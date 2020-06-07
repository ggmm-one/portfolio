<tr>
    <td>{{ $evaluationItem->name }}</td>
    <td>{{ $evaluationItem->weight }}</td>
    <td>
        <a href="{{ route('evaluation_items.edit', [$evaluationItem]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
