<?php

namespace App\View\Components;

use Illuminate\View\Component;
use ProtoneMedia\LaravelFormComponents\Components\HandlesBoundValues;

class GgmmFormHeader extends Component
{
    use HandlesBoundValues;

    public string $legend;

    public function __construct()
    {
        $bind = $this->getBoundTarget();
        $this->legend = ($bind->exists ? 'Edit' : 'Add').' '.$bind->getModelDisplayName();
    }

    public function render()
    {
        return view('components.ggmm-form-header');
    }
}
