<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarryingGoodsDetail extends Model
{
    //
    protected $table = 't_carrying_goods_details';

    protected $fillable = [
        'goods_id', 'name', 'price',
    ];
}
