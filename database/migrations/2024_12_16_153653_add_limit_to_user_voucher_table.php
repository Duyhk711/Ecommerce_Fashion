<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_voucher', function (Blueprint $table) {
            $table->dropColumn('last_used_at');
            $table->unsignedInteger('limit')->default(0)->nullable()->after('is_used');
        });
    }

    public function down(): void
    {
        Schema::table('user_voucher', function (Blueprint $table) {
            $table->dateTime('last_used_at')->nullable()->after('is_used');
            $table->dropColumn('limit');
        });
    }
};
