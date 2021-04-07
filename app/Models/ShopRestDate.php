<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopRestDate extends Model
{
    protected $table = 't_shop_rest_date';
    protected $fillable = ['f_shop_id', 'f_rest_date', 'f_rest_type'];
    protected $primaryKey = 'f_id';
}
