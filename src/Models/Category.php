<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nuxtifyts\NuxtifyPages\Models\Observers\CategoryObserver;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $parent_id
 * @property ?array $metadata
 * @property string $name
 * @property string $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property-read ?Category $parent
 * @property-read Collection $relatedCategories
 */
#[ObservedBy(CategoryObserver::class)]
class Category extends NuxtifyModel
{
    use HasTranslations;

    protected $fillable = [
        'parent_id',
        'metadata',
        'name',
        'description'
    ];

    protected array $translatable = [
        'name',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, foreignKey: 'parent_id');
    }

    public function relatedCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            table: (new RelatedCategory())->getTable(),
            foreignPivotKey: 'category_id',
            relatedPivotKey: 'related_category_id'
        )->withPivot('relation');
    }
}
