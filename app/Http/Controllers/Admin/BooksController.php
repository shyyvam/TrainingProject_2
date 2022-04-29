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

    public function index()
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

      try {
          Books::saveBooks($request);
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

      try {
          Books::updateBooks($request,$book_id);
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      return redirect('/booksedit/'.$book_id);
    }

    public function delete($book_id)
    {
      $book = Books::findOrFail($book_id);

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
          $books    = Books::searchBooks($request);
     } catch (Exception $e) {
       echo $e->getMessage();
     }

     return view('admin.books',['books'=>$books]);
    }

}
