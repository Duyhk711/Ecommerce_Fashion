<?php

use App\Models\User;
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
    Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
        $table->string('customer_name')->nullable();
        $table->string('customer_phone', 50)->nullable();
        $table->string('address_line1');
        $table->string('address_line2')->nullable();
        $table->string('ward');
        $table->string('district');
        $table->string('city');
        $table->enum('type',['home' ,'office'])->default('home');
        $table->timestamps();
        $table->softDeletes();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
