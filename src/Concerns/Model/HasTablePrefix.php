<?php

namespace Nuxtifyts\NuxtifyPages\Concerns\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin Model
 */
trait HasTablePrefix
{
    public function getBaseTable(): string
    {
        return Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public function getTable(): string
    {
        return $this->getTablePrefix() . $this->getBaseTable();
    }

    public function getTablePrefix(): string
    {
        return ($prefix = config('nuxtify-pages.database.prefix', ''))
            ? $prefix . '_'
            : '';
    }
}
