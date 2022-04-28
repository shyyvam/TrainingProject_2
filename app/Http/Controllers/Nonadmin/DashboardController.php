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
use App\http\Requests\profile;


class DashboardController extends Controller
{
    public function show()
    {
      return view('nonadmin.dashboard');
    }

    public function showProfile($id)
    {
      try {
        $users     = User::findOrFail($id);
        return view('nonadmin.profile')
              ->with('users',$users);
      } catch (Exception $e) {
        echo $e->getMessage();
      }


    }

    public function profileUpdate(Profile $request,$id)
    {
      $request->validated();
      try {
        $users = User::profileUpdate($request,$id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
      return redirect('/student-profile/'.$id)
            ->with('users',$users)
            ->with('status','Your profile is Updated');
    }


    public function issueBook($book_id) {
          DB::beginTransaction();

          try {
              (new Issue())->createIssue($book_id);
              (new Books())->updateRecord($book_id);
          } catch (Exception $e) {
              DB::rollback();
              return redirect('/studentbooks')
                     ->with('status','Your book is not issued due to some internal error');
              // Handle Exception
          }
          DB::commit();
          return redirect('/studentbooks')
                 ->with('status','Your book is issued');
      }


      public function reissueBook($id,$book_id)
      {
        try{
          Issue::createReissue($book_id);
        } catch (Exception $e) {
          return view('nonadmin.bookfine')
                 ->with('status','Your book is not reissued due to some internal error');
        }

        return view('nonadmin.bookfine')
               ->with('status','Your book is reissued');
      }

      public function return(Request $request,$id,$book_id)
      {
        DB::beginTransaction();

        try{
          (new Issue())->deleteIssue($id);
          (new Books())->updateIssue($book_id);
        } catch(Exception $e) {

          DB::rollback();
          return redirect('/finebooks')
                 ->with('status','Your book is not returned');
        }

        DB::commit();
        return redirect('/finebooks')
               ->with('status','Your book is returned');
      }

}
