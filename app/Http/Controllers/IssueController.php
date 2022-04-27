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
    foreach ($data as $d)
    {
          $date            = time();
          $date            = (int)$date;
          $returnDate      = (int)$d->return_date;

          if($returnDate<$date)
          {
            $d->fine       = round((($date-$returnDate)/86400))*5;
          }
          else {
            $d->fine       = 0;
          }
    }
    return view('admin.fine',compact('data'));
  }

  public function fineBooks()
  {
    $data=Issue::fineBooks();
    foreach ($data as $d)
    {
          $date            = time();
          $date            = (int)$date;
          $returnDate      = (int)$d->return_date;

          if($returnDate<$date)
          {
            $d->fine       = round((($date-$returnDate)/86400))*5;
          }
          else {
            $d->fine       = 0;
          }
    }
    return view('nonadmin.bookfine')->with('data',$data);
  }

}
