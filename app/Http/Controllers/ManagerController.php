<?php

namespace App\Http\Controllers;

use App\Mail\TerminalApproveEmail;

use App\Models\Manager;
use App\Models\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $old = ['shop' => $shop];
        $query = [
            'shop_name' => '%'.$shop.'%'
        ];
        $managers = Manager::get_managers($query);

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

        $data = ['message' => 'This is a test!'];
        Mail::to('john@example.com')->send(new TerminalApproveEmail($data));

        $shop = $manager->shop;
        return redirect("/manager");
    }
}
