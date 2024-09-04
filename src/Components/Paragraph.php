<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Nuxtifyts\NuxtifyPages\Data\ParagraphBlockData;

class Paragraph extends BlockComponent
{
    protected function blockDataClass(): string
    {
        return ParagraphBlockData::class;
    }

    protected function getViewName(): string
    {
        return 'nuxtify-pages::components.paragraph';
    }
}
