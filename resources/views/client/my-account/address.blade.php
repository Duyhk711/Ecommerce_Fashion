@extends('client.my-account')
@section('address')
<style>
    .pr-label-default {
    background-color: #28a745; /* Màu xanh cho nhãn mặc định */
    color: white;
    padding: 0.25em 0.5em;
    border-radius: 0.2em;
    font-size: 0.9em;
}
</style>
<div>
    <div class="address-card mt-0 h-100">
        <div class="top-sec d-flex justify-content-between mb-4">
            <h2 class="mb-0">Address Book</h2>
            <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewModal">
                <i class="icon anm anm-plus-r me-1"></i> Thêm mới
            </a>

            <!-- New Address Modal -->
            <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addNewModalLabel">Chi tiết địa chỉ</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addAddressForm" method="post" action="{{ route('addresses.store') }}">
                                @csrf
                                <div class="form-row row">
                                    <div class="form-group col-lg-6">
                                        <label for="customer-name">Họ và Tên Khách Hàng</label>
                                        <input name="customer_name" id="customer-name" type="text" class="form-control" placeholder="Họ và Tên Khách Hàng" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="customer-phone">Số điện thoại <span class="required">*</span></label>
                                        <input name="customer_phone" id="customer-phone" type="tel" class="form-control" placeholder="Số điện thoại" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="address-line1">Địa chỉ chính <span class="required">*</span></label>
                                        <input name="address_line1" id="address-line1" type="text" class="form-control" placeholder="Địa chỉ chính (Số nhà, tên đường)" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="address-line2">Địa chỉ phụ</label>
                                        <input name="address_line2" id="address-line2" type="text" class="form-control" placeholder="Địa chỉ phụ (nếu có)" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="ward">Phường/Xã <span class="required">*</span></label>
                                        <input name="ward" id="ward" type="text" class="form-control" placeholder="Phường/Xã" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="district">Quận/Huyện <span class="required">*</span></label>
                                        <input name="district" id="district" type="text" class="form-control" placeholder="Quận/Huyện" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="city">Tỉnh/Thành phố <span class="required">*</span></label>
                                        <input name="city" id="city" type="text" class="form-control" placeholder="Tỉnh/Thành phố" required />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="type">Loại địa chỉ <span class="required">*</span></label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">Chọn loại địa chỉ</option>
                                            <option value="home">Nhà riêng</option>
                                            <option value="office">Cơ quan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary m-0">Thêm địa chỉ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End New Address Modal -->
        </div>

        <div class="address-book-section">
            <div class="row g-4">
                @foreach($addresses as $address)
                <div class="address-select-box" data-id="{{ $address->id }}">
                    <div class="address-box bg-block">
                        <div class="top d-flex justify-content-between mb-3">
                            <h5 class="m-0">{{ $address->customer_name }}</h5>
                            <div class="product-labels start-auto end-0 d-flex flex-wrap">
                                @if($address->is_default)
                                    <span class="lbl pr-label-default me-2">Mặc định</span>
                                @endif
                                <span class="lbl {{ $address->type == 'home' ? 'pr-label1' : 'pr-label4' }}">
                                    {{ $address->type == 'home' ? 'Home' : 'Office' }}
                                </span>
                            </div>
                        </div>
                        <div class="middle">
                            <div class="address mb-2 text-muted">
                                <address class="m-0">
                                    {{ $address->address_line1 }}<br/>
                                    {{ $address->address_line2 }}<br/>
                                    {{ $address->ward }}, {{ $address->district }}, {{ $address->city }}.
                                </address>
                            </div>
                            <div class="number">
                                <p>Mobile: <a href="tel:{{ $address->customer_phone }}">{{ $address->customer_phone }}</a></p>
                            </div>
                        </div>
                        <div class="bottom d-flex justify-content-start gap-2">
                            <button type="button" class="bottom-btn btn btn-gray btn-sm" data-bs-toggle="modal" data-bs-target="#addEditModal">Sửa Địa Chỉ</button>
                            <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="removeAddress({{ $address->id }})">Xóa Địa Chỉ</button>
                            <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="setDefaultAddress({{ $address->id }})">Cài làm địa chỉ mặc đinh</button>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            <!-- Edit Address Modal -->
            <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addEditModalLabel">Edit Address details</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="edit-address-form" method="post" action="#">
                                <!-- Add form fields here -->
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary m-0">Save Address</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Edit Address Modal -->
        </div>
    </div>
</div>

<script>
    // Set Default Address
    function setDefaultAddress(addressId) {
        fetch(`/addresses/${addressId}/default`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Có lỗi xảy ra!');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Add Address
    document.getElementById('addAddressForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        fetch('{{ route('addresses.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tạo HTML cho địa chỉ mới
                let addressHtml = `
                    <div class="address-select-box">
                        <div class="address-box bg-block">
                            <div class="top d-flex justify-content-between mb-3">
                                <h5 class="m-0">${data.address.customer_name}</h5>
                                <span class="product-labels start-auto end-0">
                                    <span class="lbl ${data.address.type == 'home' ? 'pr-label1' : 'pr-label4'}">
                                        ${data.address.type == 'home' ? 'Home' : 'Office'}
                                    </span>
                                </span>
                            </div>
                            <div class="middle">
                                <div class="address mb-2 text-muted">
                                    <address class="m-0">
                                        ${data.address.address_line1}<br/>
                                        ${data.address.address_line2 ? data.address.address_line2 + '<br/>' : ''}
                                        ${data.address.ward}, ${data.address.district}, ${data.address.city}.
                                    </address>
                                </div>
                                <div class="number">
                                    <p>Mobile: <a href="tel:${data.address.customer_phone}">${data.address.customer_phone}</a></p>
                                </div>
                            </div>
                            <div class="bottom d-flex justify-content-start gap-2">
                                 <button type="button" class="bottom-btn btn btn-gray btn-sm" data-bs-toggle="modal" data-bs-target="#addEditModal">Sửa Địa Chỉ</button>
                                 <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="removeAddress(${data.address.id})">Xóa Địa Chỉ</button>
                                 <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="setDefaultAddress(${data.address.id})">Cài làm địa chỉ mặc đinh</button>
                            </div>
                        </div>
                    </div>
                `;
                document.querySelector('.address-book-section .row').innerHTML += addressHtml;
                let modal = bootstrap.Modal.getInstance(document.getElementById('addNewModal'));
                modal.hide();
            } else {
                alert('Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
            alert('Có lỗi xảy ra!');
        });
    });

    // Remove Address
    function removeAddress(addressId) {
    if (confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')) {
        fetch(`/addresses/${addressId}`, { // Đảm bảo rằng đường dẫn là chính xác
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Xóa địa chỉ khỏi DOM mà không reload
                document.querySelector(`.address-select-box[data-id="${addressId}"]`).remove();
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra!'); // Thông báo lỗi cho người dùng
        });
    }
}
</script>
@endsection
