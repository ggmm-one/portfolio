<?php

namespace App\Http\Controllers\Admin;

use App\ResourceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use TiMacDonald\Validation\Rule;

class ResourceTypeController extends Controller
{
    public function index()
    {
        $resourceTypes = ResourceType::orderBy('name')->get();
        return view('admin.resource_types.index', compact('resourceTypes'));
    }

    public function create()
    {
        $resourceType = new ResourceType();
        $formAction = route('admin.resource_types.store');
        return view('admin.resource_types.edit', compact('resourceType', 'formAction'));
    }

    public function store(Request $request)
    {
        ResourceType::create($this->validateValues($request));
        return Redirect::route('admin.resource_types.index');
    }

    public function edit(ResourceType $resourceType)
    {
        $formAction = route('admin.resource_types.update', ['resource_type' => $resourceType]);
        return view('admin.resource_types.edit', compact('resourceType', 'formAction'));
    }

    public function update(Request $request, ResourceType $resourceType)
    {
        $resourceType->update($this->validateValues($request));
        return Redirect::route('admin.resource_types.index');
    }

    public function destroy(ResourceType $resourceType)
    {
        $resourceType->deleteIfNotReferenced();
        return Redirect::route('admin.resource_types.index');
    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, ResourceType::DD_NAME_LENGTH)->get(),
            'category' => Rule::required()->in(array_keys(ResourceType::CATEGORIES))->get()
        ]);
    }
}
