<tr>
    <td>{{ $capacity->start->format('Y-m') }}</td>
    <td>{{ $capacity->end->format('Y-m') }}</td>
    <td>{{ __($capacity->type_name) }}</td>
    <td>{{ __($capacity->quantity) }}</td>
    <td class="app-action">
        <a href="{{ route('resources.capacities.edit', ['resource' => $resource->pid, 'resource_capacity' => $capacity]) }}">{{ __('Edit') }}</a>
        @if (auth()->user()->can('delete', $capacity))
            @php $deleteAction = route('resources.capacities.destroy', ['resource' => $resource->pid, 'resource_capacity' => $capacity]); @endphp
            <a href="#" class="app-js-delete-btn" data-delete-form-id="delete-form-{{ md5($deleteAction) }}">{{ __('Delete') }}</a>
            <form id="delete-form-{{ md5($deleteAction) }}" action="{{ $deleteAction }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
        @endif
    </td>
</tr>
