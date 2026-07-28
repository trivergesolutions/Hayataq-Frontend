<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\EnquiryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear-cache', function () {

    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return response()->json([
        'status' => true,
        'message' => 'Cache cleared successfully'
    ]);
});

Route::get('/', [WebsiteController::class, 'homePage'])->name('homepage');
Route::get('/about', [WebsiteController::class, 'aboutPage'])->name('aboutPage');
Route::get('/blogs', [WebsiteController::class, 'blogPage'])->name('blogPage');
Route::get('/blog/{slug}', [WebsiteController::class, 'blogDetailPage'])->name('blogDetailPage');
Route::get('/service', [WebsiteController::class, 'servicePage'])->name('servicePage');
Route::get('/contact', [WebsiteController::class, 'contactPage'])->name('contactPage');
Route::get('/privacy-policy', [WebsiteController::class, 'privacyPolicyPage'])->name('privacyPolicyPage');
Route::get('/terms-conditions', [WebsiteController::class, 'termsConditionsPage'])->name('termsConditionsPage');
Route::get('/downloads', [WebsiteController::class, 'downloadPage'])->name('downloadPage');
Route::get('/download/{slug}', [WebsiteController::class, 'downloadSubPage'])->name('downloadSubPage');
Route::get('/download/{slug1?}/{slug2?}', [WebsiteController::class, 'mainDownloadPage'])->name('mainDownloadPage');
Route::get('/portableOnsiteMachiningTools', [WebsiteController::class, 'portableOnsiteMachiningTools'])->name('portableOnsiteMachiningTools');
Route::get('/clamshellSplitFramesCuttersandAccessories', [WebsiteController::class, 'clamshellSplitFramesCuttersandAccessories'])->name('clamshellSplitFramesCuttersandAccessories');
Route::get('/pipeCuttingBevelingMachine', [WebsiteController::class, 'pipeCuttingBevelingMachine'])->name('pipeCuttingBevelingMachine');
Route::get('/productDetail/{id}', [WebsiteController::class, 'productDetail'])->name('productDetail');
Route::get('/product/{slug}', [WebsiteController::class, 'productDetailBySlug'])->name('productDetailBySlug');
Route::get('/mainProducts', [WebsiteController::class, 'mainProducts'])->name('mainProducts');
Route::get('/category/{slug}', [WebsiteController::class, 'subCategory'])->name('subCategory');
Route::get('/sub-category/{slug}', [WebsiteController::class, 'sub_category'])->name('sub_category');
Route::post('/service-enquiry', [WebsiteController::class, 'store'])
    ->name('service.enquiry.store');
Route::post('download-manual', [WebsiteController::class, 'downloadManual'])->name('download.manual');
Route::get('/search-suggestions', [App\Http\Controllers\WebsiteController::class, 'search']);
Route::get('/test', [WebsiteController::class, 'suggestions'])
    ->name('product.search');

Route::post('/save-enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/save-contact-enquiry', [EnquiryController::class, 'contact'])->name('enquiry.contact.store');
Route::get('/get-contact', [EnquiryController::class, 'getContact'])->name('contact.fetch');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/admin/{any?}', function () {
    return file_get_contents(public_path('admin/index.html'));
})->where('any', '.*');
