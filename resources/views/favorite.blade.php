@extends('layouts.app')

@section('content')

@push('css')
    <link href="{{ asset('css/tweet.css') }}" rel="stylesheet">
@endpush

<div id="app">
    <favorites-show-component v-bind:result="{{ $tweets }}"></favorites-show-component>
</div>

@endsection