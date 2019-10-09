<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetSave implements TweetSaveInterface{
    public function saveTweet(array $tweet) :int{
        $result = Tweet::create([
            'user_id' => Auth::id(),
            'tweet_json' => $tweet,
        ]);
        return empty($result) ? 0 : $result->id;
    }
}
