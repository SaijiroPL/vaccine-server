<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 't_notice';

    protected $fillable = [
        'kind', 'title', 'content', 'shop_id', 'agree', 'image_path',
    ];

    public static function get_data() {
        $notices = DB::table('v_notice')->latest()
                    ->paginate(10);
        return $notices;
    }

    public static function get_agree_data() {
        $notices = self::where('agree','=',1)->latest()->paginate(10);
        return $notices;
    }

    public static function get_application_data() {
        $coupons =  DB::table('v_notice')
                    ->where('agree','=',0)->latest()
                    ->paginate(10);
        return $coupons;
    }

    public static function get_notice($id) {
        $notice =  DB::table('v_notice')
                    ->where('id', '=', $id)
                    ->first();
        return $notice;
    }

    public static function get_all_data() {
        return Notice::where('agree', 1)->orderBy('updated_at', 'DESC')->get();
    }

    public static function get_by_shop($shopid) {
        return Notice::where('agree', 1)
            ->whereIn('shop_id', [0, $shopid])
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
