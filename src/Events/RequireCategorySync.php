<?php

namespace Nuxtifyts\NuxtifyPages\Events;

use Illuminate\Foundation\Events\Dispatchable;

class RequireCategorySync
{
    use Dispatchable;

    public function __construct(public int $categoryId)
    {
    }
}
