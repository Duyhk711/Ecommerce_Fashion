@extends('layouts.backend')

@section('css')
<style>
    .btn {
    position: relative;
}
    .table-cell-store {
    white-space: normal; 
    overflow: hidden; 
    text-overflow: ellipsis;
    word-break: break-word; 
    max-width: 100px; 
}
</style>
@endsection
@section('content')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách đơn hàng</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" style="color: inherit;">Đơn hàng</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
            </ol>
        </nav>
    </div>
  </div>
  
</div>
     <!-- Page Content -->
     <div class="content">
      
      
        {{-- <!-- Quick Overview -->
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
        <!-- END Quick Overview --> --}}

        <!-- All Orders -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Đơn hàng</h3>
            <div class="block-options">
                <div class="dropdown">
                  <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters-trang-thai" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Trạng thái (all)
                    <i class="fa fa-angle-down ms-1"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters-trang-thai">
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="all">Tất cả</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="cho_xac_nhan">Chờ xác nhận</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="da_xac_nhan">Đã xác nhận</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="dang_chuan_bi">Đang chuẩn bị</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="dang_van_chuyen">Đang vận chuyển</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="hoan_thanh">Đã hoàn thành</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-trang-thai="huy_don_hang">Đã hủy</a>
                  </div>
              </div>
              
              <div class="dropdown">
                  <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters-thanh-toan" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Thanh toán (all)
                    <i class="fa fa-angle-down ms-1"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters-thanh-toan">
                    <a class="dropdown-item" href="javascript:void(0)" data-thanh-toan="all">Tất cả</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-thanh-toan="cho_thanh_toan">Chờ thanh toán</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-thanh-toan="da_thanh_toan">Đã thanh toán</a>
                  </div>
              </div>
            </div>
          </div>
          {{-- <div class="block-content bg-body-dark">
            <!-- Search Form -->
            <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
              <div class="mb-4">
                <input type="text" class="form-control form-control-alt" id="dm-ecom-orders-search" name="dm-ecom-orders-search" placeholder="Search all orders..">
              </div>
            </form>
            <!-- END Search Form -->
          </div> --}}
          <div class="block-content">
            <!-- All Orders Table -->
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter fs-sm" id="order-list">
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
                    <tr data-trang-thai="{{ $order->status }}" data-thanh-toan="{{ $order->payment_status }}">
                      <td class="text-center">
                        <a class="fw-semibold" href="be_pages_ecom_order.html">
                          <strong>{{$order->sku}}</strong>
                        </a>
                      </td>
                      <td class="d-none d-sm-table-cell text-center">{{$order->created_at->format('d-m-Y H:i')}}</td>
                      <td class="fs-base">
                        @php
                            $statusMapping = [
                                'cho_xac_nhan' => 'Chờ xác nhận',
                                'da_xac_nhan' => 'Đã xác nhận',
                                'dang_chuan_bi' => 'Đang chuẩn bị',
                                'dang_van_chuyen' => 'Đang vận chuyển',
                                'hoan_thanh' => 'Đã giao hàng',
                                'huy_don_hang' => 'Đơn hàng đã hủy'
                            ];
                            $badgeColor = [
                                'cho_xac_nhan' => 'bg-warning',    
                                'da_xac_nhan' => 'bg-info',        
                                'dang_chuan_bi' => 'bg-primary',   
                                'dang_van_chuyen' => 'bg-secondary',
                                'hoan_thanh' => 'bg-success',      
                                'huy_don_hang' => 'bg-danger'    
                            ];
                            $currentStatus = $order->status;
                        @endphp
                        <span class="badge rounded-pill {{ $badgeColor[$currentStatus] }}">
                            {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                        </span>
                      </td>
                      <td class="d-none d-xl-table-cell">
                        <a class="fw-semibold">{{$order->customer_name}}</a>
                      </td>
                      <td class="d-none d-xl-table-cell text-center">
                        <a class="fw-semibold">{{$order->items->count()}}</a>
                      </td>
                      <td class="d-none d-sm-table-cell text-end">
                        <strong>{{number_format($order->total_price, 3, '.', 0)}} đ</strong>
                      </td>
                      <td class="text-center fs-base">
                        <div class="btn-group">
                          <!-- Cập nhật trạng thái -->
                          @if($order->status == "hoan_thanh" || $order->status == "huy_don_hang")
                              <button type="button" class="btn btn-sm btn-alt-warning "
                                  style="height: 30px; cursor: not-allowed; background-color: #e0e0e0; color: #999; border: none;"
                                  data-bs-toggle="tooltip" title="Không thể chỉnh sửa">
                                  <i class="fa fa-pencil-alt pb-2"></i>
                              </button>
                          @else
                          <button class="btn btn-sm btn-alt-warning" style="height: 30px;"
                              data-bs-toggle="modal" 
                              data-bs-target="#updateStatusModal" 
                              data-id="{{ $order->id }}" 
                              data-status="{{ $order->status }}"
                              title="Chỉnh sửa">
                              <i class="fa fa-pencil-alt" style="margin-top: -15px"></i>
                          </button>
                          @endif
                      </div>
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
            {{-- <nav aria-label="Photos Search Navigation">
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
            </nav> --}}
            <!-- END Pagination -->
          </div>
        </div>
        <!-- END All Orders -->
      </div>
      <!-- END Page Content -->
@endsection

@section('modal')
  <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Cập Nhật Trạng Thái</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStatusForm" method="POST" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="orderId" name="id">
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label">Chọn trạng thái mới</label>
                        <select id="statusSelect" class="form-select" name="status">
                            <option value="cho_xac_nhan">Chờ xác nhận</option>
                            <option value="da_xac_nhan">Xác nhận</option>
                            <option value="dang_chuan_bi">Đang chuẩn bị</option>
                            <option value="dang_van_chuyen">Đang vận chuyển</option>
                            <option value="hoan_thanh">Hoàn thành</option>
                            <option value="huy_don_hang" disabled>Hủy bỏ</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
      document.addEventListener('DOMContentLoaded', function () {
        var updateStatusModal = document.getElementById('updateStatusModal');
        var statusSelect = document.getElementById('statusSelect');
        var submitBtn = document.querySelector('.modal-footer .btn-primary'); 
        var form = document.getElementById('updateStatusForm');

        updateStatusModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var orderId = button.getAttribute('data-id');
            var orderStatus = button.getAttribute('data-status');

            var orderIdInput = document.getElementById('orderId');
            orderIdInput.value = orderId;
            
            // Set the current order status as the selected option
            statusSelect.value = orderStatus;

            // Array of possible statuses, reflecting the order of progression
            var statuses = ['cho_xac_nhan', 'da_xac_nhan', 'dang_chuan_bi', 'dang_van_chuyen', 'hoan_thanh', 'huy_don_hang'];
            var currentStatusIndex = statuses.indexOf(orderStatus);

            // Loop through the options and disable those that are prior to the current status and 'huy_don_hang'
            for (var i = 0; i < statusSelect.options.length; i++) {
                var optionValue = statusSelect.options[i].value;

                if (statuses.indexOf(optionValue) < currentStatusIndex || optionValue === 'huy_don_hang') {
                    statusSelect.options[i].disabled = true;
                } else {
                    statusSelect.options[i].disabled = false;
                }
            }
            form.action =  '/admin/orders/update/' + orderId;

            // Disable the "Cập Nhật" button if the status is already the current one
            submitBtn.disabled = true;
        });

        // Enable the "Cập Nhật" button only if a new status is selected
        statusSelect.addEventListener('change', function () {
            if (statusSelect.value !== document.getElementById('orderId').getAttribute('data-status')) {
                submitBtn.disabled = false; 
            } else {
                submitBtn.disabled = true; 
            }
        });
    });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        let trangThaiFilter = 'all';
        let thanhToanFilter = 'all';

        // DOM elements
        const trangThaiButton = document.getElementById('dropdown-ecom-filters-trang-thai');
        const thanhToanButton = document.getElementById('dropdown-ecom-filters-thanh-toan');
        const orderList = document.getElementById('order-list').querySelector('tbody');

        // Xử lý chọn trạng thái đơn hàng
        document.querySelectorAll('.dropdown-item[data-trang-thai]').forEach(item => {
            item.addEventListener('click', function() {
                trangThaiFilter = this.getAttribute('data-trang-thai');
                trangThaiButton.innerHTML = trangThaiFilter === 'all' ? 'Trạng thái (all)' : this.innerText; // Cập nhật nút

                filterOrders(); // Gọi hàm lọc
            });
        });

        // Xử lý chọn trạng thái thanh toán
        document.querySelectorAll('.dropdown-item[data-thanh-toan]').forEach(item => {
            item.addEventListener('click', function() {
                thanhToanFilter = this.getAttribute('data-thanh-toan');
                thanhToanButton.innerHTML = thanhToanFilter === 'all' ? 'Thanh toán (all)' : this.innerText; // Cập nhật nút

                filterOrders(); // Gọi hàm lọc
            });
        });

        // Lọc đơn hàng dựa trên trạng thái đơn hàng và thanh toán
        function filterOrders() {
            const rows = orderList.querySelectorAll('tr');
            let visibleRows = 0;
            console.log("trangThaiFilter:", trangThaiFilter, "thanhToanFilter:", thanhToanFilter);

            rows.forEach(row => {
                const trangThai = row.getAttribute('data-trang-thai');
                const thanhToan = row.getAttribute('data-thanh-toan');

                
                // Kiểm tra xem hàng có khớp với cả hai điều kiện không
                const trangThaiMatch = trangThaiFilter === 'all' || trangThai === trangThaiFilter;
                const thanhToanMatch = thanhToanFilter === 'all' || thanhToan === thanhToanFilter;

                console.log(trangThaiMatch && thanhToanMatch);
                
                // Hiển thị hàng nếu cả hai điều kiện đều khớp
                if (trangThaiMatch && thanhToanMatch) {
                    row.style.display = ''; // Hiển thị hàng
                    visibleRows++;
                } else {
                    row.style.display = 'none'; // Ẩn hàng nếu không khớp
                }
            });

            // Nếu không có hàng nào được hiển thị, thêm thông báo "Không có đơn hàng nào"
            if (visibleRows === 0) {
              // Kiểm tra xem thông báo đã có chưa, nếu chưa thì thêm
              if (!orderList.querySelector('.no-orders')) {
                  const noOrdersRow = document.createElement('tr');
                  noOrdersRow.classList.add('no-orders');
                  noOrdersRow.innerHTML = '<td colspan="7" class="text-center">Không có đơn hàng nào</td>';
                  orderList.appendChild(noOrdersRow);
              }
          } else {
              // Xóa thông báo "Không có đơn hàng nào" nếu có kết quả
              const noOrdersRow = orderList.querySelector('.no-orders');
              if (noOrdersRow) {
                  noOrdersRow.remove();
              }
          }
        }
    });
  </script>

@endsection

