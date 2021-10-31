<?php

namespace App\Http\Controllers\Claim;

use App\Models\COB;
use App\Models\Koc;
use App\Models\User;
use App\Models\Insured;
use App\Models\Currency;
use App\Models\Surveyor;
use App\Models\SlipTable;
use App\Models\Occupation;
use App\Models\CedingBroker;
use App\Models\NatureOfLoss;
use App\Models\ShipListTemp;
use Illuminate\Http\Request;
use App\Models\PrefixInsured;
use App\Models\InterestInsured;
use App\Models\LossDescription;
use App\Models\FeLookupLocation;
use App\Models\Customer\Customer;
use App\Models\ClaimDetail;
use App\Models\MasterCauseOfLoss;
use App\Models\InterestInsuredTemp;
use App\Http\Controllers\Controller;
use App\Models\ClaimInsuredData;
use App\Models\CurrencyExchange;
use App\Models\ClaimLossDescription;
use Illuminate\Support\Facades\Auth;

class MarineController extends Controller
{
    public function index($type)
    {
        if ($type == 'cargo') {
            $route_active = 'CLAIM MARINE CARGO - Entry';
        } else if ($type == 'hull') {
            $route_active = 'CLAIM MARINE HULL - Entry';
        } else {
            abort(404);
        }
        $currency = Currency::orderby('id', 'asc')->get();
        $cob = COB::orderby('id', 'asc')->get();
        $koc = Koc::orderby('code', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
        $surveyors = Surveyor::orderby('id', 'asc')->where('type_flag', 1)->get();
        $adjusters = Surveyor::orderby('id', 'asc')->where('type_flag', 2)->get();
        $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
        $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
        // $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
        $lossdesc = LossDescription::orderby('id', 'asc')->get();
        $cedings = CedingBroker::orderby('id', 'asc')->get();
        $insureds = InterestInsured::orderby('id', 'asc')->get();
        return view('crm.transaction.claim.marine.entry', compact(
            'type',
            'ocp',
            'cedingbroker',
            'ceding',
            'lossdesc',
            'surveyors',
            'adjusters',
            'natureofloss',
            'causeofloss',
            'currency',
            'insureds',
            'cedings',
            'cob',
            'koc',
            'route_active'
        ));
    }

    public function retrieveDataCargo(Request $request)
    {
        $interestDetail = InterestInsuredTemp::with(
            'cedingdata',
            'interestinsureddata',
            'ship.cedingdata',
            'ship.insured.slip.kindcontract',
            'ship.insured.slip.corebusiness',
            'ship.insured.slip.cedingbroker',
            'ship.insured.slip.ceding',
            'ship.insured.currency',
        )->where('slip_type', 'mc')->has('ship.insured.slip.kindcontract')->has('ship.insured.slip.corebusiness');

        if (isset($request->insured)) {
            $interestDetail = $interestDetail->where('interest_id', $request->insured);
        }

        if (isset($request->ceding)) {
            $interestDetail = $interestDetail->where('ceding_id', $request->ceding);
        }

        if (isset($request->no)) {
            $interestDetail = $interestDetail->where(function ($q) use ($request) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`cndn`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`certno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`slipno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`policyno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
            });
        }

        if (isset($request->uy)) {
            $interestDetail = $interestDetail->whereHas('ship.insured', function ($q) use ($request) {
                $q->where('uy', $request->uy);
            })->has('ship.insured.slip');
        }

        if (isset($request->koc)) {
            $interestDetail = $interestDetail->whereHas('ship.insured.slip', function ($q) use ($request) {
                $q->where('koc', $request->koc);
            })->has('ship.insured.slip');
        }

        if (isset($request->cob)) {
            $interestDetail = $interestDetail->whereHas('ship.insured.slip', function ($q) use ($request) {
                $q->where('cob', $request->cob);
            })->has('ship.insured.slip');
        }

        $slips = [];
        foreach ($interestDetail->get() as $interest) {
            if ($interest->ship->insured->slip && !in_array($interest->ship->insured->slip, $slips, true)) {
                $insured = $interest->ship->insured;
                $exchange =  CurrencyExchange::where('currency', $insured->currency_id)
                    ->where('month', date('m', strtotime($insured->created_at)))
                    ->where('year', date('Y', strtotime($insured->created_at)))
                    ->latest()->first();
                if ($exchange) {
                    $interest->ship->insured->slip->exchange = $exchange;
                    $interest->ship->insured->slip->uy = $interest->ship->insured->uy;
                    $interest->ship->insured->slip->currency = $interest->ship->insured->currency;
                    array_push($slips, $interest->ship->insured->slip);
                }
            }
        }

        $ship_sorted = [];
        foreach ($interestDetail->get() as $interest) {
            $shp = (object)[];
            if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) {
                $shp->name = $interest->ship->ship_name;
                $shp->insured = $interest->ship->insured;
                $shp->slip = $interest->ship->insured->slip;
                $shp->slip_type = $interest->slip_type;
                $shp->interest = [];
            }
            $intrs = (object)[];
            $intrs->id = $interest->id;
            $intrs->ship_id = $interest->ship_id;
            $intrs->amount = $interest->amount;
            $intrs->insured_id = $interest->insured_id;
            $intrs->ceding_id = $interest->ceding_id;
            $intrs->cndn = $interest->cndn;
            $intrs->certno = $interest->certno;
            $intrs->slipno = $interest->slipno;
            $intrs->policyno = $interest->policyno;
            $intrs->percent = $interest->percent;
            $intrs->slip_type = $interest->slip_type;
            $intrs->status = $interest->status;
            $intrs->cedingdata = $interest->cedingdata;
            $intrs->slip_number = $interest->ship->insured->slip->number;
            $intrs->interestinsureddata = $interest->interestinsureddata;
            array_push(
                $shp->interest,
                $intrs
            );
            if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) array_push(
                $ship_sorted,
                $shp
            );
        }

        return response()->json(['ships' => $ship_sorted, 'slips' => $slips]);
    }

    public function retrieveDataHull(Request $request)
    {
        $ships = ShipListTemp::with(
            'cedingdata',
            'insured.currency',
            'insured.slip.kindcontract',
            'insured.slip.corebusiness',
            'insured.slip.cedingbroker',
            'insured.slip.ceding',
        )->where('slip_type', 'mh')
            ->has('cedingdata')
            ->has('insured.slip')
            ->has('insured.slip.kindcontract')
            ->has('insured.slip.cedingbroker')
            ->has('insured.slip.ceding')
            ->has('insured.slip.corebusiness');

        if (isset($request->insured)) {
            $ships = $ships->where('interest_id', $request->insured);
        }

        if (isset($request->ceding)) {
            $ships = $ships->where('ceding_id', $request->ceding);
        }

        if (isset($request->no)) {
            $ships = $ships->where(function ($q) use ($request) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`cndn`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`certno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`slipno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`policyno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
            });
        }

        if (isset($request->uy)) {
            $ships = $ships->whereHas('insured', function ($q) use ($request) {
                $q->where('uy', $request->uy);
            })->has('insured');
        }

        if (isset($request->koc)) {
            $ships = $ships->whereHas('insured.slip', function ($q) use ($request) {
                $q->where('koc', $request->koc);
            })->has('insured.slip');
        }

        if (isset($request->cob)) {
            $ships = $ships->whereHas('insured.slip', function ($q) use ($request) {
                $q->where('cob', $request->cob);
            })->has('insured.slip');
        }

        $slips = [];
        foreach ($ships->get() as $interest) {
            if ($interest->insured->slip && !in_array($interest->insured->slip, $slips, true)) {
                $insured = $interest->insured;
                $exchange =  CurrencyExchange::where('currency', $insured->currency_id)
                    ->where('month', date('m', strtotime($insured->created_at)))
                    ->where('year', date('Y', strtotime($insured->created_at)))
                    ->latest()->first();
                if ($exchange) {
                    $interest->insured->slip->exchange = $exchange;
                    $interest->insured->slip->uy = $interest->insured->uy;
                    $interest->insured->slip->currency = $interest->insured->currency;
                    array_push($slips, $interest->insured->slip);
                }
            }
        }

        $ship_sorted = [];
        if (false) foreach ($ships->get() as $interest) {
            $shp = (object)[];
            if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) {
                $shp->name = $interest->ship->ship_name;
                $shp->insured = $interest->ship->insured;
                $shp->slip = $interest->ship->insured->slip;
                $shp->slip_type = $interest->slip_type;
                $shp->interest = [];
            }
            $intrs = (object)[];
            $intrs->id = $interest->id;
            $intrs->ship_id = $interest->ship_id;
            $intrs->amount = $interest->amount;
            $intrs->insured_id = $interest->insured_id;
            $intrs->ceding_id = $interest->ceding_id;
            $intrs->cndn = $interest->cndn;
            $intrs->certno = $interest->certno;
            $intrs->slipno = $interest->slipno;
            $intrs->policyno = $interest->policyno;
            $intrs->percent = $interest->percent;
            $intrs->slip_type = $interest->slip_type;
            $intrs->status = $interest->status;
            $intrs->cedingdata = $interest->cedingdata;
            $intrs->slip_number = $interest->ship->insured->slip->number;
            $intrs->interestinsureddata = $interest->interestinsureddata;
            array_push(
                $shp->interest,
                $intrs
            );
            if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) array_push(
                $ship_sorted,
                $shp
            );
        }

        return response()->json(['ships' => $ships->get(), 'slips' => $slips]);
    }

    public function slipDetails($number)
    {
        $slipdata = (object)[];
        $dateyeardata = '';
        $datetransfer = '';
        $building_rate_up = '';
        $building_rate_down = '';
        $attachmentlist = '';
        $newdeductdata = '';
        $newextenddata = '';
        $statuslist = '';
        $sum_permilec = '';
        $slip = SlipTable::where('number', $number)->get();
        $sum_inspanpercent = '';
        return $slip;
        return response()->json(
            [
                'id' => $slipdata->id,
                'insured_id' => $slipdata->insured_id,
                'slip_type' => $slipdata->slip_type,
                'username' => $slipdata->username,
                'prod_year' => $dateyeardata,
                'number' => $slipdata->number ?? $number,
                'slipuy' => $slipdata->uy,
                'date_transfer' => $datetransfer,
                'status' => $slipdata->status,
                'endorsment' => $slipdata->endorsment,
                'selisih' => $slipdata->selisih,
                'source' => $slipdata->source,
                'source_2' => $slipdata->source_2,
                'currency' => $slipdata->currency,
                'cob' => $slipdata->cob,
                'koc' => $slipdata->koc,
                'occupacy' => $slipdata->occupacy,
                'build_const' => $slipdata->build_const,
                'build_rate_up' => $building_rate_up,
                'build_rate_down' => $building_rate_down,
                'slip_no' => $slipdata->slip_no,
                'cn_dn' => $slipdata->cn_dn,
                'policy_no' => $slipdata->policy_no,
                'attacment_file' => $attachmentlist,
                'type_tsi' => $slipdata->type_tsi,
                'total_sum_insured' => $slipdata->total_sum_insured,
                'type_share_tsi' => $slipdata->type_share_tsi,
                'share_tsi' => $slipdata->share_tsi,
                'insured_type' => $slipdata->insured_type,
                'insured_pct' => $slipdata->insured_pct,
                'total_sum_pct' => $slipdata->total_sum_pct,
                'deductible_panel' => $newdeductdata,
                'extend_coverage' => $newextenddata,
                'insurance_period_from' => date("d/m/Y", strtotime($slipdata->insurance_period_from)),
                'insurance_period_to' => date("d/m/Y", strtotime($slipdata->insurance_period_to)),
                'reinsurance_period_from' => date("d/m/Y", strtotime($slipdata->reinsurance_period_from)),
                'reinsurance_period_to' => date("d/m/Y", strtotime($slipdata->reinsurance_period_to)),
                'proportional' => $slipdata->proportional,
                'layer_non_proportional' => $slipdata->layer_non_proportional,
                'rate' => $slipdata->rate,
                'sum_rate' => $slipdata->sliptotalrate,
                'share' => $slipdata->share,
                'sum_share' => $slipdata->sum_share,
                'basic_premium' => $slipdata->basic_premium,
                'commission' => $slipdata->commission,
                'grossprm_to_nr' => $slipdata->grossprm_to_nr,
                'netprm_to_nr' => $slipdata->netprm_to_nr,
                'installment_panel' => $slipdata->installment_panel,
                'sum_commission' => $slipdata->sum_commission,
                'retro_backup' => $slipdata->retro_backup,
                'own_retention' => $slipdata->own_retention,
                'sum_own_retention' => $slipdata->sum_own_retention,
                'retrocession_panel' => $slipdata->retrocession_panel,
                'endorsment' => $slipdata->endorsment,
                'prev_endorsement' => $slipdata->prev_endorsement,
                'condition_needed' => $slipdata->condition_needed,
                'created_at' => $slipdata->created_at,
                'updated_at' => $slipdata->updated_at,
                'wpc' => $slipdata->wpc,
                'remarks' => $slipdata->remarks,
                'v_broker' => $slipdata->v_broker,
                // 'sum_v_broker'=>$slipdata->sum_feebroker,
                'total_day' => $slipdata->total_day,
                'total_year' => $slipdata->total_year,
                'sum_total_date' => $slipdata->sum_total_date,
                'coinsurance_slip' => $slipdata->coinsurance_slip,
                'status_log' => $statuslist,
                'sum_feebroker' => $slipdata->sum_feebroker,
                'sum_ec' => $sum_permilec,
                'sum_ippercent' => $sum_inspanpercent
            ]
        );
    }

    public function storeClaim(Request $request)
    {
        $validator = $request->validate([
            'number' => 'required',
            'reg_comp' => 'required',
            'docpladla' => 'required',
            'date_receipt' => 'required',
            'date_document' => 'required',
            'causeofloss_id' => 'required',
            'natureofloss_id' => 'required',
            'date_of_loss' => 'required',
            'curr_id_loss' => 'required',
            'surveyor_id' => 'required',
            'adjuster_id' => 'required',
            'nasre_liab' => 'required',
            'nasre_share_loss' => 'required',
            'ced_share' => 'required',
            'total_loss_amount' => 'required',
            'estimate_percent_subro' => 'required',
        ]);
        if ($validator) {
            // return $request;
            $claimdata = ClaimDetail::where('reg_comp', $request->reg_comp)->where('doc_counter', $request->doc_counter)->orderby('id', 'DESC')->first();
            // return $claimdata->id;

            if ($claimdata) {
                if ($claimdata->status_flag != 1) {
                    $validator = $request->validate([
                        'potentialrecoverydecision' => 'required',
                        'potentialrecovery' => 'required',
                        'kronologi' => 'required',
                        'staffrecomend' => 'required',
                        'assistantmanagerrecomend' => 'required',
                    ]);
                    if ($validator) {
                        // $claimdata->number = $request->number;
                        // $claimdata->reg_comp = $request->regcomp;
                        // $claimdata->doc_number = $request->docnumber;
                        // $claimdata->docpladla = $request->docpladla;
                        // $claimdata->date_receipt = date("Y-m-d", strtotime($request->dateofreceipt));
                        // $claimdata->date_document = date("Y-m-d", strtotime($request->dateofdocument));
                        // $claimdata->causeofloss_id = $request->causeofloss;
                        // $claimdata->desc_causeofloss = $request->desccauseofloss;
                        // $claimdata->natureofloss_id = $request->natureofloss;
                        // $claimdata->descnatureofloss = $request->descnatureofloss;
                        // $claimdata->date_of_loss = date("Y-m-d", strtotime($request->dateofloss));
                        // $claimdata->curr_id_loss = $request->currofloss;
                        // $claimdata->curr_lossdesc = $request->desccurrofloss;
                        // $claimdata->surveyor_id = $request->surveyoradjuster;
                        // $claimdata->desc_surveyor = $request->descsurveyoradjuster;
                        // $claimdata->nasre_liab = $request->nationalresliab;
                        // $claimdata->nasre_liabdesc = $request->descnationalresliab;
                        // $claimdata->nasre_share_loss = $request->shareonloss;
                        // $claimdata->ced_share = $request->cedantshare;
                        // $claimdata->total_loss_amount = $request->totallossamount;
                        // $claimdata->estimate_percent_subro = $request->subrogasipersen;
                        // $claimdata->estimate_amount_subro = $request->subrogasi;
                        $claimdata->potential_recovery = $request->potential_recovery;
                        $claimdata->desc_poten_rec = $request->desc_poten_rec;
                        $claimdata->kronologi = $request->kronologi;
                        $claimdata->staff_recomendation = $request->staff_recomendation;
                        $claimdata->ass_man_recomen = $request->ass_man_recomen;
                        $claimdata->pureor_liability = $request->pureorliability;
                        $claimdata->pureor_loss = $request->pureorloss;
                        $claimdata->pureor_retro = $request->pureorcontract;
                        $claimdata->pureor_recovery = $request->pureorrecovery;
                        $claimdata->qs_liability = $request->qsliability;
                        $claimdata->qs_loss = $request->qsloss;
                        $claimdata->qs_retro = $request->qscontract;
                        $claimdata->qs_recovery = $request->qsrecovery;
                        $claimdata->arr1_liability = $request->arr1liability;
                        $claimdata->arr1_loss = $request->arr1loss;
                        $claimdata->arr1_retro = $request->arr1contract;
                        $claimdata->arr1_recovery = $request->arr1recovery;
                        $claimdata->extra_liability = $request->extraliability;
                        $claimdata->extra_loss = $request->extraloss;
                        $claimdata->extra_retro = $request->extracontract;
                        $claimdata->extra_recovery = $request->extrarecovery;
                        $claimdata->facultative_liability = $request->facultativeliability;
                        $claimdata->facultative_loss = $request->facultativeloss;
                        $claimdata->facultative_retro = $request->facultativecontract;
                        $claimdata->facultative_recovery = $request->facultativerecovery;
                        $claimdata->arr2_liability = $request->arr2liability;
                        $claimdata->arr2_loss = $request->arr2loss;
                        $claimdata->arr2_retro = $request->arr2contract;
                        $claimdata->arr2_recovery = $request->arr2recovery;
                        $claimdata->arr3_liability = $request->arr3liability;
                        $claimdata->arr3_loss = $request->arr3loss;
                        $claimdata->arr3_retro = $request->arr3contract;
                        $claimdata->arr3_recovery = $request->arr3recovery;
                        $claimdata->totalrecovery = $request->totalrecovery;
                        $claimdata->nrsgrossret = $request->nrsgrossret;
                        $claimdata->xol = $request->xol;
                        $claimdata->cereffno = $request->cereffno;
                        $claimdata->dateofprod = $request->dateofprod ? date("Y-m-d", strtotime($request->dateofprod)) : null;
                        $claimdata->ceno = $request->ceno;
                        $claimdata->ceuser = $request->ceuser;
                        $claimdata->status_ce = $request->status_ce;
                        $claimdata->description = $request->description;
                        $claimdata->dateofentry = $request->dateentry ? date("Y-m-d", strtotime($request->dateentry)) : null;
                        $claimdata->dateoftrans = $request->datetrans ? date("Y-m-d", strtotime($request->datetrans)) : null;
                        $claimdata->dateofsupporting = $request->datesupporting ? date("Y-m-d", strtotime($request->datesupporting)) : null;
                        $claimdata->save();
                    }
                } else {
                    $claimdata->potential_recovery = $request->potential_recovery;
                    $claimdata->desc_poten_rec = $request->desc_poten_rec;
                    $claimdata->kronologi = $request->kronologi;
                    $claimdata->staff_recomendation = $request->staff_recomendation;
                    $claimdata->ass_man_recomen = $request->ass_man_recomen;
                    $claimdata->pureor_liability = $request->pureorliability;
                    $claimdata->pureor_loss = $request->pureorloss;
                    $claimdata->pureor_retro = $request->pureorcontract;
                    $claimdata->pureor_recovery = $request->pureorrecovery;
                    $claimdata->qs_liability = $request->qsliability;
                    $claimdata->qs_loss = $request->qsloss;
                    $claimdata->qs_retro = $request->qscontract;
                    $claimdata->qs_recovery = $request->qsrecovery;
                    $claimdata->arr1_liability = $request->arr1liability;
                    $claimdata->arr1_loss = $request->arr1loss;
                    $claimdata->arr1_retro = $request->arr1contract;
                    $claimdata->arr1_recovery = $request->arr1recovery;
                    $claimdata->extra_liability = $request->extraliability;
                    $claimdata->extra_loss = $request->extraloss;
                    $claimdata->extra_retro = $request->extracontract;
                    $claimdata->extra_recovery = $request->extrarecovery;
                    $claimdata->facultative_liability = $request->facultativeliability;
                    $claimdata->facultative_loss = $request->facultativeloss;
                    $claimdata->facultative_retro = $request->facultativecontract;
                    $claimdata->facultative_recovery = $request->facultativerecovery;
                    $claimdata->arr2_liability = $request->arr2liability;
                    $claimdata->arr2_loss = $request->arr2loss;
                    $claimdata->arr2_retro = $request->arr2contract;
                    $claimdata->arr2_recovery = $request->arr2recovery;
                    $claimdata->arr3_liability = $request->arr3liability;
                    $claimdata->arr3_loss = $request->arr3loss;
                    $claimdata->arr3_retro = $request->arr3contract;
                    $claimdata->arr3_recovery = $request->arr3recovery;
                    $claimdata->totalrecovery = $request->totalrecovery;
                    $claimdata->nrsgrossret = $request->nrsgrossret;
                    $claimdata->xol = $request->xol;
                    $claimdata->cereffno = $request->cereffno;
                    $claimdata->dateofprod = $request->dateofprod ? date("Y-m-d", strtotime($request->dateofprod)) : null;
                    $claimdata->ceno = $request->ceno;
                    $claimdata->ceuser = $request->ceuser;
                    $claimdata->status_ce = $request->status_ce;
                    $claimdata->description = $request->description;
                    $claimdata->dateofentry = $request->dateentry ? date("Y-m-d", strtotime($request->dateentry)) : null;
                    $claimdata->dateoftrans = $request->datetrans ? date("Y-m-d", strtotime($request->datetrans)) : null;
                    $claimdata->dateofsupporting = $request->datesupporting ? date("Y-m-d", strtotime($request->datesupporting)) : null;
                    $claimdata->save();
                }
                return response()->json(['id' => $claimdata->id, 'claim' => $claimdata, 'regcomp' => $claimdata->reg_comp, 'status' => 'updated!']);
            } else {
                if (false) $mcef = ClaimDetail::create([
                    'number' => $request->number,
                    'reg_comp' => $request->regcomp,
                    'doc_number' => $request->docnumber,
                    'docpladla' => $request->docpladla,
                    'date_receipt' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofreceipt))) ?? date("Y-m-d", strtotime($request->dateofreceipt)),
                    'date_document' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofdocument))) ?? date("Y-m-d", strtotime($request->dateofdocument)),
                    'causeofloss_id' => $request->causeofloss,
                    'desc_causeofloss' => $request->desccauseofloss,
                    'natureofloss_id' => $request->natureofloss,
                    'descnatureofloss' => $request->descnatureofloss,
                    'date_of_loss' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss)),
                    'curr_id_loss' => $request->currofloss,
                    'curr_lossdesc' => $request->desccurrofloss,
                    'adjuster_id' => $request->surveyoradjuster,
                    'desc_adjuster' => $request->descsurveyoradjuster,
                    'nasre_liab' => $request->nationalresliab,
                    'nasre_liabdesc' => $request->descnationalresliab,
                    'nasre_share_loss' => $request->shareonloss,
                    'ced_share' => $request->cedantshare,
                    'total_loss_amount' => $request->totallossamount,
                    'potential_recovery' => $request->potentialrecoverydecision,
                    'estimate_percent_subro' => $request->subrogasipersen,
                    'estimate_amount_subro' => $request->subrogasi,
                    'desc_poten_rec' => $request->potentialrecovery,
                    'kronologi' => $request->kronologi,
                    'staff_recomendation' => $request->staffrecomend,
                    'ass_man_recomen' => $request->assistantmanagerrecomend,
                    'pureor_liability' => $request->pureorliability,
                    'pureor_loss' => $request->pureorloss,
                    'pureor_retro' => $request->pureorcontract,
                    'pureor_recovery' => $request->pureorrecovery,
                    'qs_liability' => $request->qsliability,
                    'qs_loss' => $request->qsloss,
                    'qs_retro' => $request->qscontract,
                    'qs_recovery' => $request->qsrecovery,
                    'arr1_liability' => $request->arr1liability,
                    'arr1_loss' => $request->arr1loss,
                    'arr1_retro' => $request->arr1contract,
                    'arr1_recovery' => $request->arr1recovery,
                    'extra_liability' => $request->extraliability,
                    'extra_loss' => $request->extraloss,
                    'extra_retro' => $request->extracontract,
                    'extra_recovery' => $request->extrarecovery,
                    'facultative_liability' => $request->facultativeliability,
                    'facultative_loss' => $request->facultativeloss,
                    'facultative_retro' => $request->facultativecontract,
                    'facultative_recovery' => $request->facultativerecovery,
                    'arr2_liability' => $request->arr2liability,
                    'arr2_loss' => $request->arr2loss,
                    'arr2_retro' => $request->arr2contract,
                    'arr2_recovery' => $request->arr2recovery,
                    'arr3_liability' => $request->arr3liability,
                    'arr3_loss' => $request->arr3loss,
                    'arr3_retro' => $request->arr3contract,
                    'arr3_recovery' => $request->arr3recovery,
                    'totalrecovery' => $request->totalrecovery,
                    'nrsgrossret' => $request->nrsgrossret,
                    'xol' => $request->xol,
                    'cereffno' => $request->cereffno,
                    'dateofprod' => $request->dateofprod ? date("Y-m-d", strtotime($request->dateofprod)) : null,
                    'ceno' => $request->ceno,
                    'ceuser' => $request->ceuser,
                    'is_delete' => 0,
                    'status_flag' => $request->status_flag ? $request->status_flag : 1,
                    'description' => $request->description,
                    'dateofentry' => date("Y-m-d", strtotime($request->dateentry)),
                    'dateoftrans' => $request->datetrans ? date("Y-m-d", strtotime($request->datetrans)) : null,
                    'dateofsupporting' => $request->datesupporting ? date("Y-m-d", strtotime($request->datesupporting)) : null,
                    'reg_comp_counter' => (int)substr($request->regcomp, -4),
                    'doc_counter' => $request->doc_counter,
                ]);
                $request->dateofentry = date("Y-m-d", strtotime($request->dateofentry));
                $mcef = ClaimDetail::create($request->all());
                return response()->json(['id' => $mcef->id, 'claim' => $mcef, 'regcomp' => $mcef->reg_comp]);
            }
        }
    }

    public function indexMarine(Request $request)
    {
        $user = Auth::user();
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'CLAIM MARINE - Index';

        $mydate = date("Y") . date("m") . date("d");
        $fe_ids = response()->json($country->modelKeys());
        $search = @$request->input('search');
        $searchregcomp = @$request->input('searchregcomp');
        $searchuy = @$request->input('searchuy');
        $searchinsured = @$request->input('searchinsured');
        $searchceding = @$request->input('searchceding');
        $searchdate = @$request->input('searchdate');
        $searchcauseofloss = @$request->input('searchcauseofloss');
        $searchsurveyor = @$request->input('searchsurveyor');
        $searchnatureofloss = @$request->input('searchnatureofloss');

        $costumer = Customer::orderby('id', 'asc')->get();


        if (!empty($search) || !empty($searchcauseofloss) || !empty($searchnatureofloss) || !empty($searchregcomp) || !empty($searchdate) || !empty($searchsurveyor) || !empty($searchuy) || !empty($searchinsured) || !empty($searchceding)) {

            $query = ClaimDetail::query()->with('slip.cedingbroker', 'slip.ceding', 'slip.insureddata')
                ->whereHas('slip.insureddata', function ($q) {
                    $q->where('slip_type', 'mc');
                    $q->orWhere('slip_type', 'mh');
                })
                ->where('is_delete', 0);

            if (!empty($search)) {
                $query = $query->where('number', $search);
            }

            if (!empty($searchcauseofloss)) {
                $query = $query->where('causeofloss_id', $searchcauseofloss);
            }

            if (!empty($searchnatureofloss)) {
                $query = $query->where('natureofloss_id', $searchnatureofloss);
            }

            if (!empty($searchregcomp)) {
                $query = $query->where('reg_comp', 'like', '%' . $searchregcomp . '%');
            }

            if (!empty($searchdate)) {
                $query = $query->where('date_receipt', $searchdate);
            }

            if (!empty($searchsurveyor)) {
                $query = $query->where('surveyor_id', $searchsurveyor);
            }

            if (!empty($searchuy)) {
                $query = $query->whereHas('slip.insureddata', function ($q) use ($searchuy) {
                    $q->where('uy', $searchuy);
                });
            }

            if (!empty($searchinsured)) {
                $query = $query->whereHas('slip.insureddata', function ($q) use ($searchinsured) {
                    $q->where('insured_name', 'like', '%' . $searchinsured . '%');
                });
            }

            if (!empty($searchceding)) {
                $query = $query->where(function ($qr) use ($searchceding) {
                    $qr->whereHas('slip.cedingbroker', function ($q) use ($searchceding) {
                        $q->where('name', 'like', '%' . $searchceding . '%');
                    });
                    $qr->whereHas('slip.ceding', function ($q) use ($searchceding) {
                        $q->where('name', 'like', '%' . $searchceding . '%');
                    });
                });
            }

            // Ordering
            //$query = $query->where('slip_type', '=', 'fe')->orderBy('id', 'DESC');

            //$insured =$query->paginate(10);
            //$insured_ids = response()->json($insured->modelKeys());

            $claimlist = $query->where('is_delete', 0)->orderby('id', 'desc')->paginate(10);
            $claimlist_ids = response()->json($claimlist->modelKeys());


            $cob = COB::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
            $currency = Currency::orderby('id', 'asc')->get();
            $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  02 . '%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();

            $surveyor = Surveyor::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();

            return view('crm.transaction.claim.claim_index', compact('claimlist_ids', 'claimlist', 'costumer', 'causeofloss', 'natureofloss', 'surveyor', 'ocp', 'koc', 'currency', 'searchceding', 'search', 'searchinsured', 'searchuy', 'searchregcomp', 'searchdate', 'searchcauseofloss', 'searchsurveyor', 'searchnatureofloss', 'cob', 'cedingbroker', 'ceding', 'user', 'route_active', 'country'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);

            //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            //$insured = Insured::where('slip_type', '=', 'fe')->orderby('id','desc')->paginate(10);
            //$insured_ids = response()->json($insured->modelKeys());


            $cob = COB::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
            $currency = Currency::orderby('id', 'asc')->get();
            $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  02 . '%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();

            $surveyor = Surveyor::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();

            $claimlist = ClaimDetail::with('slip.cedingbroker', 'slip.ceding', 'slip.insureddata')
                ->whereHas('slip', function ($q) {
                    $q->where('slip_type', 'mc');
                    $q->orWhere('slip_type', 'mh');
                })
                ->has('slip')
                ->where('is_delete', 0)
                ->orderby('id', 'desc')
                ->paginate(10);

            $claimlist_ids = response()->json($claimlist->modelKeys());

            return view('crm.transaction.claim.marine.index', compact('claimlist_ids', 'claimlist', 'costumer', 'causeofloss', 'natureofloss', 'surveyor', 'ocp', 'koc', 'currency', 'searchceding', 'search', 'searchinsured', 'searchuy', 'searchregcomp', 'searchdate', 'searchcauseofloss', 'searchsurveyor', 'searchnatureofloss', 'cob', 'cedingbroker', 'ceding', 'user', 'route_active', 'country'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function update(ClaimDetail $mainClaimEntryFAC)
    {
        $claim = $mainClaimEntryFAC->slip;
        if ($claim->slip_type == 'mc' || $claim->slip_type == 'mh') {
            if ($claim->slip_type == 'mc') {
                $route_active = 'CLAIM MARINE CARGO - update';
                $type = 'cargo';
                $claiminsureds = ClaimInsuredData::has('ship')->with('ship', 'interestceding', 'interest')->where('main_claim_id', $mainClaimEntryFAC->id)->get()->groupBy('ship.ship_name');
            } else {
                $route_active = 'CLAIM MARINE HULL - update';
                $type = 'hull';
                $claiminsureds = '';
            }

            $idclaim = $mainClaimEntryFAC->id;
            $claimdata = $mainClaimEntryFAC->load(
                'claiminsureddata.interestceding',
                'claiminsureddata.ship',
                'slip.insureddata',
                'slip.kindcontract',
                'slip.corebusiness',
                'slip.cedingbroker',
                'slip.ceding',
                'slip.insureddata.currency'
            );
            $currency = Currency::orderby('id', 'asc')->get();
            $cob = COB::where('form', 'mc')->orWhere('form', 'mh')->orderby('id', 'asc')->get();
            $koc = Koc::where('code', 'like', '02%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
            $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
            $status_flag = $claimdata->status_flag;
            $lossdesc = LossDescription::orderby('id', 'asc')->get();
            $cedings = CedingBroker::orderby('id', 'asc')->get();
            $insureds = InterestInsured::orderby('id', 'asc')->get();
            $surveyors = Surveyor::orderby('id', 'asc')->where('type_flag', 1)->get();
            $adjusters = Surveyor::orderby('id', 'asc')->where('type_flag', 2)->get();
            $placlaim = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('status_flag', 1)->orderby('id', 'DESC')->first();
            $desclosses = ClaimLossDescription::with('descLoss')->where('reg_comp', $claimdata->reg_comp)
                ->where('doc_counter', $placlaim->doc_counter)->get();

            $claims = ClaimDetail::where('reg_comp', $placlaim->reg_comp)->where('doc_counter', '>', $placlaim->doc_counter)->get();
            if ($claims) {
                $placlaimloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                    ->where('doc_counter', $placlaim->doc_counter)
                    ->where('is_correction', 0)
                    ->sum('amount');
                $lossamountlimit = 0;
                if ($claimdata->doc_counter != 1 && $claims) {
                    $lossamountlimit = $placlaimloss;
                    foreach ($claims as $cl) {
                        $clloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                            ->where('doc_counter', $cl->doc_counter)
                            ->where('is_correction', 0);
                        if ($clloss->get()) {
                            $clloss->sum('amount');
                            $lossamountlimit -= $clloss->sum('amount');
                        }
                    }
                }
            }

            return view('crm.transaction.claim.marine.entry', compact(
                'claiminsureds',
                'type',
                'desclosses',
                'surveyors',
                'adjusters',
                'placlaimloss',
                'insureds',
                'cedings',
                'lossamountlimit',
                'lossdesc',
                'idclaim',
                'claimdata',
                'prefixinsured',
                'causeofloss',
                'natureofloss',
                'ceding',
                'cedingbroker',
                'currency',
                'cob',
                'koc',
                'ocp',
                'route_active',
                'status_flag'
            ));
        }
        return abort(404);
    }
}
