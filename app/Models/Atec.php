<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Atec extends Model
{
    protected $table = 't_atec';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'kind', 'title', 'content', 'date',
    ];

    public static function get_data() {
        $atecs =  DB::table('t_atec')
                    ->paginate(10);
        return $atecs;
    }

    public static function get_atec($no) {
        $atec =  DB::table('t_atec')
                    ->where('no', '=', $no)
                    ->first();
        return $atec;
    }

    public static function get_new_record_no() {
        return  DB::table('t_atec')->max('no')+1;
    }
}
