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
                    ->where('allow', 1)
                    ->where('device_id', $device_id)
                    ->first();
    }

    public static function get_managers($shop, $brand)
    {
        return self::with('shop')
            ->whereHas('shop', function ($q) use ($shop, $brand) {
                $q->where('name', 'like', $shop)->where('brand', 'like', $brand);
            })->latest()->paginate(10);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'store');
    }

    public static function filter($filter)
    {
        DB::table('t_manager')
            ->leftJoin('t_shop', 't_manager.store', '=', 't_shop.id')
            ->leftJoin('t_area', 't_shop.postal', '=', 't_area.postal')
            ->where('name', 'like', '%'.$filter['shop'].'%')
            ->where('brand', 'like', '%'.$filter['brand'].'%')
            ->where('name_p', 'like', '%'.$filter['province'].'%')
            ->where('name_c', 'like', '%'.$filter['county'].'%')
            ->latest()
            ->paginate(10);
    }
}
