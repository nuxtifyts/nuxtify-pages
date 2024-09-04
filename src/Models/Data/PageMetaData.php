<?php

namespace Nuxtifyts\NuxtifyPages\Models\Data;

use Spatie\LaravelData\Data;

class PageMetaData extends Data
{
    /**
     * @param array<string> $keywords
     */
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?array $keywords = null,
        public ?string $author = null,
    ) {
    }
}
