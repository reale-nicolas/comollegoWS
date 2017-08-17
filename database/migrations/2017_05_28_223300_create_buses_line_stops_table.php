<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesLineStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses_line_stops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_id')->unsigned()->default(0);
            $table->foreign('line_id')->references('id')->on('buses_lines')->onDelete('cascade');
            $table->double('latitud');
            $table->double('longitud');
            $table->integer('orden');
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
        Schema::dropIfExists('buses_line_stops');
    }
}
