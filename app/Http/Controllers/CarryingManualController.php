<?php

namespace App\Http\Controllers;

use App\Models\CarryingManual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarryingManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CarryingManual::orderBy('id', 'DESC')->get();
        return view('carrying_manual', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $data = new CarryingManual;
        $data->display_name = $request->file('file')->getClientOriginalName();
        $data->filename = time().'.'.$request->file('file')->getClientOriginalExtension();
        $data->url = asset(Storage::url('manual/').$data->filename);
        $request->file('file')->storeAs('public/manual/', $data->filename);
        $data->save();

        return redirect('/manual');
    }

    public function delete($id)
    {
        $data = CarryingManual::find($id);
        Storage::delete('public/manual/'.$data->filename);
        $data->delete();
        return redirect('/manual');
    }
}
