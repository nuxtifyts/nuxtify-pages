@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

@extends(
    $page->layout_id
        ? 'nuxtify-pages::components.layout'
        : config('nuxtify-pages.default_layout.name')
)

@section(
    $page->layout_id
        ? 'content'
        : config('nuxtify-pages.default_layout.section-keys.content', 'content'),
    $page
)
