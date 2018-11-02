<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /*Kreira tabelu imena 'posts', zatim navodi 
        koje polje se automatski inkrementira,tj id polje, 
        zatim polje 'title' koje je naslov posta, 
        polje 'body' se odnosi na sam post, tj. naslov posta,
        odnosno sadrzaj posta.*/
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('body');
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
        Schema::dropIfExists('posts');
    }
}
