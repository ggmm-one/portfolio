<tr>
    <td>{{ $resourceOwner->name }}</td>
    <td>{{ $resourceOwner->email }}</td>
    <td class="app-action">
        <a href="{{ route('resource_owners.edit', ['resource_owner' => $resourceOwner]) }}">{{ __('Edit') }}</a>
        <a href="{{ route('resources.index', ['owner' => $resourceOwner]) }}">{{ __('Resources') }}</a>
    </td>
</tr>
