<?php

namespace Nuxtifyts\NuxtifyPages\Enums;

enum PageVisibility: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';

    /**
     * @return array<string, string> Associated by value
     */
    public static function getTranslatedValues(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                static fn (self $case): array => [
                    $case->value => __("nuxtify-pages::nuxtify-pages.enums.page-visibility.{$case->value}"),
                ]
            )
            ->all();
    }
}
