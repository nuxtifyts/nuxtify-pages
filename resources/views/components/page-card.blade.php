@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

<div>
    <h1>{{ $page->title }}</h1>

    <div>
        {!! $page->content !!}
    </div>

    @if ($routeName = config('nuxtify-pages.routes.show'))
        <a href="{{ route($routeName, [ 'slug' => $page->slug ]) }}">
            {{ __('nuxtify-pages::nuxtify-pages.actions.read') }}
        </a>
    @endif
</div>
