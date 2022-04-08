<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware'=>['auth','admin']], function(){
  Route::get('/dashboard', function () {
      return view('admin.dashboard');
  });
  Route::get('/role-register','Admin\DashboardController@registered');
  Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');
  Route::put('role-register-update/{id}','Admin\DashboardController@registerupdate');
  Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');
  Route::get('/abouts','Admin\AboutusController@index');
  Route::get('/books','Admin\BooksController@index');
  Route::post('/save-books','Admin\BooksController@save');
  Route::get('/booksedit/{book_id}','Admin\BooksController@edit');
  Route::put('/books-update/{book_id}','Admin\BooksController@update');
  Route::delete('/books-delete/{book_id}','Admin\BooksController@delete');
  Route::get('/search','Admin\BooksController@search');


});

Route::group(['middleware'=>['auth','student']], function(){
  Route::get('/student-dashboard', function () {
      return view('nonadmin.dashboard');
  });
});
