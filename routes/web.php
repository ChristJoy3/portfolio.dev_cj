<?php

use App\Http\Controllers\HomeController;
use App\Models\Media;
use App\Models\Resume;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/cv', function () {
    return view('cv', ['cv' => Resume::current()]);
})->name('cv');

// Admin-uploaded images. The id changes on every upload, so the response can be cached forever.
// Session/cookie middleware is skipped: a Set-Cookie header would stop the CDN caching it.
Route::get('/media/{media}', function (Media $media) {
    return response($media->bytes(), 200, [
        'Content-Type' => $media->mime,
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->withoutMiddleware([
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        ValidateCsrfToken::class,
    ])
    ->whereNumber('media')->name('media');
