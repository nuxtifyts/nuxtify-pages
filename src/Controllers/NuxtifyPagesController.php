<?php

namespace Nuxtifyts\NuxtifyPages\Controllers;

use Illuminate\Http\Response;
use Nuxtifyts\NuxtifyPages\Models\Page;

class NuxtifyPagesController
{
    public function index(): Response
    {
        return response()->view('nuxtify-pages::index', [
            'pages' => Page::orderbyDesc('updated_at')
                ->paginate(perPage: config('nuxtify-pages.pagination.per-page'))
        ]);
    }

    public function show(string $slug): Response
    {
        return response()->view('nuxtify-pages::single', [
            'page' => Page::findBySlug($slug) ?? abort(404)
        ]);
    }
}
