@extends('_master')

@section('title')
    Your Resumes
@stop

@section('description')
	Select the resume you wish to view or edit below
@stop

@section('head')
    
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <li><a href="/resume">Resume Builder</a></li>
          <li class="active"><a href="/yourResume">Other Button</a></li>
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop

@section('content')
	<div class = "row">
		<div class = "col-md-12">
			<?php echo $resumeLinks ?>
		</div>
	</div>

	<div class="footer">
	<p>	


	</p>

		</div>
@stop

@section('footer')
   
@stop