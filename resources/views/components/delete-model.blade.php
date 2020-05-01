@if ($model->exists && auth()->user()->can('delete', $model))
<a id="delete-btn-{{ $formId }}" href="#" {{ $attributes }}>{{ __('Delete') }}</a>
<form id="delete-form-{{ $formId }}" action="{{ $url }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>
<script>
    var btn = document.getElementById('delete-btn-{{ $formId }}');
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete?')) {
            document.getElementById('delete-form-{{ $formId }}').submit();
        }
    }, false);

</script>
@endif
