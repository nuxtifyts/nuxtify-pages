<?php

namespace Nuxtifyts\NuxtifyPages\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Nuxtifyts\NuxtifyPages\Enums\PageVisibility;

class VisibleScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('visibility', PageVisibility::PUBLIC->value);
    }
}
