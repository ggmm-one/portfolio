<?php

namespace App\Http\Requests;

use App\Link;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class LinkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => Rule::required()->string(1, Link::DD_TITLE_LENGTH)->get(),
            'url' => Rule::required()->url(Link::DD_URL_LENGTH)->get(),
            'sort_order' => Rule::integer(0, Link::DD_SORT_ORDER_MAX)->get(),
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateModelLink();
        });
    }

    protected function validateModelLink()
    {
        if ($this->routeIs('*store')) {
            return;
        }
        $model = $this->portfolio_unit ?: $this->project ?: null;
        if ($model == null || $this->link->linkable_id != $model->id || $this->link->linkable_type != $model::MORPH_SHORT_NAME) {
            abort(404);
        }
    }
}
