<?php

namespace App\Services;

Interface TweetSearchInterface
{
    public function getTweets(string $query): array;
}