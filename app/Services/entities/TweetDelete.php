<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetDelete {
    public function deleteTweet($id){
        $result = Tweet::destroy($id);
        return $result;
    }
}
