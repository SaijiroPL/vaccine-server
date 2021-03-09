<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Tossup extends Model
{
    protected $table = 't_tossup';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'title', 'content', 'date', 'shop_no',
    ];

    public static function get_data() {
        $tossups =  DB::table('v_tossup')
                    ->paginate(10);
        return $tossups;
    }

    public static function get_untossed_tossup() {
        $tossup =  DB::table('v_tossup')
                    ->where('tossed', '=', 0)
                    ->paginate(10);
        return $tossup;
    }

    public static function get_new_record_no() {
        return  DB::table('v_tossup')->max('no')+1;
    }
}
