<?php

namespace Nuxtifyts\NuxtifyPages\Enums;

enum CategoryRelation: string
{
    case PARENT = 'parent';
    case CHILD = 'child';
    case RELATED = 'related';

    /**
     * @return array<string, string> Associated by value
     */
    public static function getTranslatedValues(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                static fn (self $case): array => [
                    $case->value => __("nuxtify-pages::nuxtify-pages.enums.category-relation.{$case->value}"),
                ]
            )
            ->all();
    }

    public static function reverse(self $relation): self {
        return match($relation) {
            self::PARENT => self::CHILD,
            self::CHILD => self::PARENT,
            self::RELATED => self::RELATED,
        };
    }
}
