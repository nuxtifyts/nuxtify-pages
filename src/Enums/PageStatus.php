<?php

namespace Nuxtifyts\NuxtifyPages\Enums;

enum PageStatus: string
{
    case DRAFT = 'draft';
    case ARCHIVED = 'archived';
    case PENDING = 'pending';
    case PUBLISHED = 'published';

    /**
     * @return array<string, string> Associated by value
     */
    public static function getTranslatedValues(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                static fn (self $case): array => [
                    $case->value => __("nuxtify-pages::nuxtify-pages.enums.page-status.{$case->value}"),
                ]
            )
            ->all();
    }
}
