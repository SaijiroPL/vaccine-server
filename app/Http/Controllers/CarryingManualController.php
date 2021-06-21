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

    public function manuals()
    {
        $data = CarryingManual::where('type', 0)->orderBy('id', 'DESC')->get();
        return view('carrying_manual', ['data' => $data, 'type' => 0]);
    }

    public function suggest_tools()
    {
        $data = CarryingManual::where('type', 1)->orderBy('id', 'DESC')->get();
        return view('carrying_manual', ['data' => $data, 'type' => 1]);
    }

    public function add(Request $request)
    {
        $data = new CarryingManual;
        $data->type = $request->type;
        $data->display_name = $request->file('file')->getClientOriginalName();
        $data->filename = $request->file('file')->getClientOriginalName();
        if ($data->type == 0) {
            $data->url = asset(Storage::url('manual/').$data->filename);
            $request->file('file')->storeAs('public/manual/', $data->filename);
        } else {
            $data->url = asset(Storage::url('tools/').$data->filename);
            $request->file('file')->storeAs('public/tools/', $data->filename);
        }

        $data->save();

        return $data->type == 0 ? redirect('/manual') : redirect('/suggest_tools');
    }

    public function delete($id)
    {
        $data = CarryingManual::find($id);
        $type = $data->type;
        if ($type == 0) {
            Storage::delete('public/manual/'.$data->filename);
        } else {
            Storage::delete('public/tools/'.$data->filename);
        }
        $data->delete();
        return $type == 0 ? redirect('/manual') : redirect('/suggest_tools');
    }
}
