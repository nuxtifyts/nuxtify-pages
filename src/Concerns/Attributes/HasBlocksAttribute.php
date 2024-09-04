<?php

namespace Nuxtifyts\NuxtifyPages\Concerns\Attributes;

use ArrayAccess;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Nuxtifyts\NuxtifyPages\Data\BlockBuilder;
use Illuminate\Support\Collection;

trait HasBlocksAttribute
{
    private function getContent(): array|ArrayAccess
    {
        return $this->getAttribute('content');
    }

    protected function blocks(): Attribute
    {
        return Attribute::make(
            get: fn (): ?Collection => BlockBuilder::build($this->getContent())
        )->shouldCache();
    }
}
