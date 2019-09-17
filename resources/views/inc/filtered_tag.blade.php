@if (Request::isFiltered())
    <span class="app-filtered-tag">
        ({{ __('Filtered') }})
    <span>
@endif
