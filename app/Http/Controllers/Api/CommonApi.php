<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Shop;
use App\Models\Tossup;
use App\Models\Inquiry;
use App\Models\Atec;
use App\Models\Coupon;
use App\Models\Notice;

class CommonApi
{
    /**
     * Get all stores
     */
    public static function get_stores($code=NULL)
    {
        return Shop::get_shops();
    }

    public static function add_tossup($shop, $content)
    {
        $tossup = new Tossup;
        $tossup->shop = $shop;
        $tossup->content = $content;
        $tossup->save();
    }

    public static function get_tossup($shop)
    {
        return Tossup::get_tossup_by_shop($shop);
    }

    public static function get_inquiry($shop)
    {
        return Inquiry::get_by_shop($shop);
    }

    public static function reply_inquiry($id, $reply)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->reply = $reply;
        $inquiry->save();
    }

    public static function get_atec($shop)
    {
        return Atec::get_atecs($shop);
    }

    public static function add_coupon()
    {

    }

    public static function get_coupon_by_shop($shop)
    {
        return Coupon::where('shop_id', $shop)
            ->select(DB::raw('*, DATE_FORMAT(created_at,"%Y-%m-%d") as date'))
            ->latest()
            ->get();
    }

    public static function add_notice()
    {

    }

    public static function get_notice_by_shop($shop)
    {
        return Notice::where('shop_id', $shop)
            ->select(DB::raw('*, DATE_FORMAT(created_at,"%Y-%m-%d") as date'))
            ->latest()
            ->get();
    }
}
