<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Validator;


class BooksController extends Controller
{
    public $paginateValue = 5;

    public function showBooks()
    {
      try {
          $books = Books::paginate($this->paginateValue);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return view('admin.books')
            ->with('books',$books);
    }

    public function save(Request $request)
    {
      $validator = Validator::make($request -> all(),
         [
           'title'   => 'required|max:191|min:3',
           'author'  => 'required|max:191|min:3',
           'version' => 'required|max:191|numeric|min:1',
           'subject' => 'required|max:191|min:3',
         ]
       );

       if($validator -> fails())
       {
         return redirect('/books')
               -> withErrors($validator)
               -> withInput()
               -> with('status','Data not Added for Books');
       }

       $name     = $request->input('title');
       $author   = $request->input('author');
       $version  = $request->input('version');
       $subject  = $request->input('subject');

      try {
          Books::saveBooks($name,$author,$version,$subject);
      } catch (Exception $e) {
        echo $e->getMessage();
    }

    return redirect('/books');
    }

    public function edit($book_id)
    {
      try {
          $books = Books::editBooks($book_id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return view('admin.books.edit')
            ->with('books',$books);
    }

    public function update(Request $request, $book_id)
    {
      $validator = Validator::make($request -> all(),
         [
           'title'   => 'required|max:191|min:3',
           'author'  => 'required|max:191|min:3',
           'version' => 'required|max:191|numeric|min:1',
           'subject' => 'required|max:191|min:3',
         ]
       );

       if($validator -> fails())
       {
         return redirect('/books')
               -> withErrors($validator)
               -> withInput()
               -> with('status','Data not Updated for Books');
       }

       $name     = $request->input('title');
       $author   = $request->input('author');
       $version  = $request->input('version');
       $subject  = $request->input('subject');

      try {
          Books::updateBooks($name,$author,$version,$subject,$book_id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return redirect('/booksedit/'.$book_id);
    }

    public function delete($book_id)
    {
      $book = Books::findId($book_id);

      if($book->status == 'y')
      {
        return redirect('/books')
              ->with('status','Can not delete issued book');
      }

      try {
          Books::deleteBooks($book_id);

      } catch (Exception $e)
      {
        echo $e->getMessage();
      }

     return redirect('/books')
           ->with('status','Data Deleted for Books');
    }

    public function search(SearchRequest $request)
    {
      try {
          $request->validated();
          $search   = $request->get('search');
          $books    = Books::searchBooks($search);
     } catch (Exception $e) {
       echo $e->getMessage();
     }

     return view('admin.books',['books'=>$books]);
    }

}
