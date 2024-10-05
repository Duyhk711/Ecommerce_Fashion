@extends('layouts.backend')

@section('css')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="{{asset('admin/js/plugins/simplemde/simplemde.min.css')}}">
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm mới sản phẩm</h1>
      <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.attributes.index') }}" style="color: inherit;">Quản lý sản phẩm</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Thêm mới sản phẩm</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- END Hero -->
<div class="content">
  <div class="block block-rounded">
    <div class="block-content">
      <div class="row">
        <div class="col-">
          <form action="" method="post">

            <!-- Tên sản phẩm -->
            <div class="mb-3">
              <label for="name" class="form-label">Tên sản phẩm</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm" required>
            </div>

            <div class="mb-3">
              <label class="form-label" for="example-select">Danh mục</label>
              <select class="form-select" id="example-select" name="example-select">
                <option selected="">Chọn danh mục</option>
                @foreach ($catalogues as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>

            <!-- sku -->
            <div class="mb-3">
              <label for="sku" class="form-label">Mã sản phẩm</label>
              <input type="text" class="form-control" name="sku" id="sku" value="{{$sku}}" readonly>
            </div>


            <div style="display: flex; ">
              <div style="margin-top: 20px;">
                <label class="form-label" for="main_image">Chọn ảnh chính:</label>
                <input type="file" id="main_image" name="main_image" accept="image/*">
                <div id="main-image-preview" style="margin-top: 10px;">
                  <!-- Ảnh chính sẽ được hiện lên ở đây -->
                </div>
              </div>

              <!-- Chọn ảnh phụ -->
              <div style="margin-top: 20px; margin-left: 50px ;">
                <label class="form-label" for="gallery_images">Chọn ảnh phụ:</label>
                <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                <div id="gallery-preview" style="margin-top: 10px;">
                  <!-- Các ảnh phụ sẽ được hiện lên ở đây -->
                </div>
              </div>
            </div>

            <div class="row">
              <!-- price regular -->
              <div class="col-6 mb-3">
                <label for="price_regular" class="form-label">Gia gốc</label>
                <input type="text" class="form-control" name="price_regular" id="price_regular">
              </div>
              <!-- price sale -->
              <div class="col-6 mb-3">
                <label for="price_sale" class="form-label">Gia ưu đãi</label>
                <input type="text" class="form-control" name="price_sale" id="price_sale">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Inline Switches</label>
              <div class="space-x-5">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="is_active" checked>
                  <label class="form-check-label" for="example-switch-inline1">Is active</label>
                </div>
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" value="" id="example-switch-inline2" name="is_new" checked>
                  <label class="form-check-label" for="example-switch-inline2">is_new</label>
                </div>

                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="is_hot_deal">
                  <label class="form-check-label" for="example-switch-inline1">is_hot_deal</label>
                </div>

                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="is_hot_deal">
                  <label class="form-check-label" for="example-switch-inline1">is_hot_deal</label>
                </div>
              </div>

            </div>



            <label for="" class="form-label">Thông tin</label>
            <div class="mb-4">
              <textarea class="js-maxlength form-control" id="description" name="description"
                rows="5" maxlength="150" placeholder="It even works on textareas.."
                data-always-show="true"></textarea>
            </div>

            {{-- mota --}}
            <label for="" class="form-label">Nội dung</label>
            <textarea name="content" id="editor"></textarea>
          </form>


        </div>
        <!-- Select để chọn thuộc tính -->
        <!-- <div class="col-4"> -->
        {{-- danh mục --}}
        <!-- <div class="mb-3">
          <label class="form-label" for="example-select">Danh mục</label>
          <select class="form-select" id="example-select" name="example-select">
            <option selected="">Chọn danh mục</option>
            @foreach ($catalogues as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
          </select>
        </div>
         <div class="mb-3">
          <label class="form-label">Inline Switches</label>
          <div class="space-x-5">
            <div class="form-check form-switch form-check-inline">
              <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="is_active" checked>
              <label class="form-check-label" for="example-switch-inline1">Is active</label>
            </div>
            <div class="form-check form-switch form-check-inline">
              <input class="form-check-input" type="checkbox" value="" id="example-switch-inline2" name="is_new" checked>
              <label class="form-check-label" for="example-switch-inline2">is_new</label>
            </div>
          </div>
          <div class="space-x-3">
            <div class="form-check form-switch form-check-inline">
              <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="is_hot_deal" >
              <label class="form-check-label" for="example-switch-inline1">is_hot_deal</label>
            </div>
            <div class="form-check form-switch form-check-inline">
              <input class="form-check-input" type="checkbox" value="" id="example-switch-inline2" name="is_show_home">
              <label class="form-check-label" for="example-switch-inline2">show home</label>
            </div>
          </div>
        </div>  -->

        <!-- Chọn ảnh chính -->
        <!-- <div style="display: flex; ">
        <div style="margin-top: 20px;">
            <label for="main_image">Chọn ảnh chính:</label>
            <input type="file" id="main_image" name="main_image" accept="image/*">
            <div id="main-image-preview" style="margin-top: 10px;"> -->
        <!-- Ảnh chính sẽ được hiện lên ở đây -->
        <!-- </div>
        </div> -->

        <!-- Chọn ảnh phụ -->
        <!-- <div style="margin-top: 20px;">
            <label for="gallery_images">Chọn ảnh phụ:</label>
            <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
            <div id="gallery-preview" style="margin-top: 10px;"> -->
        <!-- Các ảnh phụ sẽ được hiện lên ở đây -->
        <!-- </div>
        </div> -->
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>
<div class="block block-rounded">
  <div class="block-content">
    <div class="row">
      <div class="col">
        <!-- Vertical Block Tabs Default Style -->
        <div class="block block-rounded row g-0">
          <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-3" role="tablist">
            <li class="nav-item d-md-flex flex-md-column">
              <button class="nav-link text-md-start active" id="btabs-vertical-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-home" role="tab" aria-controls="btabs-vertical-home" aria-selected="true">
                <!-- Icon thuộc tính -->
                <i class="fa fa-fw fa-tags opacity-50 me-1 d-none d-sm-inline-block"></i> Thuộc tính
              </button>
            </li>
            <li class="nav-item d-md-flex flex-md-column">
              <button class="nav-link text-md-start" id="btabs-vertical-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-profile" role="tab" aria-controls="btabs-vertical-profile" aria-selected="false">
                <!-- Icon biến thể -->
                <i class="fa fa-fw fa-cogs opacity-50 me-1 d-none d-sm-inline-block"></i> Biến thể
              </button>
            </li>
          </ul>

          <div class="tab-content col-md-9">
            <div class="block-content tab-pane active" id="btabs-vertical-home" role="tabpanel" aria-labelledby="btabs-vertical-home-tab" tabindex="0">
              {{-- <h4 class="fw-semibold">Home Content</h4> --}}
              <label for="attributeSelect">Chọn thuộc tính</label>
              <select id="attributeSelect" class="form-control">
                <option value="">Thêm thuộc tính</option>
                <option value="color">Màu sắc</option>
                <option value="size">Size</option>
              </select>
              <!-- Vùng hiển thị Select2 động -->
              <div id="dynamicFields"></div>
              <button type="submit" class="btn btn-outline-primary" style="margin-top: 20px;">Save</button>
            </div>
            <div class="block-content tab-pane" id="btabs-vertical-profile" role="tabpanel" aria-labelledby="btabs-vertical-profile-tab" tabindex="0">
              <h4 class="fw-semibold">Profile Content</h4>
              <!-- <p class="fs-sm">
                Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt.
              </p> -->


              <div class="col-3">
                <!-- Chọn ảnh chính -->
                <div>
                  <label for="main_image">Chọn ảnh:</label>
                  <input type="file" id="main_image" name="main_image" accept="image/*">
                  <div id="main-image-preview" style="margin-top: 10px;">
                    <!-- Ảnh chính sẽ được hiện lên ở đây -->
                  </div>
                </div>



              </div>
              <br>
              <div class="col-12">
                <form action="" method="post">

                  <!-- Tên sản phẩm -->
                  <div class="mb-3">
                    <label for="name" class="form-label">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nhập mã sản phẩm" required>
                  </div>

                  <!-- sku -->
                  <div class="mb-3">
                    <label for="sku" class="form-label">Sku</label>
                    <input type="text" class="form-control" name="sku" id="sku" value="{{$sku}}" readonly>
                  </div>

                  <div class="row">
                    <!-- price regular -->
                    <div class="col-6 mb-2">
                      <label for="price_regular" class="form-label">Gía </label>
                      <input type="text" class="form-control" name="price_regular" id="price_regular" placeholder="Price">
                    </div>
                    <!-- price sale -->
                    <div class="col-6 mb-2">
                      <label for="price_sale" class="form-label">Gía ưu đãi</label>
                      <input type="text" class="form-control" name="price_sale" id="price_sale" placeholder="price sale">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="name" class="form-label">Lớp giao hàng</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                  </div>

                  <div class="mb-3">
                    <label for="name" class="form-label">Mô tả sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                  </div>

                  <button type="submit" class="btn btn-outline-primary" style="margin-top: 20px;">Lưu</button>
                </form>


              </div>


            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  <!-- END Vertical Block Tabs Default Style -->
</div>
</div>
</div>
</div>

</div>




@endsection
@section('js')
{{-- <script src="{{asset('js/dashmix.app.min.js')}}"></script> --}}
<script src="{{asset('admin/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>
<script>
  $(document).ready(function() {
    // Hàm xử lý khi thay đổi thuộc tính
    $('#attributeSelect').change(function() {
      var selectedValue = $(this).val();
      var dynamicFields = $('#dynamicFields');

      // Nếu đã chọn một thuộc tính thì tạo Select2 tương ứng
      if (selectedValue === 'color' && !$('#colorField').length) {
        // Tạo Select2 cho màu sắc
        dynamicFields.append(`
                <div id="colorField" class="attribute-field">
                    <label for="colorSelect">Màu sắc</label>
                    <select id="colorSelect" class="form-control" multiple="multiple">
                        <option value="red">Đỏ</option>
                        <option value="blue">Xanh dương</option>
                        <option value="green">Xanh lá</option>
                        <option value="yellow">Vàng</option>
                    </select>
                    <button type="button" class="remove-attribute btn btn-danger btn-sm">X</button>
                </div>
            `);

        // Khởi tạo Select2 cho màu sắc
        $('#colorSelect').select2({
          placeholder: "Chọn màu sắc",
          allowClear: true
        });
      } else if (selectedValue === 'size' && !$('#sizeField').length) {
        // Tạo Select2 cho size
        dynamicFields.append(`
                <div id="sizeField" class="attribute-field">
                    <label for="sizeSelect">Size</label>
                    <select id="sizeSelect" class="form-control" multiple="multiple">
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                    </select>
                    <button type="button" class="remove-attribute btn btn-danger btn-sm">X</button>
                </div>
            `);

        // Khởi tạo Select2 cho size
        $('#sizeSelect').select2({
          placeholder: "Chọn size",
          allowClear: true
        });
      }

      // Đặt lại giá trị của select box về mặc định
      $(this).val('');
    });

    // Hàm xử lý khi nhấn nút "X" để xóa thuộc tính
    $('#dynamicFields').on('click', '.remove-attribute', function() {
      $(this).parent().remove();
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const mainImageInput = document.getElementById('main_image');
    const galleryImagesInput = document.getElementById('gallery_images');
    const mainImagePreview = document.getElementById('main-image-preview');
    const galleryPreview = document.getElementById('gallery-preview');

    // Hiển thị ảnh chính khi chọn
    mainImageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          mainImagePreview.innerHTML = `
                    <h3>Ảnh chính:</h3>
                    <img src="${e.target.result}" alt="Ảnh chính" style="max-width: 100px; border: 2px solid green; border-radius: 8px;">
                `;
        };
        reader.readAsDataURL(file);
      } else {
        mainImagePreview.innerHTML = ''; // Xóa ảnh khi không chọn ảnh
      }
    });

    // Hiển thị ảnh phụ khi chọn
    galleryImagesInput.addEventListener('change', function() {
      galleryPreview.innerHTML = ''; // Xóa ảnh phụ cũ
      const files = this.files;

      for (const file of files) {
        const reader = new FileReader();
        reader.onload = function(e) {
          galleryPreview.innerHTML += `
                    <div style="display: inline-block; margin-right: 10px; margin-bottom: 10px;">
                        <img src="${e.target.result}" alt="Ảnh phụ" style="width: 100px;height:80px border: 1px solid gray; border-radius: 8px;">
                    </div>
                `;
        };
        reader.readAsDataURL(file);
      }
    });
  });
</script>

<script>
  // Khởi tạo CKEditor sau khi tải script
  CKEDITOR.replace('editor1');
</script>
@endsection