<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Nuxtifyts\NuxtifyPages\Data\ImageBlockData;

class Image extends BlockComponent
{
    protected function blockDataClass(): string
    {
        return ImageBlockData::class;
    }

    protected function getViewName(): string
    {
        return 'nuxtify-pages::components.image';
    }
}
