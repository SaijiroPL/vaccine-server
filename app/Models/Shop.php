<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Shop extends Model
{
    protected $table = 't_shop';

    protected $fillable = [
        'name', 'address', 'postal', 'tel_no', 'image', 'docomo', 'link', 'latitude', 'longitude', 'brand', 'email', 'class_link'
    ];

    public static function get_data($area) {
        $shops = DB::table('v_shop')
                ->where('name_p', 'like' , '%'.$area.'%')
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

    public static function get_province_list()
    {
        return DB::table('v_shop')->select(DB::raw('name_p'))
            ->groupBy('name_p')
            ->orderby('name_p', 'asc')
            ->get();
    }

    public static function get_city_list_by_province($name_province)
    {
        return DB::table('v_shop')->select(DB::raw('name_c, name_p'))
            ->where('name_p', $name_province)
            ->groupBy('name_c')
            ->orderby('name_c', 'asc')
            ->get();
    }

    public static function get_shop_by_city($city_name)
    {
        return DB::table('v_shop')
                ->where('name_c', $city_name)
                ->get();
    }

    public static function get_shop_by_province($name_province)
    {
        $cityList = DB::table('v_shop')
                ->select('name_c')
                ->where('name_p', $name_province)
                ->groupBy('name_c')
                ->get();
        $shopList = DB::table('v_shop')
                ->where('name_p', $name_province)
                ->get();
        $shopByCity = [];
        foreach($cityList as $city) {
            $shopByCity[$city->name_c] = array();
        }
        foreach($shopList as $shop){
            $shopByCity[$shop->name_c][] = $shop;
        }
        return $shopByCity;
    }
}
