<tr>
    <td>{{ $role->name }}</td>
    <td class="app-action">
        <a href="{{ route('roles.edit', ['role' => $role->pid]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
