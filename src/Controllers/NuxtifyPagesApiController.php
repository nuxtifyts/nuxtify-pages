<?php

namespace Nuxtifyts\NuxtifyPages\Controllers;

use Nuxtifyts\NuxtifyPages\Models\Page;
use Nuxtifyts\NuxtifyPages\Resources\PageJsonResource;

class NuxtifyPagesApiController
{
    public function index(string $slug): PageJsonResource
    {
        return new PageJsonResource(Page::findBySlug($slug) ?? abort(404, 'page_not_found'));
    }
}
