<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function show()
    {
      return view('admin.dashboard');
    }

    public function showUsers()
    {
      try {
          $users = User::all();
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return view('admin.register')
            ->with('users',$users);
    }

    public function registerEdit($id)
    {
      try {
          $users = User::registerEdit($id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return view('admin.register-edit')
            ->with('users',$users);
    }

    public function registerUpdate(Request $request, $id)
    {
      $validator = Validator::make($request -> all(),
         [
           'username'     => 'required|max:191|min:3',
           'usertype'     => 'required|max:191|string',
         ]
       );

       if($validator -> fails())
       {
         return redirect('/role-edit/'.$id)
               -> withErrors($validator)
               -> withInput()
               -> with('status','Data not updated for Users');
       }

      try {
          User::registerUpdate($request,$id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return redirect('/role-edit/'.$id);
    }

    public function delete($id)
    {
      try {
          User::registerDelete($id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return redirect('/users')
            ->with('status','Your data is Deleted');
    }

}
