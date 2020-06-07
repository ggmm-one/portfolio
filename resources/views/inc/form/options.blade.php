@foreach ($options as $option)
<option value="{{ $option->hashid() }}" @if(isset($selected) && $option->hashid() == $selected) selected=selected @endif>{{ __($option->name ) }}</option>
@endforeach
