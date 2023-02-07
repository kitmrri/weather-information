<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dt')->unique();
            $table->json('main');
            $table->json('weather');
            // $table->json('weather');
            // $table->string('city');
            // $table->dateTime('date');
            // $table->float('temperature');
            // $table->float('pressure');
            // $table->integer('humidity');
            // $table->string('weather');
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
        Schema::dropIfExists('weather');
    }
};
