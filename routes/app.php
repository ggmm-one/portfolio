<?php

Route::view('/', 'root');

Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');

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
    Route::resource('evaluations', 'Project\EvaluationScoreController', $name)->parameters(['evaluations' => 'evaluation_score'])->only(['index', 'edit', 'update']);
    Route::resource('reports', 'Project\ProjectReportController', $name)->parameters(['reports' => 'link'])->except(['show']);
    Route::resource('links', 'Project\ProjectLinkController', $name)->except(['show']);
    Route::resource('comments', 'Project\ProjectCommentController', $name)->except(['show', 'create']);
    Route::resource('constraints', 'Project\ProjectConstraintController', $name)->parameters(['constraints' => 'project_order_constraint']);
});

//RESOURCES SECTION

$name = ['as' => 'resources'];
Route::view('resources', 'resources.root')->name('resources.root');
Route::resource('resources/resource_owners', 'Resource\ResourceOwnerController', $name)->except(['show']);
Route::resource('resources/resources', 'Resource\ResourceController', $name)->except(['show']);
Route::group(['prefix'=>'resources/{resource}'], function () use ($name) {
    Route::resource('capacities', 'Resource\ResourceCapacityController', $name)->parameters(['capacities' => 'resource_capacity'])->except(['show']);
    Route::resource('comments', 'Resource\ResourceCommentController', $name)->except(['show', 'create']);
});

// ADMIN SECTION

$name = ['as' => 'admin'];
Route::view('admin', 'admin.root')->name('admin.root');
Route::get('admin/settings/edit', 'Admin\SettingController@edit')->name('admin.settings.edit');
Route::patch('admin/settings', 'Admin\SettingController@update', $name)->name('admin.settings.update');
Route::resource('admin/evaluation_items', 'Admin\EvaluationItemController', $name)->except(['show']);
Route::resource('admin/resource_types', 'Admin\ResourceTypeController', $name)->except(['show']);
Route::resource('admin/users', 'Admin\UserController', $name)->except(['show']);
Route::resource('admin/roles', 'Admin\RoleController', $name)->except(['show']);
