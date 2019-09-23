<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\TweetSearch;
use App\Services\TweetSave;
use App\Services\TweetDelete;


class TweetController extends Controller
{
    protected $tweetSearch;
    protected $tweetSave;
    protected $tweetDelete;

    public function __construct(TweetSearch $tweetSearch, TweetSave $tweetSave, TweetDelete $tweetDelete){
        $this->tweetSearch = $tweetSearch;
        $this->tweetSave = $tweetSave;
        $this->tweetDelete = $tweetDelete;
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
    public function delete(Request $request){
        $id = $request->input('id');
        return $this->tweetDelete->deleteTweet($id);
    }
}
