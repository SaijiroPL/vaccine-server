<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\AtecConfirm;
use App\Models\Customer;
use App\Models\Notice;
use App\Models\Bottle;
use App\Models\Coupon;

use Config;
use App\Http\Controllers\Api\CommonApi;


class StoreApiController extends Controller
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

        $account = Manager::authenticate($email, $password, $device_id);
        if (!isset($account))
            return response()->json([
                'result' => Config::get('constants.errno.E_LOGIN'),
                'accessToken' => null,
            ]);
        else
            return response()->json([
                'result' => Config::get('constants.errno.E_OK'),
                'accessToken' => $account->access_token,
            ]);
    }

    public function signup(Request $request)
    {
        $account = new Manager;
        $account->email = $request->input('email');
        $account->password = sha1($request->input('password'));
        $account->device_id = $request->input('deviceId');
        $account->store = $request->input('store');
        $account->access_token = Manager::generate_access_token($account);

        $account->save();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'accessToken' => $account->access_token,
        ]);
    }

    public function get_stores($area=NULL)
    {
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_stores(),
        ]);
    }

    public function add_tossup(Request $request)
    {
        $account = $request->account;
        $content = $request->input('content');
        CommonApi::add_tossup($account->store, $content);
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_tossup($account->store),
        ]);
    }

    public function get_tossup(Request $request)
    {
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_tossup($account->store),
        ]);
    }

    public function get_inquiry(Request $request)
    {
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_inquiry($account->store),
        ]);
    }

    public function reply_inquiry(Request $request)
    {
        $account = $request->account;
        $id = $request->input('id');
        $reply = $request->input('reply');
        CommonApi::reply_inquiry($id, $reply);
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_inquiry($account->store),
        ]);
    }

    public function get_atec(Request $request)
    {
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_atec($account->store),
        ]);
    }

    public function confirm_atec(Request $request)
    {
        $account = $request->account;
        $atec = new AtecConfirm;
        $atec->atec_id = $request->input('atec_id');
        $atec->shop_id = $account->store;
        $atec->save();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_atec($account->store),
        ]);
    }

    public function search_member(Request $request)
    {
        $account = $request->account;
        $name = $request->input('name');
        $tel_no = $request->input('tel_no');
        $count = Customer::search_member_count($name, $tel_no);
        if ($count === 0)
        {
            return response()->json([
                'result' => Config::get('constants.errno.E_NO_MEMBER'),
            ]);
        }
        if ($count > 1)
        {
            return response()->json([
                'result' => Config::get('constants.errno.E_TOO_MANY_MEMBER'),
            ]);
        }
        $data = Customer::search_member_id($name, $tel_no);
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'memberId' => $data[0]->id,
        ]);
    }

    public function get_member(Request $request)
    {
        $id = $request->input('id');
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => Customer::get_member($id),
            'bottleInputData' => Bottle::get_data(1, $id, 0),
            'bottleRemain' => Bottle::get_remain($id, $account->store),
        ]);
    }

    public function get_bottle(Request $request)
    {
        $id = $request->input('id');
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'bottleUseDataLimit' => Bottle::get_limit_data(2, $id, $account->store),
            'bottleRemain' => Bottle::get_remain($id, $account->store),
        ]);
    }

    public function get_bottle_use(Request $request)
    {
        $id = $request->input('id');
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'bottleUseData' => Bottle::get_data(2, $id, $account->store),
        ]);
    }

    public function bottle_input(Request $request)
    {
        $id = $request->input('id');
        $half = $request->input('half');
        $full = $request->input('full');
        $account = $request->account;
        $bottle = new Bottle;
        $bottle->customer_id = $id;
        $bottle->shop_id = $account->store;
        $bottle->use_type = 1; //type 1: input
        if ($half === true)
            $bottle->amount = 50;
        else
            $bottle->amount = 100;
        $bottle->save();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
        ]);
    }

    public function get_coupon(Request $request)
    {
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_coupon_by_shop($account->store),
        ]);
    }

    public function get_notice(Request $request)
    {
        $account = $request->account;
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_notice_by_shop($account->store),
        ]);
    }

    public function add_notice(Request $request)
    {
        $account = $request->account;
        $notice = new Notice;
        $notice->kind = $request->input('kind');
        $notice->title = $request->input('title');
        $notice->content = $request->input('content');
        $notice->shop_id = $account->store;
        $notice->agree = 1;
        $notice->created_by = $account->email;
        if ($request->file('_file') != NULL)
        {
            $notice->image = time().'_'.$request->file( '_file')->getClientOriginalName();
            $notice->image_path = asset(Storage::url('notice_image/').$notice->image);
            $request->file('_file')->storeAs('public/notice_image/', $notice->image);
        }
        $notice->save();
        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_notice_by_shop($account->store),
        ]);
    }

    public function add_coupon(Request $request)
    {
        $account = $request->account;
        $coupon = new Coupon;
        $coupon->title = $request->input('title');
        $coupon->content = $request->input('content');
        $coupon->from_date = $request->input('from');
        $coupon->to_date = $request->input('to');
        $coupon->shop_id = $account->store;
        $coupon->reuse = $request->input('reuse');
        $coupon->agree = 1;
        $coupon->created_by = $account->email;

        if ($request->file('_file') != NULL)
        {
            $coupon->image = time().'_'.$request->file( '_file')->getClientOriginalName();
            $coupon->image_path = asset(Storage::url('coupon_image/').$coupon->image);
            $request->file('_file')->storeAs('public/coupon_image/',$coupon->image);
        }
        $coupon->save();

        return response()->json([
            'result' => Config::get('constants.errno.E_OK'),
            'data' => CommonApi::get_coupon_by_shop($account->store),
        ]);
    }
}
