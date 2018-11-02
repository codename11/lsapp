<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*U tabeli posts dodaje polje, 
        tipa integer sa imenom cover_image.*/
        Schema::table('posts', function($table){
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*U tabeli posts dodaje polje, 
        tipa integer sa imenom cover_image.*/
        Schema::table('posts', function($table){
            $table->dropColumn('cover_image');
        });
    }
}
