<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['product_name', 'product_price', 'product_discript', 'product_type_id'];

    // 關聯資料表寫在 model裡面 除了這個 model 外 ProductType 也要綁
    public function type()
    {   // 一對一 (反向關聯)                 關聯看這裡 ↓
        return $this->belongsTo(ProductType::class, 'id');  
                    // 也可以 'App\ProductType'
    }
}
