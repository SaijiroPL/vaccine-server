<?php

namespace App\Http\Controllers;

use App\Models\Atec;
use App\Models\Shop;
use App\Models\Manager;
use Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use App\Mail\StaticEmail;
use App\Services\ImageService;

class AtecController extends Controller
{
    public function index()
    {

        $atec_model = new Atec();
        $atecs = $atec_model->get_data();
        $image_url = Storage::url('atec_image/');
        return view('atec', [
            'atecs' => $atecs,
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
        Atec::find($request->input('del_no'))->forceDelete();
        return redirect("/atec");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($no=NULL)
    {
        $atec_model = new Atec();
        $shop_model = new Shop();
        $shops = $shop_model->get_shops();
        $image_url = Storage::url('atec_image/');

        if (isset($no))
            $atec = $atec_model->get_atec($no);
        else
            $atec = NULL;

        return view('atec_edit', [
            'atec' => $atec,
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
        $is_New = false;
        if ( $request->input('no') != '')
            $atec = Atec::find($request->input('no'));
        else
        {
            $atec = new Atec;
            $shop = $request->input('shop');
            $is_New = true;

            $managers = Manager::where('store', $shop)->where('allow', 1)->get();
            if ($shop == 0) {
                $managers = Manager::where('allow', 1)->get();
            } else if ($shop == -1) {
                $managers = Manager::where('allow', 1)
                    ->whereHas('shop', function ($query) {
                        $query->where('docomo', 1);
                    })->get();
            }
        }

        $atec->kind = $request->input('kind');
        $atec->title = $request->input('title');
        $atec->content = $request->input('content');
        $atec->shop = $request->input('shop');
        if ($request->file('thumbnail') != NULL)
        {
            $atec->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $atec->image_path = asset(Storage::url('atec_image/').$atec->image);
            $request->file('thumbnail')->storeAs('public/atec_image/',$atec->image);
            $targetName = 'thmb_'.$atec->image;
            ImageService::resizeImage(
                storage_path('app/public/atec_image/'.$atec->image),
                storage_path('app/public/atec_image/'.$targetName),
                240,
                180
            );
            $atec->thumbnail = asset(Storage::url('atec_image/').$targetName);
        }
        $atec->save();

        if ($is_New) {
            foreach($managers as $m) {
                if ($m->fcm_token != null) {
                    $client = new Client(['base_uri' => 'https://fcm.googleapis.com/fcm/']);
                    $client->request('POST', 'send', [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer AAAAI-LPm24:APA91bFfHq8Kp1Gmuo3hiSdoQY6YgAVUVVYPXKENMLLj6Os2nbQ0gL06-YoLOZd9fo2HBMLUVRcKMtO6FcoeT_wGr6B5bTpOrk89jK6IYXaJ9WdTSs7npIiyWjc8xz9NOx2175OTNVhK',
                        ],
                        'json' => [
                            'to' => $m->fcm_token,
                            'data' => [
                                'type' => 'atec',
                                'notify' => $atec->id,
                            ],
                            'notification' => [
                                'title' => $request->input('title'),
                                'body' => $request->input('content'),
                            ]
                        ],
                    ]);
                }
            }
            $shop = $request->input('shop');
            if ($shop > 0) {
                $shop_dest = Shop::find($shop);
                if ($shop_dest && $shop_dest->email) {
                    $data = [
                        'subject' => 'アーテック通信を受信しました。',
                        'message' => '店舗アプリから内容を確認してください。'
                    ];
                    Mail::to($shop_dest->email)->send(new StaticEmail($data, 's.hirose@oaklay.net'));
                }
            } else if ($shop == 0) {
                $shops = Shop::get();
                foreach($shops as $sh) {
                    if ($sh && $sh->email) {
                        $data = [
                            'subject' => 'アーテック通信を受信しました。',
                            'message' => '店舗アプリから内容を確認してください。'
                        ];
                        Mail::to($sh->email)->send(new StaticEmail($data, 's.hirose@oaklay.net'));
                    }
                }
            } else if ($shop == -1) {
                $shops = Shop::where('docomo', 1)->get();
                foreach($shops as $sh) {
                    if ($sh && $sh->email) {
                        $data = [
                            'subject' => 'アーテック通信を受信しました。',
                            'message' => '店舗アプリから内容を確認してください。'
                        ];
                        Mail::to($sh->email)->send(new StaticEmail($data, 's.hirose@oaklay.net'));
                    }
                }
            }
        }

        return redirect("/atec");
    }
}
