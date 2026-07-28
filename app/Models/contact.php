<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'user_id',
        'department',
        'subject',
        'company',
        'country_code',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
