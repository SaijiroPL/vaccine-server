<?php

namespace App\Http\Controllers;

use App\Models\Tossup;
use App\Models\Shop;
use App\Models\Inquiry;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TossupController extends Controller
{
    public function index()
    {

        $tossup_model = new Tossup();
        $tossups = $tossup_model->get_untossed_tossup();
        $shop_model = new Shop();

        $shops = $shop_model->get_shops();

        return view('tossup', [
            'tossups' => $tossups,
            'shops' => $shops,
            'per_page' => 10,
        ]);
    }

    /**
     * tossup a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tossup(Request $request)
    {
        $no = $request->input('toss_no');
        $shop = $request->input('shop');
        $tossup = Tossup::find($no);
        $inquiry = new Inquiry;

        $inquiry->no = $inquiry->get_new_record_no();
        $inquiry->shop_no = $shop;
        $inquiry->content = $tossup->content;
        $inquiry->customer = Shop::get_shop($tossup->shop_no)->name;
        $inquiry->date = date('Y/m/d');
        $inquiry->sender = "admin";

        $inquiry->save();

        $tossup->tossed = 1;
        $tossup->save();

        return redirect("/tossup");
    }


}
