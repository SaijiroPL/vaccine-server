<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use DB;
use App\Models\Shop;
use App\Models\Tossup;
use App\Models\Inquiry;
use App\Models\Atec;
use App\Models\Coupon;
use App\Models\Notice;
use App\Models\CarryingGoods;

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

    public static function get_goods_list()
    {
        return CarryingGoods::select()->get();
    }

    public static function generate_member_unique_id($firstName, $lastName, $email)
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $hour = date('H');
        $minute = date('i');
        $second = date('s');
        $suffix = (string)strlen($firstName).(string)strlen($lastName).(string)strlen($email);
        return (string)($year - 2010).(string)($month * 31 + $day).(string)($hour * 3600 + $minute * 60 + $second).$suffix;
    }

    public static function makeResetURL($customerID)
    {
        $resetToken = rand(100000, 999999);
        Customer::setResetToken($customerID, $resetToken);
        return url('/api/client/resetPassword'.'?resetToken='.$resetToken.'&customerID='.$customerID);
    }

    public static function sendSMS($phoneNumber, $data)
    {
        /**
         * TODO: 해당전화번호로 SMS전송코드작성
         */
    }

    public static function sendEmail($email, $data)
    {
        /**
         * TODO: 해당주소로 email전송코드작성
         */
    }
}
