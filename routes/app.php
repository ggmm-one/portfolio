<?php

Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::view('/', 'root');

//PORTFOLIOS SECTION

Route::resource('portfolio_units', 'PortfolioUnitController')->except(['show']);
Route::group(['prefix'=>'portfolios/{portfolio_unit}'], function () {
    Route::resource('goals', 'PortfolioGoalController')->except(['show']);
    Route::resource('reports', 'PortfolioReportController')->except(['show']);
    Route::resource('links', 'PortfolioLinkController')->except(['show']);
    Route::resource('comments', 'PortfolioCommentController')->except(['show', 'create']);
});

//PROJECTS SECTION

Route::resource('projects', 'ProjectController')->except(['show']);
Route::group(['prefix'=>'projects/{project}'], function () {
    Route::resource('resource_allocations', 'ResourceAllocationController')->except(['show']);
    Route::resource('evaluation_scores', 'EvaluationScoreController')->only(['index', 'edit', 'update']);
    Route::resource('links', 'ProjectReportController')->except(['show']);
    Route::resource('links', 'ProjectLinkController')->except(['show']);
    Route::resource('comments', 'ProjectCommentController')->except(['show', 'create']);
    Route::resource('project_order_constraints', 'ProjectOrderConstraintController')->except(['show', 'edit']);
});

//RESOURCES SECTION

Route::resource('resource_owners', 'ResourceOwnerController')->except(['show']);
Route::resource('resources', 'ResourceController')->except(['show']);
Route::group(['prefix'=>'resources/{resource}'], function () {
    Route::resource('resource_capacities', 'ResourceCapacityController')->except(['show']);
    Route::resource('comments', 'ResourceCommentController')->except(['show', 'create']);
});

// ADMIN SECTION

Route::resource('settings', 'SettingController')->only(['index', 'update']);
Route::resource('evaluation_items', 'EvaluationItemController')->except(['show']);
Route::resource('resource_types', 'ResourceTypeController')->except(['show']);
Route::resource('users', 'UserController')->except(['show']);
Route::resource('roles', 'RoleController')->except(['show']);
