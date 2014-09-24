@extends('url.layout')

@section('content')

<div class="large-12 columns">
    @if ( $errors->count() > 0 )
    <div class="alert-box alert">
        <ul>
            @foreach( $errors->all() as $message )
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{Form::open(array('action' => 'UrlsController@handleShortAnalytics'))}}
    <div class="large-12 columns">
        <label>Short URL</label>
        {{ Form::text('short_url','',array('placeholder'=>'Enter short URL here'))}}
        {{ Form::submit('Get Analytics',array('class' => 'small button')) }}
    </div>

    @stop