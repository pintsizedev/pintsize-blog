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

Route::get('/', array('as' => 'home', function()
{
    $data = array();
    $post = new Post();
    $data['posts'] = $post->getPosts();
    return View::make('home', $data);
}));

Route::get('login', array('as' => 'login', function()
{
    return View::make('login');
})) -> before('guest');

Route::post('login', function()
{
    $user = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );

    if (Auth::attempt($user)) {
        return Redirect::route('home')
            -> with('flash_notice', 'You successfully logged in!');
    }

    //Failed, lets go back to the login page
    return Redirect::route('login')
        -> with('flash_error', 'Your username/password combo was wrong!')
        -> withInput();
});

Route::get('logout', array('as' => 'logout', function()
{
    Auth::logout();

    return Redirect::route('home')
        -> with('flash_notice', 'You successfully logged out!');

})) -> before('auth');

Route::get('profile', array('as' => 'profile', function()
{
    return View::make('profile');
})) -> before('auth');


Route::get('post', array('as' => 'post', function()
{
    return View::make('post');
})) -> before('auth');

Route::post('post', function()
{
    $post = new Post();
    $postData = array(
        'title' => Input::get('title'),
        'content' => Input::get('content'),
        'tags' => Input::get('tags'),
        'permalink' => Input::get('permalink'),
    );
    $postedConfirmation = $post->createPost($postData);
    if($postedConfirmation['status']) {
        return Redirect::route('home')
            -> with('flash_notice', $postedConfirmation['message']);
    }
    else {
        return Redirect::route('post')
            -> with('flash_notice', $postedConfirmation['message']);
    }
}) -> before('auth');

Route::get('view/{permalink}', function($permalink)
{
    $post = new Post();
    $data = $post->getPostByPermalink($permalink);
    return View::make('viewPost', $data);
});

Route::post('search', array('as' => 'search', function()
{
    $post = new Post();
    $posts = $post->searchPosts(Input::get('criteria'));
    return Redirect::route('results')->with('results', $posts);
}));

Route::get('search', array('as' => 'results', function()
{
    if(Session::get('results'))
    {
        $data['posts'] = Session::get('results');
        $data['hasSearched'] = true;
    }
    return View::make('home', $data);
}));

Route::get('tags', function()
{
    $tag = new Tag();
    $data['tags'] = $tag->getTags();
    return View::make('tags', $data);
});

Route::post('addComment', function()
{

});