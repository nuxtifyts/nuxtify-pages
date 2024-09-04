<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Nuxtifyts\NuxtifyPages\Data\BlockData;

abstract class BlockComponent extends Component
{
    public function __construct(public BlockData $data)
    {
        if (! $data instanceof ($this->blockDataClass())) {
            throw new \InvalidArgumentException('invalid_data_provided');
        }
    }

    /**
     * @return class-string<BlockData>
     */
    abstract protected function blockDataClass(): string;

    abstract protected function getViewName(): string;

    public function render(): View
    {
        return view($this->getViewName())
            ->with('data', $this->data);
    }
}
