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
          {{-- ô 2 --}}
          <div class="col-6 col-lg-3">
            @if ($orderDetail->payment_status == "cho_thanh_toan" && $orderDetail->status != "huy_don_hang")
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

            @elseif($orderDetail->payment_status == "da_thanh_toan" && $orderDetail->status != "huy_don_hang")
              <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                  <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                    <i class="fa fa-check text-xeco-dark"></i>
                  </div>
                  <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                    Đã thanh toán
                  </p>
                </div>
              </a>
              @elseif($orderDetail->payment_status == "cho_thanh_toan" && $orderDetail->status == "huy_don_hang")
              <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                  <div class="item rounded-circle bg-body mx-auto mb-3">
                    <i class="fa fa-times text-muted"></i>
                  </div>
                  <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                    Đã hủy
                  </p>
                </div>
              </a>
              @elseif($orderDetail->payment_status == "da_thanh_toan" && $orderDetail->status == "huy_don_hang")
              <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                  <div class="item rounded-circle bg-body mx-auto mb-3">
                    <i class="fa fa-times text-muted"></i>
                  </div>
                  <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                    Đã hủy
                  </p>
                </div>
              </a>
            @endif
          </div>

          {{-- ô 3 --}}

          <div class="col-6 col-lg-3">
            @if ($orderDetail->status == "1")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                  <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Chờ xác nhận
                </p>
              </div>
            </a>

            @elseif($orderDetail->status == "2" || $orderDetail->status == "3" || $orderDetail->status == "4" )
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                  <i class="fa fa-check text-xeco-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Đã xác nhận
                </p>
              </div>
            </a>

            @elseif($orderDetail->status == "huy_don_hang")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-body mx-auto mb-3">
                  <i class="fa fa-times text-muted"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Đã hủy
                </p>
              </div>
            </a>
            @endif
          </div>

          {{-- ô 4 --}}
          <div class="col-6 col-lg-3">

            @if ($orderDetail->status == "huy_don_hang")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-body mx-auto mb-3">
                  <i class="fa fa-times text-muted"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Đã hủy
                </p>
              </div>
            </a>

            @elseif($orderDetail->status == "2")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                  <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Chờ vận chuyển
                </p>
              </div>
            </a>

            @elseif($orderDetail->status == "3")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                  <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Đang vận chuyển
                </p>
              </div>
            </a>
            
            @elseif($orderDetail->status == "4")
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
              <div class="block-content py-5">
                <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                  <i class="fa fa-check text-xeco-dark"></i>
                </div>
                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                  Đã giao hàng
                </p>
              </div>
            </a>

            @elseif( $orderDetail->status != "3" || $orderDetail->status != "4" || $orderDetail->status != "2")
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

            @endif
            
          </div>
        </div>
        <!-- END Quick Overview -->

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
                    <th>Sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-end" style="width: 15%;">Đơn giá</th>
                    <th class="text-end" style="width: 15%;">Tổng đơn giá</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr>
                      <td>                      
                          <div class="d-flex">
                            <div>
                              <img src="{{asset('storage/' . $item->productVariant->image)}}" width="80px" alt="">
                            </div>
                            <div class="mx-2">
                              <a class="text-black fs-5"  href="{{route('productDetail',$item->productVariant->product->slug)}}"><strong>{{$item->product_name}}</strong></a><br>
                              <strong style="font-size: 13px"> {{$item->productVariant->sku}}</strong> <br>
                              <p style="font-size: 13px"> 
                              @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                                  @if ($variantAttribute->attribute->name == 'Size') 
                                      {{ $variantAttribute->attributeValue->value }}  ,
                                  @endif
                                @endforeach
                                @foreach ($item->productVariant->variantAttributes as $variantAttribute)
                                  @if ($variantAttribute->attribute->name == 'Color') 
                                    {{ $variantAttribute->attributeValue->value }}
                                  @endif
                                @endforeach
                              </p> 
                              </div>
                          </div>
                      </td>
                      <td class="text-center"><strong>{{$item->quantity}}</strong></td>
                      <td class="text-end">{{ number_format(($item->variant_price_sale  == 0? $item->variant_price_regular :  $item->variant_price_sale) * 1000, 0, ',', '.')}} đ</td>
                      <td class="text-end">{{number_format($item->quantity * ($item->variant_price_sale  == 0? $item->variant_price_regular :  $item->variant_price_sale) * 1000, 0, ',', '.')}} đ</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="3" class="text-end"><strong>Tổng đơn hàng:</strong></td>
                    <td class="text-end">{{number_format(($orderDetail->total_price + $orderDetail->discount) *1000, 0, ',', '.')}}đ</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-end"><strong>Giảm giá:</strong></td>
                    <td class="text-end">{{number_format(($orderDetail->discount) *1000, 0, ',', '.')}}đ</td>
                  </tr>
                  <tr class="table-active">
                    <td colspan="3" class="text-end"><strong>Tổng đã trả:</strong></td>
                    <td class="text-end">
                      <strong>
                          @if (!empty($paymentStatusMessage))
                            {{number_format(($orderDetail->total_price) *1000, 0, ',', '.')}} đ
                          @else
                            0 đ
                          @endif
                      </strong>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- END Products -->

        <!-- Log Messages -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
              <h3 class="block-title">Lịch sử</h3>
          </div>
          <div class="block-content">
              <div class="table-responsive">
                  <table class="table table-borderless table-striped table-vcenter fs-sm">
                      <tbody>
                          @if($statusChanges->isNotEmpty())
                              @foreach($statusChanges as $change)
                                  <tr>
                                      <td class="fs-base" style="width: 80px;">
                                          <span class="badge bg-primary">Đơn hàng</span>
                                      </td>
                                      <td style="width: 220px;">
                                          <span class="fw-semibold">{{ $change->created_at->format('F d, Y - H:i') }}</span>
                                      </td>
                                      <td>
                                          <a href="javascript:void(0)">{{ $change->user->name ?? 'Support' }}</a>
                                      </td>
                                      <td class="{{ $change->new_status == '4' ? 'text-success' : ($change->new_status == 'huy_don_hang' ? 'text-danger' : 'text-warning') }}">
                                          <strong>
                                              @if($change->new_status == '1')
                                                  Đơn hàng đã đặt thành công
                                              @elseif($change->new_status == '2')
                                                  Đơn hàng đã được xác nhận, đang chuẩn bị đơn hàng giao cho đơn vị vận chuyển
                                              @elseif($change->new_status == '3')
                                                  Đơn hàng đã được chuẩn bị giao cho đơn vị vận chuyển
                                              @elseif($change->new_status == '4')
                                                  Đơn hàng đã giao thành công 
                                              @elseif($change->new_status == 'huy_don_hang')
                                                  Đơn hàng đã bị hủy
                                              @endif
                                          </strong>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                          @if(!empty($paymentStatusMessage))
                                <tr>
                                  <td class="fs-base" style="width: 80px;">
                                      <span class="badge bg-success">Thanh toán</span>
                                  </td>
                                  <td style="width: 220px;">
                                      <span class="fw-semibold">{{ $orderDetail->updated_at->format('d-m-Y H:i') }}</span>
                                  </td>
                                  <td>
                                      <a href="javascript:void(0)">{{ $user->name}}</a>
                                  </td>
                                  <td class="text-success">
                                    
                                      <strong>{{ $paymentStatusMessage }}</strong>
                                    
                                  </td>
                                </tr>
                            @endif
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      
        <!-- END Log Messages -->
      </div>
      <!-- END Page Content -->
@endsection
