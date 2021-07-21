<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Models\Notice;
use App\Models\Shop;

class NoticeApplicationController extends Controller
{
    public function index()
    {

        $notice_model = new Notice();
        $notices = $notice_model->get_application_data();
        $image_url = Storage::url('notice_image/');
        return view('notice_application', [
            'notices' => $notices,
            'per_page' => 10,
            'image_url' => $image_url
        ]);
    }

    public function update(Request $request)
    {
        $notice = Notice::find($request->input('agree_no'));
        $notice->agree = 1;
        $notice->save();

        $shop = Shop::find($notice->shop_id);
        $customers = $shop->customers;

        foreach($customers as $m) {
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
                            'type' => 'notify',
                            'notify' => $notice->id,
                        ],
                        'notification' => [
                            'body' => $request->input('title'),
                            'title' => $request->input('content'),
                        ]
                    ],
                ]);
            }
        }

        return redirect("/notice_application");
    }
}
