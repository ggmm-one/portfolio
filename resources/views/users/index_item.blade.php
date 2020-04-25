<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td class="app-action">
        <a href="{{ route('users.edit', [$user]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
