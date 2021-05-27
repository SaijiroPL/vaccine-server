<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $managers = Manager::get_managers();

        return view('manager', [
            'managers' => $managers,
            'per_page' => 10,
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
        return redirect("/manager");
    }
}
