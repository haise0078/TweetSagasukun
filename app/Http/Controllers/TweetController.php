<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\TweetDeleteInterface;
use App\Services\TweetSaveInterface;
use App\Services\TweetSearchInterface;

class TweetController extends Controller
{
    protected $tweetSearch;
    protected $tweetSave;
    protected $tweetDelete;

    public function __construct(TweetSearchInterface $tweetSearch, TweetSaveInterface $tweetSave, TweetDeleteInterface $tweetDelete){
        $this->tweetSearch = $tweetSearch;
        $this->tweetSave = $tweetSave;
        $this->tweetDelete = $tweetDelete;
        $this->middleware('auth');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $result = $this->tweetSearch->getTweets($query);
        $result = json_encode($result);
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
