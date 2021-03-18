<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Carrying extends Model
{
    protected $table = 't_carrying';

    protected $fillable = [
        'shop_id', 'date', 'goods',
    ];

    public static function get_data($date, $goods) {
        if (!isset($date))
        {
            $carries =  DB::table('t_carrying')
                    ->select('t_carrying.*', 't_shop.name')
                    ->join('t_shop', 't_carrying.shop_id', '=', 't_shop.id')
                    ->where('t_carrying.goods', 'like', $goods)
                    ->latest()
                    ->paginate(10);
        } else
            $carries =  DB::table('t_carrying')
                    ->select('t_carrying.*, t_shop.name')
                    ->join('t_shop', 't_carrying.shop_id', '=', 't_shop.id')
                    ->where('t_carrying.goods', 'like', $goods)
                    ->where('t_carrying.date', '=', $date)
                    ->latest()
                    ->paginate(10);

        return $carries;
    }
}
