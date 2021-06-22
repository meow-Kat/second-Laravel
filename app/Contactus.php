<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    //
    protected $table = 'contactuses'; // 確保 Model 與 table 綁定在一起
    protected $fillable = ['name', 'email', 'title', 'content'];
}
