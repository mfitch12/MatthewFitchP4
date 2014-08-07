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

Route::get('/', function(){
    $paragraphs = 0;
    return View::make('index')
        ->with('paragraphs', $paragraphs);
});

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
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
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

Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

Route::get('/practice-creating', function() {

    # Instantiate a new Book model class
    $resume = new Resume();

    # Set 
    $resume->resume_title = 'Resume1';
    $resume->name = 'Matthew Fitch';
    $resume->address = '570 Pleasant Street, Marshfield, MA 02050';
    $resume->email = 'mrf088@gmail.com';
    $resume->job_title = 'Verizon Wireless - Retail Sales';
    $resume->job_description = 'sales, customer service, IT support';
    $resume->school_name = 'University of Maine';

    # This is where the Eloquent ORM magic happens
    $resume->save();

    return 'A new resume has been added! Check your database to see...';

});

Route::get('/practice-reading', function() {

    # The all() method will fetch all the rows from a Model/table
    $resumes = Resume::all();

    # Typically we'd pass $books to a View, but for quick and dirty demonstration, let's just output here...
    
        echo Pre::r($resumes);
  

});

Route::get('/practice-reading-one-resume', function() {

    # The all() method will fetch all the rows from a Model/table
    $resume = Resume::where('name', 'LIKE', '%Fitch%')->first();

        //returns the email address for the first person with name like Fitch
        return $resume->email;

});

Route::get('/practice-updating', function(){

    //get resume with email address mrf088@gmail.com
    $resume = Resume::where('email', 'LIKE', '%mrf088%') -> first();

    //change the address to PO Box
    $resume->address = 'PO Box 58, Marshfield Hills, MA 02051';

    //Save changes
    $resume->save();

    return "update complete. check database for changes";


});

Route::get('/practice-deleting', function(){

    //get resume with email address mrf088@gmail.com
    $resume = Resume::where('email', 'LIKE', '%mrf088%') -> first();

    //delete row
    $resume->delete();

    return "deletion complete. check database for changes";


});

Route::get('/truncate', function() {

    # Clear the tables to a blank slate
    DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
    DB::statement('TRUNCATE resumes');
    DB::statement('TRUNCATE users');
 
});

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


Route::get('/resume', function() {


    $input = '';

    return View::make('resume')
        ->with('input', $input);
});

Route::get('/test2', function(){

    $user = Auth::user();
    return $user->resume_count;
});


Route::post('/resume', function(){
    //$input = implode(Input::all());
   


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
    //get resume with email address mrf088@gmail.com

    $count = $currentUser->resume_count;
    //change the address to PO Box
    $currentUser->resume_count = $count + 1;

    //Save changes
    $currentUser->save();


    //print_r($input);

    return Redirect::to('/yourResume');



});

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

//Route::pattern('id', '[0-9]+');

Route::get('genResume/{resumeTitle}', function($resumeId)
{
    $resume = Resume::where('id', '=', $resumeId)->first();

        //returns the email address for the first person with name like Fitch

    $resumeTitle = $resume->resume_title;
    $name = $resume->name;
    $address = $resume->address;
    $email = $resume->email;
    $jobTitle = $resume->job_title;
    $jobDescription = $resume->job_description;
    $schoolName = $resume->school_name;


    return View::make('genResume')
        ->with('resumeTitle', $resumeTitle)
        ->with('name', $name)
        ->with('address', $address)
        ->with('email', $email)
        ->with('jobTitle', $jobTitle)
        ->with('jobDescription', $jobDescription)
        ->with('schoolName', $schoolName);

});



Route::get('/test', function()
{
	echo 'Hello World';
});


Route::get('/practice', function() {

    echo App::environment();

});

