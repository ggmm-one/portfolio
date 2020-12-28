<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceCapacityRequest;
use App\Resource;
use App\ResourceCapacity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ResourceCapacityController extends Controller
{
    public function index(Resource $resource)
    {
        $this->authorize('viewAny', ResourceCapacity::class);

        $capacities = $resource->capacities()->ordered()->get();

        return view('resource_capacities.index', compact('resource', 'capacities'));
    }

    public function create(Resource $resource)
    {
        $this->authorize('create', ResourceCapacity::class);

        $resourceCapacity = new ResourceCapacity(['start' => Carbon::now()->setDay(1), 'end' => Carbon::now()->addYear()->setDay(1)]);

        return view('resources_capacities.edit', compact('resource', 'resourceCapacity'));
    }

    public function store(ResourceCapacityRequest $request, Resource $resource)
    {
        $this->authorize('create', ResourceCapacity::class);

        $capacity = new ResourceCapacity($request->validated());
        $capacity->resource_id = $resource->id;
        $capacity->save();

        return Redirect::route('resources_capacities.index', compact('resource'));
    }

    public function edit(Resource $resource, ResourceCapacity $resourceCapacity)
    {
        $this->authorize('view', $resourceCapacity);

        return view('resource_capacities.edit', compact('resource', 'resourceCapacity'));
    }

    public function update(ResourceCapacityRequest $request, Resource $resource, ResourceCapacity $resourceCapacity)
    {
        $this->authorize('update', $resourceCapacity);

        $resourceCapacity->update($request->validated());

        return Redirect::route('resource_capacities.index', compact('resource'));
    }

    public function destroy(Resource $resource, ResourceCapacity $resourceCapacity)
    {
        $this->authorize('delete', $resourceCapacity);

        $resourceCapacity->delete();

        return Redirect::route('resource_capacities.index', compact('resource'));
    }
}
