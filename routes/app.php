<?php

Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::view('/', 'root');

//PORTFOLIOS SECTION

Route::resource('portfolio_units', 'PortfolioUnitController')->except(['show']);
Route::group(['prefix'=>'portfolio_units/{portfolio_unit}'], function () {
    Route::resource('links', 'LinkController', ['as' => 'portfolio_units.goals'])->except(['show']);
    Route::resource('links', 'LinkController', ['as' => 'portfolio_units.reports'])->except(['show']);
    Route::resource('links', 'LinkController', ['as' => 'portfolio_units'])->except(['show']);
    Route::resource('comments', 'CommentController', ['as' => 'portfolio_units'])->except(['show', 'create']);
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
