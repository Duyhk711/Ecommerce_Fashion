<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status'; // Tên lệnh
    protected $description = 'Update order status to completed after 3 days if not confirmed by user';

    public function handle()
    {
        $orders = Order::where('status', 4) // Trạng thái "đã giao"
                       ->where('updated_at', '<=', Carbon::now()->subMinutes(1))
                       ->get();

        foreach ($orders as $order) {
            $order->status = 5; // Cập nhật trạng thái "hoàn thành"
            $order->save();
        }

        $this->info('Order statuses updated successfully.');
    }
}
