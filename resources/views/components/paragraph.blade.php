@php
    use Nuxtifyts\NuxtifyPages\Data\ParagraphBlockData;
    /** @var ParagraphBlockData $data */

    $strongClasses = [
        '[&_strong]:text-bold'
    ];

    $underlinedTextClasses = [
        '[&_span.underlined-text]:underline',
        '[&_span.underlined-text]:underline-offset-4'
    ];

    $blockQuoteClasses = [
        '[&_blockquote]:transition',
        '[&_blockquote]:duration-500',
        '[&_blockquote]:ease-in-out',
        '[&_blockquote]:p-4',
        '[&_blockquote]:my-4',
        '[&_blockquote]:bg-gray-100',
        '[&_blockquote]:border-l-4',
        '[&_blockquote]:border-gray-200',
        '[&_blockquote]:rounded-lg',
        '[&_blockquote]:text-gray-700',
        '[&_blockquote]:italic',
        'dark:[&_blockquote]:bg-gray-700',
        'dark:[&_blockquote]:border-gray-500',
        'dark:[&_blockquote]:text-white',
    ];

    $preClasses = [
        '[&_pre]:text-sm',
        '[&_pre]:p-4',
        '[&_pre]:my-4',
        '[&_pre]:bg-gray-100',
        '[&_pre]:border',
        '[&_pre]:border-gray-200',
        '[&_pre]:rounded-lg',
        '[&_pre]:text-gray-700',
        '[&_pre]:text-nowrap',
        '[&_pre]:overflow-x-auto',
        'dark:[&_pre]:bg-gray-700',
        'dark:[&_pre]:border-gray-500',
        'dark:[&_pre]:text-white',
    ];

    $olClasses = [
        '[&_ol]:pl-10',
        '[&_ol]:list-decimal',
        '[&_ol]:list-inside',
    ];

    $ulClasses = [
        '[&_ul]:pl-10',
        '[&_ul]:list-disc',
        '[&_ul]:list-inside',
    ];

    $linkClasses = [
        '[&_a]:text-primary',
        '[&_a]:underline-offset-4',
        '[&_a:hover]:underline',
    ];
@endphp

<div class="
        text-lg leading-relaxed mb-6
        {{ implode(' ', [
            ...$strongClasses,
            ...$underlinedTextClasses,
            ...$blockQuoteClasses,
            ...$preClasses,
            ...$olClasses,
            ...$ulClasses,
            ...$linkClasses,
        ]) }}
    "
>
    {!! $data->content !!}
</div>

@pushonce(config('nuxtify-pages.layout.stacks.scripts', 'scripts'))
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            () => document
                .querySelectorAll('span[style="text-decoration: underline;"]')
                .forEach((element) => {
                    element.style.textDecoration = '';
                    element.classList.add('underlined-text');
                })
        );
    </script>
@endpushonce
