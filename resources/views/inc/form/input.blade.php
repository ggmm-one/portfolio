<div class="form-group form-row">
    <label for="{{ $control_id }}" class="col-sm-2 offset-sm-1 col-form-label">{{ __($control_label) }}</label>
    <div class="
            @if ($input_type === 'date' || $input_type === 'month') {{ 'col-sm-2' }}
            @elseif (isset($control_size) && $control_size === 'm') {{ 'col-sm-4' }}
            @else {{ 'col-sm-8' }}
            @endif ">
        <input
            type="{{ $input_type }}"
            id="{{ $control_id }}"
            name="{{ $control_id }}"
            value="{{ $control_value }}"
            class="form-control @error($control_id) is-invalid @enderror"
            {{ (isset($disabled) && $disabled) ? 'disabled=disabled' : '' }}
            {{ $control_validation ?? '' }}
            @if ($input_type === 'date' || $input_type === 'month')
                {{ 'min='.\App\Model::DD_DATE_MIN.' max='.\App\Model::DD_DATE_MAX.' ' }}
            @endif >
        @error($control_id)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
