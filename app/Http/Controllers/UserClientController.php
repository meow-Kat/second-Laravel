<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserClientController extends Controller
{
    //
    protected $fillable = ['user_id', 'phone', 'address'];
    
    public function client()
    {
        return $this->hasOne('App\UserClient', 'user_id');
        //指到UserClient，預設有user_id，不寫也可以，寫了比較嚴謹
    }
}
