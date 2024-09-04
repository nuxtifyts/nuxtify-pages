@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

@foreach($page->layout->blocks as $block)
    <x-dynamic-component
        :component="$block->getComponentName()"
        :data="$block"
    />
@endforeach
