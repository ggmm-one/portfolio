<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;
use App\User;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, User::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(User::DD_EMAIL_LENGTH)->unique('users')->ignore($this->user->id ?? -1)->get(),
            'role_pid' => Rule::required()->exists('roles', 'pid')->get()
        ];
    }
}
