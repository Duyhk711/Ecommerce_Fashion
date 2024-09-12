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
            $table->enum('type', ['main', 'sub'])->after('id'); // 'main' cho banner chính, 'sub' cho banner phụ
            $table->enum('position',['top', 'middle', 'footer'])->nullable()->after('type'); // Vị trí hiển thị cho banner phụ
            $table->boolean('is_active')->default(false)->after('position'); // Trạng thái hoạt động
            $table->string('description')->nullable()->after('is_active'); // Thêm cột mô tả

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
