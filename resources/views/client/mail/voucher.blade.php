<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông báo Voucher mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .voucher-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .voucher-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .voucher-code {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545;
        }
        .voucher-details {
            margin-bottom: 20px;
        }
        .voucher-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="voucher-card">
        <div class="voucher-header">
            <h2>Voucher Mới!</h2>
        </div>
        <p>Chào {{ $customer->name }},</p>
        <p>Chúng tôi vừa tạo một voucher mới dành cho bạn:</p>
        <div class="voucher-details">
            <p><strong>Mã voucher:</strong> <span class="voucher-code">{{ $voucher->code }}</span></p>
            <p><strong>Giá trị giảm:</strong> {{ $voucher->discount_type == 'percentage' ? $voucher->discount_value . '%' : number_format($voucher->discount_value, 3, '.') . ' ₫' }}</p>
            <p><strong></strong> {{ $voucher->description }} {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y H:i') }}</p>

        </div>
        <div class="voucher-button">
            <a href="http://fashion1.com/" class="btn btn-primary">Mua sắm ngay</a>
        </div>
        <p class="mt-3">Cảm ơn bạn đã chọn chúng tôi!</p>
    </div>
</body>
</html>
