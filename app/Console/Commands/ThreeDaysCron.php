<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Notice;
use App\Models\Customer;
use Log;

class ThreeDaysCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:threedays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification to user after 3 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Cron is working");
        $notices = Notice::whereNotNull('customer_id')->get();
        foreach($notices as $n) {
            $m = Customer::where('member_no', $n->customer_id)->first();
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
                            'notify' => $n->id,
                        ],
                        'notification' => [
                            'body' => $n->content,
                            'title' => $n->title,
                        ]
                    ],
                ]);
            }
        }
    }
}
