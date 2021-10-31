<?php

namespace App\Http\Controllers\Claim;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currency;
use App\Models\Surveyor;
use App\Models\Occupation;
use App\Models\CedingBroker;
use App\Models\NatureOfLoss;
use Illuminate\Http\Request;
use App\Models\PrefixInsured;
use App\Models\InterestInsured;
use App\MOdels\LossDescription;
use App\Models\MasterCauseOfLoss;
use App\Http\Controllers\Controller;
use App\Models\CurrencyExchange;
use App\Models\DeductibleType;
use App\Models\ExtendedCoverage;
use App\Models\FeLookupLocation;
use App\Models\RiskLocationDetail;

class ClaimController extends Controller
{
    public function requestHandler($request)
    {
        $request->validate([
            "koc" => 'required',
            "cob" => 'required',
            "uy" => 'required',
            "regcomp" => 'required',
            "counter" => 'required',
            "status" => 'required',
            "doc_ref_number" => 'required',
            "doc_number_pla_dla" => 'required',
            "cause_of_loss" => 'required',
            "nature_of_loss" => 'required',
            "reinsurance_periode_from" => 'required',
            "reinsurance_periode_to" => 'required',
            "date_of_loss" => 'required',
            "curr_of_loss" => 'required',
            "adjuster" => 'required',
            "surveyor" => 'required',
            "nasionalre_liab_percentage" => 'required',
            "nasionalre_liab_amount" => 'required',
            "cedant_Share" => 'required',
            "nasionalre_share_on_loss" => 'required',
            "date_of_receipt" => 'required',
            "date_of_document" => 'required',
            "estimate_subrogasi_percentage" => 'required',
            "estimate_subrogasi_amount" => 'required',
            "total_loss_amount" => 'required',
        ]);
        if ($request->status != "PLA")
            $request->validate([
                "potential_recovery_decision" => 'required',
                "potential_recovery" => 'required',
                "kronologi" => 'required',
                "staff_recommeandation" => 'required',
                "assistan_manager_recommendation" => 'required',
                "manager_recommendation" => 'required',
                "general_manager_recommendation" => 'required',
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'fe';
        if ($type == 'fe') {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'CLAIM FIRE & ENGINEERING - Entry';
        } elseif ($type == 'fl') {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'CLAIM FINANCIAL LINES - Entry';
        } elseif ($type == 'hem') {
            $form_name = 'HE & MOTOR';
            $route_active = 'CLAIM HE & MOTOR - Entry';
        } elseif ($type == 'mp') {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'CLAIM MOVEABLE PROPERTY - Entry';
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'CLAIM HOLE IN ONE - Entry';
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'CLAIM PERSONAL ACCIDENT - Entry';
        } elseif ($type == 'mc') {
            $form_name = 'MARINE CARGO';
            $route_active = 'CLAIM MARINE CARGO - Entry';
        } elseif ($type == 'mh') {
            $form_name = 'MARINE HULL';
            $route_active = 'CLAIM MARINE HULL - Entry';
        } else {
            abort(404);
        }
        $route_active = 'CLAIM FIRE & ENGINEERING - Entry';
        $currency = Currency::orderby('id', 'asc')->get();
        $cob = COB::where('form', $type == "mh" || $type == "mc" ? "ms" : $type)->orderby('id', 'asc')->get();
        $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02%')->orderby('code', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
        $surveyor = Surveyor::orderby('id', 'asc')->where('type_flag', 1)->get();
        $adjuster = Surveyor::orderby('id', 'asc')->where('type_flag', 2)->get();
        $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
        $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
        $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
        $lossdesc = LossDescription::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->get();
        $insured = InterestInsured::orderby('id', 'asc')->get();
        $brokerchoice = CedingBroker::all();
        $broker = CedingBroker::all();
        $deductibletype = DeductibleType::all();
        $extendedcoverage = ExtendedCoverage::all();
        return view('crm.transaction.claim.v2.entry', compact([
            'form_name',
            'type',
            'insured',
            'ceding',
            'lossdesc',
            'prefixinsured',
            'causeofloss',
            'natureofloss',
            'adjuster',
            'surveyor',
            'ceding',
            'cedingbroker',
            'currency',
            'cob',
            'koc',
            'ocp',
            'route_active',
            'broker',
            'brokerchoice',
            'deductibletype',
            'extendedcoverage',
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
        $this->requestHandler($request);
        return $request;
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

    public function filter(Request $request)
    {
        $locations = RiskLocationDetail::has('translocationtemp.slip')->with(
            'translocationtemp.felookuplocation',
            'translocationtemp.slip.insureddata.currency',
            'translocationtemp.slip.cedingbroker',
            'translocationtemp.slip.ceding',
            'translocationtemp.slip.corebusiness',
            'translocationtemp.slip.kindcontract',
            'interestdata',
            'cedingbroker'
        )->has('translocationtemp.slip.kindcontract')->has('translocationtemp.slip.corebusiness');
        $locations = $locations->whereHas('translocationtemp', function ($q) {
            $q->where('slip_type', 'fe');
        })->has('translocationtemp.slip.insureddata');

        if (isset($request->insured)) {
            $locations = $locations->where('interest_id', $request->insured);
        }

        if (isset($request->ceding)) {
            $locations = $locations->where('ceding_id', $request->ceding);
        }

        if (isset($request->ref_no)) {
            $locations = $locations->where(function ($q) use ($request) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`cndn`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->ref_no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`certno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->ref_no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`slipno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->ref_no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`policyno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->ref_no . '%']);
            });
        }

        if (isset($request->uy)) {
            $locations = $locations->whereHas('translocationtemp.insured', function ($q) use ($request) {
                $q->where('uy', $request->uy);
            })->has('translocationtemp.insured');
        }

        if (isset($request->koc)) {
            $locations = $locations->whereHas('translocationtemp.slip', function ($q) use ($request) {
                $q->where('koc', $request->koc);
            })->has('translocationtemp.slip');
        }

        if (isset($request->cob)) {
            $locations = $locations->whereHas('translocationtemp.slip', function ($q) use ($request) {
                $q->where('cob', $request->cob);
            })->has('translocationtemp.slip');
        }

        $slips = collect($locations->get())
            ->unique('translocationtemp.slip.number')
            ->pluck('translocationtemp.slip');
        $locations = $locations->get()->groupBy('translocationtemp.felookuplocation.address');

        return response()->json(['locations' => $locations, 'slips' => $slips]);
    }
}
