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
  Route::get('/fine','IssueController@fine');


});

Route::group(['middleware'=>['auth','student']], function(){
  Route::get('/student-dashboard', function () {
      return view('nonadmin.dashboard');
  });

  Route::get('/studentprofile/{id}','Nonadmin\DashboardController@index');
  Route::put('/student-profile-update/{id}','Nonadmin\DashboardController@profileupdate');
  Route::get('/studentbooks','IssueController@studentindex');
  Route::get('/issueupdate/{book_id}','IssueController@issue_update');
  Route::get('/reissueupdate/{id}/{book_id}','IssueController@reissue_update');
  Route::get('/finebooks','IssueController@finebooks');
  Route::delete('/return/{id}/{book_id}','IssueController@return');
});
