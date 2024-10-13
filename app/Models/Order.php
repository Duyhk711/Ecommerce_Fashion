<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const TRANG_THAI_DON_HANG = [
        '1' => 'Chờ xác nhận',
        '2' => 'Đã xác nhận',
        '3' => 'Đang chuẩn bị',
        '4' => 'Đang vận chuyển',
        '5' => 'Đã giao hàng',
        'huy_don_hang' => 'Đơn hàng đã hủy',
    ];

    const TRANG_THAI_THANH_TOAN = [
    'cho_thanh_toan'=> 'Chờ thanh toán',
    'da_thanh_toan' => 'Đã thanh toán',
    ];

    const COD = 'COD'; 
    const THANH_TOAN_ONLINE = 'thanh_toan_online'; 
    

    protected $fillable = [
        'user_id',
        'voucher_id',
        'address_id',
        'sku',
        'session_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address_line1',
        'address_line2',
        'city',
        'district',
        'ward',
        'total_price',
        'discount',
        'status',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'order_id', 'id');
    }
  
    public function changeStatus($newStatus)
    {
        // Kiểm tra xem trạng thái mới có hợp lệ không
        if (!array_key_exists($newStatus, self::TRANG_THAI_DON_HANG)) {
            throw new \InvalidArgumentException('Trạng thái không hợp lệ.');
        }

        // Cập nhật trạng thái
        
        if($newStatus <= $this->status || $newStatus == "huy_don_hang"){
            throw new \Exception("Trạng thái đã được cập nhật, vui lòng chọn trạng thái mới");
        }else{
            $this->status = $newStatus;
        }

        // Nếu trạng thái mới là "hoàn thành", cập nhật trạng thái thanh toán
        if ($newStatus === '5') {
            $this->payment_status = 'da_thanh_toan'; 
        }

        $this->save(); 
    }

    public function statusChanges()
    {
        return $this->hasMany(OrderStatusChange::class);
    }
}
