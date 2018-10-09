<?php

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');



// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

});



/////////////////////////////////////////////////////////Dashboard//////////////////////////////////////////////////////////
/// Departs Dashboard
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/departs', 'Admin\departsController');
    Route::get('/all_departs', 'Admin\departsController@get_departs');

    Route::resource('/serieses', 'Admin\depart_seriesesController');
    Route::get('/all_serieses/{filter}', 'Admin\depart_seriesesController@get_serieses');

    Route::resource('/articles', 'Admin\depart_articlesController');
    Route::get('/all_articles/{filter}', 'Admin\depart_articlesController@get_articles');


    Route::resource('/books', 'Admin\depart_booksController');
    Route::get('/all_books/{filter}', 'Admin\depart_booksController@get_books');



    Route::resource('/news', 'Admin\newsController');
    Route::get('/all_news', 'Admin\newsController@get_news');

    Route::resource('/blogs', 'Admin\blogsController');
    Route::get('/all_blogs', 'Admin\blogsController@get_blogs');

    Route::resource('/blog_articles', 'Admin\blog_articlesController');
    Route::get('/all_blog_articles/{filter}', 'Admin\blog_articlesController@get_articles');

    Route::resource('/homeslides', 'Admin\sliderHomeController');
    Route::get('/all_slides', 'Admin\sliderHomeController@get_slides');


    Route::resource('/homedetails', 'Admin\homeDetailscontroller');

    Route::resource('/messages', 'Admin\homeFrontController');
    Route::get('/all_messages', 'Admin\homeFrontController@get_messages');

    Route::resource('/infos', 'Admin\infosController');




});



/////////////////////////////////////////////////////////Dashboard//////////////////////////////////////////////////////////
///
/// /////////////////////////////////////////////////////////front//////////////////////////////////////////////////////////


Route::resource('/', 'front\homeController');
Route::post('storemsg', 'front\homeController@store');
Route::get('contact', 'front\homeController@create');
Route::post('storecont', 'front\homeController@store_contact');


Route::resource('/departs', 'front\departsController');
Route::resource('/series', 'front\depart_seriesController');
Route::resource('/depart_articles', 'front\depart_articlesController');
Route::resource('/books', 'front\depart_booksController');
Route::resource('/news', 'front\newsController');
Route::resource('/blogs', 'front\blogController');
Route::resource('/blog_articles', 'front\blog_articlesController');
Route::resource('/who_we_are', 'front\infosController');
Route::resource('/users', 'front\userController');
Route::post('login','front\userController@login');
Route::get('logout','front\userController@logout');

Route::get('login/facebook', 'front\userController@redirectToProvider');
Route::get('login/facebook/callback', 'front\userController@handleProviderCallback');

//add comment to series Route For Front
Route::post('comment','front\userController@add_comment_rate_to_series');

//add comment to book Route For Front
Route::post('book_comment','front\userController@add_comment_rate_to_book');

//add comment to depart_article Route For Front
Route::post('depart_article_comment','front\userController@add_comment_rate_to_depart_article');

//add comment to new Route For Front
Route::post('news_comment','front\userController@add_comment_to_new');

//add comment to blog article Route For Front
Route::post('blog_article_comment','front\userController@add_comment_to_blog_article');

//search Route For Front
Route::get('search/{search}','front\homeController@search');
/// /////////////////////////////////////////////////////////front//////////////////////////////////////////////////////////



