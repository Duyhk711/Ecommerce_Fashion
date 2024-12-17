@extends('client.my-account')
@section('profile')
    <div>
        <div class="profile-card mt-0 h-100">
            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Thông tin cá nhân</h2>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal"><i class="icon anm anm-plus-r me-1"></i> Chỉnh sửa</button>
            </div>
            <div class="profile-book-section mb-4">
                <div class="details d-flex align-items-center mb-2">
                    <div class="left">
                        <h6 class="mb-0 body-font fw-500">Tên</h6>
                    </div>
                    <div class="right">
                        <p>{{ $currentUser->name }}</p>
                    </div>
                </div>
                <div class="details d-flex align-items-center mb-2">
                    <div class="left">
                        <h6 class="mb-0 body-font fw-500">Địa chỉ email</h6>
                    </div>
                    <div class="right">
                        <p>{{ $currentUser->email }}</p>
                    </div>
                </div>
                <div class="details d-flex align-items-center mb-2">
                    <div class="left">
                        <h6 class="mb-0 body-font fw-500">Số điện thoại</h6>
                    </div>
                    <div class="right">
                        <p>{{ $currentUser->phone }}</p>
                    </div>
                </div>
                @if ($defaultAddress)
                    <div class="details d-flex align-items-center mb-2">
                        <div class="left">
                            <h6 class="mb-0 body-font fw-500">Thành Phố</h6>
                        </div>
                        <div class="right">
                            <p>{{ $defaultAddress->city }}</p>
                        </div>
                    </div>
                    <div class="details d-flex align-items-center mb-2">
                        <div class="left">
                            <h6 class="mb-0 body-font fw-500">Quận/Huyện</h6>
                        </div>
                        <div class="right">
                            <p>{{ $defaultAddress->district }}</p>
                        </div>
                    </div>
                    <div class="details d-flex align-items-center mb-2">
                        <div class="left">
                            <h6 class="mb-0 body-font fw-500">Phường/Xã</h6>
                        </div>
                        <div class="right">
                            <p>{{ $defaultAddress->ward }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="details d-flex align-items-center mb-2">
                        <div class="left">
                            <h6 class="mb-0 body-font fw-500">Ngày tạo tài khoản</h6>
                        </div>
                        <div class="right">
                            <p>{{ $currentUser->created_at }}</p>
                        </div>
                    </div>
            </div>
            <!-- Edit Profile Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="editProfileModalLabel">Chỉnh sửa thông tin hồ sơ</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editProfileForm" class="edit-profile-form" method="post"
                            action="{{ route('profile.update', $currentUser->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <!-- Hình ảnh đại diện -->
                                <div class="form-group col-12 mb-4 text-center">
                                    <!-- Avatar Section -->
                                    <div
                                        class="profileImg img-thumbnail shadow bg-white rounded-circle position-relative mx-auto">
                                        <img id="avatarPreview"
                                            src="{{ !empty($currentUser->avatar_url) ? $currentUser->avatar_url : asset('client/images/users/default-avatar.jpg') }}"
                                            class="rounded-circle" alt="profile"
                                            style="width: 130px; height: 130px; object-fit: cover;" />
                                        <div class="thumb-edit">
                                            <label for="profileUpload"
                                                class="d-flex justify-content-center position-absolute top-0 start-100 translate-middle p-2 rounded-circle shadow btn btn-secondary mt-3"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa">
                                                <i class="icon anm anm-pencil-ar an-1x"></i>
                                            </label>
                                            <input name="avatar" type="file" id="profileUpload"
                                                class="image-upload d-none" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Các trường thông tin khác -->
                                <div class="form-group col-12 mb-3">
                                    <input name="name" placeholder="Họ và Tên" value="{{ $currentUser->name }}"
                                        id="editProfile-Name" type="text" class="form-control" required />
                                </div>
                                <div class="form-group col-12 mb-3">
                                    <input name="email" placeholder="Địa chỉ Email" value="{{ $currentUser->email }}"
                                        id="editProfile-Emailaddress" type="email" class="form-control" required />
                                </div>
                                <div class="form-group col-12 mb-3">
                                    <input name="phone" placeholder="Số điện thoại" value="{{ $currentUser->phone }}"
                                        id="editProfile-Phonenumber" type="text" class="form-control" required />
                                    <small id="phoneError" class="text-danger" style="display: none;">Số điện thoại không hợp lệ. Vui lòng nhập lại.</small>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="submit" id="submitBtn" class="btn btn-primary m-0" disabled><span>Lưu thông tin</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            <!-- End Edit Profile Modal -->
            <!-- End Edit Login details Modal -->
        </div>
    </div>
    <script>
        document.getElementById('profileUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.getElementById('profileUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('editProfile-Phonenumber').addEventListener('input', function (event) {
            const phoneInput = event.target;
            const phoneError = document.getElementById('phoneError');
            const submitBtn = document.getElementById('submitBtn');
            const phoneRegex = /^(0[3|5|7|8|9])\d{8}$/; // Regex cho số điện thoại Việt Nam

            if (!phoneRegex.test(phoneInput.value)) {
                phoneError.style.display = 'block';
                phoneInput.classList.add('is-invalid');
                submitBtn.disabled = true;  // Vô hiệu hóa nút lưu
            } else {
                phoneError.style.display = 'none';
                phoneInput.classList.remove('is-invalid');
                submitBtn.disabled = false;  // Bật lại nút lưu
            }
        });
    </script>

@endsection
