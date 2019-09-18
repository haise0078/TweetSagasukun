<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetSave {
    public function saveTweet($tweet){
        $result = Tweet::create([
            'user_id' => Auth::id(),
            'tweet_json' => $tweet,
        ]);
        return empty($result) ? 0 : $result->id;
    }
}
