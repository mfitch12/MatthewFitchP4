@extends('_master')

@section('title')
    Resume Builder
@stop

@section('description')
	Select one of the options below.
@stop

@section('head')
    
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/resume">Resume Builder</a></li>
          <li><a href="/usergenerator">Other Button</a></li>
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop

@section('content')

	<div class = "row">
		<div class = "col-md-6">
			<h4>Development Tools:</h4>
			<a href = '/resume' role="button" class="btn btn-default">Resume Builder</a>
			<br><br>
			<a href = '/usergenerator' role="button" class="btn btn-default">other button</a>
			<br><br>
		</div>

	</div>


@stop

@section('footer')
   
@stop