<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Books extends Model
{
    protected $table          = 'books';
    protected $fillable       = ['book_name',
                                 'book_author',
                                 'book_version',
                                 'book_subject'];
    protected $primaryKey     = 'book_id';

    public static function deleteBooks($book_id)
    {
      $books                  = Books::findOrFail($book_id);
      return $books->delete();
    }

    public static function saveBooks($request)
    {
      $validator = Validator::make($request -> all(),
         [
           'title' => 'required|max:191|min:3',
           'author' => 'required|max:191|min:3',
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
       else
       {
          $books                 = new Books;
          $books->book_name      = $request->input('title');
          $books->book_author    = $request->input('author');
          $books->book_version   = $request->input('version');
          $books->book_subject   = $request->input('subject');
          $books->save();
          return redirect('/books')
                ->with('status','Data Added for Books');
      }
    }
    public static function editBooks($book_id)
    {
      $books                 = Books::findOrFail($book_id);
      return $books;
    }
    public static function updateBooks($request,$book_id)
    {
      $validator = Validator::make($request -> all(),
         [
           'title' => 'required|max:191|min:3',
           'author' => 'required|max:191|min:3',
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
       else
       {
          $books                = Books::findOrFail($book_id);
          $books->book_name     = $request->input('title');
          $books->book_author   = $request->input('author');
          $books->book_version  = $request->input('version');
          $books->book_subject  = $request->input('subject');
          $books->update();
          return redirect('/booksedit/'.$book_id)
                ->with('status','Data Updated for Books');
       }
    }
    public function updateRecord($book_id) {
        $book               = Books::findOrFail($book_id);
        $book->status       = 'y';
        return $book->save();
    }
    public static function searchBooks($request)
    {
      $search               = $request->get('search');
      $books                = DB::table('books')
                            ->where('book_name','like','%'.$search.'%')
                            ->orWhere('book_subject','like','%'.$search.'%')
                            ->paginate(5);
      return $books;
    }

}
