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
                <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filters
                  <i class="fa fa-angle-down ms-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Pending..
                    <span class="badge bg-primary rounded-pill">78</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Processing
                    <span class="badge bg-black-50 rounded-pill">12</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    For Delivery
                    <span class="badge bg-black-50 rounded-pill">20</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Canceled
                    <span class="badge bg-black-50 rounded-pill">5</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    Delivered
                    <span class="badge bg-black-50 rounded-pill">280</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
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
                <input type="text" class="form-control form-control-alt" id="dm-ecom-orders-search" name="dm-ecom-orders-search" placeholder="Search all orders..">
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
                    <th class="text-center" style="width: 100px;">Mã đơn</th>
                    <th class="d-none d-sm-table-cell text-center">Ngày đặt</th>
                    <th class="d-sm-table-cell">Trạng thái</th>
                    <th class="d-none d-xl-table-cell">Khách hàng</th>
                    <th class="d-none d-xl-table-cell text-center">Số lượng</th>
                    <th class="d-none d-sm-table-cell text-end">Tổng</th>
                    <th class="text-center">#</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                    <tr>
                      <td class="text-center">
                        <a class="fw-semibold" href="be_pages_ecom_order.html">
                          <strong>{{$order->sku}}</strong>
                        </a>
                      </td>
                      <td class="d-none d-sm-table-cell text-center">{{$order->created_at->format('d-m-Y H:i')}}</td>
                      <td class="fs-base">
                        <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                      </td>
                      <td class="d-none d-xl-table-cell">
                        <a class="fw-semibold" href="be_pages_ecom_customer.html">{{$order->customer_name}}</a>
                      </td>
                      <td class="d-none d-xl-table-cell text-center">
                        <a class="fw-semibold" href="be_pages_ecom_order.html">{{$order->items->count()}}</a>
                      </td>
                      <td class="d-none d-sm-table-cell text-end">
                        <strong>{{number_format($order->total_price, 3, '.', 0)}} đ</strong>
                      </td>
                      <td class="text-center fs-base">
                        <a class="btn btn-sm btn-alt-secondary" href="{{route('admin.order.show' , $order->id)}}">
                          <i class="fa fa-fw fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                 
                </tbody>
              </table>
            </div>
            <!-- END All Orders Table -->

            <!-- Pagination -->
            <nav aria-label="Photos Search Navigation">
              <ul class="pagination justify-content-end mt-2">
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                    Prev
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)">4</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" aria-label="Next">
                    Next
                  </a>
                </li>
              </ul>
            </nav>
            <!-- END Pagination -->
          </div>
        </div>
        <!-- END All Orders -->
      </div>
      <!-- END Page Content -->
@endsection