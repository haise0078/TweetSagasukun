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
        $query =  '';
        if (!is_null($request['keyword'])) {
            $keyword = $request['keyword'];
            $query = $keyword;
        }
        if (!is_null($request['exclude_keyword'])) {
            $exclude_keywords = explode(' ', $request['exclude_keyword']);
            array_walk($exclude_keywords, function(&$val){
                $val = '-'. $val;
            });
            foreach ($exclude_keywords as $exclude_keyword) {
                $query = $query . ' ' . $exclude_keyword;
            }
        }
        if (!is_null($request['hash_tag'])) {
            $hash_tags = explode(' ', $request['hash_tag']);
            array_walk($hash_tags, function(&$val){
                $val = '#'. $val;
            });
            foreach ($hash_tags as $hash_tag) {
                $query = $query . ' ' . $hash_tag;
            }
        }
        if ($request['image']) {
            $query = $query . ' ' . 'filter:images';
        }
        if ($request['video']) {
            $query = $query . ' ' . 'filter:videos';
        }
        if ($request['exclude_retweet']) {
            $query = $query . ' ' . 'exclude:retweets';
        }
        if ($request['exclude_reply']) {
            $query = $query . ' ' . 'exclude:replies';
        }
        if (!is_null($request['favorite_num'])) {
            $query = $query . ' ' . 'min_faves:' . $request['favorite_num'];
        }
        if (!is_null($request['retweet_num'])) {
            $query = $query . ' ' . 'min_retweets:' . $request['retweet_num'];
        }
        $result = $this->tweetSearch->getTweets($query);
        $result = json_encode($result->statuses);
        return view('twitter', ["result" => $result]);
    }
    public function save(Request $request){
        $tweet = $request->input('tweet');
        return $this->tweetSave->saveTweet($tweet);
    }
}
