<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
                    // 建構子 ↓  因為下面的都會重複寫
    public function __construct()
    {   // 全域變數 的格式
        $this->index = 'admin.product.index';
        $this->edit = 'admin.product.edit';
        $this->edit = 'admin.product.edit';
        $this->create = 'admin.product.create';
    }

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
