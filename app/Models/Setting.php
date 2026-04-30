<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value', 'type', 'group', 'label', 'description',
    ];

    /** Setting::get('site.name', 'Protiddhoni') */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting:{$key}", 600, function () use ($key, $default) {
            $row = static::where('key', $key)->first();
            if (! $row) return $default;

            return match ($row->type) {
                'json'    => json_decode($row->value, true),
                'boolean' => (bool) $row->value,
                'integer' => (int) $row->value,
                default   => $row->value,
            };
        });
    }

    /** Setting::set('site.name', 'Protiddhoni') */
    public static function set(string $key, mixed $value, string $type = 'string', string $group = 'general'): self
    {
        $row = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : (string) $value,
                'type'  => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting:{$key}");

        return $row;
    }

    protected static function booted(): void
    {
        static::saved(fn ($s)   => Cache::forget("setting:{$s->key}"));
        static::deleted(fn ($s) => Cache::forget("setting:{$s->key}"));
    }
}
