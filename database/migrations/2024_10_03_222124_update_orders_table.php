<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->double('discount')->nullable()->after('total_price');
            $table->enum('payment_method', ['COD', 'THANH_TOAN_ONLINE'])->default('COD')->after('payment_status');
            $table->enum('status', [
                'cho_xac_nhan',
                'da_xac_nhan',
                'dang_chuan_bi',
                'dang_van_chuyen',
                'hoan_thanh',
                'huy_don_hang'
            ])->default('cho_xac_nhan')->change();
            
            $table->enum('payment_status', [
                'cho_thanh_toan',
                'da_thanh_toan'
            ])->default('cho_thanh_toan')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('discount', 'payment_method');
        });
    }
};
