@extends('_master')

@section('title')
    Resume Generator
@stop

@section('description')
	Fill out the options below and click "Generate Resume" to create your resume.
@stop

@section('head')
    
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <li class="active"><a href="/resume">Resume Builder</a></li>
          <li><a href="/usergenerator">Other Button</a></li>
        </ul>
        <h3 class="text-muted">Resume Builder</h3>
      </div>
@stop

@section('content')
	  <div class = "row">
		<div class = "col-md-12">
		<form role="form" method="post">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Name</label>
		    <input type="text" class="form-control" name="nameInput" id="exampleInputEmail1" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Address</label>
		    <input type="text" class="form-control" name="addressInput" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="text" class="form-control" name="emailInput" id="exampleInputEmail1" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Job Title</label>
		    <input type="text" class="form-control" name="jobInput" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Job Description</label>
		    <input type="text" class="form-control" name="descriptionInput" id="exampleInputEmail1" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">School Name</label>
		    <input type="text" class="form-control" name="schoolInput" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <button type="submit" class="btn btn-success">Generate Resume</button>
		  <br><br>
		</form>
	</div>

	</div>

	<div class="footer">
		<p>	
			input: <?echo Pre::r($input)?> <br><br>
		</p>	
	</div>
@stop

@section('footer')


   
@stop