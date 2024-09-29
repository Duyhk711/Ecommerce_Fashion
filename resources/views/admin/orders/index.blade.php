@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row items-push">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="be_pages_ecom_orders.html">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold text-primary mb-1">78</div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Pending
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold mb-1">126</div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Today
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold mb-1">350</div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Yesterday
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold mb-1">89.752</div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            This Month
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->

        <!-- All Orders -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Orders</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filters
                            <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Pending..
                                <span class="badge bg-primary rounded-pill">78</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Processing
                                <span class="badge bg-black-50 rounded-pill">12</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                For Delivery
                                <span class="badge bg-black-50 rounded-pill">20</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Canceled
                                <span class="badge bg-black-50 rounded-pill">5</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Delivered
                                <span class="badge bg-black-50 rounded-pill">280</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                All
                                <span class="badge bg-black-50 rounded-pill">19k</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content bg-body-dark">
                <!-- Search Form -->
                <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-alt" id="dm-ecom-orders-search"
                            name="dm-ecom-orders-search" placeholder="Search all orders..">
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
            <div class="block-content">
                <!-- All Orders Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">ID</th>
                                <th class="d-none d-sm-table-cell text-center">Mã đơn hàng</th>
                                <th>Trạng thái</th>
                                <th class="d-none d-xl-table-cell text-center">Tên khách hàng</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderStatusChanges as $orderStatusChange)
                                <tr>
                                    <td class="text-center">`
                                        <a class="fw-semibold" href="#">
                                            <strong>{{ $orderStatusChange->id }}</strong>
                                        </a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">{{ $orderStatusChange->order_id }}</td>
                                    <td class="fs-base">
                                        <span class="badge rounded-pill bg-info">{{ $orderStatusChange->new_status }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center">
                                        {{ $orderStatusChange->order->customer_name ?? 'N/A' }}
                                    </td> <!-- Hiển thị tên khách hàng từ bảng orders -->
                                    <td class="text-center fs-base">
                                        <a class="btn btn-sm btn-alt-secondary" href="">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>





            </div>
            <!-- END All Orders -->
        </div>
        <!-- END Page Content -->
    @endsection
