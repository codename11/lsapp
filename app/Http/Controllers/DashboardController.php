<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*create a variable called $user_id and 
        telling the system 'I want to store the ID 
        of whatever user is logged in 
        and accessing this page'*/ 
        $user_id = auth()->user()->id;
        /*from the User model get the post 
        which has the user_id field $user_id;*/
        $user = User::find($user_id);
		//dd($user->posts);
        return view('dashboard')->with('posts', $user->posts);
    }
}
