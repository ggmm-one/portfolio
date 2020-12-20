<?php

namespace App\Http\Requests;

use App\Link;
use TiMacDonald\Validation\Rule;

final class LinkRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => Rule::required()->string(1, Link::DD_TITLE_LENGTH)->get(),
            'url' => Rule::required()->url(Link::DD_URL_LENGTH)->get(),
            'sort_order' => Rule::integer(0, Link::DD_SORT_ORDER_MAX)->get(),
        ];
    }
}
