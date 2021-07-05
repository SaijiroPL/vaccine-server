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
    public function index(Request $request)
    {
        $area = $request->input('area');
        $old = ['area' => $area];
        $shops = Shop::get_data($area);
        $image_url = Storage::url('shop_image/');
        return view('shop', [
            'shops' => $shops,
            'per_page' => 10,
            'image_url' => $image_url,
            'old' => $old,
        ]);
    }

    public function delete(Request $request)
    {
        Shop::find($request->input('del_no'))->forceDelete();
        return redirect("/shop");
    }

    public function edit($no=NULL)
    {
        $shop_model = new Shop();
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
            'image_url' => $image_url
        ]);
    }

    public function update(Request $request)
    {
        if ($request->input('id') != '')
            $shop = Shop::find($request->input('id'));
        else
        {
            $shop = new Shop;
        }

        $shop->name = $request->input('name');
        $shop->address = $request->input('address');
        $shop->postal = $request->input('postal');
        $shop->tel_no = $request->input('tel_no');
        $shop->docomo = (NULL !== $request->input('docomo'));
        $shop->link = $request->input('link');
        $shop->latitude = $request->input('latitude');
        $shop->longitude = $request->input('longitude');
        $shop->brand = $request->input('brand');
        $shop->email = $request->input('email');
        $shop->class_link = $request->input('class_link');
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
