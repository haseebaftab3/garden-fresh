@extends('admin.template.master')

@section('title', 'Categories')
@push('css')
    <link href="{{ asset('admin-assets/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@push('js')
    <script>
        $(document).ready(function() {

            // Handle the master checkbox
            $('#checkAll').on('click', function() {
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle checkbox change event
            $('#example tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#checkAll').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });
        });
    </script>
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Categories</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="customerList">
                        <div class="card-header border-bottom-dashed">
                            <div class="row g-4 align-items-center justify-content-end">
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start  gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Add
                                            Categories
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div id="preloader" style="opacity: 1;  visibility: visible;">
                                <div class="spinner-border text-primary" style="position: absolute;left: 50%;top: 50%;"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success alert-border-left alert-dismissible fade show mb-3"
                                    role="alert">
                                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="categoryTable" class="table  table-bordered dt-responsive nowrap align-middle"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 50px">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll"
                                                        value="option" />
                                                </div>
                                            </th>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories->where('parent_id', null) as $index => $category)
                                            <!-- Main Category Row -->
                                            <tr data-id="{{ $category->id }}" data-parent-id=""
                                                class="bg-light  parent-category">
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15 chk_child" type="checkbox"
                                                            name="chk_child[]" value="{{ $category->id }}" />
                                                    </div>
                                                </th>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $category->name }}</strong></td>
                                                <td>
                                                    @if (!empty($category->description))
                                                        {{ Str::limit($category->description, 50, '...') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $category->status == 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} text-uppercase">
                                                        {{ $category->status == 'Active' ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-primary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ri-more-fill align-middle "></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a href="#!" class="dropdown-item view-item-btn"
                                                                    data-id="{{ $category->id }}"
                                                                    data-url="{{ route('categories.show', $category->id) }}">
                                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                    View
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#!" class="dropdown-item edit-item-btn"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                                    data-id="{{ $category->id }}"
                                                                    data-name="{{ $category->name }}"
                                                                    data-description="{{ $category->description }}"
                                                                    data-status="{{ $category->status }}"
                                                                    data-url="{{ route('categories.update', $category->id) }}">
                                                                    <i
                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                    Edit
                                                                </a>
                                                            <li>
                                                                <a href="#!" class="dropdown-item remove-item-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteRecordModal"
                                                                    data-id="{{ $category->id }}"
                                                                    data-url="{{ route('categories.destroy', $category->id) }}">
                                                                    <i
                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @if ($category->children->isNotEmpty())
                                                            <button class="btn btn-soft-secondary btn-sm toggle-category"
                                                                type="button" data-id="{{ $category->id }}">
                                                                <i class="ri-arrow-up-s-line rotate-icon"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Include Child Categories -->
                                            @if ($category->children->isNotEmpty())
                                                @include('admin.categories.partials.category-table', [
                                                    'categories' => $category->children,
                                                    'parentIndex' => $loop->iteration,
                                                    'level' => 1,
                                                    'parentId' => $category->id,
                                                ])
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Include the JavaScript code -->
                            @push('js')
                                <script>
                                    $(document).ready(function() {
                                        $(document).on('click', '.toggle-category', function() {
                                            var categoryId = $(this).data('id');
                                            var childRows = $('tr[data-parent-id="' + categoryId + '"]');

                                            childRows.each(function() {
                                                var $row = $(this);
                                                if ($row.css('display') === 'none' || $row.css('display') === '') {
                                                    $row.css('display', 'table-row');
                                                } else {
                                                    $row.css('display', 'none');

                                                    // Also hide all descendant rows recursively
                                                    hideDescendants($row.data('id'));
                                                }
                                            });
                                        });

                                        function hideDescendants(parentId) {
                                            var descendantRows = $('tr[data-parent-id="' + parentId + '"]');
                                            descendantRows.each(function() {
                                                var $row = $(this);
                                                $row.css('display', 'none');
                                                hideDescendants($row.data('id'));
                                            });
                                        }
                                    });
                                </script>
                            @endpush





                            <div class="col-12 d-flex justify-content-end">
                                @if ($categories->hasPages())
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            {{-- Previous Page Link --}}
                                            @if ($categories->onFirstPage())
                                                <li class="page-item disabled"><a class="page-link">Previous</a></li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                                        rel="prev">Previous</a>
                                                </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                                @if ($page == $categories->currentPage())
                                                    <li class="page-item active"><a class="page-link"
                                                            href="#">{{ $page }}</a></li>
                                                @else
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach

                                            {{-- Next Page Link --}}
                                            @if ($categories->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}"
                                                        rel="next">Next</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled"><a class="page-link">Next</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                @endif
                            </div>


                            {{-- View --}}
                            <!-- View Category Modal -->
                            <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="viewModalLabel">View Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="viewModalContent">
                                                <!-- Category content will be loaded here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- View --}}



                            @push('js')
                                <script>
                                    $(document).ready(function() {

                                        $('#categoryTable').DataTable({
                                            responsive: true,
                                            paging: false,
                                            searching: false,
                                            ordering: false,
                                            // pageLength: 100,
                                            columnDefs: [{
                                                orderable: false,
                                                targets: [0, 5] // Disable ordering on the checkbox and action columns
                                            }],

                                        });




                                        var rotateIcons = document.querySelectorAll('.rotate-icon');

                                        $('.rotate-icon').on('click', function() {
                                            // If the icon has the down arrow class, remove it and add the up arrow class
                                            if ($(this).hasClass('ri-arrow-up-s-line')) {
                                                $(this).removeClass('ri-arrow-up-s-line').addClass('ri-arrow-down-s-line');
                                            }
                                            // Otherwise, remove the up arrow class and add the down arrow class
                                            else {
                                                $(this).removeClass('ri-arrow-down-s-line').addClass('ri-arrow-up-s-line');
                                            }
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


                                        // View
                                        $('.view-item-btn').on('click', function() {
                                            let categoryId = $(this).data('id');
                                            let url = $(this).data('url');
                                            showPreloader();
                                            $.ajax({
                                                url: url,
                                                method: 'GET',
                                                success: function(data) {
                                                    let modalContent = `
                                                    <p><strong>Name:</strong> ${data.name}</p>
                                                    <p><strong>Slug:</strong> ${data.slug}</p>
                                                    <p><strong>Description:</strong> ${data.description}</p>
                                                    <p><strong>Status:</strong> ${data.status}</p>
                                                    <p><strong>Parent Category:</strong> ${data.parent ? data.parent.name : 'None'}</p>
                                                    <p><strong>Children Categories:</strong></p>
                                                    <ul>
                                                        ${data.children.map(child => `<li>${child.name}</li>`).join('')}
                                                    </ul>
                                                    <p><strong>Image:</strong></p>`;

                                                    if (data.image) {
                                                        modalContent +=
                                                            `<img src="/storage/${data.image}" alt="${data.name}" class="img-fluid"/>`;
                                                    } else {
                                                        // If image is null, display a message
                                                        modalContent += `<p>No image available.</p>`;
                                                    }

                                                    modalContent += `
                                                    `;
                                                    $('#viewModalContent').html(modalContent);

                                                    // Show the modal
                                                    $('#viewModal').modal('show');
                                                },
                                                error: function(error) {
                                                    console.error('Error fetching category:', error);
                                                },
                                                complete: function() {
                                                    hidePreloader(); // Hide preloader when AJAX request completes
                                                }
                                            });
                                        });
                                        // View




                                        const checkAll = $('#checkAll');
                                        const checkboxes = $('.chk_child');
                                        const removeActionsBtn = $('#remove-actions');

                                        // Initially hide the delete button
                                        removeActionsBtn.css('display', 'none');

                                        // Toggle all checkboxes when the header checkbox is clicked
                                        checkAll.on('change', function() {
                                            checkboxes.prop('checked', this.checked);
                                            toggleDeleteButton();
                                        });

                                        // Handle the toggle state of the delete button when any checkbox is clicked
                                        checkboxes.on('change', function() {
                                            // If all checkboxes are checked, also check the "Check All" checkbox
                                            checkAll.prop('checked', checkboxes.length === checkboxes.filter(':checked').length);
                                            toggleDeleteButton();
                                        });

                                        function toggleDeleteButton() {
                                            const anyChecked = checkboxes.is(':checked');
                                            if (anyChecked) {
                                                removeActionsBtn.css('display', 'block');
                                            } else {
                                                removeActionsBtn.css('display', 'none');
                                            }
                                        }

                                        // Handle multi-delete action
                                        removeActionsBtn.on('click', function() {
                                            const selectedIds = checkboxes.filter(':checked').map(function() {
                                                return $(this).val();
                                            }).get();

                                            if (selectedIds.length > 0) {
                                                if (confirm('Are you sure you want to delete the selected categories?')) {
                                                    showPreloader(); // Show preloader before starting the AJAX request
                                                    $.ajax({
                                                        url: '/admin/categories/multi-delete',
                                                        method: 'POST',
                                                        data: {
                                                            ids: selectedIds,
                                                            _token: $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        success: function(response) {
                                                            if (response.success) {
                                                                window.location.reload();
                                                            } else {
                                                                alert('An error occurred while deleting the categories.');
                                                            }
                                                        },
                                                        error: function() {
                                                            alert('An error occurred while deleting the categories.');
                                                        },
                                                        complete: function() {
                                                            hidePreloader(); // Hide preloader when AJAX request completes
                                                        }
                                                    });
                                                }
                                            }
                                        });

                                        let deleteUrl;

                                        // When the delete button in the dropdown is clicked, open the modal and store the URL
                                        $(document).on('click', '.remove-item-btn', function() {
                                            // Get the URL from the data attribute
                                            deleteUrl = $(this).data('url');

                                            // You can now use this `deleteUrl` for your delete action
                                            console.log("Delete URL: ", deleteUrl);
                                        });


                                        // When the "Yes, Delete It!" button is clicked in the modal
                                        $('#delete-record').on('click', function() {
                                            if (deleteUrl) {
                                                showPreloader(); // Show preloader before starting the AJAX request
                                                $.ajax({
                                                    url: deleteUrl,
                                                    method: 'DELETE',
                                                    data: {
                                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                                    },
                                                    success: function(response) {
                                                        if (response.success) {
                                                            // Close the modal
                                                            $('#deleteRecordModal').modal('hide');
                                                            // Optionally reload the page or remove the deleted item from the DOM
                                                            location.reload();
                                                        } else {
                                                            alert('An error occurred while deleting the record.');
                                                        }
                                                    },
                                                    error: function() {
                                                        alert('An error occurred while deleting the record.');
                                                    },
                                                    complete: function() {
                                                        hidePreloader(); // Hide preloader when AJAX request completes
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>
                            @endpush

                            {{-- Insert --}}
                            <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('categories.store') }}" method="POST"
                                            class="tablelist-form" autocomplete="off" enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">
                                                @if (session('error_type') === 'validation' || session('error_type') === 'insertion')
                                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0"
                                                        role="alert">
                                                        <i
                                                            class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                                                        @if ($errors->any())
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if (session('insertion_error'))
                                                            <p>{{ session('insertion_error') }}</p>
                                                        @endif
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <!-- Rest of your form fields -->
                                                <div class="mb-3 mt-3">
                                                    <label for="categoryname-field" class="form-label">Category
                                                        Name</label>
                                                    <input type="text" id="categoryname-field" name="name"
                                                        class="form-control" placeholder="Enter category name"
                                                        value="{{ old('name') }}" required />
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="parent-category-field" class="form-label">Parent
                                                        Category</label>
                                                    <select class="form-control" name="parent_id"
                                                        id="parent-category-field">
                                                        <option value="">Select parent category (optional)</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('parent_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="child-category-field" class="form-label">Child
                                                        Category</label>
                                                    <select class="form-control" name="child_id"
                                                        id="child-category-field" disabled>
                                                        <option value="">Select child category</option>
                                                        <!-- Child categories will be loaded dynamically here -->
                                                    </select>

                                                    @error('child_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>





                                                <div class="mb-3">
                                                    <label for="image-field" class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        id="image-field" />
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description-field" class="form-label">Description</label>
                                                    <textarea id="description-field" name="description" class="form-control" placeholder="Enter category description">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status-field" class="form-label">Status</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="status-active" value="Active"
                                                            {{ old('status', 'Active') === 'Active' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status-active">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="status-inactive" value="Inactive"
                                                            {{ old('status') === 'Inactive' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="status-inactive">Inactive</label>
                                                    </div>
                                                    @error('status')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Add
                                                        Category</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @push('js')
                                <script>
                                    $(document).ready(function() {
                                        $('#parent-category-field').on('change', function() {
                                            var parentId = $(this).val();
                                            var childDropdown = $('#child-category-field');

                                            if (parentId) {
                                                // Make the child dropdown enabled
                                                childDropdown.prop('disabled', false);

                                                // Clear previous child categories
                                                childDropdown.html('<option value="">Select child category</option>');

                                                // Send AJAX request to get child categories
                                                $.ajax({
                                                    url: 'category/get-child-categories/' +
                                                        parentId, // Assuming this route exists
                                                    type: 'GET',
                                                    success: function(data) {
                                                        // Populate the child dropdown with the returned data
                                                        $.each(data, function(key, value) {
                                                            childDropdown.append('<option value="' + value.id +
                                                                '">' + value.name + '</option>');
                                                        });
                                                    },
                                                    error: function() {
                                                        alert('Error retrieving child categories');
                                                    }
                                                });
                                            } else {
                                                // Disable the child dropdown if no parent category is selected
                                                childDropdown.prop('disabled', true);
                                                childDropdown.html('<option value="">Select child category</option>');
                                            }
                                        });
                                    });
                                </script>
                                @if (session('error_type') === 'validation' || session('error_type') === 'insertion')
                                    <script type="text/javascript">
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var myModal = new bootstrap.Modal(document.getElementById('showModal'), {});
                                            myModal.show();
                                        });
                                    </script>
                                @endif
                            @endpush
                            {{-- Insert --}}
                            {{-- Edit --}}
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="POST" class="tablelist-form" autocomplete="off"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                @if (session('error_type') === 'validation-edit' || session('error_type') === 'insertion-edit')
                                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0"
                                                        role="alert">
                                                        <i
                                                            class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                                                        @if ($errors->any())
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif


                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <!-- Edit form fields -->
                                                <div class="mb-3 mt-3">
                                                    <label for="edit-categoryname-field" class="form-label">Category
                                                        Name</label>
                                                    <input type="text" id="edit-categoryname-field" name="name"
                                                        class="form-control" placeholder="Enter category name" required />
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>



                                                {{-- <div class="mb-3">
                                                    <label for="edit-parent-category-field" class="form-label">Parent
                                                        Category</label>
                                                    <select class="form-control" name="parent_id"
                                                        id="edit-parent-category-field">
                                                        <option value="">Select parent category (optional)</option>

                                                        @foreach ($categories->where('parent_id', null) as $parentCategory)
                                                            @if (!isset($currentCategory) || $currentCategory->id != $parentCategory->id)
                                                                <!-- Main Parent Category -->
                                                                <option value="{{ $parentCategory->id }}"
                                                                    {{ (old('parent_id') ? old('parent_id') : isset($currentCategory) && $currentCategory->parent_id == $parentCategory->id) ? 'selected' : '' }}>
                                                                    {{ $parentCategory->name }}
                                                                </option>

                                                                <!-- Loop through child categories if available -->
                                                                @if ($parentCategory->children->isNotEmpty())
                                                                    @foreach ($parentCategory->children as $childCategory)
                                                                        @if (!isset($currentCategory) || $currentCategory->id != $childCategory->id)
                                                                            <option value="{{ $childCategory->id }}"
                                                                                {{ (old('parent_id') ? old('parent_id') : isset($currentCategory) && $currentCategory->parent_id == $childCategory->id) ? 'selected' : '' }}>
                                                                                -- {{ $childCategory->name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @error('parent_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div> --}}

                                                <div class="mb-3">
                                                    <label for="edit-parent-category-field" class="form-label">Parent
                                                        Category</label>
                                                    <select class="form-control" name="parent_id"
                                                        id="edit-parent-category-field">
                                                        <option value="">Select parent category</option>
                                                        @foreach ($categories as $categoryOption)
                                                            <option value="{{ $categoryOption->id }}"
                                                                {{ old('parent_id', $category->parent_id) == $categoryOption->id ? 'selected' : '' }}>
                                                                {{ $categoryOption->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-child-category-field" class="form-label">Child
                                                        Category</label>
                                                    <select class="form-control" name="child_id"
                                                        id="edit-child-category-field" disabled>
                                                        <option value="">Select child category</option>
                                                        <!-- Dynamically populated child categories -->
                                                    </select>
                                                </div>







                                                <div class="mb-3">
                                                    <label for="edit-image-field" class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        id="edit-image-field" />
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-description-field"
                                                        class="form-label">Description</label>
                                                    <textarea id="edit-description-field" name="description" class="form-control"
                                                        placeholder="Enter category description"></textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-status-field" class="form-label">Status</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="edit-status-active" value="Active">
                                                        <label class="form-check-label"
                                                            for="edit-status-active">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="edit-status-inactive" value="Inactive">
                                                        <label class="form-check-label"
                                                            for="edit-status-inactive">Inactive</label>
                                                    </div>
                                                    @error('status')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="edit-btn">Update
                                                        Category</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @push('js')
                                {{--
                                <script>
                                    $(document).ready(function() {
                                        // Add event listener to all elements with class 'edit-item-btn'
                                        $('.edit-item-btn').on('click', function() {
                                            let id = $(this).data('id'); // Current category ID
                                            let name = $(this).data('name');
                                            let description = $(this).data('description');
                                            let status = $(this).data('status');
                                            let url = $(this).data('url');
                                            let childId = $(this).data('parent-id');
                                            let parentId = $(this).data('grandparent-id');

                                            let modal = $('#editModal');
                                            modal.find('#edit-categoryname-field').val(name); // Set category name
                                            modal.find('#edit-description-field').val(description); // Set description
                                            modal.find(`#edit-status-${status.toLowerCase()}`).prop('checked', true); // Set status

                                            let parentDropdown = modal.find('#edit-parent-category-field');
                                            let childDropdown = modal.find('#edit-child-category-field');


                                            // Check if both childId and parentId exist
                                            if (childId && parentId) {
                                                childDropdown.val('');
                                                childDropdown.val('');
                                                parentDropdown.val(parentId); // Set the selected parent option
                                                // parentDropdown.find(`option[value="${parentId}"]`).prop('disabled',
                                                //     true); // Disable the selected option

                                                // Load child categories and set the selected child
                                                loadChildCategories(parentId, childId);
                                            }
                                            // If only childId exists but parentId does not
                                            else if (childId && !parentId) {
                                                parentDropdown.val(childId); // Set the selected parent option
                                                // parentDropdown.find(`option[value="${childId}"]`).prop('disabled',
                                                //     true);
                                                loadChildCategories(childId);
                                            } else {
                                                childDropdown.val('');
                                                parentDropdown.val('');

                                                loadChildCategories(parentId, childId);

                                            }
                                            // Function to load child categories via AJAX
                                            function loadChildCategories(parentId, selectedChildId = null) {


                                                // AJAX request to fetch child categories based on the selected parent category
                                                $.ajax({
                                                    url: 'category/get-child-categories/' + parentId,
                                                    type: 'GET',
                                                    success: function(response) {
                                                        // Clear and enable the child category dropdown
                                                        childDropdown.empty().prop('disabled', false);

                                                        // Append the default option
                                                        childDropdown.append(
                                                            '<option value="">Select child category</option>'
                                                        ); // Default option

                                                        // Append the fetched child categories as options
                                                        $.each(response, function(key, childCategory) {
                                                            let selected = selectedChildId == childCategory.id ?
                                                                'selected' : '';
                                                            childDropdown.append('<option value="' + childCategory
                                                                .id + '" ' + selected + '>' + childCategory
                                                                .name + '</option>');
                                                        });

                                                        // Disable the selected child option, if one exists
                                                        if (selectedChildId) {
                                                            // Make sure the selected option is disabled to prevent it from being selected again
                                                            childDropdown.find(`option[value="${selectedChildId}"]`).prop(
                                                                'readonly', true);
                                                        }
                                                    },

                                                    error: function() {
                                                        alert('Failed to fetch child categories. Please try again.');
                                                    }
                                                });
                                            }

                                            let initialParentId = parentDropdown.val(); // Get the initial parent category ID
                                            alert(initialParentId)
                                            let selectedChildId =
                                                "{{ old('child_id', $category->child_id) }}"; // Get the initially selected child category (if any)

                                            if (selectedChildId) {
                                                loadChildCategories(initialParentId, selectedChildId);
                                            }

                                            // Listen for changes on the parent category dropdown
                                            parentDropdown.on('change', function() {
                                                let parentId = $(this).val(); // Get the selected parent category ID
                                                loadChildCategories(
                                                    parentId); // Load child categories whenever the parent category changes
                                            });

                                            // Set form action URL in the modal
                                            modal.find('form').attr('action', url);
                                        });
                                    });
                                </script>
                                @if (session('error_type') === 'validation-edit' || session('error_type') === 'insertion-edit')
                                    <script type="text/javascript">
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {});
                                            myModal.show();
                                        });
                                    </script>
                                @endif --}}

                                <script>
                                    $(document).ready(function() {
                                        // Add event listener to all elements with class 'edit-item-btn'
                                        $('.edit-item-btn').on('click', function() {
                                            let id = $(this).data('id'); // Current category ID
                                            let name = $(this).data('name');
                                            let description = $(this).data('description');
                                            let status = $(this).data('status');
                                            let url = $(this).data('url');
                                            let childId = $(this).data('parent-id');
                                            let parentId = $(this).data('grandparent-id');

                                            let modal = $('#editModal');
                                            modal.find('#edit-categoryname-field').val(name); // Set category name
                                            modal.find('#edit-description-field').val(description); // Set description
                                            modal.find(`#edit-status-${status.toLowerCase()}`).prop('checked', true); // Set status

                                            let parentDropdown = modal.find('#edit-parent-category-field');
                                            let childDropdown = modal.find('#edit-child-category-field');

                                            // Check if both childId and parentId exist
                                            if (childId && parentId) {
                                                childDropdown.val('');
                                                parentDropdown.val(parentId); // Set the selected parent option
                                                loadChildCategories(parentId, childId);
                                            }
                                            // If only childId exists but parentId does not
                                            else if (childId && !parentId) {
                                                parentDropdown.val(childId); // Set the selected parent option
                                                loadChildCategories(childId);
                                            } else {
                                                childDropdown.val('');
                                                parentDropdown.val('');
                                                loadChildCategories(parentId, childId);
                                            }

                                            // Function to load child categories via AJAX
                                            function loadChildCategories(parentId, selectedChildId = null) {
                                                if (!parentId) {
                                                    return;
                                                }

                                                // AJAX request to fetch child categories based on the selected parent category
                                                $.ajax({
                                                    url: 'category/get-child-categories/' + parentId,
                                                    type: 'GET',
                                                    success: function(response) {
                                                        // Clear and enable the child category dropdown
                                                        childDropdown.empty().prop('disabled', false);

                                                        // Append the default option
                                                        childDropdown.append(
                                                            '<option value="">Select child category</option>'
                                                        ); // Default option

                                                        // Append the fetched child categories as options
                                                        $.each(response, function(key, childCategory) {
                                                            let selected = selectedChildId == childCategory.id ?
                                                                'selected' : '';
                                                            childDropdown.append('<option value="' + childCategory
                                                                .id + '" ' + selected + '>' + childCategory
                                                                .name + '</option>');
                                                        });

                                                        // Disable the selected child option, if one exists
                                                        if (selectedChildId) {
                                                            childDropdown.find(`option[value="${selectedChildId}"]`).prop(
                                                                'disabled', true);
                                                        }
                                                    },
                                                    error: function() {
                                                        alert('Failed to fetch child categories. Please try again.');
                                                    }
                                                });
                                            }

                                            let initialParentId = parentDropdown.val(); // Get the initial parent category ID
                                            let selectedChildId =
                                                "{{ old('child_id') }}"; // Get the initially selected child category (if any)

                                            if (selectedChildId) {
                                                loadChildCategories(initialParentId, selectedChildId);
                                            }

                                            // Listen for changes on the parent category dropdown
                                            parentDropdown.on('change', function() {
                                                let parentId = $(this).val(); // Get the selected parent category ID
                                                loadChildCategories(
                                                    parentId); // Load child categories whenever the parent category changes
                                            });

                                            // Set form action URL in the modal
                                            modal.find('form').attr('action', url);
                                        });
                                    });

                                    @if (session('error_type') === 'validation-edit' || session('error_type') === 'insertion-edit')
                                        $(document).ready(function() {
                                            // Display the modal on page load if there's an error
                                            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {});
                                            myModal.show();

                                            // Pre-fill the modal with the old input values from the session
                                            let modal = $('#editModal');

                                            let name = "{{ old('name') }}";
                                            let description = "{{ old('description') }}";
                                            let status = "{{ old('status') }}";
                                            let parentId = "{{ old('parent_id') }}";
                                            let childId = "{{ old('child_id') }}";

                                            modal.find('#edit-categoryname-field').val(name); // Set the name
                                            modal.find('#edit-description-field').val(description); // Set the description
                                            modal.find(`#edit-status-${status.toLowerCase()}`).prop('checked', true); // Set the status

                                            let parentDropdown = modal.find('#edit-parent-category-field');
                                            let childDropdown = modal.find('#edit-child-category-field');

                                            // Set the parent dropdown value
                                            if (parentId) {
                                                parentDropdown.val(parentId);
                                                loadChildCategories(parentId, childId); // Load child categories based on parentId
                                            } else {
                                                childDropdown.val('');
                                                parentDropdown.val('');
                                            }

                                            // Function to load child categories via AJAX
                                            function loadChildCategories(parentId, selectedChildId = null) {
                                                if (!parentId) {
                                                    return;
                                                }

                                                // AJAX request to fetch child categories based on the selected parent category
                                                $.ajax({
                                                    url: 'category/get-child-categories/' + parentId,
                                                    type: 'GET',
                                                    success: function(response) {
                                                        // Clear and enable the child category dropdown
                                                        childDropdown.empty().prop('disabled', false);

                                                        // Append the default option
                                                        childDropdown.append(
                                                            '<option value="">Select child category</option>'); // Default option

                                                        // Append the fetched child categories as options
                                                        $.each(response, function(key, childCategory) {
                                                            let selected = selectedChildId == childCategory.id ?
                                                                'selected' : '';
                                                            childDropdown.append('<option value="' + childCategory.id +
                                                                '" ' + selected + '>' + childCategory.name + '</option>'
                                                            );
                                                        });

                                                        // Disable the selected child option, if one exists
                                                        if (selectedChildId) {
                                                            childDropdown.find(`option[value="${selectedChildId}"]`).prop(
                                                                'disabled', true);
                                                        }
                                                    },
                                                    error: function() {
                                                        alert('Failed to fetch child categories. Please try again.');
                                                    }
                                                });
                                            }

                                        });
                                    @endif
                                </script>
                            @endpush

                            {{-- Edit --}}

                            <!-- Modal -->
                            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" id="deleteRecord-close"
                                                data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width: 100px; height: 100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">
                                                        Are you sure you want to remove this record ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn w-sm btn-danger" id="delete-record">
                                                    Yes, Delete It!
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->
    </div>
@endsection
