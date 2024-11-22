@extends('layouts.backend')

@section('css')
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
        <!-- All Orders -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Đơn hàng</h3>

            </div>
            <div class="block-content">
                <div class="block-options">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-3 ">
                      <div class="d-flex justify-content-end">
                        <div class="input-group mb-3 mx-2" style="width: 40%">
                            <input type="text" class="form-control" name="order_search" placeholder="Tìm kiếm theo mã đơn, tên khách hàng" aria-label="Search" aria-describedby="button-addon">
                        </div>
                          <div>
                              <select name="status" id="statusFilter" class="form-select" onchange="this.form.submit()">
                                  <option value="">Tất cả trạng thái</option>
                                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Chờ xác nhận</option>
                                  <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Chờ vận chuyển</option>
                                  <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Đã vận chuyển</option>
                                  <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Hoàn thành</option>
                                  <option value="huy_don_hang" {{ request('status') == 'huy_don_hang' ? 'selected' : '' }}>Đã hủy</option>
                              </select>
                          </div>
                          <div class="ms-2">
                              <select name="payment_status" id="paymentStatusFilter" class="form-select" onchange="this.form.submit()">
                                  <option value="">Tất cả thanh toán</option>
                                  <option value="cho_thanh_toan" {{ request('payment_status') == 'cho_thanh_toan' ? 'selected' : '' }}>Chờ thanh toán</option>
                                  <option value="da_thanh_toan" {{ request('payment_status') == 'da_thanh_toan' ? 'selected' : '' }}>Đã thanh toán</option>
                              </select>
                          </div>
                          <div class="ms-2 d-flex">
                              <input type="date" name="" class="form-control" style="width: 150px; height: 38px;" id="">
                              <input type="date" name="" class="form-control ms-2" style="width: 150px; height: 38px;" id="">
                          </div>
                      </div>
                    </form>
                  </div>
                <!-- All Orders Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-striped js-dataTable-full dataTable no-footer"
                        id="order-list">
                        <thead>
                            <tr>
                                <th class="text-center fs-sm" >STT</th>
                                <th class="text-center fs-sm" style="width: 100px;">Mã đơn</th>
                                <th class="d-none d-xl-table-cell fs-sm">Khách hàng</th>
                                <th class="d-none d-sm-table-cell fs-sm text-center">Ngày đặt</th>
                                <th class="d-sm-table-cell fs-sm">Trạng thái</th>
                                <th class="d-sm-table-cell fs-sm">Thanh toán</th>
                                <th class="d-sm-table-cell fs-sm">PTTT</th>
                                <th class="d-none d-xl-table-cell fs-sm text-center">Số lượng</th>
                                <th class="d-none d-sm-table-cell fs-sm text-end">Tổng</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if ($orders->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center fs-sm">Không có đơn hàng nào</td>
                            </tr>
                          @else
                            @foreach ($orders as $order)
                                <tr data-trang-thai="{{ $order->status }}" data-thanh-toan="{{ $order->payment_status }}" data-order-id="{{$order->id}}">
                                    <td class="text-center fs-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center fs-sm">
                                        <strong>{{ $order->sku }}</strong>
                                    </td>
                                    <td class="d-none d-xl-table-cell fs-sm">
                                        <a class="fs-sm">{{ $order->customer_name }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center fs-sm">
                                        {{ $order->created_at->format('d-m-Y ') }}</td>
                                    <td class="fs-base">
                                        @php
                                            $statusMapping = [
                                                '1' => 'Chờ xác nhận',
                                                '2' => 'Chờ vận chuyển',
                                                '3' => 'Đang vận chuyển',
                                                '4' => 'Hoàn thành',
                                                'huy_don_hang' => 'Đơn hàng đã hủy',
                                            ];
                                            $badgeColor = [
                                                '1' => 'bg-warning',
                                                '2' => 'bg-info',
                                                '3' => 'bg-primary',
                                                '4' => 'bg-success',
                                                'huy_don_hang' => 'bg-danger',
                                            ];
                                            $currentStatus = $order->status;
                                        @endphp
                                        <span id="orderStatus-{{$order->id}}" class="badge rounded-pill {{ $badgeColor[$currentStatus] }}">
                                            {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                                        </span>
                                    </td>
                                    <td class="fs-base">
                                        @php
                                            $statusMappingPayment = [
                                                'cho_thanh_toan' => 'Chờ thanh toán',
                                                'da_thanh_toan' => 'Đã thanh toán',
                                            ];
                                            $badgeColorPayment = [
                                                'cho_thanh_toan' => 'bg-warning',
                                                'da_thanh_toan' => 'bg-success',
                                            ];
                                            $currentStatusPayment = $order->payment_status;
                                        @endphp
                                         <span id="paymentStatus-{{$order->id}}" class="badge rounded-pill {{ $badgeColorPayment[$currentStatusPayment] }}">
                                            {{ $statusMappingPayment[$currentStatusPayment] ?? $currentStatusPayment }}
                                        </span>
                                    </td>
                                    <td class="fs-base">
                                        @php
                                            $statusMapping = [
                                                'COD' => 'COD',
                                                'THANH_TOAN_ONLINE' => 'ONLINE',
                                            ];
                                            $currentStatus = $order->payment_method;
                                        @endphp
                                         <span>
                                            {{$statusMapping[$currentStatus] ?? $currentStatus}}
                                        </span>
                                    </td>
                                    <td class=" text-center fs-sm">
                                        <a class="fs-sm">{{ $order->items->count() }}</a>
                                    </td>
                                    <td class=" text-end fs-sm">
                                        <strong>{{ number_format($order->total_price *1000, 0, ',', '.') }} ₫</strong>
                                    </td>
                                    <td class="text-center fs-base fs-sm">
                                        <div class="btn-group" style="width: 35px">
                                            <!-- Cập nhật trạng thái -->
                                            @if ($order->status == '4' || $order->status == 'huy_don_hang')
                                                <button type="button" class="btn btn-sm btn-alt-warning "
                                                    style="height: 30px; cursor: not-allowed; background-color: #e0e0e0; color: #999; border: none;"
                                                    data-bs-toggle="tooltip" title="Không thể chỉnh sửa">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-alt-warning" style="height: 30px;"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}"
                                                    title="Chỉnh sửa">
                                                    <i class="fa fa-pencil-alt" style="padding-top: -15px"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a class="btn btn-sm btn-alt-secondary" style="height: 30px;"
                                            href="{{ route('admin.order.show', $order->id) }}">
                                            <i class="fa fa-fw fa-eye mt-1 "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-end mt-3">
                  {{ $orders->appends(request()->query())->links() }}
                </div>
                <!-- END All Orders Table -->
            </div>
        </div>
        <!-- END All Orders -->
    </div>
    <!-- END Page Content -->
@endsection

@section('modal')
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Cập Nhật Trạng Thái</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStatusForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="orderId" name="id">
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Chọn trạng thái mới</label>
                            <select id="statusSelect" class="form-select" name="status">
                                <option value="1">Chờ xác nhận</option>
                                <option value="2">Chờ vận chuyển</option>
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Hoàn thành</option>
                                <option value="huy_don_hang">Hủy bỏ</option>
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
@vite(['resources/js/app.js'])
@section('js')
  <!-- Page JS Plugins -->
  <script src="{{ asset('admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
  {{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var updateStatusModal = document.getElementById('updateStatusModal');
          var statusSelect = document.getElementById('statusSelect');
          var submitBtn = document.querySelector('.modal-footer .btn-primary');
          var form = document.getElementById('updateStatusForm');

          updateStatusModal.addEventListener('show.bs.modal', function(event) {
              var button = event.relatedTarget;
              var orderId = button.getAttribute('data-id');
              var orderStatus = button.getAttribute('data-status');


              var orderIdInput = document.getElementById('orderId');
              orderIdInput.value = orderId;

              // Set the current order status as the selected option
              statusSelect.value = orderStatus;

              // Array of possible statuses, reflecting the order of progression
              var statuses = ['1', '2', '3', '4', 'huy_don_hang'];
              var currentStatusIndex = statuses.indexOf(orderStatus);
                console.log(currentStatusIndex);
                // if (statuses['1']) {
                //     statusSelect.options[i].disabled = false;
                // }else{
                //     statusSelect.options[i].disabled = true;
                // }
              // Loop through the options and disable those that are prior to the current status and 'huy_don_hang'
              for (var i = 0; i < statusSelect.options.length; i++) {
                var optionValue = statusSelect.options[i].value;

                // Nếu là 'huy_don_hang'
                if (optionValue === 'huy_don_hang') {
                    // Cho phép chọn nếu trạng thái hiện tại là 1, ngược lại disable
                    statusSelect.options[i].disabled = !(currentStatusIndex === 0);
                } else {
                    // Các trạng thái khác: disable nếu thứ tự trước trạng thái hiện tại
                    statusSelect.options[i].disabled = statuses.indexOf(optionValue) < currentStatusIndex;
                }
            }

              form.action = '/admin/orders/update/' + orderId;

              // Disable the "Cập Nhật" button if the status is already the current one
              submitBtn.disabled = true;
          });

          // Enable the "Cập Nhật" button only if a new status is selected
          statusSelect.addEventListener('change', function() {
              var currentStatus = document.getElementById('orderId').getAttribute('data-status');
              console.log(document.getElementById('orderId').getAttribute('data-status'));

              if (statusSelect.value != currentStatus) {
                  submitBtn.disabled = false;
              } else {
                  submitBtn.disabled = true;
              }
          });
      });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- <script src="resoures/js/app.js'"></script> --}}

@endsection
