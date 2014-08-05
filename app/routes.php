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


Route::get('/lorem', function() {


    $paragraphs = 0;
    $lorem = '';
    return View::make('lorem')
        ->with('paragraphs', $paragraphs)
        ->with('lorem', $lorem);
});

Route::post('/lorem', function(){
    $input = Input::all();
    //print_r($input);

    $numParagraphs = $input['numberOfParagraphs'];

    $generator = new Badcow\LoremIpsum\Generator();
    $paragraphs = $generator->getParagraphs($numParagraphs);
    $allParagraphs = implode('<p>', $paragraphs);

    return View::make('lorem')
        ->with('paragraphs', $numParagraphs)
        ->with('lorem', $allParagraphs);

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

