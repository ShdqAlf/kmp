<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'archive_id',
        'title',
        'file_path'
    ];

    // Relasi dengan model Archive
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
