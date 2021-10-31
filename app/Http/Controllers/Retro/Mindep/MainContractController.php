<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\MainContract;
use Illuminate\Http\Request;

class MainContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'main_contract' => 'required|unique:retro_mindep_main_contracts',
            'u_w_year' => 'required',
            'cob' => 'required',
            'contract_description' => 'required',
            'egnpi' => 'required',
            'currency' => 'required',
            'period_from' => 'required',
            'period_to' => 'required',
            'roe' => 'required',
        ]);

        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'egnpi' => str_replace(',', '', $request->egnpi),
            'period_from' => date('Y-m-d', strtotime(str_replace('/', '-', $request->period_from))),
            'period_to' => date('Y-m-d', strtotime(str_replace('/', '-', $request->period_to))),
            'roe' => str_replace(',', '', $request->roe),
        ]);

        $mainContract = MainContract::create($request->except(['_token']));
        $notification = array(
            'message' => 'Main Contract added successfully!',
            'alert-type' => 'success'
        );
        return redirect('/retro/mindep/entry?id=' . base64_encode($mainContract->id))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MainContract $mainContract)
    {
        return $mainContract->load('getuser');
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
