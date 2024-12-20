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
        Schema::table('user_voucher', function (Blueprint $table) {
            $table->dateTime('last_used_at')->nullable()->after('is_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_voucher', function (Blueprint $table) {
            $table->dropColumn('last_used_at');
        });
    }
};
