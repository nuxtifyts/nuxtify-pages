<?php

use Nuxtifyts\NuxtifyPages\Controllers\NuxtifyPagesApiController;

if (config('nuxtify-pages.api-routes.enabled')) {
    Route::prefix(config('nuxtify-pages.api-routes.prefix'))->name('nuxtify-pages.api.')->group(function () {
        Route::get('pages/{slug}', [NuxtifyPagesApiController::class, 'index'])->name('index');
    });
}
