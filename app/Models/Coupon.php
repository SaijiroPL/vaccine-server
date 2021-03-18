<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 't_coupon';

    protected $fillable = [
        'title', 'content', 'from_date', 'to_date', 'shop_id', 'reuse', 'agree',
    ];

    public static function get_data() {
        $coupons =  DB::table('v_coupon')
                    ->latest()
                    ->paginate(10);
        return $coupons;
    }

    public static function get_agree_data() {
        $coupons =  DB::table('v_coupon')
                    ->where('agree','=',1)
                    ->latest()
                    ->paginate(10);
        return $coupons;
    }

    public static function get_application_data() {
        $coupons =  DB::table('v_coupon')
                    ->where('agree','=',0)
                    ->latest()
                    ->paginate(10);
        return $coupons;
    }

    public static function get_coupon($id) {
        $coupon =  DB::table('v_coupon')
                    ->where('id', '=', $id)
                    ->first();
        return $coupon;
    }
}
