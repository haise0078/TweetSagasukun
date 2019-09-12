<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TweetSave {
    public function saveTweet(){
        if ( (Auth::user()->twitterInfomation())->get()->isEmpty()){
            return redirect('twitterSignIn');
        } else {
            $connection = \TwitterConnection::makeConnection();
            $result = $connection->get("search/tweets", ["q" => $query, "count" => 50, "tweet_mode" => "extended", "include_entities" => true]);
            return $result;
        }
    }
}
