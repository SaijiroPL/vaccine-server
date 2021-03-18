<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shop_model = new Shop();
        $shops = $shop_model->get_data();
        $image_url = Storage::url('shop_image/');
        return view('shop', [
            'shops' => $shops,
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
        Shop::find($request->input('del_no'))->forceDelete();
        return redirect("/shop");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //$no = $request->input('edit_no');

        $shop_model = new Shop();

        //$provinces = Shop::get_provinces();
        $image_url = Storage::url('shop_image/');

        if (isset($no))
        {
            $shop = $shop_model->get_shop($no);
        }
        else
        {
            $shop = NULL;
        }

        return view('shop_edit', [
            'shop' => $shop,
            //'provinces' => $provinces,
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
        if ( $request->input('id') != '')
            $shop = Shop::find($request->input('id'));
        else
        {
            $shop = new Shop;
        }

        $shop->name = $request->input('name');
        //$shop->province_no = $request->input('province');
        //$shop->county_no = $request->input('county');
        $shop->address = $request->input('address');
        $shop->postal = $request->input('postal');
        $shop->tel_no = $request->input('tel_no');
        if ($request->file('thumbnail') != NULL)
        {
            $shop->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $shop->image_path = asset(Storage::url('shop_image/').$shop->image);
            $request->file('thumbnail')->storeAs('public/shop_image/',$shop->image);
        }
        $shop->save();

        return redirect("/shop");
    }

    public static function get_counties_by_province(Request $request) {
        $shop = new Shop;
        $counties = Shop::get_counties($request->input('province_no'));
        return response()->json($counties);
    }
}
