<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'page_type',
        'reference_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'reference_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'reference_id');
    }
}
