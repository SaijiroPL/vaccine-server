<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarryingManual extends Model
{
    protected $table = 't_manual';

    protected $fillable = [
        'filename', 'display_name', 'url',
    ];
}
