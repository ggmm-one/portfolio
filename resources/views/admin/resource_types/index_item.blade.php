<tr>
    <td>{{ $resourceType->name }}</td>
    <td>{{ $resourceType->category_name }}</td>
    <td class="app-action">
        <a href="{{ route('admin.resource_types.edit', ['resource_type' => $resourceType->pid]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
