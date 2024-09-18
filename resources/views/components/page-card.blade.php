@php
    use Nuxtifyts\NuxtifyPages\Models\Page;
    /** @var Page $page */
@endphp

<div>
    <h1 class="text-lg md:text-xl lg:text-2xl font-semibold">
        {{ $page->title }}
    </h1>

    <h4 class="text-sm">{{ $page->published_at->translatedFormat('l F jS\, Y') }}</h4>

    @if($page->categories->isNotEmpty())
        <div class="flex flex-row flex-wrap gap-2 mt-2">
            @foreach($page->categories as $category)
                <span class="bg-white/50 px-3 py-1 text-xs rounded-3xl">
                {{ $category->name }}
            </span>
            @endforeach
        </div>
    @endif

    @if ($routeName = config('nuxtify-pages.routes.show'))
        <a
            href="{{ route($routeName, [ 'slug' => $page->slug ]) }}"
            target="_self"
        >
            {{ __('nuxtify-pages::nuxtify-pages.actions.read') }}
        </a>
    @endif
</div>
