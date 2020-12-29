<?php

use App\Providers\RouteServiceProvider;

Route::view(RouteServiceProvider::HOME, 'root');

Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('auth/password/request', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('auth/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');

//PORTFOLIOS SECTION

Route::resource('portfolios', 'PortfolioController')->except(['show']);
Route::group(['prefix'=>'portfolios/{portfolios}'], function () {
    Route::resource('goals', 'LinkController', ['as' => 'portfolios', 'parameters' => ['goals' => 'link']])->except(['show']);
    Route::resource('reports', 'LinkController', ['as' => 'portfolios', 'parameters' => ['reports' => 'link']])->except(['show']);
    Route::resource('links', 'LinkController', ['as' => 'portfolios'])->except(['show']);
    Route::resource('comments', 'CommentController', ['as' => 'portfolios'])->except(['show', 'create']);
});

//PROJECTS SECTION

Route::resource('projects', 'ProjectController')->except(['show']);
Route::group(['prefix'=>'projects/{project}'], function () {
    Route::resource('resource_allocations', 'ResourceAllocationController')->except(['show']);
    Route::resource('evaluation_scores', 'EvaluationScoreController')->only(['index', 'edit', 'update']);
    Route::resource('reports', 'LinkController', ['as' => 'projects', 'parameters' => ['reports' => 'link']])->except(['show']);
    Route::resource('links', 'LinkController', ['as' => 'projects'])->except(['show']);
    Route::resource('comments', 'CommentController', ['as' => 'projects'])->except(['show', 'create']);
    Route::resource('project_order_constraints', 'ProjectOrderConstraintController')->except(['show', 'edit']);
});

//RESOURCES SECTION

Route::resource('resource_owners', 'ResourceOwnerController')->except(['show']);
Route::resource('resources', 'ResourceController')->except(['show']);
Route::group(['prefix'=>'resources/{resource}'], function () {
    Route::resource('resource_capacities', 'ResourceCapacityController')->except(['show']);
    Route::resource('comments', 'CommentController', ['as' => 'resources'])->except(['show', 'create']);
});

// ADMIN SECTION

Route::resource('settings', 'SettingController')->only(['index', 'update']);
Route::resource('evaluation_items', 'EvaluationItemController')->except(['show']);
Route::resource('resource_types', 'ResourceTypeController')->except(['show']);
Route::resource('users', 'UserController')->except(['show']);
Route::resource('roles', 'RoleController')->except(['show']);
