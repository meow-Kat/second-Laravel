<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductTypeController extends Controller
{
    // 建構子 ↓  因為下面的都會重複寫
    public function __construct()
    {   // 全域變數 的格式
        $this->index = 'admin.product.type.index';
        $this->edit = 'admin.product.type.edit';
        $this->create = 'admin.product.type.create';
    }
    public function type()
    {
        $list = ProductType::get();
        return view($this->index,compact('list'));
    }
    public function edit($id)
    {
        $record = ProductType::find($id);
        return view($this->edit, compact('record'));
    }

    public function create()
    {
        return view($this->create);
    }
    public function store(Request $request)
    {
        //  ↓ 驗證  可自己制定驗證規則       ↓ 驗證全部
        $v = Validator::make($request->all(), [
            // '欄位' => ['驗證規則']
            'type_name' => ['required', 'string', 'max:10'],
        ]);

        // 如果其中一個不吻合回傳false
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        ProductType::create([
            // $data更改為$request
            'type_name' => $request['type_name'],
        ]);

        return redirect('/admin/product/type')->with('message', '新增成功');
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            // '欄位' => ['驗證規則']
            'type_name' => ['required', 'string', 'max:10'],
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $old_record = ProductType::find($id);
        $old_record->type_name = $request->type_name;
        $old_record->save();

        return redirect('/admin/product/type')->with('message', '更新成功!');
    }

    public function delete(Request $request, $id)
    {
        $old_record = ProductType::find($id);
        $old_record->delete();

        return redirect('/admin/product/type')->with('message', '刪除成功!');
    }
}
