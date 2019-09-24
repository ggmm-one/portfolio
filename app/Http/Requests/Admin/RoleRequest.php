<?php

namespace App\Http\Requests\Admin;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, Role::DD_NAME_LENGTH)->get(),
            'permission_portfolios' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_projects' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_resources' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_admin' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
        ];
    }
}
