<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Shop;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class NoticeController extends Controller
{
    public function index()
    {

        $notice_model = new Notice();
        $notices = $notice_model->get_agree_data();
        $image_url = Storage::url('notice_image/');
        return view('notice', [
            'notices' => $notices,
            'per_page' => 10,
            'image_url' => $image_url
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Notice::find($request->input('del_no'))->forceDelete();
        return redirect("/notice");
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

        $notice_model = new Notice();
        $shop_model = new Shop();

        $shops = $shop_model->get_shops();
        $image_url = Storage::url('notice_image/');

        if (isset($no))
            $notice = $notice_model->get_notice($no);
        else
            $notice = NULL;
        return view('notice_edit', [
            'notice' => $notice,
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
            $notice = Notice::find($request->input('no'));
        else
        {
            $notice = new Notice;
        }

        $notice->kind = $request->input('kind');
        $notice->title = $request->input('title');
        $notice->content = $request->input('content');
        $notice->shop_id = $request->input('shop');
        $notice->agree = 1;
        $notice->created_by = "admin";
        if ($request->file('thumbnail') != NULL)
        {
            $notice->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $notice->image_path = asset(Storage::url('notice_image/').$notice->image);
            $request->file('thumbnail')->storeAs('public/notice_image/',$notice->image);
        }
        $notice->save();

        return redirect("/notice");
    }
}
