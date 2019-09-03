<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\TweetSearch;

class TweetController extends Controller
{
    protected $tweetSearch;

    public function __construct(TweetSearch $tweetSearch){
        $this->tweetSearch = $tweetSearch;
    }

    public function search(Request $request){
        $query =  '';
        if (!is_null($request['keyword'])) {
            $keyword = $request['keyword'];
            $query = $keyword;
        }
        if (!is_null($request['exclude_keyword'])) {
            $exclude_keywords = explode(' ', $request['exclude_keyword']);
            rray_walk($exclude_keywords, function(&$val){
                return '-'. $val;
            });
            foreach ($exclude_keywords as $exclude_keyword) {
                $query = $query . ' ' . $exclude_keyword;
            }
        }
        if (!is_null($request['hash_tag'])) {
            $hash_tags = explode(' ', $request['hash_tag']);
            array_walk($hash_tags, function(&$val){
                return '#'. $val;
            });
            foreach ($hash_tags as $hash_tag) {
                $query = $query . ' ' . $hash_tag;
            }
        }
        $include_media = $request['include_media'];
        switch ($include_media) {
            case 'image':
                $query . ' ' . 'filter:images';
                break;
            case 'video':
                $query . ' ' . 'filter:videos';
                break;
            default:
                break;
        }
        if (!is_null($request['favorite_num'])) {
            $query . 'min_faves:' . $request['favorite_num'];
        }
        if (!is_null($request['retweet_num'])) {
            $query . 'min_retweets:' . $request['retweet_num'];
        }
        $result = $this->tweetSearch->getTweets($query);
        return view('twitter', ["result" => $result->statuses]);
    }
}
