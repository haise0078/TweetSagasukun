<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(Request $request){
        $connection = \TwitterConnection::useConnection();
        dd($connection);
        $result = $connection->get('statuses/home_timeline', array("count" => 5));
        return view('twitter', [
            "result" => $result
        ]);
    }
}
