@extends('layouts.client')
@section('css')
<style>
    .voucher-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .voucher-header {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .voucher-code {
        font-size: 14px;
        font-weight: bold;
        color: #2f415d;
        margin-top: 10px;
        padding: 6px;
        background-color: #A2D2DF;
        border-radius: 8px;
        text-align: center;
        width: fit-content;
    }

    .voucher-description {
        margin-top: 10px;
        font-size: 14px;
        color: #555;
    }

    .voucher-expiry {
        font-size: 12px;
        color: #999;
        margin-top: 10px;
    }

    .voucher-button {
        display: inline-block;
        padding: 10px 16px;
        background-color: #ff5722;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        font-weight: bold;
        margin-top: 16px;
        transition: background-color 0.3s ease;
    }

    .voucher-button:hover {
        background-color: #e64a19;
    }

    .voucher-copy {
        background-color: #2f415d;
        color: #ffffff;
        border: none;
        padding: 4px 8px;
        height: 30px;
        width: 80px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .voucher-copy:hover {
        background-color: #2f415d;
    }
    .voucher-save {
    background-color: #0084ff;
    color: #ffffff;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

/* Nút với trạng thái 'Đã lưu' */
.voucher-saved {
    background-color: ;
    border: 1px solid #0084ff;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: not-allowed;
    text-align: center;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

/* Nút với trạng thái 'Đã hết' */
.voucher-out-of-stock {
    background-color: #999;
    color: #ffffff;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: not-allowed;
    text-align: center;
    font-weight: bold;
}
</style>
@endsection

@section('content')
    @include('client.component.page_header')
    <div class="container mt-5">
        <div class="row vouchers">
            {{-- Voucher sẽ được load ở đây --}}
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        loadAllVouchers();
        var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        function loadAllVouchers() {
            $.ajax({
                url: '{{ route('vouchers.load.all') }}',
                method: 'GET',
                success: function(data) {
                    renderVouchers(data);
                },
                error: function(xhr) {
                    console.log('Có lỗi xảy ra:', xhr);
                }
            });
        }

        function renderVouchers(vouchers) {
    const voucherContainer = $('.vouchers');
    voucherContainer.empty();

    vouchers.forEach(voucher => {
        const isOutOfStock = voucher.is_out_of_stock;
        const isSaved = voucher.is_saved;

        // Xác định lớp CSS và nội dung nút dựa trên trạng thái của voucher
        let buttonClass, buttonText;
        if (isSaved) {
            buttonClass = 'voucher-saved';
            buttonText = 'Đã lưu';
        } else if (isOutOfStock) {
            buttonClass = 'voucher-out-of-stock';
            buttonText = 'Đã hết';
        } else {
            buttonClass = 'voucher-save';
            buttonText = 'Lưu';
        }

        const voucherCard = `
            <div class="col-md-4 mb-4">
                <div class="voucher-card">
                    <div class="voucher-header"> Voucher ${voucher.discount_value}K</div>
                    <div class="voucher-code">${voucher.code}</div>
                    <div class="voucher-description">
                        Giảm ${voucher.discount_value}K cho đơn hàng từ ${voucher.minimum_order_value ?? 0}K
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="voucher-expiry"> HSD: ${new Date(voucher.end_date).toLocaleDateString()}</div>
                        <div>
                            <button class="${buttonClass}" 
                                    data-code="${voucher.code}" 
                                    data-discount-type="${voucher.discount_type}" 
                                    data-discount-value="${voucher.discount_value}" 
                                    data-start-date="${voucher.start_date}" 
                                    data-end-date="${voucher.end_date}" 
                                    ${isSaved || isOutOfStock ? 'disabled' : ''}>
                                ${buttonText}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        voucherContainer.append(voucherCard);
    });

    // Xử lý sự kiện khi nhấn nút lưu
    $('.voucher-save').on('click', function(e) {
        e.preventDefault();
        if (!isAuthenticated) {
                    alert('Vui lòng đăng nhập để lưu voucher!');
                    return;
                }
        const button = $(this);
        const code = button.data('code');
        const discountType = button.data('discount-type');
        const discountValue = button.data('discount-value');
        const startDate = button.data('start-date');
        const endDate = button.data('end-date');

        $.ajax({
            url: '{{ route('save-voucher') }}',
            method: 'POST',
            data: {
                code: code,
                discount_type: discountType,
                discount_value: discountValue,
                start_date: startDate,
                end_date: endDate,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    loadAllVouchers(); // Tải lại voucher sau khi lưu thành công
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.log('Có lỗi xảy ra khi lưu voucher:', xhr);
            }
        });
    });
}


        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });
        const channel = pusher.subscribe('vouchers');
        channel.bind('voucher-out-of-stock', function(data) {
            loadAllVouchers();
        });
        channel.bind('voucher-saved', function(data) {
        loadAllVouchers();
    });
    });
</script>

@endsection
