<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::ordered()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User;

        return view('users.edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $user = new User($request->validated());
        $user->password = Str::random(56);
        $user->save();

        return Redirect::route('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return Redirect::route('users.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $role);

        //User cannot delete itself
        if ($user->id == Auth::user()->id) {
            Session::flash('flash-danger', 'Cannot delete your own user');

            return Redirect::route('users.edit', [$user]);
        } else {
            $user->delete();

            return Redirect::route('users.index');
        }
    }
}
