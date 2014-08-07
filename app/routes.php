<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'ResumeController@getIndex');

Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->email    = Input::get('email');

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/')->with('flash_message', 'Welcome to Resume Builder!');

        }
    )
);

Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'username or password incorrect. please try again.');
            }

            return Redirect::to('login');
        }
    )
);

# /app/routes.php
Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

Route::get('/resume', 'ResumeController@getResume');

Route::post('/resume', 'ResumeController@postResume');

Route::get('/{format?}', 
    array(
        'before' => 'auth', 
        function($format = 'yourResume') {
            # rest of your list code goes here...
                $users = 0;
                $userAddress = 'off';
                $profile = 'off';
                $userString = '';

                $userName = Auth::user()->email;

                $resumes = Resume::where('user_name', '=', $userName)->get(/**(array('resume_title'))**/);

                $titleList = '';

                $x = 0;
                foreach($resumes as $title)
                {
                    $x++;
                    if($title->resume_title != '')
                    {
                        $titleList .= '<a href="/genResume/'.$title->id.'">'.$title->resume_title.'</a><br><br>' ;
                    }
                    else
                    {
                        $titleList .= '<a href="/genResume/'.$title->id.'">'.'RESUME HAS NO TITLE'.'</a><br><br>' ;
                    }

                }

                

                return View::make('yourResume')

                    ->with('resumeLinks', $titleList);
        }
    )
);


Route::get('genResume/{resumeId}', 'ResumeController@getGenResume');

Route::get('deleteResume/{resumeId}', 'ResumeController@getDeleteResume');




