<?php

namespace App\Http\Requests;

use App\Resource;
use TiMacDonald\Validation\Rule;

final class ResourceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, Resource::DD_NAME_LENGTH)->get(),
            'resource_type_id' => Rule::required()->exists('resource_types', 'id')->get(),
            'resource_owner_id' => Rule::required()->exists('resource_owners', 'id')->get(),
            'description' => Rule::max(Resource::DD_DESCRIPTION_LENGTH)->get(),
        ];
    }
}
