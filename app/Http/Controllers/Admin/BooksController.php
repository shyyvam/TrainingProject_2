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
      $books     = Books::paginate(5);
      return view('admin.books')
            ->with('books',$books);
    }
    public function save(Request $request)
    {
        Books::saveBooks($request);
        return redirect('/books');
    }
    public function edit($book_id)
    {
      $books    = Books::editBooks($book_id);
      return view('admin.books.edit')
            ->with('books',$books);
    }
    public function update(Request $request, $book_id)
    {
      Books::updateBooks($request,$book_id);
      return redirect('/booksedit/'.$book_id);

    }
    public function delete($book_id)
    {
      Books::deleteBooks($book_id);
      return redirect('books')
            ->with('status','Data Deleted for Books');
    }
    public function search(Request $request)
    {
      $books    = Books::searchBooks($request);
      return view('admin.books',['books'=>$books]);
    }

}
