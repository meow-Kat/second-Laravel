<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    // 限制身分別
    public function news()
    {
        if(Gate::allows('admin')){
            return view('admin.news.index');
        }else{
            return 'meow';
        }
    }
}
