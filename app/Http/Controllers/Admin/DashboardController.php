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
    public function registeredit($id)
    {
      $users = User::findOrFail($id);
      return view('admin.register-edit')->with('users',$users);
    }
    public function registerupdate(Request $request, $id)
    {
      $users=User::find($id);
      $users->name=$request->input('username');
      $users->usertype=$request->input('usertype');
      $users->update();
      return redirect('/role-register')->with('status','Your data is Updated');
    }
    public function registerdelete($id)
    {
      $users = User::findOrFail($id);
      $users->delete();
      return redirect('/role-register')->with('status','Your data is Updated');

    }

}
