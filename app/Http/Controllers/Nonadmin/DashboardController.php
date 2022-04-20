<?php

namespace App\Http\Controllers\Nonadmin;

use App\Models\Issue;
use App\Models\Books;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index($id)
    {
      $users=User::find($id);
      return view('nonadmin.profile')->with('users',$users);
    }
    public function profileUpdate(Request $request,$id)
    {
      $users=User::profileUpdate($request,$id);
      return view('nonadmin.profile')->with('users',$users)->with('status','Your profile is Updated');
    }

}
