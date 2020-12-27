<fieldset {{ $attributes->merge(['class' => 'form-group']) }}>
    <legend class="bg-light">{{ $legend }}</legend>
    {{ $slot }}
</fieldset>
