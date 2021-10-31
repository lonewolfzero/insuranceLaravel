<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\SpreadingCob;
use Illuminate\Http\Request;

class SpreadingCobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return SpreadingCob::where('main_contract_id', $id)->with('getcob')->get();
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
            'main_contract_id' => 'required',
            'id_spreading_cob' => 'required',
            'detail_cob' => 'required',
            'percentage' => 'required',
            'type' => 'required',
            'koc' => 'required',
        ]);
        if ($validation) {
            $request->merge([
                'user_entry' => auth()->id(),
                'date_entry' => date('Y-m-d', strtotime(now())),
                'percentage' => str_replace(',', '', $request->percentage),
            ]);
            $spreadingcob = SpreadingCob::create($request->all());
            return $spreadingcob->load('getcob');
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
