<tr>
    <td>
        @php echo str_repeat('&nbsp;', $portfolioUnit->hierarchy_level * 4) @endphp
        <a href="{{ route('portfolio_units.edit', ['portfolio_unit' => $portfolioUnit]) }}">{{ $portfolioUnit->name }}</a>
    </td>
    <td>{{ __($portfolioUnit->type_name) }}</td>
    <td class="action-cell app-action">
        <a href="{{ route('projects.index', ['portfolio_unit' => $portfolioUnit])}}">{{ __('Projects') }}</a>
    </td>
</tr>
