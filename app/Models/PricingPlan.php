<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PricingPlan extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'price_monthly', 'price_yearly', 'rate_per_min', 'rate_note',
        'features', 'cta_label', 'cta_url', 'badge', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'features'      => 'array',
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'price_monthly' => 'integer',
        'price_yearly'  => 'integer',
        'sort_order'    => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
