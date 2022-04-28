<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use DB;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
                           'phone_number',
                           'email',
                           'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password',
                         'remember_token',];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //FUNCTIONS
    public static function registerEdit($id)
    {
      $users = User::findOrFail($id);
      return $users;
    }

    public static function registerUpdate($request,$id)
    {
          $users          = User::findOrFail($id);
          $users->name    = $request->input('username');
          $users->usertype= $request->input('usertype');
          $users->update();

          return redirect('/role-edit/'.$id)
                ->with('status','Data Updated for Users');
    }

    public static function registerDelete($id)
    {
      $users = User::findOrFail($id);
      return $users->delete();
    }

    public static function profileUpdate($request,$id)
    {
        $users              = User::findOrFail($id);
        $users->name        = $request->input('username');
        $users->email       = $request->input('email');
        $users->phone_number= $request->input('phone_number');
        return $users->update();

    }
}
