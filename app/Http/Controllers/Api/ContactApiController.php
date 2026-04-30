<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Notifications\NewContactSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ContactApiController extends Controller
{
    /** POST /api/contact */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'interest'         => ['required', Rule::in(['voice_otp', 'voice_survey', 'voice_broadcast', 'other'])],
            'name'             => 'required|string|max:120',
            'email'            => 'required|email|max:160',
            'company'          => 'nullable|string|max:120',
            'phone'            => 'nullable|string|max:32',
            'industry'         => 'nullable|string|max:64',
            'expected_volume'  => 'nullable|string|max:64',
            'message'          => 'nullable|string|max:4000',
            // Honeypot — should always be empty
            'website'          => 'nullable|max:0',
        ]);

        // Reject obvious spam (honeypot tripped)
        if (! empty($request->input('website'))) {
            return response()->json(['ok' => true]); // silent accept
        }

        $submission = ContactSubmission::create([
            ...$data,
            'status'     => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        // Notify the team (uses settings: contact.notify_emails as JSON array)
        $notifyTo = \App\Models\Setting::get('contact.notify_emails', ['hello@protiddhoni-bd.com']);
        if (is_array($notifyTo) && count($notifyTo) > 0) {
            try {
                Notification::route('mail', $notifyTo)
                    ->notify(new NewContactSubmission($submission));
            } catch (\Throwable $e) {
                // Don't block submission if mail fails — log only.
                \Log::warning('Contact notification mail failed: '.$e->getMessage());
            }
        }

        return response()->json([
            'ok'      => true,
            'message' => 'Thanks — we received your message and will be in touch within 4 hours.',
            'id'      => $submission->id,
        ], 201);
    }
}
