<tr>
    <td>{{ $link->title }}</td>
    <td>
        <a href="{{ $link->url }}" class="d-inline-block text-truncate" rel="noreferrer">{{ $link->url }}</a>
    </td>
    <td class="action-cell">
        <a href=" {{ UrlHelper::linkUrl('edit', $link->pid) }}">{{ __('Edit') }}</a>
    </td>
</tr>
