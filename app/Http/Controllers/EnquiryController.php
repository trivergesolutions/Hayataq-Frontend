<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\User;
use App\trait\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactEnquiryMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductEnquiryMail;

class EnquiryController extends Controller
{
    use ApiResponseTrait;

    /* ================= INDEX ================= */

    public function index(Request $request)
    {
        try {

            $query = Enquiry::with([
                'user:id,name,email,phone',
                'product:id,name,slug'
            ]);

            /* ================= STATUS FILTER ================= */
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            /* ================= PRODUCT FILTER ================= */
            if ($request->filled('product_id')) {
                $query->where('product_id', $request->product_id);
            }

            /* ================= USER NAME / EMAIL SEARCH ================= */
            if ($request->filled('user')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->user . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->user . '%');
                });
            }

            /* ================= DATE RANGE FILTER ================= */
            // if ($request->filled('from_date') && $request->filled('to_date')) {
            //     $query->whereBetween('created_at', [
            //         $request->from_date . ' 00:00:00',
            //         $request->to_date . ' 23:59:59'
            //     ]);
            // } elseif ($request->filled('from_date')) {
            //     $query->whereDate('created_at', '>=', $request->from_date);
            // } elseif ($request->filled('to_date')) {
            //     $query->whereDate('created_at', '<=', $request->to_date);
            // }

            $query->when(
                $request->filled('from_date') && $request->filled('to_date'),
                fn($q) => $q->whereBetween('created_at', [
                    $request->from_date . ' 00:00:00',
                    $request->to_date . ' 23:59:59'
                ])
            );

            /* ================= PAGINATION ================= */
            $enquiries = $query
                ->latest()
                ->paginate($request->get('per_page', 10));

            return $this->success('Enquiries list', $enquiries);
        } catch (Exception $e) {
            return $this->error('Failed to fetch enquiries', 500, [$e->getMessage()]);
        }
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        // Merge First & Last Name
        $request->merge([
            // 'name' => trim($request->first_name . ' ' . $request->last_name)
            'name' => trim($request->first_name)
        ]);

        DB::beginTransaction();

        try {

            $request->validate([
                'name'         => 'required|string|max:255',
                'comapny'      => 'required|string|max:255',
                'email'        => 'required|email|max:255',
                'phone'        => 'nullable|string|max:20',
                'product_id'   => 'nullable|exists:products,id',
                // 'accessory_id' => 'nullable|exists:accessories,id',
                'message'      => 'required|string',
            ]);

            /* ================= USER ================= */

            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name'  => $request->name,
                    'phone' => $request->phone,
                ]
            );

            /* ================= ENQUIRY ================= */

            $enquiry = Enquiry::create([
                'user_id'      => $user->id,
                'product_id'   => $request->product_id,
                'comapny'   => $request->comapny,
                // 'accessory_id' => $request->accessory_id,
                'message'      => $request->message,
                'status'       => 'New',
            ]);

            DB::commit();

            /*
        |--------------------------------------------------------------------------
        | Load Relations
        |--------------------------------------------------------------------------
        */

            $enquiry->load([
                'user',
                'product',
                'accessory'
            ]);

            /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */

            try {

                Mail::to(config('mail.from.address'))
                    ->send(new ProductEnquiryMail($enquiry));
            } catch (\Exception $mailException) {

                Log::error('Product Enquiry Mail Failed', [
                    'message' => $mailException->getMessage(),
                    'email'   => $request->email,
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Enquiry submitted successfully.',
                'data'    => $enquiry
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Product Enquiry Failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again.',
                'errors'  => [$e->getMessage()]
            ], 500);
        }
    }

    /* ================= SHOW ================= */

    public function show($id)
    {
        try {
            $enquiry = Enquiry::with(['user', 'product'])->findOrFail($id);
            return $this->success('Enquiry details', $enquiry);
        } catch (Exception $e) {
            return $this->error('Enquiry not found', 404);
        }
    }

    /* ================= UPDATE ================= */

    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $enquiry = Enquiry::findOrFail($id);

    //         $request->validate([
    //             'status'  => 'required|in:0,1,2', // pending, resolved, rejected
    //             'message' => 'nullable|string',
    //         ]);

    //         $enquiry->update([
    //             'status'  => $request->status,
    //             'message' => $request->message ?? $enquiry->message,
    //         ]);

    //         DB::commit();

    //         return $this->success('Enquiry updated successfully', $enquiry);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return $this->error('Enquiry update failed', 500, [$e->getMessage()]);
    //     }
    // }

    /* ================= DELETE ================= */

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $enquiry = Enquiry::findOrFail($id);
            $enquiry->delete();

            DB::commit();

            return $this->success('Enquiry deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error('Enquiry delete failed', 500, [$e->getMessage()]);
        }
    }

    public function fetchAndMarkRead(Request $request)
    {
        DB::beginTransaction();

        try {
            /* ================= FETCH NEW ENQUIRIES ================= */

            $enquiries = Enquiry::with(['user', 'product'])
                ->where('status', 'New') // new / unread
                ->latest()
                ->get();

            if ($enquiries->isEmpty()) {
                DB::commit();
                return $this->success('No new enquiries', []);
            }

            /* ================= BULK STATUS UPDATE ================= */

            $$enquiries = Enquiry::whereIn('id', $enquiries->pluck('id'))
                ->update(['status' => 'Read']); // mark as read

            DB::commit();

            return $this->success(
                'New enquiries fetched and marked as read',
                $enquiries
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error(
                'Failed to fetch/update enquiries',
                500,
                [$e->getMessage()]
            );
        }
    }

    public function contact(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'department' => 'required|string|max:255',
                'name'       => 'required|string|max:255',
                'email'      => 'required|email|max:255',
                'company'    => 'nullable|string|max:255',
                'code'       => 'required|string|max:10',
                'phone'      => 'required|string|max:20',
                'subject'    => 'required|string|max:255',
                'message'    => 'required|string',
            ]);

            // Create or Fetch User
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name'  => $request->name,
                    'phone' => $request->code . ' ' . $request->phone,
                ]
            );

            // Save Enquiry
            $contact = Contact::create([
                'user_id'    => $user->id,
                'department' => $request->department,
                'subject'    => $request->subject,
                'company'    => $request->company,
                'message'    => $request->message,
            ]);

            DB::commit();

            // Load User Relation
            $contact->load('user');

            /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */

            try {

                Mail::to(config('mail.from.address'))
                    ->send(new ContactEnquiryMail($contact));
            } catch (\Exception $mailException) {

                Log::error('Contact Enquiry Mail Failed', [
                    'message' => $mailException->getMessage(),
                    'email'   => $request->email,
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Contact form submitted successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Contact Enquiry Failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function getContact(Request $request)
    {
        try {

            $query = Contact::with([
                'user:id,name,email,phone'
            ]);

            /* ================= SEARCH ================= */
            if ($request->filled('search')) {

                $search = $request->search;

                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                });
            }

            /* ================= DEPARTMENT FILTER ================= */
            if ($request->filled('department')) {
                $query->where('department', $request->department);
            }

            /* ================= DATE RANGE FILTER ================= */
            if ($request->filled('from_date') && $request->filled('to_date')) {

                $query->whereBetween('created_at', [
                    $request->from_date . ' 00:00:00',
                    $request->to_date . ' 23:59:59'
                ]);
            } elseif ($request->filled('from_date')) {

                $query->whereDate('created_at', '>=', $request->from_date);
            } elseif ($request->filled('to_date')) {

                $query->whereDate('created_at', '<=', $request->to_date);
            }

            /* ================= PAGINATION ================= */
            $contacts = $query
                ->latest()
                ->paginate($request->get('per_page', 10));

            return response()->json([
                'status' => true,
                'message' => 'Contact enquiries fetched successfully',
                'data' => $contacts
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
