<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Insured;


use Illuminate\Support\Facades\DB;
use App\Models\COB;
use App\Models\Occupation;
use App\Models\Koc;
use App\Models\SlipTable;
use App\Models\SlipTableFile;
use App\Models\SlipTableFileTemp;
use App\Models\CedingBroker;
use App\Models\FeLookupLocation;
use App\Models\MarineLookup;
use App\Models\Customer;
use App\Models\ConditionNeeded;
use App\Models\ExtendedCoverage;
use App\Models\ConditionNeededTemp;
use App\Models\RouteShip;
use App\Models\Currency;
use App\Models\CurrencyExchange;
use App\Models\DeductibleType;
use App\Models\Customer\Customer as CustomerCustomer;
use App\Models\ShipListTemp;
use App\Models\TranslocationTemp;
use App\Models\StatusLog;
use App\Models\InterestInsured;
use App\Models\InstallmentTemp;
use App\Models\InterestInsuredTemp;
use App\Policies\FelookupLocationPolicy;
use Illuminate\Support\Facades\Auth;
use App\Models\ExtendCoverageTemp;
use App\Models\DeductibleTemp;
use App\Models\RetrocessionTemp;
use App\Models\PropertyType;
use App\Models\PropertyTypeTemp;
use App\Models\TransPropertyTemp;
use App\Models\HoleDetail;
use App\Models\GolfFieldHole;
use App\Models\InsuredNumber;
use App\Models\SlipNumber;
use App\Models\PrefixInsured;
use App\Models\MarineHullCountType;
use App\Models\InsuredMarineType;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class MarineHullController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Marine Hull - Slip Entry';
        $search = @$request->input('search');
        
        $mydate = date("Y").date("m").date("d");
        
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $cur_year = date("Y");
        $cur_month = date("m");
        $userid = Auth::user()->id;
  
        $slip = SlipTable::orderby('id','asc')->get();    
        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();
       
        $cob = COB::whereRaw('LEFT(code,2) = 12')->orWhereRaw('LEFT(code,2) = 13')->orWhereRaw('LEFT(code,2) = 14')->orderby('id', 'asc')->get();
        $business_type = BusinessType::orderBy('id','asc')->get();
        //$koc = Koc::orderby('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
       
        $ocp = Occupation::orderby('id','asc')->get();
        $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
        $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $broker = CedingBroker::orderby('id','asc')->where('type','5')->get()->unique('code');
        $cedinginsured = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $felookup = FelookupLocation::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id','asc')->get();
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::orderby('id','asc')->get();
        $costumer=CustomerCustomer::orderby('id','asc')->get();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        $marinehulltype = InsuredMarineType::orderby('id','asc')->get();
        
        
        //$insured = Insured::orderby('id','asc')->where("number", "LIKE", "%IN". $mydate ."%")->get();
        //$insured_now = Insured::whereDate('created_at', $currdate2)
        $insured = Insured::whereDate('created_at',$currdate2)->orderby('id','asc')->get();

        $ms_ids = response()->json($insured->modelKeys());

        $lastid = count($insured);
        $sliplastid = count($slip);
        $prefixinsured = PrefixInsured::orderby('id','asc')->get();


        if($lastid != null)
        {
            if($lastid <= 9)
            {
                $code_ms = "IN". $mydate . "0000" . strval($lastid + 1);
            }   
            elseif($lastid > 9 && $lastid <= 99)
            {
                $code_ms = "IN". $mydate . "000" . strval($lastid + 1);
            }
            elseif($lastid > 99 && $lastid <= 999)
            {
                $code_ms = "IN". $mydate . "00" . strval($lastid + 1);
            }
            elseif($lastid > 999 && $lastid <= 9999)
            {
                $code_ms = "IN". $mydate . "0" . strval($lastid + 1);
            }
            elseif($lastid > 9999 && $lastid <= 99999)
            {
                $code_ms = "IN". $mydate  . strval($lastid + 1);
            }
        }
        else{
            $code_ms = "IN" . $mydate . "0000" . strval(1);
        }


        $brokerchoice = DB::table('shiplist_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                        ->where('shiplist_detail.insured_id', '=', $code_ms)
                        ->where('ceding_broker.type', '=', 5)
                        ->orWhere('ceding_broker.type', '=', 4)
                        ->orderByRaw("FIELD(ceding_broker.id , (SELECT GROUP_CONCAT(DISTINCT(ceding_id) SEPARATOR ',') FROM shiplist_detail WHERE insured_id= '".$code_ms."')) DESC")
                        ->select('shiplist_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->distinct()
                        ->get();


        $slipdata = SlipTable::where('insured_id', $code_ms)->first();
        // $slipdatadistict = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mh')->orderby('id','desc')->distinct()->get();
        $slipdatadistict = collect(SlipTable::where('insured_id',$code_ms)
                            ->where('slipshow', 'yes')
                            ->where('selisih','false')
                            ->where('slip_type', 'mh')
                            ->orderBy('endorsment','desc')->get());

        $slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mh')->orderby('id', 'desc')->get();
        // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mh')->where('insured_id',$code_ms)->orderby('id','asc')->get();
        $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mh')->where('insured_id', $code_ms)->orderby('id', 'desc')->get();
        $sliplastid = count($slip_now);
        // dd($sliplastid);

        if($sliplastid != null)
        {
            if($sliplastid < 9)
            {
                $code_sl = "MH".  $mydate . "0000" . strval($sliplastid + 1);
            }   
            elseif($sliplastid > 8 && $sliplastid < 99)
            {
                $code_sl = "MH".  $mydate . "000" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 98 && $sliplastid < 999)
            {
                $code_sl = "MH".  $mydate . "00" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 998 && $sliplastid < 9999)
            {
                $code_sl = "MH".  $mydate . "0" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 9998 && $sliplastid < 99999)
            {
                $code_sl = "MH".  $mydate . strval($sliplastid + 1);
            }

            
        }
        else
        {
            $code_sl = "MH".  $mydate . "0000" . strval(1);
        }


        $checkinsurednumber = InsuredNumber::where('number',$code_ms)->where('slip_type','mh')->where('status','passive')->first();
        // $insurednumform = '';
        $checkslipnumber= SlipNumber::where('number',$code_sl)->where('insured_number',$code_ms)->where('slip_type','mh')->where('status','passive')->first();
        // $slipnumform = '';
        
        if($checkinsurednumber != null)
        {
            
            if($checkslipnumber != null)
            {
                
                $insurednumform = $code_ms;
                $slipnumform = $code_sl;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                // $locationid = TransLocationTemp::select('id')->where('insured_id','=',$code_ms)->orderby('id','desc')->get();
                // foreach($locationid as $dataid)
                // {
                //     RiskLocationDetail::where('translocation_id','=',$dataid->id)->delete();
                // }
                
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->delete();
                $hulldetail2= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->where('status','=','passive')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                //$conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();

                $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $hulldetail= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','active')->orderby('id','desc')->get();

            
                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();

                return view('crm.transaction.marine_hull_slip', compact(['slipdatadistict','hulldetail','marinehulltype','broker','brokerchoice','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            
            }
            elseif($checkslipnumber == null)
            {    

                $insurednumform = $code_ms;

                $reservedslipnumber = SlipNumber::create([
                            'number'=>$code_sl,
                            'slip_type'=>'mh',
                            'status'=>'passive',
                            'insured_number'=>$code_ms     
                    ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                // $locationid = TransLocationTemp::select('id')->where('insured_id','=',$code_ms)->orderby('id','desc')->get();
                // foreach($locationid as $dataid)
                // {
                //     RiskLocationDetail::where('translocation_id','=',$dataid->id)->delete();
                // }
                
                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->delete();
                $hulldetail2= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->where('status','=','passive')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                //$conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();

                $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $hulldetail= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->get();
                
                // $locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','mh')->orderby('id','desc')->get();


                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();

                return view('crm.transaction.marine_hull_slip', compact(['slipdatadistict','hulldetail','marinehulltype','broker','brokerchoice','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            }

        }
        elseif($checkinsurednumber == null)
        {
             

            if($checkslipnumber != null){
               
                    InsuredNumber::where('number',$code_ms)->where('slip_type','mh')->where('status','passive')->delete();

                    $reservedinsurednumber = InsuredNumber::create([
                                    'number'=>$code_ms,
                                    'status'=>'passive',
                                    'slip_type'=>'mh'     
                        ]);

                    $insurednumform = $reservedinsurednumber->number;
                
                    $slipnumform = $code_sl;

                    $interestinsured= InterestInsured::orderby('id','asc')->get();
                    
                    // $locationid = TransLocationTemp::select('id')->where('insured_id','=',$code_ms)->orderby('id','desc')->get();
                    // foreach($locationid as $dataid)
                    // {
                    //     RiskLocationDetail::where('translocation_id','=',$dataid->id)->delete();
                    // }
                    
                    // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                    $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->delete();
                    $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    $hulldetail2= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->where('status','=','passive')->orderby('id','desc')->delete();
                    // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    //$conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                    $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();

                    $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                    $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $hulldetail= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->orderby('id','desc')->get();
                    // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                    $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->get();

                    // $locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','mh')->orderby('id','desc')->get();

                    
                    // $locationlist=array();
                    // foreach($locationlist2 as $datadetail)
                    // {
                    //     if($datadetail->risklocationdetail){
                    //         $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id','=',$datadetail->id)->delete();
                            
                    //     }else{
                    //         $datadetail->risklocationdetail= RiskLocationDetail::where('translocation_id','=',$datadetail->id)->orderby('id','desc')->get();
                    //     }
                    //     $locationlist[]= $datadetail;
                    // }


                    $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();

                    return view('crm.transaction.marine_hull_slip', compact(['slipdatadistict','hulldetail','marinehulltype','broker','brokerchoice','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            
            }
            elseif($checkslipnumber == null)
            {
                
                InsuredNumber::where('number',$code_ms)->where('slip_type','mh')->where('status','passive')->delete();
                // dd($code_ms);
                $reservedinsurednumber = InsuredNumber::create([
                            'number'=>$code_ms,
                            'status'=>'passive',
                            'slip_type'=>'mh'     
                ]);

                 $insurednumform = $reservedinsurednumber->number;

                $reservedslipnumber = SlipNumber::create([
                            'number'=>$code_sl,
                            'slip_type'=>'mh',
                            'status'=>'passive',
                            'insured_number'=>$code_ms     
                    ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                // $locationid = TransLocationTemp::select('id')->where('insured_id','=',$code_ms)->orderby('id','desc')->get();
                // foreach($locationid as $dataid)
                // {
                //     RiskLocationDetail::where('translocation_id','=',$dataid->id)->delete();
                // }
                
                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $hulldetail2= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                //$conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $hulldetail= MarineHullCountType::where('insured_id','=',$code_ms)->where('slip_id','=',$code_sl)->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->get();

                // $locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','mh')->orderby('id','desc')->get();

            
                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();

                return view('crm.transaction.marine_hull_slip', compact(['slipdatadistict','hulldetail','marinehulltype','broker','brokerchoice','customer','conditionneededlist','cedinginsured','routeship','mlu','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            }

        }
    }



    public function showSlipHullList(Request $request)
    {
        $slipdata2 = SlipTable::where('number', $request->slipnumber)->where('slipshow', 'yes')->where('selisih','false')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->orderby('id', 'desc')->get();
        
        //$slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mh')->orderby('id', 'desc')->get();
        
        $newarrayslipdata = [];
        if(!empty($slipdata2)) 
        {
            foreach($slipdata2 as $mydata) 
            {
                if(!empty($mydata->source))
                {
                    $cedingbroker = CedingBroker::where('id', $mydata->source)->first();
                    $mydata->cedingbroker = $cedingbroker->name;
                }
                else{
                    $mydata->cedingbroker = "";
                }

                if(!empty($mydata->source2))
                {
                    $ceding = CedingBroker::where('id', $mydata->source2)->first();
                    $mydata->ceding = $ceding->name;
                }
                else{
                    $mydata->ceding = "";
                }

                array_push($newarrayslipdata, $mydata);
            }
        }

        return response()->json(
            [  
                'slipdata' => $newarrayslipdata,
            ]);
    }

    
    public function showTypeList(Request $request)
    {
        $typehull = DB::table("insured_marine_type")
        ->where("id",$request->hull_type)
        ->first();
        return response()->json($typehull);
    }



    public function storeinsured(Request $request)
    {
        $validator = $request->validate([
            'msinumber'=>'required',
            'msisuggestinsured'=>'required'
        ]);
        $sum_amount = DB::table('risk_location_detail')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', $request->msinumber)
                ->where('trans_location_detail.slip_type', 'mh')
                ->sum('risk_location_detail.amountlocation');
        $costumcheck = CustomerCustomer::where('company_name', '=', $request->msisuggestinsured)->first();
        if ($costumcheck == null) 
        {
            $prefixcos = $request->msiprefix;

            $msisuggestinsuredlen=strlen($request->msisuggestinsured);
            $msisuffixlen=strlen($request->msisuffix);
            
            if($msisuggestinsuredlen>100)
            {
                $msisuggestinsured=substr($request->msisuggestinsured,0,100);
            }
            else {
                $msisuggestinsured=$request->msisuggestinsured;
            }

            if($msisuffixlen>100)
            {
                $msisuffix=substr($request->msisuffix,0,100);
            }
            else {
                $msisuffix=$request->msisuffix;
            }

            if($prefixcos == 1){
                CustomerCustomer::create([
                    'owner_id' => '1',
                    'industry_id' => '27',
                    'company_prefix' => "PT",
                    'company_name' => $msisuggestinsured,
                    'website' => $msisuggestinsured,
                    'company_suffix' => $msisuffix
                ]); 
            }
            else
            {
                    CustomerCustomer::create([
                    'owner_id' => '1',
                    'industry_id' => '27',
                    'company_prefix' => 'CV',
                    'company_name' => $msisuggestinsured,
                    'website' => $msisuggestinsured,
                    'company_suffix' => $msisuffix
                ]);
            }
            
        }

        $shiplist= ShipListTemp::where('insured_id','=',$request->msinumber)->where('status','=','passive')->where('slip_type','mh')->orderby('created_at','desc')->get();
        
        if($validator)
        {
            $user = Auth::user();
            
            $insureddata= Insured::where('number','=',$request->msinumber)->first();

            if($insureddata==null)
            {
                $msisuggestinsuredlen=strlen($request->msisuggestinsured);
                $msisuffixlen=strlen($request->msisuffix);
                
                if($msisuggestinsuredlen>100)
                {
                    $msisuggestinsured=substr($request->msisuggestinsured,0,100);
                }
                else {
                    $msisuggestinsured=$request->msisuggestinsured;
                }

                if($msisuffixlen>100)
                {
                    $msisuffix=substr($request->msisuffix,0,100);
                }
                else {
                    $msisuffix=$request->msisuffix;
                }

                $insureddataup = Insured::create([
                    'number'=>$request->msinumber,
                    'slip_type'=>'mh',
                    'prefix_id' => $request->msiprefix,
                    'insured_name'=>strtoupper($msisuggestinsured),
                    'insured_suffix'=>strtoupper($msisuffix),
                    'route'=>$request->msiroute,
                    'route_from'=>$request->msiroutefrom,
                    'route_to'=>$request->msirouteto,
                    'share'=>$request->msishare,
                    'share_from'=>$request->msisharefrom,
                    'share_to'=>$request->msishareto,
                    'currency_id'=>$request->msicurrency,
                    'statmodified' => 1,
                    'uy'=>$request->msiuy,
                    'flag_overseas'=>$request->msiflag_overseas,
                    'business_id'=>$request->msibusiness_id,
                    'ship_detail'=>$shiplist->toJson()
                    // 'coincurance'=>$request->msicoinsurance
                ]);

                $insurednumberdata = InsuredNumber::where('number', $request->msinumber)->orderby('id', 'desc')->first();
                $insurednumberdata->status = 'active';
                $insurednumberdata->save();

                $shiplistup = ShiplistTemp::where('insured_id', '=', $request->msinumber)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($shiplistup as $slup) {
                    $shiplistprocessup = ShiplistTemp::findOrFail($slup->id);
                    $shiplistprocessup->status = 'active';
                    $shiplistprocessup->save();

                
                }

                $notification = array(
                    'message' => 'Marine Insured added successfully!',
                    'id' => $insureddataup->id,
                    'count_endorsement' => $insureddataup->count_endorsement,
                    'alert-type' => 'success'
                );
            }
            else
            {
                $msisuggestinsuredlen=strlen($request->msisuggestinsured);
                $msisuffixlen=strlen($request->msisuffix);
                
                if($msisuggestinsuredlen>100)
                {
                    $msisuggestinsured=substr($request->msisuggestinsured,0,100);
                }
                else {
                    $msisuggestinsured=$request->msisuggestinsured;
                }

                if($msisuffixlen>100)
                {
                    $msisuffix=substr($request->msisuffix,0,100);
                }
                else {
                    $msisuffix=$request->msisuffix;
                }

                $insureddataid=$insureddata->id;
                $insureddataup = Insured::findOrFail($insureddataid);
                $insureddataup->slip_type='mh';
                $insureddataup->prefix_id=$request->msiprefix;
                $insureddataup->insured_name=$msisuggestinsured;
                $insureddataup->insured_suffix=$msisuffix;
                $insureddataup->route=$request->msiroute;
                $insureddataup->route_from=$request->msiroutefrom;
                $insureddataup->route_to=$request->msirouteto;
                $insureddataup->share=$request->msishare;
                $insureddataup->share_from=$request->msisharefrom;
                $insureddataup->share_to=$request->msishareto;
                $insureddataup->currency_id= $request->msicurrency;
                $insureddataup->statmodified = 1;
                $insureddataup->uy = $request->msiuy;
                $insureddataup->flag_overseas = $request->msiflag_overseas;
                $insureddataup->business_id = $request->msibusiness_id;
                $insureddataup->uy = $request->msiuy;

                $insureddataup->ship_detail=$shiplist->toJson();
                // $insureddataup->coincurance=$request->msicoinsurance;
                $insureddataup->save();

                $insurednumberdata = InsuredNumber::where('number', $request->msinumber)->orderby('id', 'desc')->first();
                $insurednumberdata->status = 'active';
                $insurednumberdata->save();

                $shiplistup = ShiplistTemp::where('insured_id', '=', $request->msinumber)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($shiplistup as $slup) {
                    $shiplistprocessup = ShiplistTemp::findOrFail($slup->id);
                    $shiplistprocessup->status = 'active';
                    $shiplistprocessup->save();

                  
                }
                if ($sum_amount != strval($request->msishareto)) {
                    $warning_flag = 1;
                }else{
                    $warning_flag = 0;
                }
                $SlipTableUp = SlipTable::where('insured_id', '=', $request->msinumber)->where('slip_type', 'mh')->where('slipshow', 'yes')->orderby('id', 'desc')->get();
                    foreach ($SlipTableUp as $stu) {
                        $sliptableprocessup = SlipTable::findOrFail($stu->id);
                        $sliptableprocessup->warning_flag = $warning_flag;
                        $sliptableprocessup->save();
                    }
                // checking trans_location_detail 
                        
                        $dataShipList = ShipListTemp::where('insured_id',$request->msinumber)->where('status','active')->where('slip_type','mh')->get();
                        foreach ($dataShipList as $dataShipList) {
                            $id = $dataShipList->id;
                            $amount = strval($dataShipList->amount);
                            $amountup = strval($request->msishareto);
                            $percent = ($amount/$amountup)*100;
                            $updateShipListTemp = ShipListTemp::findOrFail($id);
                            $updateShipListTemp->percent = $percent;
                            $updateShipListTemp->save();
                        }
                        
                        // End checking
                $notification = array(
                    'message' => 'Marine Insured Update successfully!',
                    'warning_flag' => $warning_flag,
                    'id' => $insureddataup->id,
                    'count_endorsement' => $insureddataup->count_endorsement,
                    'alert-type' => 'success'
                );
            }
            // dd($shiplist);
            // ShipListTemp::whereIn('id', $shiplist->id)->update(['status' => 'saved']);
            // ShipListTemp::where('status','pending')->delete();

            // return back()->with($notification);
            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Marine Insured added Failed!',
                'alert-type' => 'danger'
            );

            // return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
        return response($notification);
    }

    public function storeslip(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);


        if ($validator) 
        {
            $user = Auth::user();

            $checkslipnumber = SlipNumber::where('number', $request->slipnumber)->where('insured_number', $request->code_ms)->where('slip_type', 'mh')->where('status', 'active')->first();


            if ($checkslipnumber == null) 
            {
                $slipdata = SlipTable::where('number', '=', $request->slipnumber)->first();

                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $hullcountlist = MarineHullCountType::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('deleted_at', null)->orderby('id', 'desc')->get();
                $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('deleted_at', null)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('deleted_at', null)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('deleted_at', null)->orderby('id', 'desc')->get();


                if ($slipdata == null) 
                {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $request->slipnumber,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mh',
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
                        //'attacment_file'=>json_encode($attachmentlist),
                        'attacment_file' => '',
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
                        'condition_needed' => $conditionneededlist->toJson(),
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
                        'hull_detail' => $hullcountlist->toJson(),
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
                        'message' => 'Marine Hull Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mh',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mh')->first();
                    $insdata = Insured::where('number', $slipdataup->insured_id)->where('slip_type','mh')->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) 
                    {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mh')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MH" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MH" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mh',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $marinehullcount = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($marinehullcount as $mhct) {
                        $marinehullcountprocessup = MarineHullCountType::findOrFail($mhct->id);
                        $marinehullcountprocessup->status = 'active';
                        $marinehullcountprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                else 
                {

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
                            'slip_type' => 'mh',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $request->slipnumber;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mh';
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
                    $slipdataup->slip_no = $request->slipno;
                    $slipdataup->cn_dn = $request->slipcndn;
                    $slipdataup->policy_no = $request->slippolicy_no;
                    $slipdataup->attacment_file = '';
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
                    $slipdataup->condition_needed = $conditionneededlist->toJson();
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
                    $slipdataup->hull_detail = $hullcountlist->toJson();
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
                        'message' => 'Marine Hull Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mh')->first();
                    $insdata = Insured::where('number', $slipdataup->insured_id)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mh')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MH" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MH" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mh',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $marinehullcount = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($marinehullcount as $mhct) {
                        $marinehullcountprocessup = MarineHullCountType::findOrFail($mhct->id);
                        $marinehullcountprocessup->status = 'active';
                        $marinehullcountprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                            'ceding' => @$slipdataup->ceding->name,
                            'cedingbroker' => $slipdataup->cedingbroker->name,
                            'count_endorsement' => $slipdataup->endorsment
                        ]
                    );
                }
            
            } 
            else 
            {

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
                    'slip_type' => 'mh',
                    'status' => 'active',
                    'insured_number' => $request->code_ms
                ]);

                $marinehullcount = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($marinehullcount as $mhct) {
                        $marinehullcountprocessup = MarineHullCountType::findOrFail($mhct->id);
                        $marinehullcountprocessup->status = 'active';
                        $marinehullcountprocessup->save();
                    }

                $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($deductibleup as $ddup) {
                    $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                    $deductibleprocessup->slip_id = $code_sl2;
                    $deductibleprocessup->save();
                }

               $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->slip_id = $code_sl2;
                        $conditionneededprocessup->save();
                    }

                $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($installmentpansup as $ipup) {
                    $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                    $inspanprocessup->slip_id = $code_sl2;
                    $inspanprocessup->save();
                }

                $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($retrocessionpanup as $rpup) {
                    $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                    $retropanprocessup->slip_id = $code_sl2;
                    $retropanprocessup->save();
                }


                $slipdata = SlipTable::where('number', '=', $code_sl2)->first();

                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $hullcountlist = MarineHullCountType::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
                $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();

                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $code_sl2,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mh',
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
                        'slip_no' => $request->slipno,
                        'cn_dn' => $request->slipcndn,
                        'policy_no' => $request->slippolicy_no,
                        //'attacment_file'=>json_encode($attachmentlist),
                        'attacment_file' => '',
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
                        'condition_needed' => $conditionneededlist->toJson(),
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
                        'hull_detail' => $hullcountlist->toJson(),

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
                        'message' => 'Marine Hull Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mh',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);




                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mh')->first();
                    $insdata = Insured::where('number', $slipdataup->insured_id)->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mh')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MH" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MH" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mh',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $marinehullcount = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($marinehullcount as $mhct) {
                        $marinehullcountprocessup = MarineHullCountType::findOrFail($mhct->id);
                        $marinehullcountprocessup->status = 'active';
                        $marinehullcountprocessup->save();
                    }

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                else 
                {

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
                            'slip_type' => 'mh',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $code_sl2;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mh';
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
                    $slipdataup->slip_no = $request->slipno;
                    $slipdataup->cn_dn = $request->slipcndn;
                    $slipdataup->policy_no = $request->slippolicy_no;
                    $slipdataup->attacment_file = '';
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
                    $slipdataup->condition_needed = $conditionneededlist->toJson();
                    $slipdataup->insurance_period_from = date("Y-m-d", strtotime($request->slipipfrom));
                    $slipdataup->insurance_period_to = date("Y-m-d", strtotime($request->slipipto));
                    $slipdataup->reinsurance_period_from = date("Y-m-d", strtotime($request->sliprpfrom));
                    $slipdataup->reinsurance_period_to = date("Y-m-d", strtotime($request->sliprpto));
                    $slipdataup->proportional = $request->slipproportional;
                    $slipdataup->layer_non_proportional = $request->sliplayerproportional;
                    $slipdataup->v_broker = $request->slipvbroker;
                    $slipdataup->sum_feebroker = $request->slipsumvbroker;
                    $slipdataup->share = $request->slipshare;
                    $slipdataup->sum_share = $request->slipsumshare;
                    $slipdataup->basic_premium = $request->slipbasicpremium;
                    $slipdataup->commission = $request->slipcommission;
                    $slipdataup->grossprm_to_nr = $request->slipgrossprmtonr;
                    $slipdataup->netprm_to_nr = $request->slipnetprmtonr;
                    $slipdataup->sum_commission = $request->slipsumcommission;
                    $slipdataup->hull_detail = $hullcountlist->toJson();

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
                        'message' => 'Marine Hull Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mh')->first();
                    $insdata = Insured::where('number', $slipdataup->insured_id)->where('slip_type','mh')->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mh')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MH" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MH" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mh',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $marinehullcount = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($marinehullcount as $mhct) {
                        $marinehullcountprocessup = MarineHullCountType::findOrFail($mhct->id);
                        $marinehullcountprocessup->status = 'active';
                        $marinehullcountprocessup->save();
                    }

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                   $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
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
            }
        
        } 
        else 
        {


            $notification = array(
                'message' => 'Marine Hull Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }

    }



    public function storehullcount(Request $request)
    {

        $type_hull = $request->type_id;
        $share_hull = $request->share;
        $amount_hull = $request->amount;
        $rate_hull = $request->rate;
        $premi_hull = $request->basic_premium;
        $insured_id = $request->insured_id;
        $slip_id = $request->slip_id;
        $slip_type = $request->sliptype;
        $group_type = $request->grouptype;
        $hulltype2 = InsuredMarineType::where('id', $type_hull)->first();
        if($request->countendorsement){
            $count_endorsement = $request->countendorsement;
        }else{
            $count_endorsement = 0;
        }
        if ($amount_hull != '' && $slip_id != '' && !empty($hulltype2) && !empty($type_hull)) 
        {
            $checkExist = MarineHullCountType::where('insured_id',$insured_id)->where('slip_id',$slip_id)->where('type_id',$type_hull)->where('count_endorsement',$count_endorsement)->where('deleted_at',null)->where('status','passive')->first();
            if ($checkExist != null) {
                return response()->json([
                    'success' => false,
                    'message'=> "Data duplicated"
                ]);
            }
            $hulltype = InsuredMarineType::where('id', $type_hull)->first();

            $hullcountlist = new MarineHullCountType();
            $hullcountlist->type_id = $type_hull;
            $hullcountlist->insured_id = $insured_id;
            $hullcountlist->slip_id = $slip_id;
            $hullcountlist->share = $share_hull;
            $hullcountlist->amount = $amount_hull;
            $hullcountlist->rate = $rate_hull;
            $hullcountlist->basic_premium = $premi_hull;
            $hullcountlist->status = "passive";
            $hullcountlist->count_endorsement = (int) $count_endorsement;
            $hullcountlist->minus = "false";
            $hullcountlist->save();

            //$felookuplocations = FeLookupLocation::find($adrress);
            // $locationlist2 = RiskLocationDetail::where('id', '=', $locationlist->id);

            // $cedingbroker = CedingBroker::where('id', $request->ceding_id)->first();
           
            $sumperhull = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                ->where('marine_hull_detail.insured_id', $insured_id)
                ->where('marine_hull_detail.slip_id', $slip_id)
                ->where('marine_hull_detail.status', 'passive')
                ->where('marine_hull_detail.count_endorsement', $count_endorsement)
                ->where('marine_hull_detail.deleted_at', null)
                ->sum('marine_hull_detail.basic_premium'); 

             $sumamount = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                ->where('marine_hull_detail.status', 'passive')
                ->where('marine_hull_detail.count_endorsement', $count_endorsement)
                ->where('marine_hull_detail.insured_id', $insured_id)->where('marine_hull_detail.slip_id', $slip_id)->where('marine_hull_detail.deleted_at', null)
                ->sum('marine_hull_detail.amount'); 

     
            $sumshare = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('marine_hull_detail.insured_id', $insured_id)->where('marine_hull_detail.slip_id', $slip_id)->where('marine_hull_detail.deleted_at', null)
            ->where('marine_hull_detail.count_endorsement', $count_endorsement)
            ->where('marine_hull_detail.status', 'passive')
            ->sum('marine_hull_detail.share'); 



            return response()->json([
                'success' => true,
                'id' => $hullcountlist->id,
                'slip_id' =>  $hullcountlist->slip_id,
                'insured_id' => $hullcountlist->insured_id,
                'share' => $hullcountlist->share,
                'type_code' => @$hulltype->code,
                'type_name' => @$hulltype->type,
                'amount' => $hullcountlist->amount,
                'rate' =>$hullcountlist->rate,
                'premi' => $hullcountlist->basic_premium,
                'sum_premi' => $sumperhull,
                'sum_amount' => $sumamount,
                'sum_share' => $sumshare,
                'countendorsement' => $count_endorsement
                // 'kurs'=> $currency->code
            ]);
        }
         else 
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fill all fields',
                    '$count_endorsement' => $count_endorsement
                ]
            );
        }
    }



    public function updateinsured(request $request, $id)
    {

        $shiplist = ShiplistTemp::where('insured_id',$request->msinumber)->orderby('id','asc')->get();

        $validator = $request->validate([
            'msinumber'=>'required',
                'msiprefix'=>'required',
                'msisuggestinsured'=>'required'
        ]);

        
        
        if($validator){

            $isd = Insured::find($id);
            $isd->number = $request->msinumber;
            $isd->insured_prefix = $request->msiprefix;
            $isd->insured_name = $request->msisuggestinsured;
            $isd->insured_suffix = $request->msisuffix;
            $isd->route = $request->msiroute;
            $isd->route_from = $request->msiroutefrom;
            $isd->route_to = $request->msirouteto;
            $isd->share = $request->msishare;
            $isd->share_from = $request->msisharefrom;
            $isd->share_to = $request->msishareto;
            $isd->ship_detail = $shiplist->toJson();
            $isd->coincurance = $request->msicoinsurance;
            $isd->save();
            

            return response()->json($isd);
        }
        else
        {
            return response()->json($validator);
        }
    }
    



    public function updatemarinehullslip($idm)
    {
        $user = Auth::user();
        //print_r($user);
        //exit();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'Marine Hull - Slip Entry';
        $mydate = date("Y") . date("m") . date("d");
        $costumer = CustomerCustomer::orderby('id', 'asc')->get();
        $customer = CustomerCustomer::orderby('id', 'asc')->get();
        $sign = "update";
        $cur_year = date("Y");
        $cur_month = date("m");
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $insured = Insured::orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();
        
        //$currency = CurrencyExchange::join('currencies','currencies_exc.currency',"=","currencies.id")->where('currencies_exc.year',$cur_year)->where('currencies_exc.month',$cur_month)->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        
        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();
       
        //$cob = COB::orderby('id', 'asc')->get();
        $cob = COB::whereRaw('LEFT(code,2) = 12')->orWhereRaw('LEFT(code,2) = 13')->orWhereRaw('LEFT(code,2) = 14')->orderby('id', 'asc')->get();
        $business_type = BusinessType::orderBy('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
        
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get()->unique('code');
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get()->unique('code');
        $broker = CedingBroker::orderby('id', 'asc')->where('type', 5)->get()->unique('code');
        $cedinginsured = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $prefixinsured =  PrefixInsured::orderby('id', 'asc')->get();
        // $felookup = FelookupLocation::orderby('id','asc')->get();
        $marinehulltype = InsuredMarineType::orderby('id','asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();
        $mlu = MarineLookup::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $conditionneeded = ConditionNeeded::orderby('id', 'asc')->get();
        $routeship = RouteShip::orderby('id', 'asc')->get();

        $mh_ids = response()->json($insured->modelKeys());
        $ms_ids = response()->json($insured->modelKeys());

        $insureddata = Insured::find(base64_decode($idm));

        $brokerchoice = DB::table('shiplist_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                        ->where('shiplist_detail.insured_id', '=', $insureddata->number)
                        ->where('shiplist_detail.slip_type', '=', 'mh')
                        ->where('ceding_broker.type', '=', 5)
                        ->orWhere('ceding_broker.type', '=', 4)
                        ->orderByRaw("FIELD(ceding_broker.id , (SELECT GROUP_CONCAT(DISTINCT(ceding_id) SEPARATOR ',') FROM shiplist_detail WHERE insured_id= '".$insureddata->number."')) DESC")
                        ->select('shiplist_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->distinct()
                        ->get();

        $sumperceding = DB::table('shiplist_detail')
                                    ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                                    ->where('shiplist_detail.insured_id', '=', $insureddata->number)
                                    ->where('shiplist_detail.slip_type', '=', 'mh')
                                    //->where('shiplist_detail.status','=','active')
                                    ->select(DB::raw('sum(shiplist_detail.amount) as amount'),'ceding_broker.name',DB::raw('sum(shiplist_detail.percent) as percentage'))
                                    ->groupBy('ceding_broker.name')
                                    ->get();

        $code_ms = $insureddata->number;
        $slipdata = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mh')->orderby('id', 'desc')->first();
        // $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('slip_type', 'fe')->orderBy('endorsment','desc')->get();

        $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mh')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->orderby('id', 'desc')->get();
        
        // $slipdatadistict = DB::table('slip_table')->select('slip_table.*')->where('slip_table.insured_id', $insureddata->number)->where('slip_table.selisih', 'false')->where('slip_table.slipshow', 'yes')->where('slip_table.slip_type', 'fe')->distinct('slip_table.number')->get();
        //$slipdatadistict = SlipTable::select('number')->distinct()->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'fe')->get();
        
        $dataslipdistict = collect(SlipTable::where('insured_id',$insureddata->number)
                            ->where('slipshow', 'yes')
                            ->where('selisih','false')
                            ->where('slip_type', 'mh')
                            ->orderBy('endorsment','desc')->get());
        $slipdatadistict = $dataslipdistict->unique('number');

        $slipdatadistict->values()->all();


        if (!empty($slipdata))
         {
            $code_sl = $slipdata->number;
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mh')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mh')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
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
                            $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MH" .  $mydate . strval($sliplastid + $i);
                        }
                    } else {
                        $code_sl = "MH" .  $mydate . "0000" . strval(1);
                    }
                }

                $i++;
            }
        } 
        else {
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate)->where('slip_type','mh')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mh')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);

            if ($sliplastid != null) {
                if ($sliplastid < 9) {
                    $code_sl = "MH" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sl = "MH" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sl = "MH" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sl = "MH" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sl = "MH" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sl = "MH" .  $mydate . "0000" . strval(1);
            }


            $slipdata = SlipTable::orderBy('id', 'desc')->first();
        }

        $maxdata = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mh')->where('selisih','false')->orderby('endorsment', 'desc')->first();
       
        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', 'mh')->where('status', 'passive')->first();


        if ($checkslipnumber != null) {
            $slipnumform = $code_sl;
        } elseif ($checkslipnumber == null) {


            $reservedslipnumber = SlipNumber::create([
                'number' => $code_sl,
                'slip_type' => 'mh',
                'status' => 'passive',
                'insured_number' => $code_ms
            ]);

            $slipnumform = $reservedslipnumber->number;
        }


                foreach($slip_now as $list_slip)
                {
                    InstallmentTemp::where('slip_id', '=', $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    //ConditionNeededTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    DeductibleTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    RetrocessionTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    ShipListTemp::where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    SlipTableFile::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mh')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                }
       
                // $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                //$conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','passive')->orderby('id','desc')->delete();
                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();

                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mh')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mh')->where('status','=','active')->orderby('id','desc')->get();
                $filelist = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mh')->where('status', '=', 'active')->orderby('id', 'desc')->get();

                
                $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mh')->orderby('id','desc')->get();


        $statuslist = StatusLog::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();


        return view('crm.transaction.marine_hull_slipupdate', compact(['maxdata','slipdatadistict','marinehulltype','sign','ms_ids','customer','cedinginsured','mlu','routeship','sumperceding','brokerchoice','broker','prefixinsured', 'slipnumform', 'user', 'userid', 'cnd', 'slipdata2', 'filelist', 'slipdata', 'insureddata', 'statuslist', 'retrocessionlist', 'installmentlist', 'conditionneededlist', 'deductiblelist', 'conditionneeded', 'deductibletype', 'interestinsured', 'shiplist', 'interestlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'mh_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
    }




    public function getdetailmarinehullSlip($idm)
    {
       
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $idm)->first();
        
        $deductibledata = DeductibleTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mh')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();

        
        if (!empty($slipdata->endorsment))
        {
            $sumperhull = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                    ->where('count_endorsement', '=', $slipdata->endorsment)
                    ->where('marine_hull_detail.insured_id', $slipdata->insured_id)
                    ->where('marine_hull_detail.slip_id', $slipdata->number)
                    ->where('minus', 'false')
                    ->where('status', 'active')
                    ->where('marine_hull_detail.deleted_at', null)
                    ->sum('marine_hull_detail.amount'); 

            $sumamount = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)
            ->where('marine_hull_detail.slip_id', $slipdata->number)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            
            $sumshare = MarineHullCountType::where('count_endorsement', '=', $slipdata->endorsment)
            ->where('insured_id', $slipdata->insured_id)
            ->where('slip_id', $slipdata->number)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('basic_premium'); 
        }
        else
        {
            $sumperhull = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                    ->where('count_endorsement', '=', $slipdata->endorsment)
                    ->where('marine_hull_detail.insured_id', $slipdata->insured_id)
                    ->where('marine_hull_detail.slip_id', $slipdata->number)
                    ->where('minus', 'false')
                    ->where('status', 'active')
                    ->where('marine_hull_detail.deleted_at', null)
                    ->sum('marine_hull_detail.amount'); 

            $sumamount = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)
            ->where('marine_hull_detail.slip_id', $slipdata->number)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            
            $sumshare = MarineHullCountType::where('count_endorsement', '=', $slipdata->endorsment)
            ->where('insured_id', $slipdata->insured_id)
            ->where('slip_id', $slipdata->number)
            ->where('minus', 'false')

            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('basic_premium');   
        }


        $newarraydeduct = [];
        // dd($deductibledata);
        if (!empty($deductibledata)) 
        {
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



    

        $conditionneededdata = ConditionNeededTemp::where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mh')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();

        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarraycn = [];

        if (!empty($conditionneededdata)) 
        {
            foreach ($conditionneededdata as $mydata) 
            {
               
                $cndesc2 = ConditionNeeded::where('id', '=', @$mydata->condition_id)->first();
                if(!empty($cndesc2))
                {
                    $mydata->cndesc = $cndesc2->description;
                    $mydata->cnname = $cndesc2->name;
                    $mydata->cncode = $cndesc2->code;
                    
                }

                array_push($newarraycn, $mydata);
            }
        }
        $newarraycndata = json_encode($newarraycn);

      
        
        $hulldetaildata = MarineHullCountType::where('count_endorsement', $slipdata->endorsment)
            ->where('slip_id', $slipdata->number)
            ->where('insured_id',  $slipdata->insured_id)
            ->where('deleted_at', null)
            ->where('minus','false')->where('status','active')
            ->orderby('id', 'desc')->get();
           
        

        $newarrayhull = [];

        if (!empty($hulldetaildata)) 
        {
            foreach ($hulldetaildata as $mydata) 
            {
               
                $hulldesc = InsuredMarineType::where('id', '=', $mydata->type_id)->first();
                if(!empty($hulldesc))
                {
                    $mydata->hullketerangan = @$hulldesc->keterangan;
                    $mydata->hulltype = $hulldesc->type;
                    $mydata->hullcode = $hulldesc->code;
                    
                }
                else
                {
                    $mydata->hullketerangan = "";
                    $mydata->hulltype = "";
                    $mydata->hullcode = "";
                }

                array_push($newarrayhull, $mydata);
            }
        }
        $newarrayhulldata = json_encode($newarrayhull);

        $installmentpdata = InstallmentTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mh')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();
        $installmentpd=json_encode($installmentpdata);

        // Retro

        $retrocessionpdata = RetrocessionTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mh')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();
        $retrocessionpd=json_encode($retrocessionpdata);
        

       
        $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));

        // $currdate = date("d/m/Y");

        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','mh')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mh')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();


        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        // $sum_permilec = DB::table('extended_coverage_detail')
        //     ->where('slip_id', $slipdata->number)
        //     ->where('insured_id', '=', $slipdata->insured_id)
        //     ->where('slip_type', 'mh')
        //     ->where('count_endorsement', $slipdata->endorsment)
        //     ->where('status', 'active')
        //     ->where('minus','false')
        //     ->where('deleted_at', null)
        //     ->sum('extended_coverage_detail.percentage');

        if($slipdata->endorsment)
        {
                $sum_inspanpercent = DB::table('installment_panel_detail')
                    ->where('slip_id', $slipdata->number)
                    ->where('insured_id', '=', $slipdata->insured_id)
                    ->where('slip_type', 'mh')
                    ->where('count_endorsement', $slipdata->endorsment)
                    //->where('status', 'active')
                    ->where('minus','false')
                    ->where('deleted_at', null)
                    ->sum('installment_panel_detail.percentage');
        }
        else
        {
            
                $sum_inspanpercent = DB::table('installment_panel_detail')
                ->where('slip_id', $slipdata->number)
                ->where('insured_id', '=', $slipdata->insured_id)
                ->where('slip_type', 'mh')
                //->where('status', 'active')
                ->where('minus','false')
                ->where('deleted_at', null)
                ->sum('installment_panel_detail.percentage');
        }


        if ($slipdata->date_transfer == null) {
            $datetransfer = "";
        } else {
            $datetransfer = date("d/m/Y", strtotime($slipdata->date_transfer));
        }


        return response()->json(
            [
                'id' => $slipdata->id,
                'sum_amount'=>$sumamount,
                'sum_share'=>$sumshare,
                'sum_premi'=> $sumperhull,
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
                'condition_needed' => $newarraycndata,
                'hull_data' => $newarrayhulldata,
                'hull_data2' => $hulldetaildata,
                'insurance_period_from' => date("d/m/Y", strtotime($slipdata->insurance_period_from)),
                'insurance_period_to' => date("d/m/Y", strtotime($slipdata->insurance_period_to)),
                'reinsurance_period_from' => date("d/m/Y", strtotime($slipdata->reinsurance_period_from)),
                'reinsurance_period_to' => date("d/m/Y", strtotime($slipdata->reinsurance_period_to)),
                'proportional' => $slipdata->proportional,
                'layer_non_proportional' => $slipdata->layer_non_proportional,
                'rate' => $slipdata->rate,
                'sum_rate' => $slipdata->sliptotalrate,
                'share' => $slipdata->share,
                'basic_premium' => $slipdata->basic_premium,
                'commission' => $slipdata->commission,
                'grossprm_to_nr' => $slipdata->grossprm_to_nr,
                'netprm_to_nr' => $slipdata->netprm_to_nr,
                'installment_panel' => $installmentpd,
                'sum_commission' => $slipdata->sum_commission,
                'retro_backup' => $slipdata->retro_backup,
                'own_retention' => $slipdata->own_retention,
                'sum_own_retention' => $slipdata->sum_own_retention,
                'retrocession_panel' => $retrocessionpd,
                'endorsment' => $slipdata->endorsment,
                'prev_endorsement' => $slipdata->prev_endorsement,
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
                'sum_ippercent' => $sum_inspanpercent
            ]
        );
        
    }



    public function getdetailEndorsementmarinehullSlip($idm)
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

        if (!empty($slipdata->deductible_panel) && strlen($slipdata->deductible_panel) > 10) 
        {
            $deductibledata = json_decode($slipdata->deductible_panel);
        } 
        else 
        {
            //$deductibledata = null;
            $deductibledata = DB::table('deductible_type_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
        }

        if (!empty($slipdata->endorsment))
        {
            $sumperhull = DB::table('marine_hull_detail')
                    ->join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                    ->where('count_endorsement', '=', $slipdata->endorsment)
                    ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
                    ->sum('marine_hull_detail.amount'); 

            $sumamount = DB::table('marine_hull_detail')
            ->join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            
            $sumshare = DB::table('marine_hull_detail')
            ->where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.share'); 
        }
        else
        {
            $sumperhull = DB::table('marine_hull_detail')
            ->join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', null)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            $sumamount = DB::table('marine_hull_detail')
            ->join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', null)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            
            $sumshare = DB::table('marine_hull_detail')
            ->where('count_endorsement', '=', null)
            ->where('marine_hull_detail.insured_id', $slipdata->insured_id)->where('marine_hull_detail.slip_id', $slipdata->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.share');    
        }

        $newarraydeduct = [];
        // dd($deductibledata);
        if (!empty($deductibledata)) 
        {
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



        if (!empty($slipdata->condition_needed) && strlen($slipdata->condition_needed) >= 10) {
            $conditionneededdata = json_decode($slipdata->condition_needed);
        } else {
            //$conditionneededdata = null;
            $conditionneededdata = DB::table('condition_needed_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
        }

        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarraycn = [];

        if (!empty($conditionneededdata)) 
        {
            foreach ($conditionneededdata as $mydata) 
            {
               
                $cndesc2 = ConditionNeeded::where('id', '=', @$mydata->condition_id)->first();
                if(!empty($cndesc2))
                {
                    $mydata->cndesc = $cndesc2->description;
                    $mydata->cnname = $cndesc2->name;
                    $mydata->cncode = $cndesc2->code;
                    
                }

                array_push($newarraycn, $mydata);
            }
        }
        $newarraycndata = json_encode($newarraycn);
       
         //MarineHullCountType
         if (!empty($slipdata->hull_detail) && strlen($slipdata->hull_detail) >= 10) 
         {
            $hulldetaildata = DB::table('marine_hull_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->orderby('id', 'desc')->get();
         
         } else {
             //$conditionneededdata = null;
             $hulldetaildata = DB::table('marine_hull_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->orderby('id', 'desc')->get();
         }
 
         $newarrayhull = [];
 
         if (!empty($hulldetaildata)) 
         {
             foreach ($hulldetaildata as $mydata) 
             {
                
                 $hulldesc = InsuredMarineType::where('id', '=', $mydata->type_id)->first();
                 if(!empty($hulldesc))
                 {
                     $mydata->hullketerangan = $hulldesc->keterangan;
                     $mydata->hulltype = $hulldesc->type;
                     $mydata->hullcode = $hulldesc->code;
                     
                 }
 
                 array_push($newarrayhull, $mydata);
             }
         }
         $newarrayhulldata = json_encode($newarrayhull);

        

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


        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','mh')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mh')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();

        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        // $sum_permilec = DB::table('extended_coverage_detail')
        //     ->where('slip_id', $slipdata->number)
        //     ->where('insured_id', '=', $slipdata->insured_id)
        //     ->where('slip_type', 'mh')
        //     ->where('count_endorsement', $slipdata->endorsment)
        //     ->where('status', 'active')
        //     ->where('deleted_at', null)
        //     ->sum('extended_coverage_detail.percentage');

        if($slipdata->endorsment)
        {
            $sum_inspanpercent = DB::table('installment_panel_detail')
                ->where('slip_id', $slipdata->number)
                ->where('insured_id', '=', $slipdata->insured_id)
                ->where('slip_type', 'mh')
                ->where('count_endorsement', $slipdata->endorsment)
                //->where('status', 'active')
                //->where('minus','false')
                //->where('deleted_at', null)
                ->sum('installment_panel_detail.percentage');
        }
        else
        {
            $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mh')
            //->where('status', 'active')
            //->where('minus','false')
            //->where('deleted_at', null)
            ->sum('installment_panel_detail.percentage');
        }

        /*
        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mh')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('installment_panel_detail.percentage');
            */


        return response()->json(
            [
                'id' => $slipdata->id,
                'sum_amount'=>$sumamount,
                'sum_share'=>$slipdata->sum_share,
                'sum_premi'=> $sumperhull,
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
                'condition_needed' => $newarraycndata,
                'hull_data'=> $newarrayhulldata,
                'insurance_period_from' => date("d/m/Y", strtotime($slipdata->insurance_period_from)),
                'insurance_period_to' => date("d/m/Y", strtotime($slipdata->insurance_period_to)),
                'reinsurance_period_from' => date("d/m/Y", strtotime($slipdata->reinsurance_period_from)),
                'reinsurance_period_to' => date("d/m/Y", strtotime($slipdata->reinsurance_period_to)),
                'proportional' => $slipdata->proportional,
                'layer_non_proportional' => $slipdata->layer_non_proportional,
                'rate' => $slipdata->rate,
                'sum_rate' => $slipdata->sliptotalrate,
                'share' => $slipdata->share,
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
                'sum_ippercent' => $sum_inspanpercent
            ]
        );
    }

    public function updatemarinehullslipmodal(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);

        if($validator) 
        {

            $user = Auth::user();

            $slipdata = SlipTable::where('number', '=', $request->slipnumber)->first();

            // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mh')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();

            $marinehulllist = MarineHullCountType::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();


            $currdate = date("Y-m-d");

            $slipipfromdate = str_replace('/', '-', $request->slipipfrom);
            $slipiptodate = str_replace('/', '-', $request->slipipto);
            $sliprpfromdate = str_replace('/', '-', $request->sliprpfrom);
            $sliprptodate = str_replace('/', '-', $request->sliprpto);

            $slipdataid = $slipdata->number;
            $slipdatalatest = SlipTable::where('number', $slipdataid)->where('insured_id', $request->code_ms)->orderby('created_at', 'desc')->first();
            $slipdataup = SlipTable::where('number', $slipdataid)->orderby('created_at', 'desc')->first();

            // if($slipdataup->status != $request->slipstatus){
            //     StatusLog::create([
            //         'status'=>$request->slipstatus,
            //         'user'=>Auth::user()->name,
            //         'datetime'=>date('Y-m-d H:i:s '),
            //         'insured_id'=>$request->code_ms,
            //         'slip_id'=>$request->slipnumber,
            //         'slip_type'=>'mh',
            //         'count_endorsement'=> $slipdatalatest->endorsment
            //     ]);
            // }

            $slipdataup->number = $request->slipnumber;
            $slipdataup->username = Auth::user()->name;
            $slipdataup->insured_id = $request->code_ms;
            $slipdataup->slip_type = 'mh';
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
            $slipdataup->condition_needed = $conditionneededlist->toJson();
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
            $slipdataup->hull_detail = $marinehulllist->toJson();
            $slipdataup->remarks = $request->remarks;
            $slipdataup->remarkscancel = $request->remarkscancel;
            $slipdataup->slipshow = "yes";

            $slipdataup->save();


            $notification = array(
                'message' => 'Marine Hull Slip Update successfully!',
                'alert-type' => 'success'
            );

            //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mh')->first();
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

            $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($deductibleup as $ddup) {
                $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                $deductibleprocessup->status = 'active';
                $deductibleprocessup->save();
            }

            $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($conditionneededup as $cnup) {
                $conditionneededprocessup = ConditionNeededTemp::findOrFail($cnup->id);
                $conditionneededprocessup->status = 'active';
                $conditionneededprocessup->save();
            }

            $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($installmentpansup as $ipup) {
                $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                $inspanprocessup->status = 'active';
                $inspanprocessup->save();
            }

            $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mh')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($retrocessionpanup as $rpup) {
                $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                $retropanprocessup->status = 'active';
                $retropanprocessup->save();
            }

            $hulldetaildataup = MarineHullCountType::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($hulldetaildataup as $rpup) {
                $hulldetailprocessup = MarineHullCountType::findOrFail($rpup->id);
                $hulldetailprocessup->status = 'active';
                $hulldetailprocessup->save();
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
                'message' => 'Marine Hull Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }



    
   public function storeendorsementmarinehullslip(Request $request)
   {
       $validator = $request->validate([
           'slipid' => 'required'
       ]);


       if ($validator) 
       {
           $user = Auth::user();

           $slipdata = SlipTable::where('id', '=', $request->slipid)->first();
           // $slipdatalist= SlipTable::where('insured_id','=',$slipdata->insured_id)->where('slip_type','fe')->where('selisih','=','false')->get();
           $slipdatalist = SlipTable::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
           $insureddata = Insured::where('number', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->where('count_endorsement', $slipdata->endorsment)->first();

           // $id_ed = ($slipdata->id + 1);
            $num = "1";
            $id_ed = ((int)$slipdata->endorsment + (int)$num);
            $slipdatalisttest = SlipTable::where('endorsment', $id_ed)->where('number', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
          
           while(!empty($slipdatalisttest))
           {
             $slipdatalisttest = SlipTable::where('endorsment', $id_ed)->where('number', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
             
           }

           $slipdatalast = SlipTable::where('endorsment', $id_ed)->where('id', '=', $request->slipid)->first();
           // dd($slipdatalast);
           // $interestlist= InterestInsuredTemp::where('slip_id','=',$slipdata->number)->orderby('id','desc')->get();
           $installmentlist = InstallmentTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->where('minus','false')->where('count_endorsement',$id_ed)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->where('minus','false')->where('count_endorsement',$id_ed)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->where('minus','false')->where('count_endorsement',$id_ed)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->where('minus','false')->where('count_endorsement',$id_ed)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
           //flag
           //$locationlist = TransLocationTemp::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
           $hulldetaillist = DB::table('marine_hull_detail')
           ->where('slip_id', '=', $slipdata->number)
           ->where('insured_id', '=', $slipdata->insured_id)
           ->where('count_endorsement',$id_ed)
           ->where('deleted_at', null)
           ->where('status','passive')
           ->orderby('id', 'desc')->get();
           $attachmentlist = SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
           if ($slipdata == null) 
           {
               $notification = array(
                   'message' => 'Marine Hull Slip Endorsement Fail!',
                   'alert-type' => 'danger'
               );
           } 
           else 
           {

               if ($slipdatalast == null) {

                   $locationlistup = ' ';
                   $risklocationlistup = ' ';
                   $dtlistup = ' ';
                   $jsondtlistup = ' ';
                   $cntlistup = ' ';
                   $jsoncntlistup = ' ';
                   $iptlistup = ' ';
                   $jsoniptlistup = ' ';
                   $rctlistup = ' ';
                   $jsonrctlistup = ' ';
                   $risklocationlistdetail = '';
                    $jsonhull = '';


                   $dtlistupminus = ' ';
                   $jsondtlistupminus = ' ';
                   $cntlistupminus = ' ';
                   $jsoncntlistupminus = ' ';
                   $iptlistupminus = ' ';
                   $jsoniptlistupminus = ' ';
                   $rctlistupminus = ' ';
                   $jsonrctlistupminus = ' ';
                   $slipdataupminus = '';
                   $jsonhullminus= '';

                   if ($deductiblelist != null) {
                        foreach ($deductiblelist as $dt) 
                        {

                            $dtlistup = DeductibleTemp::create([
                                'deductibletype_id' => $dt->deductibletype_id,
                                'currency_id' => $dt->currency_id,
                                'percentage' => $dt->percentage,
                                'min_claimamount' => $dt->min_claimamount,
                                'amount' => $dt->amount,
                                'slip_id' => $dt->slip_id,
                                'insured_id' => $dt->insured_id,
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'count_endorsement' =>  $id_ed,
                                'minus' => 'false'
                            ]);

                            $jsondtlistup = DeductibleTemp::where('slip_id', '=', $dtlistup->slip_id)->where('count_endorsement', $id_ed)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $dtlistupminus = DeductibleTemp::create([
                                'deductibletype_id' => $dt->deductibletype_id,
                                'currency_id' => $dt->currency_id,
                                'percentage' => $dt->percentage,
                                'min_claimamount' => $dt->min_claimamount,
                                'amount' => $dt->amount,
                                'slip_id' => $dt->slip_id,
                                'insured_id' => $dt->insured_id,
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'count_endorsement' =>  $id_ed,
                                'minus' => 'false'
                            ]);

                            $jsondtlistupminus = DeductibleTemp::where('slip_id', '=', $dtlistupminus->slip_id)->where('count_endorsement',  $id_ed)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $dtdata =  DeductibleTemp::findOrFail($dtlistupminus->id);
                            $dtdata->min_claimamount = ($dtlistupminus->min_claimamount * (-1));
                            $dtdata->amount = ($dtlistupminus->amount * (-1));
                            $dtdata->minus = "true";
                            $dtdata->save();
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


                    if ($conditionneededlist != null) {
                        foreach ($conditionneededlist as $cnt) {
                            $cntlistup = ConditionNeededTemp::create([
                                'condition_id' => $cnt->extendcoverage_id,
                                'information' => $cnt->information,
                                'slip_id' => $cnt->slip_id,
                                'count_endorsement' =>  $id_ed,
                                'insured_id' => $cnt->insured_id,
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $jsoncntlistup = ConditionNeededTemp::where('slip_id', '=', $cntlistup->slip_id)->where('count_endorsement',  $id_ed)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $cntlistupminus = ConditionNeededTemp::create([
                                'condition_id' => $cnt->extendcoverage_id,
                                'information' => $cnt->information,
                                'slip_id' => $cnt->slip_id,
                                'count_endorsement' =>  $id_ed,
                                'insured_id' => $cnt->insured_id,
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $jsoncntlistupminus = ConditionNeededTemp::where('slip_id', '=', $cntlistupminus->slip_id)->where('count_endorsement',  $id_ed)->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $cntdata =  ConditionNeededTemp::findOrFail($cntlistupminus->id);
                            $cntdata->minus = "true";
                            $cntdata->save();
                        }
                    } else {
                        $cntlistup = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);

                        $cntlistupminus = json([
                            'message' => ' data not found ',
                            'value' => ' '
                        ]);
                    }

                    if ($installmentlist != null) 
                    {
                        foreach ($installmentlist as $ipt) 
                        {
                            
                                $iptlistup = InstallmentTemp::create([
                                    'installment_date' => $ipt->installment_date,
                                    'percentage' => $ipt->percentage,
                                    'amount' => $ipt->amount,
                                    'slip_id' => $ipt->slip_id,
                                    'count_endorsement' => $id_ed,
                                    'insured_id' => $ipt->insured_id,
                                    'slip_type' => "mh",
                                    'status' => 'active',
                                    'minus' => 'false'
                                ]);

                                $jsoniptlistup = InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)->where('count_endorsement', $iptlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                                $iptlistupminus = InstallmentTemp::create([
                                    'installment_date' => $ipt->installment_date,
                                    'percentage' => $ipt->percentage,
                                    'amount' => $ipt->amount,
                                    'slip_id' => $ipt->slip_id,
                                    'count_endorsement' => $id_ed,
                                    'insured_id' => $ipt->insured_id,
                                    'slip_type' => "mh",
                                    'status' => 'active',
                                    'minus' => 'false'
                                ]);

                                $jsoniptlistupminus = InstallmentTemp::where('slip_id', '=', $iptlistupminus->slip_id)->where('count_endorsement', $iptlistupminus->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                                $iptdata =  InstallmentTemp::findOrFail($iptlistupminus->id);
                                $iptdata->amount = ($iptlistupminus->amount * (-1));
                                $iptdata->minus = "true";
                                $iptdata->save();
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
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $jsonrctlistup = RetrocessionTemp::where('slip_id', '=', $rctlistup->slip_id)->where('count_endorsement', $rctlistup->count_endorsement)
                            ->where('deleted_at', null)->orderby('id', 'desc')->get();

                            $rctlistupminus = RetrocessionTemp::create([
                                'type' => $rct->type,
                                'contract' => $rct->contract,
                                'percentage' => $rct->percentage,
                                'amount' => $rct->amount,
                                'slip_id' => $rct->slip_id,
                                'count_endorsement' => $id_ed,
                                'insured_id' => $rct->insured_id,
                                'slip_type' => 'mh',
                                'status' => 'active',
                                'minus' => 'false'
                            ]);

                            $jsonrctlistupminus = RetrocessionTemp::where('slip_id', '=', $rctlistupminus->slip_id)->where('count_endorsement', $rctlistupminus->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                            $rctdata =  RetrocessionTemp::findOrFail($rctlistupminus->id);
                            $rctdata->amount = ($rctlistupminus->amount * (-1));
                            $rctdata->minus = "true";
                            $rctdata->save();
                        }
                    }

                   $slipdatetransferdata=date('Y-m-d');
                   if(!empty($slipdatalist->slipdatetransfer))
                   {
                      $slipdatetransferdata=$slipdatalist->slipdatetransfer;
                   }
                   else
                   {
                      $slipdatetransferdata=date('Y-m-d');
                   }

                   if ($slipdatalist != null) 
                   {
                       if ($jsondtlistup == ' ') 
                       {

                           $slipdataup = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'yes'

                           ]);

                           $slipdataupminus = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'no'

                           ]);
                       } 
                       elseif ($jsoniptlistup == ' ') 
                       {

                           $slipdataup = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'yes'

                           ]);

                           $slipdataupminus = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'no'

                           ]);
                       } 
                       elseif ($jsonrctlistup == ' ') 
                       {

                           $slipdataup = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'yes'

                           ]);

                           $slipdataupminus = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'no'

                           ]);
                       } 
                       else 
                       {

                           $slipdataup = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'yes'

                           ]);

                           $slipdataupminus = SlipTable::create([
                               'number' => $slipdatalist->number,
                               'username' => $slipdatalist->username,
                               'insured_id' => $slipdatalist->insured_id,
                               'slip_type' => 'mh',
                               'prod_year' => $slipdatalist->prod_year,
                               'selisih' => 'false',
                               'date_transfer' => null,
                               'status' => 'endorsement',
                               'endorsment' => $id_ed,
                               'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                               'slipshow' => 'no'

                           ]);
                       }
                   }

                   // $insureddataup = Insured::findOrFail($insureddata->id);
                   // $insureddataup->count_endorsement = ($insureddata->count_endorsement + 1);
                   // $insureddataup->save();

                   $notification = array(
                       'message' => 'Marine Hull Slip added Endorsement successfully!',
                       'alert-type' => 'success'
                   );


                   if(!empty($slipdataupminus))
                   {
                   

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
                   }

                   $attachmentcheck = SlipTableFile::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mh')->get();

                   if ($attachmentcheck) {
                       foreach ($attachmentcheck as $atc) {
                           $attachmentupdate = SlipTableFile::findOrFail($atc->id);
                           $attachmentupdate->slip_id = $slipdataup->number;
                           $attachmentupdate->count_endorsement = $id_ed;
                           $attachmentupdate->save();
                       }
                   }

                   $statuslogcheck = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mh')->get();

                   if ($statuslogcheck) {
                       foreach ($statuslogcheck as $slc) {
                           $statuslogupdate = StatusLog::findOrFail($slc->id);
                           $statuslogupdate->slip_id = $slipdataup->number;
                           $statuslogupdate->count_endorsement = $id_ed;
                           $statuslogupdate->save();
                       }

                       StatusLog::create([
                           'insured_id' => $slipdataup->insured_id,
                           'status' => $slipdataup->status,
                           'datetime' => date('Y-m-d H:i:s '),
                           'slip_id' => $slipdataup->number,
                           'user' => $slipdataup->username,
                           'count_endorsement' => $slipdataup->endorsment,
                           'slip_type' => 'mh'
                       ]);
                   }
                   

                   $cedingbroker = CedingBroker::where('id', $slipdataup->source)->first();
                   $ceding = CedingBroker::where('id', $slipdataup->source_2)->first();

                   $slipdataup->cedingbroker = @$cedingbroker->name;
                   $slipdataup->ceding = @$ceding->name;

                   return response()->json(
                       [
                           // 'slip_data' => $slipdataup->toJson(),
                           // 'slip_dataarray' => json_encode($slipdatalist),
                           'oldid' => $request->slipid,
                           'hull_data' => json_encode($jsonhull),
                           'jsondtlistup' => json_encode($jsondtlistup), 
                           'jsoniptlistup' => json_encode($jsoniptlistup) 
                           // 'location_data' => $lookuplocationlist->toJson(),
                           // 'risklocation_data' => $risklocationlistdetail->toJson(),
                       ]
                   );
               } else {
                   $notification = array(
                       'message' => 'Marine Hull Slip added Endorsement Failed! data already endorsed!',
                       'alert-type' => 'error',
                       'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'attacment_file' => json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistupminus),
                                'condition_needed' => json_encode($jsoncntlistupminus),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
                                'proportional' => $request->proportional,
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
                                'hull_detail' => json_encode($jsonhull),
                                'installment_panel' => json_encode($jsoniptlistupminus),
                                'retrocession_panel' => json_encode($jsonrctlistupminus),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->slipremarks,
                   );

                   return response()->json(
                       $notification
                   );
               }
           }
       } else {

           $notification = array(
               'message' => 'Marine Hull Slip added Failed!',
               'alert-type' => 'success'
           );

           
       }
   }

   
    public function changeCancelMarine(Request $request)
    {

        $slipdata=SlipTable::where('insured_id',  $request->code_ms)->where('number',  $request->slipnumber)->first(); 
        $slipdata->status="cancel";
        $slipdata->remarkscancel = $request->remarkscancel;
        $slipdata->save();

        $notification = array(
            'message' => 'Marine Hull Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function destroyhullcount($id)
    {
        $hullcountlist = MarineHullCountType::find($id);
        
        
        $slipdata = SlipTable::where('insured_id', $hullcountlist->insured_id)->where('number', $hullcountlist->number)->first();

        if (!empty($slipdata->endorsment))
        {
            $sumperhull = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
                    ->where('count_endorsement', '=', $slipdata->endorsment)
                    ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->number)->where('marine_hull_detail.deleted_at', null)
                    ->sum('marine_hull_detail.amount'); 

            $sumamount = MarineHullCountType::join('insured_marine_type', 'insured_marine_type.id', '=', 'marine_hull_detail.type_id')
            ->where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.amount'); 

            
            $sumshare = MarineHullCountType::where('count_endorsement', '=', $slipdata->endorsment)
            ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->number)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.share'); 
        }
        else
        {
            $sumperhull = MarineHullCountType::where('count_endorsement', null)
            ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->slip_id)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.basic_premium'); 
    
            $sumamount = MarineHullCountType::where('count_endorsement', null)
                ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->slip_id)->where('marine_hull_detail.deleted_at', null)
                ->sum('marine_hull_detail.amount'); 
    
    
            $sumshare = MarineHullCountType::where('count_endorsement', null)
            ->where('marine_hull_detail.insured_id', $hullcountlist->insured_id)->where('marine_hull_detail.slip_id', $hullcountlist->slip_id)->where('marine_hull_detail.deleted_at', null)
            ->sum('marine_hull_detail.share');    
        }

        $hullcountlist->delete();
        
        return response()->json(['success'=>'Data has been deleted','sum_amount'=>$sumamount,'sum_share'=>$sumshare,'sum_premi'=> $sumperhull]);
    }




    public function destroyinsured($id)
    {
        $insured = Insured::find($id);
        if($insured->delete())
        {
            

            $notification = array(
                'message' => 'Marine Insured deleted successfully!',
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

    public function destroyslip($id)
    {
    	
    }
    public function getShip(){
        return MarineLookup::orderby('id','asc')->get();
    }

}
