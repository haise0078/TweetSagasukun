<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function search(Request $request){
        //ツイート検索サービスを作成してそれにパラメータを渡し、ビューに検索結果を渡す
        $query = $request['query'];
        $count = $request['count'];
        return view('twitter', ["result" => $result]);
    }
}
