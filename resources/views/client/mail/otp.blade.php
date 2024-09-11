<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Minh OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            margin-top: 0;
        }
        p {
            line-height: 1.6;
        }
        .otp {
            display: inline-block;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
            font-weight: bold;
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xác Minh OTP</h1>
        <p>Chào bạn,</p>
        <p>Mã OTP của bạn để đặt lại mật khẩu là:</p>
        <p class="otp">{{ $otp }}</p>
        <p>Mã OTP này hợp lệ trong vòng 5 phút.</p>
        <div class="footer">
            <p>Trân trọng,</p>
            <p>Đội ngũ hỗ trợ</p>
        </div>
    </div>
</body>
</html>
