@extends('layouts.client')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
    }

    .contact-section {
        background-color: #ffffff;
        padding: 50px 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        max-width: 1200px;
        text-align: center;
    }

    .faq-section {
        background-color: #ffffff;
        padding: 50px 0;
    }

    .faq-item {
        margin-bottom: 10px;
        margin-bottom: 1px soild #ddd;
        padding: 10px 0;
    }

    .faq-question {
        background-color: white;
        color: black;
        width: 100%;
        text-align: left;
        padding: 15px;
        font-size: 20px;
        border: none;
        outline: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .faq-question:hover {
        background-color: white;
    }

    .faq-answer {
        display: none;
        padding: 15px;
        background-color: #f1f1f1;
        font-size: 14px;
        line-height: 1.5;
    }

    .faq-answer p {
        margin: 0;
        font-size: 20px;
    }

    hr {
        border: none;
        background-color: black;
        margin: 20px 0;
    }

    .search {
        display: flex;
        justify-content: center;
        text-align: center;
        margin-bottom: 15px;
        margin-top: 10px;
    }

    .search-input {
        width: 50%;
        padding: 10px;
        font-size: 20px;
        border-radius: 20px 0 0 20px;
        outline: none;
        border-right: none;
    }

    .search-button {
        padding: 10px 20px;
        font-size: 13px;
        border-radius: 0 20px 20px 0;
        border-left: none;
        outline: none;
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
    <section class="faq-section">
        <div class="container">

            <div class="search">
                <input type="text" placeholder="Hãy ghi câu hỏi của bạn ....." class="search-input">
                <button class="search-button"><i class="hdr-icon icon anm anm-search-l"></i></button>
            </div>
            <br>

            <h1>Các câu hỏi thường gặp</h1>

            <div class="faq-item">
                <button class="faq-question">Sản phẩm có bảo hành bao lâu.</button>
                <div class="faq-answer">
                    <p>Sản phẩm của chúng tôi được bảo hành từ 6 đến 12 tháng tùy theo loại sản phẩm.</p>
                </div>
                <hr>
            </div>

            <div class="faq-item">
                <button class="faq-question">Cách thức đổi trả sản phẩm.</button>
                <div class="faq-answer">
                    <p>Khách hàng có thể đổi trả sản phẩm trong vòng 30 ngày kể từ khi nhận hàng nếu sản phẩm có lỗi do nhà sản xuất.</p>
                </div>
                <hr>
            </div>

            <div class="faq-item">
                <button class="faq-question">Phương thức thanh toán có an toàn không.</button>
                <div class="faq-answer">
                    <p>Chúng tôi sử dụng các phương thức thanh toán an toàn như thanh toán qua thẻ tín dụng, ví điện tử và chuyển khoản ngân hàng.</p>
                </div>
                <hr>
            </div>

            <div class="faq-item">
                <button class="faq-question">Thời gian giao hàng mất bao lâu.</button>
                <div class="faq-answer">
                    <p>Thời gian giao hàng thường dao động từ 3-5 ngày làm việc tùy khu vực.</p>
                </div>
                <hr>
            </div>

            <div class="faq-item">
                <button class="faq-question">Kiểm tra tình trạng đơn hàng.</button>
                <div class="faq-answer">
                    <p>Để kiểm tra thông tin hoặc tình trang đơn hàng của bạn vui lòng sử dụng mã đơn hàng đã
                        được gửi trong email xác nhận hoặc tin nhắn xác nhận để thông báo lỗi tới bộ phân Chăm sóc khách hàng
                        .</p>
                </div>
                <hr>
            </div>

        </div>

    </section>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                } else {
                    answer.style.display = 'block';
                }
            });
        });
    });
</script>

</html>
@endsection