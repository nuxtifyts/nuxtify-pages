<?php

namespace Nuxtifyts\NuxtifyPages\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Nuxtifyts\NuxtifyPages\Models\Page;

class NuxtifyPage extends Component
{
    public function __construct(public Page $page)
    {
    }

    public function render(): View
    {
        return view('nuxtify-pages::components.page')
            ->with('page', $this->page);
    }
}
