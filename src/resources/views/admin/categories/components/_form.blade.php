<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control form-input mb-1" id="name" name="name"
               placeholder="{{ __('Enter new category') }}" style="background-color: white;" required>
        @error('name')
        <div class="form-warning"> {{ $message }} </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between custom-buttons">
        <button type="submit" class="btn btn-success bg-green">{{ __('Add category') }}</button>
    </div>
</form>
