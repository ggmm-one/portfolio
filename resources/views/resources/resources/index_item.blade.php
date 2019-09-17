<tr>
    <td>{{ $resource->name }}</td>
    <td>{{ $resource->type->name }}</td>
    <td>{{ $resource->owner->name }}</td>
    <td><a href="{{ route('resources.resources.edit', compact('resource')) }}">Edit</a></td>
</tr>
