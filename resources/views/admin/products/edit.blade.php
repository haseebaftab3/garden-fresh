@extends('admin.template.master')

@section('title', 'Edit Product')
@section('content')

    @push('js')
        <script src="{{ asset('admin-assets/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        {{-- <script src="{{ asset('admin-assets/assets/js/pages/ecommerce-product-create.init.js') }}"></script> --}}
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

        <script>
            ClassicEditor.create(document.querySelector("#product-description"))
                .then(function(e) {
                    e.ui.view.editable.element.style.height = "200px";
                })
                .catch(function(e) {
                    console.error(e);
                });
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
            <form autocomplete="off" action="{{ route('admin.products.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Product Title</label>
                                    <input type="text" class="form-control @error('product_title') is-invalid @enderror"
                                        id="product-title-input" name="product_title"
                                        value="{{ old('product_title', $product->title ?? '') }}"
                                        placeholder="Enter product title" required>

                                    @error('product_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="product-description">Product Description</label>
                                    <div>
                                        <textarea name="product_description" id="product-description"
                                            class="form-control @error('product_description') is-invalid @enderror" placeholder="Enter product description">{{ old('product_description', $product->description ?? '') }}</textarea>
                                    </div>
                                    @error('product_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Gallery</h5>
                            </div>
                            <div class="card-body">
                                <!-- Product Image Upload -->
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-1">Product Image</h5>
                                    <p class="text-muted">Add Product main Image.</p>
                                    <div class="text-start">
                                        <div>
                                            <input class="form-control" type="file" id="product-image-input"
                                                accept="image/png, image/gif, image/webp, image/svg, image/jpeg"
                                                onchange="previewImage(event)" name="product_image">
                                        </div>
                                        @error('product_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (!empty($product->cover_image))
                                            <div class="mt-3">
                                                <img id="product-img-preview"
                                                    src="{{ asset('storage/' . $product->cover_image) }}"
                                                    class=" img-fluid img-thumbnail" alt="Product Image"
                                                    style="max-width: 200px;" />
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <!-- Image Preview Script -->
                                <script>
                                    function previewImage(event) {
                                        var reader = new FileReader();
                                        reader.onload = function() {
                                            var output = document.getElementById('product-img-preview');
                                            output.src = reader.result;
                                            // $("#product-img-preview").removeClass("d-none");
                                        };
                                        reader.readAsDataURL(event.target.files[0]);
                                    }
                                </script>

                                <!-- Product Gallery Upload -->
                                <div>
                                    <h5 class="fs-14 mb-1">Product Gallery</h5>
                                    <p class="text-muted">Add Product Gallery Images.</p>

                                    <input class="form-control" type="file" id="product-image-gallery"
                                        accept="image/png, image/gif, image/webp, image/svg, image/jpeg" name="gallery[]"
                                        multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="row mt-3" id="image-gallery-list">
                                        <!-- Display Existing Images -->
                                        @if ($product->gallery->isNotEmpty())
                                            @foreach ($product->gallery as $k => $image)
                                                <div class="col-md-3 col-sm-6 mb-4">
                                                    <div class="card h-100">
                                                        <div class="card-img-top position-relative"
                                                            style="overflow: hidden;">
                                                            <img src="{{ asset('storage/' . $image->image_url) }}"
                                                                class="img-fluid" alt="Gallery Image"
                                                                style="object-fit: cover; width: 100%; height: 150px;">
                                                            <button type="button"
                                                                class="btn-close position-absolute top-0 end-0 m-2"
                                                                aria-label="Close"
                                                                onclick="removeImage('{{ $image->id }}', this)"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Remove Image"
                                                                style="background-color: rgba(255, 255, 255, 0.7); border-radius: 50%;"></button>

                                                        </div>
                                                        <div class="card-body text-center p-2">
                                                            <p class="card-text">Image #: {{ ++$k }}</p>
                                                            <input type="hidden" name="existing_gallery[]"
                                                                value="{{ $image->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


                                    <!-- Add New Gallery Images -->
                                    <ul class="list-group mt-3" id="new-image-gallery-list"></ul>
                                    @push('js')
                                        <script>
                                            document.getElementById('product-image-gallery').addEventListener('change', function(event) {
                                                const fileList = event.target.files;
                                                const list = document.getElementById('new-image-gallery-list');

                                                // Clear the current list
                                                list.innerHTML = '';

                                                // Loop through the selected files and display their previews and controls
                                                for (let i = 0; i < fileList.length; i++) {
                                                    const file = fileList[i];

                                                    // Create a new li element for each file
                                                    const fileDiv = document.createElement('li');
                                                    fileDiv.className = 'list-group-item position-relative d-flex align-items-center mb-2';

                                                    // Create an image element for preview
                                                    const img = document.createElement('img');
                                                    img.src = URL.createObjectURL(file);
                                                    img.className = 'img-thumbnail me-3';
                                                    img.style.width = '80px';
                                                    img.style.height = '80px';
                                                    img.alt = file.name;

                                                    // Create a span to display the file name
                                                    const fileName = document.createElement('span');
                                                    fileName.textContent = file.name;
                                                    fileName.className = 'me-auto';


                                                    // Append the elements to the fileDiv
                                                    fileDiv.appendChild(img);
                                                    fileDiv.appendChild(fileName);
                                                    // fileDiv.appendChild(deleteButton);

                                                    // Append the fileDiv to the list
                                                    list.appendChild(fileDiv);
                                                }
                                            });


                                            function removeImage(imageId, element) {
                                                showPreloader();
                                                if (confirm('Are you sure you want to delete this image?')) {
                                                    $.ajax({
                                                        url: '{{ route('products.gallery.delete', '') }}/' + imageId,
                                                        type: 'DELETE',
                                                        data: {
                                                            "_token": "{{ csrf_token() }}",
                                                        },
                                                        success: function(response) {
                                                            if (response.success) {
                                                                // Remove the image element from the DOM
                                                                $(element).closest('.card').remove();
                                                                alert(response.message);
                                                            } else {
                                                                alert('An error occurred while trying to delete the image.');
                                                            }
                                                        },
                                                        complete: function() {
                                                            hidePreloader(); // Hide preloader when AJAX request completes
                                                        },
                                                        error: function(xhr) {
                                                            alert('An error occurred: ' + xhr.responseText);
                                                        }
                                                    });
                                                }
                                            }
                                        </script>
                                    @endpush
                                </div>
                            </div>
                        </div>

                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab">
                                            General Info
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata"
                                            role="tab">
                                            Meta Data
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <!-- Manufacturer Name -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="manufacturer-name-input">Manufacturer
                                                        Name</label>
                                                    <input type="text"
                                                        class="form-control @error('manufacturer_name') is-invalid @enderror"
                                                        id="manufacturer-name-input" name="manufacturer_name"
                                                        placeholder="Enter manufacturer name"
                                                        value="{{ old('manufacturer_name', $product->manufacturer_name) }}"
                                                        required>
                                                    @error('manufacturer_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Manufacturer Brand -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="manufacturer-brand-input">Manufacturer
                                                        Brand</label>
                                                    <input type="text"
                                                        class="form-control @error('manufacturer_brand') is-invalid @enderror"
                                                        id="manufacturer-brand-input" name="manufacturer_brand"
                                                        placeholder="Enter manufacturer brand"
                                                        value="{{ old('manufacturer_brand', $product->manufacturer_brand) }}">
                                                    @error('manufacturer_brand')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <!-- Stocks -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="stocks-input">Stocks</label>
                                                    <input type="number"
                                                        class="form-control @error('stocks') is-invalid @enderror"
                                                        id="stocks-input" name="stocks" placeholder="Stocks" required
                                                        value="{{ old('stocks', $product->stock->quantity) }}"
                                                        min="0">
                                                    @error('stocks')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Price -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-price-input">Price</label>
                                                    <div class="input-group has-validation mb-3">
                                                        <span class="input-group-text" id="product-price-addon">Rs</span>
                                                        <input type="number"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="product-price-input" name="price"
                                                            placeholder="Enter price" aria-label="Price"
                                                            aria-describedby="product-price-addon" required
                                                            value="{{ old('price', $product->price) }}" step="1"
                                                            min="1">
                                                        @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Discount -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="product-discount-input">Discount</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"
                                                            id="product-discount-addon">%</span>
                                                        <input type="number"
                                                            class="form-control @error('discount') is-invalid @enderror"
                                                            id="product-discount-input" name="discount"
                                                            placeholder="Enter discount" aria-label="discount"
                                                            aria-describedby="product-discount-addon"
                                                            value="{{ old('discount', $product->discount) }}"
                                                            step="0.01" min="0" max="100">
                                                        @error('discount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Orders -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="orders-input">Orders</label>
                                                    <input type="number"
                                                        class="form-control @error('orders') is-invalid @enderror"
                                                        id="orders-input" name="orders" placeholder="Orders"
                                                        value="{{ old('orders', $product->orders) }}" min="0">
                                                    @error('orders')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <!-- Additional Fields -->
                                        <div class="row">
                                            <!-- SKU -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="sku-input">
                                                        SKU (Stock Keeping
                                                        Unit)
                                                        <i class="ri-information-line" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            aria-label="If not provided, a unique SKU will be generated automatically."
                                                            data-bs-original-title="If not provided, a unique SKU will be generated automatically."></i>

                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('sku') is-invalid @enderror"
                                                        id="sku-input" name="sku" placeholder="Enter SKU"
                                                        value="{{ old('sku', $product->sku) }}">
                                                    @error('sku')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Weight -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="weight-input">Weight (in kg)</label>
                                                    <input type="number"
                                                        class="form-control @error('weight') is-invalid @enderror"
                                                        id="weight-input" name="weight" placeholder="Enter weight"
                                                        value="{{ old('weight', $product->weight) }}" step="0.01"
                                                        min="0">
                                                    @error('weight')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <!-- Return Policy -->
                                        <div class="mb-3">
                                            <label class="form-label">Return Policy</label>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input @error('return_policy') is-invalid @enderror"
                                                    type="radio" id="return-policy-yes" name="return_policy"
                                                    value="1"
                                                    {{ old('return_policy', $product->return_policy) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="return-policy-yes">Returnable</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input @error('return_policy') is-invalid @enderror"
                                                    type="radio" id="return-policy-no" name="return_policy"
                                                    value="0"
                                                    {{ old('return_policy', $product->return_policy) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="return-policy-no">Not
                                                    Returnable</label>
                                            </div>
                                            @error('return_policy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Optional Return Period -->
                                        <div class="mb-3" id="return-period-container"
                                            style="{{ old('return_policy', $product->return_policy) == '1' ? '' : 'display: none;' }}">
                                            <label class="form-label" for="return-period-input">Return Period (in
                                                days)</label>
                                            <input type="number"
                                                class="form-control @error('return_period') is-invalid @enderror"
                                                id="return-period-input" name="return_period"
                                                placeholder="Enter return period"
                                                value="{{ old('return_period', $product->return_period) }}"
                                                min="0">
                                            @error('return_period')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->

                                    <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="meta-title-input">Meta Title</label>
                                                    <input type="text"
                                                        class="form-control @error('meta_title') is-invalid @enderror"
                                                        id="meta-title-input" name="meta_title"
                                                        placeholder="Enter meta title"
                                                        value="{{ old('meta_title', $product->metaData->meta_title ?? '') }}">
                                                    @error('meta_title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="meta-keywords-input">Meta
                                                        Keywords</label>
                                                    <input type="text"
                                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                                        id="meta-keywords-input" name="meta_keywords"
                                                        placeholder="Enter meta keywords"
                                                        value="{{ old('meta_keywords', $product->metaData->meta_keywords ?? '') }}">
                                                    @error('meta_keywords')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div>
                                            <label class="form-label" for="meta-description-input">Meta
                                                Description</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta-description-input"
                                                name="meta_description" placeholder="Enter meta description" rows="3">{{ old('meta_description', $product->metaData->meta_description ?? '') }}</textarea>
                                            @error('meta_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->
                                </div>
                                <!-- end tab-content -->
                            </div>
                            <!-- end card body -->
                        </div>

                        <!-- end card -->


                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Variations</h4>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="product-variations" role="tabpanel">
                                            <div id="variations-container">
                                                <!-- Render the first variation row -->
                                                <div class="row mb-3 variation-row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="variation-type-0">
                                                                <i class="fas fa-tags variation-icon"></i> Variation Type
                                                            </label>
                                                            <select name="variations[0][variation_type]"
                                                                class="form-select @error('variations.0.variation_type') is-invalid @enderror"
                                                                id="variation-type-0" required>
                                                                <option value="">Select Type</option>
                                                                <option value="color"
                                                                    {{ old('variations.0.variation_type', $product->variations[0]->variation_type ?? '') == 'color' ? 'selected' : '' }}>
                                                                    Color</option>
                                                                <option value="size"
                                                                    {{ old('variations.0.variation_type', $product->variations[0]->variation_type ?? '') == 'size' ? 'selected' : '' }}>
                                                                    Size</option>
                                                                <option value="fragrance"
                                                                    {{ old('variations.0.variation_type', $product->variations[0]->variation_type ?? '') == 'fragrance' ? 'selected' : '' }}>
                                                                    Fragrance</option>
                                                                <option value="weight"
                                                                    {{ old('variations.0.variation_type', $product->variations[0]->variation_type ?? '') == 'weight' ? 'selected' : '' }}>
                                                                    Weight (in KG)</option>
                                                                <option value="flavour"
                                                                    {{ old('variations.0.variation_type', $product->variations[0]->variation_type ?? '') == 'flavour' ? 'selected' : '' }}>
                                                                    Flavour </option>
                                                            </select>
                                                            @error('variations.0.variation_type')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="variation-value-0">
                                                                <i class="fas fa-pencil-alt variation-icon"></i> Variation
                                                                Value
                                                            </label>
                                                            <input type="text" name="variations[0][variation_value]"
                                                                class="form-control @error('variations.0.variation_value') is-invalid @enderror"
                                                                id="variation-value-0" placeholder="Enter value"
                                                                value="{{ old('variations.0.variation_value', $product->variations[0]->variation_value ?? '') }}"
                                                                required>
                                                            @error('variations.0.variation_value')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="extra-price-0">
                                                                <i class="fas fa-dollar-sign variation-icon"></i> Extra
                                                                Price
                                                                <i class="ri-information-line" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Enter the additional cost for this variation. If there's no extra cost, you can leave it as 0."></i>

                                                            </label>
                                                            <input type="number" name="variations[0][extra_price]"
                                                                class="form-control @error('variations.0.extra_price') is-invalid @enderror"
                                                                id="extra-price-0" placeholder="Enter extra price"
                                                                step="1" min="0"
                                                                value="{{ old('variations.0.extra_price', $product->variations[0]->variation_price ?? '') }}">
                                                            @error('variations.0.extra_price')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <small class="form-text text-muted">
                                                                Leave empty or set to 0 if there's no additional cost for
                                                                this variation.
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="variation-stock-0">
                                                                <i class="fas fa-boxes variation-icon"></i> Separate Stock
                                                                <i class="ri-information-line" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Leave empty to deduct stock from the original quantity. Enter a value to set a separate stock for this variation."></i>
                                                            </label>
                                                            <input type="number" name="variations[0][stock]"
                                                                class="form-control @error('variations.0.stock') is-invalid @enderror"
                                                                id="variation-stock-0" placeholder="Enter stock"
                                                                min="0"
                                                                value="{{ old('variations.0.stock', $product->variations[0]->variation_stock ?? '') }}">
                                                            @error('variations.0.stock')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <small class="form-text text-muted">
                                                                Leave empty to deduct stock from the original quantity.
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="add-variation-btn" class="btn btn-primary mb-3">
                                                <i class="fas fa-plus"></i> Add Variation
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @push('js')
                            <script>
                                $(window).on('load', function() {
                                    // Set initial index based on the number of existing variations, or start at 1 if none exist
                                    let variationIndex =
                                        {{ count(old('variations', $product->variations->toArray())) > 1 ? count(old('variations', $product->variations->toArray())) : 1 }};

                                    // Add old or existing variations beyond the first one if they exist
                                    @if (old('variations') || $product->variations->count() > 1)
                                        @foreach (old('variations', $product->variations) as $index => $variation)
                                            @if ($index > 0) // Skip the first iteration as it is static
                                                addVariationRow(
                                                    '{{ old("variations.$index.variation_type", $variation->variation_type ?? '') }}',
                                                    '{{ old("variations.$index.variation_value", $variation->variation_value ?? '') }}',
                                                    '{{ old("variations.$index.variation_price", $variation->variation_price ?? '') }}',
                                                    '{{ old("variations.$index.stock", $variation->variation_stock ?? '') }}'
                                                );
                                            @endif
                                        @endforeach
                                    @endif

                                    // Function to add a variation row
                                    function addVariationRow(variationType = '', variationValue = '', extraPrice = '', stock = '') {
                                        const newVariationRow = `
                                    <div class="row mb-3 variation-row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="variation-type-${variationIndex}">
                                                    <i class="fas fa-tags variation-icon"></i> Variation Type
                                                </label>
                                                <select name="variations[${variationIndex}][variation_type]" class="form-select" id="variation-type-${variationIndex}" required>
                                                    <option value="">Select Type</option>
                                                    <option value="color" ${variationType === 'color' ? 'selected' : ''}>Color</option>
                                                    <option value="size" ${variationType === 'size' ? 'selected' : ''}>Size</option>
                                                    <option value="fragrance" ${variationType === 'fragrance' ? 'selected' : ''}>Fragrance</option>
                                                    <option value="weight" ${variationType === 'weight' ? 'selected' : ''}>Weight (in KG)</option>
                                                    <option value="flavour" ${variationType === 'flavour' ? 'selected' : ''}>Flavour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="variation-value-${variationIndex}">
                                                    <i class="fas fa-pencil-alt variation-icon"></i> Variation Value
                                                </label>
                                                <input type="text" name="variations[${variationIndex}][variation_value]" class="form-control" id="variation-value-${variationIndex}" placeholder="Enter value" value="${variationValue}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="extra-price-${variationIndex}">
                                                    <i class="fas fa-dollar-sign variation-icon"></i> Extra Price
                                                </label>
                                                 <i class="ri-information-line" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Enter the additional cost for this variation. If there's no extra cost, you can leave it as 0."></i>

                                                <input type="number" name="variations[${variationIndex}][extra_price]" class="form-control" id="extra-price-${variationIndex}" placeholder="Enter extra price" step="1" min="0" value="${extraPrice}">
                                            </div>
                                             <small class="form-text text-muted">
                                                        Leave empty or set to 0 if there's no additional cost for this variation.
                                                    </small>
                                        </div>
                                        <div class="col-lg-5 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="variation-stock-${variationIndex}">
                                                    <i class="fas fa-boxes variation-icon"></i> Separate Stock
                                                    <i class="ri-information-line" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Leave empty to deduct stock from the original quantity. Enter a value to set a separate stock for this variation."></i>
                                                </label>
                                                <input type="number" name="variations[${variationIndex}][stock]" class="form-control" id="variation-stock-${variationIndex}" placeholder="Enter stock" min="0" value="${stock}">
                                                <small class="form-text text-muted">
                                                    Leave empty to deduct stock from the original quantity.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-12 d-flex align-items-center mt-3">
                                            <button type="button" class="btn btn-danger remove-variation-btn">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>`;
                                        $('#variations-container').append(newVariationRow);
                                        variationIndex++;
                                    }

                                    // Handle adding new variation rows on button click
                                    $('#add-variation-btn').on('click', function() {
                                        addVariationRow();
                                    });

                                    // Handle removing variation rows
                                    $(document).on('click', '.remove-variation-btn', function() {
                                        $(this).closest('.variation-row').remove();
                                    });
                                });
                            </script>
                        @endpush





                        @push('css')
                            <style>
                                .remove-variation-btn {
                                    font-size: 0.9rem;
                                }

                                .variation-icon {
                                    font-size: 1.2rem;
                                }

                                .form-control,
                                .form-select {
                                    border-radius: 0.375rem;
                                }

                                .card-header {
                                    background-color: #f8f9fa;
                                    border-bottom: 1px solid #dee2e6;
                                }

                                .btn-primary {
                                    margin-top: 1rem;
                                }

                                .btn-danger {
                                    margin-left: 0.5rem;
                                }

                                .invalid-feedback {
                                    display: unset;
                                }
                            </style>
                        @endpush
                        <div class="text-end mb-3">
                            <!-- Submit Button -->
                            <button type="submit" name="submit-btn" class="btn btn-warning w-sm">Update</button>

                            <!-- Go Back Button -->
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger w-sm">Go Back</a>
                        </div>

                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Status</label>
                                    <select class="form-select" id="choices-publish-status-input" name="publish_status">
                                        <option value="Published"
                                            {{ old('publish_status', $product->status ?? '') == 'Published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="Scheduled"
                                            {{ old('publish_status', $product->status ?? '') == 'Scheduled' ? 'selected' : '' }}>
                                            Scheduled</option>
                                        <option value="Draft"
                                            {{ old('publish_status', $product->status ?? '') == 'Draft' ? 'selected' : '' }}>
                                            Draft
                                        </option>
                                    </select>
                                    @error('publish_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                                    <select class="form-select" id="choices-publish-visibility-input" name="visibility">
                                        <option value="Public"
                                            {{ old('visibility', $product->visibility ?? '') == 'Public' ? 'selected' : '' }}>
                                            Public
                                        </option>
                                        <option value="Hidden"
                                            {{ old('visibility', $product->visibility ?? '') == 'Hidden' ? 'selected' : '' }}>
                                            Hidden
                                        </option>
                                    </select>
                                    @error('visibility')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card" id="publish-schedule-card" style="display: none;">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publish Schedule</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <label for="datepicker-publish-input" class="form-label">Publish Date & Time</label>
                                    <input type="text" id="datepicker-publish-input" class="form-control"
                                        name="publish_date" placeholder="Enter publish date"
                                        value="{{ old('publish_date', $product->publish_date ?? '') }}"
                                        data-provider="flatpickr" data-date-format="d.m.y" data-enable-time>
                                    @error('publish_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        @push('js')
                            <script>
                                $(document).ready(function() {
                                    function togglePublishDate() {
                                        if ($('#choices-publish-status-input').val() === 'Scheduled') {
                                            $('#publish-schedule-card').show();
                                        } else {
                                            $('#publish-schedule-card').hide();
                                        }
                                    }

                                    togglePublishDate(); // Run on page load

                                    $('#choices-publish-status-input').on('change', function() {
                                        togglePublishDate();
                                    });
                                });
                            </script>
                        @endpush


                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Categories</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="parent-category" class="form-label">Select Parent Category
                                        (optional)</label>
                                    <select class="form-select" id="parent-category" name="parent_category">
                                        <option value="" disabled>Select parent category (optional)</option>
                                        @foreach ($categories->where('parent_id', null) as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('parent_category', $product->category->parent_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3" id="child-categories"
                                    style="{{ old('parent_category', $product->category->parent_id ?? '') ? '' : 'display: none;' }}">
                                    <label for="child-category" class="form-label">Select Child Category</label>
                                    <select class="form-select" id="child-category" name="child_category">
                                        <!-- Child categories will be loaded here via AJAX -->
                                        @if ($product->category && $product->category->parent_id)
                                            <option value="{{ $product->category->id }}" selected>
                                                {{ $product->category->name }}</option>
                                        @endif
                                    </select>
                                    @error('child_category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @push('js')
                                    <script>
                                        $(document).ready(function() {
                                            var initialParentId = '{{ old('parent_category', $product->category->parent_id ?? '') }}';

                                            if (initialParentId) {
                                                loadChildCategories(initialParentId, '{{ $product->category->id ?? '' }}');
                                            }

                                            $('#parent-category').change(function() {
                                                var parentId = $(this).val();
                                                if (parentId) {
                                                    loadChildCategories(parentId);
                                                } else {
                                                    $('#child-categories').hide();
                                                    $('#child-category').empty().append('<option value="">Select child category</option>');
                                                }
                                            });

                                            function loadChildCategories(parentId, selectedChildId = null) {
                                                showPreloader();
                                                $.ajax({
                                                    url: '/admin/get-child-categories/' + parentId,
                                                    method: 'GET',
                                                    success: function(data) {
                                                        var $childCategorySelect = $('#child-category');
                                                        $childCategorySelect.empty();
                                                        $childCategorySelect.append(
                                                            '<option value="" disabled selected>Select child category</option>');
                                                        $.each(data, function(index, category) {
                                                            $childCategorySelect.append('<option value="' + category.id + '"' +
                                                                (selectedChildId == category.id ? ' selected' : '') + '>' +
                                                                category.name + '</option>');
                                                        });
                                                        $('#child-categories').show();
                                                    },
                                                    complete: function() {
                                                        hidePreloader(); // Hide preloader when AJAX request completes
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                @endpush
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <input class="form-control" name="tags" id="tags-input"
                                            placeholder="use comma to add tag" type="text"
                                            value="{{ json_encode($tags) }}" />
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>

                        @push('js')
                            <!-- Tagify CSS -->
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.7.0/tagify.css">

                            <!-- Tagify JS -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.7.0/tagify.min.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Select the input element
                                    var input = document.getElementById('tags-input');

                                    // Initialize Tagify
                                    var tagify = new Tagify(input);

                                    // Get existing tags from Laravel's old() helper
                                    var existingTags = @json(old('tags', ''));

                                    // Check if existingTags is a JSON string (e.g., [{"value":"sa"}])
                                    try {
                                        var parsedTags = JSON.parse(existingTags);

                                        if (Array.isArray(parsedTags)) {
                                            // Add tags assuming it's an array of objects
                                            tagify.addTags(parsedTags.map(tag => tag.value));
                                        } else {
                                            // If it's just a string of tags, split by commas
                                            tagify.addTags(existingTags.split(',').map(tag => tag.trim()).filter(tag => tag));
                                        }
                                    } catch (e) {
                                        // If JSON parsing fails, treat it as a simple comma-separated string
                                        if (existingTags.length > 0) {
                                            tagify.addTags(existingTags.split(',').map(tag => tag.trim()).filter(tag => tag));
                                        }
                                    }
                                });
                            </script>
                        @endpush


                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
