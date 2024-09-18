<form method="POST" action="{{ route($action, $method == 'PUT' ? ['seller' => $seller['id']] : []) }}" class="card shadow-sm p-4 form-container custom-product-card">
    @csrf
    @method($method)
    <h5 class="form-section-title">{{ __('Main') }}</h5>
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-input" value="{{ $seller['name'] ?? old('name') }}"
               id="name" name="name" placeholder="{{ __('Enter name') }}">
    </div>

    <div class="mb-3 row form-row">
        <div class="col-md-6 form-col">
            <label for="bin" class="form-label">{{ __('BIN') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" value="{{ $seller['bin'] ?? old('bin') }}"
                   id="bin" name="bin" placeholder="{{ __('Enter BIN') }}">
        </div>
        <div class="col-md-6 form-col">
            <label for="reg_number" class="form-label">{{ __('Registration Number') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" value="{{ $seller['reg_number'] ?? old('reg_number') }}"
                   id="reg_number" name="reg_number" placeholder="{{ __('Enter registration number') }}">
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('User\'s Email') }} <span class="text-danger">*</span></label>
        <input type="email" class="form-control form-input" value="{{ $seller['email'] ?? old('email') }}"
               id="email" name="email" placeholder="{{ __('Enter email') }}"
               @if($method == 'PUT') readonly @endif>
    </div>

    <div class="d-flex justify-content-between custom-buttons">
        <button type="submit" class="btn btn-success bg-green">{{ __('Save') }}</button>
        <a href="{{ route('admin.sellers.index') }}" type="button" class="btn btn-outline-primary">{{ __('Back to sellers') }}</a>
    </div>
</form>
