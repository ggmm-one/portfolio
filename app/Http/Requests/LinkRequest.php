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
}
