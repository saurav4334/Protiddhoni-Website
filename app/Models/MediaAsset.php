<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaAsset extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'path', 'mime_type'];

    /** Public, web-accessible URL of the uploaded file (empty string if none). */
    public function getUrlAttribute(): string
    {
        return $this->path ? Storage::disk('public')->url($this->path) : '';
    }
}
