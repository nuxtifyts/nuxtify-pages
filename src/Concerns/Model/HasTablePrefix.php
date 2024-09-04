<?php

namespace Nuxtifyts\NuxtifyPages\Concerns\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait HasTablePrefix
{
    private ?string $prefix = null;

    public function getTable(): ?string
    {
        return $this->getTablePrefix() . parent::getTable();
    }

    public function getTablePrefix(): string
    {
        return $this->prefix ??= (
            ($prefix = config('nuxtify-pages.database.prefix', ''))
            ? $prefix . '_'
            : ''
        );
    }
}
