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
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Order Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Ecommerce</a>
                                </li>
                                <li class="breadcrumb-item active">Order Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->order_number }}</h5>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-success btn-sm">
                                        <i class="ri-download-2-fill align-middle me-1"></i>
                                        Invoice
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap align-middle table-borderless mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Item Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col" class="text-end">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{ Storage::url($item->product->cover_image ?? 'default-image.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15">
                                                                <a href="{{ route('product.details', $item->product_id) }}"
                                                                    class="link-primary">
                                                                    {{ $item->product_name }}
                                                                </a>
                                                            </h5>
                                                            @php
                                                                // Decode the variants JSON
                                                                $variants = json_decode($item->variants, true) ?? [];
                                                            @endphp

                                                            @foreach ($variants as $variant)
                                                                <p class="text-muted mb-0">
                                                                    {{ $variant['type'] }}:
                                                                    <span class="fw-medium">{{ $variant['value'] }}</span>
                                                                    @if (!empty($variant['price']) && $variant['price'] > 0)
                                                                        <span class="text-success">(+
                                                                            {{ number_format($variant['price'], 2) }}
                                                                            PKR)</span>
                                                                    @endif
                                                                </p>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->price_per_item, 2) }} PKR
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td></td>
                                                {{-- <td>
                                                    <div class="text-warning fs-15">
                                                         @php
                                                            $rating = $item->product->rating ?? 0; // Replace with actual rating field
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="ri-star{{ $i <= $rating ? '-fill' : '-line' }}"></i>
                                                        @endfor
                                                    </div>
                                                </td> --}}
                                                <td class="fw-medium text-end">
                                                    {{ number_format($item->total_price, 2) }} PKR
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No items found for this order.</td>
                                            </tr>
                                        @endforelse
                                        <tr class="border-top border-top-dashed">
                                            <td colspan="3"></td>
                                            <td colspan="2" class="fw-medium p-0">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sub Total :</td>
                                                            <td class="text-end">{{ number_format($order->subtotal, 2) }}
                                                                PKR
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Discount
                                                                <span class="text-muted">(Code:
                                                                    {{ $order->discount_code ?? 'N/A' }})</span>:
                                                            </td>
                                                            <td class="text-end">
                                                                {{ number_format($order->discount ?? 0, 2) }} PKR</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping Charge :</td>
                                                            <td class="text-end">
                                                                {{ number_format($order->shipping_charge, 2) }} PKR</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Estimated Tax :</td>
                                                            <td class="text-end">{{ number_format($order->tax, 2) }} PKR
                                                            </td>
                                                        </tr>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row">Total (USD) :</th>
                                                            <th class="text-end">{{ number_format($order->total, 2) }} PKR
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                                <div class="flex-shrink-0 mt-2 mt-sm-0">
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"
                                        data-bs-toggle="modal" data-bs-target="#changeAddressModal">
                                        <i class="ri-map-pin-line align-middle me-1"></i>
                                        Change Address
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-soft-primary btn-sm mt-2 mt-sm-0"
                                        data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                                        <i class="mdi mdi-archive-remove-outline align-middle me-1"></i>
                                        Change Status
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @foreach ($order->timelines as $key => $timeline)
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="heading{{ $key }}">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                                    href="#collapse{{ $key }}"
                                                    aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $key }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title bg-success rounded-circle">
                                                                <i class="{{ $timeline->icon }}"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold">
                                                                {{ $timeline->status }} -
                                                                <span class="fw-normal">{{ $timeline->event_date }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapse{{ $key }}"
                                                class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $key }}"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="mb-1">{{ $timeline->description }}</h6>
                                                    <p class="text-muted mb-0">
                                                        {{ $timeline->event_time }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>

                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i>
                                    Logistics Details
                                </h5>
                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track
                                        Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                                    colors="primary:#405189,secondary:#0ab39c"
                                    style="width: 80px; height: 80px"></lord-icon>
                                @if ($order->logistic)
                                    <h5 class="fs-16 mt-2 text-primary">{{ $order->logistic->logistic_provider }}</h5>
                                    <p class="text-muted mb-0">ID: {{ $order->logistic->tracking_id }}</p>
                                @else
                                    <p class="text-muted mb-0 ">Logistic details not available.</p>
                                @endif
                                <p class="text-muted mb-0">Payment Mode:
                                    <span class="text-primary">
                                        {{ $order->payment->payment_method == 'cod' ? 'Cash on Delivery' : $order->logistic->payment_mode }}</span>
                                </p>
                                <p class="text-muted mb-0">Status:
                                    {{ $order->logistic ? ucfirst($order->logistic->status) : 'Status not available' }}</p>
                            </div>

                        </div>
                    </div>
                    <!--end card-->

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    Customer Details
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                @if ($order->user)
                                    <!-- Show customer information -->
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $order->user->profile_image ?? asset('assets/images/users/default-avatar.jpg') }}"
                                                    alt="" class="avatar-sm rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">{{ $order->user->name }}</h6>
                                                <p class="text-muted mb-0">Customer</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                        {{ $order->user->email }}
                                    </li>
                                    <li>
                                        <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                        {{ $order->user->phone ?? 'N/A' }}
                                    </li>
                                @else
                                    <!-- Show guest information -->
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="https://cdn.vectorstock.com/i/500p/08/19/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg"
                                                    alt="" class="avatar-sm rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">Guest</h6>
                                                <p class="text-muted mb-0">No account associated with this order</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                        <a
                                            href="mailto:{{ $order->billingAddress->email ?? 'N/A' }}">{{ $order->billingAddress->email ?? 'N/A' }}</a>
                                    </li>
                                    <li>
                                        <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                        <a
                                            href="tel:{{ $order->billingAddress->phone ?? 'N/A' }}">{{ $order->billingAddress->phone ?? 'N/A' }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                                Shipping Address
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                @if ($order->shippingAddress)
                                    <!-- Address Line 1 -->
                                    <li class="fw-medium fs-14">
                                        <i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                                        {{ $order->shippingAddress->address_line1 }}
                                    </li>

                                    <!-- Address Line 2 -->
                                    @if (!empty($order->shippingAddress->address_line2))
                                        <li>
                                            <i class="ri-building-line align-middle me-1 text-muted"></i>
                                            {{ $order->shippingAddress->address_line2 }}
                                        </li>
                                    @endif

                                    <!-- City and State -->
                                    <li>
                                        <i class="ri-community-line align-middle me-1 text-muted"></i>
                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}
                                    </li>

                                    <!-- Postal Code and Country -->
                                    <li>
                                        <i class="ri-earth-line align-middle me-1 text-muted"></i>
                                        {{ $order->shippingAddress->postal_code ?? 'N/A' }},
                                        {{ $order->shippingAddress->country }}
                                    </li>

                                    <!-- Phone -->
                                    <li>
                                        <i class="ri-phone-line align-middle me-1 text-muted"></i>
                                        {{ $order->shippingAddress->phone }}
                                    </li>

                                    <!-- Email -->
                                    <li>
                                        <i class="ri-mail-line align-middle me-1 text-muted"></i>
                                        {{ $order->shippingAddress->email }}
                                    </li>
                                @else
                                    <li class="fw-medium fs-14">
                                        <i class="ri-error-warning-line align-middle me-1 text-muted"></i>
                                        Shipping address not available.
                                    </li>
                                @endif
                            </ul>



                        </div>
                    </div>


                    {{-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                                Payment Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">Transactions:</p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">#VLZ124561278124</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">Payment Method:</p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Debit Card</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">Card Holder Name:</p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Joseph Parker</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">Card Number:</p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">Total Amount:</p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">$415.96</h6>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->
    </div>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width: 100px; height: 100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">
                                Are you sure you want to remove this Notification ?
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">
                            Yes, Delete It!
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{-- Change Address Modal --}}
    <div id="changeAddressModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 overflow-hidden">
                <!-- Modal Header -->
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Change Address</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Alert -->
                <div class="alert alert-info rounded-0 mb-0">
                    <p class="mb-0">Ensure your address is accurate for a seamless delivery experience.</p>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="changeAddressForm" action="{{ route('change.address', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="addressLine1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="addressLine1" name="address_line1"
                                value="{{ old('address_line1', $order->shippingAddress->address_line1 ?? '') }}"
                                placeholder="Enter primary address" required>
                        </div>
                        <div class="mb-3">
                            <label for="addressLine2" class="form-label">Address Line 2 (Optional)</label>
                            <input type="text" class="form-control" id="addressLine2" name="address_line2"
                                value="{{ old('address_line2', $order->shippingAddress->address_line2 ?? '') }}"
                                placeholder="Enter additional address details">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city', $order->shippingAddress->city ?? '') }}"
                                placeholder="Enter your city" required>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ old('state', $order->shippingAddress->state ?? '') }}"
                                placeholder="Enter your state" required>
                        </div>
                        <div class="mb-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" name="postal_code"
                                value="{{ old('postal_code', $order->shippingAddress->postal_code ?? '') }}"
                                placeholder="Enter postal code" required>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ old('country', $order->shippingAddress->country ?? '') }}"
                                placeholder="Enter your country" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Address</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    {{-- Change Status --}}
    <div id="changeStatusModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Change Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="changeStatusForm" action="{{ route('change.status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Status Selection -->
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Select Status</label>
                            <select class="form-select" id="statusSelect" name="status" required
                                onchange="toggleLogisticFields()">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected disabled' : '' }}>
                                    Pending</option>
                                <option value="processing"
                                    {{ $order->status === 'processing' ? 'selected disabled' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected disabled' : '' }}>
                                    Delivered</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected disabled' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>

                        <!-- Logistic Fields -->
                        <div id="logisticFields" style="display: none;">
                            <div class="mb-3">
                                <label for="logisticProvider" class="form-label">Logistic Provider</label>
                                <input type="text" class="form-control" id="logisticProvider"
                                    name="logistic_provider" placeholder="Enter logistic provider">
                            </div>
                            <div class="mb-3">
                                <label for="trackingId" class="form-label">Tracking ID</label>
                                <input type="text" class="form-control" id="trackingId" name="tracking_id"
                                    placeholder="Enter tracking ID">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function toggleLogisticFields() {
                const statusSelect = document.getElementById('statusSelect');
                const logisticFields = document.getElementById('logisticFields');

                if (statusSelect.value === 'shipped') {
                    logisticFields.style.display = 'block';
                } else {
                    logisticFields.style.display = 'none';
                }
            }

            // Initialize the state when the modal loads
            document.addEventListener('DOMContentLoaded', function() {
                toggleLogisticFields();
            });
        </script>
    @endpush

@endsection
