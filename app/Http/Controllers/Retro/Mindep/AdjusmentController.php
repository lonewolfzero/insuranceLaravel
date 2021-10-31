<?php

namespace App\Http\Controllers\Retro\Mindep;

use App\Http\Controllers\Controller;
use App\Models\Retro\Mindep\Adjusment;
use Illuminate\Http\Request;

class AdjusmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Adjusment::where('layer_id', $id)->get();
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
            'id_adjusment' => 'required',
            'version' => 'required',
            'due_date' => 'required',
            'agnpi' => 'required',
            'adj_premium_rate_percentage' => 'required',
            'adj_premium_rate_amount' => 'required',
            'additional_premium' => 'required',
            'overrider_percentage' => 'required',
            'overrider_amount' => 'required',
            'no_claim_bonus_percentage' => 'required',
            'no_claim_bonus_amount' => 'required',
            'balance_due' => 'required',
        ]);
        if ($validation) {
            $request->merge([
                'user_entry' => auth()->id(),
                'date_entry' => date('Y-m-d', strtotime(now())),
                'due_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->due_date))),
                'agnpi' => str_replace(',', '', $request->agnpi),
                'adj_premium_rate_percentage' => str_replace(',', '', $request->adj_premium_rate_percentage),
                'adj_premium_rate_amount' => str_replace(',', '', $request->adj_premium_rate_amount),
                'additional_premium' => str_replace(',', '', $request->additional_premium),
                'overrider_percentage' => str_replace(',', '', $request->overrider_percentage),
                'overrider_amount' => str_replace(',', '', $request->overrider_amount),
                'no_claim_bonus_percentage' => str_replace(',', '', $request->no_claim_bonus_percentage),
                'no_claim_bonus_amount' => str_replace(',', '', $request->no_claim_bonus_amount),
                'balance_due' => str_replace(',', '', $request->balance_due),
            ]);
            $adjusment = Adjusment::create($request->all());
            return $adjusment;
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
     * @param  \App\Models\Retro\Mindep\Adjusment  $adjusment
     * @return \Illuminate\Http\Response
     */
    public function show(Adjusment $adjusment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retro\Mindep\Adjusment  $adjusment
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjusment $adjusment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retro\Mindep\Adjusment  $adjusment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjusment $adjusment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retro\Mindep\Adjusment  $adjusment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjusment $adjusment)
    {
        //
    }

    public function cancelreplace(Adjusment $adjusment)
    {
        $cancel = $adjusment->replicate();
        $cancel->version = (int)$cancel->version + 1;
        $columns = [
            'agnpi',
            'adj_premium_rate_amount',
            'additional_premium',
            'overrider_amount',
            'no_claim_bonus_amount',
            'balance_due',
        ];
        foreach ($columns as $c) {
            $cancel->{$c} = (float)$cancel->{$c} == 0 ? $cancel->{$c} : $cancel->{$c} * -1;
        }
        $cancel->date_entry = date('Y-m-d', strtotime(now()));
        $cancel->save();
        return $cancel;
    }
}
