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
                        <a class="link-fx fs-3" href="javascript:void(0)">{{ number_format($totalOrderValue *1000, 0, ',', '.') }}
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
                    <table class="table table-hover align-middle table-striped  js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center " style="width: 100px;">Mã đơn</th>
                                <th class="d-none d-sm-table-cell text-center">Ngày đặt</th>
                                <th class="d-sm-table-cell">Trạng thái</th>
                                <th class="d-none d-xl-table-cell text-center">Số lượng</th>
                                <th class="d-none d-sm-table-cell text-end">Tổng</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center fs-sm">Không có đơn hàng nào</td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">
                                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                                {{ $order->session_id }} </a>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center fs-sm">
                                            {{ $order->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="fs-base d-sm-table-cell">
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
                                            <span id="orderStatus-{{ $order->id }}"
                                                class="badge rounded-pill {{ $badgeColor[$currentStatus] }}">
                                                {{ $statusMapping[$currentStatus] ?? $currentStatus }}
                                            </span>
                                        </td>
                                        <td class="d-none d-xl-table-cell text-center fs-sm">
                                            <a class="fw-semibold">{{ $order->items->count() }}</a>
                                        </td>
                                        <td class="text-end d-none d-sm-table-cell fs-sm">
                                            <strong>{{ number_format($order->total_price, 3, '.', 0) }} đ</strong>
                                        </td>
                                        <td class="text-center fs-sm">
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
            </div>
        </div>
        <!-- END Past Orders -->



    </div>
    <!-- END Page Content -->
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
@endsection
