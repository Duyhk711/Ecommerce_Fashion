<!--Footer-->
@include('client.component.chat')
<div class="footer mt-4">
    <div class="newsletterbg clearfix">
        <div class="container">
            <form action="#" method="post" class="footer-newsletter">
                @csrf
                <div class="row align-items-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3 mb-md-0">
                        <label class="h3 mb-1 clr-none">Đăng ký nhận bản tin của chúng tôi và được GIẢM GIÁ 10%</label>
                        <p>Đăng kí để nhận thông tin cập nhật, quyền truy cập vào các ưu đãi độc quyền và hơn thế nữa.
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="input-group">
                            <input type="email" class="form-control input-group-field newsletter-input"
                                name="email" value="" placeholder=""
                                required />
                            <button type="submit" class="input-group-btn btn btn-secondary newsletter-submit"
                                name="commit">Đăng kí</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-top clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                    <h4 class="h4">Thông tin</h4>
                    <ul>
                        <li><a href="#">Tài khoản</a></li>
                        <li><a href="">Liên hệ</a></li>
                        <li><a href="">Đăng nhập</a></li>
                        <li><a href="">Chính sách bảo mật</a></li>
                        <li><a href="#">Bảo hành &amp; hoàn trả</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                    <h4 class="h4">Mua nhanh</h4>
                    <ul>
                        <li><a href="#">Quần áo nam</a></li>
                        <li><a href="#">Quần áo nữ</a></li>
                        <li><a href="#">Quần áo trẻ em</a></li>
                        <li><a href="#">Áo phông</a></li>
                        <li><a href="#">Áo sơ mi</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                    <h4 class="h4">Dịch vụ khách hàng</h4>
                    <ul>
                        <li><a href="#">Yêu cầu dữ liệu cá nhân</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Liên hệ với chúng tôi</a></li>
                        <li><a href="#">Đơn đặt hàng và trả lại</a></li>
                        <li><a href="#">Trung tâm hỗ trợ</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-contact">
                    <h4 class="h4">Liên hệ với chúng tôi</h4>
                    <p class="address d-flex"><i class="icon anm anm-map-marker-al pt-1"></i> Phố Trịnh Văn Bô, Phương Canh, Nam Từ Liêm, Hà Nội</p>
                    <p class="phone d-flex align-items-center"><i class="icon anm anm-phone-l"></i> <b
                            class="me-1 d-none">Phone:</b> <a href="tel:401234567890">(+40) 123 456 7890</a>
                    </p>
                    <p class="email d-flex align-items-center"><i class="icon anm anm-envelope-l"></i> <b
                            class="me-1 d-none">Email:</b> <a
                            href="mailto:info@example.com">info@example.com</a></p>
                    <ul class="list-inline social-icons mt-3">
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Facebook"><i
                                    class="icon anm anm-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Twitter"><i
                                    class="icon anm anm-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Pinterest"><i
                                    class="icon anm anm-pinterest-p"></i></a></li>
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Linkedin"><i
                                    class="icon anm anm-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Instagram"><i
                                    class="icon anm anm-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Youtube"><i
                                    class="icon anm anm-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom clearfix">
        <div class="container">
            <div class="d-flex-center flex-column justify-content-md-between flex-md-row-reverse">
                <ul class="payment-icons d-flex-center mb-2 mb-md-0">
                    <li><i class="icon anm anm-cc-visa"></i></li>
                    <li><i class="icon anm anm-cc-mastercard"></i></li>
                    <li><i class="icon anm anm-cc-amex"></i></li>
                    <li><i class="icon anm anm-cc-paypal"></i></li>
                    <li><i class="icon anm anm-cc-discover"></i></li>
                    <li><i class="icon anm anm-cc-stripe"></i></li>
                    <li><i class="icon anm anm-cc-jcb"></i></li>
                </ul>
                <div class="copytext">&copy; 2024 Fashion Poly. All Rights Reserved.</div>
            </div>
        </div>
    </div>
</div>
<!--End Footer-->