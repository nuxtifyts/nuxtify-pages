<?php

namespace Nuxtifyts\NuxtifyPages\Models;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Nuxtifyts\NuxtifyPages\Concerns\Attributes\HasBlocksAttribute;
use Nuxtifyts\NuxtifyPages\Data\BlockData;
use Nuxtifyts\NuxtifyPages\Enums\PageStatus;
use Nuxtifyts\NuxtifyPages\Enums\PageVisibility;
use Nuxtifyts\NuxtifyPages\Models\Data\PageMetaData;
use Nuxtifyts\NuxtifyPages\Scopes\PublishedScope;
use Nuxtifyts\NuxtifyPages\Scopes\VisibleScope;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * @mixin \Eloquent
 * @property int $id
 * @property string $slug,
 * @property string $title,
 * @property string $description,
 * @property ?PageMetaData $metadata
 * @property array $content
 * @property ?int $layout_id
 * @property ?Layout $layout
 * @property PageStatus $status
 * @property PageVisibility $visibility
 * @property ?CarbonInterface $published_at
 * @property ?CarbonInterface $created_at
 * @property ?CarbonInterface $updated_at
 * @property-read EloquentCollection $components
 * @property-read EloquentCollection $tags
 * @property-read ?Collection<int, BlockData> $blocks
 */
#[ScopedBy([VisibleScope::class, PublishedScope::class])]
class Page extends NuxtifyModel implements Htmlable
{
    use HasTranslations;
    use HasTranslatableSlug;
    use HasBlocksAttribute;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'metadata',
        'content',
        'layout_id',
        'status',
        'visibility',
        'published_at'
    ];

    protected array $translatable = [
        'slug',
        'title',
        'content',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'metadata' => PageMetaData::class,
            'content' => 'array',
            'status' => PageStatus::class,
            'visibility' => PageVisibility::class,
            'published_at' => 'datetime'
        ];
    }

    public function layout(): BelongsTo
    {
        return $this->belongsTo(Layout::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, name: 'taggable', table: Taggable::getModel()->getTable());
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function toHtml(): string
    {
        return view('nuxtify-pages::components.page')
            ->with('page', $this)
            ->render();
    }
}
