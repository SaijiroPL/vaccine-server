<?php

namespace App\Http\Controllers;

use App\Models\CarryingGoods;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CarryingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = CarryingGoods::get_data();
        $image_url = Storage::url('goods_image/');
        return view('goods', [
            'goods' => $goods,
            'per_page' => 10,
            'image_url' => $image_url
        ]);
    }

    public function delete(Request $request)
    {
        CarryingGoods::find($request->input('del_no'))->forceDelete();
        return redirect("/master/carrying_goods");
    }

    public function edit($no=NULL)
    {

        $goods_model = new CarryingGoods();
        $image_url = Storage::url('goods_image/');

        if (isset($no))
            $goods = $goods_model->get_goods($no);
        else
            $goods = NULL;
        return view('goods_edit', [
            'goods' => $goods,
            'image_url' => $image_url
        ]);
    }

    public function update(Request $request)
    {
        if ( $request->input('no') != '')
            $goods = CarryingGoods::find($request->input('no'));
        else
        {
            $goods = new CarryingGoods;
        }

        $goods->type = $request->input('type');
        $goods->name = $request->input('name');
        $goods->price = $request->input('price');
        if ($request->file('thumbnail') != NULL)
        {
            $goods->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $goods->image_path = asset(Storage::url('goods_image/').$goods->image);
            $request->file('thumbnail')->storeAs('public/goods_image/',$goods->image);
        }
        $goods->save();

        return redirect("/master/carrying_goods");
    }

}
