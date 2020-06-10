<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class ResourceAllocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
