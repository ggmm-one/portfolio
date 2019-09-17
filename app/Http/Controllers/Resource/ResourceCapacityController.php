<?php

namespace App\Http\Controllers\Resource;

use App\ResourceCapacity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resource;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Rules\NoIntervalOverlap;
use App\Libraries\DateHelper;
use App\Model;

class ResourceCapacityController extends Controller
{
    public function index(Resource $resource)
    {
        $capacities = $resource->capacities;
        return view('resources.capacities.index', compact('resource', 'capacities'));
    }

    public function create(Resource $resource)
    {
        $resourceCapacity = new ResourceCapacity(['start' => Carbon::now()->setDay(1), 'end' => Carbon::now()->addYear()->setDay(1)]);
        $formAction = route('resources.capacities.store', ['resource' => $resource->pid]);
        return view('resources.capacities.edit', compact('resource', 'resourceCapacity', 'formAction'));
    }

    public function store(Request $request, Resource $resource)
    {
        $capacity = new ResourceCapacity($this->validateValues($request));
        $capacity->resource_id = $resource->id;
        $capacity->save();
        return Redirect::route('resources.capacities.index', ['resource' => $resource->pid]);
    }

    public function edit(Resource $resource, ResourceCapacity $resourceCapacity)
    {
        if ($resourceCapacity->resource_id != $resource->id) abort(404);
        $formAction = route('resources.capacities.update', ['resource' => $resource->pid, 'resource_capacity' => $resourceCapacity->pid]);
        return view('resources.capacities.edit', compact('resource', 'resourceCapacity', 'formAction'));
    }

    public function update(Request $request, Resource $resource, ResourceCapacity $resourceCapacity)
    {
        if ($resourceCapacity->resource_id != $resource->id) abort(404);
        $resourceCapacity->update($this->validateValues($request));
        return Redirect::route('resources.capacities.index', ['resource' => $resource->pid]);
    }

    public function destroy(Resource $resource, ResourceCapacity $resourceCapacity)
    {
        if ($resourceCapacity->resource_id != $resource->id) abort(404);
        $resourceCapacity->delete();
        return Redirect::route('resources.capacities.index', ['resource' => $resource->pid]);
    }

    private function validateValues(Request $request)
    {
        $values = $request->validate([
            'start' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->get(),
            'end' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->after('start')->add(new NoIntervalOverlap($request))->get(),
            'type' => Rule::required()->in(array_keys(ResourceCapacity::TYPES))->get(),
            'quantity' => Rule::required()->integer(0, ResourceCapacity::DD_QUANTITY_MAX)->get()
        ]);
        $values['start'] = DateHelper::setDateToMonth($values['start']);
        $values['end'] = DateHelper::setDateToMonth($values['end']);
        return $values;
    }
}
