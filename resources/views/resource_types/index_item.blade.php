<tr>
    <td>{{ $resourceType->name }}</td>
    <td>{{ $resourceType->category_name }}</td>
    <td>
        <a href="{{ route('resource_types.edit', [$resourceType]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
