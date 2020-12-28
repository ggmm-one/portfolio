<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use ProtoneMedia\LaravelFormComponents\Components\Form;
use ProtoneMedia\LaravelFormComponents\Components\HandlesBoundValues;

class GgmmForm extends Form
{
    use HandlesBoundValues;

    private $bind;

    public function __construct()
    {
        $this->bind = $this->getBoundTarget();
        $method = $this->bind->exists ? 'PATCH' : 'POST';
        parent::__construct($method);
    }

    public function withAttributes(array $attributes)
    {
        $routeName = $this->bind->getTable();
        $routeName .= $this->bind->exists ? '.update' : 'store';

        $attributes['action'] = route($routeName, Route::current()->parameters());

        return parent::withAttributes($attributes);
    }
}
