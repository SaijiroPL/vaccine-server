<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Manager extends Model
{
    protected $table = 't_manager';
    protected $primaryKey = 'id';

    protected $fillable = ['name, email', 'password', 'store', 'device_id', 'access_token'];
    protected $hidden = ['password'];

    public static function generate_access_token(Manager $account)
    {
        return sha1($account->device_id.$account->email);
    }

    public static function from_access_token($token)
    {
        return Manager::where('access_token', $token)->first();
    }

    public static function authenticate($email, $password, $device_id)
    {
        return Manager::where('email', $email)
                    ->where('password', sha1($password))
                    ->where('device_id', $device_id)
                    ->first();
    }
}
