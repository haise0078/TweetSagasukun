@extends('layouts.app')

@section('content')

@include('components/tweetSearch')

@push('css')
    <link href="{{ asset('css/tweet.css') }}" rel="stylesheet">
@endpush

<body>
    <div>
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
    </div>
</body>
@endsection