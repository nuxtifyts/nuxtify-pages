@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

@extends(config('nuxtify-pages.layout.name', 'default'))

@section(
    config('nuxtify-pages.layout.section-keys.page-title', 'page-title'),
    "$page->title -"
)

@section(
    config('nuxtify-pages.layout.section-keys.meta.title', 'title'),
    $page->metadata?->title
)

@section(
    config('nuxtify-pages.layout.section-keys.meta.description', 'description'),
    $page->metadata?->description
)

@section(
    config('nuxtify-pages.layout.section-keys.meta.keywords', 'keywords'),
    implode(', ', $page->metadata?->keywords ?? [])
)

@section(
    config('nuxtify-pages.layout.section-keys.meta.author', 'author'),
    $page->metadata?->author
)

@section(config('nuxtify-pages.layout.section-keys.content', 'content'))
    @foreach($page->blocks as $block)
        <x-dynamic-component :component="$block->getComponentName()" :data="$block"/>
    @endforeach
@endsection
