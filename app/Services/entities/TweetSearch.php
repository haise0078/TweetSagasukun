<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TweetSearch implements TweetSearchInterface{
    public function getTweets(string $query): array{
        $connection = \TwitterConnection::makeConnection();
        $result = $connection->get("search/tweets", ["q" => $query, "count" => 50, "tweet_mode" => "extended", "include_entities" => true]);
        return $result->statuses;
    }
}
