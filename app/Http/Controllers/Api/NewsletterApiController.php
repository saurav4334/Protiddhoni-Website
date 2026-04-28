<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsletterApiController extends Controller
{
    /** POST /api/newsletter */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'  => 'required|email|max:160',
            'name'   => 'nullable|string|max:120',
            'source' => 'nullable|string|max:64',
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $data['email']],
            [
                'name'   => $data['name']   ?? null,
                'source' => $data['source'] ?? 'unknown',
                'status' => 'subscribed',
            ]
        );

        // If they had unsubscribed previously, re-subscribe.
        if ($subscriber->status !== 'subscribed') {
            $subscriber->update([
                'status'         => 'subscribed',
                'unsubscribed_at'=> null,
            ]);
        }

        return response()->json([
            'ok'      => true,
            'message' => 'You\'re on the list. We\'ll be in your inbox every Tuesday.',
        ], 201);
    }
}
