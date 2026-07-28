<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'status',
        'sort_order',
        'single_page',
    ];

    public function sections()
    {
        return $this->hasMany(DownloadSection::class, 'page_id')
            ->orderBy('sort_order');
    }

    public function downloadDocument()
    {
        return $this->hasMany(DownloadSectionDocument::class, 'page_id')
            ->orderBy('sort_order');
    }
}
