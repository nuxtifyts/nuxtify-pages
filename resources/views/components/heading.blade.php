@php
    use Nuxtifyts\NuxtifyPages\Data\HeadingBlockData;
    /** @var HeadingBlockData $data */
@endphp

<{{ $data->level }}>
{{ $data->content }}
</{{ $data->level }}>
