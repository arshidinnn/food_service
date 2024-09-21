<div class="modal fade" id="editModal{{ $category['id'] }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $category['id'] }}">{{ __('Edit category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.categories.update', ['category' => $category['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="categoryName{{ $category['id'] }}" class="form-label">{{ __('Category Name') }}</label>
                        <input type="text" class="form-control" id="categoryName{{ $category['id'] }}" name="name" value="{{ $category['name'] }}" required>
                        @error('name')
                        <div class="form-warning"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
