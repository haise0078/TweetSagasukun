<?php
namespace App\Http\Components;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;

class TwitterConnection{
    private $connection;

    public function __construct(){
        
        
    }

    public function makeConnection(){
        $config = config('twitter');
        $twitterInfo = Auth::user()->twitterInfomation;
        $oauth_token = $twitterInfo->oauth_token;
        $oauth_token_secret = $twitterInfo->oauth_token_secret;
        $this->connection = new TwitterOAuth($config['api_key'], $config['secret_key'], $oauth_token, $oauth_token_secret);
        return ($this->connection);
    }
}