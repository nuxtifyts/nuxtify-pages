<?php

use Nuxtifyts\NuxtifyPages\Controllers\NuxtifyPagesController;

if (config('nuxtify-pages.web-routes.enabled')) {
    Route::prefix(config('nuxtify-pages.web-routes.prefix'))->name('nuxtify-pages.')->group(function () {
        Route::get('/{slug}', [NuxtifyPagesController::class, 'index'])->name('index');
    });
}
