<?php

namespace Nuxtifyts\NuxtifyPages\Data;

class ImageBlockData extends BlockData
{
    public function __construct(
        public string $src,
        public string $alt,
        public ?float $height = null,
        public ?float $width = null,
    ) {
        $this->type = Block::IMAGE;
    }
}
