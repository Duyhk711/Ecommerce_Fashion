<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_id')->constrained()->onDelete('cascade');
            $table->string('image'); // Địa chỉ URL của ảnh
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_images');
    }
};
