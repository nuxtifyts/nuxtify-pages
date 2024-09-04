<?php

namespace Nuxtifyts\NuxtifyPages\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Nuxtifyts\NuxtifyPages\Models\Page;

/**
 * @mixin Page
 */
class PageJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'blocks' => $this->blocks?->toArray(),
            'layout-blocks' => $this->layout?->blocks?->toArray(),
            'created_at' => $this->created_at->toAtomString(),
            'published_at' => $this->published_at?->toAtomString(),
        ];
    }
}
