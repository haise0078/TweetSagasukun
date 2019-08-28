<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\TwitterInfomation;
use Illuminate\Support\Facades\Auth;

class TwitterSignInController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function register(){
        $config = config('twitterRegister');
        $request_token = \Twitter::oauth('oauth/request_token', array('oauth_callback' => $config['callback_url']));
        $url = \Twitter::url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        return redirect($url);
    }

    public function callback(){
        $access_token = \Twitter::oauth("oauth/access_token", ["oauth_verifier" => Input::get('oauth_verifier'), "oauth_token" => Input::get('oauth_token')]);
        TwitterInfomation::create([
            'user_id' => Auth::id(),
            'twitter_id' => $access_token['user_id'],
            'screen_name' => $access_token['screen_name'],
            'oauth_token' => $access_token['oauth_token'],
            'oauth_token_secret' => $access_token['oauth_token_secret'],
        ]);
        return redirect('home');
        
    }
}
