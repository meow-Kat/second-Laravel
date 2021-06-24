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

    public function product(Request $request)
    {   
        $types = ProductType::get();
        if($request->type_id){
            $record = Product::where('product_type_id',$request->type_id)->get();
        }else{
            $record = Product::get();
        }
        return view('front.product.index',compact('record','types'));
    }
}
