<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nuxtifyts\NuxtifyPages\Enums\CategoryRelation;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property int $related_category_id
 * @property CategoryRelation $relation
 * @property ?CarbonInterface $created_at
 * @property ?CarbonInterface $updated_at
 * @property-read Category $category
 * @property-read Category $relatedCategory
 */
class RelatedCategory extends NuxtifyModel
{
    protected $table = 'related_categories';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'related_category_id',
        'relation'
    ];

    protected function casts(): array
    {
        return [
            'relation' => CategoryRelation::class
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function relatedCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'related_category_id');
    }
}
