<?php

namespace App\Http\Controllers\Resource;

use App\ResourceOwner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use TiMacDonald\Validation\Rule;

class ResourceOwnerController extends Controller
{
    public function index()
    {
        $resourceOwners = ResourceOwner::ordered()->get();
        return view('resources.resource_owners.index', compact('resourceOwners'));
    }

    public function create()
    {
        $resourceOwner = new ResourceOwner();
        $formAction = route('resources.resource_owners.store');
        return view('resources.resource_owners.edit', compact('resourceOwner', 'formAction'));
    }

    public function store(Request $request)
    {
        ResourceOwner::create($this->validateValues($request));
        return Redirect::route('resources.resource_owners.index');
    }

    public function edit(ResourceOwner $resourceOwner)
    {
        $formAction = route('resources.resource_owners.update', ['resource_owner' => $resourceOwner->pid]);
        $deleteAction = route('resources.resource_owners.destroy', ['resource_owner' => $resourceOwner->pid]);
        return view('resources.resource_owners.edit', compact('resourceOwner', 'formAction', 'deleteAction'));
    }

    public function update(Request $request, ResourceOwner $resourceOwner)
    {
        $resourceOwner->update($this->validateValues($request));
        return Redirect::route('resources.resource_owners.index');
    }

    public function destroy(ResourceOwner $resourceOwner)
    {
        $resourceOwner->deleteIfNotReferenced();
        return Redirect::route('resources.resource_owners.index');
    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, ResourceOwner::DD_NAME_LENGTH)->get(),
            'email' => Rule::required()->email(ResourceOwner::DD_EMAIL_LENGTH)->get()
        ]);
    }
}
