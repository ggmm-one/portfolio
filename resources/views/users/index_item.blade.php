<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
        <a href="{{ route('users.edit', [$user]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
