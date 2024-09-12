<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorCodeToAttributeValuesTable extends Migration
{
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->string('color_code')->nullable()->after('value');
        });
    }

    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropColumn('color_code');
        });
    }
}
