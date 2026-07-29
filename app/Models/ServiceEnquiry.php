<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceEnquiry extends Model
{
    use HasFactory;
    protected $table = "service_enquiry";
    protected $fillable = [
        'user_id',
        'service',
        'requirements'
    ];

    // 🔗 Each enquiry belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
