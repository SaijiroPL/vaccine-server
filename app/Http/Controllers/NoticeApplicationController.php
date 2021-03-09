<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

        return redirect("/notice_application");
    }
}
