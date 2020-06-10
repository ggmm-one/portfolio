<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ResourceAllocationRequest;
use App\Project;
use App\Resource;
use App\ResourceAllocation;
use App\Services\ResourceAllocationService;
use Illuminate\Support\Facades\Redirect;

class ResourceAllocationController extends Controller
{
    public function index(Project $project, ResourceAllocationService $resourceAllocationService)
    {
        $this->authorize('viewAny', ResourceAllocation::class);
        $allocations = $project->resourceAllocations()->with(['project:id,duration', 'resource:id,name'])->orderBy('sort_order')->orderBy('resource_id')->get();
        $allocations = $resourceAllocationService->complete($allocations);

        return view('resource_allocations.index', compact('project', 'allocations'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', ResourceAllocation::class);
        $resourceAllocation = new ResourceAllocation();
        $formAction = route('resource_resources.store', compact('project'));

        return view('resource_allocations.edit', array_merge(compact('project', 'resourceAllocation', 'formAction'), $this->dropdowns($project)));
    }

    public function store(ResourceAllocationRequest $request, Project $project)
    {
        $this->authorize('create', ResourceAllocation::class);
        $project->resourceAllocations()->save(new ResourceAllocation($request->validated()));

        return Redirect::route('resource_allocations.index', compact('project'));
    }

    public function edit(Project $project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('update', $resourceAllocation);
        $formAction = route('resource_resources.update', ['project' => $project, 'resource_allocation' => $resourceAllocation]);
        $deleteAction = route('resource_resources.destroy', ['project' => $project, 'resource_allocation' => $resourceAllocation]);

        return view('presource_allocations.edit', array_merge(compact('project', 'resourceAllocation', 'formAction', 'deleteAction'), $this->dropdowns($project)));
    }

    public function update(ResourceAllocationRequest $request, Project $project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('update', $resourceAllocation);
        $resourceAllocation->update($request->validated());

        return Redirect::route('resource_allocations.index', compact('project'));
    }

    public function destroy($project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('delete', $resourceAllocation);
        $resourceAllocation->delete();

        return Redirect::route('presource_allocations.index', compact('project'));
    }

    private function dropdowns(Project $project)
    {
        $months = array_combine(range(1, $project->duration), array_map(null, range(1, $project->duration)));
        $resources = Resource::getSelectList();

        return compact('months', 'resources');
    }
}
