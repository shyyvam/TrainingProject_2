<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Books;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DateTime;
use DateInterval;
use format;
use DB;

class IssueController extends Controller
{
  public function studentindex()
  {
    $books=Books::all();
    $users=User::all();
    $issue=Issue::all();
    $data= DB::table('books')
                ->leftjoin('issue','books.book_id','=','issue.b_id')
                ->select('books.book_id','books.book_name','issue.id')
                ->where('books.status', '=', 'n')
                ->get();

    return view('nonadmin.bookissue')->with('data',$data);
  }
  public function fine()
  {
    $books=Books::all();
    $users=User::all();
    $data=Issue::join('users','issue.u_id','=','users.id')
                ->join('books','issue.b_id','=','books.book_id')
                ->select('issue.id','books.book_name','users.phone_number','users.email','issue.issue_date','issue.return_date')
                ->get();
    return view('admin.fine',compact('data'));
  }
  public function issue_update(Request $request,$book_id)
  {
    $issue = new Issue();
    $books = Books::findOrFail($book_id);
    $date=date("d.m.y");
    $issue->issue_date=time();
    $return_date=strtotime($date.'+7 days');
    $issue->return_date=$return_date;

    $books->status='y';
    $issue->b_id=$book_id;
    $issue->u_id=Auth::user()->id;
    $issue->save();
    $books->update();
    return redirect('/studentbooks')->with('status','Your book is issued');
  }
  public function reissue_update(Request $request,$id,$book_id)
  {
    $issue = Issue::findOrFail($id);
    $books = Books::findOrFail($book_id);
    $books->status='y';
    $date=date("d.m.y");
    $issue->issue_date=time();
    $return_date=strtotime($date.'+7 days');
    $issue->return_date=$return_date;
    $books->update();
    $issue->update();
    return redirect('/studentbooks')->with('status','Your book is reissued');
  }
  public function finebooks()
  {
    $books=Books::all();
    $users=User::all();
    $issue=Issue::all();
    /*$fine=($issue->return_date-$issue->issue_date)/604800;

    if($fine > 7)
    {
      $issue->fine=(7-$fine)*5;
    }*/
    $data=Issue::join('users','issue.u_id','=','users.id')
                ->join('books','issue.b_id','=','books.book_id')
                ->select('issue.id','books.book_id','issue.fine','books.book_name','users.phone_number','users.email','issue.issue_date','issue.return_date')
                ->where('users.id','=',Auth::user()->id)
                ->get();

    return view('nonadmin.bookfine')->with('data',$data);
  }
  public function return(Request $request,$id,$book_id)
  {
    $issue = Issue::findOrFail($id);
    $books = Books::findOrFail($book_id);
    $books->status='n';
    $books->update();
    $issue->delete();
    return redirect('/studentbooks')->with('status','Your book is returned');
  }








}
