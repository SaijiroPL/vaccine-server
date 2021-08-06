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

    public static function get_agree_data($filter) {
        $query = DB::table('t_notice')
            ->leftJoin('t_shop', 't_notice.shop_id', '=', 't_shop.id')
            ->leftJoin('t_area', 't_shop.postal', '=', 't_area.postal')
            ->where('t_notice.agree','=',1);
        if ($filter['shop'] != '') {
            $query = $query->where('t_shop.name', 'like', '%'.$filter['shop'].'%');
        }
        if ($filter['brand'] != '') {
            $query = $query->where('t_shop.brand', 'like', '%'.$filter['brand'].'%');
        }
        if ($filter['area'] != '') {
            $query = $query->where('t_area.name_p', 'like', '%'.$filter['area'].'%');
        }
        $query = $query->select('t_notice.*', 't_shop.name', 't_area.name_p', 't_area.name_c', 't_shop.brand')
            ->orderBy('t_notice.created_at', 'DESC');
        return $query->paginate(10);
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
            ->where(function($q) use($shopid) {
                $q->where('shop_id', 0)->orWhere('shop_id', $shopid);
            })
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
