<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   /*U ovoj klasi se belezi ime tabele, polja za ajdi 
    i to da li ce biti tajmstempa.*/
    // Table name
    protected $table = "posts";
    // Primary key
    public $primaryKey = "id";
    // Timestamp
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

}
