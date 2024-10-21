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
</style>
@endsection
@section('my-order')
    <div>
        <div class="orders-card mt-0 h-100">
            <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                <h2 class="mb-0">Mã ưu đãi</h2>
            </div>

            <!-- <div class="table-bottom-brd table-responsive">
                <table class="table align-middle text-center order-table">
                    <thead>
                        <tr class="table-head text-nowrap">
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">PTTT</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                   
                </table>
            </div> -->
            <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="voucher-card">
                    <div class="voucher-header">Voucher 50K</div>
                    <div class="voucher-code" id="voucher-code-1">GIAM50</div>
                    <div class="voucher-description">Giảm 50k cho đơn hàng hàng từ 399k</div>
                    <div class="d-flex justify-content-between align-items-center mt-2  ">
                    <div class="voucher-expiry">HSD: 31/12/2024</div>
                    <div>
                    <a href="{{ route('shop')}}"><button class="voucher-copy" onclick="">Mua ngay</button></a> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="voucher-card">
                    <div class="voucher-header">Voucher 80K</div>
                    <div class="voucher-code" id="voucher-code-2">GIAM80</div>
                    <div class="voucher-description">Giảm 80k cho đơn hàng từ 599k</div>
                    <div class="d-flex justify-content-between align-items-center mt-2  ">
                    <div class="voucher-expiry">HSD: 31/12/2024</div>
                    <div>
                       <a href="{{ route('shop')}}"><button class="voucher-copy" onclick="">Mua ngay</button></a> 
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
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
