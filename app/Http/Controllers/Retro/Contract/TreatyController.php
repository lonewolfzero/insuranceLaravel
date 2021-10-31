<?php

namespace App\Http\Controllers\Retro\Contract;

use App\Models\COB;
use App\Models\Koc;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Models\CurrencyExchange;
use App\Http\Controllers\Controller;
use App\Models\Retro\Contract\SpecialContract;
use App\Models\Retro\Contract\Treaty;

class TreatyController extends Controller
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
            'contract_id' => 'required',
            'production_date' => 'required',
            'quarter' => 'required',
            'year' => 'required',
            'document_date' => 'required',
        ]);
        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'document_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->document_date))),
            'production_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->production_date))),
        ]);
        return Treaty::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route_active = 'retro - contract entry';
        $contract = SpecialContract::find(base64_decode($id));
        if (!$contract)
            abort(404);
        $treaties = $contract->gettreaties;
        $koc = Koc::all();
        $cob = COB::all();
        $currency = CurrencyExchange::where('month', date('m'))->where('year', date('Y'))->get();
        $ceding = CedingBroker::all();
        return view('crm.transaction.retro.contract.treaty', compact([
            'route_active',
            'contract',
            'treaties',
            'koc',
            'cob',
            'currency',
            'ceding',
        ]));
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
    public function destroy(Treaty $treaty)
    {
        if ($treaty->delete())
            return true;

        return false;
    }
}
