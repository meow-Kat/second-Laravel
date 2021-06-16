<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
                // 建構子 ↓  因為下面的都會重複寫
    public function __construct()
    {   // 全域變數 的格式
        $this->index = 'admin.user.index';
        $this->edit = 'admin.user.edit';
        $this->create = 'admin.user.create';
    }

    public function index()
    {
        $list = User::get();

        // 把建構子帶進去
        return view($this->index, compact('list'));
    }

    public function edit($id)
    {
        $record = User::find($id);
        return view( $this->edit, compact('record') );
    }

    public function create()
    {
        return view( $this->create );
    }

    public function store(Request $request)
    {
    //  ↓ 驗證  可自己制定驗證規則       ↓ 驗證全部
        $v = Validator::make($request->all(), [
            // '欄位' => ['驗證規則']
            'name' => ['required', 'string', 'max:255'],    // 會去抓 ↓ 是不是唯一的
            'email' => ['required', 'string', 'email', 'max:255', 'unique:APP\User,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // ↑ 抓的資料表
        ]);                         //    符合8個位元 ↑          ↑ 驗證兩個欄位484正確

        // 如果其中一個不吻合回傳false
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }

        User::create([
            // $data更改為$request
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),// 加密
            'role' => $request['role'], // 註冊時一般身分別
        ]);

        return redirect('/admin/user')->with('message', '驗證成功');
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            // '欄位' => ['驗證規則']
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }

        $old_record = User::find($id);
        $old_record->name = $request->name;
        $old_record->password = Hash::make($request->password);
        $old_record->role = $request->role;
        $old_record->save();

        return redirect('/admin/user')->with('message', '更新成功!');
    }

    public function delete(Request $request, $id)
    {
        $old_record = User::find($id);
        $old_record->delete();

        return redirect('/admin/user')->with('message', '刪除成功!');
    }


}
