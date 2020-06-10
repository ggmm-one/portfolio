<tr>
    <td>{{ $capacity->start->format('Y-m') }}</td>
    <td>{{ $capacity->end->format('Y-m') }}</td>
    <td>{{ __($capacity->type_name) }}</td>
    <td>{{ __($capacity->quantity) }}</td>
    <td class="app-action">
        <a href="{{ route('resource_capacities.edit', ['resource' => $resource, 'resource_capacity' => $capacity]) }}">{{ __('Edit') }}</a>
        <x-delete-model :model="$capacity" />
    </td>
</tr>
