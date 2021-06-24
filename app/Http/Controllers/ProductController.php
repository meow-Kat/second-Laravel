<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImg;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
                // 建構子 ↓  因為下面的都會重複寫
    public function __construct()
    {   // 全域變數 的格式
        $this->index = 'admin.product.item.index';
        $this->edit = 'admin.product.item.edit';
        $this->create = 'admin.product.item.create';
    }
    public function product()
    {   // 可省略 with
        $list = Product::with('type')->get();

        $photo = ProductImg::get();

        return view( $this->index,compact('list','photo'));
    }
    public function edit($id)
    {
        $type = ProductType::get();
        $record = Product::with('photo')->find($id);
        // 多圖編輯
        $photo = $record->photo ;
        
        return view( $this->edit, compact('record','type','photo' ) );
    }

    public function create()
    {
        $type = ProductType::get();
        return view( $this->create ,compact('type'));
    }
    public function store(Request $request)
    {   // 剛創的資料

        $requestData = $request->all();
        if ($request->hasFile('pic')) {                                             // ↓ 多層的資料夾
            $requestData['pic'] = FileController::imgUpload($request->file('pic'),'product');
        }

        $new_recode = Product::create($requestData);

        if ($request->hasFile('photo')) {
            foreach($request->file('photo') as $item){  // ↓ 多層的資料夾
                $path = FileController::imgUpload($item,'product');

                ProductImg::create([
                    'photo' => $path,
                    'product_id' => $new_recode->id,
                ]);
            }
        }


    //  ↓ 驗證  可自己制定驗證規則       ↓ 驗證全部
        $v = Validator::make($request->all(), [
            // '欄位' => ['驗證規則']
            'product_name' => ['required', 'string', 'max:10'],
        ]);

        // 如果其中一個不吻合回傳false
        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }

        // Product::create([
        //     // $data更改為$request
        //     'product_name' => $request['product_name'],
        //     'product_price' => $request['product_price'],
        //     'product_discript' => $request['product_discript'],
        //     'product_type_id' => $request['product_type_id'],
        // ]);
        
        // 快速寫法

        return redirect('/admin/product/item')->with('message', '新增成功');
    }

    public function update(Request $request, $id)
    {   
        $record = Product::with('photo')->find($id);
        $requestData =  $request->all();
        // 單張圖片編輯
        if ($record->pic!='https://placeholder.pics/svg/500x500') {
            File::delete(public_path().$record->pic);
        }
        if ($request->hasFile('pic')) {
            File::delete(public_path().$record->pic);
            $path = FileController::imgUpload($request->file('pic'),'product');
            $requestData['pic'] = $path;
        }
        $record->update($requestData);

        // 多張圖片編輯
        if ($request->hasFile('photo')){
            foreach($request->file('photo') as $file){
                $path = FileController::imgUpload($file,'product');
                ProductImg::create([
                    'product_id' => $record->id,
                    'photo' => $path
                ]);
            }
        }

        // $old_record = Product::find($id);
        // $old_record->product_name = $request->product_name;
        // $old_record->save();

        return redirect('/admin/product/item')->with('message', '更新成功!');
    }

    public function delete(Request $request, $id)
    {
        $record = Product::with('photo')->find($id);
        // 刪除主要圖片
        // if ($record->pic!='https://placeholder.pics/svg/500x500') {
            File::delete(public_path().$record->pic);
        // }
        // 刪除其他圖片
        foreach($record->photo as $photo){
            // 刪除其他圖片檔
            File::delete(public_path().$photo->photo);
            // 刪除資料
            $photo->delete();
        }
        $record->delete();
        return redirect('/admin/product/item')->with('message', '刪除成功!');
    }
}
