
@extends('_master')

@section('title')
Sign up
@stop

@section('description')
{{ Form::open(array('url' => '/signup')) }}

    Email<br>
    {{ Form::text('email') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop