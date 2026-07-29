<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteEnquiry extends Model
{
    use HasFactory;

    protected $table = 'quote_enquiries';

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'category',
        'industry',
        'project_requirement',
        'status',
    ];
}
