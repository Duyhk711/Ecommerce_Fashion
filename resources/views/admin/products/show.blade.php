@extends('layouts.backend')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
@endsection
@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Chi tiết sản phẩm</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.products.index')}}" style="color: inherit;">Sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row gx-lg-5">
                                    <div class="col-xl-4 col-md-8 mx-auto">
                                        <div class="product-img-slider sticky-side-div">
                                            <!-- Main Image Slider -->
                                            <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                <div class="swiper-wrapper">
                                                    @foreach ($product->images as $image)
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('storage/' . $image->image) }}" 
                                                                 alt="Product Image" class="img-fluid d-block" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="swiper-button-next"></div>
                                                <div class="swiper-button-prev"></div>
                                            </div>
                                            <!-- end main image slider -->
                                        
                                            <!-- Thumbnail Navigation Slider -->
                                            <div class="swiper product-nav-slider mt-2">
                                                <div class="swiper-wrapper">
                                                    @foreach ($product->images as $image)
                                                        <div class="swiper-slide">
                                                            <div class="nav-slide-item">
                                                                <img src="{{ asset('storage/' . $image->image) }}" 
                                                                     alt="Thumbnail Image" class="img-fluid d-block" />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- end thumbnail navigation slider -->
                                        </div>
                                        
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-8">
                                        <div class="mt-xl-0 mt-5">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h4>{{$product->name}}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div class="text-muted">Ngày xuất bản : 
                                                            <span class="text-body fw-medium">{{ $product->created_at->format('d/m/Y') }}</span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div>
                                                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-light"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Chỉnh sửa"><i class="ri-pencil-fill align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                <div class="flex">
                                                    <div class="align-middle text-warning">
                                                        @for ($i = 0; $i < floor($averageRating); $i++)
                                                            <i class="ri-star-fill"></i>
                                                        @endfor
                                                        @if ($averageRating - floor($averageRating) > 0)
                                                            <i class="ri-star-half-fill"></i>
                                                        @endif
                                                        @for ($i = 0; $i < (5 - ceil($averageRating)); $i++)
                                                            <i class="ri-star-line"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="text-muted">( {{ number_format($averageRating, 1) }} )</div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success ">
                                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Giá gốc :</p>
                                                                <h5 class="mb-0">{{number_format($product->price_regular, 3, '.', 0)}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success ">
                                                                    <i class="ri-file-copy-2-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Số lượng đơn :</p>
                                                                <h5 class="mb-0">{{ $orderData->total_orders }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success ">
                                                                    <i class="ri-stack-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Số lượng sẵn có :</p>
                                                                <h5 class="mb-0">{{$totalStock}}</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success ">
                                                                    <i class="ri-inbox-archive-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Tổng doanh thu :</p>
                                                                <h5 class="mb-0">{{ number_format($orderData->total_revenue, 3, '.', 0) }}₫</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>

                                            <div class="row">
                                                 <!-- Hiển thị Color -->
                                                 <div class="col-xl-6">
                                                    <div class="mt-4">
                                                        <h6 class="">Màu sắc :</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @php
                                                                $displayedColors = []; 
                                                            @endphp
                                                            @foreach ($product->variants as $variant)
                                                                @foreach ($variant->variantAttributes as $attribute)
                                                                    @if ($attribute->attribute->slug === 'color' && !in_array($attribute->attributeValue->value, $displayedColors))
                                                                        @php
                                                                            $displayedColors[] = $attribute->attributeValue->value; // Thêm vào danh sách đã hiển thị
                                                                        @endphp
                                                                        <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                             data-bs-placement="top"
                                                                             title="{{ $attribute->attributeValue->value  }}">
                                                                            <button type="button" 
                                                                                    class="btn avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle text-{{ $attribute->attributeValue->color_code ?? 'primary' }}"
                                                                                    {{ $variant->stock <= 0 ? 'disabled' : '' }}
                                                                                    style="background-color: {{ $attribute->attributeValue->color_code }}">
                                                                                <i class="ri-checkbox-blank-circle-fill " style="color: #e3e5ed"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->

                                                <!-- Hiển thị Size -->
                                                <div class="col-xl-6">
                                                    <div class="mt-4">
                                                        <h6 class="">Kích cỡ :</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @php
                                                                $displayedSizes = []; 
                                                            @endphp
                                                            @foreach ($product->variants as $variant)
                                                                @foreach ($variant->variantAttributes as $attribute)
                                                                    @if ($attribute->attribute->slug === 'size' && !in_array($attribute->attributeValue->value, $displayedSizes))
                                                                        @php
                                                                            $displayedSizes[] = $attribute->attributeValue->value; 
                                                                        @endphp
                                                                       <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="">
                                                                        <input type="radio" class="btn-check" name="productsize-radio" id="productsize-radio-{{ $attribute->id }}" {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                                                        <label class="btn btn btn-alt avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center text-muted" for="productsize-radio-{{ $attribute->id }}" style="background-color:#e3e5ed; font-size:13px">
                                                                            {{ $attribute->attributeValue->value }}
                                                                        </label>
                                                                    </div>
                                                                    
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            
                                            <!-- end row -->

                                            <div class="mt-4 text-muted">
                                                <h5 class="">Mô tả :</h5>
                                                <p>{!!$product->description !!}</p>
                                            </div>

                                            <div class="product-content mt-5">
                                                <h5 class=" mb-3">Mô tả :</h5>
                                                <nav>
                                                    <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                                        role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="nav-speci-tab"
                                                                data-bs-toggle="tab" href="#nav-speci" role="tab"
                                                                aria-controls="nav-speci"
                                                                aria-selected="true">Đặc điểm</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab"
                                                                href="#nav-detail" role="tab"
                                                                aria-controls="nav-detail"
                                                                aria-selected="false">Chi tiết</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                                        aria-labelledby="nav-speci-tab">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row" style="width: 200px;">Category
                                                                        </th>
                                                                        <td>T-Shirt</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Brand</th>
                                                                        <td>Tommy Hilfiger</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Color</th>
                                                                        <td>Blue</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Material</th>
                                                                        <td>Cotton</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Weight</th>
                                                                        <td>140 Gram</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                                        aria-labelledby="nav-detail-tab">
                                                        <div>
                                                            <h5 class="font-size-16 mb-3">{{$product->name}}</h5>
                                                            <p>{!!$product->content!!}</p>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product-content -->

                                            <div class="mt-5">
                                                <div>
                                                    <h5 class=" mb-3">Xếp hạng và đánh giá</h5>
                                                </div>
                                                <div class="row gy-4 gx-0">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <div class="pb-3">
                                                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-grow-1">
                                                                            <div class="align-middle text-warning">
                                                                                @for ($i = 0; $i < floor($averageRating); $i++)
                                                                                    <i class="ri-star-fill"></i>
                                                                                @endfor
                                                                                @if ($averageRating - floor($averageRating) > 0)
                                                                                    <i class="ri-star-half-fill"></i>
                                                                                @endif
                                                                                @for ($i = 0; $i < (5 - ceil($averageRating)); $i++)
                                                                                    <i class="ri-star-line"></i>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0">
                                                                            <h6 class="mb-0">{{ number_format($averageRating, 1) }}</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <div class="text-muted">Total <span class="fw-medium">{{ number_format($totalReviews) }}</span> reviews</div>
                                                                </div>
                                                            </div>
                                                
                                                            @foreach ([5, 4, 3, 2, 1] as $stars)
                                                                <div class="mt-3">
                                                                    <div class="row align-items-center g-2">
                                                                        <div class="col-auto">
                                                                            <div class="p-2">
                                                                                <h6 class="mb-0">{{ $stars }} star</h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="p-2">
                                                                                <div class="progress animated-progress progress-sm">
                                                                                    <div class="progress-bar bg-success"
                                                                                         role="progressbar"
                                                                                         style="width: {{ $totalReviews > 0 ? ($ratingsCount[$stars] / $totalReviews * 100) : 0 }}%"
                                                                                         aria-valuenow="{{ $totalReviews > 0 ? ($ratingsCount[$stars] / $totalReviews * 100) : 0 }}"
                                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            <div class="p-2">
                                                                                <h6 class="mb-0 text-muted">{{ $ratingsCount[$stars] }}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-lg-8">
                                                        <div class="ps-lg-4">
                                                            <div class="d-flex flex-wrap align-items-start gap-3">
                                                                <h5 class="">Đánh giá: </h5>
                                                            </div>
                                                
                                                            <div class="me-lg-n3 pe-lg-4" data-simplebar style="max-height: 225px;">
                                                                <ul class="list-unstyled mb-0">
                                                                    @foreach ($comments as $comment)
                                                                        <li class="py-2">
                                                                            <div class="border border-dashed rounded p-3">
                                                                                <div class="d-flex align-items-start mb-3">
                                                                                    <div class="hstack gap-3">
                                                                                        <div class="badge rounded-pill bg-success mb-0">
                                                                                            <i class="mdi mdi-star"></i> {{ $comment->rating }}
                                                                                        </div>
                                                                                        <div class="vr"></div>
                                                                                        <div class="flex-grow-1">
                                                                                            <p class="text-muted mb-0">{{ $comment->comment }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                
                                                                                <div class="d-flex align-items-end">
                                                                                    <div class="flex-grow-1">
                                                                                        <h5 class="mb-0">{{  $comment->user_name }}</h5>
                                                                                    </div>
                                                
                                                                                    <div class="flex-shrink-0">
                                                                                        <p class="text-muted fs-13 mb-0">{{ \Carbon\Carbon::parse($comment->created_at)->format('d M, Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
<script src="{{asset('admin/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('admin/js/ecommerce-product-details.init.js')}}"></script>
@endsection
