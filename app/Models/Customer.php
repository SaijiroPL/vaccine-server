<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Config;

class Customer extends Model
{
    protected $table = 't_customer';

    protected $fillable = [
        'name', 'name_japan', 'tel_no', 'email', 'birthday', 'fax',
    ];

    public static function get_data($name) {
        return Customer::where('name', 'like', $name)->paginate(10);
    }
}
