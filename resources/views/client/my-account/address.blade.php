@extends('client.my-account')
@section('address')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
        .pr-label-default {
            background-color: #28a745;
            /* Màu xanh cho nhãn mặc định */
            color: white;
            padding: 0.25em 0.5em;
            border-radius: 0.2em;
            font-size: 0.9em;
        }
    </style>

    <div>
        <div class="address-card mt-0 h-100 mb-3">
            <div class="top-sec d-flex justify-content-between mb-4">
                <h2 class="mb-0">Địa chỉ nhận hàng</h2>
                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewModal">
                    <i class="icon anm anm-plus-r me-1"></i> Thêm mới
                </a>
            </div>
            <div>
                <div class="address-book-section">
                    <div class="row g-4">
                        @php
                            // Kiểm tra xem có địa chỉ nào không bị xóa không
                            $activeAddresses = $addresses->filter(function ($address) {
                                return $address->deleted_at === null;
                            });
                        @endphp

                        @if ($activeAddresses->isEmpty())
                            {{-- Hiển thị ảnh khi không có địa chỉ nào --}}
                            <div class="text-center" id="empty-address" style="margin: auto;">
                                <img src="{{ asset('client/images/empty-address.png') }}" alt="No address available">
                            </div>
                        @else
                            {{-- Hiển thị các địa chỉ không bị xóa --}}
                            @foreach ($activeAddresses as $address)
                                <div class="address-select-box" data-id="{{ $address->id }}">
                                    <div class="address-box bg-block">
                                        <div class="top d-flex justify-content-between mb-3">
                                            <h5 class="m-0">{{ $address->customer_name }}</h5>
                                            <div class="product-labels start-auto end-0 d-flex flex-wrap">
                                                @if ($address->is_default)
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
                                                    {{ $address->address_line1 }}<br />
                                                    {{ $address->address_line2 }}<br />
                                                    {{ $address->ward }}, {{ $address->district }}, {{ $address->city }}.
                                                </address>
                                            </div>
                                            <div class="number">
                                                <p>Mobile: <a href="tel:{{ $address->customer_phone }}">{{ $address->customer_phone }}</a></p>
                                            </div>
                                        </div>
                                        <div class="bottom d-flex justify-content-start gap-2">
                                            <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="editAddress({{ $address->id }})">Sửa Địa Chỉ</button>
                                            <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="removeAddress({{ $address->id }})">Xóa Địa Chỉ</button>
                                            @if (!$address->is_default)
                                                <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="setDefaultAddress({{ $address->id }})">Cài làm địa chỉ mặc định</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Edit Address Modal -->
        <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="addEditModalLabel">Sửa Địa Chỉ</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editAddressForm" method="post"
                            action="{{ route('addresses.update', $address->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="edit-address-id" value="">

                            <div class="form-row row">
                                <div class="form-group col-lg-6">
                                    <label for="edit-customer-name">Họ và Tên Khách Hàng</label>
                                    <input name="customer_name" id="edit-customer-name" type="text"
                                        class="form-control" placeholder="Họ và Tên Khách Hàng" required />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-customer-phone">Số điện thoại <span
                                            class="required">*</span></label>
                                    <input name="customer_phone" id="edit-customer-phone" type="tel"
                                        class="form-control" placeholder="Số điện thoại" required />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-address-line1">Địa chỉ chính <span
                                            class="required">*</span></label>
                                    <input name="address_line1" id="edit-address-line1" type="text"
                                        class="form-control" placeholder="Địa chỉ chính (Số nhà, tên đường)"
                                        required />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-address-line2">Địa chỉ phụ</label>
                                    <input name="address_line2" id="edit-address-line2" type="text"
                                        class="form-control" placeholder="Địa chỉ phụ (nếu có)" />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-city">Tỉnh/Thành phố <span class="required">*</span></label>
                                    <select name="city" id="edit-city" class="form-control" required>
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        <!-- Wards will be dynamically added here -->
                                    </select>

                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-district">Quận/Huyện <span class="required">*</span></label>
                                    <select name="district" id="edit-district" class="form-control" required>
                                        <option value="">Chọn Quận/Huyện</option>
                                        <!-- Districts will be dynamically added here -->
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-ward">Phường/Xã <span class="required">*</span></label>
                                    <select name="ward" id="edit-ward" class="form-control" required>
                                        <option value="">Chọn phường/xã</option>
                                        <!-- Cities will be dynamically added here -->
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-type">Loại địa chỉ <span class="required">*</span></label>
                                    <select name="type" id="edit-type" class="form-control" required>
                                        <option value="">Chọn loại địa chỉ</option>
                                        <option value="home">Nhà riêng</option>
                                        <option value="office">Cơ quan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-primary m-0">Lưu địa chỉ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Address Modal -->
        <!-- New Address Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="addNewModalLabel">Chi tiết địa chỉ</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addAddressForm" method="POST" action="{{ route('addresses.store') }}">
                            @csrf
                            <div class="form-row row">
                                <!-- Customer Name -->
                                <div class="form-group col-lg-6">
                                    <label for="customer-name">Họ và Tên Khách Hàng</label>
                                    <input name="customer_name" id="customer-name" type="text" class="form-control" placeholder="Họ và Tên Khách Hàng" required />
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group col-lg-6">
                                    <label for="customer-phone">Số điện thoại <span class="required">*</span></label>
                                    <input name="customer_phone" id="customer-phone" type="tel" class="form-control" placeholder="Số điện thoại" required />
                                </div>

                                <!-- Address Line 1 -->
                                <div class="form-group col-lg-6">
                                    <label for="address-line1">Địa chỉ chính <span class="required">*</span></label>
                                    <input name="address_line1" id="address-line1" type="text" class="form-control" placeholder="Địa chỉ chính (Số nhà, tên đường)" required />
                                </div>

                                <!-- Address Line 2 -->
                                <div class="form-group col-lg-6">
                                    <label for="address-line2">Địa chỉ phụ</label>
                                    <input name="address_line2" id="address-line2" type="text" class="form-control" placeholder="Địa chỉ phụ (nếu có)" />
                                </div>

                                <!-- City Selector -->
                                <div class="form-group col-lg-6">
                                    <label for="citis">Tỉnh/Thành phố <span class="required">*</span></label>
                                    <select name="city" id="citis" class="form-control" required>
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                        <!-- Cities will be dynamically added here -->
                                    </select>
                                </div>

                                <!-- District Selector -->
                                <div class="form-group col-lg-6">
                                    <label for="districts">Quận/Huyện <span class="required">*</span></label>
                                    <select name="district" id="districts" class="form-control" required>
                                        <option value="">Chọn Quận/Huyện</option>
                                        <!-- Districts will be dynamically added here -->
                                    </select>
                                </div>

                                <!-- Ward Selector -->
                                <div class="form-group col-lg-6">
                                    <label for="wards">Phường/Xã <span class="required">*</span></label>
                                    <select name="ward" id="wards" class="form-control" required>
                                        <option value="">Chọn Phường/Xã</option>
                                        <!-- Wards will be dynamically added here -->
                                    </select>
                                </div>

                                <!-- Address Type -->
                                <div class="form-group col-lg-6">
                                    <label for="type">Loại địa chỉ <span class="required">*</span></label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Chọn loại địa chỉ</option>
                                        <option value="home">Nhà riêng</option>
                                        <option value="office">Cơ quan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Submission -->
                            <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-primary m-0">Thêm địa chỉ</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- End New Address Modal -->

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

        // Hàm xóa địa chỉ
        function removeAddress(addressId) {
            if (confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')) {
                fetch(`/addresses/${addressId}`, {
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
                        let addressElement = document.querySelector(`.address-select-box[data-id="${addressId}"]`);
                        if (addressElement) {
                            addressElement.remove();
                        }
                        alert(data.message);

                        if (document.querySelectorAll('.address-select-box').length === 0) {
                            let emptyHtml = `
                                <div id="empty-address" class="text-center" style="margin: auto;">
                                    <img src="{{ asset('client/images/empty-address.png') }}" alt="No address available">
                                </div>
                            `;
                            document.querySelector('.address-book-section .row').innerHTML = emptyHtml;
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra!');
                });
            }
        }

        // Hàm sửa địa chỉ
        function editAddress(addressId) {
            fetch(`/address/${addressId}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById('edit-address-id').value = addressId;
                        document.getElementById('edit-customer-name').value = data.address.customer_name;
                        document.getElementById('edit-customer-phone').value = data.address.customer_phone;
                        document.getElementById('edit-address-line1').value = data.address.address_line1;
                        document.getElementById('edit-address-line2').value = data.address.address_line2;
                        document.getElementById('edit-type').value = data.address.type;

                        // Lưu trữ các giá trị đã chọn
                        selectedCity = data.address.city;
                        selectedDistrict = data.address.district;
                        selectedWard = data.address.ward;
                        console.log(selectedCity, selectedDistrict, selectedWard);

                        // Gọi lại API để tải danh sách thành phố, quận huyện và phường xã
                        axios.get("/address.json")
                            .then(function(result) {
                                renderCity(result.data);  // Gọi render lại thành phố
                            })
                            .catch(function(error) {
                                console.error("Lỗi khi tải dữ liệu:", error);
                            });

                        const form = document.getElementById('editAddressForm');
                        form.action = form.action.replace(/\/\d+$/, `/${addressId}`);

                        let modal = new bootstrap.Modal(document.getElementById('addEditModal'));
                        modal.show();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error.message);
                    alert('Có lỗi xảy ra!');
                });
        }


        // Xử lý khi DOM đã tải xong
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý thêm địa chỉ mới
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
                        // Ẩn ảnh "empty" nếu tồn tại
                        let emptyAddress = document.getElementById('empty-address');
                        if (emptyAddress) {
                            emptyAddress.style.display = 'none';
                        }

                        let currentDefault = document.querySelector('.address-select-box.default-address');
                        if (currentDefault) {
                            currentDefault.classList.remove('default-address');
                            // Xóa thông báo hoặc biểu tượng mặc định cũ nếu cần
                            let defaultLabel = currentDefault.querySelector('.default-label');
                            if (defaultLabel) defaultLabel.remove();
                        }

                        // Thêm địa chỉ mới vào danh sách
                        let addressHtml = `
                           <div class="address-select-box ${data.address.is_default ? 'default-address' : ''}" data-id="${data.address.id}">
                                <div class="address-box bg-block">
                                    <div class="top d-flex justify-content-between mb-3">
                                        <h5 class="m-0">${data.address.customer_name}</h5>
                                        <span class="product-labels start-auto end-0 d-flex flex-wrap">
                                             ${data.address.is_default ? '<span class="lbl pr-label-default me-2">Mặc định</span>' : ''}
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
                                            <p>Số điện thoại: <a href="tel:${data.address.customer_phone}">${data.address.customer_phone}</a></p>
                                        </div>
                                    </div>
                                    <div class="bottom d-flex justify-content-start gap-2">
                                        <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="editAddress(${data.address.id})">Sửa Địa Chỉ</button>
                                        <button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="removeAddress(${data.address.id})">Xóa Địa Chỉ</button>
                                        ${!data.address.is_default ? `<button type="button" class="bottom-btn btn btn-gray btn-sm" onclick="setDefaultAddress(${data.address.id})">Cài làm địa chỉ mặc định</button>` : ''}                                  </div>
                                    </div>
                            </div>
                        `;
                        document.querySelector('.address-book-section .row').innerHTML += addressHtml;

                        let modal = bootstrap.Modal.getInstance(document.getElementById('addNewModal'));
                        modal.hide();
                        document.getElementById('addAddressForm').reset();
                    } else {
                        alert('Có lỗi xảy ra!');
                    }
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Có lỗi xảy ra!');
                });
            });

            @if (session('success'))
                swal({
                    title: "Thành công!",
                    text: "{{ session('success') }}",
                    type: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                swal({
                    title: "Lỗi!",
                    text: "{{ session('error') }}",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let selectCity = "";
        let selectDistrict = "";
        let selectWard = "";

        axios.get("/address.json")
            .then(function(result) {
                loadCity(result.data);
                setDefaultValues();
            })
            .catch(function(error) {
                console.error("Lỗi khi tải dữ liệu:", error);
            });

        function loadCity(data) {
            citis.innerHTML = "<option value=''>Chọn Thành Phố</option>"; // Thêm tùy chọn mặc định
            data.forEach(city => {
                citis.options[citis.options.length] = new Option(city.Name, city.Name);
            });

            citis.onchange = function() {
                loadDistricts(data);
            };

            if (selectCity) {
                citis.value = selectedCity;
                citis.onchange(); // Cập nhật quận/huyện
            }
        }

        function loadDistricts(data) {
            districts.innerHTML = "<option value=''>Chọn Quận/Huyện</option>"; // Thêm tùy chọn mặc định
            wards.innerHTML = "<option value=''>Chọn Phường/Xã</option>"; // Thêm tùy chọn mặc định

            if (citis.value) {
                const cityData = data.find(n => n.Name === citis.value);
                if (cityData) {
                    cityData.Districts.forEach(district => {
                        districts.options[districts.options.length] = new Option(district.Name, district.Name);
                    });
                }
            }

            districts.onchange = function() {
                loadWards(data);
            };

            // Không tự động chọn quận/huyện
            districts.value = ""; // Đặt giá trị quận/huyện rỗng
            wards.value = ""; // Đặt giá trị phường/xã rỗng
        }

        function loadWards(data) {
            wards.innerHTML = "<option value=''>Chọn Phường/Xã</option>"; // Thêm tùy chọn mặc định

            const cityData = data.find(n => n.Name === citis.value);
            if (districts.value && cityData) {
                const districtData = cityData.Districts.find(d => d.Name === districts.value);
                if (districtData) {
                    districtData.Wards.forEach(ward => {
                        wards.options[wards.options.length] = new Option(ward.Name, ward.Name);
                    });
                }
            }

            // Không tự động chọn phường/xã
            wards.value = ""; // Đặt giá trị phường/xã rỗng
        }

        function setDefaultValues() {
            if (selectCity) {
                citis.value = selectedCity;
                citis.onchange(); // Cập nhật quận/huyện
            }
        }
    </script>

   <script>
    let selectedCity = "";
    let selectedDistrict = "";
    let selectedWard = "";

    axios.get("/address.json")
        .then(function(result) {
            renderCity(result.data); // Gọi hàm renderCity để hiển thị thành phố
            setDefaultValues(); // Cập nhật giá trị mặc định
        })
        .catch(function(error) {
            console.error("Lỗi khi tải dữ liệu:", error);
        });

    // Hàm render thành phố
    function renderCity(data) {
        const citySelect = document.getElementById('edit-city');
        citySelect.innerHTML = "<option value=''>Chọn Thành Phố</option>"; // Thêm tùy chọn mặc định

        // Thêm các thành phố vào dropdown
        data.forEach(city => {
            citySelect.options[citySelect.options.length] = new Option(city.Name, city.Name);
        });

        // Nếu đã có thành phố được chọn, đặt giá trị
        if (selectedCity) {
            citySelect.value = selectedCity;
            citySelect.onchange(); // Cập nhật các quận/huyện
        }

        // Sự kiện onchange cho thành phố
        citySelect.onchange = function() {
            updateDistricts(data); // Cập nhật quận/huyện khi chọn thành phố
        };
    }

    // Hàm cập nhật các quận/huyện
    function updateDistricts(data) {
        const citySelect = document.getElementById('edit-city');
        const districtSelect = document.getElementById('edit-district');
        const wardSelect = document.getElementById('edit-ward');

        districtSelect.innerHTML = "<option value=''>Chọn Quận/Huyện</option>"; // Thêm tùy chọn mặc định
        wardSelect.innerHTML = "<option value=''>Chọn Phường/Xã</option>"; // Thêm tùy chọn mặc định

        if (citySelect.value) {
            const cityData = data.find(n => n.Name === citySelect.value);
            if (cityData) {
                // Thêm các quận/huyện vào dropdown
                cityData.Districts.forEach(district => {
                    districtSelect.options[districtSelect.options.length] = new Option(district.Name, district.Name);
                });
            }
        }

        // Sự kiện onchange cho quận/huyện
        districtSelect.onchange = function() {
            updateWards(data); // Cập nhật phường/xã khi chọn quận/huyện
        };

        // Không tự động chọn quận/huyện
        districtSelect.value = ""; // Đặt giá trị quận/huyện rỗng
        wardSelect.value = ""; // Đặt giá trị phường/xã rỗng
    }

    // Hàm cập nhật các phường/xã
    function updateWards(data) {
        const citySelect = document.getElementById('edit-city');
        const districtSelect = document.getElementById('edit-district');
        const wardSelect = document.getElementById('edit-ward');

        wardSelect.innerHTML = "<option value=''>Chọn Phường/Xã</option>"; // Thêm tùy chọn mặc định

        const cityData = data.find(n => n.Name === citySelect.value);
        if (districtSelect.value && cityData) {
            const districtData = cityData.Districts.find(d => d.Name === districtSelect.value);
            if (districtData) {
                // Thêm các phường/xã vào dropdown
                districtData.Wards.forEach(ward => {
                    wardSelect.options[wardSelect.options.length] = new Option(ward.Name, ward.Name);
                });
            }
        }

        // Không tự động chọn phường/xã
        wardSelect.value = ""; // Đặt giá trị phường/xã rỗng
    }

    // Hàm set giá trị mặc định cho thành phố, quận/huyện, và phường/xã
    function setDefaultValues() {
    const citySelect = document.getElementById('edit-city');
    const districtSelect = document.getElementById('edit-district');
    const wardSelect = document.getElementById('edit-ward');

    // Nếu có thành phố đã chọn, thiết lập giá trị cho thành phố
    if (selectedCity) {
        citySelect.value = selectedCity;
        citySelect.onchange(); // Gọi onchange để cập nhật quận/huyện
    }

    // Nếu có quận/huyện đã chọn, thiết lập giá trị cho quận/huyện
    if (selectedDistrict) {
        districtSelect.value = selectedDistrict;
        districtSelect.onchange(); // Gọi onchange để cập nhật phường/xã
    }

    // Nếu có phường/xã đã chọn, thiết lập giá trị cho phường/xã
    if (selectedWard) {
        wardSelect.value = selectedWard; // Đặt giá trị cho phường/xã
    }
}
</script>

@endsection
