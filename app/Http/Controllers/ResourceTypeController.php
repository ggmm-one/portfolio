<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceTypeRequest;
use App\ResourceType;
use Illuminate\Support\Facades\Redirect;

class ResourceTypeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ResourceType::class);

        $resourceTypes = ResourceType::ordered()->get();

        return view('resource_types.index', compact('resourceTypes'));
    }

    public function create()
    {
        $this->authorize('create', ResourceType::class);

        $resourceType = new ResourceType();

        return view('resource_types.edit', compact('resourceType'));
    }

    public function store(ResourceTypeRequest $request)
    {
        $this->authorize('create', ResourceType::class);

        ResourceType::create($request->validated());

        return Redirect::route('resource_types.index');
    }

    public function edit(ResourceType $resourceType)
    {
        $this->authorize('view', $resourceType);

        return view('resource_types.edit', compact('resourceType'));
    }

    public function update(ResourceTypeRequest $request, ResourceType $resourceType)
    {
        $this->authorize('update', $resourceType);

        $resourceType->update($request->validated());

        return Redirect::route('resource_types.index');
    }

    public function destroy(ResourceType $resourceType)
    {
        $this->authorize('delete', $resourceType);

        $resourceType->deleteIfNotReferenced();

        return Redirect::route('resource_types.index');
    }
}
