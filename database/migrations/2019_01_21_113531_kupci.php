<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kupci extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kupci', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv');
            $table->string('adresa');
            $table->string('lat');
            $table->string('lng');
            $table->string('id_komercijaliste');
            $table->string('description');
            $table->timestamps();//Ovo automatski dodaje dve kolone: created_at i updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Kupci');
    }
}
