@foreach (['danger', 'warning', 'success', 'info'] as $level)
    @if(Session::has('flash-' . $level))
        <div class="alert alert-{{ $level }}" role="alert">{{ __(Session::get('flash-' . $level)) }}</div>
    @endif
@endforeach

@if ($errors->has('check_before_deleting'))
    <div class="alert alert-warning" role="alert">{{ __(Arr::first($errors->get('check_before_deleting'))) }}</div>
@elseif ($errors->any())
    <div class="alert alert-warning" role="alert">{{ __('Please fix the error(s) and try again') }}</div>
@endif
