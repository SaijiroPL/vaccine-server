<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Area extends Model
{
    protected $table = 't_area';
    protected $primaryKey = 'f_id';

    protected $fillable = [
        'f_area_name'
    ];

    public static function get_area_list()
    {
        return Area::orderby('f_area_name', 'asc')->get();
    }


}
