<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use TiMacDonald\Validation\Rule;
use App\User;

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

    public function store(Request $request)
    {
        $user = new User($this->validateValues($request));
        $user->password = Str::random(56);
        $user->save();
        return Redirect::route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($this->validateValues($request, $user->id));
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

    private function validateValues(Request $request, $idToIgnore = -1)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, User::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(User::DD_EMAIL_LENGTH)->unique('users')->where(function ($query) use ($idToIgnore) {
                $query->where('id', '<>', $idToIgnore);
            })->get(),
            'role_pid' => Rule::required()->exists('roles', 'pid')->get()
        ]);
    }
}
