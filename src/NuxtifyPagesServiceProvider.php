<?php

namespace Nuxtifyts\NuxtifyPages;

use Illuminate\Support\Facades\Event;
use Nuxtifyts\NuxtifyPages\Events\RequireCategorySync;
use Nuxtifyts\NuxtifyPages\Listeners\SyncRelatedCategories;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * @package Nuxtifyts\NuxtifyPages
 */
class NuxtifyPagesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('nuxtify-pages')
            ->hasMigration('create_nuxtify_pages_tables')
            ->hasTranslations()
            ->hasViews()
            ->hasViewComponents(
                'nuxtify-components',
                Components\Heading::class,
                Components\Paragraph::class,
                Components\Image::class,
            )
            ->hasConfigFile();
    }

    public function boot(): PackageServiceProvider
    {
        Event::listen(RequireCategorySync::class, SyncRelatedCategories::class);

        return parent::boot();
    }
}
