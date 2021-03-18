<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Atec extends Model
{
    protected $table = 't_atec';

    protected $fillable = [
        'kind', 'title', 'content',
    ];

    public static function get_data() {
        $atecs =  DB::table('t_atec')
                    ->latest()
                    ->paginate(10);
        return $atecs;
    }

    public static function get_atecs($shop) {
        $query='select * from t_atec
                left JOIN (select shop_id, atec_id from t_atec_confirm where shop_id='.$shop.') A on t_atec.id=A.atec_id
                where shop_id is NULL';
        $atecs =  DB::select($query);
        return $atecs;
    }

    public static function get_atec($id) {
        $atec =  DB::table('t_atec')
                    ->where('id', '=', $id)
                    ->first();
        return $atec;
    }
}
