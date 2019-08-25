<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( (Auth::user()->twitterInfomation())->get()->isEmpty()){
            return redirect('twitterSignIn');
        } else {
            $connection = \TwitterConnection::makeConnection();
            $result = $connection->get('statuses/home_timeline', array("count" => 5));
            return view('twitter', [
                "result" => $result
            ]);
        }
    }
}
