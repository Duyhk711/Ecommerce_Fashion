@extends('client.my-account')
@section('profile')
    <div>
        <div class="profile-card mt-0 h-100">
            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Profile</h2>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal"><i class="icon anm anm-plus-r me-1"></i> Edit</button>
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
                            <form class="edit-profile-form" method="post"
                                action="{{ route('profile.update', $currentUser->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12 mb-4 text-center">
                                        <div
                                            class="profileImg img-thumbnail shadow bg-white rounded-circle position-relative mx-auto">
                                            <img id="avatarPreview"
                                                src="{{ !empty($currentUser->avatar) ? asset('storage/' . $currentUser->avatar) : asset('client/images/users/default-avatar.jpg') }}"
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
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary m-0"><span>Lưu thông tin</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End Edit Profile Modal -->

            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Login details</h2>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editLoginModal"><i class="icon anm anm-plus-r me-1"></i> Edit</button>
            </div>
            <div class="profile-login-section">
                <div class="details d-flex align-items-center mb-2">
                    <div class="left">
                        <h6 class="mb-0 body-font fw-500">Email address</h6>
                    </div>
                    <div class="right">
                        <p>{{ $currentUser->email }}</p>
                    </div>
                </div>
                <div class="details d-flex align-items-center mb-2">
                    <div class="left">
                        <h6 class="mb-0 body-font fw-500">Phone number</h6>
                    </div>
                    <div class="right">
                        <p>{{ $currentUser->phone }}</p>
                    </div>
                </div>
              
            </div>

            <!-- Edit Login details Modal -->
            <div class="modal fade" id="editLoginModal" tabindex="-1" aria-labelledby="editLoginModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="editLoginModalLabel">Edit Login details</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="edit-Loginprofile-from" method="post" action="#">
                                <div class="form-row row-cols-lg-1 row-cols-md-1 row-cols-sm-1 row-cols-1">
                                    <div class="form-group">
                                        <label for="editLogin-Emailaddress" class="d-none">Email address <span
                                                class="required">*</span></label>
                                        <input name="editLogin-Emailaddress" placeholder="Email address" value=""
                                            id="editLogin-Emailaddress" type="email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="editLogin-Phonenumber" class="d-none">Phone number <span
                                                class="required">*</span></label>
                                        <input name="editLogin-Phonenumber" placeholder="Phone number" value=""
                                            id="editLogin-Phonenumber" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <label for="editLogin-Password" class="d-none">Current Password <span
                                                class="required">*</span></label>
                                        <input name="editLogin-Password" placeholder="Current Password" value=""
                                            id="editLogin-Password" type="password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="editLogin-NewPassword" class="d-none">New Password <span
                                                class="required">*</span></label>
                                        <input name="editLogin-NewPassword" placeholder="New Password" value=""
                                            id="editLogin-NewPassword" type="password" />
                                        <small class="form-text text-muted">Your password must be 8-20 characters long,
                                            contain letters and numbers, and must not contain spaces, special
                                            characters.</small>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="editLogin-Verify" class="d-none">Verify <span
                                                class="required">*</span></label>
                                        <input name="editLogin-Verify" placeholder="Verify" value=""
                                            id="editLogin-Verify" type="text" />
                                        <small class="form-text text-muted">To confirm, type the new password
                                            again.</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary m-0"><span>Save changes</span></button>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection
