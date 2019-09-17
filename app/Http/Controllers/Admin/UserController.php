<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('organization_id', Auth::user()->organization_id)->orderBy('name')->get();
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
        $user->organization_id = Auth::user()->organization_id;
        $user->save();
        return Redirect::route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::where('organization_id', Auth::user()->organization_id)->where('pid', $id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('organization_id', Auth::user()->organization_id)->where('pid', $id)->firstOrFail();
        $user->update($this->validateValues($request, $user->id));
        return Redirect::route('admin.users.index');
    }

    public function destroy($id)
    {
        //User cannot delete itself
        if ($id == Auth::user()->pid) {
            Session::flash('flash-danger', 'Cannot delete your own user');
            return Redirect::route('admin.users.edit', ['user' => $id]);
        } else {
            User::where('pid', $id)->where('organization_id', Auth::user()->organization_id)->delete();
            return Redirect::route('admin.users.index');
        }
    }

    private function validateValues(Request $request, $idToIgnore = null)
    {
        $validationRules = [
            'name' => ['required', 'max:256'],
            'email' => ['required', 'email', 'max:256']
        ];
        $validationRules['email'][] = ($idToIgnore == null) ? Rule::unique('users') : Rule::unique('users')->ignore($idToIgnore);
        return $request->validate($validationRules);
    }
}
