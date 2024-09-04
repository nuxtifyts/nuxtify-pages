<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\PageResource\Pages;

use Filament\Forms;
use Exception;

class PageContentBuilder
{
    private array $blocks = [];

    protected function __construct(private readonly string $name)
    {
    }

    public function withHeadingBlock(): static
    {
        $this->blocks['heading'] = Forms\Components\Builder\Block::make('heading')
            ->label(__('nuxtify-pages::nuxtify-pages.models.page.block-name.heading'))
            ->schema([
                Forms\Components\Select::make('level')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.level'))
                    ->options([
                        'h1' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h1'),
                        'h2' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h2'),
                        'h3' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h3'),
                        'h4' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h4'),
                        'h5' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h5'),
                        'h6' => __('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.h6'),
                    ])
                    ->required(),
                Forms\Components\TextInput::make('content')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.heading.content'))
                    ->required(),
            ])
            ->columns();

        return $this;
    }

    public function withParagraphBlock(): static
    {
        $this->blocks['paragraph'] = Forms\Components\Builder\Block::make('paragraph')
            ->label(__('nuxtify-pages::nuxtify-pages.models.page.block-name.paragraph'))
            ->schema([
                Forms\Components\RichEditor::make('content')
                    ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.paragraph.content'))
                    ->columnSpanFull()
                    ->disableToolbarButtons([
                        'h2',
                        'h3',
                    ]),
            ]);

        return $this;
    }

    public function withImageBlock(): static
    {
        $this->blocks['image'] = Forms\Components\Builder\Block::make('image')
            ->label(__('nuxtify-pages::nuxtify-pages.models.page.block-name.image'))
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\FileUpload::make('src')
                        ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.image.src'))
                        ->image()
                        ->required(),
                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\TextInput::make('alt')
                                ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.image.alt'))
                                ->required(),
                            Forms\Components\TextInput::make('height')
                                ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.image.height'))
                                ->nullable(),
                            Forms\Components\TextInput::make('width')
                                ->label(__('nuxtify-pages::nuxtify-pages.models.page.blocks.image.width'))
                                ->nullable(),
                        ]),
                ]),
            ]);

        return $this;
    }

    public static function create(string $name): static
    {
        return new static($name);
    }

    /**
     * @throws Exception
     */
    public function build(): Forms\Components\Builder
    {
        return count($this->blocks)
            ? Forms\Components\Builder::make($this->name)
                ->hiddenLabel()
                ->blocks(array_values($this->blocks))
                ->blockNumbers(false)
                ->columnSpanFull()
            : throw new Exception('At least one block must be added to the content builder.');
    }
}
