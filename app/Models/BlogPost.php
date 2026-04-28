<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'author_id', 'category_id', 'title', 'slug', 'excerpt', 'body',
        'featured_image_url', 'hero_gradient', 'reading_minutes',
        'view_count', 'status', 'published_at', 'is_featured', 'seo',
    ];

    protected $casts = [
        'published_at'    => 'datetime',
        'is_featured'     => 'boolean',
        'reading_minutes' => 'integer',
        'view_count'      => 'integer',
        'seo'             => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /* ---------------------------------------------------------------
     | Relationships
     |---------------------------------------------------------------- */

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'post_id', 'tag_id');
    }

    /* ---------------------------------------------------------------
     | Scopes
     |---------------------------------------------------------------- */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /* ---------------------------------------------------------------
     | Helpers
     |---------------------------------------------------------------- */

    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    public function getReadingMinutesAttribute($value): int
    {
        if ($value) return (int) $value;
        // 200 wpm fallback
        return max(1, (int) ceil(str_word_count(strip_tags($this->body)) / 200));
    }
}
