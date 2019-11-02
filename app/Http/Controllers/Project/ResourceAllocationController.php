<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
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
        $allocations = $project->resourceAllocations()->with(['project:id,pid,duration', 'resource:id,pid,name'])->orderBy('sort_order')->orderBy('resource_id')->get();
        $allocations = $resourceAllocationService->complete($allocations);

        return view('projects.resources.index', compact('project', 'allocations'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', ResourceAllocation::class);
        $allocation = new ResourceAllocation();
        $resources = Resource::getSelectList();
        $formAction = route('projects.resources.store', ['project' => $project->pid]);
        $months = array_combine(range(1, $project->duration), array_map(null, range(1, $project->duration)));

        return view('projects.resources.edit', compact('project', 'allocation', 'resources', 'months', 'formAction'));
    }

    public function store(ResourceAllocationRequest $request, Project $project)
    {
        $this->authorize('create', ResourceAllocation::class);
        $project->resourceAllocations()->save(new ResourceAllocation($request->validated()));

        return Redirect::route('projects.resources.index', ['project' => $project->pid]);
    }

    public function edit(Project $project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('update', $resourceAllocation);

        return view('projects.resources.edit', ['project' => $project->pid, 'resource_allocation' => $resourceAllocation->pid]);
    }

    public function update(ResourceAllocationRequest $request, Project $project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('update', $resourceAllocation);
        $resourceAllocation->update($request->validated());

        return Redirect::route('projects.resources.index', ['project' => $project->pid]);
    }

    public function destroy(Project $project, ResourceAllocation $resourceAllocation)
    {
        $this->authorize('delete', $resourceAllocation);

        return Redirect::route('projects.resources.index', ['project' => $project->pid]);
    }
}
