<?php

namespace App\Http\Controllers;

use App\Models\CarryingGoods;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\CarryingGoodsDetail;

class CarryingGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $goods = CarryingGoods::get_data($type);
        $image_url = Storage::url('goods_image/');
        return view('goods', [
            'goods' => $goods,
            'per_page' => 10,
            'image_url' => $image_url,
            'type'=> $type
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
            $goods = CarryingGoods::find($no);
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

    public function detail($id) {
        $goods = CarryingGoods::find($id);
        return view('goods_detail', ['goods' => $goods]);
    }

    public function detail_post($id) {
        CarryingGoodsDetail::create([
            'goods_id' => $id,
            'name' => request('name'),
            'price' => request('price'),
        ]);
        return redirect("/master/carrying_goods/detail/".$id);
    }

    public function delete_detail($id) {
        $detail = CarryingGoodsDetail::find($id);
        $goods_id = $detail->goods_id;
        $detail->delete();
        return redirect("/master/carrying_goods/detail/".$goods_id);
    }

}
