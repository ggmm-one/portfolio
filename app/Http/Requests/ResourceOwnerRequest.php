<?php

namespace App\Http\Requests;

use App\ResourceOwner;
use TiMacDonald\Validation\Rule;

final class ResourceOwnerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, ResourceOwner::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(ResourceOwner::DD_EMAIL_LENGTH)->get(),
        ];
    }
}
