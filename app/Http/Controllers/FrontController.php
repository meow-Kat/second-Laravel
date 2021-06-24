<?php

namespace App\Http\Controllers;

use App\Product;
use App\Contactus;
use App\ProductType;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function contactus()
    {
        return view('front.contactus.index');
    }

    public function store(Request $request)
    {
        // Contactus::create([
        //     // $data更改為$request
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'title' => $request['title'], 
        //     'content' => $request['content'], 
        // ]);

        Contactus::create($request->all());

        return redirect('/contact_us')->with('message','發送成功!');
    }

    public function product()
    {   
        $types = ProductType::get();
        $record = Product::with('photo')->get();
        return view('front.product.index',compact('record','types'));
    }
}
