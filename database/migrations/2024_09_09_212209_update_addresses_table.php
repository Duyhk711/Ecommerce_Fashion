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
        Schema::table('addresses', function (Blueprint $table) {
            // $table->dropColumn("state");
            // $table->dropColumn("postal_code");
            // $table->dropColumn("country");
            // $table->string("district")->after("city");
            // $table->string("is_default")->after("address_line2")->default(0);
            // $table->string("ward")->after("district");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // $table->dropColumn("district", "ward", "is_default");
        });
    }
};
