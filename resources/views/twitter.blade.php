@extends('layouts.app')

@section('content')

@push('css')
    <link href="{{ asset('css/tweet.css') }}" rel="stylesheet">
@endpush

<div id="app">
    <tweet-parent-component></tweet-parent-component>
</div>

@endsection