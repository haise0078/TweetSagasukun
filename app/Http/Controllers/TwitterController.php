<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(Request $request){
        $result = \Twitter::get('statuses/home_timeline', array("count" => 5));
        return view('twitter', [
            "result" => $result
        ]);
    }
}
