<?php

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\NewsletterApiController;
use App\Http\Controllers\Api\PageBlockApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API — consumed by the static marketing site
|--------------------------------------------------------------------------
| Mounted at /api by RouteServiceProvider.
| CORS allowed via config/cors.php. JSON responses only.
*/

// Blog
Route::get('posts',         [BlogApiController::class, 'index']);
Route::get('posts/{slug}',  [BlogApiController::class, 'show']);
Route::get('categories',    [BlogApiController::class, 'categories']);
Route::get('tags',          [BlogApiController::class, 'tags']);

// Page-content blocks (homepage hero, FAQ, testimonials, ...)
Route::get('blocks/{key}',  [PageBlockApiController::class, 'show']);

// Form intake — rate-limited per IP+email
Route::post('contact',      [ContactApiController::class, 'store'])
     ->middleware('throttle:6,1');
Route::post('newsletter',   [NewsletterApiController::class, 'store'])
     ->middleware('throttle:6,1');
