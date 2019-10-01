<?php

namespace App\Services;

Interface TweetDeleteInterface
{
    public function deleteTweet(int $id): int;
}