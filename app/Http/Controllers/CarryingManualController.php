<?php

namespace App\Http\Controllers;

use App\Models\CarryingManual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarryingManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carrying_manual');
    }


}
