<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\TweetSearch;
use App\Services\TweetSave;


class TweetController extends Controller
{
    protected $tweetSearch;
    protected $tweetSave;

    public function __construct(TweetSearch $tweetSearch, TweetSave $tweetSave){
        $this->tweetSearch = $tweetSearch;
        $this->tweetSave = $tweetSave;
        $this->middleware('auth');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $result = $this->tweetSearch->getTweets($query);
        $result = json_encode($result->statuses);
        return $result;
    }
    public function save(Request $request){
        $tweet = $request->input('tweet');
        return $this->tweetSave->saveTweet($tweet);
    }
}
