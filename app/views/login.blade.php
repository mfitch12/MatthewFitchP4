@extends('_master')

@section('title')
Log in
@stop

@section('description')
    @if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
        <br>
    @endif
{{ Form::open(array('url' => '/login')) }}

    Email<br>
    {{ Form::text('email') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop