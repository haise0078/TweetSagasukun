<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tweet_json' => 'json',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
