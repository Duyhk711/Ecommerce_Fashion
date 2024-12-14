@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Actions -->
        {{-- <div class="row items-push">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold mb-1">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Edit Customer
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="fs-3 fw-semibold text-danger mb-1">
                            <i class="fa fa-times"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-danger text-uppercase mb-0">
                            Remove Customer
                        </p>
                    </div>
                </a>
            </div>
        </div> --}}
        <!-- END Quick Actions -->

        <!-- User Info -->
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        <img class="img-avatar img-avatar96"
                            src="{{ $user->avatar != '' ? asset('storage/' . $user->avatar) : asset('admin/media/avatars/avatar3.jpg') }}"
                            alt="">
                    </div>
                    <h1 class="fs-lg mb-0">
                        {{ $user->name }}
                    </h1>
                    <p class="text-muted">
                        {{ $user->email }}
                    </p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    {{-- <div class="col-6 col-md-3">
                      <div class="fw-semibold text-dark mb-1">Giỏ hàng</div>
                      <a class="link-fx fs-3" href="javascript:void(0)">4</a>
                  </div> --}}
                    <div class="col-6 col-md-6">
                        <div class="fw-semibold text-dark mb-1">Tổng đơn đặt hàng</div>
                        <a class="link-fx fs-3" href="javascript:void(0)">{{ $totalOrders }}</a>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="fw-semibold text-dark mb-1">Tổng giá trị các đơn hàng</div>
                        <a class="link-fx fs-3" href="javascript:void(0)">{{ number_format($totalOrderValue, 3, '.', 0) }}
                            VND</a>
                    </div>
                    {{-- <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Referred</div>
                        <a class="link-fx fs-3" href="javascript:void(0)">3</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- END User Info -->

        <!-- Addresses -->
        {{-- <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Addresses (2)</h3>
          </div>
          <div class="block-content">
            <div class="row">
              <div class="col-lg-6">
                <!-- Billing Address -->
                <div class="block block-rounded block-bordered">
                  <div class="block-header border-bottom">
                    <h3 class="block-title">Billing Address</h3>
                  </div>
                  <div class="block-content">
                    <div class="fs-4 mb-1">John Parker</div>
                    <address class="fs-sm">
                      Sunrise Str 620<br>
                      Melbourne<br>
                      Australia, 11-587<br><br>
                      <i class="fa fa-phone"></i> (999) 888-55555<br>
                      <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                    </address>
                  </div>
                </div>
                <!-- END Billing Address -->
              </div>
              <div class="col-lg-6">
                <!-- Shipping Address -->
                <div class="block block-rounded block-bordered">
                  <div class="block-header border-bottom">
                    <h3 class="block-title">Shipping Address</h3>
                  </div>
                  <div class="block-content">
                    <div class="fs-4 mb-1">John Parker</div>
                    <address class="fs-sm">
                      Sunrise Str 620<br>
                      Melbourne<br>
                      Australia, 11-587<br><br>
                      <i class="fa fa-phone"></i> (999) 888-55555<br>
                      <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                    </address>
                  </div>
                </div>
                <!-- END Shipping Address -->
              </div>
            </div>
          </div>
        </div> --}}
        <!-- END Addresses -->

        <!-- Shopping Cart -->
        {{-- <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Shopping Cart (4)</h3>
          </div>
          <div class="block-content">
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 100px;">ID</th>
                    <th class="d-none d-sm-table-cell text-center">Added</th>
                    <th class="d-none d-md-table-cell">Product</th>
                    <th>Status</th>
                    <th class="d-none d-sm-table-cell text-end">Value</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        PID.0154                  </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">12/02/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #4</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$14,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        PID.0153                  </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">27/09/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #3</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$63,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        PID.0152                  </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">07/05/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #2</a>
                    </td>
                    <td>
                      <span class="badge bg-success">Available</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$34,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                        PID.0151                  </a>
                    </td>
                    <td class="d-none d-sm-table-cell text-center fs-sm">13/10/2019</td>
                    <td class="d-none d-md-table-cell fs-sm">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.html">Product #1</a>
                    </td>
                    <td>
                      <span class="badge bg-danger">Out of Stock</span>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>$34,00</strong>
                    </td>
                    <td class="text-center fs-sm">
                      <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> --}}
        <!-- END Shopping Cart -->

        <!-- Past Orders -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Các đơn hàng ({{ $totalOrders }})</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover align-middle js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-left fs-sm" style="width: 100px;">Mã đơn</th>
                                <th class="d-none d-xl-table-cell fs-sm">Người nhận</th>
                                <th class="d-none d-sm-table-cell fs-sm text-center">Ngày đặt</th>
                                <th class="d-sm-table-cell fs-sm">Trạng thái</th>
                                {{-- <th class="d-sm-table-cell fs-sm">Thanh toán</th> --}}
                                <th class="d-sm-table-cell fs-sm">PTTT</th>
                                <th class="d-none d-xl-table-cell fs-sm text-center">Số lượng</th>
                                <th class="d-none d-sm-table-cell fs-sm text-end">Tổng</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td colspan="9" class="text-center fs-sm">Không có đơn hàng nào</td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr data-trang-thai="{{ $order->status }}"
                                        data-thanh-toan="{{ $order->payment_status }}" data-order-id="{{ $order->id }}">
                                        <td class="text-left fs-sm">
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
                                                    '4' => 'Đã giao',
                                                    '5' => 'Hoàn thành',
                                                    'huy_don_hang' => 'Đơn hàng đã hủy',
                                                ];
                                                $badgeColor = [
                                                    '1' => 'bg-warning',
                                                    '2' => 'bg-info',
                                                    '3' => 'bg-primary',
                                                    '4' => 'bg-success',
                                                    '5' => 'bg-success',
                                                    'huy_don_hang' => 'bg-danger',
                                                ];
                                                $currentStatus = $order->status;
                                            @endphp
                                            <span id="orderStatus-{{ $order->id }}"
                                                class="badge rounded-pill {{ $badgeColor[$currentStatus] }}">
                                                {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                                            </span>
                                        </td>
                                        {{-- <td class="fs-base">
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
                                  </td> --}}
                                        <td class="fs-base">
                                            @php
                                                $statusMapping = [
                                                    'COD' => 'COD',
                                                    'THANH_TOAN_ONLINE' => 'VN Pay',
                                                ];
                                                $currentStatus = $order->payment_method;
                                            @endphp
                                            <span>
                                                {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                                            </span>
                                        </td>
                                        <td class=" text-center fs-sm">
                                            <a class="fs-sm">{{ $order->items->count() }}</a>
                                        </td>
                                        <td class=" text-end fs-sm">
                                            <strong>{{ number_format($order->total_price * 1000, 0, ',', '.') }} ₫</strong>
                                        </td>
                                        <td class="text-center fs-base fs-sm">
                                            <div class="btn-group" style="width: 35px">
                                                @can('Chỉnh sửa trạng thái đơn hàng')
                                                    <!-- Cập nhật trạng thái -->
                                                    @if ($order->status == '4' || $order->status == 'huy_don_hang' || $order->status == '5')
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
                                                @endcan
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
            </div>
        </div>
        <!-- END Past Orders -->



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
                                <option value="4">Đã giao</option>
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

    <!-- Page JS Code -->
    @vite(['resources/js/pages/datatables.js'])
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
                        statusSelect.options[i].disabled = statuses.indexOf(optionValue) <
                            currentStatusIndex;
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
@endsection
