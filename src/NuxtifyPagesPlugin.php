<?php

namespace Nuxtifyts\NuxtifyPages;

use Filament\SpatieLaravelTranslatablePlugin;
use Nuxtifyts\NuxtifyPages\Filament\Resources;
use Filament\Contracts\Plugin;
use Filament\Panel;

class NuxtifyPagesPlugin implements Plugin
{
    public function getId(): string
    {
        return 'nuxtify-pages';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                Resources\LayoutResource::class,
                Resources\PageResource::class,
                Resources\TagResource::class,
                Resources\CategoryResource::class
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(config('nuxtify-pages.locales')),
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
