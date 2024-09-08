<?php

namespace Nuxtifyts\NuxtifyPages\Models;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property int $page_id
 */
class CategoryPage extends NuxtifyModel
{
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'page_id',
    ];

    public function getBaseTable(): string
    {
        return 'category_pages';
    }
}
