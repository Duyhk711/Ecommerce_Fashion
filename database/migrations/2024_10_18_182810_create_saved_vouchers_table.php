<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_voucher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('voucher_id')->constrained()->onDelete('cascade'); 
            $table->timestamp('saved_at')->nullable(); 
            $table->boolean('is_used')->default(false); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_voucher');
    }
};
