<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TweetSearch {
    public function getTweets($query){
        if ( (Auth::user()->twitterInfomation())->get()->isEmpty()){
            return redirect('twitterSignIn');
        } else {
            $connection = \TwitterConnection::makeConnection();
            $result = $connection->get("search/tweets", ["q" => $query, "count" => 50, "tweet_mode" => "extended"]);
            return $result;
        }
    }
}
