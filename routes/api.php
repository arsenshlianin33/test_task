<?php

use App\Http\Controllers\UrlShortController;
use Illuminate\Support\Facades\Route;

Route::get('short-url', [UrlShortController::class, 'index'])->name('main.url');
Route::post('generate-shorten-url', [UrlShortController::class, 'createShortUrl'])->name('generate.short.url');
Route::get('get-shorten-url/{id}', [UrlShortController::class, 'getShortUrl'])->name('get.short.url');


Route::get('{shortUrl}', [UrlShortController::class, 'shortUrl'])->name('short.url');
