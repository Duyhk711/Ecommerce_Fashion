@extends('layouts.backend')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
  <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center ">
          <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách Sản Phẩm</h1>
          <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="#" style="color: inherit;">Sản phẩm</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách Sản Phẩm</li>
              </ol>
          </nav>
      </div>
  </div>
</div>
<!-- END Hero -->

<div class="content ">
  <!-- Dynamic Table Full -->
  <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h3 class="block-title">Danh sách Sản Phẩm</h3>
          <div class="block-options">
              <div class="block-options-item">
                  <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Add">
                      <i class="fa fa-plus"></i>
                  </a>
              </div>
          </div>
      </div>
      <div class="block-content block-content-full">
          <!-- Table with data -->
          <table id="example" class="table table-hover align-middle js-dataTable-full">
            <thead>
              <tr>
                  <th>Tên sản phẩm</th>
                  <th>Danh mục</th>
                  <th>SKU</th>
                  <th>Giá</th>
                  <th>Giá khuyến mãi</th>
                  <th>Ảnh</th>
                  <th>Trạng thái</th>
                  <th class="text-center">Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                  <tr>
                      <td  class="fs-sm">{{ $product->name }}</td>
                      <td class="fs-sm">{{ $product->catalogue->name }}</td>
                      <td class="fs-sm">{{ $product->sku }}</td>
                      <td class="fs-sm">{{ number_format($product->price_regular) }}₫</td>
                      <td class="fs-sm">{{ $product->price_sale ? number_format($product->price_sale) . '₫' : 'Không có' }}</td>
                      <td class="fs-sm">
                          @if ($product->mainImage)
                              <img src="{{ asset('storage/' . $product->mainImage->image) }}" alt="Ảnh sản phẩm"
                                  style="width: 50px; height: auto;">
                          @else
                              <span>Chưa có ảnh</span>
                          @endif
                      </td>
                      <td class="fs-sm">
                          @if ($product->is_active)
                              <span class="badge bg-success">Đang hoạt động</span>
                          @else
                              <span class="badge bg-danger">Không hoạt động</span>
                          @endif
                      </td>
                      <td class="text-center fs-sm">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-alt-secondary mx-1" data-bs-toggle="tooltip" title="Biến thể">
                                <i class="fa fa-fw fa-tags" title="Biến thể"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-alt-secondary mx-1" data-bs-toggle="tooltip" title="Sửa">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-alt-secondary mx-1" data-bs-toggle="tooltip" title="Xóa">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                  </tr>
                  <!-- Biến thể sản phẩm -->
                  {{-- <tr id="variants-{{ $product->id }}" class="collapse">
                      <td colspan="8">
                          <table class="table table-bordered mb-0">
                              <thead>
                                  <tr>
                                      <th>SKU biến thể</th>
                                      <th>Giá biến thể</th>
                                      <th>Giá khuyến mãi biến thể</th>
                                      <th>Kho</th>
                                      <th>Ảnh biến thể</th>
                                      <th>Thuộc tính</th>
                                      <th>Hành động</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($product->variants as $variant)
                                      <tr>
                                          <td>{{ $variant->sku }}</td>
                                          <td>{{ number_format($variant->price_regular) }}₫</td>
                                          <td>{{ $variant->price_sale ? number_format($variant->price_sale) . '₫' : 'Không có' }}</td>
                                          <td>{{ $variant->stock }}</td>
                                          <td>
                                              @if ($variant->image)
                                                  <img src="{{ asset('storage/' . $variant->image) }}" alt="Ảnh biến thể"
                                                      style="width: 50px; height: auto;">
                                              @else
                                                  <span>Chưa có ảnh</span>
                                              @endif
                                          </td>
                                          <td>
                                              @foreach ($variant->variantAttributes as $attribute)
                                                  <strong>{{ $attribute->attribute->name }}:</strong>
                                                  {{ $attribute->attributeValue->value }}<br>
                                              @endforeach
                                          </td>
                                          <td>
                                              <a href="" class="btn btn-sm btn-alt-secondary"><i class="fa fa-pencil-alt"></i></a>
                                              <form action="" method="POST" class="d-inline-block">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn btn-sm btn-alt-secondary"><i class="fa fa-fw fa-times text-danger"></i></button>
                                              </form>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </td>
                  </tr> --}}
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>

@endsection

@section('js')
  <!-- Include jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize DataTable
      $('#example').DataTable({
          paging: true,         // Enable pagination
          searching: true,      // Enable searching
          ordering: true,       // Enable column ordering
          lengthMenu: [10, 25, 50, 100],  // Set options for page length
          pageLength: 10        // Default page length
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const deleteBtns = document.querySelectorAll('.form-delete');
  
          for (const btn of deleteBtns) {
              btn.addEventListener('submit', function(e) {
                  e.preventDefault();
  
                  Swal.fire({
                      title: "Xác nhận xóa?",
                      text: "Nếu xóa bạn sẽ không thể khôi phục!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Đồng ý',
                      cancelButtonText: 'Hủy'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          this.submit();
                      }
                  });
              });
          }
      });
  </script>
  
@endsection
