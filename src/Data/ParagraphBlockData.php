<?php

namespace Nuxtifyts\NuxtifyPages\Data;

class ParagraphBlockData extends BlockData
{
    public function __construct(
        public string $content,
    ) {
        $this->type = Block::PARAGRAPH;
    }
}
