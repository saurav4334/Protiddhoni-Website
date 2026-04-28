<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/voice-otp', 'pages.voice-otp')->name('voice-otp');
Route::view('/voice-survey', 'pages.voice-survey')->name('voice-survey');
Route::view('/voice-broadcast', 'pages.voice-broadcast')->name('voice-broadcast');
Route::view('/pricing', 'pages.pricing')->name('pricing');
Route::view('/api-docs', 'pages.api-docs')->name('api-docs');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/blog-post', 'pages.blog-post')->name('blog-post');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// Backward-compatible redirects for the original static HTML URLs.
Route::redirect('/frontend.html', '/', 301);
Route::redirect('/index.html', '/', 301);
Route::redirect('/voice-otp.html', '/voice-otp', 301);
Route::redirect('/voice-survey.html', '/voice-survey', 301);
Route::redirect('/voice-broadcast.html', '/voice-broadcast', 301);
Route::redirect('/pricing.html', '/pricing', 301);
Route::redirect('/api-docs.html', '/api-docs', 301);
Route::redirect('/blog.html', '/blog', 301);
Route::redirect('/blog-post.html', '/blog-post', 301);
Route::redirect('/about.html', '/about', 301);
Route::redirect('/contact.html', '/contact', 301);

Route::get('/health', fn () => response()->json(['ok' => true, 'service' => 'protiddhoni']));

Route::get('/newsletter/confirm/{token}', [\App\Http\Controllers\NewsletterController::class, 'confirm'])
    ->name('newsletter.confirm');

Route::get('/newsletter/unsubscribe/{token}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');
