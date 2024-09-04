<?php

namespace Nuxtifyts\NuxtifyPages\Models\Observers;

use Nuxtifyts\NuxtifyPages\Models\Category;
use Nuxtifyts\NuxtifyPages\Events\RequireCategorySync;

class CategoryObserver
{
    public function saved(Category $category): void
    {
        RequireCategorySync::dispatch($category->id);
    }
}
