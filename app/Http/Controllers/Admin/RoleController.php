<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::ordered()->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role;
        return view('admin.roles.edit', compact('role'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());
        return Redirect::route('admin.roles.edit', ['role' => $role->pid]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return Redirect::route('admin.roles.edit', ['role' => $role->pid]);
    }

    public function destroy(Role $role)
    {
        $role->deleteIfNotReferenced();
        return Redirect::route('admin.roles.index');
    }
}
