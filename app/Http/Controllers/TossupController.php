<?php

namespace App\Http\Controllers;

use App\Models\Tossup;
use App\Models\Shop;
use App\Models\Inquiry;
use App\Models\Atec;

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
        $id = $request->input('toss_no');
        $shop = $request->input('shop');
        $tossup = Tossup::find($id);

        $atec = new Atec;
        $atec->kind = 'トスアップ';
        $atec->title = 'トスアップ';
        $atec->content = $tossup->content;
        $atec->shop = $tossup->shop;
        $atec->save();

        $tossup->tossed = 1;
        $tossup->save();

        return redirect("/tossup");
    }
}
