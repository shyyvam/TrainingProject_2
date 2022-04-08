<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
  protected $table = 'issue';
  protected $fillable = ['issue_date','return_date','issue_status','return_day'];
  protected $guarded = ['u_id','b_id'];
  protected $primaryKey = ['id'];
}
