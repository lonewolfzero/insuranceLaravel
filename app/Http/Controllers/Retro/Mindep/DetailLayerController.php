<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\DetailLayer;
use Illuminate\Http\Request;

class DetailLayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return DetailLayer::where('layer_id', $id)->with('getcob', 'getmindep')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'layer_id' => 'required',
            'cob' => 'required',
            'mindep' => 'required',
            'limit_loss' => 'required',
            'deductible' => 'required',
        ]);
        if ($validation) {
            $request->merge([
                'user_entry' => auth()->id(),
                'date_entry' => date('Y-m-d', strtotime(now())),
                'limit_loss' => str_replace(',', '', $request->limit_loss),
                'deductible' => str_replace(',', '', $request->deductible),
            ]);
            $detailLayer = DetailLayer::create($request->all());
            return $detailLayer->load('getcob', 'getmindep');
        }
        $notification = array(
            'message' => $validation,
            'alert-type' => 'error'
        );
        return $notification;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
