<tr>
    <td>
        @php echo str_repeat('&nbsp;', $portfolio->hierarchy_level * 4) @endphp
        {{ $portfolio->name }}
    </td>
    <td>
        <a href="{{ route('portfolios.edit', [$portfolio]) }}">{{ __('Edit') }}</a>
    </td>
</tr>
