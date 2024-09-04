<?php

namespace Nuxtifyts\NuxtifyPages\Filament\Resources\LayoutResource\Pages;

use ArrayAccess;
use Closure;
use Filament\Forms;
use Exception;
use Illuminate\Support\Arr;

class LayoutContentBuilder
{
    private array $blocks = [];

    protected function __construct(private readonly string $name)
    {
        $this->blocks['slot'] = Forms\Components\Builder\Block::make('slot')
            ->label(__('nuxtify-pages::nuxtify-pages.models.layout.block-name.slot'))
            ->schema([])
            ->maxItems(1);
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
                ->default([
                    [ 'type' => 'slot' ]
                ])
                ->rules([
                    static fn (): Closure => function (string $attribute, mixed $value, Closure $fail) {
                        if (
                            (is_array($value)
                            || $value instanceof ArrayAccess)
                            && !Arr::first(
                                $value,
                                static fn ($block) => $block['type'] === 'slot'
                            )
                        ) {
                            $fail('The :attribute must have a page content.');
                        }
                    },
                ])
                ->blockNumbers(false)
                ->columnSpanFull()
            : throw new Exception('At least one block must be added to the content builder.');
    }
}
