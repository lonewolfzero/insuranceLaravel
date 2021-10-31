<?php

namespace App\Http\Controllers\Facultative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Customer\Customer;
use App\Models\FeLookupLocation;
use App\Models\SlipTable;
use App\Models\SlipTableFile;
use App\Models\SlipTableFileTemp;
use App\Models\TransLocation;
use App\Models\Currency;
use App\Models\COB;
use App\Models\Occupation;
use App\Models\Koc;
use App\Models\CedingBroker;
use App\Models\ConditionNeeded;
use App\Models\ShipListTemp;
use App\Policies\FelookupLocationPolicy;
use App\Models\TransLocationTemp;
use App\Models\EarthQuakeZone;
use App\Models\FloodZone;
use App\Models\Insured;
use App\Models\InterestInsured;
use App\Models\InstallmentTemp;
use App\Models\InterestInsuredTemp;
use Illuminate\Support\Facades\Auth;
use App\Models\DeductibleType;
use App\Models\ExtendedCoverage;
use App\Models\ExtendCoverageTemp;
use App\Models\DeductibleTemp;
use App\Models\StatusLog;
use App\Models\RetrocessionTemp;
use App\Models\RiskLocationDetail;
use App\Models\CurrencyExchange;
use App\Models\InsuredNumber;
use App\Models\SlipNumber;
use App\Models\PrefixInsured;

class FacultativeSlipController extends Controller
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
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);


        if ($validator) {
            $user = Auth::user();


            $checkslipnumber = SlipNumber::where('number', $request->slipnumber)->where('insured_number', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'active')->first();


            if ($checkslipnumber == null) {
                $slipdata = SlipTable::where('number', '=', $request->slipnumber)->where('insured_id','=',$request->code_ms)->where('slip_type','=',$request->sliptypeform)->where('slipshow','=','yes')->where('selisih','=','false')->first();

                $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();


                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $request->slipnumber,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => $request->sliptypeform,
                        'prod_year' => $currdate,
                        // 'date_transfer'=> date("Y-m-d", strtotime($request->slipdatetransfer)),
                        'status' => $request->slipstatus,
                        'endorsment' => 0,
                        'selisih' => 'false',
                        'source' => $request->slipcedingbroker,
                        'source_2' => $request->slipceding,
                        // 'currency'=>$request->slipcurrency,
                        'cob' => $request->slipcob,
                        'koc' => $request->slipkoc,
                        'occupacy' => $request->slipoccupacy,
                        'build_const' => $request->slipbld_const,
                        'slip_no' => $request->slipno,
                        'cn_dn' => $request->slipcndn,
                        'policy_no' => $request->slippolicy_no,
                        //'attacment_file'=>json_encode($attachmentlist),
                        'attacment_file' => '',
                        'interest_insured' => $interestlist->toJSon(),
                        'total_sum_insured' => $request->sliptotalsum,
                        'share_tsi' => $request->slipsharetotalsum,
                        'type_tsi' => $request->sliptypetotalsum,
                        'type_share_tsi' => $request->sliptypetsishare,
                        'total_day' => $request->sliptotalday,
                        'total_year' => $request->sliptotalyear,
                        'sum_total_date' => $request->slipdatesum,
                        'insured_type' => $request->sliptype,
                        'insured_pct' => $request->slippct,
                        'total_sum_pct' => $request->sliptotalsumpct,
                        'deductible_panel' => $deductiblelist->toJson(),
                        'extend_coverage' => $extendcoveragelist->toJson(),
                        'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                        'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                        'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                        'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
                        'proportional' => $request->slipproportional,
                        'layer_non_proportional' => $request->sliplayerproportional,
                        'rate' => $request->sliprate,
                        'sliptotalrate' => $request->sliptotalrate,
                        'v_broker' => $request->slipvbroker,
                        'sum_feebroker' => $request->slipsumvbroker,
                        'share' => $request->slipshare,
                        'sum_share' => $request->slipsumshare,
                        'basic_premium' => $request->slipbasicpremium,
                        'commission' => $request->slipcommission,
                        'grossprm_to_nr' => $request->slipgrossprmtonr,
                        'netprm_to_nr' => $request->slipnetprmtonr,
                        'sum_commission' => $request->slipsumcommission,
                        'installment_panel' => $installmentlist->toJson(),
                        'retrocession_panel' => $retrocessionlist->toJson(),
                        'retro_backup' => $request->sliprb,
                        'own_retention' => $request->slipor,
                        'sum_own_retention' => $request->slipsumor,
                        'wpc' => $request->wpc,
                        'remarks' => $request->remarks,
                        'slipshow' => "yes"

                    ]);

                    $notification = array(
                        'message' => 'Fire & Engginering Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => $request->sliptypeform,
                        'count_endorsement' => $slipdataup->endorsment
                    ]);




                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type',$request->sliptypeform)->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();
                    // $old_sumshare = $request->slipoldsumshare;
                    $old_nasre_share = null;
                    if($insdata->share_from == "0" ){
                        $old_nasre_share = 0.0;
                    }else{
                        $old_nasre_share = (float)$insdata->share_from;
                    }
                    
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $new_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', $request->sliptypeform)->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', $request->sliptypeform)->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "FE" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "FE" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "FE" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "FE" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "FE" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "FE" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => $request->sliptypeform,
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($retrocessionpanup as $rpup) {
                        $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                        $retropanprocessup->status = 'active';
                        $retropanprocessup->save();
                    }

                    return response()->json(
                        [
                            'id' => $slipdataup->id,
                            'number' => $request->slipnumber,
                            'slipnumber' => $code_sl,
                            'slipstatus' => $slipdataup->status,
                            'insuredid' => $slipdataup->insured_id,
                            'date_transfer' => $slipdataup->date_transfer,
                            'ceding' => $slipdataup->ceding->name,
                            'cedingbroker' => $slipdataup->cedingbroker->name,
                            'count_endorsement' => $slipdataup->endorsment
                        ]
                    );
                } else {

                    $currdate = date("Y-m-d");

                    $slipdataid = $slipdata->number;
                    $slipdataup = SlipTable::where('number', $slipdataid)->orderby('created_at', 'desc')->first();

                    if ($slipdataup->status != $request->slipstatus) {
                        StatusLog::create([
                            'status' => $request->slipstatus,
                            'user' => Auth::user()->name,
                            'datetime' => date('Y-m-d H:i:s '),
                            'insured_id' => $request->code_ms,
                            'slip_id' => $request->slipnumber,
                            'slip_type' => $request->sliptypeform,
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $request->slipnumber;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = $request->sliptypeform;
                    $slipdataup->prod_year = $currdate;
                    // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
                    $slipdataup->status = $request->slipstatus;
                    $slipdataup->endorsment = 0;
                    $slipdataup->selisih = "false";
                    $slipdataup->source = $request->slipcedingbroker;
                    $slipdataup->source_2 = $request->slipceding;
                    // $slipdataup->currency=$request->slipcurrency;
                    $slipdataup->cob = $request->slipcob;
                    $slipdataup->koc = $request->slipkoc;
                    $slipdataup->occupacy = $request->slipoccupacy;
                    $slipdataup->build_const = $request->slipbld_const;
                    $slipdataup->slip_no = $request->slipno;
                    $slipdataup->cn_dn = $request->slipcndn;
                    $slipdataup->policy_no = $request->slippolicy_no;
                    $slipdataup->attacment_file = '';
                    $slipdataup->interest_insured = $interestlist->toJSon();
                    $slipdataup->total_sum_insured = $request->sliptotalsum;
                    $slipdataup->share_tsi = $request->slipsharetotalsum;
                    $slipdataup->type_tsi = $request->sliptypetotalsum;
                    $slipdataup->type_share_tsi = $request->sliptypetsishare;
                    $slipdataup->total_day = $request->sliptotalday;
                    $slipdataup->total_year = $request->sliptotalyear;
                    $slipdataup->sum_total_date = $request->slipdatesum;
                    $slipdataup->insured_type = $request->sliptype;
                    $slipdataup->insured_pct = $request->slippct;
                    $slipdataup->total_sum_pct = $request->sliptotalsumpct;
                    $slipdataup->deductible_panel = $deductiblelist->toJson();
                    $slipdataup->extend_coverage = $extendcoveragelist->toJson();
                    $slipdataup->insurance_period_from = date("Y-m-d", strtotime($request->slipipfrom));
                    $slipdataup->insurance_period_to = date("Y-m-d", strtotime($request->slipipto));
                    $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($request->sliprpfrom));
                    $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($request->sliprpto));
                    $slipdataup->proportional = $request->slipproportional;
                    $slipdataup->layer_non_proportional = $request->sliplayerproportional;
                    $slipdataup->rate = $request->sliprate;
                    $slipdataup->sliptotalrate = $request->sliptotalrate;
                    $slipdataup->v_broker = $request->slipvbroker;
                    $slipdataup->sum_feebroker = $request->slipsumvbroker;
                    $slipdataup->share = $request->slipshare;
                    $slipdataup->sum_share = $request->slipsumshare;
                    $slipdataup->basic_premium = $request->slipbasicpremium;
                    $slipdataup->commission = $request->slipcommission;
                    $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
                    $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
                    $slipdataup->sum_commission = $request->slipsumcommission;
                    $slipdataup->installment_panel = $installmentlist->toJson();
                    $slipdataup->retrocession_panel = $retrocessionlist->toJson();
                    $slipdataup->retro_backup = $request->sliprb;
                    $slipdataup->own_retention = $request->slipor;
                    $slipdataup->sum_own_retention = $request->slipsumor;
                    $slipdataup->wpc = $request->wpc;
                    $slipdataup->remarks = $request->remarks;
                    $slipdataup->slipshow = "yes";
                    $slipdataup->warning_flag = "0";

                    $slipdataup->save();


                    $notification = array(
                        'message' => 'Fire & Engginering Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type',$request->sliptypeform)->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', $request->sliptypeform)->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', $request->sliptypeform)->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "FE" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "FE" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "FE" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "FE" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "FE" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "FE" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => $request->sliptypeform,
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($retrocessionpanup as $rpup) {
                        $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                        $retropanprocessup->status = 'active';
                        $retropanprocessup->save();
                    }

                    return response()->json(
                        [
                            'id' => $slipdataup->id,
                            'number' => $request->slipnumber,
                            'slipnumber' => $code_sl,
                            'slipstatus' => $slipdataup->status,
                            'date_transfer' => $slipdataup->date_transfer,
                            'ceding' => $slipdataup->ceding->name,
                            'cedingbroker' => $slipdataup->cedingbroker->name,
                            'count_endorsement' => $slipdataup->endorsment
                        ]
                    );
                }
            } else {
                $newnumber2 = substr($request->slipnumber, 10, 15);
                $codenumber = substr($request->slipnumber, 0, 10);

                if (intval($newnumber2) < 9) {
                    $count = substr($newnumber2, 14);
                    $code_sl2 = $codenumber . "0000" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 8 && intval($newnumber2) < 99) {
                    $count = substr($newnumber2, 13);
                    $code_sl2 = $codenumber . "000" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 98 && intval($newnumber2) < 999) {
                    $count = substr($newnumber2, 12);
                    $code_sl2 = $codenumber . "00" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 998 && intval($newnumber2) < 9999) {
                    $count = substr($newnumber2, 11);
                    $code_sl2 = $codenumber . "0" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 9998 && intval($newnumber2) < 99999) {
                    $count = substr($newnumber2, 10);
                    $code_sl2 = $codenumber  . strval(intval($count) + 1);
                }


                $reservedslipnumber = SlipNumber::create([
                    'number' => $code_sl2,
                    'slip_type' => $request->sliptypeform,
                    'status' => 'active',
                    'insured_number' => $request->code_ms
                ]);

                $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($deductibleup as $ddup) {
                    $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                    $deductibleprocessup->slip_id = $code_sl2;
                    $deductibleprocessup->save();
                }

                $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($extendcoverageup as $ecup) {
                    $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                    $extendcoverageprocessup->slip_id = $code_sl2;
                    $extendcoverageprocessup->save();
                }

                $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($installmentpansup as $ipup) {
                    $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                    $inspanprocessup->slip_id = $code_sl2;
                    $inspanprocessup->save();
                }

                $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($retrocessionpanup as $rpup) {
                    $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                    $retropanprocessup->slip_id = $code_sl2;
                    $retropanprocessup->save();
                }


                $slipdata = SlipTable::where('number', '=', $code_sl2)->where('insured_id','=',$request->code_ms)->where('slip_type','=',$request->sliptypeform)->where('slipshow','=','yes')->where('selisih','=','false')->first();

                $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();

                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $code_sl2,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => $request->sliptypeform,
                        'prod_year' => $currdate,
                        // 'date_transfer'=> date("Y-m-d", strtotime($request->slipdatetransfer)),
                        'status' => $request->slipstatus,
                        'endorsment' => 0,
                        'selisih' => 'false',
                        'source' => $request->slipcedingbroker,
                        'source_2' => $request->slipceding,
                        // 'currency'=>$request->slipcurrency,
                        'cob' => $request->slipcob,
                        'koc' => $request->slipkoc,
                        'occupacy' => $request->slipoccupacy,
                        'build_const' => $request->slipbld_const,
                        'slip_no' => $request->slipno,
                        'cn_dn' => $request->slipcndn,
                        'policy_no' => $request->slippolicy_no,
                        //'attacment_file'=>json_encode($attachmentlist),
                        'attacment_file' => '',
                        'interest_insured' => $interestlist->toJSon(),
                        'total_sum_insured' => $request->sliptotalsum,
                        'share_tsi' => $request->slipsharetotalsum,
                        'type_tsi' => $request->sliptypetotalsum,
                        'type_share_tsi' => $request->sliptypetsishare,
                        'total_day' => $request->sliptotalday,
                        'total_year' => $request->sliptotalyear,
                        'sum_total_date' => $request->slipdatesum,
                        'insured_type' => $request->sliptype,
                        'insured_pct' => $request->slippct,
                        'total_sum_pct' => $request->sliptotalsumpct,
                        'deductible_panel' => $deductiblelist->toJson(),
                        'extend_coverage' => $extendcoveragelist->toJson(),
                        'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                        'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                        'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                        'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
                        'proportional' => $request->slipproportional,
                        'layer_non_proportional' => $request->sliplayerproportional,
                        'rate' => $request->sliprate,
                        'sliptotalrate' => $request->sliptotalrate,
                        'v_broker' => $request->slipvbroker,
                        'sum_feebroker' => $request->slipsumvbroker,
                        'share' => $request->slipshare,
                        'sum_share' => $request->slipsumshare,
                        'basic_premium' => $request->slipbasicpremium,
                        'commission' => $request->slipcommission,
                        'grossprm_to_nr' => $request->slipgrossprmtonr,
                        'netprm_to_nr' => $request->slipnetprmtonr,
                        'sum_commission' => $request->slipsumcommission,
                        'installment_panel' => $installmentlist->toJson(),
                        'retrocession_panel' => $retrocessionlist->toJson(),
                        'retro_backup' => $request->sliprb,
                        'own_retention' => $request->slipor,
                        'sum_own_retention' => $request->slipsumor,
                        'wpc' => $request->wpc,
                        'remarks' => $request->remarks,
                        'slipshow' => "yes"

                    ]);

                    $notification = array(
                        'message' => 'Fire & Engginering Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => $request->sliptypeform,
                        'count_endorsement' => $slipdataup->endorsment
                    ]);




                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type',$request->sliptypeform)->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $new_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', $request->sliptypeform)->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', $request->sliptypeform)->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "FE" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "FE" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "FE" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "FE" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "FE" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "FE" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => $request->sliptypeform,
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($retrocessionpanup as $rpup) {
                        $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                        $retropanprocessup->status = 'active';
                        $retropanprocessup->save();
                    }

                    return response()->json(
                        [
                            'id' => $slipdataup->id,
                            'number' => $request->slipnumber,
                            'slipnumber' => $code_sl,
                            'slipstatus' => $slipdataup->status,
                            'ceding' => $slipdataup->ceding->name,
                            'date_transfer' => $slipdataup->date_transfer,
                            'cedingbroker' => $slipdataup->cedingbroker->name,
                            'count_endorsement' => $slipdataup->endorsment
                        ]
                    );
                } else {

                    $currdate = date("Y-m-d");

                    $slipdataid = $slipdata->number;
                    $slipdataup = SlipTable::where('number', $slipdataid)->orderby('created_at', 'desc')->first();

                    if ($slipdataup->status != $request->slipstatus) {
                        StatusLog::create([
                            'status' => $request->slipstatus,
                            'user' => Auth::user()->name,
                            'datetime' => date('Y-m-d H:i:s '),
                            'insured_id' => $request->code_ms,
                            'slip_id' => $request->slipnumber,
                            'slip_type' => $request->sliptypeform,
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $code_sl2;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = $request->sliptypeform;
                    $slipdataup->prod_year = $currdate;
                    // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
                    $slipdataup->status = $request->slipstatus;
                    $slipdataup->endorsment = 0;
                    $slipdataup->selisih = "false";
                    $slipdataup->source = $request->slipcedingbroker;
                    $slipdataup->source_2 = $request->slipceding;
                    // $slipdataup->currency=$request->slipcurrency;
                    $slipdataup->cob = $request->slipcob;
                    $slipdataup->koc = $request->slipkoc;
                    $slipdataup->occupacy = $request->slipoccupacy;
                    $slipdataup->build_const = $request->slipbld_const;
                    $slipdataup->slip_no = $request->slipno;
                    $slipdataup->cn_dn = $request->slipcndn;
                    $slipdataup->policy_no = $request->slippolicy_no;
                    $slipdataup->attacment_file = '';
                    $slipdataup->interest_insured = $interestlist->toJSon();
                    $slipdataup->total_sum_insured = $request->sliptotalsum;
                    $slipdataup->share_tsi = $request->slipsharetotalsum;
                    $slipdataup->type_tsi = $request->sliptypetotalsum;
                    $slipdataup->type_share_tsi = $request->sliptypetsishare;
                    $slipdataup->total_day = $request->sliptotalday;
                    $slipdataup->total_year = $request->sliptotalyear;
                    $slipdataup->sum_total_date = $request->slipdatesum;
                    $slipdataup->insured_type = $request->sliptype;
                    $slipdataup->insured_pct = $request->slippct;
                    $slipdataup->total_sum_pct = $request->sliptotalsumpct;
                    $slipdataup->deductible_panel = $deductiblelist->toJson();
                    $slipdataup->extend_coverage = $extendcoveragelist->toJson();
                    $slipdataup->insurance_period_from = date("Y-m-d", strtotime($request->slipipfrom));
                    $slipdataup->insurance_period_to = date("Y-m-d", strtotime($request->slipipto));
                    $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($request->sliprpfrom));
                    $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($request->sliprpto));
                    $slipdataup->proportional = $request->slipproportional;
                    $slipdataup->layer_non_proportional = $request->sliplayerproportional;
                    $slipdataup->rate = $request->sliprate;
                    $slipdataup->sliptotalrate = $request->sliptotalrate;
                    $slipdataup->v_broker = $request->slipvbroker;
                    $slipdataup->sum_feebroker = $request->slipsumvbroker;
                    $slipdataup->share = $request->slipshare;
                    $slipdataup->sum_share = $request->slipsumshare;
                    $slipdataup->basic_premium = $request->slipbasicpremium;
                    $slipdataup->commission = $request->slipcommission;
                    $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
                    $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
                    $slipdataup->sum_commission = $request->slipsumcommission;
                    $slipdataup->installment_panel = $installmentlist->toJson();
                    $slipdataup->retrocession_panel = $retrocessionlist->toJson();
                    $slipdataup->retro_backup = $request->sliprb;
                    $slipdataup->own_retention = $request->slipor;
                    $slipdataup->sum_own_retention = $request->slipsumor;
                    $slipdataup->wpc = $request->wpc;
                    $slipdataup->remarks = $request->remarks;
                    $slipdataup->slipshow = "yes";
                    $slipdataup->warning_flag = "0";

                    $slipdataup->save();


                    $notification = array(
                        'message' => 'Fire & Engginering Slip Update successfully!',
                        'code' => $code_sl2,
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type',$request->sliptypeform)->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', $request->sliptypeform)->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', $request->sliptypeform)->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "FE" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "FE" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "FE" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "FE" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "FE" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "FE" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => $request->sliptypeform,
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($retrocessionpanup as $rpup) {
                        $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                        $retropanprocessup->status = 'active';
                        $retropanprocessup->save();
                    }

                    return response()->json(
                        [
                            'id' => $slipdataup->id,
                            'number' => $request->slipnumber,
                            'slipnumber' => $code_sl,
                            'slipstatus' => $slipdataup->status,
                            'ceding' => $slipdataup->ceding->name,
                            'date_transfer' => $slipdataup->date_transfer,
                            'cedingbroker' => $slipdataup->cedingbroker->name,
                            'count_endorsement' => $slipdataup->endorsment
                        ]
                    );
                }
            }
        } else {


            $notification = array(
                'message' => 'Fire & Engginering Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type,$id)
    {
        $user = Auth::user();
        $slipdata = SlipTable::findOrFail($id);
        // if($slipdata == null){
            // $slipdata = SlipTable::where('id', $id)->where('slip_type',$type)->first();
            // $slipdata = SlipTable::where('number', $id)->where('insured_id',$insured_id)->where('slip_type',$type)->first();
        // }
        // dd($slipdata);


        if (!empty($slipdata->deductible_panel) && strlen($slipdata->deductible_panel) > 10) {
            $deductibledata = DeductibleTemp::where('slip_id',$slipdata->number)
            ->where('count_endorsement',$slipdata->endorsment)
            ->where('slip_type',$type)
            ->where('insured_id',$slipdata->insured_id)
            ->where('deleted_at',null)
            ->where('minus','false')
            ->get();

        } else {
            $deductibledata = null;
        }

        $newarraydeduct = [];
        // dd($deductibledata);
        if (!empty($deductibledata)) {
            foreach ($deductibledata as $mydata) {
                $deductdatadesc = DeductibleType::where('id', '=', $mydata->deductibletype_id)->first();
                if ($deductdatadesc) {
                    $mydata->deductibletype = $deductdatadesc->description;
                }


                $currencydesc = Currency::where('id', '=', $mydata->currency_id)->first();
                if ($currencydesc) {
                    $mydata->currencydata = $currencydesc->symbol_name;
                }
                array_push($newarraydeduct, $mydata);
            }
        }
        $newdeductdata = json_encode($newarraydeduct);



        if (!empty($slipdata->extend_coverage) && strlen($slipdata->extend_coverage) >= 10) {
            $extendcoverdata = json_decode($slipdata->extend_coverage);
        } else {
            $extendcoverdata = null;
        }
        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarrayextend = [];

        if (!empty($extendcoverdata)) {
            foreach ($extendcoverdata as $mydata) {
                $extenddesc = ExtendedCoverage::where('id', '=', $mydata->extendcoverage_id)->first();
                if ($extenddesc) {
                    $mydata->coveragetype = $extenddesc->description;
                    $mydata->coveragename = $extenddesc->name;
                    $mydata->coveragecode = $extenddesc->code;
                }

                array_push($newarrayextend, $mydata);
            }
        }
        $newextenddata = json_encode($newarrayextend);


        if (!empty($slipdata->installment_panel) && strlen($slipdata->installment_panel) >= 10) {
            $installmentpdata = json_decode($slipdata->installment_panel);
        } else {
            $installmentpdata = null;
        }
        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarrayinspan = [];

        if (!empty($installmentpdata)) {
            foreach ($installmentpdata as $ipdata) {
                // $ipddesc= ExtendedCoverage::where('id','=',$ipdata->extendcoverage_id)->first();
                // if($ipddesc){
                //     $ipdata->coveragetype=$ipddesc->description;
                // }

                array_push($newarrayinspan, $ipdata);
            }
        }
        $newarrayinspandata = json_encode($newarrayinspan);

        // if($slipdata->prod_year == null){
        //     $prodyeardata = strtotime(date("Y-m-d"));
        //     $dateyeardata= date("d/m/Y", $prodyeardata);
        // }else{
        //     $prodyeardata = strtotime($slipdata->prod_year);
        //     $dateyeardata= date("d/m/Y", $prodyeardata);
        // }
        if($slipdata->prod_year){
            $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));
        }else{
            $dateyeardata =  date("d/m/Y");
        }
        

        // $currdate = date("d/m/Y");



        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type',$request->sliptypeform)->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', $type)->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();


        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type',$type)->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        $sum_permilec = DB::table('extended_coverage_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', $type)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('minus','false')
            ->where('deleted_at', null)
            ->sum('extended_coverage_detail.percentage');

        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', $type)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('minus','false')
            ->where('deleted_at', null)
            ->sum('installment_panel_detail.percentage');


        if ($slipdata->build_const == "Building 1") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_1;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_1;
        } elseif ($slipdata->build_const == "Building 2") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_2;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_2;
        } elseif ($slipdata->build_const == "Building 3") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_3;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_3;
        }

        if ($slipdata->date_transfer == null) {
            $datetransfer = "";
        } else {
            $datetransfer = date("d/m/Y", strtotime($slipdata->date_transfer));
        }



        return response()->json(
            [
                'id' => $slipdata->id,
                'insured_id' => $slipdata->insured_id,
                'slip_type' => $slipdata->slip_type,
                'username' => $slipdata->username,
                'prod_year' => $dateyeardata,
                'number' => $slipdata->number,
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
                'build_rate_up' => @$building_rate_up,
                'build_rate_down' => @$building_rate_down,
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
                'sum_v_broker' => $slipdata->sum_feebroker,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function endorsement($type,$id)
    {
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $id)->first();

        $countendorsement = $slipdata->endorsment;

        if ($slipdata->endorsment == NULL || $slipdata->endorsment == "") {
            $code_sl = $slipdata->number . '000' . '1';
        } else {
            if ($countendorsement < 9) {
                $code_sl = substr($slipdata->number, 0, 15) . '000' . ($countendorsement + 1);
            } elseif ($countendorsement > 8 && $countendorsement < 99) {
                $code_sl = substr($slipdata->number, 0, 15) .  '00' . ($countendorsement + 1);
            } elseif ($countendorsement > 98 && $countendorsement < 999) {
                $code_sl = substr($slipdata->number, 0, 15) . '0' . ($countendorsement + 1);
            } elseif ($countendorsement > 998 && $countendorsement < 9999) {
                $code_sl = substr($slipdata->number, 0, 15) . ($countendorsement + 1);
            }
        }


        // $interestdata=json_decode($slipdata->interest_insured);   
        // $newarray=[];

        // if(!empty($interestdata))
        // {
        //     foreach($interestdata as $mydata)
        //     {
        //         $interestdatadesc= InterestInsured::where('id','=',$mydata->interest_id)->first();
        //         $mydata->description=$interestdatadesc->description;     

        //         array_push($newarray,$mydata);
        //     }  
        // }     

        // $newinterestdata=json_encode($newarray);

        if (!empty($slipdata->deductible_panel) && strlen($slipdata->deductible_panel) >= 10) {
            $deductibledata = json_decode($slipdata->deductible_panel);
        } else {
            $deductibledata = null;
        }

        $newarraydeduct = [];
        if (!empty($deductibledata)) {
            foreach ($deductibledata as $mydata) {
                $deductdatadesc = DeductibleType::where('id', '=', $mydata->deductibletype_id)->first();
                $mydata->deductibletype = $deductdatadesc->description;

                $currencydesc = Currency::where('id', '=', $mydata->currency_id)->first();
                $mydata->currencydata = @$currencydesc->symbol_name;

                array_push($newarraydeduct, $mydata);
            }
        }

        $newdeductdata = json_encode($newarraydeduct);

        if (!empty($slipdata->extend_coverage) && strlen($slipdata->extend_coverage) >= 10) {
            $extendcoverdata = json_decode($slipdata->extend_coverage);
        } else {
            $extendcoverdata = null;
        }

        $newarrayextend = [];
        if (!empty($extendcoverdata)) {
            foreach ($extendcoverdata as $mydata) {
                $extenddesc = ExtendedCoverage::where('id', '=', $mydata->extendcoverage_id)->first();
                $mydata->coveragetype = $extenddesc->description;
                $mydata->coveragename = $extenddesc->name;
                $mydata->coveragecode = $extenddesc->code;

                array_push($newarrayextend, $mydata);
            }
        }
        $newextenddata = json_encode($newarrayextend);


        $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));

        // $currdate = date("d/m/Y");


        if (!empty($slipdata->installment_panel) && strlen($slipdata->installment_panel) >= 10) {
            $installmentpdata = json_decode($slipdata->installment_panel);
        } else {
            $installmentpdata = null;
        }
        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarrayinspan = [];

        if (!empty($installmentpdata)) {
            foreach ($installmentpdata as $ipdata) {
                // $ipddesc= ExtendedCoverage::where('id','=',$ipdata->extendcoverage_id)->first();
                // if($ipddesc){
                //     $ipdata->coveragetype=$ipddesc->description;
                // }

                array_push($newarrayinspan, $ipdata);
            }
        }
        $newarrayinspandata = json_encode($newarrayinspan);


        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type',$request->sliptypeform)->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type',$type)->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();

        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', $type)->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        $sum_permilec = DB::table('extended_coverage_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', $type)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('extended_coverage_detail.percentage');

        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', $type)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('installment_panel_detail.percentage');



        if ($slipdata->build_const == "Building 1") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_1;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_1;
        } elseif ($slipdata->build_const == "Building 2") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_2;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_2;
        } elseif ($slipdata->build_const == "Building 3") {
            $building_rate = Occupation::where('id', $slipdata->occupacy)->first();
            $building_rate_up = $building_rate->rate_batas_atas_building_class_3;
            $building_rate_down = $building_rate->rate_batas_bawah_building_class_3;
        }




        return response()->json(
            [
                'id' => $slipdata->id,
                'code_slreal' => $slipdata->number,
                'code_sl' => $code_sl,
                'insured_id' => $slipdata->insured_id,
                'slip_type' => $slipdata->slip_type,
                'username' => $slipdata->username,
                'prod_year' => $dateyeardata,
                'number' => $slipdata->number,
                'slipuy' => $slipdata->uy,
                'date_transfer' => date("d/m/Y", strtotime($slipdata->date_transfer)),
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
                'installment_panel' => $newarrayinspandata,
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
                'coinsurance_slip' => $slipdata->coinsurance_slip,
                'status_log' => $statuslist,
                'sum_feebroker' => $slipdata->sum_feebroker,
                'sum_ec' => $sum_permilec,
                'sum_ippercent' => $sum_inspanpercent
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);

        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('number', '=', $request->slipnumber)->where('insured_id',$request->code_ms)->where('slip_type',$request->sliptypeform)->where('endorsment',$request->countendorsement)->first();

            $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', $request->sliptypeform)->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();


            $currdate = date("Y-m-d");

            $slipipfromdate = str_replace('/', '-', $request->slipipfrom);
            $slipiptodate = str_replace('/', '-', $request->slipipto);
            $sliprpfromdate = str_replace('/', '-', $request->sliprpfrom);
            $sliprptodate = str_replace('/', '-', $request->sliprpto);

            $slipdataid = $slipdata->number;
            $slipdatalatest = SlipTable::where('number', $slipdataid)->where('insured_id', $request->code_ms)->orderby('created_at', 'desc')->first();
            $slipdataup = SlipTable::where('number', $slipdataid)->where('endorsment', $request->countendorsement)->orderby('created_at', 'desc')->first();

            // if($slipdataup->status != $request->slipstatus){
            //     StatusLog::create([
            //         'status'=>$request->slipstatus,
            //         'user'=>Auth::user()->name,
            //         'datetime'=>date('Y-m-d H:i:s '),
            //         'insured_id'=>$request->code_ms,
            //         'slip_id'=>$request->slipnumber,
            //         'slip_type'=>$request->sliptypeform,
            //         'count_endorsement'=> $slipdatalatest->endorsment
            //     ]);
            // }

            $slipdataup->number = $request->slipnumber;
            $slipdataup->username = Auth::user()->name;
            $slipdataup->insured_id = $request->code_ms;
            $slipdataup->slip_type = $request->sliptypeform;
            $slipdataup->prod_year = $currdate;
            // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
            $slipdataup->status = $request->slipstatus;
            $slipdataup->endorsment = $slipdatalatest->endorsment;
            $slipdataup->selisih = "false";
            $slipdataup->source = $request->slipcedingbroker;
            $slipdataup->source_2 = $request->slipceding;
            $slipdataup->cob = $request->slipcob;
            $slipdataup->koc = $request->slipkoc;
            $slipdataup->occupacy = $request->slipoccupacy;
            $slipdataup->build_const = $request->slipbld_const;
            $slipdataup->slip_no = $request->slipno;
            $slipdataup->cn_dn = $request->slipcndn;
            $slipdataup->policy_no = $request->slippolicy_no;
            $slipdataup->attacment_file = '';
            $slipdataup->interest_insured = $interestlist->toJSon();
            $slipdataup->total_sum_insured = $request->sliptotalsum;
            $slipdataup->share_tsi = $request->sharetotalsum;
            $slipdataup->type_tsi = $request->sliptypetsi;
            $slipdataup->type_share_tsi = $request->sharetypetsi;
            $slipdataup->total_day = $request->sliptotalday;
            $slipdataup->total_year = $request->sliptotalyear;
            $slipdataup->sum_total_date = $request->slipdatesum;
            $slipdataup->insured_type = $request->sliptype;
            $slipdataup->insured_pct = $request->slippct;
            $slipdataup->total_sum_pct = $request->sliptotalsumpct;
            $slipdataup->deductible_panel = $deductiblelist->toJson();
            $slipdataup->extend_coverage = $extendcoveragelist->toJson();
            $slipdataup->insurance_period_from = date("Y-m-d", strtotime($slipipfromdate));
            $slipdataup->insurance_period_to = date("Y-m-d", strtotime($slipiptodate));
            $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($sliprpfromdate));
            $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($sliprptodate));
            $slipdataup->proportional = $request->slipproportional;
            $slipdataup->layer_non_proportional = $request->sliplayerproportional;
            $slipdataup->rate = $request->sliprate;
            $slipdataup->sliptotalrate = $request->slipsumrate;
            $slipdataup->v_broker = $request->slipvbroker;
            $slipdataup->sum_feebroker = $request->slipsumvbroker;
            $slipdataup->share = $request->slipshare;
            $slipdataup->sum_share = $request->slipsumshare;
            $slipdataup->basic_premium = $request->slipbasicpremium;
            $slipdataup->commission = $request->slipcommission;
            $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
            $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
            $slipdataup->sum_commission = $request->slipsumcommission;
            $slipdataup->installment_panel = $installmentlist->toJson();
            $slipdataup->retrocession_panel = $retrocessionlist->toJson();
            $slipdataup->retro_backup = $request->sliprb;
            $slipdataup->own_retention = $request->slipor;
            $slipdataup->sum_own_retention = $request->slipsumor;
            $slipdataup->wpc = $request->wpc;
            $slipdataup->remarks = $request->remarks;
            $slipdataup->slipshow = "yes";

            $slipdataup->save();


            $notification = array(
                'message' => 'Fire & Engginering Slip Update successfully!',
                'alert-type' => 'success'
            );

            //$insdata = Insured::where('number',$request->code_ms)->where('slip_type',$request->sliptypeform)->first();
            $insdata = Insured::where('number', $request->code_ms)->first();

            $old_nasre_share = $insdata->share_from;
            $current_share = $request->slipshare;
            $new_nasre_share = floatval($old_nasre_share + $current_share);

            $msdata = Insured::findOrFail($insdata->id);

            if ($new_nasre_share != $old_nasre_share) {
                $msdata = Insured::findOrFail($insdata->id);

                $msdata->share_from = $new_nasre_share;
                $msdata->save();
            }

            $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($deductibleup as $ddup) {
                $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                $deductibleprocessup->status = 'active';
                $deductibleprocessup->save();
            }

            $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($extendcoverageup as $ecup) {
                $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                $extendcoverageprocessup->status = 'active';
                $extendcoverageprocessup->save();
            }

            $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($installmentpansup as $ipup) {
                $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                $inspanprocessup->status = 'active';
                $inspanprocessup->save();
            }

            $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', $request->sliptypeform)->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($retrocessionpanup as $rpup) {
                $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                $retropanprocessup->status = 'active';
                $retropanprocessup->save();
            }


            return response()->json(
                [
                    'id' => $slipdataup->id,
                    'slipstatus' => $slipdataup->status,
                    'new_share_nasre' => $msdata->share_from,
                    'ceding' => @$slipdataup->ceding->name,
                    'cedingbroker' => @$slipdataup->cedingbroker->name,
                    'count_endorsement' => @$slipdataup->endorsment
                ]
            );
        } else {
            $notification = array(
                'message' => 'Fire & Engginering Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }

    public function storeendorsement(Request $request)
    {
        $validator = $request->validate([
            'slipid' => 'required'
        ]);
        // dd($request->slipipfrom);
        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('id', $request->slipid)->first();
            // $slipdatalist= SlipTable::where('insured_id','=',$slipdata->insured_id)->where('slip_type',$request->sliptypeform)->where('selisih','=','false')->get();
            $slipdatalist = SlipTable::where('id', '=', $request->slipid)->where('insured_id', '=', $slipdata->insured_id)->where('endorsment',$slipdata->endorsment)->where('slip_type', $request->sliptypeform)->orderby('id', 'desc')->first();
            $insureddata = Insured::where('number', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->where('count_endorsement', $slipdata->endorsment)->first();

            // $id_ed = ($slipdata->id + 1);
            $num = "1";
            $id_ed = ((int)$slipdata->endorsment + (int)$num);

            $slipdatalast = SlipTable::where('endorsment', $id_ed)->where('id', '=', $request->slipid)->first();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('status','passive')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('status','passive')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('status','passive')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->where('minus','false')->where('status','passive')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $locationlist = TransLocationTemp::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();
            $attachmentlist = SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->orderby('id', 'desc')->get();


            if ($slipdata == null) {
                $notification = array(
                    'message' => 'Fire & Engineering Slip Endorsement Fail!',
                    'alert-type' => 'danger'
                );
            } else {

                if ($slipdatalast == null) {

                    $locationlistup = ' ';
                    $risklocationlistup = ' ';
                    $dtlistup = ' ';
                    $jsondtlistup = ' ';
                    $ectlistup = ' ';
                    $jsonectlistup = ' ';
                    $iptlistup = ' ';
                    $jsoniptlistup = ' ';
                    $rctlistup = ' ';
                    $jsonrctlistup = ' ';
                    $risklocationlistdetail = '';

                    $dtlistupminus = ' ';
                    $jsondtlistupminus = ' ';
                    $ectlistupminus = ' ';
                    $jsonectlistupminus = ' ';
                    $iptlistupminus = ' ';
                    $jsoniptlistupminus = ' ';
                    $rctlistupminus = ' ';
                    $jsonrctlistupminus = ' ';
                    $slipdataupminus = '';

                    

                    if ($deductiblelist != null) {
                        foreach ($deductiblelist as $dt) {

                            $dtlistup = DeductibleTemp::create([
                                'deductibletype_id' => $dt->deductibletype_id,
                                'currency_id' => $dt->currency_id,
                                'percentage' => $dt->percentage,
                                'min_claimamount' => $dt->min_claimamount,
                                'amount' => $dt->amount,
                                'slip_id' => $dt->slip_id,
                                'insured_id' => $dt->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'count_endorsement' => $id_ed,
                                'minus' => 'false'
                            ]);

                            // $jsondtlistup = DeductibleTemp::where('slip_id', '=', $dtlistup->slip_id)->where('insured_id', '=', $dtlistup->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','false')->where('count_endorsement', $dtlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsondtlistup = collect(DeductibleTemp::where('slip_id', '=', $dtlistup->slip_id)
                                                ->where('insured_id', '=', $dtlistup->insured_id)
                                                ->where('slip_type',$request->sliptypeform)
                                                ->where('minus','false')
                                                ->where('count_endorsement', $dtlistup->count_endorsement)
                                                ->where('deleted_at', null)
                                                ->orderby('id', 'desc')->get());
                            $jsondtlistup = $datajsondtlistup->unique('deductibletype_id','percentage','amount','min_claimamount');
                            $jsondtlistup->values()->all();


                            $dtlistupminus = DeductibleTemp::create([
                                'deductibletype_id' => $dt->deductibletype_id,
                                'currency_id' => $dt->currency_id,
                                'percentage' => $dt->percentage,
                                'min_claimamount' => $dt->min_claimamount,
                                'amount' => $dt->amount,
                                'slip_id' => $dt->slip_id,
                                'insured_id' => $dt->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'count_endorsement' => $id_ed,
                                'minus' => 'false'
                            ]);

                            $dtdata =  DeductibleTemp::findOrFail($dtlistupminus->id);
                            $dtdata->min_claimamount = ($dtlistupminus->min_claimamount * (-1));
                            $dtdata->amount = ($dtlistupminus->amount * (-1));
                            $dtdata->minus = "true";
                            $dtdata->save();

                            $jsondtlistupminus = DeductibleTemp::where('slip_id', '=', $dtdata->slip_id)->where('insured_id', '=', $dtdata->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','true')->where('count_endorsement', $dtlistupminus->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            
                        }
                    } else {
                        $dtlistup = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);

                        $dtlistupminus = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);
                    }


                    if ($extendcoveragelist != null) {
                        foreach ($extendcoveragelist as $ect) {
                            $ectlistup = ExtendCoverageTemp::create([
                                'extendcoverage_id' => $ect->extendcoverage_id,
                                'percentage' => $ect->percentage,
                                'amount' => $ect->amount,
                                'slip_id' => $ect->slip_id,
                                'count_endorsement' => $id_ed,
                                'insured_id' => $ect->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            // $jsonectlistup = ExtendCoverageTemp::where('slip_id', '=', $ectlistup->slip_id)->where('insured_id', '=', $ectlistup->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','false')->where('count_endorsement', $ectlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsonectlistup = collect(ExtendCoverageTemp::where('slip_id', '=', $ectlistup->slip_id)
                                                ->where('insured_id', '=', $ectlistup->insured_id)
                                                ->where('slip_type',$request->sliptypeform)->where('minus','false')
                                                ->where('count_endorsement', $ectlistup->count_endorsement)
                                                ->where('deleted_at', null)->orderby('id', 'desc')
                                                ->get());
                            $jsonectlistup = $datajsonectlistup->unique('extendcoverage_id','percentage','amount');
                            $jsonectlistup->values()->all();
                           
                            $ectlistupminus = ExtendCoverageTemp::create([
                                'extendcoverage_id' => $ect->extendcoverage_id,
                                'percentage' => $ect->percentage,
                                'amount' => $ect->amount,
                                'slip_id' => $ect->slip_id,
                                'count_endorsement' => $id_ed,
                                'insured_id' => $ect->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $ectdata =  ExtendCoverageTemp::findOrFail($ectlistupminus->id);
                            $ectdata->amount = ($ectlistupminus->amount * (-1));
                            $ectdata->minus = "true";
                            $ectdata->save();

                            $jsonectlistupminus = ExtendCoverageTemp::where('slip_id', '=', $ectdata->slip_id)->where('insured_id', '=', $ectdata->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','true')->where('count_endorsement', $ectdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            
                        }
                    } else {
                        $ectlistup = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);

                        $ectlistupminus = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);
                    }

                    if ($installmentlist != null) {
                        foreach ($installmentlist as $ipt) {
                            $iptlistup = InstallmentTemp::create([
                                'installment_date' => $ipt->installment_date,
                                'percentage' => $ipt->percentage,
                                'amount' => $ipt->amount,
                                'slip_id' => $ipt->slip_id,
                                'count_endorsement' => ((int)$ipt->count_endorsement + (int)$num),
                                'insured_id' => $ipt->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            // $jsoniptlistup = InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)->where('insured_id', '=', $iptlistup->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','false')->where('count_endorsement', $iptlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsoniptlistup = collect(InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)
                                                ->where('insured_id', '=', $iptlistup->insured_id)
                                                ->where('slip_type',$request->sliptypeform)
                                                ->where('minus','false')
                                                ->where('count_endorsement', $iptlistup->count_endorsement)
                                                ->where('deleted_at', null)
                                                ->orderby('id', 'desc')
                                                ->get());
                            $jsoniptlistup = $datajsoniptlistup->unique('installment_date','percentage','amount');
                            $jsoniptlistup->values()->all();

                            $iptlistupminus = InstallmentTemp::create([
                                'installment_date' => $ipt->installment_date,
                                'percentage' => $ipt->percentage,
                                'amount' => $ipt->amount,
                                'slip_id' => $ipt->slip_id,
                                'count_endorsement' => ((int)$ipt->count_endorsement + (int)$num),
                                'insured_id' => $ipt->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $iptdata =  InstallmentTemp::findOrFail($iptlistupminus->id);
                            $iptdata->amount = ($iptlistupminus->amount * (-1));
                            $iptdata->minus = "true";
                            $iptdata->save();

                            $jsoniptlistupminus = InstallmentTemp::where('slip_id', '=', $iptdata->slip_id)->where('insured_id', '=', $iptdata->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','true')->where('count_endorsement', $iptdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                            
                        }
                    } else {
                        $iptlistup = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);

                        $iptlistupminus = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);
                    }

                    if (!$retrocessionlist) {
                        $rctlistup = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);

                        $rctlistupminus = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);
                    } else {

                        foreach ($retrocessionlist as $rct) {
                            $rctlistup = RetrocessionTemp::create([
                                'type' => $rct->type,
                                'contract' => $rct->contract,
                                'percentage' => $rct->percentage,
                                'amount' => $rct->amount,
                                'slip_id' => $rct->slip_id,
                                'count_endorsement' => $id_ed,
                                'insured_id' => $rct->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);
                            
                            $jsonrctlistup = RetrocessionTemp::where('slip_id', '=', $rctlistup->slip_id)->where('insured_id', '=', $rctlistup->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','false')->where('count_endorsement', $rctlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsonrctlistup = collect(RetrocessionTemp::where('slip_id', '=', $rctlistup->slip_id)
                                                ->where('insured_id', '=', $rctlistup->insured_id)
                                                ->where('slip_type',$request->sliptypeform)
                                                ->where('minus','false')
                                                ->where('count_endorsement', $rctlistup->count_endorsement)
                                                ->where('deleted_at', null)
                                                ->orderby('id', 'desc')->get());
                            $jsonrctlistup = $datajsonrctlistup->unique('type','contract','percentage','amount');
                            $jsonrctlistup->values()->all();

                            $rctlistupminus = RetrocessionTemp::create([
                                'type' => $rct->type,
                                'contract' => $rct->contract,
                                'percentage' => $rct->percentage,
                                'amount' => $rct->amount,
                                'slip_id' => $rct->slip_id,
                                'count_endorsement' => $id_ed,
                                'insured_id' => $rct->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $rctdata =  RetrocessionTemp::findOrFail($rctlistupminus->id);
                            $rctdata->amount = ($rctlistupminus->amount * (-1));
                            $rctdata->minus = "true";
                            $rctdata->save();

                            $jsonrctlistupminus = RetrocessionTemp::where('slip_id', '=', $rctdata->slip_id)->where('insured_id', '=', $rctdata->insured_id)->where('slip_type',$request->sliptypeform)->where('minus','true')->where('count_endorsement', $rctdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                            
                        }
                    }


                    // dd($slipdatalist);

                    if ($slipdatalist != null) {
                        if ($jsondtlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'false',
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistup),
                                'extend_coverage' => json_encode($jsonectlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'extend_coverage' => json_encode($jsonectlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'no'

                            ]);
                        } elseif ($jsonectlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'false',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistup),
                                'extend_coverage' => json_encode($jsonectlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'extend_coverage' => json_encode($jsonectlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'no'

                            ]);
                        } elseif ($jsoniptlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'false',
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistup),
                                'extend_coverage' => json_encode($jsonectlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'extend_coverage' => json_encode($jsonectlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'no'

                            ]);
                        } elseif ($jsonrctlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'false',
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistup),
                                'extend_coverage' => json_encode($jsonectlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'extend_coverage' => json_encode($jsonectlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'no'

                            ]);
                        } else {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'false',
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistup),
                                'extend_coverage' => json_encode($jsonectlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => $request->sliptypeform,
                                'prod_year' => $slipdatalist->prod_year,
                                'date_transfer' => $slipdatalist->slipdatetransfer,
                                'status' => 'endorsement',
                                'endorsment' => ((int)$slipdatalist->endorsment + (int)$num),
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$slt->currency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'occupacy' => $request->slipoccupacy,
                                'build_const' => $request->slipbld_const,
                                'attacment_file' => json_encode($attachmentlist),
                                'total_sum_insured' => $request->sliptotalsum,
                                'insured_type' => $request->sliptype,
                                'insured_pct' => $request->slippct,
                                'total_sum_pct' => $request->sliptotalsumpct,
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'extend_coverage' => json_encode($jsonectlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace('/','-',$request->sliprpto))),
                                'proportional' => $request->proportional,
                                'layer_non_proportional' => $request->sliplayerproportional,
                                'rate' => $request->sliprate,
                                'v_broker' => $request->slipvbroker,
                                'share' => $request->slipshare,
                                'sum_share' => $request->slipsumshare,
                                'basic_premium' => $request->slipbasicpremium,
                                'commission' => $request->slipcommission,
                                'grossprm_to_nr' => $request->slipgrossprmtonr,
                                'netprm_to_nr' => $request->slipnetprmtonr,
                                'sum_commission' => $request->slipsumcommission,
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                                'total_day' => $request->total_day,
                                'total_year' => $request->total_year,
                                'sum_total_date' => $request->sum_total_date,
                                'type_tsi' => $request->type_tsi,
                                'share_tsi' => $request->share_tsi,
                                'type_share_tsi' => $request->type_share_tsi,
                                'sliptotalrate' => $request->sliptotalrate,
                                'sum_feebroker' => $request->sum_feebroker,
                                'slipshow' => 'no'

                            ]);
                        }
                    }

                    // $insureddataup = Insured::findOrFail($insureddata->id);
                    // $insureddataup->count_endorsement = ($insureddata->count_endorsement + 1);
                    // $insureddataup->save();

                    $notification = array(
                        'message' => 'Fire & Enginering Slip added Endorsement successfully!',
                        'alert-type' => 'success'
                    );




                    $msdata = SlipTable::findOrFail($slipdataupminus->id);
                    $msdata->total_sum_insured = ($slipdataupminus->total_sum_insured * (-1));
                    $msdata->total_sum_pct = ($slipdataupminus->total_sum_pct * (-1));
                    $msdata->sum_share = ($slipdataupminus->sum_share * (-1));
                    $msdata->sliptotalrate = $slipdataupminus->sliptotalrate;
                    $msdata->sum_total_date = $slipdataupminus->sum_total_date;
                    $msdata->sum_feebroker = ($slipdataupminus->sum_feebroker * (-1));
                    $msdata->basic_premium = ($slipdataupminus->basic_premium * (-1));
                    $msdata->commission = ($slipdataupminus->commission * (-1));
                    $msdata->grossprm_to_nr = ($slipdataupminus->grossprm_to_nr * (-1));
                    $msdata->netprm_to_nr = ($slipdataupminus->netprm_to_nr * (-1));
                    $msdata->sum_commission = ($slipdataupminus->sum_commission * (-1));
                    $msdata->wpc = $slipdataupminus->wpc;
                    // $msdata->status='endorsement'; 
                    $msdata->sum_own_retention = ($slipdataupminus->sum_own_retention * (-1));
                    $msdata->selisih = "true";
                    $msdata->slipshow = "no";
                    $msdata->save();

                    $attachmentcheck = SlipTableFile::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', $request->sliptypeform)->get();

                    if ($attachmentcheck) {
                        foreach ($attachmentcheck as $atc) {
                            $attachmentupdate = SlipTableFile::findOrFail($atc->id);
                            $attachmentupdate->slip_id = $slipdataup->number;
                            $attachmentupdate->count_endorsement = ((int)$atc->count_endorsement + (int)$num);
                            $attachmentupdate->save();
                        }
                    }

                    $statuslogcheck = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', $request->sliptypeform)->get();

                    if ($statuslogcheck) {
                        foreach ($statuslogcheck as $slc) {
                            $statuslogupdate = StatusLog::findOrFail($slc->id);
                            $statuslogupdate->slip_id = $slipdataup->number;
                            $statuslogupdate->count_endorsement = ((int)$slc->count_endorsement + (int)$num);
                            $statuslogupdate->save();
                        }

                        StatusLog::create([
                            'insured_id' => $slipdataup->insured_id,
                            'status' => $slipdataup->status,
                            'datetime' => date('Y-m-d H:i:s'),
                            'slip_id' => $slipdataup->number,
                            'user' => $slipdataup->username,
                            'count_endorsement' => $slipdataup->endorsment,
                            'slip_type' => $request->sliptypeform
                        ]);
                    }
                    // $insdata =  Insured::findOrFail($insureddata->id);
                    // $insdata->share_from = ($insureddata->share_from * (1));
                    // $insdata->share_to = ($insureddata->share_to * (1));
                    // $insdata->save();

                    // $cedingbroker = CedingBroker::where('id', $slipdataup->source)->first();
                    // $ceding = CedingBroker::where('id', $slipdataup->source_2)->first();

                    // $slipdataup->cedingbroker = $cedingbroker->name;
                    // $slipdataup->ceding = $ceding->name;

                    $slipdatalist2 = SlipTable::where('id', '=', $slipdata->insured_id)->where('slip_type', '=', $request->sliptypeform)->get();

                    //$locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();


                    // $slipdatalist = array();
                    // foreach ($slipdatalist2 as $datadetail) {
                    //     $datadetail->cedingbroker = "";
                    //     $datadetail->ceding = "";

                    //     if ($datadetail->cedingbroker) {
                    //         $dataceding = CedingBroker::where('id', $datadetail->source)->first();
                    //         $datadetail->cedingbroker = $dataceding->name;
                    //         $datadetail->ceding = $dataceding->name;
                    //     } else {
                    //         $dataceding = CedingBroker::where('id', $datadetail->source)->first();
                    //         $datadetail->cedingbroker = $dataceding->name;
                    //         $datadetail->ceding = $dataceding->name;
                    //     }



                    //     $slipdatalist[] = $datadetail;
                    // }

                    
                    
                    return response()->json(
                        [
                            'slip_data' => $slipdataup->toJson(),
                            // 'slip_dataarray' => json_encode($slipdatalist),
                            'oldid' => $request->slipid,
                            // 'insured_data' => $insureddataup->toJson(),
                            // 'location_data' => $lookuplocationlist->toJson(),
                            // 'risklocation_data' => $risklocationlistdetail->toJson(),
                        ]
                    );
                } else {
                    $notification = array(
                        'message' => 'Fire & Enginering Slip added Endorsement Failed! data already endorsed!',
                        'alert-type' => 'error'
                    );

                    return response()->json(
                        $notification
                    );
                }
            }
        } else {

            $notification = array(
                'message' => 'Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function changeCancel($id)
    {

        $slip = SlipTable::where('id', '=', $id);
        $slip->status = "cancel";
        $slip->save();

        $notification = array(
            'message' => 'Fire & Engginering Insured & Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function cancelstatus(Request $request)
    {

        $slip = SlipTable::where('number', '=', $request->slipnumber)->where('insured_id',$request->code_ms)->where('slip_type',$request->slip_type)->first();
        $slip->status = "cancel";
        $slip->remarkscancel = $request->remarks;
        $slip->save();

        StatusLog::create([
            'insured_id' => $request->code_ms,
            'status' => "cancel",
            'datetime' => date('Y-m-d H:i:s '),
            'slip_id' => $request->slipnumber,
            'user' => $request->username,
            'count_endorsement' => $request->endorsement,
            'slip_type' => $request->slip_type
        ]);

        $slipdata2 = DB::table('slip_table as stb')
                    ->where('stb.insured_id', $request->code_ms)
                    ->where('stb.slipshow', 'yes')
                    ->where('stb.slip_type', $request->slip_type)
                    ->join('ceding_broker as cb1', 'stb.source', '=', 'cb1.id')
                    ->join('ceding_broker as cb2', 'stb.source', '=', 'cb2.id')
                    ->select('stb.*', 'cb1.name','cb1.company_name','cb2.name as source_name','cb2.company_name as source_companyname')
                    ->orderBy('stb.endorsment','desc')
                    ->orderBy('cb1.name', 'asc')
                    ->get();
        // $slipdatadistict = SlipTable::select('number')->where('insured_id', $slipdataup->insured_id)->where('slipshow', 'yes')->where('slip_type', $request->sliptypeform)->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->distinct()->get('slip_table.number');
        $dataslipdistict = collect(SlipTable::where('insured_id',$request->code_ms)
                            ->where('slipshow', 'yes')
                            ->where('selisih','false')
                            ->where('slip_type', $request->slip_type)
                            ->orderBy('endorsment','desc')->get());
        $slipdatadistict = $dataslipdistict->unique('number');
        $slipdatadistict->values()->all();

        $maxdata = SlipTable::where('insured_id', $request->code_ms)
                    ->where('slip_type', $request->slip_type)
                    ->orderby('endorsment', 'desc')->first();


        $notification = array(
            'message' => 'Insured & Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
         return response()->json(
            [
                
                'slip_data2' => $slipdata2->toJson(),
                'slip_data_distinct' => $slipdatadistict->toJson(),
                'notification' => $notification,
                'max_endorsement' => $maxdata->endorsment,
                // 'insured_data' => $insureddataup->toJson(),
                // 'location_data' => $lookuplocationlist->toJson(),
                // 'risklocation_data' => $risklocationlistdetail->toJson(),
            ]);
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
    public function autoupdateinstallment(Request $request){
        $insured = $request->insured;
        $slipnumber = $request->slipnumber;
        $sliptype = $request->sliptype;
        $slipnetprmtonr = $request->slipnetprmtonr;
        $count_endorsement = $request->count_endorsement;

        $checkExistData = InstallmentTemp::where('slip_id',$slipnumber)->where('insured_id',$insured)->where('slip_type',$sliptype)->where('deleted_at',null)->where('minus','false')->where('status','active')->where('count_endorsement',$count_endorsement)
        ->get();
        foreach ($checkExistData as $data) {

            $id = $data->id;
            $amount = strval($data->amount);
            $amountup = strval($slipnetprmtonr);
            $percent = ($amount/$amountup)*100;
            $insallmentUpdate = InstallmentTemp::findOrFail($id);
            $insallmentUpdate->percentage = $percent;
            $insallmentUpdate->amount = $amountup;
            $insallmentUpdate->save();
        }
        $newData = InstallmentTemp::where('slip_id',$slipnumber)->where('insured_id',$insured)->where('slip_type',$sliptype)->where('deleted_at',null)->where('minus','false')->where('status','active')->where('count_endorsement',$count_endorsement)
        ->get();
        $sliptable = SlipTable::where('insured_id',$insured)->where('endorsment',$count_endorsement)->where('number',$slipnumber)->where('slip_type',$sliptype)->where('selisih','false')->first();
        $sliptable->installment_panel = $newData->toJson();
        $sliptable->save();
        return response()->json([
            'insured' => $insured,
            'slipnumber' => $slipnumber,
            'sliptype' => $sliptype,
            'slipnetprmtonr' => $slipnetprmtonr,
            'count_endorsement' => $count_endorsement,
            'data' => $newData->toJson()
        ]);
    }
    public function autoupdateretro(Request $request){
        $insured = $request->insured;
        $slipnumber = $request->slipnumber;
        $sliptype = $request->sliptype;
        $slipsumshare = $request->slipsumshare;
        $count_endorsement = $request->count_endorsement;

        $checkExistData = RetrocessionTemp::where('slip_id',$slipnumber)->where('insured_id',$insured)->where('slip_type',$sliptype)->where('deleted_at',null)->where('minus','false')->where('status','active')->where('count_endorsement',$count_endorsement)
        ->get();
        foreach ($checkExistData as $data) {

            $id = $data->id;
            $amount = strval($data->amount);
            $amountup = strval($slipsumshare);
            $percent = ($amount/$amountup)*100;
            $retroUpdate = RetrocessionTemp::findOrFail($id);
            $retroUpdate->percentage = $percent;
            $retroUpdate->amount = $amountup;
            $retroUpdate->save();
        }
        $newData = RetrocessionTemp::where('slip_id',$slipnumber)->where('insured_id',$insured)->where('slip_type',$sliptype)->where('deleted_at',null)->where('minus','false')->where('status','active')->where('count_endorsement',$count_endorsement)
        ->get();
        $sliptable = SlipTable::where('insured_id',$insured)->where('endorsment',$count_endorsement)->where('number',$slipnumber)->where('slip_type',$sliptype)->where('selisih','false')->first();
        $sliptable->retrocession_panel = $newData->toJson();
        $sliptable->save();
        return response()->json([
            'insured' => $insured,
            'slipnumber' => $slipnumber,
            'sliptype' => $sliptype,
            'slipsumshare' => $slipsumshare,
            'count_endorsement' => $count_endorsement,
            'data' => $newData->toJson()
        ]);
    }
    
    public function changestatus($idm){
        if ($idm == '') {
            return response()->json([
                'success' => false,
                'message' => 'Error getting data slip'
            ]);
        }

        $slip = SlipTable::find($idm);

        $slip->status ='slip';
        $slip->save();

        return response()->json([
            'success' => true,
            'message' => 'Change to slip success!'
        ]);
    }
    public function changetfdate($idm){
        if ($idm == '') {
            return response()->json([
                'success' => false,
                'message' => 'Error getting data slip'
            ]);
        }

        $slip = SlipTable::find($idm);

        $slip->date_transfer = date('Y-m-d');
        $slip->save();

        return response()->json([
            'success' => true,
            'message' => 'Change to slip success!'
        ]);
    }
    function getCedingBroker(){
        return CedingBroker::orderby('id', 'asc')->where('type', 5)->orWhere('type', 4)->get()->unique('code');
    }
    function getStates($id)
    {
        if ($request->ajax())
            return State::where(['country_id' => $id])->get();
        else {
            return 0;
        }
    }
    function getInsurableList(){
        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        return $interestinsured;
    }
    function getCedingSlip($code_ms){
        $data =[];
        $brokerchoice = DB::table('risk_location_detail')->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
            ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
            ->where('trans_location_detail.insured_id', '=', $code_ms)
            ->where('ceding_broker.type', '=', 4)
            ->orWhere('ceding_broker.type', '=', 5)
            ->select('risk_location_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
            ->orderByRaw("FIELD(ceding_broker.id , (SELECT GROUP_CONCAT(DISTINCT(ceding_id) SEPARATOR ',') FROM shiplist_detail WHERE insured_id= '".$code_ms."')) DESC")
            ->distinct()
            ->get();
        

        return $brokerchoice;
    }
}
