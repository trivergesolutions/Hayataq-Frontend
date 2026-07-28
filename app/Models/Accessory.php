<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $fillable = [
        'name',
        'image',
        'document'
    ];

    protected $appends = [
        'image_url',
        'document_url'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'accessory_product');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }

    public function getDocumentUrlAttribute()
    {
        return $this->document ? asset($this->document) : null;
    }
}
