<tr>
    <td>{{ $evaluationItem->name }}</td>
    <td>{{ $evaluationItem->weight }}</td>
    <td>
        <a href="{{ route('evaluation_items.edit', ['evaluation_item' => $evaluationItem->pid]) }}">{{ __('Edit') }}</a>
    </td>
</tr>