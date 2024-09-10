<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources;

use Illuminate\Database\Eloquent\Builder;
use Nuxtifyts\NuxtifyPages\Filament\Resources\PageResource\Pages;
use Filament\Resources\Concerns\Translatable;
use Nuxtifyts\NuxtifyPages\Enums\PageStatus;
use Nuxtifyts\NuxtifyPages\Enums\PageVisibility;
use Nuxtifyts\NuxtifyPages\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Nuxtifyts\NuxtifyPages\Scopes\PublishedScope;
use Nuxtifyts\NuxtifyPages\Scopes\VisibleScope;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('nuxtify-pages::nuxtify-pages.models.page.sections.page-information'))
                    ->schema([
                        Forms\Components\Split::make([
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\FileUpload::make('cover_image')
                                        ->image()
                                        ->required(config('nuxtify-pages.pages.cover_image_required'))
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.cover_image'))
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->maxLength(60)
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.slug'))
                                        ->columnSpanFull()
                                        ->disabled()
                                        ->hiddenOn('create'),
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(50)
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.title'))
                                        ->columnSpanFull(),
                                    Forms\Components\Textarea::make('description')
                                        ->nullable()
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.description'))
                                        ->columnSpanFull(),
                                ]),
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\Select::make('status')
                                        ->options(PageStatus::getTranslatedValues())
                                        ->required()
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.status'))
                                        ->default(config('nuxtify-pages.pages.default_status')),
                                    Forms\Components\Select::make('visibility')
                                        ->options(PageVisibility::getTranslatedValues())
                                        ->required()
                                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.visibility'))
                                        ->default(config('nuxtify-pages.pages.default_visibility')),
                                ])
                                ->grow(false),
                        ])
                    ]),

                Forms\Components\Section::make(__('nuxtify-pages::nuxtify-pages.models.page.sections.seo'))
                    ->schema([
                        Forms\Components\TextInput::make('metadata.title')
                            ->nullable()
                            ->maxLength(60)
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.metadata.title'))
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('metadata.description')
                            ->nullable()
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.metadata.description'))
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('metadata.keywords')
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.metadata.keywords'))
                            ->columnSpanFull()
                            ->nullable(),
                        Forms\Components\TextInput::make('metadata.author')
                            ->nullable()
                            ->maxLength(50)
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.metadata.author'))
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),

                Forms\Components\Section::make(__('nuxtify-pages::nuxtify-pages.models.page.sections.tags_and_categories'))
                    ->schema([
                        Forms\Components\Select::make('tags')
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.tags'))
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique()
                                    ->label(__('nuxtify-pages::nuxtify-pages.models.tag.fields.name'))
                            ]),

                        Forms\Components\Select::make('categories')
                            ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.categories'))
                            ->relationship('categories', 'name')
                            ->multiple(),
                    ])
                    ->collapsed(),

                Forms\Components\Section::make(__('nuxtify-pages::nuxtify-pages.models.page.sections.page-elements'))
                    ->schema([
                        Pages\PageContentBuilder::create('content')
                            ->withHeadingBlock()
                            ->withParagraphBlock()
                            ->withImageBlock()
                            ->build(),
                    ])
                    ->collapsed()
                    ->persistCollapsed(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.published_at'))
                    ->columnStart(2)
                    ->requiredIf('status', PageStatus::PUBLISHED->value),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.slug'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('layout.code')
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.layout_id')),
                Tables\Columns\SelectColumn::make('status')
                    ->options(PageStatus::getTranslatedValues())
                    ->default(config('nuxtify-pages.pages.default_status'))
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.status')),
                Tables\Columns\SelectColumn::make('visibility')
                    ->options(PageVisibility::getTranslatedValues())
                    ->default(config('nuxtify-pages.pages.default_visibility'))
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.visibility')),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.fields.published_at')),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(PublishedScope::class)
            ->withoutGlobalScope(VisibleScope::class);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->withoutGlobalScope(PublishedScope::class)
            ->withoutGlobalScope(VisibleScope::class);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
