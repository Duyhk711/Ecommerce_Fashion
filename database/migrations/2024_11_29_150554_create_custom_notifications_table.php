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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người nhận thông báo
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('read_at')->nullable(); // Trạng thái đã đọc/chưa đọc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
