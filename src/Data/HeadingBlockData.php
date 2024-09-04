<?php

namespace Nuxtifyts\NuxtifyPages\Data;

class HeadingBlockData extends BlockData
{
    public function __construct(
        public string $content,
        public string $level,
    ) {
        $this->type = Block::HEADING;
    }
}
