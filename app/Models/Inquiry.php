<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 't_inquiry';

    protected $fillable = [
        'shop', 'content', 'customer', 'sender', 'reply'
    ];

    public static function get_data($shop_name) {

        $inquiries = DB::table('v_inquiry')
                ->where('shop_name', 'like', $shop_name)
                ->latest()
                ->paginate(10);

        return $inquiries;
    }

    public static function get_by_shop($shop)
    {
        return DB::table('v_inquiry')
            ->where('shop', $shop)
            ->where('reply', NULL)
            ->latest()
            ->get();
    }
}
