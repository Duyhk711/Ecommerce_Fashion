<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("address_line1")->after("customer_phone");
            $table->string("address_line2")->after("address_line1");
            $table->string("city")->after("address_line2");
            $table->string("district")->after("city");
            $table->string("ward")->after("district");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("district", "ward", "city", "address_line1", "address_line2");
        });
    }
};
