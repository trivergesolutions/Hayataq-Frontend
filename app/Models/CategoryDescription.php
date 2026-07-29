<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CategoryDescription extends Model
{
    protected $table = 'category_description';

    protected $fillable = [
        'categoryId',
        'description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    protected function images(): Attribute
    {
        return Attribute::make(

            get: function ($value) {

                $images = is_array($value)
                    ? $value
                    : json_decode($value, true);

                $images = $images ?? [];

                foreach ($images as &$image) {

                    $image['full_path'] = asset('category/' . $image['file_name']);
                }

                return $images;
            }

        );
    }
}
