<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property ?CarbonInterface $created_at
 * @property ?CarbonInterface $updated_at
 * @property-read Collection $pages
 * @property-read Collection $taggables
 */
class Tag extends NuxtifyModel
{
    protected $fillable = [
        'name',
    ];

    public function taggables(): HasMany
    {
        return $this->hasMany(Taggable::class);
    }

    public function pages(): MorphToMany
    {
        return $this->morphedByMany(Page::class, 'taggable');
    }
}
