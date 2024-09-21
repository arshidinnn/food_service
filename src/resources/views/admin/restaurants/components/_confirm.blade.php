<div class="modal fade" id="deleteModal{{ $restaurant['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $restaurant['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $restaurant['id'] }}">{{ __('Deleting restaurant') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                {{ __('Are you sure to delete this restaurant?') }}
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant['id']]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red">{{ __('Delete') }}</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
