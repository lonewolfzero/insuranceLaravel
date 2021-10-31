<?php

namespace App\Http\Controllers\Treaty;

use App\Http\Controllers\Controller;
use App\Models\CedingBroker;
use App\Models\COB;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\Treaty\NonProp\InstallMindep;
use App\Models\Treaty\NonProp\InstallMindepSubcontract;
use App\Models\Treaty\NonProp\InstallMindepRetro;
use App\Models\Treaty\NonProp\InstallMindepCob;
use App\Models\Treaty\NonProp\InstallMindepCobDetail;
use App\Models\Treaty\NonProp\InstallMindepDetail;
use App\Models\Treaty\NonProp\InstallMindepLayer;
use App\Models\Treaty\NonProp\InstallMindepReinstatement;
use App\Models\Treaty\NonProp\AdjusmentInstallMindep;
use App\Models\Treaty\NonProp\AdjsutmentInstallMindepReins;
use App\Models\Treaty\NonProp\InstallMindepReins;
use App\Models\ClaimDetail;
use App\Models\BusinessType;

use Illuminate\Http\Request;
use App\Models\CurrencyExchange;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class NonPropController extends Controller
{

    public function getclaimregcomp($searchregcomp)
    {
        if(!empty($searchregcomp))
        {
            $user = Auth::user();

            $regcompclaimdata = ClaimDetail::where('reg_comp', 'like', '%' . $searchregcomp . '%')->join('slip_table','claim_detail.doc_number','=','slip_table.number')->get();
            return response()->json(
                [
                    'success' => true,
                    'regcompclaimdata' => $regcompclaimdata->toJson(),
                    'message' => 'Claim Data  Update successfully!',
                ]
            );
        }
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Claim Data  get data Failed!',
                ]
            );
        }
    }


    public function getclaimregcompdetail($searchregcomp)
    {
        if(!empty($searchregcomp))
        {
            $user = Auth::user();

            $regcompclaimdata = ClaimDetail::where('reg_comp', '=', $searchregcomp)->join('slip_table','claim_detail.doc_number','=','slip_table.number')->first();
            return response()->json(
                [
                    'success' => true,
                    'regcompclaimdata' => $regcompclaimdata,
                    'message' => 'Claim Data  Update successfully!',
                ]
            );
        }
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Claim Data  get data Failed!',
                ]
            );
        }
    }


    public function getsubcontractbyid($masterid)
    {
        if(!empty($masterid))
        {
            $user = Auth::user();

            $subcontractdata = InstallMindepSubcontract::where('master_number', $masterid)->get();
            return response()->json(
                [
                    'success' => true,
                    'subcontractdata' => $subcontractdata->toJson(),
                    'message' => 'Sub COntract  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sub COntract  get data Failed!',
                ]
            );
           
        }

    }



    public function getsubcontractdetailbyid($submasterid)
    {
        if(!empty($submasterid))
        {
            $user = Auth::user();

            $subcontractdata = InstallMindepSubcontract::findOrFail($submasterid);
            return response()->json(
                [
                    'success' => true,
                    'subcontractdata' => $subcontractdata,
                    'message' => 'Sub COntract  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sub COntract  get data Failed!',
                ]
            );
           
        }

    }
    

    


    public function getgroupcobbyid($submasterid)
    {
        if(!empty($submasterid))
        {
            $user = Auth::user();

            $groupcobdataget = InstallMindepCob::where('subcontract_number', $submasterid)->get();
            return response()->json(
                [
                    'success' => true,
                    'groupcobdataget' => $groupcobdataget->toJson(),
                    'message' => 'GroupCOB  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'GroupCOB  get data Failed!',
                ]
            );
           
        }
    }

    

    
    public function getgroupcobdetailbyid($submasterid)
    {
        if(!empty($submasterid))
        {
            $user = Auth::user();

            $groupcobdataget = InstallMindepCob::findOrFail($submasterid);
            return response()->json(
                [
                    'success' => true,
                    'groupcobdataget' => $groupcobdataget,
                    'message' => 'GroupCOB  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'GroupCOB  get data Failed!',
                ]
            );
           
        }
    }



    public function getretrobyid($groupcobid)
    {
        if(!empty($groupcobid))
        {
            $user = Auth::user();

            $retrodata = InstallMindepRetro::where('cob_name', $groupcobid)->get();
            return response()->json(
                [
                    'success' => true,
                    'retrodata' => $retrodata->toJson(),
                    'message' => 'Retro  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Retro  get data Failed!',
                ]
            );
           
        }

    }


    public function getretrodetailbyid($retroid)
    {
        if(!empty($retroid))
        {
            $user = Auth::user();

            $retrodata = InstallMindepRetro::findOrFail($retroid);
            return response()->json(
                [
                    'success' => true,
                    'retrodata' => $retrodata,
                    'message' => 'Retro  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Retro  get data Failed!',
                ]
            );
           
        }
    }


    public function getlayerbyid($groupcobid)
    {
        if(!empty($groupcobid))
        {
            $user = Auth::user();

            $layerdatalist = InstallMindepLayer::where('groupcob_number',$groupcobid)->get();
            return response()->json(
                [
                    'success' => true,
                    'layerdatalist' => $layerdatalist->toJson(),
                    'message' => 'Mindep Layer  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Mindep Layer get data Failed!',
                ]
            );
           
        }
    }


    public function getlayerdetailbyid($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();

            $layerdatalist = InstallMindepLayer::findOrFail($layerid);
            return response()->json(
                [
                    'success' => true,
                    'layerdatalist' => $layerdatalist,
                    'message' => 'Mindep Layer  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Mindep Layer get data Failed!',
                ]
            );
        }
    }




    public function getinstallmentbyid($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();

            $installmentdatalist = InstallMindepDetail::where('layer_id', $layerid)->get();
            return response()->json(
                [
                    'success' => true,
                    'installmentdatalist' => $installmentdatalist->toJson(),
                    'message' => 'Installment Mindep Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Mindep Detail  get data Failed!',
                ]
            );
           
        }

    }


    public function getinstallmentdetailbyid($instid)
    {
        if(!empty($instid))
        {
            $user = Auth::user();

            $installmentdatalist = InstallMindepDetail::findOrFail($instid);
            return response()->json(
                [
                    'success' => true,
                    'installmentdatalist' => $installmentdatalist,
                    'message' => 'Installment Mindep Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Mindep Detail  get data Failed!',
                ]
            );
           
        }
    }



    public function getinstallmentcount($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();
            
            $currdate2 = date("Y-m-d");
            $mydate = date("Y") . date("m") . date("d");
            $slip_now = InstallMindepDetail::where('layer_id',$layerid)->whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);
            // dd($sliplastid);

            if ($sliplastid != null) 
            {
                if ($sliplastid < 9) {
                    $code_sub = "COUNTERINSTALL" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sub = "COUNTERINSTALL" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sub = "COUNTERINSTALL" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sub = "COUNTERINSTALL" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sub = "COUNTERINSTALL" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sub = "COUNTERINSTALL" .  $mydate . "0000" . strval(1);
            }

            return response()->json(
                [
                    'success' => true,
                    'countercode' => $code_sub,
                    'message' => 'Installment Mindep Detail Count Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Mindep Detail Count  get data Failed!',
                ]
            );
        }
    }


    public function getdetailcobbyid($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();

            $installmentcobdatalist = InstallMindepCobDetail::where('layer_id', $layerid)->get();
            $totalogrpi = InstallMindepCobDetail::where('layer_id',$layerid)->sum('ogrpi_amount');
            return response()->json(
                [
                    'success' => true,
                    'totalogrpi'=>$totalogrpi,
                    'installmentcobdatalist' => $installmentcobdatalist->toJson(),
                    'message' => 'Installment Mindep COB Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Mindep COB Detail  get data Failed!',
                ]
            );
           
        }

    }

    public function getdetailcobbyiddetail($detailid)
    {
        if(!empty($detailid))
        {
            $user = Auth::user();

            $installmentcobdatalist = InstallMindepCobDetail::findOrFail($detailid);

            return response()->json(
                [
                    'success' => true,
                    'installmentcobdatalist' => $installmentcobdatalist,
                    'message' => 'Installment Mindep COB Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Mindep COB Detail  get data Failed!',
                ]
            );
           
        }
    }


    
    public function getdetailreinsid($reinsid)
    {
        if(!empty($reinsid))
        {
            $user = Auth::user();

            $reinsdatalist = InstallMindepReins::findOrFail($reinsid);

            return response()->json(
                [
                    'success' => true,
                    'reinsdatalist' => $reinsdatalist,
                    'message' => 'Reinstallment Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Reinstallment Detail  get data Failed!',
                ]
            );
           
        }
    }


    public function getdetailadjreinsid($adjreinsid)
    {
        if(!empty($adjreinsid))
        {
            $user = Auth::user();

            $ajdreinsdatalist = AdjsutmentInstallMindepReins::findOrFail($adjreinsid);

            return response()->json(
                [
                    'success' => true,
                    'ajdreinsdatalist' => $ajdreinsdatalist,
                    'message' => 'Reinstallment Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Reinstallment Detail  get data Failed!',
                ]
            );
           
        }
    }



    public function getreinstatementbyid($numbergroupid)
    {
        if(!empty($numbergroupid))
        {
            $user = Auth::user();

            $reinstatementdatalist = InstallMindepReinstatement::where('groupcob_number', $numbergroupid)->get();
            return response()->json(
                [
                    'success' => true,
                    'reinstatementdatalist' => $reinstatementdatalist->toJson(),
                    'message' => 'Reinstatement Mindep Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Reinstatement Mindep Detail  get data Failed!',
                ]
            );
           
        }

    }


    public function getadjinstallmentbyid($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();

            $adjinstallmentdatalist = AdjusmentInstallMindep::where('layer_id', $layerid)->get();
            return response()->json(
                [
                    'success' => true,
                    'adjinstallmentdatalist' => $adjinstallmentdatalist->toJson(),
                    'message' => 'ADJ Reinstatement Mindep Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'ADJ Reinstatement Mindep Detail  get data Failed!',
                ]
            );
           
        }
    }


    public function getadjinstallmentcount($layerid)
    {
        if(!empty($layerid))
        {
            $user = Auth::user();

            $currdate2 = date("Y-m-d");
            $mydate = date("Y") . date("m") . date("d");
            $slip_now = AdjusmentInstallMindep::where('layer_id',$layerid)->whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);
            // dd($sliplastid);

            if ($sliplastid != null) 
            {
                if ($sliplastid < 9) {
                    $code_sub = "COUNTERADJ" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sub = "COUNTERADJ" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sub = "COUNTERADJ" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sub = "COUNTERADJ" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sub = "COUNTERADJ" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sub = "COUNTERADJ" .  $mydate . "0000" . strval(1);
            }
            
            return response()->json(
                [
                    'success' => true,
                    'countercode' => $code_sub,
                    'message' => 'ADJ Reinstatement Mindep Detail Count  Update successfully!',
                ]
            );
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'ADJ Reinstatement Mindep Detail Count  get data Failed!',
                ]
            );
        }
    }


    public function getadjinstallmentdetailbyid($adjinstid)
    {
        if(!empty($adjinstid))
        {
            $user = Auth::user();

            $adjinstallmentdatalist = AdjusmentInstallMindep::findOrFail($adjinstid);
            return response()->json(
                [
                    'success' => true,
                    'adjinstallmentdatalist' => $adjinstallmentdatalist,
                    'message' => 'ADJ Reinstatement Mindep Detail  Update successfully!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'ADJ Reinstatement Mindep Detail  get data Failed!',
                ]
            );
           
        }
    }

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

    public function storereins(Request $request)
    {

        $validator = $request->validate([
            'counternumber' => 'required',
            'detailcob' => 'required',
            'reinsid' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
                $reins = InstallMindepReins::where('counter_number', $request->counter_number)->first();
                
                if(empty($reins))
                {
                    $reins = InstallMindepReins::where('reins_id', $request->reinsid)->first();
                }

                if(empty($reins))
                {
                    $posdate =  $request->dateprod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $posdate2 =  $request->dateloss;
                    $date2 = str_replace('/', '-', $posdate2);
                    $newposDate2 = date('Y-m-d', strtotime($date2));

                

                    $reinsdata = InstallMindepReins::create([
                        'counter_number' => $request->counternumber,
                        'reins_id' => $request->reinsid,
                        'status_doc' => $request->statusdoc,
                        'date_prod' => $newposDate,
                        'date_loss' => $newposDate2,
                        'dla_reff' => $request->dlareff,
                        'insured' => $request->insured,
                        'currency_id' => $request->currency,
                        'currency'=>$request->currencytext,
                        'settlement' => $request->settlement,
                        'loss_nasre' => $request->lossnasre,
                        'reinstatement_rate' => $request->reinstatementrate,
                        'reinstatement_day' => $request->reinstatementday,
                        'reinstatement_of' => $request->reinstatementof,
                        'reinstatement_premiun' => $request->reinstatementpremium,
                        'nasre_share' => $request->nasreshare,
                        'main_claim_id' => $request->claimid,
                        'claim_id' => $request->claimid,
                        'layer_id' => $request->layerid,
                        'detailcob_id' => $request->detailcob,
                        'transfer_date' => $request->transferdate,
                        'username' => $request->username,
                        'status'=>'active'
                    ]);

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = InstallMindepReins::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "REINSTATEMENT" .  $mydate . "0000" . strval(1);
                    }

                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'id'=>$reinsdata->id,
                            'message' => 'Reinstatement Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {

                    $posdate =  $request->date_prod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $posdate2 =  $request->date_loss;
                    $date2 = str_replace('/', '-', $posdate2);
                    $newposDate2 = date('Y-m-d', strtotime($date2));

                    $reinsid = $reins->id;
                    $reinsdata = InstallMindepReins::findOrFail($reinsid);
                    $reinsdata->date_prod = $newposDate;
                    $reinsdata->counter_number = $request->counternumber;
                    $reinsdata->reins_id = $request->reinsid;
                    $reinsdata->status_doc = $request->statusdoc;
                    $reinsdata->date_prod = $newposDate;
                    $reinsdata->date_loss = $newposDate2;
                    $reinsdata->product_claim = $request->product_claim;
                    $reinsdata->dla_reff = $request->dlareff;
                    $reinsdata->insured = $request->insured;
                    $reinsdata->currency_id = $request->currency;
                    $reinsdata->currency = $request->currencytext;
                    $reinsdata->settlement = $request->settlement;
                    $reinsdata->loss_nasre = $request->lossnasre;
                    $reinsdata->reinstatement_rate = $request->reinstatementrate;
                    $reinsdata->reinstatement_day = $request->reinstatementday;
                    $reinsdata->reinstatement_of = $request->reinstatementof;
                    $reinsdata->reinstatement_premiun = $request->reinstatementpremium;
                    $reinsdata->nasre_share = $request->nasreshare;
                    $reinsdata->main_claim_id = $request->main_claim_id;
                    $reinsdata->claim_id = $request->claimid;
                    $reinsdata->layer_id = $request->layerid;
                    $reinsdata->detailcob_id = $request->detailcob;
                    $reinsdata->transfer_date = $request->transferdate;
                    $reinsdata->username = $request->username;
                    $reinsdata->save();
                    

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = InstallMindepReins::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "REINSTATEMENT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "REINSTATEMENT" .  $mydate . "0000" . strval(1);
                    }

                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'id'=>$reinsdata->id,
                            'message' => 'Reinstatement successfully!, but tsi changed. Must Change!!!',
                        ]
                    );
                }
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Reinstatement Entry added Failed!',
                ]
            ); 
        }
    }



    public function storeadjusmentreins(Request $request)
    {
        $validator = $request->validate([
            'counternumber' => 'required',
            'reinsid' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
                $adjreins = AdjsutmentInstallMindepReins::where('counter_number', $request->counter_number)->first();
                
                if(empty($adjreins))
                {
                    $adjreins = AdjsutmentInstallMindepReins::where('reins_id2', $request->reinsnumber)->first();
                }

                if(empty($adjreins))
                {
                    $posdate =  $request->dateprod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $adjreinsdata = AdjsutmentInstallMindepReins::create([
                        'counter_number' => $request->counternumber,
                        'layer_id' => $request->layerid,
                        'reins_id' => $request->reinsid,
                        'reins_id2' => $request->reinsnumber,
                        'date_prod' => $newposDate,
                        'reinstatement' => $request->reinstatement,
                        'nasre_share' => $request->nasreshare,
                        'type' => $request->typedata,
                        'position' => $request->position,
                        'username' => $request->username,
                        'transfer_date' => $request->transferdate,
                        'status'=>'active'
                    ]);


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = AdjsutmentInstallMindepReins::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "ADJREINSTATEMENT" .  $mydate . "0000" . strval(1);
                    }

                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'id'=>$adjreinsdata->id,
                            'message' => 'Master Contract  Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    $posdate =  $request->date_prod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $adjreinsid = $adjreins->id;
                    $adjreinsdata = AdjsutmentInstallMindepReins::findOrFail($adjreinsid);
                    $adjreinsdata->date_prod = $newposDate;
                    $adjreinsdata->counter_number = $request->counter_number;
                    $adjreinsdata->layer_id = $request->layer_id;
                    $adjreinsdata->reins_id = $request->reins_id;
                    $adjreinsdata->reins_id2 = $request->reinsnumber;
                    $adjreinsdata->reinstatement = $request->reinstatement;
                    $adjreinsdata->nasre_share = $request->nasre_share;
                    $adjreinsdata->type = $request->typedata;
                    $adjreinsdata->position = $request->position;
                    $adjreinsdata->username = $request->username;
                    $adjreinsdata->transfer_date = $request->transferdate;
                    $adjreinsdata->save();
                    

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $subcontactdata = AdjsutmentInstallMindepReins::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($subcontactdata);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {

                        if ($sliplastid < 9) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "ADJREINSTATEMENT" .  $mydate . strval($sliplastid + 1);
                        }
                    }
                    else 
                    {
                        $code_sub = "ADJREINSTATEMENT" .  $mydate . "0000" . strval(1);
                    }
                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'id'=>$adjreinsdata->id,
                            'message' => 'Adj Reinstatement successfully!, but tsi changed. Must Change!!!',
                        ]
                    );
                }
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Adj Reinstatement Entry added Failed!',
                ]
            ); 
        }

    }


    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'masterid' => 'required',
            'masterdateentry' => 'required'
        ]);

        if ($validator) 
        {
                $user = Auth::user();
           
                $mindepdata = InstallMindep::where('number', $request->masterid)->first();
                
                if(empty($mindepdata))
                {
                    
                    $posdate =  $request->masterdateentry;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $mindepdataup = InstallMindep::create([
                        'number' => $request->masterid,
                        'date_entry' => $newposDate,
                        'user_id' => $user->id,
                        'user_name' => $request->masteruser,
                        'ceding_id' => $request->masterceding,
                        'ceding_type' => $request->mastercedingtype,
                        'ceding_name' => $request->mastercedingname,
                        'uwyear' => $request->masteruwyear,
                        'status'=>'active'
                    ]);


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = InstallMindepSubcontract::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval(1);
                    }

                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'message' => 'Master Contract  Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    $posdate =  $request->masterdateentry;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $mindepid = $mindepdata->id;
                    $mindepdata = InstallMindep::findOrFail($mindepid);
                    $mindepdata->date_entry = $newposDate;
                    $mindepdata->user_id = $user->id;
                    $mindepdata->user_name = $request->masteruser;
                    $mindepdata->ceding_id = $request->masterceding;
                    $mindepdata->ceding_type = $request->mastercedingtype;
                    $mindepdata->ceding_name = $request->mastercedingname;
                    $mindepdata->uwyear = $request->masteruwyear;

                    $mindepdata->save();
                    

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $subcontactdata = InstallMindepSubcontract::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($subcontactdata);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval(1);
                    }
                    
                    return response()->json(
                        [
                            'success' => true,
                            'code_sub'=>$code_sub,
                            'message' => 'Master Contract Upload Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Master Contract Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }

    public function getsubcontractdata(Request $request)
    {
        $validator = $request->validate([
            'submasterid' => 'required'
        ]);
        

        if ($validator) 
        {
            $user = Auth::user();

            $submindepdata = InstallMindepSubcontract::where('number_subcontract', $request->submasterid)->first();
            $mindepdata = InstallMindep::where('id', $submindepdata->master_id)->first();
            $cedingbroker = CedingBroker::where('id',$mindepdata->broker_id);
            $cedingcompany = CedingBroker::where('id',$submindepdata->ceding_id);

            $currdate2 = date("Y-m-d");
            $mydate = date("Y") . date("m") . date("d");
            $groupcobdata = InstallMindepCob::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
            $sliplastid = count($groupcobdata);

            if ($sliplastid != null) 
            {
                if ($sliplastid < 9) {
                    $code_groupcob = "GROUPCOBDATA" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_groupcob = "GROUPCOBDATA" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_groupcob = "GROUPCOBDATA" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_groupcob = "GROUPCOBDATA" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_groupcob = "GROUPCOBDATA" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_groupcob = "GROUPCOBDATA" .  $mydate . "0000" . strval(1);
            }
                
            return response()->json(
                [
                    'success' => true,
                    'code_groupcob'=>$code_groupcob,
                    'mastercontract' => $mindepdata,
                    'subcontract' => $submindepdata,
                    'cedingbroker' => $cedingbroker,
                    'cedingcompany' => $cedingcompany,
                    'message' => 'Sub COntract  Update successfully!, but tsi changed. Must Change!!!',
                ]
            );
            
        }
        else 
        {

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sub COntract  get data Failed!',
                ]
            );
           
        }

    }


    public function getgroupcobdata(Request $request)
    {
        $validator = $request->validate([
            'groucobid' => 'required'
        ]);
        

        if ($validator) 
        {
            $user = Auth::user();
            
            $cobmindepdata = InstallMindepCob::where('numbercob', $request->groucobid)->first();
            $submindepdata = InstallMindepSubcontract::where('id', $cobmindepdata->subcontract_id)->first();
            $mindepdata = InstallMindep::where('id', $cobmindepdata->installmindep_id)->first();
            $cedingbroker = CedingBroker::where('id',$mindepdata->broker_id);
            $cedingcompany = CedingBroker::where('id',$submindepdata->ceding_id);

            return response()->json(
                [
                    'success' => true,
                    'mastercontract' => $mindepdata,
                    'subcontract' => $submindepdata,
                    'groucob'=> $cobmindepdata,
                    'cedingbroker' => $cedingbroker,
                    'cedingcompany' => $cedingcompany,
                    'message' => 'Group Cob/Layer  Update successfully!, but tsi changed. Must Change!!!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Group Cob/Layer  get data Failed!',
                ]
            );
           
        }
    }


    public function getgrouplayerdata(Request $request)
    {
        $validator = $request->validate([
            'groucobidlayer' => 'required'
        ]);
        

        if ($validator) 
        {
            $user = Auth::user();
            
            $layermindepdata = InstallMindepLayer::where('id', $request->groucobidlayer)->first();
            $cobmindepdata = InstallMindepCob::where('id', $layermindepdata->groupcob_id)->first();
            $submindepdata = InstallMindepSubcontract::where('id', $cobmindepdata->subcontract_id)->first();
            $mindepdata = InstallMindep::where('id', $cobmindepdata->installmindep_id)->first();
            $cedingbroker = CedingBroker::where('id',$mindepdata->broker_id);
            $cedingcompany = CedingBroker::where('id',$submindepdata->ceding_id);

            return response()->json(
                [
                    'success' => true,
                    'mastercontract' => $mindepdata,
                    'subcontract' => $submindepdata,
                    'groucob'=> $cobmindepdata,
                    'layerdata'=> $layermindepdata,
                    'cedingbroker' => $cedingbroker,
                    'cedingcompany' => $cedingcompany,
                    'message' => 'Group Cob/Layer  Update successfully!, but tsi changed. Must Change!!!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Group Cob/Layer  get data Failed!',
                ]
            );
           
        }
    }


    public function getgroupdetailcobdata(Request $request)
    {
        $validator = $request->validate([
            'groucobdetailid' => 'required'
        ]);
        

        if ($validator) 
        {
            $user = Auth::user();
            
            $reinsdatalist = InstallMindepReins::where('detailcob_id', $request->groucobdetailid)->get();
            $cobdetailmindepdata = InstallMindepCobDetail::where('id', $request->groucobdetailid)->first();
            $layermindepdata = InstallMindepLayer::where('id', $cobdetailmindepdata->layer_id)->first();
            $cobmindepdata = InstallMindepCob::where('id', $layermindepdata->groupcob_id)->first();
            $submindepdata = InstallMindepSubcontract::where('id', $cobmindepdata->subcontract_id)->first();
            $mindepdata = InstallMindep::where('id', $cobmindepdata->installmindep_id)->first();
            $cedingbroker = CedingBroker::where('id',$mindepdata->broker_id);
            $cedingcompany = CedingBroker::where('id',$submindepdata->ceding_id);

            return response()->json(
                [
                    'success' => true,
                    'mastercontract' => $mindepdata,
                    'subcontract' => $submindepdata,
                    'groucob'=> $cobmindepdata,
                    'layerdata'=> $layermindepdata,
                    'cedingbroker' => $cedingbroker,
                    'cobdetailmindep'=> $cobdetailmindepdata,
                    'cedingcompany' => $cedingcompany,
                    'reinsdatalist' => $reinsdatalist->toJson(),
                    'message' => 'Group Cob/Layer  Update successfully!, but tsi changed. Must Change!!!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Group Cob Detail  get data Failed!',
                ]
            );
           
        }
    }


    
    public function getgroupreinstatementdata(Request $request)
    {
        $validator = $request->validate([
            'reinsid' => 'required'
        ]);
        

        if ($validator) 
        {
            $user = Auth::user();
            
            $ajdreinsdatalist = AdjsutmentInstallMindepReins::where('reins_id', $request->reinsid)->get();
            $reinsmindepdata = InstallMindepReins::where('id', $request->reinsid)->first();
            $cobdetailmindepdata = InstallMindepCobDetail::where('id', $reinsmindepdata->detailcob_id)->first();
            $layermindepdata = InstallMindepLayer::where('id', $cobdetailmindepdata->layer_id)->first();
            $adjustmentdata = AdjusmentInstallMindep::where('layer_id', $cobdetailmindepdata->layer_id)->orderby('id', 'desc')->first();
            $cobmindepdata = InstallMindepCob::where('id', $layermindepdata->groupcob_id)->first();
            $submindepdata = InstallMindepSubcontract::where('id', $cobmindepdata->subcontract_id)->first();
            $mindepdata = InstallMindep::where('id', $cobmindepdata->installmindep_id)->first();
            $cedingbroker = CedingBroker::where('id',$mindepdata->broker_id);
            $cedingcompany = CedingBroker::where('id',$submindepdata->ceding_id);

            return response()->json(
                [
                    'success' => true,
                    'mastercontract' => $mindepdata,
                    'subcontract' => $submindepdata,
                    'groucob'=> $cobmindepdata,
                    'layerdata'=> $layermindepdata,
                    'cedingbroker' => $cedingbroker,
                    'cobdetailmindep'=> $cobdetailmindepdata,
                    'reinsmindepdata' => $reinsmindepdata,
                    'adjustmentdata' => $adjustmentdata,
                    'ajdreinsdatalist' => $ajdreinsdatalist->toJson(),
                    'cedingcompany' => $cedingcompany,
                    'message' => 'Group Cob/Layer  Update successfully!, but tsi changed. Must Change!!!',
                ]
            );
            
        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Group Cob Detail  get data Failed!',
                ]
            );
           
        }
    }



    public function storesub(Request $request)
    {
        //
        $validator = $request->validate([
            'masterid' => 'required',
            'submasterid' => 'required'
        ]);

        if ($validator) 
        {
                $user = Auth::user();
           
                //$mindepdata = InstallMindep::where('number', $request->masterid)->first();
                
                $submindepdata = InstallMindepSubcontract::where('number_subcontract', $request->submasterid)->first();
                $mindepdata = InstallMindep::where('number', $request->masterid)->first();
                
                if(empty($submindepdata))
                {
                    
                    $posdate =  $request->submasterperiod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $posdate2 =  $request->submasterto;
                    $date2 = str_replace('/', '-', $posdate2);
                    $newposDate2 = date('Y-m-d', strtotime($date2));

                    $mindepdataup = InstallMindepSubcontract::create([
                        'master_number' => $request->masterid,
                        'master_id' => $mindepdata->id,
                        'ceding_id' => $request->submasterceding,
                        'ceding_name' => $request->submastercedingname,
                        'number_subcontract' => $request->submasterid,
                        'period_from' => $newposDate,
                        'period_to' => $newposDate2,
                        'subcontract_type' => $request->submastertype,
                        'status'=>'active'

                    ]);



                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $subcontactdata = InstallMindepSubcontract::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
                    $sliplastid = count($subcontactdata);
                    // dd($sliplastid);

                    if ($sliplastid != null) 
                    {
                        if ($sliplastid < 9) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sub = "SUBCONTRACT" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sub = "SUBCONTRACT" .  $mydate . "0000" . strval(1);
                    }


                    
                    return response()->json(
                        [
                            'success' => true,
                            'submindepdataup' => $mindepdataup,
                            'code_sub'=> $code_sub,
                            'message' => 'Sub COntract  Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    $posdate =  $request->submasterperiod;
                    $date = str_replace('/', '-', $posdate);
                    $newposDate = date('Y-m-d', strtotime($date));

                    $posdate2 =  $request->submasterto;
                    $date2 = str_replace('/', '-', $posdate2);
                    $newposDate2 = date('Y-m-d', strtotime($date2));

                    $submindepid = $submindepdata->id;
                    $submindepdata = InstallMindepSubcontract::findOrFail($submindepid);
                    $submindepdata->master_number = $request->masterid;
                    $submindepdata->ceding_id = $request->submasterceding;
                    $submindepdata->ceding_name = $request->submastercedingname;
                    $submindepdata->master_id = $mindepdata->id;
                    $submindepdata->period_from = $newposDate;
                    $submindepdata->period_to = $newposDate2;
                    $submindepdata->subcontract_type = $request->submastertype;
                   
                    $submindepdata->save();

                    
                    return response()->json(
                        [
                            'success' => true,
                            'submindepdataup' => $submindepdata,
                            'message' => 'Sub COntract  Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sub COntract  Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    public function storegroupcob(Request $request)
    {
        //
        $validator = $request->validate([
            'masterid' => 'required',
            'submasterid' => 'required',
            'groupcobid' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
                $submindepdata = InstallMindepSubcontract::where('number_subcontract', $request->submasterid)->first();
                $mindepdata = InstallMindep::where('number', $request->masterid)->first();
                $groupcobdata = InstallMindepCob::where('numbercob', $request->groupcobid)->first();
                
                if(empty($groupcobdata))
                {
                    
                    $groupcobdataup = InstallMindepCob::create([
                        'installmindep_id' => $mindepdata->id,
                        'installmindep_number'  => $mindepdata->number,
                        'subcontract_id' => $submindepdata->id,
                        'subcontract_number'  => $submindepdata->number_subcontract,
                        'cob_id' => $request->groupcobselect,
                        'cob_name' => $request->groupcobselecttext,
                        'numbercob' => $request->groupcobid,
                        'ogrpi' => $request->groupcobogrpi,
                        'treaty_type' => $request->groupcobtype,
                        'brokerage_value' => $request->groupcobbrokerage,
                        'brokerage_persentage' => $request->groupcobbrokeragepersen,
                        'status'=>'active'

                    ]);
                    
                    return response()->json(
                        [
                            'success' => true,
                            'id'=> $groupcobdataup->id,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
            
                    $groupcobdataid = $groupcobdata->id;
                    $groupcobdataup = InstallMindepCob::findOrFail($groupcobdataid);
                    $groupcobdataup->installmindep_id = $mindepdata->id;
                    $groupcobdataup->installmindep_number = $mindepdata->number;
                    $groupcobdataup->subcontract_id = $submindepdata->id;
                    $groupcobdataup->subcontract_number = $submindepdata->number_subcontract;
                    $groupcobdataup->cob_id = $request->groupcobselect;
                    $groupcobdataup->cob_name = $request->groupcobselecttext;
                    $groupcobdataup->ogrpi = $request->groupcobogrpi;
                    $groupcobdataup->treaty_type = $request->groupcobtype;
                    $groupcobdataup->brokerage_value = $request->groupcobbrokerage;
                    $groupcobdataup->brokerage_persentage = $request->groupcobbrokeragepersen;
                  
                    $groupcobdataup->save();

                    
                    return response()->json(
                        [
                            'success' => true,
                            'id'=> $groupcobdataup->id,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Group Cob Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }



    public function storelayer(Request $request)
    {
        //
        $validator = $request->validate([
            'groupcobidlayer' => 'required',
            'layerlevel' => 'required',
            'instlayer' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
                $groupcobdata = InstallMindepCob::where('numbercob', $request->groupcobidlayer)->first();
                 
                if(empty($request->layerid))
                {
                    
                    $layerdataup = InstallMindepLayer::create([
                        'layer_level' => $request->layerlevel,
                        'prem_rate'  => $request->premratelayer,
                        'inst' => $request->instlayer,
                        'status_layer'  => $request->statuslayer,
                        'uw_retention' => $request->uwlayer,
                        'mindep_rate' => $request->mindeplayer,
                        'limit_rate' => $request->limitlayer,
                        'premium_type' => $request->premiumtypelayer,
                        'reinstatement' => $request->reinstatementlayer,
                        'retro_share' => $request->retrosharelayer,
                        'check' => $request->checkboxlayer,
                        'nasre_share' => $request->nasresharelayer,
                        'liability' => $request->liabilitylayer,
                        'liability2' => $request->liabilitylayerext,
                        'md_premium' => $request->mdpremiumlayer,
                        'md_premium2' => $request->mdpremiumlayerext,
                        'aad_limit' => $request->aadlimitlayer,
                        'aa_deductible' => $request->aadeductiblelayer,
                        'groupcob_id' => $groupcobdata->id,
                        'groupcob_number' => $request->groupcobidlayer,
                        'transfer_date' => $request->transferdate,
                        'status'=>'active'

                    ]);
                    
                    return response()->json(
                        [
                            'success' => true,
                            'layerdata' => $layerdataup,
                            'message' => 'Layer Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
            
                    //$layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
               
                    $layerdataup = InstallMindepLayer::findOrFail($request->layerid);

                    $layerdataup->layer_level = $request->layerlevel;
                    $layerdataup->prem_rate = $request->premratelayer;
                    $layerdataup->inst = $request->instlayer;
                    $layerdataup->status_layer = $request->status_layer;
                    $layerdataup->uw_retention = $request->uwlayer;
                    $layerdataup->mindep_rate = $request->mindeplayer;
                    $layerdataup->limit_rate = $request->limitlayer;
                    $layerdataup->premium_type = $request->premiumtypelayer;
                    $layerdataup->reinstatement = $request->reinstatementlayer;
                    $layerdataup->retro_share = $request->retrosharelayer;
                    $layerdataup->check = $request->checkboxlayer;
                    $layerdataup->nasre_share = $request->nasresharelayer;
                    $layerdataup->liability = $request->liabilitylayer;
                    $layerdataup->liability2 = $request->liabilitylayerext;
                    $layerdataup->md_premium = $request->mdpremiumlayer;
                    $layerdataup->md_premium2 = $request->mdpremiumlayerext;
                    $layerdataup->aad_limit = $request->aadlimitlayer;
                    $layerdataup->aa_deductible = $request->aadeductiblelayer;
                    $layerdataup->groupcob_id = $groupcobdata->groupcobidlayer;
                    $layerdataup->groupcob_number = $request->groupcobidlayer;
                    $layerdataup->transfer_date = $request->transferdate;
                   
                    $layerdataup->save();

                    
                    return response()->json(
                        [
                            'success' => true,
                            'layerdata' => $layerdataup,
                            'message' => 'Layer Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Layer Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    public function storeinstatement(Request $request)
    {
        //
        $validator = $request->validate([
            'groupcobid' => 'required',
            'percentagereinstatement' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
                $groupcobdata = InstallMindepCob::where('numbercob', $request->groupcobid)->first();
                 
                if(empty($request->reinstatementid))
                {
                    
                    $reinstatementdataup = InstallMindepReinstatement::create([
                        'groupcob_id' => $groupcobdata->id,
                        'groupcob_number' => $request->groupcobid,
                        //'layer_id'  => $request->layerid,
                        'percentage_reinstatement' => $request->percentagereinstatement,
                        'reinstatement_number'  => $request->numberinstatement,
                        'status'=>'active'

                    ]);
                    
                    return response()->json(
                        [
                            'success' => true,
                            'groupcobdata'=>$groupcobdata,
                            'reinstatement'=>$reinstatementdataup,
                            'id'=>$reinstatementdataup->id,
                            'message' => 'Layer Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
            
                    //$layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
               
                    $reinstatementdataup = InstallMindepReinstatement::findOrFail($request->reinstatementid);

                    $reinstatementdataup->groupcob_id = $groupcobdata->id;
                    $reinstatementdataup->groupcob_number = $request->groupcobid;
                    //$reinstatementdataup->layer_id = $request->layerid;
                    $reinstatementdataup->percentage_reinstatement = $request->percentagereinstatement;
                    $reinstatementdataup->reinstatement_number = $request->numberinstatement;                  
                    $reinstatementdataup->save();

                    
                    return response()->json(
                        [
                            'success' => true,
                            'reinstatement'=>$reinstatementdataup,
                            'id'=>$reinstatementdataup->id,
                            'message' => 'Layer Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Layer Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    
    public function resetinstallmentdetail(Request $request)
    {
            $validator = $request->validate([
                'detailcobid' => 'required'
            ]);

            if($validator) 
            {
                    $user = Auth::user();
                
                    if(empty($request->detailcobid))
                    {
                    
                        return response()->json(
                            [
                                'success' => true,
                                'message' => 'Installment Detail Entry added Failed!',
                            ]
                        );

                    }
                    else 
                    {
                        
                        $mindeinstdetail = InstallMindepDetail::findOrFail($request->detailcobid);
                        $mindeinstdetail->amount = $mindeinstdetail->amountinst*-1;
                        $mindeinstdetail->save();


                        return response()->json(
                            [
                                'success' => true,
                                'id'=>$mindeinstdetail->id,
                                'mindepcobdetail'=>$mindeinstdetail,
                                'message' => 'Installment Detail Update successfully!, but tsi changed. Must Change!!!',
                            ]
                        );
                    }

            }
            else 
            {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Installment Detail Entry added Failed!',
                    ]
                );
                //return back()->with($validator)->withInput(); 

            }

    }



    public function storeadjusment(Request $request)
    {
        //
        $validator = $request->validate([
            'layerid' => 'required',
            'groupcob_number' => 'required',
            'position' => 'required',
            'due_date' => 'required'
        ]);

        if($validator) 
        {
                 $user = Auth::user();
                
                if(empty($request->adjusmentid))
                {
                    
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('numbercob', $layerdata->groupcob_number)->first();
    
                    $cedingbroker = CedingBroker::where('id',$request->brokerage)->first();
                    
                    $adjusmentdetail = AdjusmentInstallMindep::create([
                        'position' => $request->position,
                        'due_date' => $request->due_date,
                        'ogrpi' => $request->ogrpi,
                        'adjusment' => $request->adjusment,
                        'additional_premium' => $request->additional_premium,
                        'counter_number'=> $request->counter_number,
                        'brokerage'=> $request->brokeragepercentage,
                        'disc' => $request->discpecentage,
                        'net_add_premium' => $request->net_add_premium,
                        're_sharer' => $request->re_sharer,
                        'retro_share' => $request->retro_share,
                        'layer_id' => $request->layerid,
                        'groupcob_number' => $request->groupcob_number,
                        'detailcob_id' => $groupcobdata->id,
                        'broker_amount' => $request->brokerage,
                        'disc_amount' => $request->disc,
                        'position' => $request->position,
                        'transfer_date' => $request->adjtransferdate,
                        'status'=>'active'
                    ]);

                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$adjusmentdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'adjusmentdetail'=>$adjusmentdetail,
                            'message' => 'Adjusment Data Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('numbercob', $layerdata->groupcob_number)->first();
                
                    $cedingbroker = CedingBroker::where('id',$request->brokerage)->first();
                    

                    $adjusmentdetail = AdjusmentInstallMindep::findOrFail($request->detailcobid);
                    $adjusmentdetail->position = $request->position;
                    $adjusmentdetail->broker_name = $cedingbroker->name;
                    $adjusmentdetail->due_date = $request->due_date;
                    $adjusmentdetail->ogrpi = $request->ogrpi;
                    $adjusmentdetail->adjusment = $request->adjusment;
                    $adjusmentdetail->additional_premium = $request->additional_premium;
                    $adjusmentdetail->counter_number = $request->counter_number;
                    $adjusmentdetail->brokerage = $request->brokeragepercentage;
                    $adjusmentdetail->disc = $request->discpecentage;
                    $adjusmentdetail->net_add_premium = $request->net_add_premium;
                    $adjusmentdetail->re_sharer = $request->re_sharer;
                    $adjusmentdetail->retro_share = $request->retro_share;
                    $adjusmentdetail->layer_id = $request->layerid;
                    $adjusmentdetail->groupcob_number = $request->groupcob_number;
                    $adjusmentdetail->detailcob_id = $groupcobdata->id;
                    $adjusmentdetail->broker_amount = $request->brokerage;
                    $adjusmentdetail->disc_amount = $request->disc;
                    $adjusmentdetail->position = $request->position;
                    $adjusmentdetail->transfer_date = $request->adjtransferdate;
                    $adjusmentdetail->save();

                   
                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$adjusmentdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'adjusmentdetail'=>$adjusmentdetail,
                            'message' => 'Adjusment Data Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );
                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Adjusment Data Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    public function storeretrocob(Request $request)
    {
        //
        $validator = $request->validate([
            'groupcobid' => 'required',
            'retrocontract' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
               
                if(empty($request->retrocobid))
                {
                    
                    $groupcobdata = InstallMindepCob::where('numbercob', $request->groupcobid)->first();

                    $retrocobdataup = InstallMindepRetro::create([
                        'retrocontract' => $request->retrocontract,
                        'retropercent' => $request->retropercent,
                        'cob_id' => $groupcobdata->id,
                        'cob_name' => $request->groupcobid,
                        'status'=>'active'
                    ]);

                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$retrocobdataup->id,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    
                    $retrocobdataup = InstallMindepRetro::findOrFail($request->retrocobid);
                    $retrocobdataup->retrocontract = $request->retrocontract;
                    $retrocobdataup->retropercent = $request->retropercent;
                    $retrocobdataup->save();

                    
                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$retrocobdataup->id,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Group Cob Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    
    public function storedetailcob(Request $request)
    {
        //
        $validator = $request->validate([
            'layerid' => 'required',
            'detailcob' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
               
                if(empty($request->detailcobid))
                {
                    
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('id', $layerdata->groupcob_id)->first();
                    
                    $hasildata=0;
                    if(!empty($request->ogrpicob))
                    {
                        $persendata=1;
                        $amountdata=1;

                        if(is_numeric($request->ogrpicobpercentage))
                        {
                            $persendata=$request->ogrpicobpercentage;
                        }
                        else
                        {
                            $persendata=1;
                        }
                        
                        if(is_numeric($layerdata->md_premium))
                        {
                            $amountdata=$layerdata->md_premium;
                        }
                        else
                        {
                            $amountdata=1;  
                        }

                        $hasildata=($persendata*$amountdata)/100;
                    }
                    else
                    {
                        $hasildata=0;
                    }
                    
                    if(!empty($request->ogrpicob))
                    {
                        $hasildata=$request->ogrpicob;
                    }
                    

                    $mindepcobdetail = InstallMindepCobDetail::create([
                        'detailcob_id' => $request->detailcob,
                        'ogrpi_percentage' => $request->ogrpicobpercentage,
                        'share_percentage' => $layerdata->nasre_share,
                        'groupcob' => $groupcobdata->cob_name,
                        'ogrpi_amount'=> $hasildata,
                        'mindep_amount'=> $layerdata->md_premium,
                        'businesssource' => $request->flag_overseas,
                        'businesstype' => $request->businessid,
                        'max_acceptance' => $request->maximum_acceptence,
                        'layer_id'=>$request->layerid,
                        'status'=>'active'
                    ]);

                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$mindepcobdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'mindepcobdetail'=>$mindepcobdetail,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('id', $layerdata->groupcob_id)->first();
                   
                    $hasildata=0;
                    if(!empty($request->ogrpicobpercentage))
                    {
                        $persendata=$request->ogrpicob;
                        $hasildata=($persendata*$layerdata->md_premium)/100;
                    }
                    else
                    {
                        $hasildata=0;
                    }

                    if(!empty($request->ogrpicob))
                    {
                        $hasildata=$request->ogrpicob;
                    }
                    

                    $mindepcobdetail = InstallMindepCobDetail::findOrFail($request->detailcobid);
                    $mindepcobdetail->detailcob_id = $request->detailcob;
                    $mindepcobdetail->ogrpi_percentage = $request->ogrpicobpercentage;
                    $mindepcobdetail->share_percentage = $layerdata->nasre_share;
                    $mindepcobdetail->groupcob = $groupcobdata->cob_name;
                    $mindepcobdetail->ogrpi_amount = $hasildata;
                    $mindepcobdetail->mindep_amount = $layerdata->md_premium;
                    $mindepcobdetail->businesssource = $request->flag_overseas;
                    $mindepcobdetail->businesstype = $request->businessid;
                    $mindepcobdetail->max_acceptance=$request->maximum_acceptence;
                    $mindepcobdetail->save();


                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$mindepcobdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'mindepcobdetail'=>$mindepcobdetail,
                            'message' => 'Group Cob Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );
                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Layer Detail Cob Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

    }


    public function storeinstallmentdetail(Request $request)
    {
        //
        $validator = $request->validate([
            'layerid' => 'required',
            'counternumberinst' => 'required'
        ]);

        if($validator) 
        {
                $user = Auth::user();
            
               
                if(empty($request->installmentdetailid))
                {
                    
                
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('id', $layerdata->groupcob_id)->first();
                    
                    
                    $mindeinstdetail = InstallMindepDetail::create([
                        'counter_number' => $request->counternumberinst,
                        'due_date' => $request->duedateinst,
                        'gross' => $request->grossinst,
                        'rep_date' => $request->repdateinst,
                        'broker' => $request->brokerinst,
                        'broker_id' => $request->brokerinst,
                        'pct_persentage'=> $request->pctinst,
                        'amount'=> $request->amountinst,
                        'ppw_days' => $request->ppwdaysinst,
                        'layer_id' => $request->layerid,
                        'status'=>'active'
                    ]);

                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$mindeinstdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'mindepcobdetail'=>$mindeinstdetail,
                            'message' => 'Installment Detail Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );

                }
                else 
                {
                    
                    $layerdata = InstallMindepLayer::where('id', $request->layerid)->first();
                    $groupcobdata = InstallMindepCob::where('id', $layerdata->groupcob_id)->first();
                   
                

                    $mindeinstdetail = InstallMindepDetail::findOrFail($request->installmentdetailid);
                    $mindeinstdetail->counter_number = $request->counternumberinst;
                    $mindeinstdetail->due_date = $request->duedateinst;
                    $mindeinstdetail->gross = $request->grossinst;
                    $mindeinstdetail->rep_date = $request->repdateinst;
                    $mindeinstdetail->broker = $request->brokerinst;
                    $mindeinstdetail->broker_id = $request->brokerinst;
                    $mindeinstdetail->pct_persentage = $request->pctinst;
                    $mindeinstdetail->amount = $request->amountinst;
                    $mindeinstdetail->ppw_days = $request->ppwdaysinst;
                    $mindeinstdetail->layer_id = $request->layerid;
                    $mindeinstdetail->save();


                    return response()->json(
                        [
                            'success' => true,
                            'id'=>$mindeinstdetail->id,
                            'groupcob'=>$groupcobdata,
                            'layerdata'=>$layerdata,
                            'mindepcobdetail'=>$mindeinstdetail,
                            'message' => 'Installment Detail Update successfully!, but tsi changed. Must Change!!!',
                        ]
                    );
                }


        }
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Installment Detail Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();
            
        }

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
        $accu = InstallMindep::findOrFail($id);

        //$datasub = InstallMindepSubcontract::where('master_id','=',$id)->first();

        //if(empty($datasub))
        //{
                if($accu->delete()) 
                {
                    $notification = array(
                        'message' => 'Install Mindep deleted successfully!',
                        'alert-type' => 'success'
                    );

                    //return back()->with($notification);
                    return redirect('treaty/nonprop/list')->with('message', 'Install Mindep deleted successfully!');
                } 
                else 
                {
                    $notification = array(
                        'message' => 'Contact admin!',
                        'alert-type' => 'error'
                    );

                    //return back()->with($notification);
                    return redirect('treaty/nonprop/list')->with('message', 'Error Contact Admin');
                }
        /*
        }
        else 
        {    
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );

            return redirect('treaty/nonprop/list')->with('message', 'Masih Terdapat Data SubContract');
        }
        */
    }


    public function entry(Request $request)
    {
        if(!empty($request->id)) 
        {
            $mindep = InstallMindep::where('id',base64_decode($request->id))->first();
        }
        
        $route_active = 'TREATY & RETROCESSION Summary Non Prop Mindep - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        $ceding2 = CedingBroker::all();

        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $mindep_now = InstallMindep::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();              
        $business_type = BusinessType::orderBy('id','asc')->get();
        $lastid = count($mindep_now);


        if ($lastid != null) 
        {
            if ($lastid < 9) {
                $code_ms = "Master" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "Master" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "Master" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "Master" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "Master" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "Master" . $mydate . "0000" . strval(1);
        }

        
        $datatest=InstallMindep::where('number','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "Master" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "Master" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "Master" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "Master" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "Master" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "Master" . $mydate . "0000" . strval(1);
            }
        }


        if(empty($mindep))
        {
            return view('crm.transaction.treaty.nonprop.entry', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'business_type',
                'code_ms',
                'ceding',
            ));
        }
        else
        {
            return view('crm.transaction.treaty.nonprop.entryedit', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'business_type',
                'mindep',
                'ceding',
            ));
        }


    }


    public function adjentry(Request $request)
    {
        if(!empty($request->id)) 
        {
            $ajdmindep = InstallMindepLayer::where('id',base64_decode($request->id))->first();
        }
        
        $route_active = 'TREATY & RETROCESSION Summary Non Prop Mindep - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        $ceding2 = CedingBroker::all();

        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $mindep_now = InstallMindep::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();              
        $business_type = BusinessType::orderBy('id','asc')->get();
        $lastid = count($mindep_now);


        if(empty($ajdmindep))
        {
            /*
            return view('crm.transaction.treaty.nonprop.adjentry', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'business_type',
                'ceding',
            ));
            */
        }
        else
        {
            return view('crm.transaction.treaty.nonprop.adjentry', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'business_type',
                'ajdmindep',
                'ceding',
            ));
        }

    }

    public function detailinstallmentmindep()
    {
        $route_active = 'TREATY & RETROCESSION Summary Prop - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.nonprop.detail_mindep', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function detailcobmindep()
    {
        $route_active = 'TREATY & RETROCESSION Summary Prop - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.nonprop.detail_cobmindep', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }



    public function list(Request $request)
    {
        $route_active = 'TREATY & RETROCESSION Summary Non Prop - List';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();

        $treatyyeardata = @$request->input('treatyyear');
        $prodyeardata = @$request->input('prodyear');
        $ceding_brokerdata = @$request->input('ceding_broker');
        $ceding_companydata = @$request->input('ceding_company');
        $cob_inputdata = @$request->input('cob_input');
        $koc_inputdata = @$request->input('koc_input');
        $search = @$request->input('search');
        
        if (!empty($search) || !empty($treatyyeardata) || !empty($prodyeardata)  || !empty($ceding_brokerdata)  || !empty($ceding_companydata) || !empty($cob_inputdata) || !empty($koc_inputdata)) {

            $query = InstallMindep::query();

            if (!empty($search)) {
                $query = $query->where('number', 'LIKE', '%' . $search);
            }

            if (!empty($treatyyeardata)) {
                $query = $query->where('uw', $treatyyeardata);
            }

            if (!empty($prodyeardata)) {
                $query = $query->where('date_prod', $prodyeardata);
            }

            if (!empty($ceding_brokerdata)) {
                $query = $query->where('broker_id', $ceding_brokerdata);
            }

            if (!empty($ceding_companydata)) {
                $query = $query->where('ceding_id', $ceding_companydata);
            }

            if (!empty($cob_inputdata)) {
                $query = $query->where('cob_id', $cob_inputdata);
            }

            if (!empty($koc_inputdata)) {
                $query = $query->where('koc_id', $koc_inputdata);
            }


            // $accu = Accumulation::all();
            $installmindep = $query->get();

            $installmindep_ids = response()->json($installmindep->modelKeys());
        } 
        else 
        {
            $installmindep = InstallMindep::all();
        }


        $adjusmentInstallMindep = AdjusmentInstallMindep::all();


        return view('crm.transaction.treaty.nonprop.list', compact(
            'route_active',
            'installmindep',
            'adjusmentInstallMindep',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));

    }



    public function mindep(Request $request)
    {
        $route_active = 'TREATY & RETROCESSION Summary Non Prop Adj Mindep - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();

    
        $treatyyeardata = @$request->input('treatyyear');
        $prodyeardata = @$request->input('prodyear');
        $ceding_brokerdata = @$request->input('ceding_broker');
        $ceding_companydata = @$request->input('ceding_company');
        $cob_inputdata = @$request->input('cob_input');
        $koc_inputdata = @$request->input('koc_input');
        $search = @$request->input('search');
        
        if (!empty($search) || !empty($treatyyeardata) || !empty($prodyeardata)  || !empty($ceding_brokerdata)  || !empty($ceding_companydata) || !empty($cob_inputdata) || !empty($koc_inputdata)) {

            $query = InstallMindepLayer::query();

            if (!empty($search)) {
                $query = $query->where('number', 'LIKE', '%' . $search);
            }

            if (!empty($treatyyeardata)) {
                $query = $query->where('uw', $treatyyeardata);
            }

            if (!empty($prodyeardata)) {
                $query = $query->where('date_prod', $prodyeardata);
            }

            if (!empty($ceding_brokerdata)) {
                $query = $query->where('broker_id', $ceding_brokerdata);
            }

            if (!empty($ceding_companydata)) {
                $query = $query->where('ceding_id', $ceding_companydata);
            }

            if (!empty($cob_inputdata)) {
                $query = $query->where('cob_id', $cob_inputdata);
            }

            if (!empty($koc_inputdata)) {
                $query = $query->where('koc_id', $koc_inputdata);
            }


            // $accu = Accumulation::all();
            $adjinstallmindep = $query->get();

            $adjinstallmindep_ids = response()->json($adjinstallmindep->modelKeys());
        } 
        else 
        {
            $adjinstallmindep = InstallMindepLayer::all();
        }



        return view('crm.transaction.treaty.nonprop.listmindep', compact(
            'route_active',
            'adjinstallmindep',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    
    }


    public function reinstatement()
    {
        $route_active = 'TREATY & RETROCESSION Summary Non Prop Reinstatement - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.nonprop.instatement', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function adjinstatement()
    {
        $route_active = 'TREATY & RETROCESSION Summary Non Prop Adj Reinstatement - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.nonprop.adjinstatement', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function entry_v2()
    {
        $route_active = 'TREATY & RETROCESSION Summary Prop - Entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.nonprop.v2.entry', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function destroysubmaster($id)
    {
        //
        $accu = InstallMindepSubcontract::findOrFail($id);

        $groupcobdata = InstallMindepCob::where('subcontract_id','=',$id)->first();

        if(empty($groupcobdata))
        {
            if ($accu->delete()) 
            {
                
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Sub Master deleted successfully!',
                        'alert-type' => 'success'
                    ]
                );
            } 
            else 
            {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Sub Master deleted Failed!',
                        'alert-type' => 'error'
                    ]
                );
            
            }
        }
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Sub Master deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        }
    }


    public function destroygroupcob($id)
    {
        //
        $accu = InstallMindepCob::findOrFail($id);
        
        $layerdata = InstallMindepLayer::where('groupcob_id','=',$id)->first();

        if(empty($layerdata))
        {
            if ($accu->delete()) 
            {
                
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Group cob deleted successfully!',
                        'alert-type' => 'success'
                    ]
                );
            } 
            else 
            {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Group COB deleted Failed!',
                        'alert-type' => 'error'
                    ]
                );
            
            }

        }
        else
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Group COB deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        }
    
    }


    public function destroyretro($id)
    {
        //
        $accu = InstallMindepRetro::findOrFail($id);

        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Retro deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Retro deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
           
        }
    }


    public function destroylayer($id)
    {
        //
        $accu = InstallMindepLayer::findOrFail($id);

        $adjdata = AdjusmentInstallMindep::where('layer_id','=',$id)->first();
        $installmentdetail = InstallMindepDetail::where('layer_id','=',$id)->first();
        $cobmindepdetail = InstallMindepCobDetail::where('layer_id','=',$id)->first();

        if(empty($adjdata) && empty($installmentdetail) && empty($cobmindepdetail))
        {
            if ($accu->delete()) 
            {
                
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Layer deleted successfully!',
                        'alert-type' => 'success'
                    ]
                );
            } 
            else 
            {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Layer deleted Failed!',
                        'alert-type' => 'error'
                    ]
                );
            
            }

        }
        else {
            # code...
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Layer deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        }

    }


    public function destroyreinstatement($id)
    {
        //
        $accu = InstallMindepReinstatement::findOrFail($id);

        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Installment deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Installment deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        
        }
    }


    public function destroyadjinstallment($id)
    {
        //
        $accu = AdjusmentInstallMindep::findOrFail($id);

        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Installment deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Installment deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        
        }
    }



    public function destroydetailinstallment($id)
    {
        //
        $accu = InstallMindepDetail::findOrFail($id);

        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Installment deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Installment deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
           
        }
    }


    public function destroydetailcob($id)
    {
        //
        $accu = InstallMindepCobDetail::findOrFail($id);

        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Installment deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Installment deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
           
        }
    }


    public function destroyreins($id)
    {
        $accu = InstallMindepReins::findOrFail($id);

        if ($accu->delete()) 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Reinstatement deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        } 
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Reinstatement deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        }
    }

    public function destroyadjreins($id)
    {
        $accu = AdjsutmentInstallMindepReins::findOrFail($id);
        if ($accu->delete()) 
        {
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Adjustment Reinstatement deleted successfully!',
                    'alert-type' => 'success'
                ]
            );
        }
        else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Adjustment Reinstatement deleted Failed!',
                    'alert-type' => 'error'
                ]
            );
        }
    }
    

}
