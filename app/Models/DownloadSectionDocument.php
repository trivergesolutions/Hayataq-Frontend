<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadSectionDocument extends Model
{
    protected $table = "download_section_document";
    protected $fillable = [
        'section_id',
        'document_id',
        'sort_order',
        'page_id',
    ];

    public function documentDownload()
    {
        return $this->belongsToMany(
            Document::class,
            'download_section_document',
            'section_id',   // 👈 exact DB column
            'document_id',
            'page_id',
        )
            ->withPivot('page_id', 'sort_order')
            ->withTimestamps();
    }
}
