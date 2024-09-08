@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

<div>
    <h1>{{ $page->title }}</h1>

    <div>
        {!! $page->content !!}
    </div>

    <a href="{{ route('nuxtify-pages.show', [ 'slug' => $page->slug ]) }}">
        {{ __('nuxtify-pages::nuxtify-pages.actions.read') }}
    </a>
</div>
