<?php

namespace App\Http\Controllers\Admin;

use App\ResourceType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\ResourceTypeRequest;

class ResourceTypeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ResourceType::class);
        $resourceTypes = ResourceType::ordered()->get();
        return view('admin.resource_types.index', compact('resourceTypes'));
    }

    public function create()
    {
        $this->authorize('create', ResourceType::class);
        $resourceType = new ResourceType();
        $formAction = route('admin.resource_types.store');
        return view('admin.resource_types.edit', compact('resourceType', 'formAction'));
    }

    public function store(ResourceTypeRequest $request)
    {
        $this->authorize('create', ResourceType::class);
        ResourceType::create($request->validated());
        return Redirect::route('admin.resource_types.index');
    }

    public function edit(ResourceType $resourceType)
    {
        $this->authorize('view', $resourceType);
        $formAction = route('admin.resource_types.update', ['resource_type' => $resourceType]);
        return view('admin.resource_types.edit', compact('resourceType', 'formAction'));
    }

    public function update(ResourceTypeRequest $request, ResourceType $resourceType)
    {
        $this->authorize('update', $resourceType);
        $resourceType->update($request->validated());
        return Redirect::route('admin.resource_types.index');
    }

    public function destroy(ResourceType $resourceType)
    {
        $this->authorize('delete', $resourceType);
        $resourceType->deleteIfNotReferenced();
        return Redirect::route('admin.resource_types.index');
    }
}
