<?php

namespace App\Events;

use App\Models\Voucher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateNewVoucherNotify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $voucher;

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function broadcastWith()
    {
        $voucherMessages = "Mã giảm giá mới <strong>{$this->voucher->code}</strong> giảm {$this->voucher->discount_value}";
            if ($this->voucher->discount_type == 'fixed') {
                $voucherMessages .= "K cho đơn hàng từ {$this->voucher->minimum_order_value}K! Click để nhận ngay ưu đãi!!";
            } elseif ($this->voucher->discount_type == 'percentage') {
                $voucherMessages .= "% cho đơn hàng từ {$this->voucher->minimum_order_value}K! Click để nhận ngay ưu đãi!!";
            }
            $message = $voucherMessages;
        return [
            'notification' => [
                'title' => "Bạn đã nhận được voucher mới",
                'message' => $message,
                'link' => route('vouchers.index'),
            ],
        ];
    }

    public function broadcastOn()
    {
        return new Channel('new_vouchers');
    }
}
