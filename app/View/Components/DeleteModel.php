<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class DeleteModel extends Component
{
    public $model = null;
    public $formId = '';
    public $url = '';

    public function __construct($model)
    {
        $this->model = $model;
        if ($model->exists) {
            $route = Request::route();
            $routePieces = explode('.', $route->getName());
            $routePieces[count($routePieces) - 1] = 'destroy';
            $name = implode('.', $routePieces);
            $this->url = route($name, $route->parameters());
        }
        $this->formId = md5($this->url);
    }

    public function render()
    {
        return view('components.delete-model');
    }
}
