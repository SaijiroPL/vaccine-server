<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shop extends Model
{
    protected $table = 't_shop';

    protected $fillable = [
        'name', 'province', 'county', 'address', 'postal', 'tel_no', 'image',
    ];

    public static function get_data() {
        $shops = DB::table('t_shop')
                ->latest()
                ->paginate(10);
        return $shops;
    }

    public static function get_shops() {
        return Shop::select('*')->get();
    }

    public static function get_shop($id) {
        $shop =  DB::table('t_shop')
                    ->where('id', '=', $id)
                    ->first();
        return $shop;
    }

}
