<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Manager extends Model
{
    protected $table = 't_manager';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'password', 'store', 'allow', 'device_id', 'access_token', 'fcm_token'];
    protected $hidden = ['password'];

    public static function generate_access_token(Manager $account)
    {
        return sha1($account->device_id.$account->email);
    }

    public static function from_access_token($token)
    {
        return Manager::where('access_token', $token)->first();
    }

    public static function authenticate($name, $password, $device_id)
    {
        return Manager::where('name', $name)
                    ->where('password', sha1($password))
                    // ->where('device_id', $device_id)
                    ->first();
    }

    public static function get_managers($query)
    {
        $managers = DB::table('v_manager')
                ->where('shop_name', 'like', $query['shop_name'])
                ->latest()
                ->paginate(10);
        return $managers;
    }
}
