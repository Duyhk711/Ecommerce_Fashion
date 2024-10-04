@extends('layouts.backend')

@section('content')
     <!-- Page Content -->
     <div class="content">
        <!-- Quick Overview -->
        <div class="row items-push">
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                  <i class="fa fa-check text-xeco-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  {{$orderDetail->sku}}
                </p>
              </div>
            </a>
          </div>
          <div class="col-6 col-lg-3">
            {{-- <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                  <i class="fa fa-check text-xeco-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Thanh toán
                </p>
              </div>
            </a> --}}

            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                  <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Chờ Thanh toán
                </p>
              </div>
            </a>

          </div>
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                  <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Trạng Thái
                </p>
              </div>
            </a>
          </div>
          <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-body mx-auto mb-3">
                  <i class="fa fa-times text-muted"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Giao hàng 
                </p>
              </div>
            </a>
          </div>
        </div>
        <!-- END Quick Overview -->

        <!-- Products -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Sản phẩm</h3>
          </div>
          <div class="block-content">
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter fs-sm">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 130px;">Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-end" style="width: 15%;">Đơn giá</th>
                    <th class="text-end" style="width: 15%;">Tổng đơn giá</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr>
                      <td class="text-center"><a href="be_pages_ecom_product_edit.html"><strong>{{$item->productVariant->sku}}</strong></a></td>
                      <td>
                        <a href="{{route('productDetail',$item->productVariant->product->slug)}}"><strong>{{$item->product_name}}</strong></a><br>
                          @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                            @if ($variantAttribute->attribute->name == 'Size') 
                                Loại: {{ $variantAttribute->attributeValue->value }}  ,
                            @endif
                          @endforeach
                          @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                            @if ($variantAttribute->attribute->name == 'Color') 
                               {{ $variantAttribute->attributeValue->value }}
                            @endif
                          @endforeach
                          </td>
                      <td class="text-center"><strong>{{$item->quantity}}</strong></td>
                      <td class="text-end">{{ number_format(($item->variant_price_sale  == 0? $item->variant_price_regular :  $item->variant_price_sale) * 1000, 0, ',', '.')}} đ</td>
                      <td class="text-end">{{number_format($item->quantity * ($item->variant_price_sale  == 0? $item->variant_price_regular :  $item->variant_price_sale) * 1000, 0, ',', '.')}} đ</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="4" class="text-end"><strong>Tổng đơn hàng:</strong></td>
                    <td class="text-end">{{number_format(($orderDetail->total_price) *1000, 0, ',', '.')}}đ</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-end"><strong>Giảm giá:</strong></td>
                    <td class="text-end">0 đ</td>
                  </tr>
                  <tr class="table-active">
                    <td colspan="4" class="text-end"><strong>Tổng đã trả:</strong></td>
                    <td class="text-end"><strong>0 đ </strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END Products -->

        <!-- Customer -->
        <div class="row">
          <div class="col-sm-6">
            <!-- Billing Address -->
            <div class="block block-rounded" >
              <div class="block-header block-header-default">
                <h3 class="block-title ">Người đặt</h3>
              </div>
              <div class="block-content">
                <div class="fs-4 mb-1">{{$user->name}}</div>
                <address class="fs-sm">
                  {{-- Sunset Str 598<br>
                  Melbourne<br>
                  Australia, 11-671<br><br> --}}
                  <i class="fa fa-phone"></i> {{$user->phone}}<br>
                  <i class="fa-regular fa-envelope"></i> <a href="javascript:void(0)">{{$user->email}}</a> <br><br> <br>
                </address>
              </div>
            </div>
            <!-- END Billing Address -->
          </div>
          <div class="col-sm-6">
            <!-- Shipping Address -->
            <div class="block block-rounded">
              <div class="block-header block-header-default">
                <h3 class="block-title">Địa chỉ nhận hàng</h3>
              </div>
              <div class="block-content">
                <div class="fs-4 mb-1">{{$orderDetail->customer_name}}</div>
                <address class="fs-sm">
                  {{$orderDetail->address_line1}}
                  {{$orderDetail->address_line2}} <br>
                  {{$orderDetail->ward}}, 
                  {{$orderDetail->district}},
                  {{$orderDetail->city}}<br><br>
                  <i class="fa fa-phone"></i> {{$orderDetail->customer_phone}}<br>
                  {{-- <a href="javascript:void(0)">{{$orderDetail->customer_email}}</a> --}}
                </address>
              </div>
            </div>
            <!-- END Shipping Address -->
          </div>
        </div>
        <!-- END Customer -->

        <!-- Log Messages -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Log Messages</h3>
          </div>
          <div class="block-content">
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter fs-sm">
                <tbody>
                  <tr>
                    <td class="fs-base" style="width: 80px;">
                      <span class="badge bg-primary">Order</span>
                    </td>
                    <td style="width: 220px;">
                      <span class="fw-semibold">January 17, 2020 - 18:00</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">Support</a>
                    </td>
                    <td class="text-success"><strong>Order Completed</strong></td>
                  </tr>
                  <tr>
                    <td class="fs-base">
                      <span class="badge bg-primary">Order</span>
                    </td>
                    <td>
                      <span class="fw-semibold">January 17, 2020 - 17:36</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">Support</a>
                    </td>
                    <td class="text-warning"><strong>Preparing Order</strong></td>
                  </tr>
                  <tr>
                    <td class="fs-base">
                      <span class="badge bg-success">Payment</span>
                    </td>
                    <td>
                      <span class="fw-semibold">January 16, 2020 - 18:10</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">John Parker</a>
                    </td>
                    <td class="text-success"><strong>Payment Completed</strong></td>
                  </tr>
                  <tr>
                    <td class="fs-base">
                      <span class="badge bg-danger">Email</span>
                    </td>
                    <td>
                      <span class="fw-semibold">January 16, 2020 - 10:35</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">Support</a>
                    </td>
                    <td class="text-danger"><strong>Missing payment details. Email was sent and awaiting for payment before processing</strong></td>
                  </tr>
                  <tr>
                    <td class="fs-base">
                      <span class="badge bg-primary">Order</span>
                    </td>
                    <td>
                      <span class="fw-semibold">January 15, 2020 - 14:59</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">Support</a>
                    </td>
                    <td>All products are available</td>
                  </tr>
                  <tr>
                    <td class="fs-base">
                      <span class="badge bg-primary">Order</span>
                    </td>
                    <td>
                      <span class="fw-semibold">January 15, 2020 - 14:29</span>
                    </td>
                    <td>
                      <a href="javascript:void(0)">John Parker</a>
                    </td>
                    <td>Order Submitted</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END Log Messages -->
      </div>
      <!-- END Page Content -->
@endsection