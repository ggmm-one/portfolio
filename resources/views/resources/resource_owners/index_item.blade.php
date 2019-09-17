<tr>
    <td>{{ $resourceOwner->name }}</td>
    <td>{{ $resourceOwner->email }}</td>
    <td class="app-action">
        <a href="{{ route('resources.resource_owners.edit', ['resource_owner' => $resourceOwner->pid]) }}">{{ __('Edit') }}</a>
        <a href="{{ route('resources.resources.index', ['owner' => $resourceOwner->pid]) }}">{{ __('Resources') }}</a>
    </td>
</tr>
