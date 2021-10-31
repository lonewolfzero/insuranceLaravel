<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\CedingBroker;
use App\Models\COB;
use App\Models\Currency;
use App\Models\Koc;
use App\Models\Retro\Mindep\Adjusment;
use App\Models\Retro\Mindep\Layer;
use App\Models\Retro\Mindep\MainContract;
use App\Models\TypeOfCoverage;
use App\Models\TypeOfMindep;
use Illuminate\Http\Request;

class RetroController extends Controller
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

    public function list(Request $request)
    {
        $route_active = 'retro - mindep entry list';
        $maincontracts = MainContract::all();
        return view('crm.transaction.retro.mindep.entry_list', compact([
            'route_active',
            'maincontracts',
        ]));
    }

    public function listAdjusment(Request $request)
    {
        $route_active = 'retro - mindep adjusment list';
        $cob = COB::all();
        $currency = Currency::all();
        $adjusments = Adjusment::all()->load('getlayer.getmaincontract');
        return view('crm.transaction.retro.mindep.adjusment_list', compact([
            'route_active',
            'cob',
            'currency',
            'adjusments',
        ]));
    }

    public function entry(Request $request)
    {
        $route_active = 'retro - mindep entry';
        $ceding = CedingBroker::all();
        $cob = COB::all();
        $koc = Koc::all();
        $currency = Currency::all();
        $typeOfCoverage = TypeOfCoverage::all();
        $typeOfMindep = TypeOfMindep::all();
        $maincontracts = MainContract::all();
        $maincontract = $layer = null;
        $form_view = 'maincontract';
        if ($request->id) {
            $maincontract = MainContract::find(base64_decode($request->id))->load('getuser', 'getcob', 'getcurrency');
        }
        if ($request->adjusment) {
            $layer = Layer::find(base64_decode($request->adjusment))->load('getmaincontract');
            $maincontract = $layer->getmaincontract;
            $form_view = 'adjusment';
        }
        return view('crm.transaction.retro.mindep.entry', compact([
            'route_active',
            'ceding',
            'cob',
            'koc',
            'currency',
            'typeOfCoverage',
            'typeOfMindep',
            'maincontract',
            'maincontracts',
            'layer',
            'form_view',
        ]));
    }

    public function entryAdjusment(Request $request)
    {
        $route_active = 'retro - mindep adjusment entry';
        return view('crm.transaction.retro.mindep.adjusment_entry', compact([
            'route_active'
        ]));
    }
}
