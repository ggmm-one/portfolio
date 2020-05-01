<tr>
    <td>{{ $evaluationScore->evaluationItem->name }}</td>
    <td>{{ $evaluationScore->score }}</td>
    <td>{{ $evaluationScore->evaluationItem->weight }}</td>
    <td>{{ $evaluationScore->formatted_weighted_score }}</td>
    <td><a href="{{ route('evaluation_scores.edit', ['project' => $project, 'evaluation_score' => $evaluationScore]) }}">{{ __('Edit') }}</a></td>
</tr>
