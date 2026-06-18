<?php

use Illuminate\Support\Facades\Route;

// ---------------------------------------------------------------------------
// Frontend marketing pages — dynamic Blade views (content hydrated from the DB
// via PageBlock/PageSeo + cms-client.js, with the original HTML as fallback).
// Each view gets $seoPage (drives layout SEO) and $cmsPage (drives JS hydration).
// ---------------------------------------------------------------------------
$pages = [
    '/'                => ['view' => 'home',            'page' => 'homepage'],
    '/about'           => ['view' => 'about',           'page' => 'about'],
    '/pricing'         => ['view' => 'pricing',         'page' => 'pricing'],
    '/voice-otp'       => ['view' => 'voice-otp',       'page' => 'voice-otp'],
    '/voice-survey'    => ['view' => 'voice-survey',    'page' => 'voice-survey'],
    '/voice-broadcast' => ['view' => 'voice-broadcast', 'page' => 'voice-broadcast'],
    '/api-docs'        => ['view' => 'api-docs',        'page' => 'api-docs'],
    '/blog'            => ['view' => 'blog',            'page' => 'blog'],
    '/contact'         => ['view' => 'contact',         'page' => 'contact'],
    '/user-guide'      => ['view' => 'user-guide',      'page' => 'user-guide'],
];

foreach ($pages as $uri => $cfg) {
    Route::get($uri, fn () => view("frontend.{$cfg['view']}", [
        'seoPage' => $cfg['page'],
        'cmsPage' => $cfg['page'],
    ]));
}

// Contact form (server-side fallback for non-JS clients; the JS form posts to /api/contact).
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');


// Filament owns /admin — root redirects are no longer needed as root is now the landing page.
// Route::get('/', fn () => redirect('/admin'));

// Health check (used by uptime monitors)
Route::get('/health', fn () => response()->json(['ok' => true, 'service' => 'protiddhoni-cms']));

// Newsletter unsubscribe + double-opt-in
Route::get('/newsletter/confirm/{token}', [\App\Http\Controllers\NewsletterController::class, 'confirm'])
     ->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])
     ->name('newsletter.unsubscribe');
