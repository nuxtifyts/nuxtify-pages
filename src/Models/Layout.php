<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nuxtifyts\NuxtifyPages\Concerns\Attributes\HasBlocksAttribute;
use Nuxtifyts\NuxtifyPages\Data\BlockData;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property ?array $metadata
 * @property array $content
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property-read EloquentCollection $pages
 * @property-read EloquentCollection $tags
 * @property-read ?Collection<int, BlockData> $blocks
 */
class Layout extends NuxtifyModel
{
    use HasTranslations;
    use HasBlocksAttribute;

    protected $fillable = [
        'code',
        'metadata',
        'content'
    ];

    protected array $translatable = [
        'metadata',
        'content'
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'metadata' => 'array'
        ];
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
