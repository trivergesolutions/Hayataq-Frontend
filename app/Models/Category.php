<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'parent_id',
        'is_active',
    ];

    /* ===== Hierarchy ===== */

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default-category.png'); // Agar image nahi hai toh default path
        }

        // Agar aap image public folder mein rakhte hain
        return asset($this->image);

        // YA agar aap Storage (storage/app/public) use kar rahe hain toh:
        // return asset('storage/' . $this->image);
    }


    /* ===== Relations ===== */

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product')
            ->withTimestamps();
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'category_blog')
            ->withTimestamps();
    }

    public function categoryDescription()
    {
        return $this->hasOne(CategoryDescription::class, 'categoryId');
    }
}
