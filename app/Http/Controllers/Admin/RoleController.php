<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role;
        return view('admin.roles.edit', compact('role'));
    }

    public function store(Request $request)
    {
        $role = Role::create($this->validateValues($request));
        return Redirect::route('admin.roles.edit', ['role' => $role->pid]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update($this->validateValues($request));
        return Redirect::route('admin.roles.edit', ['role' => $role->pid]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return Redirect::route('admin.roles.index');
    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, Role::DD_NAME_LENGTH)->get(),
            'permission_portfolios' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_projects' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_resources' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
            'permission_admin' => Rule::required()->in(array_keys(Role::PERMISSIONS))->get(),
        ]);
    }
}
