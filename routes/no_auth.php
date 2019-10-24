<?php

Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('auth/password/request', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('auth/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
