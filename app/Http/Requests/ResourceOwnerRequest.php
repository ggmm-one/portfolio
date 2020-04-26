<?php

namespace App\Http\Requests;

use App\ResourceOwner;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class ResourceOwnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, ResourceOwner::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(ResourceOwner::DD_EMAIL_LENGTH)->get(),
        ];
    }
}
