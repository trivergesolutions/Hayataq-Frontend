<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadSection extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'sort_order',
    ];

    public function page()
    {
        return $this->belongsTo(DownloadPage::class, 'page_id');
    }

    // public function documents()
    // {
    //     return $this->belongsToMany(
    //         Document::class,
    //         'download_section_document'
    //     )->withTimestamps()
    //         ->orderBy('download_section_document.sort_order');
    // }

    public function documents()
    {
        return $this->belongsToMany(
            Document::class,
            'download_section_document',
            'section_id',   // 👈 exact DB column
            'document_id'
        )
            ->withPivot('page_id', 'sort_order')
            ->withTimestamps();
    }
}
