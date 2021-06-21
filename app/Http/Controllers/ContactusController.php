<?php

namespace App\Http\Controllers;

use App\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    //
    public function __construct()
    {   
        $this->index = 'admin.contactus.index';
        $this->edit = 'admin.contactus.look';
    }

    public function contactus()
    {
        $list = Contactus::get();
        return view($this->index, compact('list'));
    }

    public function look($id)
    {
        $record = Contactus::find($id);
        return view( $this->edit, compact('record') );
    }

    public function delete(Request $request, $id)
    {
        $old_record = Contactus::find($id);
        $old_record->delete();

        return redirect('/admin/contact_us')->with('message', '刪除成功!');
    }

}
