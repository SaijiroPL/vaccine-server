<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 't_inquiry';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'shop_no', 'content', 'customer', 'date', 'sender',
    ];

    public static function get_data($shop_name) {

        $inquiries =  DB::table('t_inquiry')
                ->join('t_shop', 't_inquiry.shop_no', '=', 't_shop.no')
                ->where('t_shop.name', 'like', $shop_name)
                ->paginate(10);

        return $inquiries;
    }

    public static function get_new_record_no() {
        return  DB::table('t_inquiry')->max('no')+1;
    }
}
