<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;
use App\Resource;
use TiMacDonald\Validation\Rule;

class ResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, Resource::DD_NAME_LENGTH)->get(),
            'resource_type_pid' => Rule::required()
                ->exists('resource_types', 'pid')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->get(),
            'resource_owner_pid' => Rule::required()
                ->exists('resource_owners', 'pid')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->get(),
            'description' => Rule::max(Resource::DD_DESCRIPTION_LENGTH)->get()
        ];
    }
}
