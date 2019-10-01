<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetDelete implements TweetDeleteInterface{
    public function deleteTweet(int $id): int{
        $result = Tweet::destroy($id);
        return empty($result) ? 0 : $result;
    }
}
