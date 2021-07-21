<?php

namespace App\Http\Controllers;

use App\Mail\TerminalApproveEmail;

use App\Models\Manager;
use App\Models\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop = $request->input('shop');
        $brand = $request->input('brand');
        $old = [
            'shop' => $shop,
            'brand' => $brand,
        ];
        $managers = Manager::get_managers('%'.$shop.'%', '%'.$brand.'%');

        return view('manager', [
            'managers' => $managers,
            'per_page' => 10,
            'old' => $old,
        ]);
    }

    public function allow($id)
    {
        $manager = Manager::find($id);

        if ($manager->allow == 0)
            $manager->allow = 1;
        else
            $manager->allow = 0;

        $manager->save();

        $shop = $manager->shop;
        if ($shop) {
            $data = [
                'allow' => $manager->allow,
                'shop_name' => $shop->name,
                'device_id' => $manager->device_id,
                'login_id' => $shop->login_id,
                'login_password' => $shop->login_password,
            ];
            Mail::to($shop->email)->send(new TerminalApproveEmail($data, 's.hirose@oaklay.net'));
        }
        return redirect("/manager");
    }
}
