@extends('admin.template.master')

@section('title', 'Add Product')
@section('content')
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="{{ asset('admin-assets/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        {{-- <script src="{{ asset('admin-assets/assets/js/pages/ecommerce-product-create.init.js') }}"></script> --}}
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

        <!-- Include Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            hidePreloader();

            function showPreloader() {
                $('#preloader').css('opacity', '1');
                $('#preloader').css('visibility', 'visible');
            }

            function hidePreloader() {
                $('#preloader').css('opacity', '0');
                $('#preloader').css('visibility', 'hidden');

            }
        </script>
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div id="preloader" style="opacity: 1;  visibility: visible;">
                <div class="spinner-border text-primary" style="position: absolute;left: 50%;top: 50%;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Create Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Create Product</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (session('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show mb-3" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form autocomplete="off" action="{{ route('admin.sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Sale Name -->
                                <div class="mb-3">
                                    <label class="form-label" for="sale-name-input">
                                        Sale Name
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Enter a descriptive name for the sale."></i>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="sale-name-input" name="name" value="{{ old('name') }}"
                                        placeholder="Enter sale name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sale Description -->
                                <div class="mb-3">
                                    <label for="sale-description">
                                        Sale Description
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Provide details about the sale. This can include conditions or special notes."></i>
                                    </label>
                                    <div>
                                        <textarea name="description" id="sale-description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter sale description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Discount Type -->
                                <div class="mb-3">
                                    <label for="discount-type" class="form-label">
                                        Discount Type
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Choose whether the discount is a percentage or a fixed amount."></i>
                                    </label>
                                    <select name="discount_type" id="discount-type"
                                        class="form-control @error('discount_type') is-invalid @enderror" required>
                                        <option value="percentage"
                                            {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>
                                            Fixed Amount</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Discount Value -->
                                <div class="mb-3">
                                    <label class="form-label" for="discount-value-input">
                                        Discount Value
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Enter the discount amount. If 'Percentage' is selected, enter a number from 1 to 100. If 'Fixed Amount', enter the amount in currency."></i>
                                    </label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('discount_value') is-invalid @enderror"
                                        id="discount-value-input" name="discount_value" value="{{ old('discount_value') }}"
                                        placeholder="Enter discount value" required>
                                    @error('discount_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Applicable To -->
                                <div class="mb-3">
                                    <label for="applicable-to" class="form-label">
                                        Applicable To
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Specify if the sale applies sitewide, to specific categories, or individual products."></i>
                                    </label>
                                    <select name="applicable_to" id="applicable-to"
                                        class="form-control @error('applicable_to') is-invalid @enderror" required>
                                        <option value="sitewide"
                                            {{ old('applicable_to') == 'sitewide' ? 'selected' : '' }}>Sitewide</option>
                                        <option value="category"
                                            {{ old('applicable_to') == 'category' ? 'selected' : '' }}>Category</option>
                                        <option value="product" {{ old('applicable_to') == 'product' ? 'selected' : '' }}>
                                            Product</option>
                                    </select>
                                    @error('applicable_to')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category Selection (Shown if 'Category' is selected) -->
                                <div class="mb-3" id="category-selection" style="display:none;">
                                    <label for="categories" class="form-label">
                                        Select Categories
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Select the categories to which this sale applies."></i>
                                    </label>
                                    <select name="categories[]" id="categories" class="form-control select2" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Product Selection (Shown if 'Product' is selected) -->
                                <div class="mb-3" id="product-selection" style="display:none;">
                                    <label for="products" class="form-label">
                                        Select Products
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Select the products to which this sale applies."></i>
                                    </label>
                                    <select name="products[]" id="products" class="form-control select2" multiple>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @push('js')
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Initialize Select2
                                            $('.select2').select2({
                                                placeholder: "Select an option",
                                                allowClear: true
                                            });

                                            const applicableTo = document.getElementById('applicable-to');
                                            const categorySelection = document.getElementById('category-selection');
                                            const productSelection = document.getElementById('product-selection');

                                            function toggleSelection() {
                                                const value = applicableTo.value;

                                                categorySelection.style.display = value === 'category' ? 'block' : 'none';
                                                productSelection.style.display = value === 'product' ? 'block' : 'none';

                                                // Clear selection when not in use
                                                if (value !== 'category') {
                                                    $('#categories').val(null).trigger('change');
                                                }
                                                if (value !== 'product') {
                                                    $('#products').val(null).trigger('change');
                                                }
                                            }

                                            // Initialize the selection based on the current value
                                            toggleSelection();

                                            // Listen for changes
                                            applicableTo.addEventListener('change', toggleSelection);
                                        });
                                    </script>
                                @endpush

                                <!-- Start Date -->
                                <div class="mb-3">
                                    <label class="form-label" for="start-date-input">
                                        Start Date
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Set the start date and time for the sale."></i>
                                    </label>
                                    <input type="text" id="start-date-input"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        placeholder="Enter start date" value="{{ old('start_date') }}"
                                        data-provider="flatpickr" data-date-format="d.m.y" data-enable-time required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div class="mb-3">
                                    <label class="form-label" for="end-date-input">
                                        End Date
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Set the end date and time for the sale. Ensure it is after the start date."></i>
                                    </label>
                                    <input type="text" id="end-date-input"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        placeholder="Enter end date" value="{{ old('end_date') }}"
                                        data-provider="flatpickr" data-date-format="d.m.y" data-enable-time required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status-sale" class="form-label">
                                        Status
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Set the status of the sale. Active means it is currently running or will run when the start date is reached."></i>
                                    </label>
                                    <select name="status" id="status-sale"
                                        class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Is Visible -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox"
                                        class="form-check-input @error('is_visible') is-invalid @enderror" id="is_visible"
                                        name="is_visible" value="1" {{ old('is_visible') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_visible">
                                        Visible Before Start
                                        <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Check this box if you want the sale to be visible to customers before it starts."></i>
                                    </label>
                                    @error('is_visible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <!-- end card -->
                        <div class="text-end mb-3">
                            <!-- Submit Button -->
                            <button type="submit" name="submit-btn" value="true"
                                class="btn btn-success w-sm">Submit</button>

                            <!-- Go Back Button -->
                            <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary w-sm">Go Back</a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </form>


        </div>
        <!-- container-fluid -->
    </div>
@endsection
