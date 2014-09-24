@extends('login.layout-login')
@section('content')

<form method="POST" action="{{ URL::to('/users/forgot_password') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
<fieldset>
    @if (Session::get('error'))
        <div class="alert-box alert" >{{{ Session::get('error') }}}</div>
    @endif

    @if (Session::get('notice'))
        <div class="alert-box secondary">{{{ Session::get('notice') }}}</div>
    @endif
    <div class="form-group">
        <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>

            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}" >
            </div>
            
            <div class="form-group">
                <button class="btn btn-default" type="submit" >{{{ Lang::get('confide::confide.forgot.submit') }}} </button>
            

        </div>
   
    
</fieldset>
</form>
@stop