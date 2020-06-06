<tr>
    <td>{{ $link->title }}</td>
    <td>
        <a href="{{ $link->url }}" class="d-inline-block text-truncate" rel="noreferrer">{{ $link->url }}</a>
    </td>
    <td class="action-cell">
        <a href="{{ route(str_replace('index', 'edit', Request::route()->getName()) , array_merge(Request::route()->parameters(), compact('link')))}}">{{ __('Edit') }}</a>
    </td>
</tr>
