<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class CarryingGoods extends Model
{
    protected $table = 't_carrying_goods';

    protected $fillable = [
        'type', 'name', 'price',
    ];

    public static function get_data() {
        $goods =  DB::table('t_carrying_goods')
                    ->latest()
                    ->paginate(10);
        return $goods;
    }

    public static function get_goods($id) {
        $goods =  DB::table('t_carrying_goods')
                    ->where('id', '=', $id)
                    ->first();
        return $goods;
    }

    public static function get_goods_list() {
        return DB::table('t_carrying_goods')
                    ->latest()
                    ->get();
    }

}
