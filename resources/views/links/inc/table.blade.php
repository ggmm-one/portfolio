<table class="table">
    <thead>
        <tr>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Url') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @if ($links->isEmpty())
            @include('links.inc.no_item')
        @else
            @foreach ($links as $link)
                @include('links.inc.item')
            @endforeach
        @endif
    </tbody>
</table>
