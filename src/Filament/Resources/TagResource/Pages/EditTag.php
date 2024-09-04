<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\TagResource\Pages;

use Nuxtifyts\NuxtifyPages\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
