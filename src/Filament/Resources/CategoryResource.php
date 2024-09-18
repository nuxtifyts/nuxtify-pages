<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources;

use Nuxtifyts\NuxtifyPages\Filament\Resources\CategoryResource\Pages;
use Nuxtifyts\NuxtifyPages\Filament\Resources\CategoryResource\RelationManagers;
use Filament\Resources\Concerns\Translatable;
use Nuxtifyts\NuxtifyPages\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Closure;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
         $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.name'))
                    ->columnSpan(call_user_func(static::hideParentIdFieldClosure()) ? 'full' : 'default'),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.parent'))
                    ->hidden(static::hideParentIdFieldClosure()),
                Forms\Components\Textarea::make('description')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.description'))
                    ->columnSpanFull(),
            ]);

         return $form;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.name')),
                Tables\Columns\TextColumn::make('parent.name')
                    ->numeric()
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.category.fields.parent')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function hideParentIdFieldClosure(): Closure
    {
        return static fn (): bool => !(static::$model)::count();
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RelatedCategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('nuxtify-pages::nuxtify-pages.resources.group-name');
    }
}
