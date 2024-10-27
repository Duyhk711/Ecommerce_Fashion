@extends('client.my-account')
@section('account-info')
<div class="tab-pane fade h-100 show active" id="info">
    <div class="account-info h-100">
        <div class="welcome-msg mb-4">
            <h2>Xin chào, <span class="text-primary">{{ $currentUser->name }}</span></h2>
        </div>

        <div class="row g-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 row-cols-1 mb-4">
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{ asset('client/images/icons/sale.png') }}"
                        src="{{ asset('client/images/icons/sale.png') }}" alt="icon" width="64"
                        height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">{{ $totalOrder }}</h3>
                        <p>Tổng số đơn hàng</p>
                    </div>
                </div>
            </div>
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{ asset('client/images/icons/homework.png') }}"
                        src="{{ asset('client/images/icons/homework.png') }}" alt="icon" width="64"
                        height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">{{$getTotalOrdersPending}}</h3>
                        <p>Đơn hàng đang xử lí</p>
                    </div>
                </div>
            </div>
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{ asset('client/images/icons/order.png') }}"
                        src="{{ asset('client/images/icons/order.png') }}" alt="icon" width="64"
                        height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">{{$getTotalOrdersSucess}}</h3>
                        <p>Đơn hàng đã nhận</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="account-box">
            <h3 class="mb-3">Thông tin tài khoản</h3>
            <div class="box-info mb-4">
                <div class="box-title d-flex-center">
                    <h4>Thông tin liên hệ</h4>
                    <a href="{{ route('profile') }}" class="btn-link ms-auto">Chỉnh sửa</a>
                </div>
                <div class="box-content mt-3">
                    <h5>Tên: {{ $currentUser->name }}</h5>
                    <p class="mb-2">Email: {{ $currentUser->email }}</p>
                    <p class="mb-2">Số điện thoại: {{ $currentUser->phone }}</p>
                    <p><a href="#" class="btn-link" data-bs-toggle="modal"
                            data-bs-target="#changePasswordModal">Đổi mật khẩu</a></p>
                </div>
            </div>
        </div>

        <!-- Modal Đổi Mật Khẩu -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm" action="{{ route('update-password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="modalAlertContainer"></div>

                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                name="new_password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="box-info mb-4">
            <div class="box-title d-flex-center">
                <h4>Địa chỉ</h4>
                <a href="{{ route('address') }}" class="btn-link ms-auto">Chỉnh sửa</a>
            </div>
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
                @if ($defaultAddress)
                    <div class="box-content mt-3">
                        <h5>Địa chỉ mặc định:</h5>
                        <address>
                            {{ $defaultAddress->address_line1 }}<br>
                            {{ $defaultAddress->address_line2 }}<br>
                            {{ $defaultAddress->ward }}, {{ $defaultAddress->district }},
                            {{ $defaultAddress->city }}<br>
                            <p>Mobile: <a
                                    href="tel:{{ $defaultAddress->customer_phone }}">{{ $defaultAddress->customer_phone }}</a>
                            </p>
                        </address>
                    </div>
                @else
                    <div class="box-content mt-3">
                        <h5>Địa chỉ giao hàng mặc định</h5>
                        <p class="mb-2">Bạn chưa thiết lập địa chỉ giao hàng mặc định.</p>
                        <p><a href="{{ route('address') }}" class="btn-link">Chỉnh sửa địa chỉ</a></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-Token': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: data.message,
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#3085d6',
            }).then(() => {
                location.reload();
            });
        } else {
            let alertContainer = document.getElementById('modalAlertContainer');
            alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection
