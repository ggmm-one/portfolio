<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::ordered()->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User;

        return view('admin.users.edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->validated());
        $user->password = Str::random(56);
        $user->save();

        Password::broker()->sendResetLink(['email' => $user->email]);

        return Redirect::route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return Redirect::route('admin.users.index');
    }

    public function destroy(User $user)
    {
        //User cannot delete itself
        if ($user->pid == Auth::user()->pid) {
            Session::flash('flash-danger', 'Cannot delete your own user');

            return Redirect::route('admin.users.edit', ['user' => $user->pid]);
        } else {
            $user->delete();

            return Redirect::route('admin.users.index');
        }
    }
}
