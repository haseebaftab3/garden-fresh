@extends('admin.template.master')

@section('title', 'Dashboard')
@section('content')
    @push('css')
        <link href="{{ asset('admin-assets/assets/libs/gridjs/theme/mermaid.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/assets/libs/nouislider/nouislider.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    @push('js')
        <script src="{{ asset('admin-assets/assets/libs/nouislider/nouislider.min.js') }}"></script>
        <script src="{{ asset('admin-assets/assets/libs/wnumb/wNumb.min.js') }}"></script>
        <script src="{{ asset('admin-assets/assets/libs/gridjs/gridjs.umd.js') }}"></script>
        <script src="{{ asset('admin-assets/assets/libs/gridjs/plugins/selection/dist/selection.umd.js') }}"></script>
        <script src="{{ asset('admin-assets/assets/js/pages/ecommerce-product-list.init.js') }}"></script>
    @endpush

    <div class="page-content">
        <div id="preloader" style="opacity: 1;  visibility: visible;">
            <div class="spinner-border text-primary" style="position: absolute;left: 50%;top: 50%;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Ecommerce</a>
                                </li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">


                <div class="col-xl-12 col-lg-12">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.products.create') }}" class="btn btn-success"
                                                id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add
                                                Product</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold"
                                                    href="{{ route('admin.products.index') }}">
                                                    All
                                                    <span
                                                        class="badge bg-primary-subtle text-primary align-middle rounded-pill ms-1">{{ $allProducts->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold"
                                                    href="{{ route('admin.products.published') }}">
                                                    Published
                                                    <span
                                                        class="badge bg-success-subtle text-success align-middle rounded-pill ms-1">{{ $publishedCount }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold"
                                                    href="{{ route('admin.products.scheduled') }}">
                                                    Scheduled
                                                    <span
                                                        class="badge bg-info-subtle text-info align-middle rounded-pill ms-1">{{ $scheduledCount }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" href="{{ route('admin.products.draft') }}">
                                                    Draft
                                                    <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $draftCount }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <div id="selection-element">
                                            <div class="my-n1 d-flex align-items-center text-muted">
                                                Select
                                                <div id="select-content" class="text-body fw-semibold px-1"></div>
                                                Result
                                                <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                                    data-bs-toggle="modal" data-bs-target="#removeItemModal">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active">
                                        <table id="ProductDatatable"
                                            class="table table-bordered dt-responsive nowrap table-striped align-middle"
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
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($allProducts as $product)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15 chk_child"
                                                                    type="checkbox" name="chk_child[]" />
                                                            </div>
                                                        </th>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><strong>{{ $product->title }}</strong></td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->status }}</td>
                                                        <td>
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-soft-primary btn-sm dropdown"
                                                                    type="button" data-bs-toggle="dropdown">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                                                            class="dropdown-item view-item-btn">
                                                                            <i
                                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                            View
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item edit-item-btn"
                                                                            href="{{ route('admin.products.edit', $product->id) }}">
                                                                            <i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item remove-item-btn cursor-pointer"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteRecordModal"
                                                                            data-id="{{ $product->id }}"
                                                                            data-url="{{ route('admin.products.destroy', $product->id) }}">
                                                                            <i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                            Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">No products found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @push('js')
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
                                            $('#ProductDatatable').DataTable({
                                                "paging": true,
                                                "lengthChange": true,
                                                "searching": true,
                                                "ordering": false,
                                                "info": true,
                                                "autoWidth": false,
                                                "responsive": true
                                            });
                                            let deleteUrl;
                                            $('.remove-item-btn').on('click', function() {
                                                deleteUrl = $(this).data('url');
                                            });
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
                                                                $('#deleteRecordModal').modal('hide');
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
                                        </script>
                                    @endpush
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->

                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal"
                        aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width: 100px; height: 100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">
                                Are you sure you want to remove this record ?
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">
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
@endsection
