<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use App\Models\Coupon;
use App\Models\Shop;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coupon_model = new Coupon();
        $coupons = $coupon_model->get_agree_data();
        $image_url = Storage::url('coupon_image/');
        return view('coupon', [
            'coupons' => $coupons,
            'per_page' => 10,
            'image_url' => $image_url
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Coupon::find($request->input('del_no'))->forceDelete();
        return redirect("/coupon");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($no=NULL)
    {

        $coupon_model = new Coupon();
        $shop_model = new Shop();

        $shops = $shop_model->get_shops();
        $image_url = Storage::url('coupon_image/');

        if (isset($no))
            $coupon = $coupon_model->get_coupon($no);
        else
            $coupon = NULL;
        return view('coupon_edit', [
            'coupon' => $coupon,
            'shops' => $shops,
            'image_url' => $image_url
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ( $request->input('no') != '')
            $coupon = Coupon::find($request->input('no'));
        else
        {
            $coupon = new Coupon;
        }

        $coupon->title = $request->input('title');
        $coupon->content = $request->input('content');
        $coupon->from_date = $request->input('from_date');
        $coupon->to_date = $request->input('to_date');
        $coupon->shop_id = $request->input('shop');
        $coupon->reuse = $request->input('reuse');
        $coupon->type = $request->input('type');
        $coupon->amount = $request->input('amount');
        $coupon->unit = $request->input('unit');
        $coupon->agree = 1;
        $coupon->created_by = "admin";
        if ($request->file('thumbnail') != NULL)
        {
            $coupon->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $coupon->image_path = asset(Storage::url('coupon_image/').$coupon->image);
            $request->file('thumbnail')->storeAs('public/coupon_image/',$coupon->image);
        }
        $coupon->save();

        return redirect("/coupon");
    }
}
