@php
    use Nuxtifyts\NuxtifyPages\Data\ImageBlockData;
    /** @var ImageBlockData $data */
@endphp

<img
    src="{{ asset("storage/$data->src") }}"
    alt="{{ $data->alt }}"
    @if($data->width) width="{{ $data->width }}" @endif
    @if($data->height) height="{{ $data->height }}" @endif
>
