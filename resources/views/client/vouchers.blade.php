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
    
</style>
@endsection
@section('content')
@include('client.component.page_header')
<div class="container mt-5">
    <div class="row">
    @foreach($vouchers as $voucher)
            <div class="col-md-4 mb-4">
                <div class="voucher-card">
                    <div class="voucher-header"> Voucher {{ $voucher->discount_value }}K</div>
                    <div class="voucher-code" id="voucher-code-1">{{ $voucher->code }}</div>
                    <div class="voucher-description">
                    Giảm {{ $voucher->discount_value }}K
                    cho đơn hàng từ {{ $voucher->minimum_order_value ?? 0 }}K
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="voucher-expiry"> HSD: {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</div>
                        <div>
                            <form action="{{ route('save-voucher') }}" method="POST">
                                @csrf
                                <input type="hidden" name="code" value="{{ $voucher->code }}">
                                <input type="hidden" name="discount_type" value="{{ $voucher->discount_type }}">
                                <input type="hidden" name="discount_value" value="{{ $voucher->discount_value }}">
                                <input type="hidden" name="start_date" value="{{ $voucher->start_date }}">
                                <input type="hidden" name="end_date" value="{{ $voucher->end_date }}">
                                <button type="submit" class="voucher-copy">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        

    </div>
</div>
@endsection