@extends('url.layout')

@section('content')
<div class="large-12 columns">
    <div class="panel">

        <h5>Build URL</h5>
        <p>{{$data['build_url']}}</p>
    </div>
    {{Form::open(array('action' => 'UrlsController@saveBuildUrl','method'=>'post'))}}
    {{ Form::submit('Save',array('class' => 'small button')) }}
</div>
@stop