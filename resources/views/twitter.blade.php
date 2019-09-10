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
    <tweet-show-component v-bind:result="{{ $result }}"></tweet-show-component>
</div>

@endsection