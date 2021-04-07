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

    public static function get_shops($myShopID=NULL) {
        if (isset($myShopID) && $myShopID !== '') {
            $myShop = Shop::where('id', $myShopID)->get()->toArray();
            $otherShop = Shop::where('id', '<>', $myShopID)->get()->toArray();
            return array_merge($myShop, $otherShop);
        } else {
            return Shop::select('*')->get();
        }
    }

    public static function get_shop($id) {
        $shop =  DB::table('t_shop')
                    ->where('id', '=', $id)
                    ->first();
        return $shop;
    }

    public static function get_shop_by_area_id($areaID)
    {
        return Shop::where('area_id', $areaID)
            ->get();
    }

    public static function get_shop_by_postalCode($postalCode)
    {
        return Shop::where('postal', $postalCode)
            ->first();
    }

    public static function get_shop_name($id) {
        $shop = Shop::where('id', $id)
                ->first();
        return $shop->name;
    }

}
