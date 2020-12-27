<?php

namespace App\View\Components;

use ProtoneMedia\LaravelFormComponents\Components\Form;
use ProtoneMedia\LaravelFormComponents\Components\HandlesBoundValues;

class GgmmForm extends Form
{
    use HandlesBoundValues;

    private $bind;

    public function __construct(string $method = 'POST', $bind = null)
    {
        $this->bind = $bind === null ? $this->getBoundTarget() : $bind;
        $method = $this->bind->exists ? 'PATCH' : $method;
        parent::__construct($method);
    }

    public function withAttributes(array $attributes)
    {
        $action = $this->bind->getTable();
        if ($this->bind->exists) {
            $action = route($action.'.update', [$this->bind]);
        } else {
            $action = route($action.'store');
        }
        $attributes['action'] = $action;

        return parent::withAttributes($attributes);
    }
}
