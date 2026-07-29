<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'author_id',
    ];

    /* ===== Relations ===== */

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_blog')
            ->withTimestamps();
    }

    public function getFeaturedImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function seoMeta()
    {
        return $this->hasOne(SeoMeta::class, 'reference_id')
            ->where('page_type', 'blog');
    }
}
