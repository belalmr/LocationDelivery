<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('main_lat', 10, 7)->default(31.521921061170);
            $table->decimal('main_lng', 10, 7)->default(34.43374671135);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_mains');
    }
}
