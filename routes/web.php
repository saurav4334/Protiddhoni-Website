<?php

use Illuminate\Support\Facades\Route;

// Frontend Pages
Route::get('/', fn () => view('frontend.index'));
Route::get('/about', fn () => view('frontend.about'));
Route::get('/pricing', fn () => view('frontend.pricing'));
Route::get('/api-docs', fn () => view('frontend.api-docs'));
Route::get('/blog', fn () => view('frontend.blog'));
Route::get('/user-guide', fn () => view('frontend.user-guide'));
Route::get('/voice-broadcast', fn () => view('frontend.voice-broadcast'));
Route::get('/voice-otp', fn () => view('frontend.voice-otp'));
Route::get('/voice-survey', fn () => view('frontend.voice-survey'));
Route::get('/contact', fn () => view('frontend.contact'));
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
