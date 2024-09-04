<?php

namespace Nuxtifyts\NuxtifyPages\Controllers;

use Illuminate\Http\Response;
use Nuxtifyts\NuxtifyPages\Models\Page;

class NuxtifyPagesController
{
    public function index(string $slug): Response
    {
        return response()->view('nuxtify-pages::index', [
            'page' => Page::findBySlug($slug) ?? abort(404)
        ]);
    }
}
