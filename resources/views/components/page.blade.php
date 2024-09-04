@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

@section(
    config('nuxtify-pages.default_layout.section-keys.meta.title', 'title'),
    $page->metadata?->title
)

@section(
    config('nuxtify-pages.default_layout.section-keys.meta.description', 'description'),
    $page->metadata?->description
)

@section(
    config('nuxtify-pages.default_layout.section-keys.meta.keywords', 'keywords'),
    implode(', ', $page->metadata?->keywords ?? [])
)

@section(
    config('nuxtify-pages.default_layout.section-keys.meta.author', 'author'),
    $page->metadata?->author
)

@foreach($page->blocks as $block)
    <x-dynamic-component
        :component="$block->getComponentName()"
        :data="$block"
    />
@endforeach
