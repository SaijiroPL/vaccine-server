<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Carrying extends Model
{
    protected $table = 't_carrying';

    protected $fillable = [
        'shop_no', 'date', 'goods',
    ];

    public static function get_data($date, $goods) {
        if ( $date == "")
            $carries =  DB::table('t_carrying')
                    ->join('t_shop', 't_carrying.shop_no', '=', 't_shop.no')
                    ->where('t_carrying.goods', 'like', $goods)
                    ->paginate(10);
        else
            $carries =  DB::table('t_carrying')
                    ->join('t_shop', 't_carrying.shop_no', '=', 't_shop.no')
                    ->where('t_carrying.goods', 'like', $goods)
                    ->where('t_carrying.date', '=', $date)
                    ->paginate(10);

        return $carries;
    }
}
