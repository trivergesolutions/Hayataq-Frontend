<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comapny',
        'product_id',
        'accessory_id',
        'message',
        'status',
    ];

    /* ===== Relations ===== */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }
}
