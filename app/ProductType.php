<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $fillable = ['type_name'];

    // 關聯資料表寫在 model裡面 除了這個 model 外 Product 也要綁
    public function product()
    {   // 一對多關係            關聯全部 會自動找
        return $this->hasMany(Product::class);
                    // 也可以 'App\Product'
    }
}
