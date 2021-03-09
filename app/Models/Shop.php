<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shop extends Model
{
    protected $table = 't_shop';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'name', 'province', 'county', 'address', 'postal', 'tel_no', 'image',
    ];

    public static function get_data() {
        $shops = DB::table('t_shop')
                ->paginate(10);
        return $shops;
    }

    public static function get_shops() {
        return Shop::select('*')->get();
    }

    public static function get_shop($no) {
        $shop =  DB::table('t_shop')
                    ->where('no', '=', $no)
                    ->first();
        return $shop;
    }

    public static function get_provinces() {
        return DB::table('t_province')->get();
    }

    public static function get_counties($no) {
        return DB::table('t_county')->where(['province_no' => $no])->get();
    }

    public static function get_new_record_no() {
        return  DB::table('t_shop')->max('no')+1;
    }
}
