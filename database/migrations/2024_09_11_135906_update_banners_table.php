<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBannersTable extends Migration
{
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            // Thêm các cột mới
            $table->enum('type', ['main', 'sub'])->after('id'); 
            $table->enum('position',['top', 'middle', 'footer'])->nullable()->after('type');
            $table->boolean('is_active')->default(false)->after('position'); 
            $table->string('description')->nullable()->after('is_active'); 

            $table->dropColumn('image_url');
            $table->dropColumn('link');
        });
    }

    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('position');
            $table->dropColumn('is_active');
            $table->dropColumn('description');
            
        });
    }
}
