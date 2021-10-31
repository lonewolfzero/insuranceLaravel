<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Customer\Customer;
use App\Models\FeLookupLocation;
use App\Models\SlipTable;
use App\Models\SlipTableFile;
use App\Models\SlipTableFileTemp;
use App\Models\User;
use App\Models\EarthQuakeZone;
use App\Models\FloodZone;
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
use App\Models\TransProperty;
use App\Models\TransPropertyTemp;
use App\Models\Insured;
use App\Models\InterestInsured;
use App\Models\InterestInsuredTemp;
use App\Models\InstallmentTemp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DeductibleType;
use App\Models\ExtendedCoverage;
use App\Models\ExtendCoverageTemp;
use App\Models\DeductibleTemp;
use App\Models\PropertyType;
use App\Models\PropertyTypeTemp;
use App\Models\PrefixInsured;
use App\Models\InsuredNumber;
use App\Models\SlipNumber;
use App\Models\StatusLog;
use App\Models\RetrocessionTemp;
use App\Models\RiskLocationDetail;
use App\Models\CurrencyExchange;

class MovePropSlipController extends Controller
{

    public function getCountries(){
        $countries = DB::table('countries')->get();
        return response()->json([
            'message'=>'success',
            'countries'=>$countries
        ]);
    }

    public function getStates(Request $request, $id){
        if($request->ajax())
            return DB::table('states')->where(['country_id'=> $id])->get();
        else{
            return 0;
        }
    } 
    
    public function getCities(Request $request, $id){
        if($request->ajax())
            return DB::table('cities')->where(['state_id'=> $id])->get();
        else{
            return 0;
        }
    }

    public function getStateList(Request $request)
    {
        $states = DB::table("states")
        ->where("country_id",$request->country_id)
        ->pluck("name","id");
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
        ->where("state_id",$request->state_id)
        ->pluck("name","id");
        return response()->json($cities);
    }


    public function getCostumers(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $costumers = Customer::orderby('company_name','asc')->select('id','company_name')->limit(10)->get();
        }else{
           $costumers = Customer::orderby('company_name','asc')->select('id','company_name')->where('company_name', 'like', '%' .$search . '%')->limit(10)->get();
        }
  
        $response = array();
        foreach($costumers as $costumer){
           $response[] = array("value"=>$costumer->id,"label"=>$costumer->company_name);
        }
  
        return response()->json($response);
     }
    

    public function index(Request $request)
    {
         $user = Auth::user();
         $country = User::orderby('id','asc')->get();
         $route_active = 'Moveable Property - Index';   
         $mydate = date("Y").date("m").date("d");
         $fe_ids = response()->json($country->modelKeys());
         $search = @$request->input('search');
         $searchinsured = @$request->input('searchinsured');
         $searchuy = @$request->input('searchuy');
         $searchshare = @$request->input('searchshare');
         $searchnre = @$request->input('searchnre');
         $searchtsi = @$request->input('searchtsi');
         $searchendorse = @$request->input('searchendorse');
         $searchslipnum = @$request->input('searchslipnum');
         $searchcob = @$request->input('searchcob');
         $searchceding = @$request->input('searchceding');

         $checkdatainsured= Insured::where('statmodified','=',1)->whereNull('share_to')->Where('share_to','=',0)->get();


        foreach ($checkdatainsured as $insureddata)
        {
            //$deleteinsured= SlipTable::where('insured_id','=',$insureddata->number)->delete();
            $deleteinsured= Insured::where('number','=',$insureddata->number)->delete();  
        }

        
        if(!empty($search) || !empty($searchinsured) || !empty($searchuy) || !empty($searchshare) || !empty($searchnre) || !empty($searchtsi) || !empty($searchendorse))
        {

            $query = Insured::query();

            if (!empty($search)) {
                $query = $query->where('number', $search);
            }

            if (!empty($searchinsured)) {
                $query = $query->where('insured_name', $searchinsured);
            }

            if (!empty($searchuy)) {
                $query = $query->where('uy', $searchuy);
            }

            if (!empty($searchshare)) {
                $query = $query->where('share', $searchshare);
            }

            if (!empty($searchnre)) {
                $query = $query->where('share_from', $searchnre);
            }

            if (!empty($searchtsi)) {
                $query = $query->where('share_to', $searchtsi);
            }

            if (!empty($searchendorse)) {
                $query = $query->where('count_endorsement', $searchendorse);
            }

            // Ordering
            $query = $query->where('slip_type', '=', 'mp')->orderBy('id', 'DESC');
            
            $insured =$query->paginate(50);

            $insured_ids = response()->json($insured->modelKeys());
    
            $slip = SlipTable::where('slip_type', '=', 'mp')->orWhere('number', 'LIKE', '%' . @$search . '%')->orderby('id','desc')->paginate(10);
            $slip_ids = response()->json($insured->modelKeys());

            $insuredlist=[];
            foreach (@$insured as $insureddata)
            {
                   $queryslip = SlipTable::query();
                   
                   if (!empty($searchslipnum)) 
                   {
                    $queryslip = $queryslip->where('number', $searchslipnum);
                   }

                   if (!empty($searchcob)) 
                   {
                    $queryslip = $queryslip->where('cob', $searchcob);
                   }

                   if (!empty($searchceding)) 
                   {
                    $queryslip = $queryslip->where('source', $searchceding);
                   }

                   $slipdata=$queryslip->where('insured_id', '=', $insureddata->number)->get()->toArray();
                   
                   $sliplist=[];
                   foreach($slipdata as $value)
                   {
                     $value['cobdata']=COB::where('id','=',$value['cob'])->first();
                     $value['brokerdata']=CedingBroker::where('id','=',$value['source'])->first();
                     $value['cedingdata']=CedingBroker::where('id','=',$value['source_2'])->first();

                     array_push($sliplist,$value);
                   }
                
                   $insureddata->slipdata=$sliplist;
                
                if(!empty($sliplist))
                {
                  array_push($insuredlist,$insureddata);
                }
            }

            $cob = COB::orderby('id','asc')->get();
            $cedingbroker = CedingBroker::orderby('id','asc')->get();
            $ceding = CedingBroker::orderby('id','asc')->where('type',4)->get();

            
            return view('crm.transaction.mp_slip_index', compact('searchslipnum','searchcob','searchceding','search','searchinsured','searchuy','searchshare','searchnre','searchtsi','searchendorse','cob','cedingbroker','ceding','insuredlist','user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
            

         }
         else
         {
          
            //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            $insured = Insured::where('slip_type', '=', 'mp')->orderby('id','desc')->paginate(10);
            $insured_ids = response()->json($insured->modelKeys());

            $slip = SlipTable::where('slip_type', '=', 'mp')->orderby('id','desc')->paginate(10);
            $slip_ids = response()->json($insured->modelKeys());
            
            $insuredlist=[];
            foreach (@$insured as $insureddata)
            {
                    $slipdata=SlipTable::where('insured_id', '=', $insureddata->number)->get()->toArray();
                    
                    $sliplist=[];
                    foreach($slipdata as $value)
                    {
                    $value['cobdata']=COB::where('id','=',$value['cob'])->first();
                    $value['brokerdata']=CedingBroker::where('id','=',$value['source'])->first();
                    $value['cedingdata']=CedingBroker::where('id','=',$value['source_2'])->first();

                    array_push($sliplist,$value);
                    }
                
                    $insureddata->slipdata=$sliplist;
                
                array_push($insuredlist,$insureddata);
            }

            $cob = COB::orderby('id','asc')->get();
            $cedingbroker = CedingBroker::orderby('id','asc')->get();
            $ceding = CedingBroker::orderby('id','asc')->where('type',4)->get();

            return view('crm.transaction.mp_slip_index', compact('searchslipnum','searchcob','searchceding','search','searchinsured','searchuy','searchshare','searchnre','searchtsi','searchendorse','cob','cedingbroker','ceding','insuredlist','user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
            
        }
    }


    public function getdetailSlip($idm)
    {
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $idm)->first();


        if (!empty($slipdata->deductible_panel) && strlen($slipdata->deductible_panel) > 10) {
            $deductibledata = json_decode($slipdata->deductible_panel);
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

        $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));

        // $currdate = date("d/m/Y");



        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','fe')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mp')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();


        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mp')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        $sum_permilec = DB::table('extended_coverage_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mp')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('minus','false')
            ->where('deleted_at', null)
            ->sum('extended_coverage_detail.percentage');

        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mp')
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

    public function getdetailEndorsementSlip($idm)
    {
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $idm)->first();

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


        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','fe')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mp')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();

        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mp')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        $sum_permilec = DB::table('extended_coverage_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mp')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('extended_coverage_detail.percentage');

        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mp')
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


    
    //$propertytype= PropertyType::orderby('id','asc')->get();
    public function indexmpslip()
    {
        
        $user = Auth::user();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'Moveable Property - Slip Entry';
        $mydate = date("Y") . date("m") . date("d");
        $costumer = Customer::orderby('id', 'asc')->get();

        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        // $currdate = date("d/m/Y");
        $insured = Insured::orderby('id', 'asc')->get();
        $insured_now = Insured::whereDate('created_at',$currdate2)->orderby('id','asc')->get();
        //$insured_now = Insured::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();

        $year=date('Y');

        $currency = CurrencyExchange::where('year','=',$year)->join('currencies','currencies_exc.currency',"=","currencies.id")->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        
        if(empty($currency))
        {
            $currency = CurrencyExchange::join('currencies','currencies_exc.currency',"=","currencies.id")->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        }

        $cob = COB::where('form', 'mp')->orderby('id', 'asc')->get();
        $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('code', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
        $broker = CedingBroker::orderby('id', 'asc')->where('type', '5')->get();
        $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
        // $felookup = FelookupLocation::distinct()->orderby('id','asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();

        // $felookup = DB::table('mp_lookup_location')
        //             ->join('countries','countries.id','=','mp_lookup_location.country_id')
        //             ->select('mp_lookup_location.*','countries.code','countries.name')        
        //             ->orderby('id','asc')
        //             ->distinct('mp_lookup_location.country_id')
        //             ->get();

        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $extendedcoverage = ExtendedCoverage::orderby('id', 'asc')->get();

        $fe_ids = response()->json($insured->modelKeys());
        $lastid = count($insured_now);

        if ($lastid != null) {
            if ($lastid < 9) {
                $code_ms = "IN" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "IN" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "IN" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "IN" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "IN" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "IN" . $mydate . "0000" . strval(1);
        }


        $brokerchoice = DB::table('risk_location_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                        ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                        ->where('trans_location_detail.insured_id', '=', $code_ms)
                        ->orWhere('ceding_broker.type', '=', 5)
                        ->select('risk_location_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->distinct()
                        ->get();


        $slipdata = SlipTable::where('insured_id', $code_ms)->first();
        $slipdatadistict = SlipTable::select('number')->distinct()->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mp')->get();
       
        $slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mp')->get();
       
        // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mp')->where('insured_id',$code_ms)->orderby('id','asc')->get();
        $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $code_ms)->orderby('id', 'asc')->get();
        $sliplastid = count($slip_now);
        // dd($sliplastid);

        if ($sliplastid != null) {
            if ($sliplastid < 9) {
                $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
            } elseif ($sliplastid > 8 && $sliplastid < 99) {
                $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
            } elseif ($sliplastid > 98 && $sliplastid < 999) {
                $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
            } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
            } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
            }
        } else {
            $code_sl = "MP" .  $mydate . "0000" . strval(1);
        }

        $maxdata = SlipTable::select('endorsment')->where('insured_id', $code_ms)->where('number', $code_sl)->where('slipshow', 'yes')->where('slip_type', 'mp')->orderby('endorsment','desc')->first();

        $checkinsurednumber = InsuredNumber::where('number', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->first();
        // $insurednumform = '';
        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->first();
        // $slipnumform = '';
        if ($checkinsurednumber != null) {

            if ($checkslipnumber != null) {



                $insurednumform = $code_ms;
                $slipnumform = $code_sl;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                
                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type','mp')->where('status','passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status','passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();


                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'passive')->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $propertytype= PropertyType::orderby('id','asc')->get();

                return view('crm.transaction.mp_slip', compact(['maxdata','slipdatadistict','propertytype','propertytypelist','brokerchoice','broker','prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
            } 
            elseif ($checkslipnumber == null) 
            {


                $insurednumform = $code_ms;

                $reservedslipnumber = SlipNumber::create([
                    'number' => $code_sl,
                    'slip_type' => 'mp',
                    'status' => 'passive',
                    'insured_number' => $code_ms
                ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type','mp')->where('status','passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status','passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();


                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $propertytype= PropertyType::orderby('id','asc')->get();

                return view('crm.transaction.mp_slip', compact(['maxdata','slipdatadistict','propertytype','propertytypelist','brokerchoice','broker','prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
            }
        } elseif ($checkinsurednumber == null) {


            if ($checkslipnumber != null) {

                InsuredNumber::where('number', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->delete();

                $reservedinsurednumber = InsuredNumber::create([
                    'number' => $code_ms,
                    'status' => 'passive',
                    'slip_type' => 'mp'
                ]);

                $insurednumform = $reservedinsurednumber->number;

                $slipnumform = $code_sl;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type','mp')->where('status','passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status','passive')->delete();
                }


                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();

                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $propertytype= PropertyType::orderby('id','asc')->get();

                return view('crm.transaction.mp_slip', compact(['maxdata','slipdatadistict','propertytype','propertytypelist','brokerchoice','broker','prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
           
            } elseif ($checkslipnumber == null) {

                InsuredNumber::where('number', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->delete();
                // dd($code_ms);
                $reservedinsurednumber = InsuredNumber::create([
                    'number' => $code_ms,
                    'status' => 'passive',
                    'slip_type' => 'mp'
                ]);

                $insurednumform = $reservedinsurednumber->number;

                $reservedslipnumber = SlipNumber::create([
                    'number' => $code_sl,
                    'slip_type' => 'mp',
                    'status' => 'passive',
                    'insured_number' => $code_ms
                ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type','mp')->where('status','passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status','passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();

                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $propertytype= PropertyType::orderby('id','asc')->get();

                return view('crm.transaction.mp_slip', compact(['maxdata','slipdatadistict','propertytype','propertytypelist','brokerchoice','broker','prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
            }
        }

    }


  
    public function updatempslip($idm)
    {
        $user = Auth::user();
        //print_r($user);
        //exit();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'Moveable Property - Slip Entry';
        $mydate = date("Y") . date("m") . date("d");
        $costumer = Customer::orderby('id', 'asc')->get();
        $cur_year = date("Y");
        $cur_month = date("m");
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $insured = Insured::orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();

        $currency = CurrencyExchange::join('currencies','currencies_exc.currency',"=","currencies.id")->where('currencies_exc.year',$cur_year)->where('currencies_exc.month',$cur_month)->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();

        $cob = COB::orderby('id', 'asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
        $broker = CedingBroker::orderby('id', 'asc')->where('type', 5)->get();

        $prefixinsured =  PrefixInsured::orderby('id', 'asc')->get();
        // $felookup = FelookupLocation::orderby('id','asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $extendedcoverage = ExtendedCoverage::orderby('id', 'asc')->get();

        $fe_ids = response()->json($insured->modelKeys());

        $insureddata = Insured::find($idm);
        $brokerchoice = DB::table('risk_location_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                        ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                        ->where('trans_location_detail.insured_id', '=', $insureddata->number)
                        ->where('trans_location_detail.slip_type', '=', 'mp')
                        ->orWhere('ceding_broker.type', '=', 5)
                        ->select('risk_location_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->distinct()
                        ->get();

        $sumperceding = DB::table('risk_location_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                        ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                        ->where('trans_location_detail.insured_id', '=', $insureddata->number)
                        ->where('trans_location_detail.slip_type', '=', 'mp')
                        ->select(DB::raw('sum(risk_location_detail.amountlocation) as amountlocation'),'ceding_broker.name', DB::raw('sum(risk_location_detail.percentage) as percentage'))
                        ->groupBy('ceding_broker.name')
                        ->orderBy('ceding_broker.name','asc')
                        ->get();

        // dd($sumperceding);
        $code_ms = $insureddata->number;
        $slipdata = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mp')->first();
        // $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('slip_type', 'mp')->orderBy('endorsment','desc')->get();

        $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mp')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->get();
        // $slipdatadistict = DB::table('slip_table')->select('slip_table.*')->where('slip_table.insured_id', $insureddata->number)->where('slip_table.selisih', 'false')->where('slip_table.slipshow', 'yes')->where('slip_table.slip_type', 'fe')->distinct('slip_table.number')->get();
        //$slipdatadistict = SlipTable::select('number')->distinct()->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'fe')->get();
        
        $dataslipdistict = collect(SlipTable::where('insured_id',$insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mp')->get());
        $slipdatadistict = $dataslipdistict->unique('number');
        $slipdatadistict->values()->all();
        // dd($slipdata2);

        if (!empty($slipdata)) {
            $code_sl = $slipdata->number;
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mp')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mp')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
            // dd($slip_now);
            $sliplastid = count($slip_now);
            // dd($sliplastid);
            $kondisi = false;
            $i = 1;
            while ($kondisi == false) {
                $slipdatatest = SlipTable::where('number', $code_sl)->first();
                if (empty($slipdatatest) || $slipdatatest == NULL) {
                    $kondisi = true;
                } else {
                    if ($slipdata != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MP" .  $mydate . strval($sliplastid + $i);
                        }
                    } else {
                        $code_sl = "MP" .  $mydate . "0000" . strval(1);
                    }
                }

                $i++;
            }
        } else {
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate)->where('slip_type','mp')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mp')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);

            if ($sliplastid != null) {
                if ($sliplastid < 9) {
                    $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sl = "MP" .  $mydate . "0000" . strval(1);
            }


            $slipdata = SlipTable::orderBy('id', 'desc')->first();
        }

        $maxdata = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mp')->where('selisih','false')->orderby('endorsment', 'desc')->first();
        // dd($maxdata);

        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->first();


        if ($checkslipnumber != null) {

            $slipnumform = $code_sl;
        } elseif ($checkslipnumber == null) {


            $reservedslipnumber = SlipNumber::create([
                'number' => $code_sl,
                'slip_type' => 'mp',
                'status' => 'passive',
                'insured_number' => $code_ms
            ]);

            $slipnumform = $reservedslipnumber->number;
        }

        foreach($slip_now as $list_slip){
            // HoleDetail::where('insured_id', '=', $list_slip->insured_id)->where('status','passive')->orderby('id','desc')->delete();
            InterestInsuredTemp::where('insured_id', '=', $list_slip->insured_id)->orderby('id', 'desc')->delete();
            InstallmentTemp::where('slip_id', '=', $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            ExtendCoverageTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            DeductibleTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            RetrocessionTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            TransLocationTemp::where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            PropertyTypeTemp::where('insured_id', '=', $list_slip->insured_id)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            SlipTableFile::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            
            $locationidcurr = TransLocationTemp::select('id')->where('insured_id', '=', $list_slip->insured_id)->where('slip_type','mp')->where('status','passive')->orderby('id', 'desc')->get();
            foreach ($locationidcurr as $dataid) {
                RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('slip_type','mp')->where('status','passive')->delete();
            }

        }

        

        $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
        foreach ($locationid as $dataid) {
            RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
        }


        $interestlist2 = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->delete();
        $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $propertytypelist2 = PropertyTypeTemp::where('insured_id', '=', $code_ms)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        // $filelist = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mp')->where('status','=','passive')->orderby('id','desc')->delete();

        // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


        $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
        $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
        $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
        $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
        $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
        $filelist = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();

        $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', 'mp')->orderby('id', 'desc')->get();
        $propertytypelist = PropertyTypeTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();

        //dd($locationlist2);

        $locationlist = [];

        if (!empty($locationlist2)) {
            foreach ($locationlist2 as $datadetail) {
                //$risklocationdetaildata= RiskLocationDetail::where('translocation_id','=',$datadetail->id)->where('count_endorsement',$insureddata->count_endorsement)->get();
                $risklocationdetaildata = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status','active')->join('ceding_broker','risk_location_detail.ceding_id','=','ceding_broker.id')->select('risk_location_detail.*','ceding_broker.name')->orderBy('ceding_broker.name','asc')->get();

                $riskdetaillist = [];

                foreach ($risklocationdetaildata as $stt) {

                    $interestdata = InterestInsured::where('id', '=', $stt->interest_id)->first();
                    $cedingdata = CedingBroker::where('id', '=', $stt->ceding_id)->first();

                    $stt->interestdetail = $interestdata;
                    $stt->cedingdetail = $cedingdata;

                    array_push($riskdetaillist, $stt);
                }


                $datadetail->risklocationdetail = $riskdetaillist;

                array_push($locationlist, $datadetail);
            }
        }

        // $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
        $propertytype= PropertyType::orderby('id','asc')->get();
        $statuslist = StatusLog::where('insured_id', '=', $code_sl)->orderby('id', 'desc')->get();


        return view('crm.transaction.mp_slipupdate', compact(['propertytype','propertytypelist','maxdata','slipdatadistict','sumperceding','brokerchoice','broker','prefixinsured', 'slipnumform', 'user', 'userid', 'cnd', 'slipdata2', 'filelist', 'slipdata', 'insureddata', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'interestlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
    }


    
    public function updatempslipmodal(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);

        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('number', '=', $request->slipnumber)->where('insured_id',$request->code_ms)->where('slip_type','mp')->where('endorsment',$request->countendorsement)->orderby('id','desc')->first();

            $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();


            $currdate = date("Y-m-d");

            $slipipfromdate = str_replace('/', '-', $request->slipipfrom);
            $slipiptodate = str_replace('/', '-', $request->slipipto);
            $sliprpfromdate = str_replace('/', '-', $request->sliprpfrom);
            $sliprptodate = str_replace('/', '-', $request->sliprpto);

            // $slipdataid = $slipdata->number;
            // $slipdatalatest = SlipTable::where('number', $slipdataid)->where('insured_id', $request->code_ms)->orderby('created_at', 'desc')->first();
            $slipdataup = SlipTable::where('number', $request->slipnumber)->where('insured_id', $request->code_ms)->where('slip_type','mp')->orderby('created_at', 'desc')->first();

            // if($slipdataup->status != $request->slipstatus){
            //     StatusLog::create([
            //         'status'=>$request->slipstatus,
            //         'user'=>Auth::user()->name,
            //         'datetime'=>date('Y-m-d H:i:s '),
            //         'insured_id'=>$request->code_ms,
            //         'slip_id'=>$request->slipnumber,
            //         'slip_type'=>'fe',
            //         'count_endorsement'=> $slipdatalatest->endorsment
            //     ]);
            // }

            $slipdataup->number = $request->slipnumber;
            $slipdataup->username = Auth::user()->name;
            $slipdataup->insured_id = $request->code_ms;
            $slipdataup->slip_type = 'mp';
            $slipdataup->prod_year = $currdate;
            // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
            $slipdataup->status = $request->slipstatus;
            $slipdataup->endorsment = $request->countendorsement;
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
                'message' => 'Movable Property Slip Update successfully!',
                'alert-type' => 'success'
            );

            //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','fe')->first();
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

            $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($deductibleup as $ddup) {
                $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                $deductibleprocessup->status = 'active';
                $deductibleprocessup->save();
            }

            $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($extendcoverageup as $ecup) {
                $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                $extendcoverageprocessup->status = 'active';
                $extendcoverageprocessup->save();
            }

            $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($installmentpansup as $ipup) {
                $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                $inspanprocessup->status = 'active';
                $inspanprocessup->save();
            }

            $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                'message' => 'movable Property Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }


    public function endorsementmpslip($ms, $sl)
    {
        $user = Auth::user();
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'Moveable Property - Slip Entry';
        $mydate = date("Y") . date("m") . date("d");
        $costumer = Customer::orderby('id', 'asc')->get();

        $currdate = date("d/m/Y");
        $insured = Insured::orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();
        $currency = Currency::orderby('id', 'asc')->get();
        $cob = COB::orderby('id', 'asc')->get();
        $koc = KOC::orderby('id', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 'ceding')->get();
        $felookup = FelookupLocation::orderby('id', 'asc')->get();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $extendedcoverage = ExtendedCoverage::orderby('id', 'asc')->get();

        $fe_ids = response()->json($insured->modelKeys());

        $code_ms = $ms;
        $code_sl = $sl;

        $insureddata = Insured::where('number', $code_ms)->first();
        $slipdata = SlipTable::where('insured_id', $code_ms)->first();
        $slipdata2 = SlipTable::where('insured_id', $code_ms)->get();


        if ($slipdata == NULL || empty($slipdata) || $code_ms == 0 || $code_sl == 0) {

            $insureddata = Insured::where('slip_type', 'mp')->orderby('id', 'desc')->first();
            $slipdata = SlipTable::where('insured_id', $insureddata->number)->orderby('id', 'desc')->first();

            $code_ms = $insureddata->number;
            $countendorsement = $slipdata->endorsment;
            if ($slipdata->endorsment == NULL || $slipdata->endorsment == "") {
                $code_sl = $slipdata->number . '-END' . '000' . '1';
            } else {
                if ($countendorsement < 9) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '000' . ($countendorsement + 1);
                } elseif ($countendorsement > 8 && $countendorsement < 99) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '00' . ($countendorsement + 1);
                } elseif ($countendorsement > 98 && $countendorsement < 999) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '0' . ($countendorsement + 1);
                } elseif ($countendorsement > 998 && $countendorsement < 9999) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . ($countendorsement + 1);
                }
            }

            if ($slipdata->prev_endorsement == NULL || $slipdata->prev_endorsement == "") {
                $slipdata->prev_endorsement = $sl;
            }
        } else {

            $countendorsement = $slipdata->endorsment;
            if ($slipdata->endorsment == NULL || $slipdata->endorsment == "") {
                $code_sl = $slipdata->number . '-END' . '000' . '1';
            } else {
                if ($countendorsement < 9) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '000' . ($countendorsement + 1);
                } elseif ($countendorsement > 8 && $countendorsement < 99) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '00' . ($countendorsement + 1);
                } elseif ($countendorsement > 98 && $countendorsement < 999) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . '0' . ($countendorsement + 1);
                } elseif ($countendorsement > 998 && $countendorsement < 9999) {
                    $code_sl = substr($slipdata->number, 0, 15) . '-END' . ($countendorsement + 1);
                }
            }

            if ($slipdata->prev_endorsement == NULL || $slipdata->prev_endorsement == "") {
                $slipdata->prev_endorsement = $sl;
            }
        }

        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();


        $filelist = SlipTableFile::where('slip_id', '=', $code_sl)->orderby('id', 'desc')->get();
        $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->orderby('id', 'desc')->get();
        $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->orderby('id', 'desc')->get();
        $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->orderby('id', 'desc')->get();
        $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->orderby('id', 'desc')->get();

        $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();

        $locationlist = [];

        if (!empty($locationlist2)) {
            foreach ($locationlist2 as $datadetail) {
                $risklocationdetaildata = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->get();

                $riskdetaillist = [];

                foreach ($risklocationdetaildata as $stt) {

                    $interestdata = InterestInsured::where('id', '=', $stt->interest_id)->first();
                    $cedingdata = CedingBroker::where('id', '=', $stt->ceding_id)->first();

                    $stt->interestdetail = $interestdata;
                    $stt->cedingdetail = $cedingdata;

                    array_push($riskdetaillist, $stt);
                }


                $datadetail->risklocationdetail = $riskdetaillist;

                array_push($locationlist, $datadetail);
            }
        }


        $statuslist = StatusLog::where('insured_id', '=', $code_sl)->orderby('id', 'desc')->get();


        return view('crm.transaction.mp_slipendorsement', compact(['user', 'cnd', 'slipdata2', 'countendorsement', 'filelist', 'slipdata', 'insureddata', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'interestlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer']));
    }


    public function detailmpslip($idm)
    {
        $user = Auth::user();
        $userid = Auth::user()->id;
        $country = User::orderby('id','asc')->get();
        $route_active = 'Moveable Property - Slip Entry';
        $mydate = date("Y").date("m").date("d");
        $costumer=Customer::orderby('id','asc')->get();

        $currdate = date("d/m/Y");
        $insured = Insured::orderby('id','asc')->get();
        $slip = SlipTable::orderby('id','asc')->get();
        
        $year=date('Y');

        $currency = CurrencyExchange::where('year','=',$year)->join('currencies','currencies_exc.currency',"=","currencies.id")->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        

        if(empty($currency))
        {
            $currency = CurrencyExchange::join('currencies','currencies_exc.currency',"=","currencies.id")->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        }

        $cob = COB::orderby('id','asc')->get();
        $koc = KOC::orderby('id','asc')->get();
        $ocp = Occupation::orderby('id','asc')->get();
        $cedingbroker = CedingBroker::orderby('id','asc')->get();
        $ceding = CedingBroker::orderby('id','asc')->where('type','ceding')->get();
        $felookup = FelookupLocation::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        $extendedcoverage= ExtendedCoverage::orderby('id','asc')->get();
        $propertytype= PropertyType::orderby('id','asc')->get();
        $fe_ids = response()->json($insured->modelKeys());
        
        $insureddata=Insured::find($idm);
        $code_ms=$insureddata->number;
        $slipdata=SlipTable::where('insured_id','=',$code_ms)->first();
        $slipdata2=SlipTable::where('insured_id',$code_ms)->get();
        
        $code_sl=$slipdata->number;
        $sliplastid = count($slip);
        
        $kondisi=false;
        $i=1;
        while($kondisi==false)
        {
            $slipdatatest=SlipTable::where('number',$code_sl)->first();
            if(empty($slipdatatest) || $slipdatatest==NULL)
            {
                $kondisi=true;
            }
            else
            {
                if($sliplastid < 9)
                {
                    $code_sl = "MP".  $mydate . "0000" . strval($sliplastid + $i);
                }   
                elseif($sliplastid > 8 && $sliplastid < 99)
                {
                    $code_sl = "MP".  $mydate . "000" . strval($sliplastid + $i);
                }
                elseif($sliplastid > 98 && $sliplastid < 999)
                {
                    $code_sl = "MP".  $mydate . "00" . strval($sliplastid + $i);
                }
                elseif($sliplastid > 998 && $sliplastid < 9999)
                {
                    $code_sl = "MP".  $mydate . "0" . strval($sliplastid + $i);
                }
                elseif($sliplastid > 9998 && $sliplastid < 99999)
                {
                    $code_sl = "MP".  $mydate . strval($sliplastid + $i);
                }
            }

            $i++;
        }



        $interestinsured= InterestInsured::orderby('id','asc')->get();
        //$interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
       
        
        $filelist=SlipTableFile::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();       
        
        $locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();

        
        $locationlist=[];

        if(!empty($locationlist2))
        {
            foreach($locationlist2 as $datadetail)
            {
                $risklocationdetaildata= RiskLocationDetail::where('translocation_id','=',$datadetail->id)->get();
                
                $riskdetaillist=[];

                foreach($risklocationdetaildata as $stt)
                {
                    
                    $interestdata=InterestInsured::where('id','=',$stt->interest_id)->first();
                    $cedingdata=CedingBroker::where('id','=',$stt->ceding_id)->first();

                    $stt->interestdetail=$interestdata;
                    $stt->cedingdetail=$cedingdata;

                    array_push($riskdetaillist,$stt);
                }


                $datadetail->risklocationdetail=$riskdetaillist;
           
                array_push($locationlist,$datadetail);
            }     
        }  


        $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
        $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


        return view('crm.transaction.mp_slipdetail', compact(['user','cnd','slipdata2','filelist','propertytype','propertytypelist','slipdata','insureddata','statuslist','retrocessionlist','installmentlist','extendcoveragelist','deductiblelist','extendedcoverage','extendedcoverage','deductibletype','interestinsured','locationlist','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','fe_ids','code_ms','code_sl','costumer']));
    
    }


    public function storempinsured(Request $request)
    {

        $validator = $request->validate([
            'mpsuggestinsured' => 'required'
        ]);

        $costumcheck = Customer::where('company_name', '=', $request->mpsuggestinsured)->first();
        if ($costumcheck == null) {

            Customer::create([
                'owner_id' => '1',
                'industry_id' => '27',
                'company_prefix' => $request->mpinsured,
                'company_name' => $request->mpsuggestinsured,
                'website' => $request->mpsuggestinsured,
                'company_suffix' => $request->mpsuffix
            ]);
        }

        if ($validator) {
            $user = Auth::user();


            $locationlist = TransLocationTemp::where('insured_id', '=', $request->mpnumber)->where('slip_type', 'mp')->orderby('id', 'desc')->get();
            $propertytypelist = PropertyTypeTemp::where('insured_id', '=', $request->mpnumber)->orderby('id', 'desc')->get();

            $sum_amount = DB::table('risk_location_detail')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', $request->mpnumber)
                ->where('trans_location_detail.slip_type', 'mp')
                ->sum('risk_location_detail.amountlocation');

            $checkinsurednumber = InsuredNumber::where('number', $request->mpnumber)->where('slip_type', 'mp')->where('status', 'active')->first();

            // $checkslipnumber= SlipNumber::where('number',$code_sl)->where('insured_number',$code_ms)->where('slip_type','mp')->where('status','passive')->first();
            if ($checkinsurednumber == null) {
                $insureddata = Insured::where('number', '=', $request->mpnumber)->where('slip_type','mp')->first();
                if ($insureddata == null) {
                    $insureddataup = Insured::create([
                        'number' => $request->mpnumber,
                        'slip_type' => 'mp',

                        'prefix_id' => $request->mpinsured,
                        'insured_name' => strtoupper($request->mpsuggestinsured),
                        'insured_suffix' => strtoupper($request->mpsuffix),

                        'share' => $sum_amount,
                        'share_from' => $request->mpsharefrom,
                        'statmodified' => 1,
                        'share_to' => $request->mpshareto,
                        'coincurance' => $request->mpcoincurance,
                        'location' => $locationlist->toJson(),
                        'uy' => $request->feuy,
                        'count_endorsement' => 0,
                        'currency_id' => $request->fecurrency,
                        'property_type' => $propertytypelist->toJson()

                    ]);

                    $insurednumberdata = InsuredNumber::where('number', $request->mpnumber)->orderby('id', 'desc')->first();
                    $insurednumberdata->status = 'active';
                    $insurednumberdata->save();

                    $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->mpnumber)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($TransLocationup as $tstup) {
                        $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                        $translocationprocessup->status = 'active';
                        $translocationprocessup->save();

                        $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($risklocationup as $rlsup) {
                            $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                            $risklocationprocessup->status = 'active';
                            $risklocationprocessup->save();
                        }
                    }

                    $PropertyTypeup = PropertyTypeTemp::where('insured_id', '=', $request->mpnumber)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($PropertyTypeup as $ptup) {
                        $propertytypeprocessup = PropertyTypeTemp::findOrFail($ptup->id);
                        $propertytypeprocessup->status = 'active';
                        $propertytypeprocessup->save();
                    }

                    $notification = array(
                        'message' => 'Moveable PropertyInsured added successfully!',
                        'alert-type' => 'success',
                        'count_endorsement' => $insureddataup->count_endorsement,
                        'ceding_share' => $sum_amount
                    );
                } else {
                    // dd($insureddata->share_to);
                    if($insureddata->share_to != $request->mpshareto){
                        $insureddataid = $insureddata->id;
                        $insureddataup = Insured::findOrFail($insureddataid);

                        $insureddataup->prefix_id = $request->mpinsured;
                        $insureddataup->insured_name = strtoupper($request->mpsuggestinsured);
                        $insureddataup->insured_suffix = strtoupper($request->mpsuffix);

                        $insureddataup->share = $sum_amount;
                        $insureddataup->statmodified = 1;
                        $insureddataup->share_from = $request->mpsharefrom;
                        $insureddataup->share_to = $request->mpshareto;
                        $insureddataup->coincurance = $request->mpcoincurance;
                        $insureddataup->location = $locationlist->toJson();
                        $insureddataup->uy = $request->feuy;
                        $insureddataup->currency_id = $request->fecurrency;
                        $insureddataup->save();

                        $insurednumberdata = InsuredNumber::where('number', $request->mpnumber)->orderby('id', 'desc')->first();
                        $insurednumberdata->status = 'active';

                        $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->mpnumber)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($TransLocationup as $tstup) {
                            $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                            $translocationprocessup->status = 'active';
                            $translocationprocessup->save();

                            $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                            foreach ($risklocationup as $rlsup) {
                                $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                                $risklocationprocessup->status = 'active';
                                $risklocationprocessup->save();
                            }
                        }

                        $SlipTableUp = SlipTable::where('insured_id', '=', $insureddataup->number)->where('slip_type', 'mp')->where('slipshow', 'yes')->orderby('id', 'desc')->get();
                        foreach ($SlipTableUp as $stu) {
                            $sliptableprocessup = SlipTable::findOrFail($stu->id);
                            $sliptableprocessup->warning_flag = 1;
                            $sliptableprocessup->save();
                        }

                        $notification = array(
                            'message' => 'Moveable PropertyInsured Update successfully!, but tsi changed. Must Change!!!',
                            'alert-type' => 'success',
                            'count_endorsement' => $insureddataup->count_endorsement,
                            'ceding_share' => $sum_amount
                        );

                        
                    }else{
                        $insureddataid = $insureddata->id;
                        $insureddataup = Insured::findOrFail($insureddataid);

                        $insureddataup->prefix_id = $request->mpinsured;
                        $insureddataup->insured_name = strtoupper($request->mpsuggestinsured);
                        $insureddataup->insured_suffix = strtoupper($request->mpsuffix);

                        $insureddataup->share = $sum_amount;
                        $insureddataup->statmodified = 1;
                        $insureddataup->share_from = $request->mpsharefrom;
                        $insureddataup->share_to = $request->mpshareto;
                        $insureddataup->coincurance = $request->mpcoincurance;
                        $insureddataup->location = $locationlist->toJson();
                        $insureddataup->uy = $request->feuy;
                        $insureddataup->currency_id = $request->fecurrency;
                        $insureddataup->save();

                        $insurednumberdata = InsuredNumber::where('number', $request->mpnumber)->orderby('id', 'desc')->first();
                        $insurednumberdata->status = 'active';

                        $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->mpnumber)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($TransLocationup as $tstup) {
                            $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                            $translocationprocessup->status = 'active';
                            $translocationprocessup->save();

                            $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                            foreach ($risklocationup as $rlsup) {
                                $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                                $risklocationprocessup->status = 'active';
                                $risklocationprocessup->save();
                            }
                        }

                        $notification = array(
                            'message' => 'Moveable PropertyInsured Update successfully!',
                            'alert-type' => 'success',
                            'count_endorsement' => $insureddataup->count_endorsement,
                            'ceding_share' => $sum_amount
                        );
                        
                    }
                    
                }
            } else {
                $newnumber2 = substr($request->mpnumber, 10, 15);
                $codenumber = substr($request->mpnumber, 0, 10);

                if (intval($newnumber2) < 9) {
                    $count = substr($newnumber2, 14);
                    $code_ms2 = $codenumber . "0000" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 8 && intval($newnumber2) < 99) {
                    $count = substr($newnumber2, 13);
                    $code_ms2 = $codenumber . "000" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 98 && intval($newnumber2) < 999) {
                    $count = substr($newnumber2, 12);
                    $code_ms2 = $codenumber . "00" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 998 && intval($newnumber2) < 9999) {
                    $count = substr($newnumber2, 11);
                    $code_ms2 = $codenumber . "0" . strval(intval($count) + 1);
                } elseif (intval($newnumber2) > 9998 && intval($newnumber2) < 99999) {
                    $count = substr($newnumber2, 10);
                    $code_ms2 = $codenumber  . strval(intval($count) + 1);
                }


                $reservedinsurednumber = InsuredNumber::create([
                    'number' => $code_ms2,
                    'status' => 'active'
                ]);

                $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->mpnumber)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($TransLocationup as $tstup) {
                    $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                    $translocationprocessup->insured_id = $code_ms2;
                    $translocationprocessup->save();

                    $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($risklocationup as $rlsup) {
                        $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                        $risklocationprocessup->translocation_id = $translocationprocessup->id;
                        $risklocationprocessup->save();
                    }
                }

                $insureddata = Insured::where('number', '=', $code_ms2)->first();

                if ($insureddata == null) {
                    $insureddataup = Insured::create([
                        'number' => $code_ms2,
                        'slip_type' => 'mp',

                        'prefix_id' => $request->mpinsured,
                        'insured_name' => strtoupper($request->mpsuggestinsured),
                        'insured_suffix' => strtoupper($request->mpsuffix),

                        'share' => $sum_amount,
                        'share_from' => $request->mpsharefrom,
                        'statmodified' => 1,
                        'share_to' => $request->mpshareto,
                        'coincurance' => $request->mpcoincurance,
                        'location' => $locationlist->toJson(),
                        'uy' => $request->feuy,
                        'count_endorsement' => 0,
                        'currency_id' => $request->fecurrency

                    ]);

                    $insurednumberdata = InsuredNumber::where('number', $code_ms2)->orderby('id', 'desc')->first();
                    $insurednumberdata->status = 'active';
                    $insurednumberdata->save();

                    $TransLocationup = TransLocationTemp::where('insured_id', '=', $code_ms2)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($TransLocationup as $tstup) {
                        $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                        $translocationprocessup->status = 'active';
                        $translocationprocessup->save();

                        $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($risklocationup as $rlsup) {
                            $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                            $risklocationprocessup->status = 'active';
                            $risklocationprocessup->save();
                        }
                    }






                    $notification = array(
                        'message' => 'Moveable PropertyInsured added successfully!',
                        'alert-type' => 'success',
                        'count_endorsement' => $insureddataup->count_endorsement,
                        'ceding_share' => $sum_amount
                    );
                    
                } else {
                    $insureddataid = $insureddata->id;
                    $insureddataup = Insured::findOrFail($insureddataid);

                    $insureddataup->prefix_id = $request->mpinsured;
                    $insureddataup->insured_name = strtoupper($request->mpsuggestinsured);
                    $insureddataup->insured_suffix = strtoupper($request->mpsuffix);

                    $insureddataup->share = $sum_amount;
                    $insureddataup->statmodified = 1;
                    $insureddataup->share_from = $request->mpsharefrom;
                    $insureddataup->share_to = $request->mpshareto;
                    $insureddataup->coincurance = $request->mpcoincurance;
                    $insureddataup->location = $locationlist->toJson();
                    $insureddataup->uy = $request->feuy;
                    $insureddataup->currency_id = $request->fecurrency;
                    $insureddataup->save();

                    $insurednumberdata = InsuredNumber::where('number', $request->mpnumber)->orderby('id', 'desc')->first();
                    $insurednumberdata->status = 'active';
                    $insurednumberdata->save();

                    $TransLocationup = TransLocationTemp::where('insured_id', '=', $code_ms2)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($TransLocationup as $tstup) {
                        $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                        $translocationprocessup->status = 'active';
                        $translocationprocessup->save();

                        $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($risklocationup as $rlsup) {
                            $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                            $risklocationprocessup->status = 'active';
                            $risklocationprocessup->save();
                        }
                    }



                    $notification = array(
                        'message' => 'Moveable PropertyInsured Update successfully!',
                        'alert-type' => 'success',
                        'count_endorsement' => $insureddataup->count_endorsement,
                        'ceding_share' => $sum_amount
                    );
                }
            }





            return response($notification);
            //Session::flash('Success', 'Moveable PropertyInsured added successfully', 'success');
            //return redirect()->route('liniusaha.index');

        } else {

            $notification = array(
                'message' => 'Moveable PropertyInsured added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Moveable PropertyInsured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function storempslip(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);


        if ($validator) {
            $user = Auth::user();


            $checkslipnumber = SlipNumber::where('number', $request->slipnumber)->where('insured_number', $request->code_ms)->where('slip_type', 'mp')->where('status', 'active')->first();


            if ($checkslipnumber == null) {
                $slipdata = SlipTable::where('number', '=', $request->slipnumber)->where('insured_id','=',$request->code_ms)->where('slip_type','=','mp')->where('slipshow','=','yes')->where('selisih','=','false')->first();

                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                // $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
                // $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
                // $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
                // $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();

                $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();


                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $request->slipnumber,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mp',
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
                        'message' => 'Financial Line Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mp',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);




                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $new_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MP" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mp',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                            'slip_type' => 'mp',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $request->slipnumber;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mp';
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
                        'message' => 'Financial Line Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MP" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mp',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                    'slip_type' => 'mp',
                    'status' => 'active',
                    'insured_number' => $request->code_ms
                ]);

                $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($deductibleup as $ddup) {
                    $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                    $deductibleprocessup->slip_id = $code_sl2;
                    $deductibleprocessup->save();
                }

                $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($extendcoverageup as $ecup) {
                    $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                    $extendcoverageprocessup->slip_id = $code_sl2;
                    $extendcoverageprocessup->save();
                }

                $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($installmentpansup as $ipup) {
                    $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                    $inspanprocessup->slip_id = $code_sl2;
                    $inspanprocessup->save();
                }

                $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($retrocessionpanup as $rpup) {
                    $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                    $retropanprocessup->slip_id = $code_sl2;
                    $retropanprocessup->save();
                }


                $slipdata = SlipTable::where('number', '=', $code_sl2)->first();

                $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();

                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $code_sl2,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mp',
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
                        'message' => 'Financial Line Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mp',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);




                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $new_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MP" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mp',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                            'slip_type' => 'mp',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $code_sl2;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mp';
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
                        'message' => 'Financial Line Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($sliplastid != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MP" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mp',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($extendcoverageup as $ecup) {
                        $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
                        $extendcoverageprocessup->status = 'active';
                        $extendcoverageprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                'message' => 'Financial Line Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }


    // public function storempslip(Request $request)
    // {
    //     $validator = $request->validate([
    //         'slipnumber' => 'required'
    //     ]);


    //     if ($validator) {
    //         $user = Auth::user();


    //         $checkslipnumber = SlipNumber::where('number', $request->slipnumber)->where('insured_number', $request->code_ms)->where('slip_type', 'mp')->where('status', 'active')->first();


    //         if ($checkslipnumber == null) {
    //             $slipdata = SlipTable::where('number', '=', $request->slipnumber)->first();

    //             $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
    //             $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
    //             $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
    //             $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();
    //             $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->where('deleted_at', null)->orderby('id', 'desc')->get();


    //             if ($slipdata == null) {
    //                 $currdate = date("Y-m-d");

    //                 $slipdataup = SlipTable::create([
    //                     'number' => $request->slipnumber,
    //                     'username' => Auth::user()->name,
    //                     'insured_id' => $request->code_ms,
    //                     'slip_type' => 'mp',
    //                     'prod_year' => $currdate,
    //                     // 'date_transfer'=> date("Y-m-d", strtotime($request->slipdatetransfer)),
    //                     'status' => $request->slipstatus,
    //                     'endorsment' => 0,
    //                     'selisih' => 'false',
    //                     'source' => $request->slipcedingbroker,
    //                     'source_2' => $request->slipceding,
    //                     // 'currency'=>$request->slipcurrency,
    //                     'cob' => $request->slipcob,
    //                     'koc' => $request->slipkoc,
    //                     'occupacy' => $request->slipoccupacy,
    //                     'build_const' => $request->slipbld_const,
    //                     'slip_no' => $request->slipno,
    //                     'cn_dn' => $request->slipcndn,
    //                     'policy_no' => $request->slippolicy_no,
    //                     //'attacment_file'=>json_encode($attachmentlist),
    //                     'attacment_file' => '',
    //                     'interest_insured' => $interestlist->toJSon(),
    //                     'total_sum_insured' => $request->sliptotalsum,
    //                     'share_tsi' => $request->slipsharetotalsum,
    //                     'type_tsi' => $request->sliptypetotalsum,
    //                     'type_share_tsi' => $request->sliptypetsishare,
    //                     'total_day' => $request->sliptotalday,
    //                     'total_year' => $request->sliptotalyear,
    //                     'sum_total_date' => $request->slipdatesum,
    //                     'insured_type' => $request->sliptype,
    //                     'insured_pct' => $request->slippct,
    //                     'total_sum_pct' => $request->sliptotalsumpct,
    //                     'deductible_panel' => $deductiblelist->toJson(),
    //                     'extend_coverage' => $extendcoveragelist->toJson(),
    //                     'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
    //                     'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
    //                     'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
    //                     'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
    //                     'proportional' => $request->slipproportional,
    //                     'layer_non_proportional' => $request->sliplayerproportional,
    //                     'rate' => $request->sliprate,
    //                     'sliptotalrate' => $request->sliptotalrate,
    //                     'v_broker' => $request->slipvbroker,
    //                     'sum_feebroker' => $request->slipsumvbroker,
    //                     'share' => $request->slipshare,
    //                     'sum_share' => $request->slipsumshare,
    //                     'basic_premium' => $request->slipbasicpremium,
    //                     'commission' => $request->slipcommission,
    //                     'grossprm_to_nr' => $request->slipgrossprmtonr,
    //                     'netprm_to_nr' => $request->slipnetprmtonr,
    //                     'sum_commission' => $request->slipsumcommission,
    //                     'installment_panel' => $installmentlist->toJson(),
    //                     'retrocession_panel' => $retrocessionlist->toJson(),
    //                     'retro_backup' => $request->sliprb,
    //                     'own_retention' => $request->slipor,
    //                     'sum_own_retention' => $request->slipsumor,
    //                     'wpc' => $request->wpc,
    //                     'remarks' => $request->remarks,
    //                     'slipshow' => "yes"

    //                 ]);

    //                 $notification = array(
    //                     'message' => 'Moveable Property Slip added successfully!',
    //                     'alert-type' => 'success'
    //                 );

    //                 StatusLog::create([
    //                     'status' => $request->slipstatus,
    //                     'user' => Auth::user()->name,
    //                     'datetime' => date('Y-m-d H:i:s '),
    //                     'insured_id' => $request->code_ms,
    //                     'slip_id' => $request->slipnumber,
    //                     'slip_type' => 'mp',
    //                     'count_endorsement' => $slipdataup->endorsment
    //                 ]);




    //                 //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
    //                 $insdata = Insured::where('number', $request->code_ms)->first();
    //                 // $old_sumshare = $request->slipoldsumshare;

    //                 $old_nasre_share = $insdata->share_from;
    //                 $new_nasre_share = $request->insured_share;


    //                 if ($new_nasre_share != $new_nasre_share) {
    //                     $msdata = Insured::findOrFail($insdata->id);

    //                     $msdata->share_from = $new_nasre_share;
    //                     $msdata->save();
    //                 }

    //                 $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
    //                 $slipnumberdata->status = 'active';
    //                 $slipnumberdata->save();


    //                 $currdate2 = date("Y-m-d");
    //                 $mydate = date("Y") . date("m") . date("d");
    //                 $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
    //                 $sliplastid = count($slip_now);
    //                 // dd($sliplastid);

    //                 if ($sliplastid != null) {
    //                     if ($sliplastid < 9) {
    //                         $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 8 && $sliplastid < 99) {
    //                         $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 98 && $sliplastid < 999) {
    //                         $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 998 && $sliplastid < 9999) {
    //                         $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
    //                         $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
    //                     }
    //                 } else {
    //                     $code_sl = "MP" .  $mydate . "0000" . strval(1);
    //                 }

    //                 $reservedslipnumber = SlipNumber::create([
    //                     'number' => $code_sl,
    //                     'slip_type' => 'mp',
    //                     'status' => 'passive',
    //                     'insured_number' => $request->code_ms
    //                 ]);

    //                 $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($deductibleup as $ddup) {
    //                     $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
    //                     $deductibleprocessup->status = 'active';
    //                     $deductibleprocessup->save();
    //                 }

    //                 $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($extendcoverageup as $ecup) {
    //                     $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
    //                     $extendcoverageprocessup->status = 'active';
    //                     $extendcoverageprocessup->save();
    //                 }

    //                 $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($installmentpansup as $ipup) {
    //                     $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
    //                     $inspanprocessup->status = 'active';
    //                     $inspanprocessup->save();
    //                 }

    //                 $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($retrocessionpanup as $rpup) {
    //                     $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
    //                     $retropanprocessup->status = 'active';
    //                     $retropanprocessup->save();
    //                 }

    //                 return response()->json(
    //                     [
    //                         'id' => $slipdataup->id,
    //                         'number' => $request->slipnumber,
    //                         'slipnumber' => $code_sl,
    //                         'slipstatus' => $slipdataup->status,
    //                         'date_transfer' => $slipdataup->date_transfer,
    //                         'ceding' => $slipdataup->ceding->name,
    //                         'cedingbroker' => $slipdataup->cedingbroker->name,
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]
    //                 );
    //             } else {

    //                 $currdate = date("Y-m-d");

    //                 $slipdataid = $slipdata->number;
    //                 $slipdataup = SlipTable::where('number', $slipdataid)->orderby('created_at', 'desc')->first();

    //                 if ($slipdataup->status != $request->slipstatus) {
    //                     StatusLog::create([
    //                         'status' => $request->slipstatus,
    //                         'user' => Auth::user()->name,
    //                         'datetime' => date('Y-m-d H:i:s '),
    //                         'insured_id' => $request->code_ms,
    //                         'slip_id' => $request->slipnumber,
    //                         'slip_type' => 'mp',
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]);
    //                 }

    //                 $slipdataup->number = $request->slipnumber;
    //                 $slipdataup->username = Auth::user()->name;
    //                 $slipdataup->insured_id = $request->code_ms;
    //                 $slipdataup->slip_type = 'mp';
    //                 $slipdataup->prod_year = $currdate;
    //                 // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
    //                 $slipdataup->status = $request->slipstatus;
    //                 $slipdataup->endorsment = 0;
    //                 $slipdataup->selisih = "false";
    //                 $slipdataup->source = $request->slipcedingbroker;
    //                 $slipdataup->source_2 = $request->slipceding;
    //                 // $slipdataup->currency=$request->slipcurrency;
    //                 $slipdataup->cob = $request->slipcob;
    //                 $slipdataup->koc = $request->slipkoc;
    //                 $slipdataup->occupacy = $request->slipoccupacy;
    //                 $slipdataup->build_const = $request->slipbld_const;
    //                 $slipdataup->slip_no = $request->slipno;
    //                 $slipdataup->cn_dn = $request->slipcndn;
    //                 $slipdataup->policy_no = $request->slippolicy_no;
    //                 $slipdataup->attacment_file = '';
    //                 $slipdataup->interest_insured = $interestlist->toJSon();
    //                 $slipdataup->total_sum_insured = $request->sliptotalsum;
    //                 $slipdataup->share_tsi = $request->slipsharetotalsum;
    //                 $slipdataup->type_tsi = $request->sliptypetotalsum;
    //                 $slipdataup->type_share_tsi = $request->sliptypetsishare;
    //                 $slipdataup->total_day = $request->sliptotalday;
    //                 $slipdataup->total_year = $request->sliptotalyear;
    //                 $slipdataup->sum_total_date = $request->slipdatesum;
    //                 $slipdataup->insured_type = $request->sliptype;
    //                 $slipdataup->insured_pct = $request->slippct;
    //                 $slipdataup->total_sum_pct = $request->sliptotalsumpct;
    //                 $slipdataup->deductible_panel = $deductiblelist->toJson();
    //                 $slipdataup->extend_coverage = $extendcoveragelist->toJson();
    //                 $slipdataup->insurance_period_from = date("Y-m-d", strtotime($request->slipipfrom));
    //                 $slipdataup->insurance_period_to = date("Y-m-d", strtotime($request->slipipto));
    //                 $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($request->sliprpfrom));
    //                 $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($request->sliprpto));
    //                 $slipdataup->proportional = $request->slipproportional;
    //                 $slipdataup->layer_non_proportional = $request->sliplayerproportional;
    //                 $slipdataup->rate = $request->sliprate;
    //                 $slipdataup->sliptotalrate = $request->sliptotalrate;
    //                 $slipdataup->v_broker = $request->slipvbroker;
    //                 $slipdataup->sum_feebroker = $request->slipsumvbroker;
    //                 $slipdataup->share = $request->slipshare;
    //                 $slipdataup->sum_share = $request->slipsumshare;
    //                 $slipdataup->basic_premium = $request->slipbasicpremium;
    //                 $slipdataup->commission = $request->slipcommission;
    //                 $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
    //                 $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
    //                 $slipdataup->sum_commission = $request->slipsumcommission;
    //                 $slipdataup->installment_panel = $installmentlist->toJson();
    //                 $slipdataup->retrocession_panel = $retrocessionlist->toJson();
    //                 $slipdataup->retro_backup = $request->sliprb;
    //                 $slipdataup->own_retention = $request->slipor;
    //                 $slipdataup->sum_own_retention = $request->slipsumor;
    //                 $slipdataup->wpc = $request->wpc;
    //                 $slipdataup->remarks = $request->remarks;
    //                 $slipdataup->slipshow = "yes";
    //                 $slipdataup->warning_flag = "0";

    //                 $slipdataup->save();


    //                 $notification = array(
    //                     'message' => 'Moveable Property Slip Update successfully!',
    //                     'alert-type' => 'success'
    //                 );

    //                 //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
    //                 $insdata = Insured::where('number', $request->code_ms)->first();

    //                 $old_nasre_share = $insdata->share_from;
    //                 $new_nasre_share = $request->insured_share;


    //                 if ($new_nasre_share != $old_nasre_share) {
    //                     $msdata = Insured::findOrFail($insdata->id);

    //                     $msdata->share_from = $new_nasre_share;
    //                     $msdata->save();
    //                 }

    //                 $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
    //                 $slipnumberdata->status = 'active';
    //                 $slipnumberdata->save();

    //                 $currdate2 = date("Y-m-d");
    //                 $mydate = date("Y") . date("m") . date("d");
    //                 $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
    //                 $sliplastid = count($slip_now);
    //                 // dd($sliplastid);

    //                 if ($sliplastid != null) {
    //                     if ($sliplastid < 9) {
    //                         $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 8 && $sliplastid < 99) {
    //                         $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 98 && $sliplastid < 999) {
    //                         $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 998 && $sliplastid < 9999) {
    //                         $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
    //                         $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
    //                     }
    //                 } else {
    //                     $code_sl = "MP" .  $mydate . "0000" . strval(1);
    //                 }

    //                 $reservedslipnumber = SlipNumber::create([
    //                     'number' => $code_sl,
    //                     'slip_type' => 'mp',
    //                     'status' => 'passive',
    //                     'insured_number' => $request->code_ms
    //                 ]);

    //                 $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($deductibleup as $ddup) {
    //                     $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
    //                     $deductibleprocessup->status = 'active';
    //                     $deductibleprocessup->save();
    //                 }

    //                 $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($extendcoverageup as $ecup) {
    //                     $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
    //                     $extendcoverageprocessup->status = 'active';
    //                     $extendcoverageprocessup->save();
    //                 }

    //                 $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($installmentpansup as $ipup) {
    //                     $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
    //                     $inspanprocessup->status = 'active';
    //                     $inspanprocessup->save();
    //                 }

    //                 $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($retrocessionpanup as $rpup) {
    //                     $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
    //                     $retropanprocessup->status = 'active';
    //                     $retropanprocessup->save();
    //                 }

    //                 return response()->json(
    //                     [
    //                         'id' => $slipdataup->id,
    //                         'number' => $request->slipnumber,
    //                         'slipnumber' => $code_sl,
    //                         'slipstatus' => $slipdataup->status,
    //                         'date_transfer' => $slipdataup->date_transfer,
    //                         'ceding' => $slipdataup->ceding->name,
    //                         'cedingbroker' => $slipdataup->cedingbroker->name,
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]
    //                 );
    //             }
    //         } else {
    //             $newnumber2 = substr($request->slipnumber, 10, 15);
    //             $codenumber = substr($request->slipnumber, 0, 10);

    //             if (intval($newnumber2) < 9) {
    //                 $count = substr($newnumber2, 14);
    //                 $code_sl2 = $codenumber . "0000" . strval(intval($count) + 1);
    //             } elseif (intval($newnumber2) > 8 && intval($newnumber2) < 99) {
    //                 $count = substr($newnumber2, 13);
    //                 $code_sl2 = $codenumber . "000" . strval(intval($count) + 1);
    //             } elseif (intval($newnumber2) > 98 && intval($newnumber2) < 999) {
    //                 $count = substr($newnumber2, 12);
    //                 $code_sl2 = $codenumber . "00" . strval(intval($count) + 1);
    //             } elseif (intval($newnumber2) > 998 && intval($newnumber2) < 9999) {
    //                 $count = substr($newnumber2, 11);
    //                 $code_sl2 = $codenumber . "0" . strval(intval($count) + 1);
    //             } elseif (intval($newnumber2) > 9998 && intval($newnumber2) < 99999) {
    //                 $count = substr($newnumber2, 10);
    //                 $code_sl2 = $codenumber  . strval(intval($count) + 1);
    //             }


    //             $reservedslipnumber = SlipNumber::create([
    //                 'number' => $code_sl2,
    //                 'slip_type' => 'mp',
    //                 'status' => 'active',
    //                 'insured_number' => $request->code_ms
    //             ]);

    //             $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //             foreach ($deductibleup as $ddup) {
    //                 $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
    //                 $deductibleprocessup->slip_id = $code_sl2;
    //                 $deductibleprocessup->save();
    //             }

    //             $extendcoverageup = ExtendCoverageTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //             foreach ($extendcoverageup as $ecup) {
    //                 $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
    //                 $extendcoverageprocessup->slip_id = $code_sl2;
    //                 $extendcoverageprocessup->save();
    //             }

    //             $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //             foreach ($installmentpansup as $ipup) {
    //                 $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
    //                 $inspanprocessup->slip_id = $code_sl2;
    //                 $inspanprocessup->save();
    //             }

    //             $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //             foreach ($retrocessionpanup as $rpup) {
    //                 $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
    //                 $retropanprocessup->slip_id = $code_sl2;
    //                 $retropanprocessup->save();
    //             }


    //             $slipdata = SlipTable::where('number', '=', $code_sl2)->first();

    //             $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
    //             $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
    //             $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
    //             $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
    //             $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();

    //             if ($slipdata == null) {
    //                 $currdate = date("Y-m-d");

    //                 $slipdataup = SlipTable::create([
    //                     'number' => $code_sl2,
    //                     'username' => Auth::user()->name,
    //                     'insured_id' => $request->code_ms,
    //                     'slip_type' => 'mp',
    //                     'prod_year' => $currdate,
    //                     // 'date_transfer'=> date("Y-m-d", strtotime($request->slipdatetransfer)),
    //                     'status' => $request->slipstatus,
    //                     'endorsment' => 0,
    //                     'selisih' => 'false',
    //                     'source' => $request->slipcedingbroker,
    //                     'source_2' => $request->slipceding,
    //                     // 'currency'=>$request->slipcurrency,
    //                     'cob' => $request->slipcob,
    //                     'koc' => $request->slipkoc,
    //                     'occupacy' => $request->slipoccupacy,
    //                     'build_const' => $request->slipbld_const,
    //                     'slip_no' => $request->slipno,
    //                     'cn_dn' => $request->slipcndn,
    //                     'policy_no' => $request->slippolicy_no,
    //                     //'attacment_file'=>json_encode($attachmentlist),
    //                     'attacment_file' => '',
    //                     'interest_insured' => $interestlist->toJSon(),
    //                     'total_sum_insured' => $request->sliptotalsum,
    //                     'share_tsi' => $request->slipsharetotalsum,
    //                     'type_tsi' => $request->sliptypetotalsum,
    //                     'type_share_tsi' => $request->sliptypetsishare,
    //                     'total_day' => $request->sliptotalday,
    //                     'total_year' => $request->sliptotalyear,
    //                     'sum_total_date' => $request->slipdatesum,
    //                     'insured_type' => $request->sliptype,
    //                     'insured_pct' => $request->slippct,
    //                     'total_sum_pct' => $request->sliptotalsumpct,
    //                     'deductible_panel' => $deductiblelist->toJson(),
    //                     'extend_coverage' => $extendcoveragelist->toJson(),
    //                     'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
    //                     'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
    //                     'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
    //                     'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
    //                     'proportional' => $request->slipproportional,
    //                     'layer_non_proportional' => $request->sliplayerproportional,
    //                     'rate' => $request->sliprate,
    //                     'sliptotalrate' => $request->sliptotalrate,
    //                     'v_broker' => $request->slipvbroker,
    //                     'sum_feebroker' => $request->slipsumvbroker,
    //                     'share' => $request->slipshare,
    //                     'sum_share' => $request->slipsumshare,
    //                     'basic_premium' => $request->slipbasicpremium,
    //                     'commission' => $request->slipcommission,
    //                     'grossprm_to_nr' => $request->slipgrossprmtonr,
    //                     'netprm_to_nr' => $request->slipnetprmtonr,
    //                     'sum_commission' => $request->slipsumcommission,
    //                     'installment_panel' => $installmentlist->toJson(),
    //                     'retrocession_panel' => $retrocessionlist->toJson(),
    //                     'retro_backup' => $request->sliprb,
    //                     'own_retention' => $request->slipor,
    //                     'sum_own_retention' => $request->slipsumor,
    //                     'wpc' => $request->wpc,
    //                     'remarks' => $request->remarks,
    //                     'slipshow' => "yes"

    //                 ]);

    //                 $notification = array(
    //                     'message' => 'Moveable Property Slip added successfully!',
    //                     'alert-type' => 'success'
    //                 );

    //                 StatusLog::create([
    //                     'status' => $request->slipstatus,
    //                     'user' => Auth::user()->name,
    //                     'datetime' => date('Y-m-d H:i:s '),
    //                     'insured_id' => $request->code_ms,
    //                     'slip_id' => $request->slipnumber,
    //                     'slip_type' => 'mp',
    //                     'count_endorsement' => $slipdataup->endorsment
    //                 ]);




    //                 //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
    //                 $insdata = Insured::where('number', $request->code_ms)->first();
    //                 // $old_sumshare = $request->slipoldsumshare;

    //                 $old_nasre_share = $insdata->share_from;
    //                 $new_nasre_share = $request->insured_share;


    //                 if ($new_nasre_share != $new_nasre_share) {
    //                     $msdata = Insured::findOrFail($insdata->id);

    //                     $msdata->share_from = $new_nasre_share;
    //                     $msdata->save();
    //                 }

    //                 $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
    //                 $slipnumberdata->status = 'active';
    //                 $slipnumberdata->save();


    //                 $currdate2 = date("Y-m-d");
    //                 $mydate = date("Y") . date("m") . date("d");
    //                 $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
    //                 $sliplastid = count($slip_now);
    //                 // dd($sliplastid);

    //                 if ($sliplastid != null) {
    //                     if ($sliplastid < 9) {
    //                         $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 8 && $sliplastid < 99) {
    //                         $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 98 && $sliplastid < 999) {
    //                         $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 998 && $sliplastid < 9999) {
    //                         $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
    //                         $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
    //                     }
    //                 } else {
    //                     $code_sl = "MP" .  $mydate . "0000" . strval(1);
    //                 }

    //                 $reservedslipnumber = SlipNumber::create([
    //                     'number' => $code_sl,
    //                     'slip_type' => 'mp',
    //                     'status' => 'passive',
    //                     'insured_number' => $request->code_ms
    //                 ]);

    //                 $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($deductibleup as $ddup) {
    //                     $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
    //                     $deductibleprocessup->status = 'active';
    //                     $deductibleprocessup->save();
    //                 }

    //                 $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($extendcoverageup as $ecup) {
    //                     $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
    //                     $extendcoverageprocessup->status = 'active';
    //                     $extendcoverageprocessup->save();
    //                 }

    //                 $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($installmentpansup as $ipup) {
    //                     $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
    //                     $inspanprocessup->status = 'active';
    //                     $inspanprocessup->save();
    //                 }

    //                 $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($retrocessionpanup as $rpup) {
    //                     $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
    //                     $retropanprocessup->status = 'active';
    //                     $retropanprocessup->save();
    //                 }

    //                 return response()->json(
    //                     [
    //                         'id' => $slipdataup->id,
    //                         'number' => $request->slipnumber,
    //                         'slipnumber' => $code_sl,
    //                         'slipstatus' => $slipdataup->status,
    //                         'date_transfer' => $slipdataup->date_transfer,
    //                         'ceding' => $slipdataup->ceding->name,
    //                         'cedingbroker' => $slipdataup->cedingbroker->name,
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]
    //                 );
    //             } else {

    //                 $currdate = date("Y-m-d");

    //                 $slipdataid = $slipdata->number;
    //                 $slipdataup = SlipTable::where('number', $slipdataid)->orderby('created_at', 'desc')->first();

    //                 if ($slipdataup->status != $request->slipstatus) {
    //                     StatusLog::create([
    //                         'status' => $request->slipstatus,
    //                         'user' => Auth::user()->name,
    //                         'datetime' => date('Y-m-d H:i:s '),
    //                         'insured_id' => $request->code_ms,
    //                         'slip_id' => $request->slipnumber,
    //                         'slip_type' => 'mp',
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]);
    //                 }

    //                 $slipdataup->number = $code_sl2;
    //                 $slipdataup->username = Auth::user()->name;
    //                 $slipdataup->insured_id = $request->code_ms;
    //                 $slipdataup->slip_type = 'mp';
    //                 $slipdataup->prod_year = $currdate;
    //                 // $slipdataup->date_transfer=date("Y-m-d", strtotime($request->slipdatetransfer));
    //                 $slipdataup->status = $request->slipstatus;
    //                 $slipdataup->endorsment = 0;
    //                 $slipdataup->selisih = "false";
    //                 $slipdataup->source = $request->slipcedingbroker;
    //                 $slipdataup->source_2 = $request->slipceding;
    //                 // $slipdataup->currency=$request->slipcurrency;
    //                 $slipdataup->cob = $request->slipcob;
    //                 $slipdataup->koc = $request->slipkoc;
    //                 $slipdataup->occupacy = $request->slipoccupacy;
    //                 $slipdataup->build_const = $request->slipbld_const;
    //                 $slipdataup->slip_no = $request->slipno;
    //                 $slipdataup->cn_dn = $request->slipcndn;
    //                 $slipdataup->policy_no = $request->slippolicy_no;
    //                 $slipdataup->attacment_file = '';
    //                 $slipdataup->interest_insured = $interestlist->toJSon();
    //                 $slipdataup->total_sum_insured = $request->sliptotalsum;
    //                 $slipdataup->share_tsi = $request->slipsharetotalsum;
    //                 $slipdataup->type_tsi = $request->sliptypetotalsum;
    //                 $slipdataup->type_share_tsi = $request->sliptypetsishare;
    //                 $slipdataup->total_day = $request->sliptotalday;
    //                 $slipdataup->total_year = $request->sliptotalyear;
    //                 $slipdataup->sum_total_date = $request->slipdatesum;
    //                 $slipdataup->insured_type = $request->sliptype;
    //                 $slipdataup->insured_pct = $request->slippct;
    //                 $slipdataup->total_sum_pct = $request->sliptotalsumpct;
    //                 $slipdataup->deductible_panel = $deductiblelist->toJson();
    //                 $slipdataup->extend_coverage = $extendcoveragelist->toJson();
    //                 $slipdataup->insurance_period_from = date("Y-m-d", strtotime($request->slipipfrom));
    //                 $slipdataup->insurance_period_to = date("Y-m-d", strtotime($request->slipipto));
    //                 $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($request->sliprpfrom));
    //                 $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($request->sliprpto));
    //                 $slipdataup->proportional = $request->slipproportional;
    //                 $slipdataup->layer_non_proportional = $request->sliplayerproportional;
    //                 $slipdataup->rate = $request->sliprate;
    //                 $slipdataup->sliptotalrate = $request->sliptotalrate;
    //                 $slipdataup->v_broker = $request->slipvbroker;
    //                 $slipdataup->sum_feebroker = $request->slipsumvbroker;
    //                 $slipdataup->share = $request->slipshare;
    //                 $slipdataup->sum_share = $request->slipsumshare;
    //                 $slipdataup->basic_premium = $request->slipbasicpremium;
    //                 $slipdataup->commission = $request->slipcommission;
    //                 $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
    //                 $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
    //                 $slipdataup->sum_commission = $request->slipsumcommission;
    //                 $slipdataup->installment_panel = $installmentlist->toJson();
    //                 $slipdataup->retrocession_panel = $retrocessionlist->toJson();
    //                 $slipdataup->retro_backup = $request->sliprb;
    //                 $slipdataup->own_retention = $request->slipor;
    //                 $slipdataup->sum_own_retention = $request->slipsumor;
    //                 $slipdataup->wpc = $request->wpc;
    //                 $slipdataup->remarks = $request->remarks;
    //                 $slipdataup->slipshow = "yes";
    //                 $slipdataup->warning_flag = "0";

    //                 $slipdataup->save();


    //                 $notification = array(
    //                     'message' => 'Moveable Property Slip Update successfully!',
    //                     'alert-type' => 'success'
    //                 );

    //                 //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mp')->first();
    //                 $insdata = Insured::where('number', $request->code_ms)->first();

    //                 $old_nasre_share = $insdata->share_from;
    //                 $new_nasre_share = $request->insured_share;


    //                 if ($new_nasre_share != $old_nasre_share) {
    //                     $msdata = Insured::findOrFail($insdata->id);

    //                     $msdata->share_from = $new_nasre_share;
    //                     $msdata->save();
    //                 }

    //                 $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
    //                 $slipnumberdata->status = 'active';
    //                 $slipnumberdata->save();

    //                 $currdate2 = date("Y-m-d");
    //                 $mydate = date("Y") . date("m") . date("d");
    //                 $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mp')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
    //                 $sliplastid = count($slip_now);
    //                 // dd($sliplastid);

    //                 if ($sliplastid != null) {
    //                     if ($sliplastid < 9) {
    //                         $code_sl = "MP" .  $mydate . "0000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 8 && $sliplastid < 99) {
    //                         $code_sl = "MP" .  $mydate . "000" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 98 && $sliplastid < 999) {
    //                         $code_sl = "MP" .  $mydate . "00" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 998 && $sliplastid < 9999) {
    //                         $code_sl = "MP" .  $mydate . "0" . strval($sliplastid + 1);
    //                     } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
    //                         $code_sl = "MP" .  $mydate . strval($sliplastid + 1);
    //                     }
    //                 } else {
    //                     $code_sl = "MP" .  $mydate . "0000" . strval(1);
    //                 }

    //                 $reservedslipnumber = SlipNumber::create([
    //                     'number' => $code_sl,
    //                     'slip_type' => 'mp',
    //                     'status' => 'passive',
    //                     'insured_number' => $request->code_ms
    //                 ]);

    //                 $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($deductibleup as $ddup) {
    //                     $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
    //                     $deductibleprocessup->status = 'active';
    //                     $deductibleprocessup->save();
    //                 }

    //                 $extendcoverageup = ExtendCoverageTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($extendcoverageup as $ecup) {
    //                     $extendcoverageprocessup = ExtendCoverageTemp::findOrFail($ecup->id);
    //                     $extendcoverageprocessup->status = 'active';
    //                     $extendcoverageprocessup->save();
    //                 }

    //                 $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($installmentpansup as $ipup) {
    //                     $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
    //                     $inspanprocessup->status = 'active';
    //                     $inspanprocessup->save();
    //                 }

    //                 $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mp')->where('status', 'passive')->orderby('id', 'desc')->get();
    //                 foreach ($retrocessionpanup as $rpup) {
    //                     $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
    //                     $retropanprocessup->status = 'active';
    //                     $retropanprocessup->save();
    //                 }

    //                 return response()->json(
    //                     [
    //                         'id' => $slipdataup->id,
    //                         'number' => $request->slipnumber,
    //                         'slipnumber' => $code_sl,
    //                         'slipstatus' => $slipdataup->status,
    //                         'ceding' => $slipdataup->ceding->name,
    //                         'date_transfer' => $slipdataup->date_transfer,
    //                         'cedingbroker' => $slipdataup->cedingbroker->name,
    //                         'count_endorsement' => $slipdataup->endorsment
    //                     ]
    //                 );
    //             }
    //         }
    //     } else {


    //         $notification = array(
    //             'message' => 'Moveable Property Slip added Failed!, missing data',
    //             'alert-type' => 'Failed'
    //         );

    //         return response($notification);
    //     }
    // }



    public function storeendorsementmpslip(Request $request)
    {
        $validator = $request->validate([
            'slipid' => 'required'
        ]);


        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('id', '=', $request->slipid)->first();
            // $slipdatalist= SlipTable::where('insured_id','=',$slipdata->insured_id)->where('slip_type','fe')->where('selisih','=','false')->get();
            $slipdatalist = SlipTable::where('id', '=', $request->slipid)->where('insured_id', '=', $slipdata->insured_id)->where('endorsment',$slipdata->endorsment)->where('slip_type', 'mp')->orderby('id', 'desc')->first();
            $insureddata = Insured::where('number', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->where('count_endorsement', $slipdata->endorsment)->first();

            // $id_ed = ($slipdata->id + 1);
            $num = "1";
            $id_ed = ((int)$slipdata->endorsment + (int)$num);

            $slipdatalast = SlipTable::where('endorsment', $id_ed)->where('id', '=', $request->slipid)->first();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();
            $locationlist = TransLocationTemp::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();
            $attachmentlist = SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->orderby('id', 'desc')->get();


            if ($slipdata == null) {
                $notification = array(
                    'message' => 'Movable Property Slip Endorsement Fail!',
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
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'count_endorsement' => ((int)$dt->count_endorsement + (int)$num),
                                'minus' => 'false'
                            ]);

                            // $jsondtlistup = DeductibleTemp::where('slip_id', '=', $dtlistup->slip_id)->where('insured_id', '=', $dtlistup->insured_id)->where('slip_type','fe')->where('minus','false')->where('count_endorsement', $dtlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsondtlistup = collect(DeductibleTemp::where('slip_id', '=', $dtlistup->slip_id)
                                                ->where('insured_id', '=', $dtlistup->insured_id)
                                                ->where('slip_type','mp')
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
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'count_endorsement' => ((int)$dt->count_endorsement + (int)$num),
                                'minus' => 'false'
                            ]);

                            $dtdata =  DeductibleTemp::findOrFail($dtlistupminus->id);
                            $dtdata->min_claimamount = ($dtlistupminus->min_claimamount * (-1));
                            $dtdata->amount = ($dtlistupminus->amount * (-1));
                            $dtdata->minus = "true";
                            $dtdata->save();

                            $jsondtlistupminus = DeductibleTemp::where('slip_id', '=', $dtdata->slip_id)->where('insured_id', '=', $dtdata->insured_id)->where('slip_type','mp')->where('minus','true')->where('count_endorsement', $dtlistupminus->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            
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
                                'count_endorsement' => ((int)$ect->count_endorsement + (int)$num),
                                'insured_id' => $ect->insured_id,
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            // $jsonectlistup = ExtendCoverageTemp::where('slip_id', '=', $ectlistup->slip_id)->where('insured_id', '=', $ectlistup->insured_id)->where('slip_type','fe')->where('minus','false')->where('count_endorsement', $ectlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsonectlistup = collect(ExtendCoverageTemp::where('slip_id', '=', $ectlistup->slip_id)
                                                ->where('insured_id', '=', $ectlistup->insured_id)
                                                ->where('slip_type','mp')->where('minus','false')
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
                                'count_endorsement' => ((int)$ect->count_endorsement + (int)$num),
                                'insured_id' => $ect->insured_id,
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $ectdata =  ExtendCoverageTemp::findOrFail($ectlistupminus->id);
                            $ectdata->amount = ($ectlistupminus->amount * (-1));
                            $ectdata->minus = "true";
                            $ectdata->save();

                            $jsonectlistupminus = ExtendCoverageTemp::where('slip_id', '=', $ectdata->slip_id)->where('insured_id', '=', $ectdata->insured_id)->where('slip_type','mp')->where('minus','true')->where('count_endorsement', $ectdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            
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
                                'slip_type' => "mp",
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            // $jsoniptlistup = InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)->where('insured_id', '=', $iptlistup->insured_id)->where('slip_type','fe')->where('minus','false')->where('count_endorsement', $iptlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsoniptlistup = collect(InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)
                                                ->where('insured_id', '=', $iptlistup->insured_id)
                                                ->where('slip_type','mp')
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
                                'slip_type' => "mp",
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $iptdata =  InstallmentTemp::findOrFail($iptlistupminus->id);
                            $iptdata->amount = ($iptlistupminus->amount * (-1));
                            $iptdata->minus = "true";
                            $iptdata->save();

                            $jsoniptlistupminus = InstallmentTemp::where('slip_id', '=', $iptdata->slip_id)->where('insured_id', '=', $iptdata->insured_id)->where('slip_type','mp')->where('minus','true')->where('count_endorsement', $iptdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                            
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
                                'count_endorsement' => ((int)$ect->count_endorsement + (int)$num),
                                'insured_id' => $rct->insured_id,
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $jsonrctlistup = RetrocessionTemp::where('slip_id', '=', $rctlistup->slip_id)->where('insured_id', '=', $rctlistup->insured_id)->where('slip_type','mp')->where('minus','false')->where('count_endorsement', $rctlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $datajsonrctlistup = collect(RetrocessionTemp::where('slip_id', '=', $rctlistup->slip_id)
                                                ->where('insured_id', '=', $rctlistup->insured_id)
                                                ->where('slip_type','mp')
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
                                'count_endorsement' => ((int)$ect->count_endorsement + (int)$num),
                                'insured_id' => $rct->insured_id,
                                'slip_type' => 'mp',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $rctdata =  RetrocessionTemp::findOrFail($rctlistupminus->id);
                            $rctdata->amount = ($rctlistupminus->amount * (-1));
                            $rctdata->minus = "true";
                            $rctdata->save();

                            $jsonrctlistupminus = RetrocessionTemp::where('slip_id', '=', $rctdata->slip_id)->where('insured_id', '=', $rctdata->insured_id)->where('slip_type','mp')->where('minus','true')->where('count_endorsement', $rctdata->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                            
                        }
                    }


                    // dd($slipdatalist);

                    if ($slipdatalist != null) {
                        if ($jsondtlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                                'slip_type' => 'mp',
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
                                'insurance_period_from' => date("Y-m-d", strtotime($request->slipipfrom)),
                                'insurance_period_to' => date("Y-m-d", strtotime($request->slipipto)),
                                'reinsurance_period_from' => date("Y-m-d", strtotime($request->sliprpfrom)),
                                'reinsurance_period_to' => date("Y-m-d", strtotime($request->sliprpto)),
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
                        'message' => 'Moveable Property Slip added Endorsement successfully!',
                        'alert-type' => 'success'
                    );




                    $msdata = SlipTable::findOrFail($slipdataupminus->id);
                    $msdata->total_sum_insured = ($slipdataupminus->total_sum_insured * (-1));
                    $msdata->total_sum_pct = ($slipdataupminus->total_sum_pct * (-1));
                    $msdata->sum_share = ($slipdataupminus->sum_share * (-1));
                    $msdata->sliptotalrate = ($slipdataupminus->sliptotalrate * (-1));
                    $msdata->sum_total_date = ($slipdataupminus->sum_total_date * (-1));
                    $msdata->sum_feebroker = ($slipdataupminus->sum_feebroker * (-1));
                    $msdata->basic_premium = ($slipdataupminus->basic_premium * (-1));
                    $msdata->commission = ($slipdataupminus->commission * (-1));
                    $msdata->grossprm_to_nr = ($slipdataupminus->grossprm_to_nr * (-1));
                    $msdata->netprm_to_nr = ($slipdataupminus->netprm_to_nr * (-1));
                    $msdata->sum_commission = ($slipdataupminus->sum_commission * (-1));
                    $msdata->wpc = ($slipdataupminus->wpc * (-1));
                    // $msdata->status='endorsement'; 
                    $msdata->sum_own_retention = ($slipdataupminus->sum_own_retention * (-1));
                    $msdata->selisih = "true";
                    $msdata->slipshow = "no";
                    $msdata->save();

                    $attachmentcheck = SlipTableFile::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mp')->get();

                    if ($attachmentcheck) {
                        foreach ($attachmentcheck as $atc) {
                            $attachmentupdate = SlipTableFile::findOrFail($atc->id);
                            $attachmentupdate->slip_id = $slipdataup->number;
                            $attachmentupdate->count_endorsement = ((int)$atc->count_endorsement + (int)$num);
                            $attachmentupdate->save();
                        }
                    }

                    $statuslogcheck = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mp')->get();

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
                            'datetime' => date('Y-m-d H:i:s '),
                            'slip_id' => $slipdataup->number,
                            'user' => $slipdataup->username,
                            'count_endorsement' => $slipdataup->endorsment,
                            'slip_type' => 'mp'
                        ]);
                    }
                    // $insdata =  Insured::findOrFail($insureddata->id);
                    // $insdata->share_from = ($insureddata->share_from * (1));
                    // $insdata->share_to = ($insureddata->share_to * (1));
                    // $insdata->save();

                    $cedingbroker = CedingBroker::where('id', $slipdataup->source)->first();
                    $ceding = CedingBroker::where('id', $slipdataup->source_2)->first();

                    $slipdataup->cedingbroker = $cedingbroker->name;
                    $slipdataup->ceding = $ceding->name;

                    $slipdatalist2 = SlipTable::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mp')->get();

                    //$locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();


                    $slipdatalist = array();
                    foreach ($slipdatalist2 as $datadetail) {
                        $datadetail->cedingbroker = "";
                        $datadetail->ceding = "";

                        if ($datadetail->cedingbroker) {
                            $dataceding = CedingBroker::where('id', '=', $datadetail->source)->first();
                            $datadetail->cedingbroker = $dataceding->name;
                            $datadetail->ceding = $dataceding->name;
                        } else {
                            $dataceding = CedingBroker::where('id', '=', $datadetail->source)->first();
                            $datadetail->cedingbroker = $dataceding->name;
                            $datadetail->ceding = $dataceding->name;
                        }



                        $slipdatalist[] = $datadetail;
                    }

                    $slipdata2 = DB::table('slip_table as stb')
                                ->where('stb.insured_id', $slipdataup->insured_id)
                                ->where('stb.slipshow', 'yes')
                                ->where('stb.slip_type', 'mp')
                                ->join('ceding_broker as cb1', 'stb.source', '=', 'cb1.id')
                                ->join('ceding_broker as cb2', 'stb.source', '=', 'cb2.id')
                                ->select('stb.*', 'cb1.name','cb1.company_name','cb2.name as source_name','cb2.company_name as source_companyname')
                                ->orderBy('stb.endorsment','desc')
                                ->orderBy('cb1.name', 'asc')
                                ->get();
                    // $slipdatadistict = SlipTable::select('number')->where('insured_id', $slipdataup->insured_id)->where('slipshow', 'yes')->where('slip_type', 'fe')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->distinct()->get('slip_table.number');
                    $dataslipdistict = collect(SlipTable::where('insured_id',$slipdataup->insured_id)
                                        ->where('slipshow', 'yes')
                                        ->where('selisih','false')
                                        ->where('slip_type', 'mp')
                                        ->orderBy('endorsment','desc')->get());
                    $slipdatadistict = $dataslipdistict->unique('number');
                    $slipdatadistict->values()->all();
                    
                    $maxdata = SlipTable::where('insured_id', $slipdataup->insured_id)->where('slip_type', 'mp')->orderby('endorsment', 'desc')->first();


                    return response()->json(
                        [
                            'slip_data' => $slipdataup->toJson(),
                            'slip_dataarray' => json_encode($slipdatalist),
                            'oldid' => $request->slipid,
                            'slip_data2' => $slipdata2->toJson(),
                            'slip_data_distinct' => $slipdatadistict->toJson(),
                            'max_endorsement' => $maxdata->endorsment,
                            // 'insured_data' => $insureddataup->toJson(),
                            // 'location_data' => $lookuplocationlist->toJson(),
                            // 'risklocation_data' => $risklocationlistdetail->toJson(),
                        ]
                    );
                } else {
                    $notification = array(
                        'message' => 'Moveable Property Slip added Endorsement Failed! data already endorsed!',
                        'alert-type' => 'error'
                    );

                    return response()->json(
                        $notification
                    );
                }
            }
        } else {

            $notification = array(
                'message' => 'Fire & Engginering Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }


    public function updateendorsement(Request $request)
    {

        $slipdata = SlipTable::where('id', '=', $request->slipid)->first();

        $interestlist = InterestInsuredTemp::where('insured_id', '=', $slipdata->insured_id)->orderby('id', 'desc')->get();
        $installmentlist = InstallmentTemp::where('slip_id', '=', $slipdata->number)->orderby('id', 'desc')->get();
        $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $slipdata->number)->orderby('id', 'desc')->get();
        $deductiblelist = DeductibleTemp::where('slip_id', '=', $slipdata->number)->orderby('id', 'desc')->get();
        $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $slipdata->number)->orderby('id', 'desc')->get();
        $attachmentlist = SlipTableFile::where('slip_id', '=', $slipdata->number)->orderby('id', 'desc')->get();

        $currdate = date("d/m/Y");

        $slipdataid = $slipdata->id;
        $slipdataup = SlipTable::findOrFail($slipdataid);

        $slipdataup->number = $request->slipnumber;
        $slipdataup->username = Auth::user()->name;
        $slipdataup->insured_id = $request->code_ms;
        $slipdataup->prod_year = $currdate;
        $slipdataup->date_transfer = $request->slipdatetransfer;
        $slipdataup->status = $request->slipstatus;
        $slipdataup->endorsment = $request->sliped;
        $slipdataup->selisih = $request->slipsls;
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
        $slipdataup->attacment_file = $attachmentlist->toJSon();
        $slipdataup->interest_insured = $interestlist->toJSon();
        $slipdataup->total_sum_insured = $request->sliptotalsum;
        $slipdataup->insured_type = $request->sliptype;
        $slipdataup->insured_pct = $request->slippct;
        $slipdataup->total_sum_pct = $request->sliptotalsumpct;
        $slipdataup->deductible_panel = $deductiblelist->toJson();
        $slipdataup->extend_coverage = $extendcoveragelist->toJson();
        $slipdataup->insurance_period_from = $request->slipipfrom;
        $slipdataup->insurance_period_to = $request->slipipto;
        $slipdataup->reinsurance_period_from = $request->sliprpfrom;
        $slipdataup->reinsurance_period_to = $request->sliprpto;
        $slipdataup->proportional = $request->slipproportional;
        $slipdataup->layer_non_proportional = $request->sliplayerproportional;
        $slipdataup->rate = $request->sliprate;
        $slipdataup->v_broker = $request->slipvbroker;
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
        $slipdataup->wpc = $request->wpc;

        $countendorsement = $slipdata->endorsment + 1;

        $slipdataup->endorsment = $countendorsement;
        $slipdataup->remarks = $request->remarks;

        $slipdataup->prev_endorsement = $request->prevslipnumber;
        $slipdataup->sum_own_retention = $request->slipsumor;

        $slipdataup->save();

        // InterestInsuredTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
        InstallmentTemp::where('slip_id', '=', $request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
        ExtendCoverageTemp::where('slip_id', '=', $request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
        DeductibleTemp::where('slip_id', '=', $request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
        RetrocessionTemp::where('slip_id', '=', $request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));


        $notification = array(
            'message' => 'Moveable Property Slip Update Endorsement successfully!',
            'alert-type' => 'success'
        );

        StatusLog::create([
            'status' => $request->slipstatus,
            'user' => Auth::user()->name,
            'insured_id' => $request->code_ms,
            'slip_id' => $request->slipnumber,
        ]);

        $cedingbroker = CedingBroker::where('id', $slipdataup->source)->first();
        $ceding = CedingBroker::where('id', $slipdataup->source_2)->first();

        return response()->json(
            [
                'id' => $slipdataup->id,
                'number' => $slipdataup->number,
                'slipuy' => $slipdataup->uy,
                'ceding' => $ceding->name,
                'cedingbroker' => $cedingbroker->name,
                'slipstatus' => $slipdataup->status
            ]
        );
        
    }


    public function destroy($id)
    {
        $insured = Insured::find($id);
        if($insured->delete())
        {
            $slip = SlipTable::where('insured_id', '=', $id);
            $slip->delete();

            $notification = array(
                'message' => 'Moveable Property Insured & Slip  deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
    

    public function changeDecline($id)
    {

        $slip = SlipTable::where('id', '=', $id);
        $slip->status = "decline";
        $slip->save();

        $notification = array(
            'message' => 'Moveable Property Insured & Slip Status Decline successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function changeCancel($id)
    {

        $slip = SlipTable::where('id', '=', $id);
        $slip->status = "cancel";
        $slip->save();

        $notification = array(
            'message' => 'Moveable Property Insured & Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function changeCancelNumber($id)
    {

        $slip = SlipTable::where('number', '=', $id);
        $slip->status = "cancel";
        $slip->save();

        $notification = array(
            'message' => 'Moveable Property Insured & Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

}
