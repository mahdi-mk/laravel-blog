<?php

// Articles
Route::get('/', 'ArticleController@index')->name('article.home');
Route::get('/explore', 'ArticleController@explore')->name('article.explor');
Route::get('/articles/create', 'ArticleController@create')->name('article.create');
Route::post('/articles/create', 'ArticleController@store');
Route::get('/articles/{article}/edit', 'ArticleController@edit')->name('article.edit');
Route::patch('/articles/{article}', 'ArticleController@update');
Route::get('/articles/{article}/{slug}', 'ArticleController@show')->name('article.show');
Route::delete('/articles/{article}', 'ArticleController@destroy')->name('article.destroy');

// Categories
Route::get('/categories', 'CategoryController@index')->name('categories.home');
Route::get('/categories/create', 'CategoryController@create')->name('category.create');
Route::post('/categories/create', 'CategoryController@store');
Route::get('/categories/{category}/{slug}', 'CategoryController@show')->name('category.show');
// Route::put('/categories/{category}', 'CategoryController@update');

// Auth
Auth::routes();

// Profile
Route::get('/profile/{user}/edit','UserController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'UserController@update');
Route::delete('/profile/{user}/delete','UserController@delete')->name('profile.destroy');
Route::get('/profile/{user}/{slug}', 'UserController@index')->name('profile');

// Search
Route::any('/search', 'SearchController@index')->name('search');

// Dashboard
Route::get('/dashboard', 'AdminController@index')->name('dashboaed.home');
Route::get('/dashboard/articles', 'AdminController@articles')->name('articles');
Route::get('/dashboard/categories', 'AdminController@categories')->name('categories');
Route::get('/dashboard/users', 'AdminController@users')->name('users');


// Route::post('/roles/new', 'UserController@storeRole');

// Route::get('/abilities/new', 'UserController@createAbility');
// Route::post('/abilities/new', 'UserController@storeAbility');

Route::get('/roles/assign', 'UserController@assign');
Route::post('/roles/assign', 'UserController@assignTo');









