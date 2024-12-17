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
            $table->enum('status', [
                '1',
                '2',
                '3',
                '4',
                '5',
                'huy_don_hang',
            ])->default('1')->change();

            $table->enum('payment_status', [
                'cho_thanh_toan',
                'da_thanh_toan',
                'huy_thanh_toan'
            ])->default('cho_thanh_toan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
