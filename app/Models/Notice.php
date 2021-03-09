<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 't_notice';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'kind', 'title', 'content', 'date', 'shop_no', 'created_by', 'agree',
    ];

    public static function get_data() {
        $notices =  DB::table('v_notice')
                    ->paginate(10);
        return $notices;
    }

    public static function get_agree_data() {
        $notices =  DB::table('v_notice')
                    ->where('agree','=',1)
                    ->paginate(10);
        return $notices;
    }

    public static function get_application_data() {
        $coupons =  DB::table('v_notice')
                    ->where('agree','=',0)
                    ->paginate(10);
        return $coupons;
    }

    public static function get_notice($no) {
        $notice =  DB::table('v_notice')
                    ->where('no', '=', $no)
                    ->first();
        return $notice;
    }

    public static function get_new_record_no() {
        return  DB::table('v_notice')->max('no')+1;
    }
}
