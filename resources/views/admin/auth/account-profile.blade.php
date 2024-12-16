@extends('layouts.backend')

@section('content')
<main id="main-container">

  <!-- Page Content -->
  <div class="content content-full content-boxed">
    <!-- Hero -->
    <div class="rounded border overflow-hidden push">
      <div class="bg-image pt-9" style="background-image: url('assets/media/photos/photo19@2x.jpg');"></div>
      <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
        <a class="d-block img-link mt-n5" href="be_pages_generic_profile_v2.html">
          <img class="img-avatar img-avatar128 img-avatar-thumb" src="{{ Storage::url( Auth::user()->avatar) }}" alt="" id="user-avatar">
        </a>
        <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">

          @if(Auth::check())
                  <h1 class="fs-4 fw-bold mb-1">{{ Auth::user()->name }}</h1>
          @endif
          <h2 class="fs-sm fw-medium text-muted mb-0">
            Edit Account
          </h2>
        </div>
        <div class="space-x-1">
          {{-- <a href="be_pages_generic_profile_v2.html" class="btn btn-sm btn-alt-secondary space-x-1">
            <i class="fa fa-arrow-left opacity-50"></i>
            <span>Back to Profile</span>
          </a> --}}
        </div>
      </div>
    </div>
    <!-- END Hero -->

    <!-- Edit Account -->
    <div class="block block-bordered block-rounded">
      <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
        <li class="nav-item">
          <button class="nav-link space-x-1 active" id="account-profile-tab" data-bs-toggle="tab" data-bs-target="#account-profile" role="tab" aria-controls="account-profile" aria-selected="true">
            <i class="fa fa-user-circle d-sm-none"></i>
            <span class="d-none d-sm-inline">Hồ sơ</span>
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link space-x-1" id="account-password-tab" data-bs-toggle="tab" data-bs-target="#account-password" role="tab" aria-controls="account-password" aria-selected="false">
            <i class="fa fa-asterisk d-sm-none"></i>
            <span class="d-none d-sm-inline">Mật khẩu</span>
          </button>
        </li>
      </ul>
      <div class="block-content tab-content">
        <div class="tab-pane active" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab" tabindex="0">
          <div class="row push p-sm-2 p-lg-4">
            <div class="offset-xl-1 col-xl-4 order-xl-1">
              <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                Thông tin quan trọng của tài khoản của bạn. Tên người dùng của bạn sẽ được hiển thị công khai.
              </p>
            </div>
            <div class="col-xl-6 order-xl-0">
              <form id="updateProfileForm"  enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                  <label class="form-label" for="dm-profile-edit-username">Tên tài khoản</label>
                  <input type="text" class="form-control" id="dm-profile-edit-username" name="name" placeholder="Enter your username.." value="{{ Auth::user()->name }}">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label" for="dm-profile-edit-email">Email</label>
                  <input type="email" class="form-control" id="dm-profile-edit-email" name="email" placeholder="Enter your email.." value="{{ Auth::user()->email }}">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label" for="dm-profile-edit-tel">Số điện thoại</label>
                  <input type="text" class="form-control" id="dm-profile-edit-email" name="phone" placeholder="Enter your số điện thoại.." value="{{ Auth::user()->phone }}">
                  @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <img id="avatar-preview" src="#" alt="Ảnh đại diện đã chọn" style="max-width: 200px; display: none;" />
                </div>
                <div class="mb-4">
                  <label class="form-label" for="dm-profile-edit-avatar">Ảnh đại diện</label>
                  <input type="file" class="form-control" id="dm-profile-edit-avatar" name="avatar" accept="image/*" onchange="previewAvatar()">
                  @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-alt-primary">
                  <i class="fa fa-check-circle opacity-50 me-1"></i> Cập nhật hồ sơ
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="account-password" role="tabpanel" aria-labelledby="account-password-tab" tabindex="0">
          <div class="row push p-sm-2 p-lg-4">
            <div class="offset-xl-1 col-xl-4 order-xl-1">
              <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                Thay đổi mật khẩu đăng nhập là cách dễ dàng để giữ an toàn cho tài khoản của bạn.
              </p>
            </div>
            <div class="col-xl-6 order-xl-0">
              <form id="updatePasswordForm" >
                @csrf
                <div class="mb-4">
                    <label class="form-label" for="dm-profile-edit-password">Mật khẩu cũ</label>
                    <input type="password" class="form-control" id="dm-profile-edit-password" name="current_password" >
                    @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label" for="dm-profile-edit-password-new">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new" name="new_password" >
                    </div>
                    @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label" for="dm-profile-edit-password-new-confirm">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new-confirm" name="new_password_confirmation" >
                    </div>
                    @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-alt-primary">
                    <i class="fa fa-check-circle opacity-50 me-1"></i> Cập nhật mật khẩu
                </button>
            </form>

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- END Edit Account -->
  </div>

</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function previewAvatar() {
    const avatarInput = document.getElementById('dm-profile-edit-avatar');
    const preview = document.getElementById('avatar-preview');

    if (avatarInput.files && avatarInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(avatarInput.files[0]);
    } else {
        preview.src = '#';  // Reset preview image
        preview.style.display = 'none'; // Hide the preview
    }
}
  </script>
  <script>
    $(document).ready(function() {
    // Xóa thông báo lỗi cũ
    function clearErrors() {
        $('.text-danger').remove(); // Xóa các thẻ span chứa lỗi cũ
    }

    // Hiển thị lỗi tại các trường input tương ứng
    function displayErrors(errors) {
        for (let field in errors) {
            if (errors.hasOwnProperty(field)) {
                const input = $('[name="' + field + '"]');
                input.after('<span class="text-danger">' + errors[field][0] + '</span>'); // Hiển thị lỗi dưới trường input
            }
        }
    }

    // Cập nhật hồ sơ
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault();
        clearErrors(); // Xóa lỗi cũ trước khi submit

        const formData = new FormData(this);

        $.ajax({
            url: '/admin/profile/update',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Cập nhật thành công!');
                $('#user-avatar').attr('src', response.avatar);
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors || {};
                displayErrors(errors); // Hiển thị lỗi nếu có
            }
        });
    });

    // Cập nhật mật khẩu
    $('#updatePasswordForm').on('submit', function(e) {
        e.preventDefault();
        clearErrors(); // Xóa lỗi cũ trước khi submit

        const formData = $(this).serialize();

        $.ajax({
            url: '/admin/profile/update-password',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Mật khẩu đã được cập nhật thành công!');
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors || {};
                displayErrors(errors); // Hiển thị lỗi nếu có
            }
        });
    });
});

    </script>
@endsection
