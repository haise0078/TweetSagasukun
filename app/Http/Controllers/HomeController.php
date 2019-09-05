<?php

namespace App\Http\Controllers;

use App\Services\TweetSearch;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $tweetSearch;

    public function __construct(TweetSearch $tweetSearch){
        $this->tweetSearch = $tweetSearch;
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
            $result = $this->tweetSearch->getTweets('飯テロ');
            return view('twitter', ["result" => $result->statuses]);
        }
    }
}
