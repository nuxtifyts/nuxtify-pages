@php
    use Nuxtifyts\NuxtifyPages\Data\HeadingBlockData;
    /** @var HeadingBlockData $data */

    $classes = match($data->level) {
        'h1' => 'text-3xl lg:text-5xl mb-6',
        'h2' => 'text-2xl lg:text-4xl mb-6',
        'h3' => 'text-xl lg:text-2xl mb-6',
        'h4' => 'text-lg lg:text-xl mb-6',
        'h5' => 'text-base lg:text-lg mb-6',
        'h6' => 'text-sm lg:text-base mb-6',
        default => '',
    };
@endphp

<{{ $data->level }} class="{{ $classes }}">
    {{ $data->content }}
</{{ $data->level }}>
