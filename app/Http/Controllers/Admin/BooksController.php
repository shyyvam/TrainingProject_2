<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    public function index()
    {
      $books = Books::paginate(5);

      return view('admin.books')->with('books',$books);
    }
    public function save(Request $request)
    {
      $books = new Books;
      $books->book_name=$request->input('title');
      $books->book_author=$request->input('author');
      $books->book_version=$request->input('version');
      $books->book_subject=$request->input('subject');
      $books->save();
      return redirect('/books')->with('status','Data Added for Books');
    }
    public function edit($book_id)
    {

      $books = Books::findOrFail($book_id);
      return view('admin.books.edit')->with('books',$books);
    }
    public function update(Request $request, $book_id)
    {
      $books = Books::findOrFail($book_id);
      $books->book_name=$request->input('title');
      $books->book_author=$request->input('author');
      $books->book_version=$request->input('version');
      $books->book_subject=$request->input('subject');
      $books->update();
      return redirect('books')->with('status','Data Updated for Books');
    }
    public function delete($book_id)
    {
      $books = Books::findOrFail($book_id);
      $books->delete();
      return redirect('books')->with('status','Data Deleted for Books');
    }
    public function search()
    {
      $search_text = $_GET['query'];
      $books = Books::where('book_name','LIKE','%'.$search_text.'%')->with('book_subject')->get();
      return view('admin.booksearch',compact('books'));
    }

}
