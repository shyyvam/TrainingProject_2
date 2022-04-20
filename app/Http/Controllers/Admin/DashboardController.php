<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function registered()
    {
      $users = User::all();
      return view('admin.register')->with('users',$users);
    }

    public function registerEdit($id)
    {
      $users=User::registerEdit($id);
      return view('admin.register-edit')->with('users',$users);
    }

    public function registerUpdate(Request $request, $id)
    {
      User::registerUpdate($request,$id);
      return redirect('/role-register')->with('status','Your data is Updated');
    }

    public function registerDelete($id)
    {
      User::registerDelete($id);
      return redirect('/role-register')->with('status','Your data is Updated');
    }

}
