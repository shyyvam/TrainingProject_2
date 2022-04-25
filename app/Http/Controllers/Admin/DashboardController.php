<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function show()
    {
      return view('admin.dashboard');
    }

    public function showUsers()
    {
      try {
          $users        = User::all();
          return view('admin.register')
                ->with('users',$users);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }

    public function registerEdit($id)
    {
      try {
          $users        = User::registerEdit($id);
          return view('admin.register-edit')
                ->with('users',$users);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }

    public function registerUpdate(Request $request, $id)
    {
      try {
          User::registerUpdate($request,$id);
          return redirect('/role-edit/'.$id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }

    public function Delete($id)
    {
          User::registerDelete($id);
          return redirect('/role-register')
                ->with('status','Your data is Updated');
    }

}
