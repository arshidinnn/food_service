<form class="card shadow-sm p-4 form-container custom-product-card" method="POST"
      action="{{ route($action, $method == 'PUT' ? ['food' => $food['id']] : []) }}" enctype="multipart/form-data">
    @csrf
    @method($method)
    <h5 class="form-section-title">{{ __('Main') }}</h5>

    <div class="mb-3">
        <label for="title" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-input" id="title" name="title"
               value="{{ $food['title'] ?? old('title') }}" placeholder="{{ __('Enter title') }}">
        @error('title')
        <div class="form-warning"> {{ $message }} </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
        <textarea class="form-control form-textarea" id="description" name="description"
                  placeholder="{{ __('Enter description') }}" rows="3">{{ $food['description'] ?? old('description') }}</textarea>
        @error('description')
        <div class="form-warning"> {{ $message }} </div>
        @enderror
    </div>

    <div class="mb-3 row form-row">
        <div class="col-md-6 form-col">
            <label for="price" class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" id="price" name="price"
                   value="{{ $food['price'] ?? old('price') }}" placeholder="{{ __('Enter price') }}">
            @error('price')
            <div class="form-warning"> {{ $message }} </div>
            @enderror
        </div>
        <div class="col-md-6 form-col">
            <label for="category" class="form-label">{{ __('Category') }} <span class="text-danger">*</span></label>
            <select class="form-control form-select" id="category" name="category">
                <option value="" disabled selected>{{ __('Select category') }}</option>
                @foreach(\App\Models\Category::getCategoriesBySeller() as $category)
                    <option value="{{ $category['id'] }}"
                        {{ (isset($food['category_id']) && $food['category_id'] == $category['id']) || old('category') == $category['id'] ? 'selected' : '' }}>
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
            @error('category')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row form-row">
        <div class="col-md-6 form-col">
            <label for="quantity" class="form-label">{{ __('Quantity') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" id="quantity" name="quantity"
                   value="{{ $food['quantity'] ?? old('quantity') }}" placeholder="Enter quantity">
            @error('quantity')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 form-col">
            <label for="unit" class="form-label">{{ __('Unit') }} <span class="text-danger">*</span></label>
            <select class="form-control form-select" id="unit" name="unit">
                <option value="" disabled selected>{{ __('Select unit') }}</option>
                @foreach(\App\Enums\UnitType::getValues() as $unit)
                    <option value="{{ $unit }}"
                        {{ (isset($food['unit']) && $food['unit']->value == $unit) || old('unit') == $unit ? 'selected' : '' }}>
                        {{ $unit }}
                    </option>
                @endforeach
            </select>
            @error('unit')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">{{ __('Image') }}</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @error('image')
        <div class="form-warning">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between custom-buttons">
        <button type="submit" class="btn btn-success bg-green">{{ __('Save') }}</button>
        <a href="{{ route('admin.foods.index') }}" class="btn btn-outline-primary">{{ __('Back to foods') }}</a>
    </div>
</form>
