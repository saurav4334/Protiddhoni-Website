<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

// (already imported above — kept for clarity)

class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'label', 'page', 'type', 'value', 'description', 'sort_order',
    ];

    /**
     * Quick fetch — used by API + Blade templates.
     *   PageBlock::value('homepage.hero.headline', 'Default headline')
     */
    public static function value(string $key, mixed $default = null): mixed
    {
        return Cache::remember("page_block:{$key}", 300, function () use ($key, $default) {
            $block = static::where('key', $key)->first();

            if (! $block) return $default;

            return match ($block->type) {
                'json'    => json_decode($block->value, true),
                'boolean' => (bool) $block->value,
                'integer' => (int) $block->value,
                default   => $block->value,
            };
        });
    }

    /** Bulk fetch all blocks for a page (used to render a whole template). */
    public static function forPage(string $page): array
    {
        return Cache::remember("page_blocks:{$page}", 300, function () use ($page) {
            return static::where('page', $page)
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn ($b) => [$b->key => $b->type === 'json' ? json_decode($b->value, true) : $b->value])
                ->toArray();
        });
    }

    /** Auto-flush cache on update. */
    protected static function booted(): void
    {
        static::saved(fn ($b) => static::flushCache($b));
        static::deleted(fn ($b) => static::flushCache($b));
    }

    protected static function flushCache(PageBlock $b): void
    {
        Cache::forget("page_block:{$b->key}");
        Cache::forget("page_blocks:{$b->page}");
    }
}
