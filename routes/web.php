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
  //***START***
  Route::get('/','auth\LoginController@show');
  Auth::routes();

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/authenticity', 'HomeController@show');

//**ADMIN**
Route::group(['middleware'=>['auth','admin']], function(){
     //**ADMIN-DASHBOARD**
     Route::get('/dashboard','Admin\DashboardController@show');

     //**ADMIN CRUD**
     Route::get('/users','Admin\DashboardController@showUsers');
     Route::get('/role-edit/{id}','Admin\DashboardController@registerEdit');
     Route::put('role-update/{id}','Admin\DashboardController@registerUpdate');
     Route::delete('/user-delete/{id}','Admin\DashboardController@delete');

     //**ABOUT US PAGE**
     Route::get('/abouts','Admin\AboutusController@index');

     //**BOOKS CRUD**
     Route::get('/books','Admin\BooksController@showBooks');
     Route::post('/save-book','Admin\BooksController@save');
     Route::get('/book-edit/{book_id}','Admin\BooksController@edit')->name('booksedit');
     Route::put('/books-update/{book_id}','Admin\BooksController@update');
     Route::delete('/book-delete/{book_id}','Admin\BooksController@delete');
     Route::get('/search','Admin\BooksController@search');

     //**FINE DETAILS**
     Route::get('/fine','IssueController@fine');
});


//**STUDENT**
Route::group(['middleware'=>['auth','student']], function(){
     //**DASHBOARD**
     Route::get('/student-dashboard','Nonadmin\DashboardController@show');

     //**USER-PROFILE**
     Route::get('/student-profile/{id}','Nonadmin\DashboardController@showProfile');
     Route::put('/student-profile-update/{id}','Nonadmin\DashboardController@profileUpdate');

     //**BOOKS-ISSUE**
     Route::get('/studentbooks','IssueController@studentIndex');
     Route::get('/issueupdate/{book_id}','Nonadmin\DashboardController@issueBook');

     //**BOOKS-REISSUE-RETURN**
     Route::get('/reissueupdate/{id}/{book_id}','Nonadmin\DashboardController@reissueBook');
     Route::get('/finebooks','IssueController@fineBooks');
     Route::match(['get', 'delete'],'/return/{id}/{book_id}','Nonadmin\DashboardController@return');
});
