@foreach ($options as $k => $v)
<option value="{{ $k }}" @if(isset($selected) && $k==$selected) selected=selected @endif>{{ __($v) }}</option>
@endforeach
