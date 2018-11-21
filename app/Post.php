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

    public function prev($post)
    {
        if($post->orderBy('id', 'ASC')->where('id', '>', $post->id)->first()){
            $prev = $post->orderBy('id', 'ASC')->where('id', '>', $post->id)->first()->id;
        }
        else{
            $prev = $post->min('id');
        }
        
        return $prev;
    } 

    public function next($post)
    {
        if($post->orderBy('id', 'DESC')->where('id', '<', $post->id)->first()){
            $next = $post->orderBy('id', 'DESC')->where('id', '<', $post->id)->first()->id;
        }
        else{
            $next = $post->max('id');
        }
        
        return $next;
    } 
}
