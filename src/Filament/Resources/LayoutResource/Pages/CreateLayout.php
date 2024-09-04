<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource;

class CreateLayout extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = LayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
        ];
    }
}
