<?php

namespace App\Http\Requests;

use TiMacDonald\Validation\Rule;

final class ResourceAllocationRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'resource_hashid' => Rule::required()->get(),
            'month' => Rule::required()->integer()->get(),
            'quantity' => Rule::required()->integer()->get(),
            'sort_order' => Rule::required()->integer(0)->get(),
        ];
    }
}
