<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td class="app-action">
        <a href="{{ route('admin.users.edit', ['user' => $user->pid]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
