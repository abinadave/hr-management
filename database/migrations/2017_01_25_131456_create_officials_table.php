<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dob', 40);
            $table->string('city');
            $table->string('phone', 11);
            $table->string('location');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('date_of_joining');
            $table->string('date_of_leaving')->nullable();
            $table->integer('status');
            $table->integer('position');
            $table->integer('user_id');
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
        Schema::dropIfExists('officials');
    }
}
