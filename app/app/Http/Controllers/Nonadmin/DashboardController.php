<?php

namespace App\Http\Controllers\Nonadmin;

use App\Models\Issue;
use App\Models\Books;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IssueController;
use Auth;
use DateTime;
use DateInterval;
use format;

class DashboardController extends Controller
{
    public function show()
    {
      return view('nonadmin.dashboard');
    }

    public function index($id)
    {
      $users     =User::find($id);
      return view('nonadmin.profile')->with('users',$users);
    }
    public function profileUpdate(Request $request,$id)
    {
      $users     =User::profileUpdate($request,$id);
      return view('nonadmin.profile')->with('users',$users)->with('status','Your profile is Updated');
    }
    public function issueBook($book_id) {
          DB::beginTransaction();
          try {
              (new Issue())->createIssue($book_id);
              (new Books())->updateRecord($book_id);
          } catch (Exception $e) {
              DB::rollback();
              return redirect('/studentbooks')->with('status','Your book is not issued');
              // Handle Exception
          }
          DB::commit();
          return redirect('/studentbooks')->with('status','Your book is issued');
      }
      public function reissueBook($id,$book_id)
      {

        DB::beginTransaction();
        try{
          (new Issue())->createReissue($book_id);
          (new Books())->updateRecord($book_id);
        } catch (Exception $e) {
          DB::rollback();
          return redirect('/studentbooks')->with('status','Your book is not reissued');

        }
        DB::commit();
        return redirect('/studentbooks')->with('status','Your book is reissued');
      }
}
