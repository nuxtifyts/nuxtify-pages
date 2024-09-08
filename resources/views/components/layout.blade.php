@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    use Nuxtifyts\NuxtifyPages\Models\Layout;
    /** @var ?Page $page */
    /** @var ?Layout $layout */
@endphp

@foreach($layout?->blocks ?? $page?->layout->blocks ?? [] as $block)
    <x-dynamic-component
        :component="$block->getComponentName()"
        :data="$block"
    />
@endforeach
