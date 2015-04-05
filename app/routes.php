<?php

Route::get('/', function(){
	return View::make('hello');
	});

Route::get('Users',function(){
	return View::make('Users.index');
});

Route::any('users',array(
		'as' => 'transactionUpdate',
		'uses' => 'UsersController@transactionUpdate'
	));

Route::get('admins',function(){
	return View::make('admins.index');
});

Route::any('users_login',array(
		'as' => 'login',
		'uses' => 'AdminsController@login'
	));

Route::any('admins_login',array(
		'as' => 'ulogin',
		'uses' => 'AdminsController@login'
	));

Route::any('add',function(){
		return View::make('admins.edit');
	});

Route::any('removeUser',array(
		'as' => 'removeUser',
		'uses' => 'AdminsController@removeUser'
	    ));

Route::any('remove',function(){
		return View::make('admins.removeEmployee');
	});

Route::any('orderStock',array(
		'as' => 'removeUser',
		'uses' => 'AdminsController@orderStock'
	    ));

Route::any('reorder',function(){
		return View::make('admins.orderStock');
	});

Route::any('deprecate',array(
		'as' => 'deprecateProduct',
		'uses' => 'AdminsController@deprecateProduct'
	    ));

Route::any('revoke',array(
		'as' => 'revokeProduct',
		'uses' => 'AdminsController@revokeProduct'
	    ));

Route::any('dep',function(){
		return View::make('admins.deprecate');
	});

Route::any('genChart', function(){
	return View::make('admins.chartGenerationTool');
});

Route::any('generate',array(
		'as' => 'getChart',
		'uses' => 'AdminsController@getChart'
	    ));