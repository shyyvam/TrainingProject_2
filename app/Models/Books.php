<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $fillable = ['book_name','book_author','book_version','book_subject'];
    protected $primaryKey = 'book_id';

}
