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
    public static $paginateValue     = 5;
    public static $issued     = 'y';
    public static $not_issued = 'n';

    public static function deleteBooks($book_id)
    {
      $books = Books::findOrFail($book_id);
      return $books->delete();
    }

    public static function findId($book_id)
    {
      return Books::findOrFail($book_id);
    }

    public static function saveBooks($name,$author,$version,$subject)
    {
          $books                 = new Books;
          $books->book_name      = $title;
          $books->book_author    = $author;
          $books->book_version   = $version;
          $books->book_subject   = $subject;
          $books->save();

          return redirect('/books')
                ->with('status','Data Added for Books');
    }

    public static function editBooks($book_id)
    {
      $books = Books::findOrFail($book_id);
      return $books;
    }

    public static function updateBooks($name,$author,$version,$subject,$book_id)
    {
          $books                = Books::findOrFail($book_id);
          $books->book_name     = $name;
          $books->book_author   = $author;
          $books->book_version  = $version;
          $books->book_subject  = $subject;
          $books->update();

          return redirect('/booksedit/'.$book_id)
                ->with('status','Data Updated for Books');
    }

    public static function updateRecord($book_id)
    {
        $book          = Books::findOrFail($book_id);
        $book->status  = self::$issued;   //setting status of book as issued

        return $book->save();
    }

    public static function updateIssue($book_id)
    {
        $book          = Books::findOrFail($book_id);
        $book->status  = self::$not_issued;   //setting status of book as not issued

        return $book->save();
    }

    public static function searchBooks($search)
    {
      $books    = DB::table('books')
                ->where('book_name','like','%'.$search.'%')
                ->orWhere('book_subject','like','%'.$search.'%')
                ->paginate(self::$paginateValue);

      return $books;
    }

}
