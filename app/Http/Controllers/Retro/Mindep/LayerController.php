<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\Layer;
use Illuminate\Http\Request;

class LayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Layer::where('main_contract_id', $id)->with('getcoverage')->get();
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
            'id_layer' => 'required',
            'our_contract' => 'required',
            'kind_of_treaty' => 'required',
            'type_coverage' => 'required',
            'mindep_100' => 'required',
            'share' => 'required',
            'mindep_retro' => 'required',
            'withholding_tax' => 'required',
            'limit_loss' => 'required',
            'deductible' => 'required',
            'aggregate' => 'required',
            'adj_rate' => 'required',
        ]);
        if ($validation) {
            $request->merge([
                'user_entry' => auth()->id(),
                'date_entry' => date('Y-m-d', strtotime(now())),
                'mindep_100' => str_replace(',', '', $request->mindep_100),
                'share' => str_replace(',', '', $request->share),
                'mindep_retro' => str_replace(',', '', $request->mindep_retro),
                'withholding_tax' => str_replace(',', '', $request->withholding_tax),
                'limit_loss' => str_replace(',', '', $request->limit_loss),
                'deductible' => str_replace(',', '', $request->deductible),
                'aggregate' => str_replace(',', '', $request->aggregate),
                'adj_rate' => str_replace(',', '', $request->adj_rate),
            ]);
            $layer = Layer::create($request->except(['_token']));
            return $layer->load('getcoverage');
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
    public function show(Layer $layer)
    {
        return $layer->load('getcoverage', 'getmaincontract');
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
