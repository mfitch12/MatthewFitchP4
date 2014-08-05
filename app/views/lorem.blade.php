@extends('_master')

@section('title')
    Lorem Ipsum Generator
@stop

@section('description')
	Fill out the options below and click "Generate" to create lorem ipsum paragraphs.
@stop

@section('head')
    
@stop

@section('header')
    
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <li class="active"><a href="/lorem">Lorem</a></li>
          <li><a href="/usergenerator">Users</a></li>
        </ul>
        <h3 class="text-muted">Developer's Best Friend</h3>
      </div>
@stop

@section('content')
	  <div class = "row">
		<div class = "col-md-6">
		<form role="form" method="post">
		  
		  <div class="form-group">
		    <label for="numberOfWords"># of paragraphs</label>
		    <input maxlength=2 type="text" name = "numberOfParagraphs" id="numWords" value = {{{ $paragraphs }}}> (Max 99)
		  </div>
		  <button type="submit" class="btn btn-success">Generate</button>
		  <br><br>
		</form>
	</div>
	<div class = "col-md-6">
		<p>Other Developer Tools:</p>
		<a href = '/usergenerator' role="button" class="btn btn-default">Random User Generator</a>
		<br><br>
	</div>
	</div>

	<div class="footer">
	<p>	
		# of paragraphs: {{{ $paragraphs }}} <br><br>
	</p>
			<section>
		<p>
		{{$lorem}}
		</section>
		</div>
@stop

@section('footer')


   
@stop