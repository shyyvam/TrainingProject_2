<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BooksController extends Controller
{
    public function index()
    {
      try {
          $books     = Books::paginate(5);
          return view('admin.books')
                ->with('books',$books);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function save(Request $request)
    {
      try {
          Books::saveBooks($request);
          return redirect('/books');
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function edit($book_id)
    {
      try {
          $books    = Books::editBooks($book_id);
          return view('admin.books.edit')
                ->with('books',$books);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function update(Request $request, $book_id)
    {
      try {
          Books::updateBooks($request,$book_id);
          return redirect('/booksedit/'.$book_id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function delete($book_id)
    {
      try {
          Books::deleteBooks($book_id);
          return redirect('books')
                ->with('status','Data Deleted for Books');
      } catch (Exception $e)
      {
        echo $e->getMessage();
      }
    }
    public function search(Request $request)
    {
      try {
          $books    = Books::searchBooks($request);
          return view('admin.books',['books'=>$books]);
     } catch (Exception $e) {
       echo $e->getMessage();
     }
    }

}
