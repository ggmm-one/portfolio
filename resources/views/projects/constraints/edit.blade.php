@extends('layouts.frame_app')

@section('pagetitle', 'Constraints')
@section('bodyid', 'app-projects-constraints-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <br>

    <h5>{{ __('Timeline Constraint') }}</h5>

    <form action="{{ route('projects.constraints.update', ['project' => $project->pid, 'project_order_constraint' => $project->pid]) }}" method="POST">
        @csrf
        @method('PATCH')
        @form_input(['input_type' => 'date', 'control_id' => 'start_after', 'control_label' => 'Start After', 'control_value' => old('start_after', isset($project->start_after) ? $project->start_after->toDateString() : '')])
        @form_input(['input_type' => 'date', 'control_id' => 'end_before', 'control_label' => 'End Before', 'control_value' => old('end_before', isset($project->end_before) ? $project->end_before->toDateString() : '')])
        @if (auth()->user()->can('update', $project)) @form_submit @endif
    </form>

    <h5>{{ __('Order Constraint') }}</h5>

    <form action="{{ route('projects.constraints.store', compact('project')) }}" method="POST">
        @csrf
        @form_select(['control_id' => 'pid', 'control_label' => 'This project before', 'control_value' => old('project_pid'),'select_options' => $selectProjects])
        @if (auth()->user()->can('update', $project)) @form_submit(['control_value' => 'Add']) @endif
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Sequence') }}</th>
                <th>{{ __('Project') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @if ($beforeProjects->count() + $afterProjects->count() == 0)
            <tr><td>{{ __('No constraints found') }}</td></tr>
        @else
            @php $projects = ['After' => $afterProjects, 'Before' => $beforeProjects]; @endphp
            @foreach($projects as $sequence => $constraints)
                @foreach($constraints as $constraint)
                    <tr>
                        <td>{{ __($sequence) }}</td>
                        <td><a href="{{ route('projects.projects.edit', ['project' => $constraint->afterProject->pid])}}">{{ $constraint->afterProject->name }}</a></td>
                        <td>
                            @if (true || auth()->user()->can('delete', $constraint))
                                <a href="#" class="app-js-delete-btn" data-delete-form-id="delete-form-{{ $constraint->afterProject->pid }}">{{ __('Remove Constraint') }}</a>
                                <form id="delete-form-{{ $constraint->afterProject->pid }}" action="{{ route('projects.constraints.destroy', ['project' => $project->pid, 'project_order_constraint' => $constraint->pid]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endif
                        </td>
                    </td>
                @endforeach
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
