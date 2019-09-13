<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TweetSave {
    public function saveTweet($tweet){
        if ( (Auth::user()->twitterInfomation())->get()->isEmpty()){
            return false;
        } else {
            
            return true;
        }
    }
}
