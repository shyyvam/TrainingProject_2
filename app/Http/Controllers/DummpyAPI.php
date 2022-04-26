<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Issue;

class DummpyAPI extends Controller
{
    //
    function getData()
    {
      $books                = Books::all();
      $issue                = Issue::all();
      return Issue::join('books','issue.b_id','=','books.book_id')
                    ->select('issue.id','books.book_name','issue.issue_date','issue.return_date')
                    ->get();
    }
}
