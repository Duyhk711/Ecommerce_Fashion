@extends('client.my-account')
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

        .voucher-copy {
            width: 100px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: #0d6efd;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .voucher-copy:hover {
            background-color: #e0e7ff;
            color: #4c6ef5;
        }
    </style>
@endsection

@section('my-order')
    <div class="orders-card mt-0 h-100">
        <div class="top-sec d-flex justify-content-between mb-4">
            <h2 class="mb-0">Mã ưu đãi của bạn</h2>
        </div>
        <div class="container mt-5" id="saved-vouchers-container">

        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
    $.ajax({
        url: "{{ route('user.vouchers') }}",
        type: "GET",
        success: function(response) {
            let container = $('#saved-vouchers-container');
            container.empty();

            if (response.success) {
                let vouchers = response.vouchers;
                vouchers.forEach(voucher => {
                    container.append(`
                        <div class="voucher-card mb-4">
                            <div class="voucher-header">${voucher.description}</div>
                            <div class="voucher-code" id="voucher-code-${voucher.id}">${voucher.code}</div>
                            <div class="voucher-description">Giảm ${voucher.discount_type === 'percentage' ? voucher.discount_value + '%' : voucher.discount_value + 'K'} cho đơn hàng từ ${voucher.minimum_order_value ?? 0}K</div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="voucher-expiry">HSD: ${voucher.expiry_date}</div>
                                ${
                                voucher.is_used 
                                ? `<button class="voucher-copy used-button" disabled>Đã dùng</button>` 
                                : `<a href="{{ route('shop') }}">
                                   <button class="voucher-copy" onclick="copyCode('voucher-code-${voucher.id}')">Dùng ngay</button>
                               </a>`
                                }
                            </div>
                        </div>
                    `);
                });
            } else {
                container.append(`
                    <div class="text-center">
                        <img src="https://png.pngtree.com/png-vector/20220524/ourmid/pngtree-voucher-discount-png-image_4613299.png" alt="Chưa có voucher" class="img-fluid" style="max-width: 300px; margin: 20px auto;">
                        <h3 class="text-muted"> Bạn chưa lưu mã giảm giá nào.</h3>
                    </div>
                `);
            }
        },
        error: function() {
            alert('Không thể load dữ liệu voucher');
        }
    });
});


        function copyCode(voucherId) {
            const code = document.getElementById(voucherId).innerText;
            navigator.clipboard.writeText(code).then(() => {
                alert("Mã giảm giá đã được sao chép: " + code);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endsection
