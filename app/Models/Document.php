<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'file_path',
        'file_type',
        'document_type',
        'status',
        'created_by',
    ];

    protected $appends = ['file_url'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_document')
            ->withPivot('show_on_product')
            ->withTimestamps();
    }

    public function sections()
    {
        return $this->belongsToMany(
            DownloadSection::class,
            'download_section_document'
        )->withTimestamps();
    }

    /* ================= ACCESSOR ================= */

    public function getFileUrlAttribute()
    {
        return $this->file_path
            ? asset($this->file_path)
            : null;
    }
}
