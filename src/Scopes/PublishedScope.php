<?php

namespace Nuxtifyts\NuxtifyPages\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Nuxtifyts\NuxtifyPages\Enums\PageStatus;

class PublishedScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder
            ->where('status', PageStatus::PUBLISHED->value)
            ->where('published_at', '<=', now());
    }
}
