<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    //
    protected $fillable = ['product_id', 'photo'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


