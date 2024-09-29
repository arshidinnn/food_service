<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control form-input mb-1" id="name" name="name_create"
               placeholder="{{ __('Enter new category') }}" style="background-color: white;" required maxlength="60">
        @error('name_create')
            <div class="form-warning">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between custom-buttons">
        <button type="submit" class="btn btn-success bg-green">{{ __('Add category') }}</button>
    </div>
</form>
