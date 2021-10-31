<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Installment::where('layer_id', $id)->get();
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
            'date' => 'required',
            'percentage' => 'required',
        ]);
        if ($validation) {
            $request->merge([
                'user_entry' => auth()->id(),
                'date_entry' => date('Y-m-d', strtotime(now())),
                'date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->date))),
                'percentage' => str_replace(',', '', $request->percentage),
            ]);
            $installment = Installment::create($request->except(['_token']));
            return $installment;
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
