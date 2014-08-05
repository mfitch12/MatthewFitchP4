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


Route::get('/resume', function() {


    $input = '';

    return View::make('resume')
        ->with('input', $input);
});

Route::post('/resume', function(){
    //$input = implode(Input::all());
    $input = Input::all();
    //print_r($input);

    return View::make('resume')
        ->with('input', $input);

});


Route::get('/usergenerator', function(){
    
    $users = 0;
    $userAddress = 'off';
    $profile = 'off';
    $userString = '';

    return View::make('usergenerator')
        ->with('users', $users)
        ->with('userAddress', $userAddress)
        ->with('profile', $profile)
        ->with('userString', $userString);

});

Route::post('/usergenerator', function(){
    
    //$input = Input::all();
    //print_r($input);

    $users = Input::get('numberOfUsers');
    $userAddress = Input::get('userAddress', 'off');
    $profile = Input::get('profile', 'off');
    $userString = '';

    $faker = Faker\Factory::create();
    
    if($userAddress == 'off' && $profile == 'off')
    {
        for ($i=0; $i < $users; $i++)
        {
            $userString .= $faker->name."<br><br>";
        }
    }

    if($userAddress == 'on' && $profile == 'off')
    {
        for ($i=0; $i < $users; $i++)
        {
            $userString .= $faker->name."<br>".$faker->address."<br><br>";
        }
    }

    if($userAddress == 'off' && $profile == 'on')
    {
        for ($i=0; $i < $users; $i++)
        {
            $userString .= $faker->name."<br>".$faker->text."<br><br>";
        }
    }

    if($userAddress == 'on' && $profile == 'on')
    {
        for ($i=0; $i < $users; $i++)
        {
            $userString .= $faker->name."<br>".$faker->address."<br>".$faker->text."<br><br>";
        }
    }

    return View::make('usergenerator')
        ->with('users', $users)
        ->with('userAddress', $userAddress)
        ->with('profile', $profile)
        ->with('userString', $userString);

});


Route::get('/test', function()
{
	echo 'Hello World';
});


Route::get('/practice', function() {

    echo App::environment();

});

