<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã voucher
            $table->decimal('discount_value', 10, 2); // Giá trị giảm giá
            $table->date('start_date'); // Ngày bắt đầu hiệu lực
            $table->date('end_date'); // Ngày hết hạn
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
    
};
