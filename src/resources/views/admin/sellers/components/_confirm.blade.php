<div class="modal fade" id="deleteModal{{ $seller['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $seller['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $seller['id'] }}">{{ __('Deleting seller') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                {{ __('Are you sure to delete this seller?') }}
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.sellers.destroy', ['seller' => $seller['id']]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red">{{ __('Delete') }}</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
