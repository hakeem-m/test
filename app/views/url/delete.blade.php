@extends('url.layout')

@section('content')

</div>
<div class="row">
    <div class="callout panel">
        <p><strong>Do you really want to delete employee?</strong> </p>
    </div>
    <form action="{{ action('UrlsController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="url" value="{{ $url->id }}" />
        <input type="submit" class="small alert button" value="Yes" />
        <a href="{{ action('UrlsController@index') }}" class="small button">No</a>
    </form>
</div>
<div class="row">
    @stop