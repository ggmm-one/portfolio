<tr>
    <td>{{ $resourceType->name }}</td>
    <td>{{ $resourceType->category_name }}</td>
    <td class="app-action">
        <a href="{{ route('resource_types.edit', [$resourceType]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
