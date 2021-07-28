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
        return sha1($account->device_id.$account->real_password);
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
        return DB::table('t_manager')
            ->leftJoin('t_shop', 't_manager.store', '=', 't_shop.id')
            ->leftJoin('t_area', 't_shop.postal', '=', 't_area.postal')
            ->where('t_shop.name', 'like', '%'.$filter['shop'].'%')
            ->where('t_shop.brand', 'like', '%'.$filter['brand'].'%')
            ->where('t_area.name_p', 'like', '%'.$filter['province'].'%')
            ->where('t_area.name_c', 'like', '%'.$filter['county'].'%')
            ->select('t_manager.id', 't_shop.name', 't_area.name_p', 't_area.name_c', 't_shop.brand',
                't_manager.device_id', 't_manager.name as lid', 't_manager.real_password', 't_manager.allow')
            ->orderBy('t_shop.created_at', 'DESC')
            ->paginate(10);
    }
}
