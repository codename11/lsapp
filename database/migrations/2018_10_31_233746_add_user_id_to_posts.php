<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /*U tabeli posts dodaje polje, 
        tipa integer sa imenom user_id.*/
        Schema::table('posts', function($table){
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   /*Ovde se revertuje prethodno(gore) 
        setovano polje, brise se.*/
        Schema::table('posts', function($table){
            $table->dropColumn('user_id');
        });
    }
}
