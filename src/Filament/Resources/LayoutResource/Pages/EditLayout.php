<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource;

class EditLayout extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = LayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
