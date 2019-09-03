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
            $result = $connection->get("search/tweets", ["q" => "lenovo (from:taritari_vtuber OR from:haise0202)", "count" => 5]);
            // dd($result);
            return view('twitter', ["result" => $result->statuses]);
        }
    }
}
