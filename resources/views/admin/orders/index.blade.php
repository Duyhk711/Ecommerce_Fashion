@extends('layouts.backend')


@section('css')
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
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
                <div class="block-options">
                  <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-3">
                    <select name="status" id="statusFilter" class="form-select" onchange="this.form.submit()">
                        <option value="">Tất cả trạng thái</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Chờ xác nhận</option>
                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Đang chuẩn bị</option>
                        <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Đang vận chuyển</option>
                        <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>Đã giao hàng</option>
                        <option value="huy_don_hang" {{ request('status') == 'huy_don_hang' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                  </form>
                </div>
            </div>
            <div class="block-content">
                <!-- All Orders Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-striped js-dataTable-full dataTable no-footer"
                        id="order-list">
                        <thead>
                            <tr>
                                <th class="text-center " style="width: 100px;">Mã đơn</th>
                                <th class="d-none d-sm-table-cell text-center">Ngày đặt</th>
                                <th class="d-sm-table-cell">Trạng thái</th>
                                <th class="d-none d-xl-table-cell">Khách hàng</th>
                                <th class="d-none d-xl-table-cell text-center">Số lượng</th>
                                <th class="d-none d-sm-table-cell text-end">Tổng</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if ($orders->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center fs-sm">Không có đơn hàng nào</td>
                            </tr>
                          @else
                            @foreach ($orders as $order)
                                <tr data-trang-thai="{{ $order->status }}" data-thanh-toan="{{ $order->payment_status }}">
                                    <td class="text-center fs-sm">
                                        <a class="fw-semibold" href="be_pages_ecom_order.html">
                                            <strong>{{ $order->sku }}</strong>
                                        </a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center fs-sm">
                                        {{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="fs-base">
                                        @php
                                            $statusMapping = [
                                                '1' => 'Chờ xác nhận',
                                                '2' => 'Đã xác nhận',
                                                '3' => 'Đang chuẩn bị',
                                                '4' => 'Đang vận chuyển',
                                                '5' => 'Đã giao hàng',
                                                'huy_don_hang' => 'Đơn hàng đã hủy',
                                            ];
                                            $badgeColor = [
                                                '1' => 'bg-warning',
                                                '2' => 'bg-info',
                                                '3' => 'bg-primary',
                                                '4' => 'bg-secondary',
                                                '5' => 'bg-success',
                                                'huy_don_hang' => 'bg-danger',
                                            ];
                                            $currentStatus = $order->status;
                                        @endphp
                                        <span class="badge rounded-pill {{ $badgeColor[$currentStatus] }}">
                                            {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                                        </span>
                                    </td>
                                    <td class="d-none d-xl-table-cell fs-sm">
                                        <a class="fw-semibold">{{ $order->customer_name }}</a>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center fs-sm">
                                        <a class="fw-semibold">{{ $order->items->count() }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-end fs-sm">
                                        <strong>{{ number_format($order->total_price, 3, '.', 0) }} đ</strong>
                                    </td>
                                    <td class="text-center fs-base fs-sm">
                                        <div class="btn-group">
                                            <!-- Cập nhật trạng thái -->
                                            @if ($order->status == '5' || $order->status == 'huy_don_hang')
                                                <button type="button" class="btn btn-sm btn-alt-warning "
                                                    style="height: 30px; cursor: not-allowed; background-color: #e0e0e0; color: #999; border: none;"
                                                    data-bs-toggle="tooltip" title="Không thể chỉnh sửa">
                                                    <i class="fa fa-pencil-alt pb-2"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-alt-warning" style="height: 30px;"
                                                    data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}"
                                                    title="Chỉnh sửa">
                                                    <i class="fa fa-pencil-alt" style="margin-top: -15px"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a class="btn btn-sm btn-alt-secondary"
                                            href="{{ route('admin.order.show', $order->id) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
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
                                <option value="2">Xác nhận</option>
                                <option value="3">Đang chuẩn bị</option>
                                <option value="4">Đang vận chuyển</option>
                                <option value="5">Hoàn thành</option>
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
              var statuses = ['1', '2', '3', '4', '5', 'huy_don_hang'];
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
@endsection
