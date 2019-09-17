<a href="#" class="btn btn-primary app-js-delete-btn" data-delete-form-id="delete-form-{{ md5($deleteAction) }}">{{ __('Delete') }}</a>
<form id="delete-form-{{ md5($deleteAction) }}" action="{{ $deleteAction }}" method="POST" style="display: none;">
@method('DELETE')
@csrf
</form>
@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
