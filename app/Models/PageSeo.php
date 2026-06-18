<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageSeo extends Model
{
    use HasFactory;

    protected $fillable = [
        'page', 'label', 'title', 'meta_description', 'og_title', 'og_image', 'canonical_url',
    ];

    /**
     * Fetch the SEO row for a page (cached). Always returns a PageSeo instance so Blade
     * can read ->title etc. with the model's own attributes as the source of truth.
     *   PageSeo::for('homepage')->title
     */
    public static function for(string $page): self
    {
        return Cache::remember("page_seo:{$page}", 600, function () use ($page) {
            return static::where('page', $page)->first() ?? new static(['page' => $page]);
        });
    }

    protected static function booted(): void
    {
        static::saved(fn ($s)   => Cache::forget("page_seo:{$s->page}"));
        static::deleted(fn ($s) => Cache::forget("page_seo:{$s->page}"));
    }
}
