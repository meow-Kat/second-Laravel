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
    {   // 要同時把建好的關聯拿出來用 ↓ 在model內(使用with) 也可以不寫 系統會自己判斷
        $list = ProductType::with('products')->get();
        // 拿到關聯的資料表 ↓
        // dd($list[0]->products);


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
        $count = $old_record->product_name->count();

        // 不該讓使用者在有種類的情況下刪除種類
        // 如果裡面有東西↓
        if ($count != 0) {
            //一對多刪除
            return redirect('/admin/product/type')->with('message', 
            '無法刪除，裡面還有'. $old_record->product->count() .'筆資料，請先刪除產品品項');
        }elseif($count == 0){
            $old_record->delete();
            return redirect('/admin/product/type')->with('message', '刪除成功!');
        }
    }
}
