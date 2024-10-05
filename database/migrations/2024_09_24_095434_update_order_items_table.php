<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn("state");
            $table->dropColumn("postal_code");
            $table->dropColumn("country");
            $table->dropColumn("price");
            $table->dropColumn("customer_name");
            $table->dropColumn("customer_email");
            $table->dropColumn("customer_phone");
            $table->dropColumn("address_line1");
            $table->dropColumn("address_line2");
            $table->dropColumn("city");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn("district", "ward");
        });
    }
};
