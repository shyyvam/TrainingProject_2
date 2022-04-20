<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Books extends Model
{
    protected $table = 'books';
    protected $fillable = ['book_name','book_author','book_version','book_subject'];
    protected $primaryKey = 'book_id';

    public static function deleteBooks($book_id)
    {
      $books = Books::findOrFail($book_id);
      $books->delete();
    }
    public static function saveBooks($request)
    {
      $validator = Validator::make($request -> all(),
         [
           'title' => ['required'],
           'author' => ['required'],
           'version' => ['required'],
           'subject' => ['required'],
         ]
       );
       if($validator -> fails())
       {
         return redirect('/books') -> withErrors($validator) -> withInput();
       }
      $books = new Books;
      $books->book_name=$request->input('title');
      $books->book_author=$request->input('author');
      $books->book_version=$request->input('version');
      $books->book_subject=$request->input('subject');
      $books->save();
    }
    public static function editBooks($book_id)
    {
      $books = Books::findOrFail($book_id);
      return $books;
    }
    public static function updateBooks($request,$book_id)
    {
      $books = Books::findOrFail($book_id);
      $books->book_name=$request->input('title');
      $books->book_author=$request->input('author');
      $books->book_version=$request->input('version');
      $books->book_subject=$request->input('subject');
      $books->update();
    }
    public static function searchBooks($request)
    {
      $search = $request->get('search');
      $books = DB::table('books')->where('book_name','like','%'.$search.'%')->orWhere('book_subject','like','%'.$search.'%')->paginate(5);
      return $books;
    }

}
