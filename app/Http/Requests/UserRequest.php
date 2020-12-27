<?php

namespace App\Http\Requests;

use App\User;
use TiMacDonald\Validation\Rule;

final class UserRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, User::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(User::DD_EMAIL_LENGTH)->unique('users')->ignore($this->user->id ?? -1)->get(),
            'role_id' => Rule::required()->exists('roles', 'id')->get(),
        ];
    }
}
