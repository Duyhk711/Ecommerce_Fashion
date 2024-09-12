@extends('layouts.client')

@section('content')
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing:  border-box;
    }
    body{
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
    }
    .contact-section{
        background-color: #ffffff;
        padding: 50px 20px;
    }
    .container{
        width: 80%;
        margin: 0 auto;
        max-width: 1200px;
        text-align: left;
    }
    .h1{
        
        font-size: 35px;
        color: #333;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    p{
        font-size: 20px;
        color: #333;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .contact-info{
        margin-bottom: 20px;
    }
    .contact-info strong{
        color: #333;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="contact-section">
        <div class="container">
            <h1>Liên hệ</h1>

            <p>Cảm ơn bạn đã ghé thăm trang web của chúng tôi. Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi qua các thông tin dưới đây:</p>

            <div class="contact-info">
                <p><strong>Địa chỉ:</strong> Phương Canh, Nam Từ Liêm, Hà Nội</p>
            </div>

            <div class="contact-info">
                <p><strong>Số điện thoại:</strong> +84 1234 6788</p>
            </div>

            <div class="contact-info">
                <p><strong>Email:</strong> Hema@fpt.edu.vn</p>
            </div>

            <div class="contact-info">
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6 hàng tuần vào lúc: 8:00 AM -5:00 PM</p>
            </div>

            <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn trong mọi thắc mắc hoặc yêu cầu. Vui lòng liên hệ với chúng tôi qua bất kỳ kênh nào thuận tiện nhất cho bạn.</p>
        </div>

    </section>
</body>
</html>
@endsection