<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource;

class ListLayouts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = LayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
