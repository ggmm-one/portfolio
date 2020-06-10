<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Resource::class);
        $resources = Resource::all();

        return view('resources.index', compact('resources'));
    }

    public function create()
    {
        $this->authorize('create', Resource::class);
        $resource = new Resource();

        return view('resourcesedit', compact('resource'));
    }

    public function store(ResourceRequest $request)
    {
        $this->authorize('create', Resource::class);
        $resource = Resource::create($request->validated());

        return Redirect::route('resources.edit', compact('resource'));
    }

    public function edit(Resource $resource)
    {
        $this->authorize('view', $resource);

        return view('resources.edit', compact('resource'));
    }

    public function update(ResourceRequest $request, Resource $resource)
    {
        $this->authorize('view', $resource);
        $resource->update($request->validated());

        return view('resources.edit', compact('resource'));
    }

    public function destroy(Resource $resource)
    {
        $this->authorize('delete', $resource);
        $resource->deleteIfNotReferenced();

        return Redirect::route('resources.index');
    }
}
