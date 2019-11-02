
@php
    $duration = $allocations[0]->project->duration;
    $count = count($allocations);
@endphp
@for($i=0; $i < $count; $i++)
    @if ($i % $duration == 0) </tr><tr><td><a href="{{ route('resources.resources.edit', ['resource' => $allocations[$i]->resource->pid]) }}">{{ $allocations[$i]->resource->name }}</a></td> @endif
    <td>
        @if ($allocations[$i]->exists) <a href="{{ route('projects.resources.edit', ['resource' => $allocations[$i]->resource->pid, 'project' => $project->pid]) }}"> @endif
        {{ $allocations[$i]->quantity }}
        @if ($allocations[$i]->exists) </a> @endif
    </td>
@endfor
