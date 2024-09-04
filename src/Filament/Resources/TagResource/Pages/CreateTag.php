<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\TagResource\Pages;

use Nuxtifyts\NuxtifyPages\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
