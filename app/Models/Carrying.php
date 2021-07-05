<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Carrying extends Model
{
    protected $table = 't_carrying';

    protected $fillable = [
        'shop_id', 'date', 'goods',
    ];

    public static function get_data($date, $filter) {
        if (!isset($date))
        {
            $carries =  DB::table('t_carrying')
                    ->join('t_shop', 't_carrying.shop_id', '=', 't_shop.id')
                    ->where('t_carrying.goods', 'like', $filter['goods'])
                    ->where('t_carrying.customer_id', 'like', $filter['customer'])
                    ->where('t_shop.name', 'like', $filter['shop'])
                    ->select('t_carrying.*', 't_shop.name')
                    ->latest()
                    ->paginate(10);
        } else
            $carries =  DB::table('t_carrying')
                    ->join('t_shop', 't_carrying.shop_id', '=', 't_shop.id')
                    ->where('t_carrying.goods', 'like', $filter['goods'])
                    ->where('t_carrying.customer_id', 'like', $filter['customer'])
                    ->where('t_shop.name', 'like', $filter['shop'])
                    ->where('t_carrying.date', '=', $date)
                    ->select('t_carrying.*', 't_shop.name')
                    ->latest()
                    ->paginate(10);

        return $carries;
    }

    public static function get_data_by_customer($customer_id, $shop_id)
    {
        $carries = DB::table('v_carrying')
                    ->where('shop_id', $shop_id)
                    ->where('customer_id', $customer_id)
                    ->latest()
                    ->get();
        return $carries;
    }

    public static function get_data_by_shop($shop_id)
    {
        $carries = DB::table('v_carrying')
                    ->where('shop_id', $shop_id)
                    ->latest()
                    ->get();
        return $carries;
    }

    public static function get_today_data_by_shop($shop_id)
    {
        $today = date('Y-m-d');
        $carries = DB::table('v_carrying')
                    ->where('shop_id', $shop_id)
                    ->where('date', $today)
                    ->latest()
                    ->get();
        return $carries;
    }

    public static function get_date_data_by_shop($shop_id, $from, $to)
    {
        if (!$from) $from='';
        if (!$to) $to='2100/01/01';

        $carries = DB::table('v_carrying')
                    ->where('shop_id', $shop_id)
                    ->where('date', '>=', $from)
                    ->where('date', '<=', $to)
                    ->latest()
                    ->get();
        return $carries;
    }

    public static function get_last_carrying_date($customer_id, $shop_id)
    {
        $carrying = DB::table('t_carrying')
                    ->select('date')
                    ->where('shop_id', $shop_id)
                    ->where('customer_id', $customer_id)
                    ->latest()
                    ->first();
        return $carrying;
    }

    public static function get_sigong_by_customer($customerID, $sortMode)
    {
        return DB::table('v_carrying')
            ->where('customer_id', $customerID)
            ->orderBy('created_at', $sortMode)
            ->get();
    }

}
