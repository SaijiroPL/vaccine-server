<?php

namespace App\Http\Controllers;

use App\Models\Atec;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $image_url = Storage::url('atec_image/');

        if (isset($no))
            $atec = $atec_model->get_atec($no);
        else
            $atec = NULL;

        return view('atec_edit', [
            'atec' => $atec,
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
        if ( $request->input('no') != '')
            $atec = Atec::find($request->input('no'));
        else
        {
            $atec = new Atec;
        }

        $atec->kind = $request->input('kind');
        $atec->title = $request->input('title');
        $atec->content = $request->input('content');
        if ($request->file('thumbnail') != NULL)
        {
            $atec->image = time().'_'.$request->file( 'thumbnail')->getClientOriginalName();
            $atec->image_path = asset(Storage::url('atec_image/').$atec->image);
            $request->file('thumbnail')->storeAs('public/atec_image/',$atec->image);
        }
        $atec->save();

        return redirect("/atec");
    }
}
