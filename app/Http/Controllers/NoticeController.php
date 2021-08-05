<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Shop;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class NoticeController extends Controller
{
    public function index($request)
    {
        $name = $request->input('name');
        $brand = $request->input('brand');
        $area = $request->input('area');

        $old = [
            'name' => $name,
            'brand' => $brand,
            'area' => $area
        ];

        $notice_model = new Notice();
        $notices = $notice_model->get_agree_data();
        $image_url = Storage::url('notice_image/');
        return view('notice', [
            'notices' => $notices,
            'per_page' => 10,
            'image_url' => $image_url,
            'old' => $old,
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
        $isNew = false;
        if ( $request->input('no') != '')
            $notice = Notice::find($request->input('no'));
        else
        {
            $notice = new Notice;
            $notice->agree = 1;
            $isNew = true;
        }

        $notice->kind = $request->input('kind');
        $notice->title = $request->input('title');
        $notice->content = $request->input('content');
        $notice->shop_id = $request->input('shop');
        $notice->created_by = "admin";
        if ($request->file('thumbnail') != NULL)
        {
            $notice->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $notice->image_path = asset(Storage::url('notice_image/').$notice->image);
            $request->file('thumbnail')->storeAs('public/notice_image/',$notice->image);
        }
        $notice->save();

        if ($isNew) {
            $customers = Customer::get();
            if ($notice->shop_id != 0) {
                $shop = Shop::find($notice->shop_id);
                $customers = $shop->customers;
            }
            foreach($customers as $m) {
                if ($m->fcm_token != null && $m->fcm_flag == 1) {
                    $client = new Client(['base_uri' => 'https://fcm.googleapis.com/fcm/']);
                    $client->request('POST', 'send', [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer AAAAI-LPm24:APA91bFfHq8Kp1Gmuo3hiSdoQY6YgAVUVVYPXKENMLLj6Os2nbQ0gL06-YoLOZd9fo2HBMLUVRcKMtO6FcoeT_wGr6B5bTpOrk89jK6IYXaJ9WdTSs7npIiyWjc8xz9NOx2175OTNVhK',
                        ],
                        'json' => [
                            'to' => $m->fcm_token,
                            'data' => [
                                'type' => 'notify',
                                'notify' => $notice->id,
                            ],
                            'notification' => [
                                'body' => $request->input('content'),
                                'title' => $request->input('title'),
                            ]
                        ],
                    ]);
                }
            }
        }

        return redirect("/notice");
    }
}
