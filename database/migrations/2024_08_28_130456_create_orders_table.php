<?php

use App\Models\Address;
use App\Models\User;
use App\Models\Voucher;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Voucher::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Address::class)->constrained()->onDelete('cascade');
            $table->string('sku');
            $table->string('session_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone', 50)->nullable();
            $table->double('total_price');
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
