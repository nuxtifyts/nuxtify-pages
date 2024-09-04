<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\PageResource\Pages;

use Nuxtifyts\NuxtifyPages\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
