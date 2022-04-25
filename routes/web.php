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
  //Route::get('/','HomeController@show');
  Auth::routes();
  Route::get('/home', 'HomeController@index')->name('home');

                    //**ADMIN**
Route::group(['middleware'=>['auth','admin']], function(){
                    //**ADMIN-DASHBOARD**
     Route::get('/','Admin\DashboardController@show');
     Route::get('/dashboard','Admin\DashboardController@show');

                    //**ADMIN CRUD**
     Route::get('/role-register','Admin\DashboardController@registered');
     Route::get('/role-edit/{id}','Admin\DashboardController@registerEdit');
     Route::put('role-register-update/{id}','Admin\DashboardController@registerUpdate');
     Route::delete('/role-delete/{id}','Admin\DashboardController@registerDelete');

                    //**ABOUT US PAGE**
     Route::get('/abouts','Admin\AboutusController@index');

                    //**BOOKS CRUD**
     Route::get('/books','Admin\BooksController@index');
     Route::post('/save-books','Admin\BooksController@save');
     Route::get('/booksedit/{book_id}','Admin\BooksController@edit');
     Route::put('/books-update/{book_id}','Admin\BooksController@update');
     Route::delete('/books-delete/{book_id}','Admin\BooksController@delete');
     Route::get('/search','Admin\BooksController@search');

                    //**FINE DETAILS**
     Route::get('/fine','IssueController@fine');
});


                  //**STUDENT**
Route::group(['middleware'=>['auth','student']], function(){
                  //**DASHBOARD**
     Route::get('/student-dashboard','Nonadmin\DashboardController@show');

                  //**USER-PROFILE**
     Route::get('/studentprofile/{id}','Nonadmin\DashboardController@index');
     Route::put('/student-profile-update/{id}','Nonadmin\DashboardController@profileUpdate');

                  //**BOOKS-ISSUE**
     Route::get('/studentbooks','IssueController@studentIndex');
     Route::get('/issueupdate/{book_id}','Nonadmin\DashboardController@issueBook');

                  //**BOOKS-REISSUE-RETURN**
     Route::get('/reissueupdate/{id}/{book_id}','Nonadmin\DashboardController@reissueBook');
     Route::get('/finebooks','IssueController@fineBooks');
     Route::delete('/return/{id}/{book_id}','IssueController@return');
});
