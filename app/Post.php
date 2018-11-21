<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
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

    public function getIds()
    {
        $postx = Post::pluck('id');//Niz sa svim id-jevima.
        foreach ($postx as $value){
            $postsIds[] = $value;
        } 

        return $postsIds;
    }

    public function prevNext($par1, $par2)
    {
        $cur_index = array_search($par1, $par2);
        $len = count($par2);
        
        $prev = 0;
        $next = 0;

        if(($cur_index+1)<$len){
            $prev = $par2[$cur_index+1];
        }
        else{
            $prev = $par2[0];
        }
        
        if(($cur_index-1)<$len && ($cur_index)>0){
            $next = $par2[$cur_index-1];
        }
        else{
            $next = $par2[$len-1];
        }

        $prevNext [0] = $prev;
        $prevNext [1] = $next;
        
        return $prevNext;
    } 
}
