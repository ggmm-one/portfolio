<tr>
    <td>
        @php echo str_repeat('&nbsp;', $portfolioUnit->hierarchy_level * 4) @endphp
        <a href="{{ route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]) }}">{{ $portfolioUnit->name }}</a>
    </td>
    <td>{{ __($portfolioUnit->type_name) }}</td>
    <td class="action-cell app-action">
        <a href="{{ route('projects.projects.index', ['portfolio_unit' => $portfolioUnit->pid])}}">{{ __('Projects') }}</a>
    </td>
</tr>
