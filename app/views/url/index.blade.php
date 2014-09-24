@extends('url.layoutHome')

@section('content')
{{Form::open(array('action' => 'UrlsController@exportCsv','method'=>'post','id'=>'exportForm1'))}}
{{ $table=Datatable::table()
    ->addColumn('','<input type=\'checkbox\' id=\'selectall\'> ','Date Created','Campaign Content','URL','Campaign Name','Source','Medium','Long URL','Short URL','Partner','Channel','WMJ Job#','Subject Line','Notes')       // these are the column headings to be shown
    ->setUrl(route('api.urls'))   // this is the route where data will be retrieved
    ->noScript()
    ->render('url.urlShortenerTable') }}

{{Form::close()}}
{{Datatable::table()->script('url.javascript')}}
<a href="#" data-reveal-id="addNew" class="button tiny" style="float: right;">Add New</a>

<a href="#" data-reveal-id="export" class="success button tiny" >Export</a>

<div id="export" class="reveal-modal small" data-reveal>
    {{Form::open(array('action' => 'UrlsController@exportCsv','method'=>'post','id'=>'exportForm'))}}
    <div class="panel">
        <div class="alert alert-box" id="alert" style="display:none;" ><strong ></strong></div>					
        <table class="table">
            <thead>
                <tr>
                    <th>Start date&nbsp;
                        <a href="#" class="button small" id="dp4"  name data-date-format="yyyy-mm-dd" data-date="2012-02-20">Change</a>
                    </th>
                    <th>End date&nbsp;
                        <a href="#" class="button small" id="dp5" data-date-format="yyyy-mm-dd" data-date="2012-02-25">Change</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td ><input type="text" id="startDate" name="start" value="2014-08-01"></td>
                    <td ><input type="text" id="endDate" name="end" value="2014-08-20"></td>
                </tr>
            </tbody>
        </table>
    </div> 
        
    <div class="row">
        {{Form::checkbox('original_url','','',array('id'=>'original_url'))}} 
        {{ Form::label('original_url','URL') }}
    </div>
    <div class="row">    
        {{Form::checkbox('campaign_source_export','','',array('id'=>'campaign_source_export'))}}
        {{ Form::label('campaign_source_export','Source') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('campaign_medium_export','','',array('id'=>'campaign_medium_export'))}}
        {{ Form::label('campaign_medium_export','Medium') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('campaign_content_export','','',array('id'=>'campaign_content_export'))}}
        {{ Form::label('campaign_content_export','Content') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('campaign_name_export','','',array('id'=>'campaign_name_export'))}}
        {{ Form::label('campaign_name_export','Name') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('partner_export','','',array('id'=>'partner_export'))}} 
        {{ Form::label('partner_export','Partner') }}
    </div>
    <div class="row">    
        {{Form::checkbox('channel_export','','',array('id'=>'channel_export'))}} 
        {{ Form::label('channel_export','Channel') }}
    </div>
    <div class="row">    
        {{Form::checkbox('subject_line_export','','',array('id'=>'subject_line_export'))}} 
        {{ Form::label('subject_line_export','Subject Line') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('ShortClicks','','',array('id'=>'ShortClicks'))}} 
        {{ Form::label('ShortClicks','Short URL Clicks') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('LongClicks','','',array('id'=>'LongClicks'))}} 
        {{ Form::label('LongClicks','Long URL Clicks') }}
    </div>
    <div class="row">    
        {{Form::checkbox('Referrer','','',array('id'=>'Referrer'))}} 
        {{ Form::label('Referrer','Top Referrer') }}
    </div>
    <div class="row">    
        {{Form::checkbox('Countries','','',array('id'=>'Countries'))}}
        {{ Form::label('Countries','Top Countries') }}
    </div> 
    <div class="row">    
        {{Form::checkbox('Browsers','','',array('id'=>'Browsers'))}}
        {{ Form::label('Browsers','Top Browsers') }}
    </div>     
    <div class="row">    
        {{Form::checkbox('Platforms','','',array('id'=>'Platforms'))}}
        {{ Form::label('Platforms','Top Platforms') }}
    </div>    
    {{Form::hidden('form1','',['id' => 'form1data'])}}
    
    {{ Form::button('Submit',array('class' => 'small button','id'=>'exportSubmit')) }}
    <!--    {{ Form::submit('Export',array('class' => 'success button tiny')) }}-->
    {{Form::close()}}
    
    <a class="close-reveal-modal">&#215;</a>
</div>

@if ( $errors->count() > 0 )
<div class="alert-box alert">
    <ul>
        @foreach( $errors->all() as $message )
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif


<div id="addNew" class="reveal-modal small" data-reveal>



    {{Form::open(array('action' => 'UrlsController@handleUrlBuilder','method'=>'post','id'=>'addForm','data-abide'=>''))}}


    {{Form::label('website_url', 'Website URL *')}}
    {{ Form::url(
                            'website_url',
                            '',
                           ['required' => '',
                            'placeholder' => 'Enter Website URL'
                           ]
                         )}}
    <small class="error">Website URL is required and must be valid URL.</small>
    {{Form::label('campaign_source', 'Campaign Source *')}}
    {{ Form::text(
                            'campaign_source',
                            '',
                           [
                            'required' => '',
                            //'pattern' => '/^[ A-Za-z0-9_@./#&+-]*$/',
                            'placeholder' => 'Enter Campaign Source'
                           ]
                         )}}
    <small class="error">Campaign Source is required.</small>
    {{Form::label('campaign_medium', 'Campaign Medium *')}}
    {{ Form::text(
                            'campaign_medium',
                            '',
                           [
                            'required' => '',
                            //'pattern' => '[a-zA-Z]+',
                            'placeholder' => 'Enter Campaign Medium'
                           ]
                         )}}
    <small class="error">Campaign Medium is required.</small>
    {{Form::label('campaign_content', 'Campaign Content')}}
    {{ Form::text(
                            'campaign_content',
                            '',
                           [
                            'placeholder' => 'Enter Campaign Content'
                           ]
                           
                         )}}
    {{Form::label('campaign_name', 'Campaign Name *')}}
    {{ Form::text(
                            'campaign_name',
                            '',
                           [
                            'required' => '',
                            //'pattern' => '[a-zA-Z]+',
                            'placeholder' => 'Enter Campaign Name'
                           ]
                         )}}
    <small class="error">Campaign Name is required.</small>

    {{Form::label('subject_line', 'Subject Line')}}
    {{ Form::text(
                            'subject_line',
                            '',
                           [
                            'placeholder' => 'Enter Subject Line'
                           ]
                           
                         )}}
    {{Form::label('wmj_job_number', 'WMJ Job Number')}}
    {{ Form::text(
                            'wmj_job_number',
                            '',
                           [
                            'placeholder' => 'Enter WMJ Job Number'
                           ]
                           
                         )}}
    {{Form::label('message', 'Message')}}
    {{ Form::text(
                            'message',
                            '',
                           [
                            'placeholder' => 'Enter Message'
                           ]
                           
                         )}}
    {{Form::label('partner', 'Partner')}}
    {{ Form::text(
                            'partner',
                            '',
                           [
                            'placeholder' => 'Enter Partner'
                           ]
                           
                         )}}
    {{Form::label('channel', 'Channel')}}
    {{ Form::text(
                            'channel',
                            '',
                           [
                            'placeholder' => 'Enter Channel'
                           ]
                           
                         )}}
    {{Form::label('notes', 'Notes')}}
    {{ Form::text(
                            'notes',
                            '',
                           [
                            'placeholder' => 'Enter Notes'
                           ]
                           
                         )}}
    {{ Form::submit('Submit',array('class' => 'small button')) }}
    {{Form::close()}}
    <a class="close-reveal-modal">&#215;</a>
</div>
<script>
    $(function() {
        window.prettyPrint && prettyPrint();

        $('#dp4').fdatepicker()
                .on('changeDate', function(ev) {
                    if (ev.date.valueOf() > endDate.valueOf()) {
                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                    } else {
                        $('#alert').hide();
                        startDate = new Date(ev.date);
                        $('#startDate').val($('#dp4').data('date'));
                    }
                    $('#dp4').fdatepicker('hide');
                });
        $('#dp5').fdatepicker()
                .on('changeDate', function(ev) {
                    if (ev.date.valueOf() < startDate.valueOf()) {
                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                    } else {
                        $('#alert').hide();
                        endDate = new Date(ev.date);
                        $('#endDate').val($('#dp5').data('date'));
                    }
                    $('#dp5').fdatepicker('hide');
                });

    });
    $('#exportSubmit').click(function() {
        var form1 = $('#exportForm1').serialize();
        $('#form1data').val(form1);
        $('#export').foundation('reveal', 'close');
        $('#exportForm').submit();
    });
    //select all checkbox code.
     $(document).ready(function() {
        $('#selectall').click(function() {  //on click 
            
            if (this.checked) { // check select status
                $('.checkbox-record').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                });
            } else {
                $('.checkbox-record').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                });
            }
        });

    });
    
</script>
@stop