<?php

namespace App\Http\Controllers\Retro\Contract;

use App\Models\COB;
use App\Models\Koc;
use App\Models\CedingBroker;
use App\Models\CurrencyExchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Retro\Contract\SpecialContract;

class ContractListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route_active = 'retro - contract list';
        $koc = Koc::all();
        $cob = COB::all();
        $currency = CurrencyExchange::where('month', date('m'))->where('year', date('Y'))->get();
        $ceding = CedingBroker::all();
        $specialContract = SpecialContract::all();
        return view('crm.transaction.retro.contract.list', compact([
            'route_active',
            'koc',
            'cob',
            'currency',
            'ceding',
            'specialContract',
        ]));
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
        //
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
