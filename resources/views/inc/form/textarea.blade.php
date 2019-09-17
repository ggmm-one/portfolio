<div class="form-group form-row">
    <label for="{{ $control_id }}" class="col-sm-2 offset-sm-1 col-form-label">{{ __($control_label) }}</label>
    <div class="{{ isset($control_size) ? 'col-sm-4' : 'col-sm-8' }}">
        <textarea
            id="{{ $control_id }}"
            name="{{ $control_id }}"
            class="form-control @error($control_id) is-invalid @enderror"
            {{ (isset($disabled) && $disabled) ? 'disabled=disabled' : '' }}
            {{ $control_validation ?? '' }}>{{ $control_value }}</textarea>
        @error($control_id)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
