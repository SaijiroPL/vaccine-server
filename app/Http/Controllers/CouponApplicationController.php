<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Mail;

use App\Models\Coupon;
use App\Models\Shop;
use App\Mail\ApproveCouponEmail;

class CouponApplicationController extends Controller
{
    public function index()
    {

        $coupon_model = new Coupon();
        $coupons = $coupon_model->get_application_data();
        $image_url = Storage::url('coupon_image/');
        return view('coupon_application', [
            'coupons' => $coupons,
            'per_page' => 10,
            'image_url' => $image_url
        ]);
    }

    public function update(Request $request)
    {
        $coupon = Coupon::find($request->input('agree_no'));
        $coupon->agree = 1;
        $coupon->save();

        $shop = $coupon->shop;
        if ($shop && $shop->email) {
            $data = [
                'coupon_name' => $coupon->title,
            ];
            Mail::to($shop->email)->send(new ApproveCouponEmail($data, 's.hirose@oaklay.net'));
        }

        return redirect("/coupon_application");
    }
}
