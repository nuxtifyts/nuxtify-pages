<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property int $tag_id
 * @property string $taggable_id
 * @property string $taggable_type
 * @property-read ?CarbonInterface $created_at
 * @property-read ?CarbonInterface $updated_at
 * @property-read Model $taggable
 */
class Taggable extends NuxtifyModel
{
    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type'
    ];

    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }
}
