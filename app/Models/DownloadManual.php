<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadManual extends Model
{
    protected $table = "download_manuals";
    protected $fillable = [
        'name',
        'email',
        'contact',
        'company',
    ];
}
