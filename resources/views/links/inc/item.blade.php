<tr>
    <td>{{ $link->title}}</td>
    <td>
        <a href="{{ $link->url }}" class="d-inline-block text-truncate" rel="noreferrer">{{ $link->url }}</a>
    </td>
    <td class="action-cell">
        <a href=" {{ str_replace('LLIINNKK', $link->pid, $editRoute) }}">Edit</a>
    </td>
</tr>
