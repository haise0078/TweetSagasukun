<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\Auth;

class FavoriteTweetController extends Controller
{
    public function __construct(){

    }
    public function favorite(){
        $tweets = Tweet::where('user_id' , Auth::id())
            ->get();
        return view('favorite', ['tweets'=>$tweets]);
    }
}
