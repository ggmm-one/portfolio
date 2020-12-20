<?php

namespace App\Http\Requests;

use App\ResourceType;
use TiMacDonald\Validation\Rule;

final class ResourceTypeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, ResourceType::DD_NAME_LENGTH)->get(),
            'category' => Rule::required()->in(array_keys(ResourceType::CATEGORIES))->get(),
        ];
    }
}
