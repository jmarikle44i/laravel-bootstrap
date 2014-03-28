<?php
App::before(function($request)
{
	// Get the URL segment to use for routing
	$urlSegment = Config::get('laravel-bootstrap::app.access_url');

	// Filter all requests ensuring a user is logged in when this filter is called
	Route::filter('adminFilter', 'Davzie\LaravelBootstrap\Filters\Admin');

	Route::group(array('namespace' => 'Davzie\LaravelBootstrap\Controllers', 'prefix' => $urlSegment), function()
	{
		Route::controller( '/users'     , 'UsersController' );
		Route::controller( '/galleries' , 'GalleriesController' );
		Route::controller( '/settings'  , 'SettingsController' );
		Route::controller( '/blocks'    , 'BlocksController' );
		Route::controller( '/posts'     , 'PostsController' );
		Route::controller( '/'          , 'DashController'  );
	});
});

/** Include IOC Bindings **/
include __DIR__.'/bindings.php';
