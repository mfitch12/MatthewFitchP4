@extends('_master')

@section('title')
    {{$resumeTitle}}
@stop

@section('description')

@stop

@section('head')
    
@stop

@section('header')
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <li><a href="/resume">Resume Builder</a></li>
          <li><a href="/yourResume">My Resumes</a></li>
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop

@section('content')
	<div class = "row">
		<div class = "col-md-12">
			<h3 class="text-center">{{$name}}</h3>
			<h5 class="text-center">{{$address}}</h5>
			<h5 class="text-center">{{$email}}</h5>
			<h4>Work Experience</h4>
			<br>
			<h5>{{$jobTitle}}</h5>
			<p>&nbsp&nbsp&nbsp{{$jobDescription}}</p>
			<br>
			<h4>Education</h4>
			<br>
			<h5>{{$schoolName}}<h5>
		</div>
	</div>

	<div class="footer">
	<p>	


	</p>

		</div>
@stop

@section('footer')
   
@stop