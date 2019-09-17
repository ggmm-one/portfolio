@foreach ($options as $key => $value)
    <option value="{{ $key }}" @if(isset($selected) && $key == $selected) selected=selected @endif>{{ __($value) }}</option>
@endforeach
