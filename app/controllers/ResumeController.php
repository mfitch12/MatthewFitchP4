<?php

class ResumeController extends BaseController{

	/*
	public function __construct(){
		//anything here would happen before any of the other actions
	}
	*/

	public function getResume()
	{
	    if (Auth::check())
			{
		        return View::make('resume');
		    }
		    else
		    {
		        return Redirect::to('/login');
		    }
	}

	public function postResume()
	{
		$resumeTitle = Input::get('titleInput', 'blank');
	    $name = Input::get('nameInput', 'blank');
	    $address = Input::get('addressInput', 'blank');
	    $email = Input::get('emailInput', 'blank');
	    $jobTitle = Input::get('jobInput', 'blank');
	    $jobDescription = Input::get('descriptionInput', 'blank');
	    $schoolName = Input::get('schoolInput', 'blank');
	    $user = Auth::user()->email;

	    $input = $resumeTitle;

	    # Instantiate a new Resume model class
	    $resume = new Resume();

	    # Set 
	    $resume->resume_title = $resumeTitle;
	    $resume->name = $name;
	    $resume->address = $address;
	    $resume->email = $email;
	    $resume->job_title = $jobTitle;
	    $resume->job_description = $jobDescription;
	    $resume->school_name = $schoolName;
	    $resume->user_name = $user;

	    # This is where the Eloquent ORM magic happens
	    $resume->save();

	    $currentUser = Auth::user();

	    $count = $currentUser->resume_count;

	    $currentUser->resume_count = $count + 1;

	    //Save changes
	    $currentUser->save();

	    return Redirect::to('/yourResume');
	}




}