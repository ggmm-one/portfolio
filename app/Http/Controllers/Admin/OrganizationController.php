<?php

namespace App\Http\Controllers\Admin;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use TiMacDonald\Validation\Rule;

class OrganizationController extends Controller
{
    public function edit()
    {
        $organization = Auth::user()->organization;
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => Rule::required()->string(1, Organization::DD_NAME_LENGTH)->get()
        ]);

        $org = Auth::user()->organization;
        $org->update($validated);
        return Redirect::route('admin.organizations.edit', ['organization' => 'X']);
    }

}
