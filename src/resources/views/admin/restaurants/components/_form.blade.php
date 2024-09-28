<form class="card shadow-sm p-4 form-container custom-product-card" method="POST"
      action="{{ route($action, $method == 'PUT' ? ['restaurant' => $restaurant['id']] : []) }}" enctype="multipart/form-data">
    @csrf
    @method($method)
    <h5 class="form-section-title">{{ __('Main') }}</h5>

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-input" id="name" name="name"
               value="{{ $restaurant['name'] ?? old('name') }}" placeholder="{{ __('Enter name') }}">
        @error('name')
            <div class="form-warning"> {{ $message }} </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
        <textarea class="form-control form-textarea" id="description" name="description"
                  placeholder="{{ __('Enter description') }}" rows="3">{{ $restaurant['description'] ?? old('description') }}</textarea>
        @error('description')
            <div class="form-warning"> {{ $message }} </div>
        @enderror
    </div>

    @if ($method == 'POST')
        @can('anyActions', \App\Models\Seller::class)
            <div class="mb-3">
                <label for="seller" class="form-label">{{ __('Seller') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-input" id="seller" name="seller"
                       value="{{ $restaurant['seller'] ?? old('seller') }}" placeholder="{{ __('Enter seller') }}">
                @error('seller')
                <div class="form-warning"> {{ $message }} </div>
                @enderror
            </div>
        @endcan
    @endif
    <div class="mb-3">
        <label for="image" class="form-label">{{ __('Image') }}</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @error('image')
            <div class="form-warning">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between custom-buttons">
        <button type="submit" class="btn btn-success bg-green">{{ __('Save') }}</button>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-primary">{{ __('Back to restaurants') }}</a>
    </div>
</form>
