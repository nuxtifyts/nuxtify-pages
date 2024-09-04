<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Nuxtifyts\NuxtifyPages\Data\BlockData;
use Nuxtifyts\NuxtifyPages\Data\HeadingBlockData;

/**
 * @property HeadingBlockData $data
 */
class Heading extends BlockComponent
{
    /**
     * @return class-string<BlockData>
     */
    protected function blockDataClass(): string
    {
        return HeadingBlockData::class;
    }

    protected function getViewName(): string
    {
        return 'nuxtify-pages::components.heading';
    }
}
