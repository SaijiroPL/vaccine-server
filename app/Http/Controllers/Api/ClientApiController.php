<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerVerifyNumber;
use Config;

class ClientApiController extends Controller
{
    public function test(Request $request)
    {
        return response()->json([$request->header('x-access-token'), 'OK']);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $device_id = $request->input('deviceId');

        $account = Customer::authenticate($email, $password);
        if (!isset($account))
            return response()->json([
                'result' => Config::get('constants.errno.E_LOGIN'),
            ]);
        else
            return response()->json([
                'result' => Config::get('constants.errno.E_OK'),
            ]);
    }

    public function getLicense()
    {
        $license = Customer::getLicenseData();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'privacy' => $license['f_privacy'],
            'license' => $license['f_use']
        ]);
    }

    public function signup(Request $request)
    {
        $account = new Customer;
        $account->email = $request->input('email');
        $account->password = sha1($request->input('password'));
        $account->fax = $request->input('fax');
        $account->birthday = $request->input('birthDate');
        $account->first_name = $request->input('firstName');
        $account->last_name = $request->input('lastName');
        $account->name = $request->input('lastName').' '.$request->input('firstName');
        $account->first_huri = $request->input('japanese_firstName');
        $account->last_huri = $request->input('japanese_lastName');
        $account->name_japan = $request->input('japanese_firstName').' '.$request->input('japanese_lastName');
        $account->tel_no = $request->input('phoneNumber');

        $account->save();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
        ]);
    }

    public function sendVerifyNumber(Request $request)
    {
        $phoneNumber = $request->input('phoneNumber');
        $verifyNumber = '123456';
        /*
        * 해당전화번호로 verifyNumber를 전송하는 코드삽입
        */
        $verify = new CustomerVerifyNumber;
        $verify->f_phone_number = $phoneNumber;
        $verify->f_verify_number = $verifyNumber;
        $verify->save();

        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'verifyNumber' => $verifyNumber,
        ]);
    }

    public function confirmVerifyNumber(Request $request)
    {
        $verifyNumber = $request->input('verifyNumber');
        $phoneNumber = $request->input('phoneNumber');

        $verifyNumber_org = CustomerVerifyNumber::get_verifyNumber_by_phoneNumber($phoneNumber);
        $isMatch = 999;

        if (isset($verifyNumber_org) && $verifyNumber_org['f_verify_number'] == $verifyNumber) {
            $isMatch = 0;
            CustomerVerifyNumber::where('f_phone_number', $phoneNumber)->forceDelete();
        }

        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'isMatch' => $isMatch,
        ]);

    }
}
