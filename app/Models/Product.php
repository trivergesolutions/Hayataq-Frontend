<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'short_description',
        'long_description',
        'featured_image',
        'status',
        'dynamic_table',
        'dimensionalDiagram',
    ];

    protected $casts = [
        'dynamic_table' => 'array',
    ];

    protected $appends = ['featured_image_url'];

    /* ===== Relations ===== */

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product')
            ->withTimestamps();
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'product_document')
            ->withPivot('show_on_product')
            ->withTimestamps();
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    // public function accessories()
    // {
    //     return $this->belongsToMany(Accessory::class, 'accessory_product');
    // }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class)
            ->withPivot('order')
            ->orderBy('pivot_order');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(
            Product::class,
            'related_products',
            'product_id',
            'related_product_id'
        );
    }

    /* ================= ACCESSORS ================= */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image
            ? asset($this->featured_image)
            : null;
    }

    public function getDiagramImageUrlAttribute()
    {
        return $this->dimensionalDiagram
            ? asset($this->dimensionalDiagram)
            : null;
    }

    public function seoMeta()
    {
        return $this->hasOne(SeoMeta::class, 'reference_id')
            ->where('page_type', 'product');
    }
}
