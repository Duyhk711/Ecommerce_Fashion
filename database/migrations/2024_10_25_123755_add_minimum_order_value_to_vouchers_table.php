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
    Schema::table('vouchers', function (Blueprint $table) {
        $table->integer('minimum_order_value')->nullable()->after('discount_value');
    });
}

public function down(): void
{
    Schema::table('vouchers', function (Blueprint $table) {
        $table->dropColumn('minimum_order_value');
    });
}
};
