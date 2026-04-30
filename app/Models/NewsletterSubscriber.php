<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'name', 'source', 'status',
        'confirm_token', 'confirmed_at', 'unsubscribed_at',
    ];

    protected $casts = [
        'confirmed_at'    => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (NewsletterSubscriber $s) {
            $s->confirm_token ??= Str::random(48);
        });
    }

    public function confirm(): void
    {
        $this->update([
            'status'       => 'subscribed',
            'confirmed_at' => now(),
        ]);
    }

    public function unsubscribe(): void
    {
        $this->update([
            'status'         => 'unsubscribed',
            'unsubscribed_at'=> now(),
        ]);
    }
}
