<tr>
    <td>{{ $resource->name }}</td>
    <td>{{ $resource->type->name }}</td>
    <td>{{ $resource->owner->name }}</td>
    <td><a href="{{ route('resources.resources.edit', compact('resource')) }}">{{ __('Edit') }}</a></td>
</tr>
