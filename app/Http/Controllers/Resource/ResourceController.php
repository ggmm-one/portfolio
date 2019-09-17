<?php

namespace App\Http\Controllers\Resource;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $resources = $this->filter($request)->get();
        return view('resources.resources.index', compact('resources', 'isFiltered'));
    }

    public function create()
    {
        $resource = new Resource();
        $formAction = route('resources.resources.store');
        return view('resources.resources.edit', compact('resource', 'formAction'));
    }

    public function store(Request $request)
    {
        $resource = Resource::create($this->validateValues($request));
        return Redirect::route('resources.resources.edit', compact('resource'));
    }

    public function edit(Resource $resource)
    {
        $formAction = route('resources.resources.update', compact('resource'));
        return view('resources.resources.edit', compact('resource', 'formAction'));
    }

    public function update(Request $request, Resource $resource)
    {
        $resource->update($this->validateValues($request));
        $formAction = route('resources.resources.update', compact('resource'));
        return view('resources.resources.edit', compact('resource', 'formAction'));
    }

    public function destroy(Resource $resource)
    {
        //TODO: Check dependencies before deleting

    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, Resource::DD_NAME_LENGTH)->get(),
            'resource_type_pid' => Rule::required()
                ->exists('resource_types', 'pid')->where(function ($query) {
                    $query->where('organization_id', Auth::user()->organization_id);
                    $query->whereNull('deleted_at');
                })->get(),
            'resource_owner_pid' => Rule::required()
                ->exists('resource_owners', 'pid')->where(function ($query) {
                    $query->where('organization_id', Auth::user()->organization_id);
                    $query->whereNull('deleted_at');
                })->get(),
            'description' => Rule::max(Resource::DD_DESCRIPTION_LENGTH)->get()
        ]);
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
