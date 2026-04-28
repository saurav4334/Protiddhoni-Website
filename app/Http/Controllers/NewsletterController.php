<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /** GET /newsletter/confirm/{token} */
    public function confirm(string $token, Request $request)
    {
        $sub = NewsletterSubscriber::where('confirm_token', $token)->first();
        if (! $sub) {
            return response('Invalid or expired token.', 404);
        }
        $sub->confirm();
        return response()->view('newsletter.confirmed', ['email' => $sub->email]);
    }

    /** GET /newsletter/unsubscribe/{token} */
    public function unsubscribe(string $token, Request $request)
    {
        $sub = NewsletterSubscriber::where('confirm_token', $token)->first();
        if (! $sub) {
            return response('Invalid or expired token.', 404);
        }
        $sub->unsubscribe();
        return response()->view('newsletter.unsubscribed', ['email' => $sub->email]);
    }
}
