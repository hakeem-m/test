@extends('url.layout')
@section('content')

{{Form::open(array('action' => 'UrlsController@save'))}}
<div class="large-12 columns">
    <label>Long URL</label>
    {{ Form::text('long_url',$short->longUrl,array('readonly'=>'readonly'))}}
    <label>Short URL</label>
    {{ Form::text('short_url',$short->id,array('readonly'=>'readonly'))}}
    <label>Description</label>
    {{ Form::textarea('description','',array('cols'=>'30','rows'=>'3'))}}
    {{ Form::submit('Save',array('class' => 'small button')) }}
</div>

@stop


