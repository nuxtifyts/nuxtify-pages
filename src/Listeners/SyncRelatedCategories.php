<?php

namespace Nuxtifyts\NuxtifyPages\Listeners;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Nuxtifyts\NuxtifyPages\Enums\CategoryRelation;
use Nuxtifyts\NuxtifyPages\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nuxtifyts\NuxtifyPages\Events\RequireCategorySync;
use Nuxtifyts\NuxtifyPages\Models\RelatedCategory;

class SyncRelatedCategories implements ShouldQueue
{
    public function handle(RequireCategorySync $event): void
    {
        /** @var Category $category */
        $category = Category::find($event->categoryId);

        $data = collect()
            ->union($this->buildRelatedCategoriesData($category, CategoryRelation::PARENT))
            ->union($this->buildRelatedCategoriesData($category, CategoryRelation::RELATED))
            ->union($this->buildRelatedCategoriesData($category, CategoryRelation::CHILD));

        RelatedCategory::upsert(
            values: $data->toArray(),
            uniqueBy: ['category_id', 'related_category_id'],
            update: ['category_id', 'related_category_id', 'relation']
        );
    }

    private function buildRelatedCategoriesData(Category $category, CategoryRelation $relation): Collection
    {
        return (match($relation) {
                CategoryRelation::PARENT => $this->getCategoryParentIds($category),
                CategoryRelation::RELATED => $this->getCategorySiblingsIds($category),
                CategoryRelation::CHILD => $this->getCategoryChildrenIds($category),
            })
            ->map(static fn (int $id): array => [
                [
                    'category_id' => $category->id,
                    'related_category_id' => $id,
                    'relation' => $relation->value
                ],
                [
                    'category_id' => $id,
                    'related_category_id' => $category->id,
                    'relation' => CategoryRelation::reverse($relation)->value
                ]
            ])
            ->collapse();
    }

    /**
     * @return Collection<int>
     */
    private function getCategoryParentIds(Category $category): Collection
    {
        return collect(
            $category->parent_id
                ? DB::select("
                       WITH RECURSIVE cte (id, parent_id) AS (
                           SELECT c1.id, c1.parent_id
                           FROM {$this->getTablePrefix()}categories AS c1
                           WHERE c1.id = $category->id
                           UNION ALL
                           SELECT c2.id, c2.parent_id
                           FROM {$this->getTablePrefix()}categories AS c2
                               INNER JOIN cte
                                   ON c2.id = cte.parent_id
                       )
                       SELECT id
                       FROM cte
                       WHERE id <> $category->id
                   ")
                : []
        )->pluck('id');
    }

    /**
     * @return Collection<int>
     */
    private function getCategorySiblingsIds(Category $category): Collection
    {
        return collect(
            $category->parent_id
                ? DB::select("
                        WITH RECURSIVE cte (id, parent_id) AS (
                            SELECT c1.id, c1.parent_id
                            FROM {$this->getTablePrefix()}categories AS c1
                            WHERE c1.parent_id = $category->parent_id
                            AND c1.id <> $category->id
                            UNION ALL
                            SELECT c2.id, c2.parent_id
                            FROM {$this->getTablePrefix()}categories AS c2
                                INNER JOIN cte
                                    ON c2.parent_id = cte.id
                        )
                        SELECT id
                        FROM cte
                    ")
                : []
        )->pluck('id');
    }

    /**
     * @return Collection<int>
     */
    private function getCategoryChildrenIds(Category $category): Collection
    {
        return collect(DB::select("
            WITH RECURSIVE cte (id, parent_id) AS (
                SELECT c1.id, c1.parent_id
                FROM {$this->getTablePrefix()}categories AS c1
                WHERE c1.parent_id = $category->id
                UNION ALL
                SELECT c2.id, c2.parent_id
                FROM {$this->getTablePrefix()}categories AS c2
                    INNER JOIN cte
                        ON c2.parent_id = cte.id
            )
            SELECT id
            FROM cte
        "))->pluck('id');
    }

    private function getTablePrefix(): string
    {
        return ($prefix = config('nuxtify-pages.database.prefix', ''))
            ? $prefix . '_'
            : '';
    }
}
