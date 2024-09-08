@php
    use Illuminate\Database\Eloquent\Collection;
    use Nuxtifyts\NuxtifyPages\Models\Layout;
    use Nuxtifyts\NuxtifyPages\Models\Page;

    /** @var ?Layout $layout */
    /** @var Collection<int, Page> $pages */
@endphp

@extends(
    $layout
        ? 'nuxtify-pages::components.layout'
        : config('nuxtify-pages.default_layout.name')
)

@section(
    $layout
        ? 'content'
        : config('nuxtify-pages.default_layout.section-keys.content', 'content')
)
    @foreach($pages as $page)
        @include('nuxtify-pages::components.page-card', [ 'page' => $page ])
    @endforeach
@endsection
