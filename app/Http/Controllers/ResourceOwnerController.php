<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceOwnerRequest;
use App\ResourceOwner;
use Illuminate\Support\Facades\Redirect;

class ResourceOwnerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ResourceOwner::class);

        $resourceOwners = ResourceOwner::ordered()->get();

        return view('resource_owners.index', compact('resourceOwners'));
    }

    public function create()
    {
        $this->authorize('create', ResourceOwner::class);

        $resourceOwner = new ResourceOwner();

        return view('resource_owners.edit', compact('resourceOwner'));
    }

    public function store(ResourceOwnerRequest $request)
    {
        $this->authorize('create', ResourceOwner::class);

        ResourceOwner::create($request->validated());

        return Redirect::route('resource_owners.index');
    }

    public function edit(ResourceOwner $resourceOwner)
    {
        $this->authorize('update', $resourceOwner);

        return view('resource_owners.edit', compact('resourceOwner'));
    }

    public function update(ResourceOwnerRequest $request, ResourceOwner $resourceOwner)
    {
        $this->authorize('update', $resourceOwner);

        $resourceOwner->update($request->validated());

        return Redirect::route('resource_owners.index');
    }

    public function destroy(ResourceOwner $resourceOwner)
    {
        $this->authorize('delete', $resourceOwner);

        $resourceOwner->deleteIfNotReferenced();

        return Redirect::route('resource_owners.index');
    }
}
