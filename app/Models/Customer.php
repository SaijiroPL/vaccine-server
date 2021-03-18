<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Config;

class Customer extends Model
{
    protected $table = 't_customer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'name_japan', 'tel_no', 'email', 'birthday', 'fax', 'password', 'first_name', 'last_name', 'first_huri', 'last_huri'
    ];

    public static function get_data($name) {
        return Customer::where('name', 'like', $name)->latest()->paginate(10);
    }

    public static function search_member_count($name, $tel_no) {
        return Customer::where([
            ['name', '=', $name],
            ['tel_no', '=', $tel_no],
            ])->count();
    }

    public static function getLicenseData()
    {
        return DB::table('t_license')
            ->first();
    }

    public static function search_member_id($name, $tel_no) {
        return DB::table('t_customer')
            ->select('id')
            ->where([
                ['name', '=', $name],
                ['tel_no', '=', $tel_no],
            ])->get();
    }

    public static function get_member($id) {
        return Customer::where([
            ['id', '=', $id],
            ])->get();
    }

	public static function authenticate($email, $password)
    {
        return Customer::where('email', $email)
                    ->where('password', sha1($password))
                    ->first();
    }}
