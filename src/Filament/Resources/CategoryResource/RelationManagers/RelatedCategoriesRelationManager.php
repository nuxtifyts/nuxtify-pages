<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RelatedCategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatedCategories';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.name')),
                Tables\Columns\TextColumn::make('relation')
                    ->searchable()
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.related-category.fields.relation')),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('nuxtify-pages::nuxtify-pages.models.category.fields.related_categories');
    }

    public function isReadOnly(): bool
    {
        return true;
    }
}
