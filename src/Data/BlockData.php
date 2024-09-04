<?php

namespace Nuxtifyts\NuxtifyPages\Data;

use Spatie\LaravelData\Data;

abstract class BlockData extends Data
{
    public Block $type;

    public function getComponentName(): string
    {
        return "nuxtify-components-{$this->type->value}";
    }
}
