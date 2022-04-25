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
  public function studentIndex()
  {
    $data=Issue::studentIndex();
    return view('nonadmin.bookissue')->with('data',$data);
  }
  public function fine()
  {
    $data=Issue::adminFine();
    return view('admin.fine',compact('data'));
  }

  public function reissue_Update(Request $request,$id,$book_id)
  {
    Issue::reissueUpdate($request,$id,$book_id);
    return redirect('/studentbooks')->with('status','Your book is reissued');
  }
  public function fineBooks()
  {
    $data=Issue::fineBooks();
    return view('nonadmin.bookfine')->with('data',$data);
  }

  public function return(Request $request,$id,$book_id)
  {
    Issue::return($request,$id,$book_id);
    return redirect('/studentbooks')->with('status','Your book is returned');
  }
}
