<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Issue;
use App\Models\Books;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DateTime;
use DateInterval;
use format;
use DB;
use Exception;

class Issue extends Model
{
  protected $table        = "issue";
  protected $primaryKey   = "id";
  protected $fillable     = ["issue_date","return_date","b_id","u_id"];

  public static function studentIndex()
  {
    $books                = Books::all();
    $users                = User::all();
    $issue                = Issue::all();
    $data                 = DB::table('books')
                                ->leftjoin('issue','books.book_id','=','issue.b_id')
                                ->select('books.book_id','books.book_name','issue.id')
                                ->where('books.status', '=', 'n')
                                ->get();
    return $data;
  }
  public static function adminFine()
  {
    $books                 = Books::all();
    $users                 = User::all();
    $data                  =  Issue::join('users','issue.u_id','=','users.id')
                                    ->join('books','issue.b_id','=','books.book_id')
                                    ->select('issue.id','issue.fine','books.book_name','users.phone_number','users.email','issue.issue_date','issue.return_date')
                                    ->get();
    foreach ($data as $d)
    {
          $date            = time();
          $date            = (int)$date;
          $returnDate      = (int)$d->return_date;

          if($returnDate<$date)
          {
            $d->fine       = round((($date-$returnDate)/86400))*5;
          }
    }
    return $data;
  }
  public static function createIssue($book_id) {
      //$this->validate();
      $issue              = new self();
      $date               = date("d.m.y");
      $issue->issue_date  = time();
      $return_date        = strtotime($date.'+7 days');
      $issue->return_date = $return_date;
      $issue->b_id        = $book_id;
      $issue->u_id        = Auth::user()->id;
      return $issue->save();
  }
  public static function createReissue($book_id) {

    $issue                = Issue::findOrFail($book_id);
    $date                 = date("d.m.y");
    $return_date          = strtotime($date.'+7 days');
    $issue->return_date   = $return_date;
    return $issue->save();
  }
  /*private function validate($data) {
      foreach ($data as $attr => $value) {
          if (!in_array($attr, $this->fillable)) {
              throw new Exception(
                  sprintf('Invalid data provided. supported columns : %s', json_encode($this->fillable))
              );
          }
      }
  }*/
  public static function fineBooks()
  {
    $books                = Books::all();
    $users                = User::all();
    $issue                = Issue::all();
    $data                 = Issue::join('users','issue.u_id','=','users.id')
                                  ->join('books','issue.b_id','=','books.book_id')
                                  ->select('issue.id','books.book_id','issue.fine','books.book_name','users.phone_number','users.email','issue.issue_date','issue.return_date')
                                  ->where('users.id','=',Auth::user()->id)
                                  ->get();
    //CALCULATE FINE
    foreach ($data as $d)
    {
      $date               = time();
      $date               = (int)$date;
      $returnDate         = (int)$d->return_date;
      if($returnDate < $date)
      {
        $d->fine          = round((($date-$returnDate)/86400))*5;
      }
    }
      return $data;
  }

  public static function deleteIssue($id)
  {
    $issue                = Issue::findOrFail($id);
    return $issue->delete();
  }

}
