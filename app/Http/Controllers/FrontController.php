<?php

namespace App\Http\Controllers;

use App\Contactus;
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
        Contactus::create([
            // $data更改為$request
            'name' => $request['name'],
            'email' => $request['email'],
            'title' => $request['title'], 
            'content' => $request['content'], 
        ]);

        return redirect('/contact_us');
    }
}
