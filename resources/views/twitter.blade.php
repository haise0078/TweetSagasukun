@extends('layouts.app')

@section('content')

<!-- コンポーネントの配置 -->
<div id="app">
    <tweet-search-component></TweetSearch-component>
</div>


@push('css')
    <link href="{{ asset('css/tweet.css') }}" rel="stylesheet">
@endpush

<div id="tweet-search">
    <tweet-search-component></TweetSearch-component>
</div>

<div id="tweet-show">
    <tweets-show-component v-bind:result="{{ $result }}"></tweets-show-component>
</div>

{{-- <div>
    @foreach ($result as $tweet)
        <div class="card mb-2">
            <div class="card-body">
                <div class="media">
                    <img src={{$tweet->user->profile_image_url_https}} class="rounded-circle mr-4">
                    <div class="media-body">
                        <h5 class="d-inline mr-3"><strong>{{ $tweet->user->name }}</strong></h5>
                        <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                        <p class="mt-3 mb-0">{{ preg_replace('/https:\/\/t.co\/.*\z/', '', $tweet->full_text) }}</p>
                        @isset ($tweet->entities->media)
                            @foreach ($tweet->entities->media as $media)
                                <div class="image-box">
                                    <img src={{$media->media_url}} class="rounded tweet-image">
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex flex-row justify-content-end">
                    <div class="mr-5"><i class="fas fa-retweet text-secondary"></i>{{$tweet->retweet_count}}</div>
                    <div class="mr-5"><i class="far fa-heart text-secondary"></i>{{$tweet->favorite_count}}</div>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}

@endsection