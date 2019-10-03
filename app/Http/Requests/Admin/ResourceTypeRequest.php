<?php

namespace App\Http\Requests\Admin;

use App\ResourceType;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class ResourceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, ResourceType::DD_NAME_LENGTH)->get(),
            'category' => Rule::required()->in(array_keys(ResourceType::CATEGORIES))->get(),
        ];
    }
}
