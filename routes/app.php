<?php

Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::view('/', 'root');

//PORTFOLIOS SECTION

$name = ['as' => 'portfolios'];
Route::resource('portfolios', 'Portfolio\PortfolioUnitController', $name)->parameters(['portfolios' => 'portfolio_unit'])->except(['show']);
Route::group(['prefix'=>'portfolios/{portfolio_unit}'], function () use ($name) {
    Route::resource('goals', 'Portfolio\PortfolioGoalController', $name)->parameters(['goals' => 'link'])->except(['show']);
    Route::resource('reports', 'Portfolio\PortfolioReportController', $name)->parameters(['reports' => 'link'])->except(['show']);
    Route::resource('links', 'Portfolio\PortfolioLinkController', $name)->except(['show']);
    Route::resource('comments', 'Portfolio\PortfolioCommentController', $name)->except(['show', 'create']);
});

//PROJECTS SECTION

$name = ['as' => 'projects'];
Route::resource('projects', 'Project\ProjectController', $name)->except(['show']);
Route::group(['prefix'=>'projects/{project}'], function () use ($name) {
    Route::resource('resources', 'Project\ResourceAllocationController', $name)->except(['show'])->parameters(['resources' => 'resource_allocation']);
    Route::resource('evaluations', 'Project\EvaluationScoreController', $name)->parameters(['evaluations' => 'evaluation_score'])->only(['index', 'edit', 'update']);
    Route::resource('reports', 'Project\ProjectReportController', $name)->parameters(['reports' => 'link'])->except(['show']);
    Route::resource('links', 'Project\ProjectLinkController', $name)->except(['show']);
    Route::resource('comments', 'Project\ProjectCommentController', $name)->except(['show', 'create']);
    Route::resource('constraints', 'Project\ProjectConstraintController', $name)->parameters(['constraints' => 'project_order_constraint']);
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
