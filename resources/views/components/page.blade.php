@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */

    $pageTitle = config('nuxtify-pages.layout.section-keys.page-title', 'page-title');
    $metaTitle = config('nuxtify-pages.layout.section-keys.meta.title', 'title');
    $metaDescription = config('nuxtify-pages.layout.section-keys.meta.description', 'description');
    $metaKeywords = config('nuxtify-pages.layout.section-keys.meta.keywords', 'keywords');
    $metaAuthor = config('nuxtify-pages.layout.section-keys.meta.author', 'author');
@endphp

@section($pageTitle, $page->title)
@section($metaTitle, $page->metadata?->title)
@section($metaDescription, $page->metadata?->description)
@section($metaKeywords, implode(', ', $page->metadata?->keywords ?? []))
@section($metaAuthor, $page->metadata?->author)

@foreach($page->blocks as $block)
    <x-dynamic-component :component="$block->getComponentName()" :data="$block"/>
@endforeach
