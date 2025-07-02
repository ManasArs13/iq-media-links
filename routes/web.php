<?php

use App\Http\Controllers\RedirectLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/{short_url}', RedirectLinkController::class)
    ->where('short_url', '^[a-zA-Z0-9_-]+$')
    ->name('link.redirect');
