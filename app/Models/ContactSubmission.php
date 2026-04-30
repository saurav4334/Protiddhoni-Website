<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'interest', 'name', 'email', 'company', 'phone',
        'industry', 'expected_volume', 'message',
        'status', 'assigned_to', 'internal_notes',
        'ip_address', 'user_agent',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }

    /** Scope: unread/new submissions for the dashboard inbox count. */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
