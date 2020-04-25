<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Role;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::ordered()->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        $role = new Role;

        return view('roles.edit', compact('role'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $role = Role::create($request->validated());

        return Redirect::route('roles.edit', [$role]);
    }

    public function edit(Role $role)
    {
        $this->authorize('view', $role);

        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->update($request->validated());

        return Redirect::route('roles.edit', [$role]);
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        $role->deleteIfNotReferenced();

        return Redirect::route('roles.index');
    }
}
