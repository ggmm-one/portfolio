<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\ResourceRequest;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Resource::class);
        $resources = $this->filter($request)->get();

        return view('resources.resources.index', compact('resources', 'isFiltered'));
    }

    public function create()
    {
        $this->authorize('create', Resource::class);
        $resource = new Resource();
        $formAction = route('resources.resources.store');

        return view('resources.resources.info.edit', compact('resource', 'formAction'));
    }

    public function store(ResourceRequest $request)
    {
        $this->authorize('create', Resource::class);
        $resource = Resource::create($request->validated());

        return Redirect::route('resources.resources.edit', compact('resource'));
    }

    public function edit(Resource $resource)
    {
        $formAction = route('resources.resources.update', compact('resource'));

        return view('resources.resources.info.edit', compact('resource', 'formAction'));
    }

    public function update(ResourceRequest $request, Resource $resource)
    {
        $this->authorize('view', $resource);
        $resource->update($request->validated());
        $formAction = route('resources.resources.update', compact('resource'));

        return view('resources.resources.info.edit', compact('resource', 'formAction'));
    }

    public function destroy(Resource $resource)
    {
        $this->authorize('delete', $resource);
        $resource->deleteIfNotReferenced();

        return Redirect::route('resources.resources.index');
    }

    private function filter(Request &$request)
    {
        $builder = Resource::with('owner:id,pid,name')->with('type:id,pid,name');

        if ($request->has('owner')) {
            $builder->join('resource_owners', 'resource_owners.id', '=', 'resources.resource_owner_id')
                ->where('resource_owners.pid', $request->input('owner'));
            $request->setFiltered();
        }

        $builder->orderBy('resources.name')->get();

        return $builder;
    }
}
