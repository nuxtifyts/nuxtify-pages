<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Nuxtifyts\NuxtifyPages\Data\SlotBlockData;

class Slot extends BlockComponent
{
    protected function blockDataClass(): string
    {
        return SlotBlockData::class;
    }

    protected function getViewName(): string
    {
        return 'nuxtify-pages::components.slot';
    }
}
