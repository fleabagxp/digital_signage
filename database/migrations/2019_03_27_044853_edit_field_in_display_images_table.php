<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFieldInDisplayImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('display_images', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('position');
            $table->dropColumn('path');
            
            $table->string('bg_path')->nullable()->after('display_id');
            $table->string('signage1_path')->nullable()->after('bg_path');
            $table->string('signage2_path')->nullable()->after('signage1_path');
            $table->string('video1_path')->nullable()->after('signage2_path');
            $table->string('video2_path')->nullable()->after('video1_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('display_images', function (Blueprint $table) {
            //
        });
    }
}
