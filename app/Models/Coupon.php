<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 't_coupon';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'title', 'content', 'from_date', 'to_date', 'shop_no', 'reuse', 'agree',
    ];

    public static function get_data() {
        $coupons =  DB::table('v_coupon')
                    ->paginate(10);
        return $coupons;
    }

    public static function get_agree_data() {
        $coupons =  DB::table('v_coupon')
                    ->where('agree','=',1)
                    ->paginate(10);
        return $coupons;
    }

    public static function get_application_data() {
        $coupons =  DB::table('v_coupon')
                    ->where('agree','=',0)
                    ->paginate(10);
        return $coupons;
    }

    public static function get_coupon($no) {
        $coupon =  DB::table('v_coupon')
                    ->where('no', '=', $no)
                    ->first();
        return $coupon;
    }

    public static function get_new_record_no() {
        return  DB::table('v_coupon')->max('no')+1;
    }
}
