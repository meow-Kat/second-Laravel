<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $fillable = ['type_name'];
    
    // 這邊寫得很差
    // // 關聯資料表寫在 model裡面 除了這個 model 外 Product 也要綁
    // public function product()
    // {   // 一對多關係            關聯全部 會自動找
    //     return $this->hasMany(Product::class);
    //                 // 也可以 'App\Product'
    // }

    // 寫關聯的畫兩邊都要寫 因為系統會認為是獨立事件
    public function products()
    {                       // 要關聯的Medole   對方的欄位     自己的欄位(唯一) // 只要對的上484 FK都無所謂
        return $this->hasMany('App\product','product_type_id', 'id'); // 如果欄位名稱有符合規則後面兩個可以不用給
    }           // 固定寫法 反斜線 ↑ 也可以整串變這樣 Product::class 
    
}
