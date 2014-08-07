@extends('_master')

@section('title')
    Resume Builder
@stop

@section('description')
	{{$signedIn}}
@stop

@section('head')
    
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/resume">Resume Builder</a></li>
        
        @if(Auth::check())
          <li><a href="/yourResume">Your Resumes</a></li>
        @endif
        
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop

@section('content')

	<div class = "row">
		<div class = "col-md-6">
			<h4>Tools:</h4>
			<a href = '/resume' role="button" class="btn btn-default">Resume Builder</a>
			<br><br>
			<a href = '/yourResume' role="button" class="btn btn-default">Your Resumes</a>
			<br><br>
		</div>

	</div>


@stop

@section('footer')
   
@stop