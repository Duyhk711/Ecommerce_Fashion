@extends('layouts.client')

@section('content')
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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
    h1{
        color: red;
        line-height: 1.6;
        margin-bottom: 30px;
        font-size: 25px;
    }
    hr{
        background-color: black;
        border: none;
    }
    .contact-barter p{
        margin: 0;
        font-size: 18px;
    }
    .contact-barter h4{
        margin: 0;
        font-size: 25px;
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
            <h1>Chính sách đổi hàng</h1>
            <hr>
            <br>

            <div class="contact-barter">
                <h2>I. Quy định đổi hàng online</h2>
                <div class="barter-d1">
                <h4>1. Chính sách áp dụng</h4>
                <p>- Áp dụng 01 lần đổi/01 đơn hàng</p>
                <p>- Không áp dụng đổi với sản phẩm phụ kiện và đồ lót</p>
                <p>- Sản phẩm nguyên giá được đổi sang sản phẩm nguyên khác còn hàng tại website có giá trị bằng hoặc lớn hơn (KH bù thêm chênh lệch nếu lớn hơn)</p>
                <p>- Không hỗ trợ đổi các sản phẩm giảm giá/khuyên mại</p>
                </div>
                <br>
                <div class="barter-d1">
                <h4>2. Điều kiện đổi sản phẩm</h4>
                <p>- Đổi hàng trong vòng 3 ngày kể từ ngày khách hàng nhận được sản phẩm</p>
                <p>- Sản phẩm còn nguyên tem, mác và chưa qua sử dụng</p>
                </div>
                <br>
                <div class="barter-d1">
                <h4>3. Thực hiện đổi sản phẩm</h4>
                <p>Bước 1: Liên hệ fanpage https://www.facebook.com/ để xác nhận đổi hàng</p>
                <p>Bước 2: Gửi hàng về địa chỉ kho</p>
                <p>Bước 3: Shop gửi đổi sản phẩm mới khi nhận được hàng. Trong trường hợp hết hàng, Shop sẽ liên hệ xác nhận.</p>
                <p></p>
                </div>
                <hr>

                <h2>II. Quy định đổi sản phẩm khi mua tại cửa hàng</h2>
                <div class="barter-d1">
                <h4>1. Điều kiện đổi sản phẩm</h4>
                <p>Tất cả các cơ sở của shop </p>
                </div>
                <br>
                <div class="barter-d1">
                <h4>2. Điều kiện đổi hàng</h4>
                <p>- Trong vòng 3 ngày kể từ ngày mua sản phẩm. </p>
                <p>- Áp dụng đối với sản phẩm nguyên giá và sản phẩm giảm giá,<strong>và chỉ được đổi 01 lần duy nhất</strong>  </p>
                <p>- Sản phẩm nguyên giá được đổi sang sản phẩm nguyên giá khác và không thấp hơn giá trị sản phẩm đã mua.</p>
                <p>- Không hỗ trợ đổi các sản phẩm giảm giá/khuyên mại </p>
                <p>- Sản phẩm đồ lót và phụ kiện  không được đổi.</p>
                <p><strong>- Giá trị sản phẩm đổi : bằng hoặc cao hơn giá trị sản phẩm đã mua trước đó</strong></p>

                </div>
                <br>

                <div class="barter-d1">
                <h4>3. Lưu ý</h4>
                <p>- Trường hợp đổi SP hôm trước mua là nguyên giá, hôm sau giảm giá, thì áp dụng chính sách như đổi sản phẩm nguyên giá. </p>
                <p>- Quý khách vui lòng kiểm tra sản phẩm và hóa đơn trước khi ra về và tham khảo hướng dẫn bảo quản sản phẩm trước khi sử dụng.  </p>
                <p>- Mọi thắc mắc về quy định chung của cửa hàng xin vui lòng liên hệ số hotline: <strong>012345678</strong> để được hỗ trợ nhanh nhất</p>
                </div>
                <br>
            </div>
        </div>
    </section>
    
</body>
</html>
@endsection