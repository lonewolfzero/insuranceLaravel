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
use App\Models\TransLocationTemp;
use App\Models\StatusLog;
use App\Models\InterestInsured;
use App\Models\InstallmentTemp;
use App\Models\InterestInsuredTemp;
use App\Policies\FelookupLocationPolicy;
use Illuminate\Http\Request;
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
use App\Models\BusinessType;
use Carbon\Carbon;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexmarineslip(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Marine Cargo - Slip Entry';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");
        $cur_year = date("Y");
        $cur_month = date("m");
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $sign = "insert";
        $userid = Auth::user()->id;
        
        $slip = SlipTable::orderby('id','asc')->get();
        
        //$currency = CurrencyExchange::join('currencies','currencies_exc.currency',"=","currencies.id")->where('currencies_exc.year',$cur_year)->where('currencies_exc.month',$cur_month)->select('currencies_exc.*','currencies.symbol_name','currencies.code')->orderby('currencies_exc.id', 'asc')->get();
        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();
       
        $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
        $business_type = BusinessType::orderby('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
       
        $ocp = Occupation::orderby('id','asc')->get();
        
        $cedingbroker = CedingBroker::orderby('id','asc')->distinct()->get()->unique('code');
        $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $broker = CedingBroker::orderby('id','asc')->where('type','5')->get()->unique('code');
        $cedinginsured = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');

        $felookup = FelookupLocation::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id','asc')->get();
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::orderby('id','asc')->get();
        $costumer=CustomerCustomer::orderby('id','asc')->get();
        $prefixinsured = PrefixInsured::orderby('id','asc')->get();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
       
        
        //$insured = Insured::orderby('id','asc')->get();
        $insured = Insured::orderby('id','asc')->where("number", "LIKE", "%IN". $mydate ."%")->get();
        $ms_ids = response()->json($insured->modelKeys());
        
        $lastid = count($insured);
        $sliplastid = count($slip);

        if($lastid != null)
        {
            if($lastid < 9)
            {
                $code_ms = "IN". $mydate . "0000" . strval($lastid + 1);
            }   
            elseif($lastid > 8 && $lastid < 99)
            {
                $code_ms = "IN". $mydate . "000" . strval($lastid + 1);
            }
            elseif($lastid > 98 && $lastid < 999)
            {
                $code_ms = "IN". $mydate . "00" . strval($lastid + 1);
            }
            elseif($lastid > 998 && $lastid < 9999)
            {
                $code_ms = "IN". $mydate . "0" . strval($lastid + 1);
            }
            elseif($lastid > 9998 && $lastid < 99999)
            {
                $code_ms = "IN". $mydate  . strval($lastid + 1);
            }
        }
        else{
            $code_ms = "IN" . $mydate . "0000" . strval(1);
        }

        $brokerchoice = DB::table('interest_insured_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                        ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                        ->where('shiplist_detail.insured_id', '=', $code_ms)
                        ->where('ceding_broker.type', '=', 5)
                        ->orWhere('ceding_broker.type', '=', 4)
                        ->select('interest_insured_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->orderByRaw("FIELD(ceding_broker.id , interest_insured_detail.ceding_id) ASC")
                        ->distinct()
                        ->get();

        
        $slipdata = SlipTable::where('insured_id', $code_ms)->first();
        $slipdatadistict = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mc')->distinct()->get();

        $slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mc')->get();
        // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mc')->where('insured_id',$code_ms)->orderby('id','asc')->get();
        $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mc')->where('insured_id', $code_ms)->orderby('id', 'asc')->get();
        $sliplastid = count($slip_now);

        if($sliplastid != null)
                {
                    if($sliplastid < 9)
                    {
                        $code_sl = "MC".  $mydate . "0000" . strval($sliplastid + 1);
                    }   
                    elseif($sliplastid > 8 && $sliplastid < 99)
                    {
                        $code_sl = "MC".  $mydate . "000" . strval($sliplastid + 1);
                    }
                    elseif($sliplastid > 98 && $sliplastid < 999)
                    {
                        $code_sl = "MC".  $mydate . "00" . strval($sliplastid + 1);
                    }
                    elseif($sliplastid > 998 && $sliplastid < 9999)
                    {
                        $code_sl = "MC".  $mydate . "0" . strval($sliplastid + 1);
                    }
                    elseif($sliplastid > 9998 && $sliplastid < 99999)
                    {
                        $code_sl = "MC".  $mydate . strval($sliplastid + 1);
                    }

                    
                }
                else
                {
                    $code_sl = "MC".  $mydate . "0000" . strval(1);
                }


        $checkinsurednumber = InsuredNumber::where('number',$code_ms)->where('slip_type','mc')->where('status','passive')->first();
        // $insurednumform = '';
        $checkslipnumber= SlipNumber::where('number',$code_sl)->where('insured_number',$code_ms)->where('slip_type','mc')->where('status','passive')->first();
        // $slipnumform = '';
        if($checkinsurednumber != null){
            
            if($checkslipnumber != null){
                


                $insurednumform = $code_ms;
                $slipnumform = $code_sl;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                $shiplistid = ShiplistTemp::select('id')->where('insured_id','=',$code_ms)->where('slip_type','mc')->where('status','passive')->orderby('id','desc')->get();
                foreach($shiplistid as $dataid)
                {
                    InterestInsuredTemp::where('ship_id','=',$dataid->id)->where('status','passive')->delete();
                }
                
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','passive')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->get();

                
                $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mc')->orderby('id','desc')->get();

                
                $listship=array();
                foreach($shiplist3 as $datadetail)
                {
                    if($datadetail->interestinsureddetail){
                        $datadetail->interestinsureddetail = InterestInsuredTemp::where('ship_id','=',$datadetail->id)->where('slip_type','mc')->where('status','passive')->delete();
                        
                    }else{
                        $datadetail->interestinsureddetail= InterestInsuredTemp::where('ship_id','=',$datadetail->id)->orderby('id','desc')->where('slip_type','mc')->get();
                    }
                    $listship[]= $datadetail;
                }


                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();

                return view('crm.transaction.marine_slip', compact(['sign','slipdatadistict','broker','brokerchoice','listship','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            
            }elseif($checkslipnumber == null){
                

                $insurednumform = $code_ms;

                $reservedslipnumber = SlipNumber::create([
                            'number'=>$code_sl,
                            'slip_type'=>'mc',
                            'status'=>'passive',
                            'insured_number'=>$code_ms     
                    ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                $shiplistid = ShiplistTemp::select('id')->where('insured_id','=',$code_ms)->where('slip_type','mc')->where('status','passive')->orderby('id','desc')->get();
                foreach($shiplistid as $dataid)
                {
                    InterestInsuredTemp::where('ship_id','=',$dataid->id)->where('status','passive')->delete();
                }
                
                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','passive')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->where('status','=','passive')->orderby('id','desc')->delete();
                
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->get();
                
                $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mc')->orderby('id','desc')->get();

                
                $listship=array();
                foreach($shiplist3 as $datadetail)
                {
                    if($datadetail->interestinsureddetail){
                        $datadetail->interestinsureddetail = InterestInsuredTemp::where('ship_id','=',$datadetail->id)->where('slip_type','mc')->where('status','passive')->delete();
                        
                    }else{
                        $datadetail->interestinsureddetail= InterestInsuredTemp::where('ship_id','=',$datadetail->id)->orderby('id','desc')->where('slip_type','mc')->get();
                    }
                    $listship[]= $datadetail;
                }


                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();

                return view('crm.transaction.marine_slip', compact(['slipdatadistict','sign','broker','brokerchoice','listship','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            }

        }elseif($checkinsurednumber == null){
             

            if($checkslipnumber != null){
               
                    InsuredNumber::where('number',$code_ms)->where('slip_type','mc')->where('status','passive')->delete();

                    $reservedinsurednumber = InsuredNumber::create([
                                    'number'=>$code_ms,
                                    'status'=>'passive',
                                    'slip_type'=>'mc'     
                        ]);

                    $insurednumform = $reservedinsurednumber->number;
                
                    $slipnumform = $code_sl;

                    $interestinsured= InterestInsured::orderby('id','asc')->get();
                    
                    
                    $shiplistid = ShiplistTemp::select('id')->where('insured_id','=',$code_ms)->where('slip_type','mc')->where('status','passive')->orderby('id','desc')->get();
                    foreach($shiplistid as $dataid)
                    {
                        InterestInsuredTemp::where('ship_id','=',$dataid->id)->where('status','passive')->delete();
                    }
                    
                    // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                    $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','passive')->orderby('id','desc')->delete();
                    $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    $conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                    $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();

                    // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                    $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                    $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->get();

                   $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mc')->orderby('id','desc')->get();

                
                    $listship=array();
                    foreach($shiplist3 as $datadetail)
                    {
                        if($datadetail->interestinsureddetail){
                            $datadetail->interestinsureddetail = InterestInsuredTemp::where('ship_id','=',$datadetail->id)->where('slip_type','mc')->where('status','passive')->delete();
                            
                        }else{
                            $datadetail->interestinsureddetail= InterestInsuredTemp::where('ship_id','=',$datadetail->id)->orderby('id','desc')->where('slip_type','mc')->get();
                        }
                        $listship[]= $datadetail;
                    }


                    $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();

                    return view('crm.transaction.marine_slip', compact(['slipdatadistict','sign','broker','brokerchoice','listship','customer','conditionneededlist','cedinginsured','mlu','routeship','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            
            }elseif($checkslipnumber == null){
                
                InsuredNumber::where('number',$code_ms)->where('slip_type','mc')->where('status','passive')->delete();
                // dd($code_ms);
                $reservedinsurednumber = InsuredNumber::create([
                            'number'=>$code_ms,
                            'status'=>'passive',
                            'slip_type'=>'mc'     
                ]);

                 $insurednumform = $reservedinsurednumber->number;

                $reservedslipnumber = SlipNumber::create([
                            'number'=>$code_sl,
                            'slip_type'=>'mc',
                            'status'=>'passive',
                            'insured_number'=>$code_ms     
                    ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured= InterestInsured::orderby('id','asc')->get();
                
                
                
                $shiplistid = ShiplistTemp::select('id')->where('insured_id','=',$code_ms)->where('slip_type','mc')->where('status','passive')->orderby('id','desc')->get();
                foreach($shiplistid as $dataid)
                {
                    InterestInsuredTemp::where('ship_id','=',$dataid->id)->where('status','passive')->delete();
                }
                
                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','passive')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->get();

                $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mc')->orderby('id','desc')->get();

                
                $listship=array();
                foreach($shiplist3 as $datadetail)
                {
                    if($datadetail->interestinsureddetail){
                        $datadetail->interestinsureddetail = InterestInsuredTemp::where('ship_id','=',$datadetail->id)->where('slip_type','mc')->where('status','passive')->delete();
                        
                    }else{
                        $datadetail->interestinsureddetail= InterestInsuredTemp::where('ship_id','=',$datadetail->id)->orderby('id','desc')->where('slip_type','mc')->get();
                    }
                    $listship[]= $datadetail;
                }


                $statuslist= StatusLog::where('insured_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();

                return view('crm.transaction.marine_slip', compact(['slipdatadistict','sign','broker','brokerchoice','listship','customer','conditionneededlist','cedinginsured','routeship','mlu','prefixinsured','shiplist','slipnumform','insurednumform','user','cnd','slipdata','slipdata2','statuslist','retrocessionlist','installmentlist','deductiblelist','deductibletype','interestinsured','interestlist','felookup','currency','cob','koc','ocp','ceding','cedingbroker','route_active','currdate','slip','insured','ms_ids','code_ms','code_sl','costumer','business_type']));
            }

        }
     
    }



    public function indexhioslip(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Hole In One - Slip Entry';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");
        $currdate = date("d/m/Y");
        

        if(empty($search))
         {
            $insured = Insured::orderby('id','asc')->get();
            $slip = SlipTable::orderby('id','asc')->get();
            $currency = Currency::orderby('id','asc')->get();
            $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
            $koc = Koc::orderby('id','asc')->get();
            $ocp = Occupation::orderby('id','asc')->get();
            $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
            $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
            $felookup = FelookupLocation::orderby('id','asc')->get();
            $cnd = ConditionNeeded::orderby('id','asc')->get();
            $exc = ExtendedCoverage::orderby('id','asc')->get();
            $mlu = MarineLookup::orderby('id','asc')->get();
            $golffieldhole = GolfFieldHole::orderby('id','asc')->get();
            
            
            $customer= CustomerCustomer::orderby('id','asc')->get();
            $routeship= RouteShip::orderby('id','asc')->get();
            $interestinsured= InterestInsured::orderby('id','asc')->get();
            $deductibletype= DeductibleType::orderby('id','asc')->get();
            $ms_ids = response()->json($insured->modelKeys());
            $lastid = count($insured);
            $sliplastid = count($slip);

            if($lastid != null){
                if($lastid < 10)
                {
                    $code_ms = "IN" . $mydate . "0000" . strval($lastid + 1);
                }   
                elseif($lastid > 9 && $lastid < 100)
                {
                    $code_ms = "IN" . $mydate . "000" . strval($lastid + 1);
                }
                elseif($lastid > 99 && $lastid < 1000)
                {
                    $code_ms = "IN" . $mydate . "00" . strval($lastid + 1);
                }
                elseif($lastid > 999 && $lastid < 10000)
                {
                    $code_ms = "IN" . $mydate . "0" . strval($lastid + 1);
                }
                elseif($lastid > 9999 && $lastid < 100000)
                {
                    $code_ms = "IN" . $mydate  . strval($lastid + 1);
                }


            }
            else{
                $code_ms = "IN" . $mydate . "0000" . strval(1);
            }

            if($sliplastid != null){
                if($lastid < 10)
                {
                    $code_sl = "HIO". $mydate . "0000" . strval($sliplastid + 1);
                }   
                elseif($lastid > 9 && $lastid < 100)
                {
                    $code_sl = "HIO". $mydate . "000" . strval($sliplastid + 1);
                }
                elseif($lastid > 99 && $lastid < 1000)
                {
                    $code_sl = "HIO". $mydate . "00" . strval($sliplastid + 1);
                }
                elseif($lastid > 999 && $lastid < 10000)
                {
                    $code_sl = "HIO". $mydate . "0" . strval($sliplastid + 1);
                }
                elseif($lastid > 9999 && $lastid < 100000)
                {
                    $code_sl = "HIO". $mydate . strval($sliplastid + 1);
                }

                
            }
            else{
                $code_sl = "HIO" . $mydate . "0000" . strval(1);
            }


            $interestlist= InterestInsuredTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();
            // $shiplist= ShipListTemp::where('insured_id',$code_ms)->where('status','saved')->orderby('id','desc')->get();
            $deductibletemp= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            // $extendcoveragetemp= ExtendCoverageTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $installmentpanel= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $retrocessiontemp= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
            $locationlist= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();
            $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
            $holedetaillist= HoleDetail::where('insured_id','=',$code_ms)->orderby('id','desc')->get();


            if(count($interestlist) != null){
                InterestInsuredTemp::where('insured_id', $code_ms)->delete();
            }

            if(count($locationlist) != null){
                TransLocationTemp::where('insured_id', $code_ms)->delete();
            }

            if(count($holedetaillist) != null){
                HoleDetail::where('insured_id', $code_ms)->delete();
            }

            if(count($deductibletemp) != null){
                DeductibleTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($extendcoveragelist) != null){
                ExtendCoverageTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($conditionneededtemp) != null){
                ConditionNeededTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($installmentpanel) != null){
                InstallmentTemp::where('slip_id', $code_sl)->delete();
            }
            
            if(count($retrocessiontemp) != null){
                RetrocessionTemp::where('slip_id', $code_sl)->delete();
            }

            $checklastslip = SlipTable::where('slip_type','ms')->orderby('id','desc')->first();

            // if($checklastins->number == $checklastslip->insured_id)
            // {
            //     $lastinsid = $code_ms;
            // }
            // else{
            //     $lastinsid = $checklastins->number;
            // }
            
            if($checklastslip != null)
            {
                $edslipid = $checklastslip->id;
            }
            else{
                $edslipid = 0;
            }


            return view('crm.transaction.hio_slip', compact(['user','golffieldhole','holedetaillist','extendcoveragelist','edslipid','statuslist','retrocessiontemp','installmentpanel','conditionneededtemp','deductibletemp','deductibletype','interestinsured','routeship','customer','interestlist','locationlist','exc','cnd','mlu','felookup','currency','cob','koc','ocp','ceding','cedingbroker','slip','insured','route_active','ms_ids','code_ms','code_sl','currdate']));     
         }
        else
        {
          $insured = Insured::where('number', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $ms_ids = response()->json($insured->modelKeys());
          return view('crm.transaction.hio_slip', compact('user','extendcoveragetemp','customer','slip','insured','route_active','ms_ids','code_ms'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexpaslip(Request $request)
    {
        $user = Auth::user();
        $userid = Auth::user()->id;
        $route_active = 'Personal Accident - Slip Entry';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");
        

            $insured = Insured::orderby('id','asc')->get();
            $slip = SlipTable::orderby('id','asc')->get();
            $currency = Currency::orderby('id','asc')->get();
            $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
            $koc = Koc::orderby('id','asc')->get();
            $ocp = Occupation::orderby('id','asc')->get();
            $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
            $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
            $felookup = FelookupLocation::orderby('id','asc')->get();
            $cnd = ConditionNeeded::orderby('id','asc')->get();
            $exc = ExtendedCoverage::orderby('id','asc')->get();
        $extendedcoverage= ExtendedCoverage::orderby('id','asc')->get();
        $mlu = MarineLookup::orderby('id','asc')->get();
            
            
            $customer= CustomerCustomer::orderby('id','asc')->get();
            // $routeship= RouteShip::orderby('id','asc')->get();
            $interestinsured= InterestInsured::orderby('id','asc')->get();
            $deductibletype= DeductibleType::orderby('id','asc')->get();
            $ms_ids = response()->json($insured->modelKeys());
            $lastid = count($insured);
            $sliplastid = count($slip);

            if($lastid != null){
                if($lastid < 9)
                {
                    $code_ms = "IN" . $mydate . "0000" . strval($lastid + 1);
                }   
                elseif($lastid > 8 && $lastid < 100)
                {
                    $code_ms = "IN" . $mydate . "000" . strval($lastid + 1);
                }
                elseif($lastid > 99 && $lastid < 1000)
                {
                    $code_ms = "IN" . $mydate . "00" . strval($lastid + 1);
                }
                elseif($lastid > 999 && $lastid < 10000)
                {
                    $code_ms = "IN" . $mydate . "0" . strval($lastid + 1);
                }
                elseif($lastid > 9999 && $lastid < 100000)
                {
                    $code_ms = "IN" . $mydate  . strval($lastid + 1);
                }


            }
            else{
                $code_ms = "IN" . $mydate . "0000" . strval(1);
            }

            $slipdata=SlipTable::where('insured_id',$code_ms)->first();
            $slipdata2=SlipTable::where('insured_id',$code_ms)->get();

            if($sliplastid != null){
                if($lastid < 10)
                {
                    $code_sl = "PA" . $mydate . "0000" . strval($sliplastid + 1);
                }   
                elseif($lastid > 9 && $lastid < 100)
                {
                    $code_sl = "PA" . $mydate . "000" . strval($sliplastid + 1);
                }
                elseif($lastid > 99 && $lastid < 1000)
                {
                    $code_sl = "PA" . $mydate . "00" . strval($sliplastid + 1);
                }
                elseif($lastid > 999 && $lastid < 10000)
                {
                    $code_sl = "PA" . $mydate . "0" . strval($sliplastid + 1);
                }
                elseif($lastid > 9999 && $lastid < 100000)
                {
                    $code_sl = "PA" . $mydate . strval($sliplastid + 1);
                }

                
            }
            else{
                $code_sl = "PA" . $mydate . "0000" . strval(1);
            }

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
                        $code_sl = "PA".  $mydate . "0000" . strval($sliplastid + $i);
                    }   
                    elseif($sliplastid > 8 && $sliplastid < 100)
                    {
                        $code_sl = "PA".  $mydate . "000" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 99 && $sliplastid < 1000)
                    {
                        $code_sl = "PA".  $mydate . "00" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 999 && $sliplastid < 10000)
                    {
                        $code_sl = "PA".  $mydate . "0" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 9999 && $sliplastid < 100000)
                    {
                        $code_sl = "PA".  $mydate . strval($sliplastid + $i);
                    }
                }

                $i++;
            }

            InterestInsuredTemp::where('insured_id',$code_ms)->orderby('id','desc')->delete();
            DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->delete();
            ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->delete();
            ExtendCoverageTemp::where('slip_id',$code_sl)->orderby('id','desc')->delete();
            InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->delete();
            RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->delete();
            TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->delete();

            $interestlist= InterestInsuredTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();
            $deductiblelist= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $extendcoveragelist= ExtendCoverageTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $installmentlist= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $retrocessionlist= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
            $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
            $locationlist= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();

            if(count($interestlist) != null){
                InterestInsuredTemp::where('insured_id', $code_ms)->delete();
            }

            if(count($deductiblelist) != null){
                DeductibleTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($extendcoveragelist) != null){
                ExtendCoverageTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($conditionneededtemp) != null){
                ConditionNeededTemp::where('slip_id', $code_sl)->delete();
            }

            if(count($installmentlist) != null){
                InstallmentTemp::where('slip_id', $code_sl)->delete();
            }
            
            if(count($retrocessionlist) != null){
                RetrocessionTemp::where('slip_id', $code_sl)->delete();
            }

            $checklastslip = SlipTable::where('slip_type','ms')->orderby('id','desc')->first();

            // if($checklastins->number == $checklastslip->insured_id)
            // {
            //     $lastinsid = $code_ms;
            // }
            // else{
            //     $lastinsid = $checklastins->number;
            // }
            
            if($checklastslip != null)
            {
                $edslipid = $checklastslip->id;
            }
            else{
                $edslipid = 0;
            }


            return view('crm.transaction.pa_slip', compact(['user','installmentlist','extendedcoverage','slipdata2','edslipid','statuslist','retrocessionlist','conditionneededtemp','deductiblelist','deductibletype','interestinsured','locationlist','extendcoveragelist','customer','interestlist','exc','cnd','mlu','felookup','currency','cob','koc','ocp','ceding','cedingbroker','slip','insured','route_active','ms_ids','code_ms','code_sl','currdate']));     
         
    }

    public function indexmarine(Request $request)
    {
         $user = Auth::user();
         $country = User::orderby('id','asc')->get();
         $route_active = 'Marine Slip - Index';   
         $mydate = date("Y").date("m").date("d");
         $ms_ids = response()->json($country->modelKeys());

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

        $checkdatainsured = Insured::where('slip_type', '=', 'mh')->orWhere('slip_type', '=', 'mc')->where('statmodified', '=', 0)->get();

        // foreach ($checkdatainsured as $insureddata) {
        //     //$deleteinsured= SlipTable::where('insured_id','=',$insureddata->number)->delete();
        //     $deleteinsured = Insured::where('number', '=', $insureddata->number)->where('slip_type', '=', 'mh')->orWhere('slip_type', '=', 'mc')->where('statmodified', '=', 0)->delete();
        // }

        if (!empty($search) || !empty($searchinsured) || !empty($searchuy)) {
            $query = Insured::query();
            
            if (!empty($search)) {
                 $query->where('number', $search);
            }

            if (!empty($searchinsured)) {
                 $query->where('insured_name', $searchinsured);
            }

            if (!empty($searchuy)) {
                 $query->where('uy', $searchuy);
            }
            // $query->whereRaw("slip_type='mh' OR slip_type='mc'");
            // $query->orWhere('slip_type', 'mc');
            // dd($query);
            // Ordering
            //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);

            $insured = $query->orderby('id','desc')->paginate(10);
            $insured_ids = response()->json($insured->modelKeys());
            $slip = SlipTable::where('slip_type', '=', 'mh')->orWhere('slip_type', '=', 'mh')->orderby('id', 'desc')->get();
            $slip_ids = response()->json($insured->modelKeys());


            $insuredlist = [];
            foreach (@$insured as $insureddata) {
                $queryslip = SlipTable::query();

                if (!empty($searchslipnum)) {
                    $queryslip = $queryslip->where('number', $searchslipnum);
                }

                if (!empty($searchcob)) {
                    $queryslip = $queryslip->orWhere('cob', $searchcob);
                }

                if (!empty($searchceding)) {
                    $queryslip = $queryslip->orWhere('source', $searchceding);
                }

                $slipdata = $queryslip->where('insured_id', '=', $insureddata->number)->get()->toArray();

                $sliplist = [];
                foreach ($slipdata as $value) {
                    $value['cobdata'] = COB::where('id', '=', $value['cob'])->first();
                    $value['brokerdata'] = CedingBroker::where('id', '=', $value['source'])->first();
                    $value['cedingdata'] = CedingBroker::where('id', '=', $value['source_2'])->first();

                    array_push($sliplist, $value);
                }

                $insureddata->slipdata = $sliplist;

                if (!empty($sliplist)) {
                    array_push($insuredlist, $insureddata);
                }
            }

            $cob = COB::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get()->unique('code');
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get()->unique('code');
            // dd($insured);
            return view('crm.transaction.marine_index', compact('searchslipnum', 'searchcob', 'searchceding', 'search', 'searchinsured', 'searchuy', 'searchshare', 'searchnre', 'searchtsi', 'searchendorse', 'cob', 'cedingbroker', 'ceding', 'insuredlist', 'user', 'slip', 'slip_ids', 'insured', 'insured_ids', 'route_active', 'country'))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
          //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
          
          $insured = Insured::where('slip_type', '=', 'mh')->orWhere('slip_type', '=', 'mc')->orderby('id','desc')->paginate(10);
          $insured_ids = response()->json($insured->modelKeys());
          $slip = SlipTable::with('insureddata')->where('slip_type', '=', 'mh')->orWhere('slip_type', '=', 'mc')->orderby('id','desc')->paginate(10);
          $slip_ids = response()->json($slip->modelKeys());

          $insuredlist = [];
            foreach (@$insured as $insureddata) {
                if($insureddata->slip_type == 'mc'){
                    $slipdata = SlipTable::where('insured_id', '=', $insureddata->number)->where('slip_type','mc')->where('slipshow', '=', 'yes')->get()->toArray();

                    $sliplist = [];
                    foreach ($slipdata as $value) {
                        $value['cobdata'] = COB::where('id', '=', $value['cob'])->first();
                        $value['brokerdata'] = CedingBroker::where('id', '=', $value['source'])->first();
                        $value['cedingdata'] = CedingBroker::where('id', '=', $value['source_2'])->first();

                        array_push($sliplist, $value);
                    }
                }else{
                    $slipdata = SlipTable::where('insured_id', '=', $insureddata->number)->where('slip_type','mh')->where('slipshow', '=', 'yes')->get()->toArray();

                    $sliplist = [];
                    foreach ($slipdata as $value) {
                        $value['cobdata'] = COB::where('id', '=', $value['cob'])->first();
                        $value['brokerdata'] = CedingBroker::where('id', '=', $value['source'])->first();
                        $value['cedingdata'] = CedingBroker::where('id', '=', $value['source_2'])->first();

                        array_push($sliplist, $value);
                    }
                }

                

                $insureddata->slipdata = $sliplist;

                // $insureddata->insured_name = strtoupper($insureddata->prefix_id) . ' - ' . strtoupper($insureddata->insured_name) . ' - ' . strtoupper($insureddata->insured_suffix);

                // $insureddata->share = number_format($insureddata->share, 0);
                // $insureddata->share_from = number_format($insureddata->share_from, 0);
                // $insureddata->share_to = number_format($insureddata->share_to, 0);

                array_push($insuredlist, $insureddata);
            }

          //$cob = COB::orderby('id', 'asc')->get();
          $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
          $cedingbroker = CedingBroker::orderby('id', 'asc')->get()->unique('code');
          $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get()->unique('code');

        //   dd($slip);

          return view('crm.transaction.marine_index', compact('insuredlist','searchslipnum', 'searchcob', 'searchceding', 'search', 'searchinsured', 'searchuy', 'searchshare', 'searchnre', 'searchtsi', 'searchendorse', 'cob', 'cedingbroker', 'ceding', 'user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
         
    }

    public function indexhio(Request $request)
    {
        $user = Auth::user();
        $country = User::orderby('id','asc')->get();
        $route_active = 'Hole In One - Index';   
        $mydate = date("Y").date("m").date("d");
        $hio_ids = response()->json($country->modelKeys());

        $search = @$request->input('search');

            if(empty($search))
            {
          //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            $insured = Insured::where('slip_type', '=', 'hio')->orderby('id','desc')->paginate(10);
            $insured_ids = response()->json($insured->modelKeys());
            $slip = SlipTable::where('slip_type', '=', 'hio')->orderby('id','desc')->paginate(10);
            $slip_ids = response()->json($slip->modelKeys());

            return view('crm.transaction.hio_index', compact('user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
        
            }
            else
            {
          //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);
        
            $insured = Insured::where('slip_type', '=', 'hio')->where('number', 'LIKE', '%' . $search . '%')->orderby('id','desc')->paginate(10);
            $insured_ids = response()->json($insured->modelKeys());
            $slip = SlipTable::where('slip_type', '=', 'hio')->where('number', 'LIKE', '%' . $search . '%')->orderby('id','desc')->paginate(10);
            $slip_ids = response()->json($slip->modelKeys());
        
            return view('crm.transaction.hio_index', compact('user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
        
            }
    }

    public function indexpa(Request $request)
    {
         $user = Auth::user();
         $country = User::orderby('id','asc')->get();
         $route_active = 'Personal Accident - Index';   
         $mydate = date("Y").date("m").date("d");
         $ms_ids = response()->json($country->modelKeys());

         $search = @$request->input('search');

         if(empty($search))
         {
          //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
          $insured = Insured::where('slip_type', '=', 'pa')->orderby('id','desc')->paginate(10);
          $insured_ids = response()->json($insured->modelKeys());
          $slip = SlipTable::where('slip_type', '=', 'pa')->orderby('id','desc')->paginate(10);
          $slip_ids = response()->json($slip->modelKeys());

          return view('crm.transaction.pa_index', compact('user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
        
         }
         else
         {
          //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);
          
          $insured = Insured::where('slip_type', '=', 'pa')->where('number', 'LIKE', '%' . $search . '%')->orderby('id','desc')->paginate(10);
          $insured_ids = response()->json($insured->modelKeys());
          $slip = SlipTable::where('slip_type', '=', 'pa')->where('number', 'LIKE', '%' . $search . '%')->orderby('id','desc')->paginate(10);
          $slip_ids = response()->json($slip->modelKeys());

        
          return view('crm.transaction.pa_index', compact('user','slip','slip_ids','insured','insured_ids','route_active','country'))->with('i', ($request->input('page', 1) - 1) * 10);
        
        }
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
 

    public function storemarineinsured(Request $request)
    {
        $validator = $request->validate([
            'msinumber'=>'required',
            'msisuggestinsured'=>'required'
        ]);

        $costumcheck = CustomerCustomer::where('company_name', '=', $request->msisuggestinsured)->first();
        $sum_amount = DB::table('shiplist_detail')
                ->join('interest_insured_detail', 'interest_insured_detail.insured_id', '=', 'shiplist_detail.insured_id')
                ->where('interest_insured_detail.insured_id', $request->msinumber)
                ->where('interest_insured_detail.slip_type', 'mc')
                ->sum('interest_insured_detail.amount');
        if ($costumcheck == null) {

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
                'website' =>  $msisuggestinsured,
                'company_suffix' => $msisuffix
            ]); 
            }else{
                CustomerCustomer::create([
                'owner_id' => '1',
                'industry_id' => '27',
                'company_prefix' => 'CV',
                'company_name' =>  $msisuggestinsured,
                'website' =>  $msisuggestinsured,
                'company_suffix' => $msisuffix
            ]);
            }
            
        }

        $shiplist= ShipListTemp::where('insured_id','=',$request->msinumber)->where('status','=','passive')->orderby('created_at','desc')->get();
        
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
                    'slip_type'=>'mc',
                    'prefix_id' => $request->msiprefix,
                    'insured_name'=>strtoupper($msisuggestinsured),
                    'insured_suffix'=>strtoupper($msisuffix),
                    'route'=>$request->msiroute,
                    'route_from'=>$request->msiroutefrom,
                    'route_to'=>$request->msirouteto,
                    'share'=>$request->msishare,
                    'statmodified' => 1,
                    'share_from'=>$request->msisharefrom,
                    'share_to'=>$request->msishareto,
                    'currency_id'=>$request->msicurrency,
                    'uy'=>$request->msiuy,
                    'business_id'=>$request->msibusiness_id,
                    'flag_overseas'=>$request->msiflag_overseas,
                    'ship_detail'=>$shiplist->toJson()
                    // 'coincurance'=>$request->msicoinsurance
                ]);

                $insurednumberdata = InsuredNumber::where('number', $request->msinumber)->orderby('id', 'desc')->first();
                $insurednumberdata->status = 'active';
                $insurednumberdata->save();

                $shiplistup = ShiplistTemp::where('insured_id', '=', $request->msinumber)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($shiplistup as $slup) {
                    $shiplistprocessup = ShiplistTemp::findOrFail($slup->id);
                    $shiplistprocessup->status = 'active';
                    $shiplistprocessup->save();

                    $interestinsuredup = InterestInsuredTemp::where('ship_id', '=', $slup->id)->where('insured_id','=',$slup->insured_id)->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($interestinsuredup as $iidup) {
                        $interestinsuredprocessup = InterestInsuredTemp::findOrFail($iidup->id);
                        $interestinsuredprocessup->status = 'active';
                        $interestinsuredprocessup->save();
                    }
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
                $insureddataup->slip_type='mc';
                $insureddataup->prefix_id=$request->msiprefix;
                $insureddataup->insured_name=$msisuggestinsured;
                $insureddataup->insured_suffix=$msisuffix;
                $insureddataup->route=$request->msiroute;
                $insureddataup->route_from=$request->msiroutefrom;
                $insureddataup->route_to=$request->msirouteto;
                $insureddataup->share=$request->msishare;
                $insureddataup->share_from=$request->msisharefrom;
                $insureddataup->share_to=$request->msishareto;
                $insureddataup->currency_id=$request->msicurrency;
                $insureddataup->statmodified = 1;
                $insureddataup->uy=$request->msiuy;
                $insureddataup->flag_overseas=$request->msiflag_overseas;
                $insureddataup->business_id=$request->msibusiness_id;
                $insureddataup->ship_detail=$shiplist->toJson();
                // $insureddataup->coincurance=$request->msicoinsurance;
                $insureddataup->save();

                 $insurednumberdata = InsuredNumber::where('number', $request->msinumber)->orderby('id', 'desc')->first();
                    $insurednumberdata->status = 'active';
                    $insurednumberdata->save();

                    $TransLocationup = ShiplistTemp::where('insured_id', '=', $request->msinumber)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($TransLocationup as $tstup) {
                        $translocationprocessup = ShiplistTemp::findOrFail($tstup->id);
                        $translocationprocessup->status = 'active';
                        $translocationprocessup->save();

                        $risklocationup = InterestInsuredTemp::where('ship_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                        foreach ($risklocationup as $rlsup) {
                            $risklocationprocessup = InterestInsuredTemp::findOrFail($rlsup->id);
                            $risklocationprocessup->status = 'active';
                            $risklocationprocessup->save();
                        }
                    }

                if ($sum_amount != strval($request->msishareto)) {
                    $warning_flag = 1;
                }else{
                    $warning_flag = 0;
                }
                $SlipTableUp = SlipTable::where('insured_id', '=', $insureddataup->number)->where('slip_type', 'mc')->where('slipshow', 'yes')->orderby('id', 'desc')->get();
                    foreach ($SlipTableUp as $stu) {
                        $sliptableprocessup = SlipTable::findOrFail($stu->id);
                        $sliptableprocessup->warning_flag = $warning_flag;
                        $sliptableprocessup->save();
                    }
                // checking trans_location_detail 
                        
                        $dataShipList = InterestInsuredTemp::where('insured_id',$request->msinumber)->where('slip_type','mc')->get();
                        foreach ($dataShipList as $dataShipList) {
                            $id = $dataShipList->id;
                            $amount = strval($dataShipList->amount);
                            $amountup = strval($request->msishareto);
                            $percent = ($amount/$amountup)*100;
                            $updateShipListTemp = InterestInsuredTemp::findOrFail($id);
                            $updateShipListTemp->percent = $percent;
                            $updateShipListTemp->status = "active";
                            $updateShipListTemp->save();
                        }
                        
                        // End checking
                $notification = array(
                    'message' => 'Marine Insured Update successfully!',
                    'warning_flag' => $warning_flag,
                    'sum_amount' => $sum_amount,
                    'id' => $insureddataid,
                    'count_endorsement' => $insureddataup->count_endorsement,
                    'alert-type' => 'success'
                );
            }
            // dd($shiplist);
            // ShipListTemp::whereIn('id', $shiplist->id)->update(['status' => 'saved']);
            // ShipListTemp::where('status','pending')->delete();

            return response($notification);
            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Marine Insured added Failed!',
                'alert-type' => 'success'
            );

            return response($notification);
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    // public function storemarineslip(Request $request)
    // {
    //     $validator = $request->validate([
    //         'slipnumber'=>'required',
    //         'slipuy'=>'required',
    //         'slippolicy_no'=>'required',
    //         'slipno'=>'required',
    //         'slipcndn'=>'required'
    //     ]);
        

    //     if($validator)
    //     {
    //         $user = Auth::user();
            
    //         $slipdata= SlipTable::where('number','=',$request->slipnumber)->first();
            
            
    //         $interestlist= InterestInsuredTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
    //         $installmentlist= InstallmentTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
    //         $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
    //         $deductiblelist= DeductibleTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
    //         $retrocessionlist=RetrocessionTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();             
    //         $slipfile=SlipTableFile::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();             

    //         if($slipdata==null)
    //         {
    //             $currdate = date("Y-m-d");

    //             $newmarineslip = SlipTable::create([
    //                 'number'=>$request->slipnumber,
    //                 'username'=>Auth::user()->name,
    //                 'insured_id'=>$request->code_ms,
    //                 'slip_type'=>'ms',
    //                 'prod_year' => $currdate,
    //                 'uy'=>$request->slipuy,
    //                 'status'=>$request->slipstatus,
    //                 'endorsment'=>'true',
    //                 'selisih'=>'false',
    //                 'source'=>$request->slipcedingbroker,
    //                 'source_2'=>$request->slipceding,
    //                 'currency'=>$request->slipcurrency,
    //                 'cob'=>$request->slipcob,
    //                 'koc'=>$request->slipkoc,
    //                 'occupacy'=>$request->slipoccupacy,
    //                 'build_const'=>$request->slipbld_const,
    //                 'slip_no'=>$request->slipno,
    //                 'cn_dn'=>$request->slipcndn,
    //                 'policy_no'=>$request->slippolicy_no,
    //                 'attacment_file'=>$slipfile->toJson(),
    //                 'interest_insured'=>$interestlist->toJSon(),
    //                 'total_sum_insured'=>$request->sliptotalsum,
    //                 'insured_type'=>$request->sliptype,
    //                 'insured_pct'=>$request->slippct,
    //                 'total_sum_pct'=>$request->sliptotalsumpct,
    //                 'deductible_panel'=>$deductiblelist->toJson(),
    //                 'condition_needed'=>$conditionneededlist->toJson(),
    //                 'insurance_period_from'=>$request->slipipfrom,
    //                 'insurance_period_to'=>$request->slipipto,
    //                 'reinsurance_period_from'=>$request->sliprpfrom,
    //                 'reinsurance_period_to'=>$request->sliprpto,
    //                 'proportional'=>$request->slipproportional,
    //                 'layer_non_proportional'=>$request->sliplayerproportional,
    //                 'rate'=>$request->sliprate,
    //                 'share'=>$request->slipshare,
    //                 'sum_share'=>$request->slipsumshare,
    //                 'basic_premium'=>$request->slipbasicpremium,
    //                 'v_broker'=>$request->slipvbroker,
    //                 'commission'=>$request->slipcommission,
    //                 'grossprm_to_nr'=>$request->slipgrossprmtonr,
    //                 'netprm_to_nr'=>$request->slipnetprmtonr,
    //                 'sum_commission'=>$request->slipsumcommission,
    //                 'installment_panel'=>$installmentlist->toJson(),
    //                 'retrocession_panel'=>$retrocessionlist->toJson(),
    //                 'retro_backup'=>$request->sliprb,
    //                 'own_retention'=>$request->slipor,
    //                 'sum_own_retention'=>$request->slipsumor,
    //                 'coinsurance_slip'=>$request->slipcoinsurance

    //             ]);

    //             StatusLog::create([
    //                 'insured_id'=>$request->code_ms,
    //                 'status'=>$request->slipstatus,
    //                 'datetime'=>date('Y-m-d H:i:s'),
    //                 'slip_id'=>$request->slipnumber,
    //                 'user'=>Auth::user()->name,
    //             ]);

    //             $insdata = Insured::where('number',$request->code_ms)->where('slip_type','ms')->first();

    //             $inscoinsurance = $insdata->coincurance . ',' . $request->slipcoinsurance;

    //             $msdata = Insured::findOrFail($insdata->id);
    //             $msdata->share=$request->sharems;
    //             $msdata->share_from=$request->sumsharems;
    //             $msdata->share_to=$request->tsims;
    //             $msdata->coincurance=$inscoinsurance;
    //             $msdata->save();

    //             $mydate = date("Y").date("m").date("d");
    //             $slip = SlipTable::orderby('id','asc')->get();
    //             $sliplastid = count($slip);
    //             $userid = Auth::user()->id;
    //             if($sliplastid != null){
    //                 if($sliplastid < 10)
    //                 {
    //                     $code_sl = "M". $mydate . "0000" . strval($sliplastid + 1);
    //                 }   
    //                 elseif($sliplastid > 9 && $sliplastid < 100)
    //                 {
    //                     $code_sl = "M". $mydate . "000" . strval($sliplastid + 1);
    //                 }
    //                 elseif($sliplastid > 99 && $sliplastid < 1000)
    //                 {
    //                     $code_sl = "M". $mydate . "00" . strval($sliplastid + 1);
    //                 }
    //                 elseif($sliplastid > 999 && $sliplastid < 10000)
    //                 {
    //                     $code_sl = "M". $mydate . "0" . strval($sliplastid + 1);
    //                 }
    //                 elseif($sliplastid > 9999 && $sliplastid < 100000)
    //                 {
    //                     $code_sl = "M". $mydate . strval($sliplastid + 1);
    //                 }
    //             }
    //             else{
    //                 $code_sl = "M" . $mydate . "0000" . strval(1);
    //             }


    //             return response()->json([
    //                 'id' => $newmarineslip->id,
    //                 'slip_number' => $newmarineslip->number,
    //                 'new_slip_number' => $code_sl,
    //                 'uy' => $newmarineslip->uy,
    //                 'status' => $newmarineslip->status,
    //                 'insured_id' => $newmarineslip->insured_id
    //             ]);
    //         }
    //         else
    //         {
    //             $currdate = date("d/m/Y");

    //             $var = $request->prod_year;
    //             $date = str_replace('/', '-', $var);
    //             $prod_year = date('Y-m-d', strtotime($date));

    //             $slipdataid=$slipdata->id;
    //             $slipdataup = SlipTable::findOrFail($slipdataid);
                
                
    //             $slipdataup->number=$request->slipnumber;
    //             $slipdataup->username=Auth::user()->name;
    //             $slipdataup->insured_id=$request->code_ms;
    //             $slipdataup->prod_year=$prod_year;
    //             $slipdataup->uy=$request->slipuy;
    //             $slipdataup->status=$request->slipstatus;
    //             $slipdataup->endorsment='true';
    //             $slipdataup->selisih='false';
    //             $slipdataup->source=$request->slipcedingbroker;
    //             $slipdataup->source_2=$request->slipceding;
    //             $slipdataup->currency=$request->slipcurrency;
    //             $slipdataup->cob=$request->slipcob;
    //             $slipdataup->koc=$request->slipkoc;
    //             $slipdataup->occupacy=$request->slipoccupacy;
    //             $slipdataup->build_const=$request->slipbld_const;
    //             $slipdataup->slip_no=$request->slipno; 
    //             $slipdataup->cn_dn=$request->slipcndn; 
    //             $slipdataup->policy_no=$request->slippolicy_no; 
    //             $slipdataup->attacment_file=$slipfile->toJson(); 
    //             $slipdataup->interest_insured=$interestlist->toJSon();
    //             $slipdataup->total_sum_insured=$request->sliptotalsum; 
    //             $slipdataup->insured_type=$request->sliptype; 
    //             $slipdataup->insured_pct=$request->slippct; 
    //             $slipdataup->total_sum_pct=$request->sliptotalsumpct; 
    //             $slipdataup->deductible_panel=$deductiblelist->toJson(); 
    //             $slipdataup->condition_needed=$conditionneededlist->toJson();  
    //             $slipdataup->insurance_period_from=$request->slipipfrom;  
    //             $slipdataup->insurance_period_to=$request->slipipto;  
    //             $slipdataup->reinsurance_period_from=$request->sliprpfrom;  
    //             $slipdataup->reinsurance_period_to=$request->sliprpto;
    //             $slipdataup->proportional=$request->slipproportional;
    //             $slipdataup->layer_non_proportional=$request->sliplayerproportional;  
    //             $slipdataup->rate=$request->sliprate;  
    //             $slipdataup->share=$request->slipshare;
    //             $slipdataup->sum_share=$request->slipsumshare;
    //             $slipdataup->basic_premium=$request->slipbasicpremium;
    //             $slipdataup->v_broker=$request->slipvbroker;
    //             $slipdataup->commission=$request->slipcommission; 
    //             $slipdataup->grossprm_to_nr=$request->slipgrossprmtonr; 
    //             $slipdataup->netprm_to_nr=$request->slipnetprmtonr; 
    //             $slipdataup->sum_commission=$request->slipsumcommission; 
    //             $slipdataup->installment_panel=$installmentlist->toJson();   
    //             $slipdataup->retrocession_panel=$retrocessionlist->toJson();  
    //             $slipdataup->retro_backup=$request->sliprb;
    //             $slipdataup->own_retention=$request->slipor;
    //             $slipdataup->sum_own_retention=$request->slipsumor;
    //             $slipdataup->coinsurance_slip=$request->slipcoinsurance;

    //             $slipdataup->save();

    //             StatusLog::create([
    //                 'insured_id'=>$request->code_ms,
    //                 'status'=>$request->slipstatus,
    //                 'datetime'=>date('Y-m-d H:i:s '),
    //                 'slip_id'=>$request->slipnumber,
    //                 'user'=>Auth::user()->name,
    //             ]);

    //             $insdata = Insured::where('number',$request->code_ms)->where('slip_type','ms')->first();

    //             if($insdata->coincurance == null){
    //                 $inscoinsurance = $request->slipcoinsurance;
    //             }
    //             else{
    //                 $inscoinsurance = $insdata->coincurance . ',' . $request->slipcoinsurance;
    //             }
                

    //             $msdata = Insured::findOrFail($insdata->id);
    //             $msdata->share=$request->sharems;
    //             $msdata->share_from=$request->sumsharems;
    //             $msdata->share_to=$request->tsims;
    //             $msdata->coincurance=$inscoinsurance;
    //             $msdata->save();

    //             // $mydate = date("Y").date("m").date("d");
    //             // $slip = SlipTable::orderby('id','asc')->get();
    //             // $sliplastid = count($slip);
    //             // $userid = Auth::user()->id;
    //             // if($sliplastid != null){
    //             //     if($sliplastid < 10)
    //             //     {
    //             //         $code_sl = "M". $mydate . "0000" . strval($sliplastid + 1);
    //             //     }   
    //             //     elseif($sliplastid > 9 && $sliplastid < 100)
    //             //     {
    //             //         $code_sl = "M". $mydate . "000" . strval($sliplastid + 1);
    //             //     }
    //             //     elseif($sliplastid > 99 && $sliplastid < 1000)
    //             //     {
    //             //         $code_sl = "M". $mydate . "00" . strval($sliplastid + 1);
    //             //     }
    //             //     elseif($sliplastid > 999 && $sliplastid < 10000)
    //             //     {
    //             //         $code_sl = "M". $mydate . "0" . strval($sliplastid + 1);
    //             //     }
    //             //     elseif($sliplastid > 9999 && $sliplastid < 100000)
    //             //     {
    //             //         $code_sl = "M". $mydate . strval($sliplastid + 1);
    //             //     }
    //             // }
    //             // else{
    //             //     $code_sl = "M" . $mydate . "0000" . strval(1);
    //             // }

    //             return response()->json([
    //                 'id' => $slipdataup->id,
    //                 'slip_number' => $slipdataup->number,
    //                 // 'new_slip_number' => $code_sl,
    //                 'uy' => $slipdataup->uy,
    //                 'status' => $slipdataup->status,
    //                 'insured_id' => $slipdataup->insured_id
    //             ]);
    //         }
            
    //         //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
    //         //return redirect()->route('liniusaha.index');
        
    //     }
    //     else
    //     {

    //         $notification = array(
    //             'message' => 'Marine Slip added Failed!',
    //             'alert-type' => 'success'
    //         );

    //         return back()->with($validator)->withInput();
    //         //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
    //         //return redirect()->route('liniusaha.index');
    //     }
    // }

    public function storemarineslip(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);


        if ($validator) {
            $user = Auth::user();


            $checkslipnumber = SlipNumber::where('number', $request->slipnumber)->where('insured_number', $request->code_ms)->where('slip_type', 'mc')->where('status', 'active')->first();


            if ($checkslipnumber == null) {
                $slipdata = SlipTable::where('number', '=', $request->slipnumber)->first();

                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                
                $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',0)->where('deleted_at', null)->orderby('id', 'desc')->get();


                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $request->slipnumber,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mc',
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
                        'extend_coverage' => $extendcoveragelist->toJson(),
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
                        'message' => 'Marine Cargo Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mc',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mc')->first();
                    $insdata = Insured::where('number', $request->code_ms)->where('slip_type','mc')->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mc')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mc')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MC" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MC" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mc',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                            'slip_type' => 'mc',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $request->slipnumber;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mc';
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
                    $slipdataup->extend_coverage = $extendcoveragelist->toJson();
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
                        'message' => 'Marine Cargo Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mc')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $request->slipnumber)->where('slip_type', 'mc')->orderby('id', 'desc')->first();
                    if ($slipnumberdata == null) {
                        $insurednumberdatanew = InsuredNumber::create([
                            'number' => $request->slipnumber,
                            'slip_type' => 'mc',
                            'status' => 'active'
                        ]);
                    }else{
                        $slipnumberdata->status = 'active';
                        $slipnumberdata->save();    
                    }
                    

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mc')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MC" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MC" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mc',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                    'slip_type' => 'mc',
                    'status' => 'active',
                    'insured_number' => $request->code_ms
                ]);

                $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($deductibleup as $ddup) {
                    $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                    $deductibleprocessup->slip_id = $code_sl2;
                    $deductibleprocessup->save();
                }

               $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->slip_id = $code_sl2;
                        $conditionneededprocessup->save();
                    }

                $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($installmentpansup as $ipup) {
                    $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                    $inspanprocessup->slip_id = $code_sl2;
                    $inspanprocessup->save();
                }

                $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($retrocessionpanup as $rpup) {
                    $retropanprocessup = RetrocessionTemp::findOrFail($rpup->id);
                    $retropanprocessup->slip_id = $code_sl2;
                    $retropanprocessup->save();
                }


                $slipdata = SlipTable::where('number', '=', $code_sl2)->first();

                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();
                $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();

                if ($slipdata == null) {
                    $currdate = date("Y-m-d");

                    $slipdataup = SlipTable::create([
                        'number' => $code_sl2,
                        'username' => Auth::user()->name,
                        'insured_id' => $request->code_ms,
                        'slip_type' => 'mc',
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
                        'message' => 'Marine Cargo Slip added successfully!',
                        'alert-type' => 'success'
                    );

                    StatusLog::create([
                        'status' => $request->slipstatus,
                        'user' => Auth::user()->name,
                        'datetime' => date('Y-m-d H:i:s '),
                        'insured_id' => $request->code_ms,
                        'slip_id' => $request->slipnumber,
                        'slip_type' => 'mc',
                        'count_endorsement' => $slipdataup->endorsment
                    ]);


                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mc')->first();
                    $insdata = Insured::where('number', $request->code_ms)->first();
                    // $old_sumshare = $request->slipoldsumshare;

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mc')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();


                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mc')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MC" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MC" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mc',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                    $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                            'slip_type' => 'mc',
                            'count_endorsement' => $slipdataup->endorsment
                        ]);
                    }

                    $slipdataup->number = $code_sl2;
                    $slipdataup->username = Auth::user()->name;
                    $slipdataup->insured_id = $request->code_ms;
                    $slipdataup->slip_type = 'mc';
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

                    $slipdataup->save();


                    $notification = array(
                        'message' => 'Marine Cargo Slip Update successfully!',
                        'alert-type' => 'success'
                    );

                    //$insdata = Insured::where('number',$request->code_ms)->where('slip_type','mc')->first();
                    $insdata = Insured::where('number', $request->code_ms)->where('slip_type','mc')->first();

                    $old_nasre_share = $insdata->share_from;
                    $new_nasre_share = $request->insured_share;


                    if ($new_nasre_share != $old_nasre_share) {
                        $msdata = Insured::findOrFail($insdata->id);

                        $msdata->share_from = $new_nasre_share;
                        $msdata->save();
                    }

                    $slipnumberdata = SlipNumber::where('number', $code_sl2)->where('slip_type', 'mc')->orderby('id', 'desc')->first();
                    $slipnumberdata->status = 'active';
                    $slipnumberdata->save();

                    $currdate2 = date("Y-m-d");
                    $mydate = date("Y") . date("m") . date("d");
                    $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', 'mc')->where('insured_id', $request->code_ms)->orderby('id', 'asc')->get();
                    $sliplastid = count($slip_now);
                    // dd($sliplastid);

                    if ($slip_now != null) {
                        if ($sliplastid < 9) {
                            $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + 1);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MC" .  $mydate . strval($sliplastid + 1);
                        }
                    } else {
                        $code_sl = "MC" .  $mydate . "0000" . strval(1);
                    }

                    $reservedslipnumber = SlipNumber::create([
                        'number' => $code_sl,
                        'slip_type' => 'mc',
                        'status' => 'passive',
                        'insured_number' => $request->code_ms
                    ]);

                    $deductibleup = DeductibleTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($deductibleup as $ddup) {
                        $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                        $deductibleprocessup->status = 'active';
                        $deductibleprocessup->save();
                    }

                   $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($conditionneededup as $ecup) {
                        $conditionneededprocessup = ConditionNeededTemp::findOrFail($ecup->id);
                        $conditionneededprocessup->status = 'active';
                        $conditionneededprocessup->save();
                    }

                    $installmentpansup = InstallmentTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
                    foreach ($installmentpansup as $ipup) {
                        $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                        $inspanprocessup->status = 'active';
                        $inspanprocessup->save();
                    }

                    $retrocessionpanup = RetrocessionTemp::where('slip_id', $code_sl2)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                'message' => 'Marine Cargo Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }

    public function storeholeinoneinsured(Request $request)
    {
        $validator = $request->validate([
            'msinumber'=>'required',
            'msisuggestinsured'=>'required'
        ]);

        $holedetail= HoleDetail::where('insured_id','=',$request->msinumber)->orderby('created_at','desc')->get();
        $locationlist= TransLocationTemp::where('insured_id','=',$request->msinumber)->orderby('created_at','desc')->get();
        
        if($validator)
        {
            $user = Auth::user();
            
            $insureddata= Insured::where('number','=',$request->msinumber)->first();

            if($insureddata==null)
            {
                Insured::create([
                    'number'=>$request->msinumber,
                    'slip_type'=>'hio',
                    'insured_prefix' => $request->msiprefix,
                    'insured_name'=>strtoupper($request->msisuggestinsured),
                    'insured_suffix'=>strtoupper($request->msisuffix),
                    'route'=>$request->msiroute,
                    'route_from'=>$request->msiroutefrom,
                    'route_to'=>$request->msirouteto,
                    'share'=>$request->msishare,
                    'share_from'=>$request->msisharefrom,
                    'share_to'=>$request->msishareto,
                    'location'=>$locationlist->toJson(),
                    'hole_detail'=>$holedetail->toJson(),
                    'coincurance'=>$request->msicoinsurance
                ]);

                $notification = array(
                    'message' => 'Hole in One Insured added successfully!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $insureddataid=$insureddata->id;
                $insureddataup = Insured::findOrFail($insureddataid);
                $insureddataup->slip_type='hio';
                $insureddataup->insured_prefix=$request->msiinsured;
                $insureddataup->insured_name=$request->msisuggestinsured;
                $insureddataup->insured_suffix=$request->msisuffix;
                $insureddataup->route=$request->msiroute;
                $insureddataup->route_from=$request->msiroutefrom;
                $insureddataup->route_to=$request->msirouteto;
                $insureddataup->share=$request->msishare;
                $insureddataup->share_from=$request->msisharefrom;
                $insureddataup->share_to=$request->msishareto;
                $insureddataup->location=$locationlist->toJson();
                $insureddataup->hole_detail=$holedetail->toJson();
                $insureddataup->coincurance=$request->msicoinsurance;
                $insureddataup->save();


                $notification = array(
                    'message' => 'Hole in One Insured Update successfully!',
                    'alert-type' => 'success'
                );
            }
            // dd($locationlist);
            // ShipListTemp::whereIn('id', $shiplist->id)->update(['status' => 'saved']);
            // ShipListTemp::where('status','pending')->delete();

            return back()->with($notification);
            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Hole in One Insured added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function storeholeinoneslip(Request $request)
    {
        $validator = $request->validate([
            'slipnumber'=>'required'
        ]);
        

        
        if($validator)
        {
            $user = Auth::user();
            
            $slipdata= SlipTable::where('number','=',$request->slipnumber)->first();
            
            $interestlist= InterestInsuredTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $installmentlist= InstallmentTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $deductiblelist= DeductibleTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $retrocessionlist=RetrocessionTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();             

            if($slipdata==null)
            {
                $currdate = date("Y-m-d");

                $slipdataup=SlipTable::create([
                    'number'=>$request->slipnumber,
                    'username'=>Auth::user()->name,
                    'insured_id'=>$request->code_ms,
                    'slip_type'=>'hio',
                    'prod_year' => $currdate,
                    'uy'=>$request->slipuy,
                    'status'=>$request->slipstatus,
                    'endorsment'=>$request->sliped,
                    'selisih'=>$request->slipsls,
                    'source'=>$request->slipcedingbroker,
                    'source_2'=>$request->slipceding,
                    'currency'=>$request->slipcurrency,
                    'cob'=>$request->slipcob,
                    'koc'=>$request->slipkoc,
                    'occupacy'=>$request->slipoccupacy,
                    'build_const'=>$request->slipbld_const,
                    'slip_no'=>$request->slipno,
                    'cn_dn'=>$request->slipcndn,
                    'policy_no'=>$request->slippolicy_no,
                    'attacment_file'=>'',
                    'interest_insured'=>$interestlist->toJSon(),
                    'total_sum_insured'=>$request->sliptotalsum,
                    'insured_type'=>$request->sliptype,
                    'insured_pct'=>$request->slippct,
                    'total_sum_pct'=>$request->sliptotalsumpct,
                    'deductible_panel'=>$deductiblelist->toJson(),
                    'extend_coverage'=>$extendcoveragelist->toJson(),
                    'insurance_period_from'=>$request->slipipfrom,
                    'insurance_period_to'=>$request->slipipto,
                    'reinsurance_period_from'=>$request->sliprpfrom,
                    'reinsurance_period_to'=>$request->sliprpto,
                    'proportional'=>$request->slipproportional,
                    'layer_non_proportional'=>$request->sliplayerproportional,
                    'rate'=>$request->sliprate,
                    'v_broker'=>$request->slipvbroker,
                    'share'=>$request->slipshare,
                    'sum_share'=>$request->slipsumshare,
                    'basic_premium'=>$request->slipbasicpremium,
                    'commission'=>$request->slipcommission,
                    'grossprm_to_nr'=>$request->slipgrossprmtonr,
                    'netprm_to_nr'=>$request->slipnetprmtonr,
                    'sum_commission'=>$request->slipsumcommission,
                    'installment_panel'=>$installmentlist->toJson(),
                    'retrocession_panel'=>$retrocessionlist->toJson(),
                    'retro_backup'=>$request->sliprb,
                    'own_retention'=>$request->slipor,
                    'sum_own_retention'=>$request->slipsumor
                    

                ]);

                $notification = array(
                    'message' => 'Fire & Engginering Slip added successfully!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $currdate = date("Y-m-d");

                $slipdataid=$slipdata->id;
                $slipdataup = SlipTable::findOrFail($slipdataid);
                
                $slipdataup->number=$request->slipnumber;
                $slipdataup->username=Auth::user()->name;
                $slipdataup->insured_id=$request->code_ms;
                $slipdataup->prod_year=$currdate;
                $slipdataup->uy=$request->slipuy;
                $slipdataup->status=$request->slipstatus;
                $slipdataup->endorsment=$request->sliped;
                $slipdataup->selisih=$request->slipsls;
                $slipdataup->source=$request->slipcedingbroker;
                $slipdataup->source_2=$request->slipceding;
                $slipdataup->currency=$request->slipcurrency;
                $slipdataup->cob=$request->slipcob;
                $slipdataup->koc=$request->slipkoc;
                $slipdataup->occupacy=$request->slipoccupacy;
                $slipdataup->build_const=$request->slipbld_const;
                $slipdataup->slip_no=$request->slipno; 
                $slipdataup->cn_dn=$request->slipcndn; 
                $slipdataup->policy_no=$request->slippolicy_no; 
                $slipdataup->attacment_file=''; 
                $slipdataup->interest_insured=$interestlist->toJSon();
                $slipdataup->total_sum_insured=$request->sliptotalsum; 
                $slipdataup->insured_type=$request->sliptype; 
                $slipdataup->insured_pct=$request->slippct; 
                $slipdataup->total_sum_pct=$request->sliptotalsumpct; 
                $slipdataup->deductible_panel=$deductiblelist->toJson(); 
                $slipdataup->extend_coverage=$extendcoveragelist->toJson();  
                $slipdataup->insurance_period_from=$request->slipipfrom;  
                $slipdataup->insurance_period_to=$request->slipipto;  
                $slipdataup->reinsurance_period_from=$request->sliprpfrom;  
                $slipdataup->reinsurance_period_to=$request->sliprpto;
                $slipdataup->proportional=$request->slipproportional;
                $slipdataup->layer_non_proportional=$request->sliplayerproportional;  
                $slipdataup->rate=$request->sliprate;  
                $slipdataup->v_broker=$request->slipvbroker;
                $slipdataup->share=$request->slipshare;
                $slipdataup->sum_share=$request->slipsumshare;
                $slipdataup->basic_premium=$request->slipbasicpremium;
                $slipdataup->commission=$request->slipcommission; 
                $slipdataup->grossprm_to_nr=$request->slipgrossprmtonr; 
                $slipdataup->netprm_to_nr=$request->slipnetprmtonr; 
                $slipdataup->sum_commission=$request->slipsumcommission; 
                $slipdataup->installment_panel=$installmentlist->toJson();   
                $slipdataup->retrocession_panel=$retrocessionlist->toJson();  
                $slipdataup->retro_backup=$request->sliprb;
                $slipdataup->own_retention=$request->slipor;
                $slipdataup->sum_own_retention=$request->slipsumor;

                $slipdataup->save();


                $notification = array(
                    'message' => 'Fire & Engginering Slip Update successfully!',
                    'alert-type' => 'success'
                );
            }

            StatusLog::create([
                'status'=>$request->slipstatus,
                'user'=>Auth::user()->name,
                'insured_id'=>$request->code_ms,
                'slip_id'=>$request->slipnumber,
            ]);



            $slip = SlipTable::orderby('id','asc')->get();            
            $sliplastid = count($slip);

            $mydate = date("Y").date("m").date("d");
            $userid = Auth::user()->id;
            if($sliplastid != null){
                if($sliplastid < 10)
                {
                    $code_sl = "HIO".  $mydate . "0000" . strval($sliplastid + 1);
                }   
                elseif($sliplastid > 9 && $sliplastid < 100)
                {
                    $code_sl = "HIO".  $mydate . "000" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 99 && $sliplastid < 1000)
                {
                    $code_sl = "HIO".  $mydate . "00" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 999 && $sliplastid < 10000)
                {
                    $code_sl = "HIO".  $mydate . "0" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 9999 && $sliplastid < 100000)
                {
                    $code_sl = "HIO".  $mydate . strval($sliplastid + 1);
                }

                
            }
            else{
                $code_sl = "HIO".  $mydate . "0000" . strval(1);
            }

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
                    if($sliplastid < 10)
                    {
                        $code_sl = "HIO".  $mydate . "0000" . strval($sliplastid + $i);
                    }   
                    elseif($sliplastid > 9 && $sliplastid < 100)
                    {
                        $code_sl = "HIO".  $mydate . "000" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 99 && $sliplastid < 1000)
                    {
                        $code_sl = "HIO".  $mydate . "00" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 999 && $sliplastid < 10000)
                    {
                        $code_sl = "HIO".  $mydate . "0" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 9999 && $sliplastid < 100000)
                    {
                        $code_sl = "HIO".  $mydate . strval($sliplastid + $i);
                    }
                }

                $i++;
            }

            return response()->json(
                [
                    'id' => $slipdataup->id,
                    'number' => $slipdataup->number,
                    'slipuy' => $slipdataup->uy,
                    'code_sl'=> $code_sl,
                    'slipstatus' => $slipdataup->status
                ]
            );

            //return back()->with($notification);

            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Fire & Engginering Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function storepersonalaccidentinsured(Request $request)
    {
        $validator = $request->validate([
            'msinumber'=>'required'
        ]);

        $shiplist= FeLookupLocation::where('insured_id','=',$request->msinumber)->orderby('created_at','desc')->get();
        
        if($validator)
        {
            $user = Auth::user();
            
            $insureddata= Insured::where('number','=',$request->msinumber)->first();

            if($insureddata==null)
            {
                Insured::create([
                    'number'=>$request->msinumber,
                    'slip_type'=>'pa',
                    'insured_prefix' => $request->msiprefix,
                    'insured_name'=>strtoupper($request->msisuggestinsured),
                    'insured_suffix'=>strtoupper($request->msisuffix),
                    'share'=>$request->msishare,
                    'share_from'=>$request->msisharefrom,
                    'share_to'=>$request->msishareto,
                    'location'=>$shiplist->toJson(),
                    'coincurance'=>$request->msicoinsurance
                ]);

                $notification = array(
                    'message' => 'Personal Accident Insured added successfully!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $insureddataid=$insureddata->id;
                $insureddataup = Insured::findOrFail($insureddataid);
                $insureddataup->slip_type='pa';
                $insureddataup->insured_prefix=$request->msiinsured;
                $insureddataup->insured_name=$request->msisuggestinsured;
                $insureddataup->insured_suffix=$request->msisuffix;
                $insureddataup->share=$request->msishare;
                $insureddataup->share_from=$request->msisharefrom;
                $insureddataup->share_to=$request->msishareto;
                $insureddataup->location=$shiplist->toJson();
                $insureddataup->coincurance=$request->msicoinsurance;
                $insureddataup->save();


                $notification = array(
                    'message' => 'Personal Accident Insured Update successfully!',
                    'alert-type' => 'success'
                );
            }
            // dd($shiplist);
            // ShipListTemp::whereIn('id', $shiplist->id)->update(['status' => 'saved']);
            // ShipListTemp::where('status','pending')->delete();

            return back()->with($notification);
            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Personal Accident Insured added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function storepersonalaccidentslip(Request $request)
    {
        $validator = $request->validate([
            'slipnumber'=>'required'
        ]);
        
        
        if($validator)
        {
            $user = Auth::user();
            
            $slipdata= SlipTable::where('number','=',$request->slipnumber)->first();
            
            $interestlist= InterestInsuredTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $installmentlist= InstallmentTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $deductiblelist= DeductibleTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();
            $retrocessionlist=RetrocessionTemp::where('slip_id','=',$request->slipnumber)->orderby('id','desc')->get();             

            if($slipdata==null)
            {
                $currdate = date("Y-m-d");

                $slipdataup=SlipTable::create([
                    'number'=>$request->slipnumber,
                    'username'=>Auth::user()->name,
                    'insured_id'=>$request->code_ms,
                    'slip_type'=>'pa',
                    'prod_year' => $currdate,
                    'uy'=>$request->slipuy,
                    'status'=>$request->slipstatus,
                    'endorsment'=>$request->sliped,
                    'selisih'=>$request->slipsls,
                    'source'=>$request->slipcedingbroker,
                    'source_2'=>$request->slipceding,
                    'currency'=>$request->slipcurrency,
                    'cob'=>$request->slipcob,
                    'koc'=>$request->slipkoc,
                    'occupacy'=>$request->slipoccupacy,
                    'build_const'=>$request->slipbld_const,
                    'slip_no'=>$request->slipno,
                    'cn_dn'=>$request->slipcndn,
                    'policy_no'=>$request->slippolicy_no,
                    'attacment_file'=>'',
                    'interest_insured'=>$interestlist->toJSon(),
                    'total_sum_insured'=>$request->sliptotalsum,
                    'insured_type'=>$request->sliptype,
                    'insured_pct'=>$request->slippct,
                    'total_sum_pct'=>$request->sliptotalsumpct,
                    'deductible_panel'=>$deductiblelist->toJson(),
                    'extend_coverage'=>$extendcoveragelist->toJson(),
                    'insurance_period_from'=>$request->slipipfrom,
                    'insurance_period_to'=>$request->slipipto,
                    'reinsurance_period_from'=>$request->sliprpfrom,
                    'reinsurance_period_to'=>$request->sliprpto,
                    'proportional'=>$request->slipproportional,
                    'layer_non_proportional'=>$request->sliplayerproportional,
                    'rate'=>$request->sliprate,
                    'v_broker'=>$request->slipvbroker,
                    'share'=>$request->slipshare,
                    'sum_share'=>$request->slipsumshare,
                    'basic_premium'=>$request->slipbasicpremium,
                    'commission'=>$request->slipcommission,
                    'grossprm_to_nr'=>$request->slipgrossprmtonr,
                    'netprm_to_nr'=>$request->slipnetprmtonr,
                    'sum_commission'=>$request->slipsumcommission,
                    'installment_panel'=>$installmentlist->toJson(),
                    'retrocession_panel'=>$retrocessionlist->toJson(),
                    'retro_backup'=>$request->sliprb,
                    'own_retention'=>$request->slipor,
                    'sum_own_retention'=>$request->slipsumor
                    

                ]);

                $notification = array(
                    'message' => 'Personal Accident Slip added successfully!',
                    'alert-type' => 'success'
                );
            }
            else
            {
                $currdate = date("Y-m-d");

                $slipdataid=$slipdata->id;
                $slipdataup = SlipTable::findOrFail($slipdataid);
                
                $slipdataup->number=$request->slipnumber;
                $slipdataup->username=Auth::user()->name;
                $slipdataup->insured_id=$request->code_ms;
                $slipdataup->prod_year=$currdate;
                $slipdataup->uy=$request->slipuy;
                $slipdataup->status=$request->slipstatus;
                $slipdataup->endorsment=$request->sliped;
                $slipdataup->selisih=$request->slipsls;
                $slipdataup->source=$request->slipcedingbroker;
                $slipdataup->source_2=$request->slipceding;
                $slipdataup->currency=$request->slipcurrency;
                $slipdataup->cob=$request->slipcob;
                $slipdataup->koc=$request->slipkoc;
                $slipdataup->occupacy=$request->slipoccupacy;
                $slipdataup->build_const=$request->slipbld_const;
                $slipdataup->slip_no=$request->slipno; 
                $slipdataup->cn_dn=$request->slipcndn; 
                $slipdataup->policy_no=$request->slippolicy_no; 
                $slipdataup->attacment_file=''; 
                $slipdataup->interest_insured=$interestlist->toJSon();
                $slipdataup->total_sum_insured=$request->sliptotalsum; 
                $slipdataup->insured_type=$request->sliptype; 
                $slipdataup->insured_pct=$request->slippct; 
                $slipdataup->total_sum_pct=$request->sliptotalsumpct; 
                $slipdataup->deductible_panel=$deductiblelist->toJson(); 
                $slipdataup->extend_coverage=$extendcoveragelist->toJson();  
                $slipdataup->insurance_period_from=$request->slipipfrom;  
                $slipdataup->insurance_period_to=$request->slipipto;  
                $slipdataup->reinsurance_period_from=$request->sliprpfrom;  
                $slipdataup->reinsurance_period_to=$request->sliprpto;
                $slipdataup->proportional=$request->slipproportional;
                $slipdataup->layer_non_proportional=$request->sliplayerproportional;  
                $slipdataup->rate=$request->sliprate;  
                $slipdataup->v_broker=$request->slipvbroker;
                $slipdataup->share=$request->slipshare;
                $slipdataup->sum_share=$request->slipsumshare;
                $slipdataup->basic_premium=$request->slipbasicpremium;
                $slipdataup->commission=$request->slipcommission; 
                $slipdataup->grossprm_to_nr=$request->slipgrossprmtonr; 
                $slipdataup->netprm_to_nr=$request->slipnetprmtonr; 
                $slipdataup->sum_commission=$request->slipsumcommission; 
                $slipdataup->installment_panel=$installmentlist->toJson();   
                $slipdataup->retrocession_panel=$retrocessionlist->toJson();  
                $slipdataup->retro_backup=$request->sliprb;
                $slipdataup->own_retention=$request->slipor;
                $slipdataup->sum_own_retention=$request->slipsumor;

                $slipdataup->save();


                $notification = array(
                    'message' => 'Personal Accident Slip Update successfully!',
                    'alert-type' => 'success'
                );
            }

            StatusLog::create([
                'status'=>$request->slipstatus,
                'user'=>Auth::user()->name,
                'insured_id'=>$request->code_ms,
                'slip_id'=>$request->slipnumber,
            ]);



            $slip = SlipTable::orderby('id','asc')->get();            
            $sliplastid = count($slip);

            $mydate = date("Y").date("m").date("d");
            $userid = Auth::user()->id;
            if($sliplastid != null){
                if($sliplastid < 9)
                {
                    $code_sl = "PA".  $mydate . "0000" . strval($sliplastid + 1);
                }   
                elseif($sliplastid > 8 && $sliplastid < 100)
                {
                    $code_sl = "PA".  $mydate . "000" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 99 && $sliplastid < 1000)
                {
                    $code_sl = "PA".  $mydate . "00" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 999 && $sliplastid < 10000)
                {
                    $code_sl = "PA".  $mydate . "0" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 9999 && $sliplastid < 100000)
                {
                    $code_sl = "PA".  $mydate . strval($sliplastid + 1);
                }

                
            }
            else{
                $code_sl = "PA".  $mydate . "0000" . strval(1);
            }

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
                        $code_sl = "PA".  $mydate . "0000" . strval($sliplastid + $i);
                    }   
                    elseif($sliplastid > 8 && $sliplastid < 100)
                    {
                        $code_sl = "PA".  $mydate . "000" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 99 && $sliplastid < 1000)
                    {
                        $code_sl = "PA".  $mydate . "00" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 999 && $sliplastid < 10000)
                    {
                        $code_sl = "PA".  $mydate . "0" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 9999 && $sliplastid < 100000)
                    {
                        $code_sl = "PA".  $mydate . strval($sliplastid + $i);
                    }
                }

                $i++;
            }

            return response()->json(
                [
                    'id' => $slipdataup->id,
                    'number' => $slipdataup->number,
                    'slipuy' => $slipdataup->uy,
                    'code_sl'=> $code_sl,
                    'slipstatus' => $slipdataup->status
                ]
            );

            //return back()->with($notification);

            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');
        
        }
        else
        {

            $notification = array(
                'message' => 'Personal Accident Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    public function storepersonalaccidentendorsement(Request $request)
    {
        $validator = $request->validate([
            'slipnumber'=>'required'
        ]);
        

        if($validator)
        {
            $user = Auth::user();
            
            $slipdata= SlipTable::where('number','=',$request->prevslipnumber)->first();
            
            $interestlist= InterestInsuredTemp::where('slip_id','=',$request->prevslipnumber)->orderby('id','desc')->get();
            $installmentlist= InstallmentTemp::where('slip_id','=',$request->prevslipnumber)->orderby('id','desc')->get();
            $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$request->prevslipnumber)->orderby('id','desc')->get();
            $deductiblelist= DeductibleTemp::where('slip_id','=',$request->prevslipnumber)->orderby('id','desc')->get();
            $retrocessionlist=RetrocessionTemp::where('slip_id','=',$request->prevslipnumber)->orderby('id','desc')->get();             

            if($slipdata==null)
            {
                $notification = array(
                    'message' => 'Personal Accident Slip added Fail!',
                    'alert-type' => 'danger'
                );
            }
            else
            {
                $currdate = date("Y-m-d");

                $slipdataid=$slipdata->id;
                $slipdataup = SlipTable::findOrFail($slipdataid);
                
                $slipdataup->number=$request->slipnumber;
                $slipdataup->username=Auth::user()->name;
                $slipdataup->insured_id=$request->code_ms;
                $slipdataup->prod_year=$currdate;
                $slipdataup->uy=$request->slipuy;
                $slipdataup->status=$request->slipstatus;
                $slipdataup->endorsment=$request->sliped;
                $slipdataup->selisih=$request->slipsls;
                $slipdataup->source=$request->slipcedingbroker;
                $slipdataup->source_2=$request->slipceding;
                $slipdataup->currency=$request->slipcurrency;
                $slipdataup->cob=$request->slipcob;
                $slipdataup->koc=$request->slipkoc;
                $slipdataup->occupacy=$request->slipoccupacy;
                $slipdataup->build_const=$request->slipbld_const;
                $slipdataup->slip_no=$request->slipno; 
                $slipdataup->cn_dn=$request->slipcndn; 
                $slipdataup->policy_no=$request->slippolicy_no; 
                $slipdataup->attachment_file=''; 
                $slipdataup->interest_insured=$interestlist->toJSon();
                $slipdataup->total_sum_insured=$request->sliptotalsum; 
                $slipdataup->insured_type=$request->sliptype; 
                $slipdataup->insured_pct=$request->slippct; 
                $slipdataup->total_sum_pct=$request->sliptotalsumpct; 
                $slipdataup->deductible_panel=$deductiblelist->toJson(); 
                $slipdataup->extend_coverage=$extendcoveragelist->toJson();  
                $slipdataup->insurance_period_from=$request->slipipfrom;  
                $slipdataup->insurance_period_to=$request->slipipto;  
                $slipdataup->reinsurance_period_from=$request->sliprpfrom;  
                $slipdataup->reinsurance_period_to=$request->sliprpto;
                $slipdataup->proportional=$request->slipproportional;
                $slipdataup->layer_non_proportional=$request->sliplayerproportional;  
                $slipdataup->rate=$request->sliprate; 
                $slipdataup->v_broker=$request->slipvbroker;
                $slipdataup->share=$request->slipshare;
                $slipdataup->sum_share=$request->slipsumshare;
                $slipdataup->basic_premium=$request->slipbasicpremium;
                $slipdataup->commission=$request->slipcommission; 
                $slipdataup->grossprm_to_nr=$request->slipgrossprmtonr; 
                $slipdataup->netprm_to_nr=$request->slipnetprmtonr; 
                $slipdataup->sum_commission=$request->slipsumcommission; 
                $slipdataup->installment_panel=$installmentlist->toJson();   
                $slipdataup->retrocession_panel=$retrocessionlist->toJson();  
                $slipdataup->retro_backup=$request->sliprb;
                $slipdataup->own_retention=$request->slipor;


                if($slipdataup->slip_idendorsementcount==NULL || $slipdataup->slip_idendorsementcount=="")
                {
                    $countendorsement=1;
                }
                else 
                {
                    $countendorsement=$slipdataup->slip_idendorsementcount+1;
                }

                $slipdataup->slip_idendorsementcount=$countendorsement;
                
                
                $slipdataup->prev_endorsement=$request->prevslipnumber;
                $slipdataup->sum_own_retention=$request->slipsumor;

                $slipdataup->save();

                InterestInsuredTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
                InstallmentTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
                ExtendCoverageTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
                DeductibleTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));
                RetrocessionTemp::where('slip_id','=',$request->prevslipnumber)->update(array('slip_id' => $request->slipnumber));          
    

                $notification = array(
                    'message' => 'Personal Accident Slip Update successfully!',
                    'alert-type' => 'success'
                );
            }

            StatusLog::create([
                'status'=>$request->slipstatus,
                'user'=>Auth::user()->name,
                'insured_id'=>$request->code_ms,
                'slip_id'=>$request->slipnumber,
            ]);

           
            $slip = SlipTable::orderby('id','asc')->get();            
            $sliplastid = count($slip);

            $mydate = date("Y").date("m").date("d");
            $userid = Auth::user()->id;
            if($sliplastid != null){
                if($sliplastid < 9)
                {
                    $code_sl = "PA".  $mydate . "0000" . strval($sliplastid + 1);
                }   
                elseif($sliplastid > 8 && $sliplastid < 100)
                {
                    $code_sl = "PA".  $mydate . "000" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 99 && $sliplastid < 1000)
                {
                    $code_sl = "PA".  $mydate . "00" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 999 && $sliplastid < 10000)
                {
                    $code_sl = "PA".  $mydate . "0" . strval($sliplastid + 1);
                }
                elseif($sliplastid > 9999 && $sliplastid < 100000)
                {
                    $code_sl = "PA".  $mydate . strval($sliplastid + 1);
                }

                
            }
            else{
                $code_sl = "PA".  $mydate . "0000" . strval(1);
            }

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
                        $code_sl = "PA".  $mydate . "0000" . strval($sliplastid + $i);
                    }   
                    elseif($sliplastid > 8 && $sliplastid < 100)
                    {
                        $code_sl = "PA".  $mydate . "000" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 99 && $sliplastid < 1000)
                    {
                        $code_sl = "PA".  $mydate . "00" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 999 && $sliplastid < 10000)
                    {
                        $code_sl = "PA".  $mydate . "0" . strval($sliplastid + $i);
                    }
                    elseif($sliplastid > 9999 && $sliplastid < 100000)
                    {
                        $code_sl = "PA".  $mydate . strval($sliplastid + $i);
                    }
                }

                $i++;
            }

            return response()->json(
                [
                    'id' => $slipdataup->id,
                    'number' => $slipdataup->number,
                    'slipuy' => $slipdataup->uy,
                    'code_sl'=> $code_sl,
                    'slipstatus' => $slipdataup->status
                ]
            );
        
        }
        else
        {

            $notification = array(
                'message' => 'Personal Accident Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }


    public function storeshiplist(Request $request)
    {
            $shipcode = $request->ship_code;
            $insured_id = $request->insuredID;
            $slip_type = $request->sliptype;
            $cedingname = $request->ceding;
            $amount = $request->slipamount;
            $cn_dn = $request->cndn;
            $cert_no = $request->certno;
            $slip_no = $request->slipno;
            $policy_no = $request->policyno;
            $percentage = $request->percent;
            $token = $request->_token;
            
            $mydate = date("Y") . date("m") . date("d");
                
            if($shipcode !=''  && $insured_id != '' )
            {
                $shipdata = MarineLookup::where('code',$shipcode)->first();
                if($slip_type == 'mh')
                {
                    $checkExistShipList = ShipListTemp::where('insured_id',$insured_id)->first();
                    if ($checkExistShipList) {
                        if ($checkExistShipList->token == null) {

                            $code_ms = $insured_id;
                        }else if ($token != null && $token != $checkExistShipList->token) {
                            $code_ms = "IN". $mydate .str_pad( intval(ltrim(substr($checkExistShipList->insured_id,-5) , "0"))+1, 5, '0', STR_PAD_LEFT);
                        }else{
                            $code_ms = $checkExistShipList->insured_id;
                        }
                    }else{
                        $code_ms = $insured_id;
                            
                    }
                    $condition = ShipListTemp::where('insured_id', $code_ms)
                    ->where('slip_type','mh')
                    ->where('ceding_id', $cedingname)
                    ->where('ship_code',$shipcode)
                    ->where('status','passive')
                    ->first();

                    if(empty($condition))
                    {
                            $sumperceding = DB::table('shiplist_detail')
                                ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                                ->where('shiplist_detail.insured_id', '=', $code_ms)
                                ->where('shiplist_detail.slip_type', '=', $slip_type)
                                ->select(DB::raw('sum(shiplist_detail.amount) as amount'), 'ceding_broker.name', DB::raw('sum(shiplist_detail.percent) as percentage'))
                                ->groupBy('ceding_broker.name')
                                ->get();

                            $slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mh')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->orderby('id', 'desc')->get();
                            
                            //dd($sumperceding);
                            $totalpercent=0;

                            if(!empty($sumperceding))
                            {
                                foreach($sumperceding as $cedingdata)
                                {
                                    $totalpercent=$totalpercent+$cedingdata->percentage;
                                }

                                $totalpercent=$totalpercent+$percentage;
                            }
                            else
                            {
                            $totalpercent=$totalpercent+$percentage;
                            }
                            
                            $shiplist = new ShipListTemp();
                            $shiplist->insured_id = $code_ms;
                            $shiplist->ship_code = $shipcode;
                            $shiplist->ship_name = $shipdata->shipname; 
                            $shiplist->ceding_id  = $cedingname;
                            $shiplist->percent = $percentage;
                            $shiplist->amount = $amount;
                            $shiplist->cndn = $cn_dn;
                            $shiplist->certno = $cert_no;
                            $shiplist->slipno = $slip_no;
                            $shiplist->policyno = $policy_no;
                            $shiplist->status = "passive"; 
                            $shiplist->slip_type =  $slip_type; 
                            $shiplist->token =  $token; 

                            $cedingdata= CedingBroker::where('id','=',$cedingname)->first();


                            if($totalpercent<=100)
                            {
                                $shiplist->save();   
                                
                                $sumperceding = DB::table('shiplist_detail')
                                ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                                ->where('shiplist_detail.insured_id', '=', $code_ms)
                                ->where('shiplist_detail.slip_type', '=', $slip_type)
                                ->select(DB::raw('sum(shiplist_detail.amount) as amount'), 'ceding_broker.name', DB::raw('sum(shiplist_detail.percent) as percentage'))
                                ->groupBy('ceding_broker.name')
                                ->get();
                            }

                                
                        return response()->json(
                            [
                                'success' => true,
                                'id' => $shiplist->id,
                                'ceding_id' => $shiplist->ceding_id,
                                'percentage' => $shiplist->percent,
                                'insured_id' => $code_ms,
                                'cndn' => $shiplist->cndn,
                                'certno' => $shiplist->certno,
                                'slipno' => $shiplist->slipno,
                                'policyno' => $shiplist->policy_no,
                                'amount' => $shiplist->amount,

                                'ship_name' => $shipdata->shipname,
                                'ship_code' => $shipcode,
                                'sumceding' => $sumperceding,
                                'insured_id' => $shiplist->insured_id,
                                'id_ceding' => @$cedingdata->id,
                                'code_ceding' => $cedingdata->code,
                                'name_ceding' => $cedingdata->name,
                                'totalpercent'=> $totalpercent,
                                'slipdata2'=> $slipdata2
                            ]
                        );
                    
                    }
                    else {
                        # code...
                        return response()->json(
                            [
                                'success' => false,
                                'message' => 'Duplicate Data'
                            ]
                        );
                    }

                }
                else
                {
                    $checkExistShipList = ShipListTemp::where('insured_id',$insured_id)->first();
                    if ($checkExistShipList) {
                        if ($checkExistShipList->token == null) {

                            $code_ms = $insured_id;
                        }else if ($token != null && $token != $checkExistShipList->token) {
                            $code_ms = "IN". $mydate .str_pad( intval(ltrim(substr($checkExistShipList->insured_id,-5) , "0"))+1, 5, '0', STR_PAD_LEFT);
                        }else{
                            $code_ms = $checkExistShipList->insured_id;    
                        }
                    }else{
                        $code_ms = $insured_id;
                            
                    }

                    $condition = ShipListTemp::where('insured_id', $code_ms)
                    ->where('slip_type','mc')
                    ->where('ship_code', $shipcode)
                    // ->where('deleted_at', null)
                    ->first();
                    //$condition2 = ShipListTemp::where('insured_id', $code_ms)->where('ship_code', $shipcode)->first();

                    if(empty($condition))
                    {
                        $shiplist = new ShipListTemp();
                        $shiplist->insured_id = $code_ms;
                        $shiplist->ship_code = $shipcode;
                        $shiplist->ship_name = $shipdata->shipname; 
                        $shiplist->status = "passive"; 
                        $shiplist->slip_type = "mc";
                        $shiplist->token = $token;
                        $shiplist->save();

                        $shiplist->success=true;
                        return response()->json($shiplist);
                    }
                    else {
                        # code...
                        return response()->json(
                            [
                                'success' => false,
                                'message' => 'Duplicate Data'

                            ]
                        );
                    }
                    
                    // $shipdataupd = ShipListTemp::where('id',$shiplist->id)->orderby('id','desc')->first();
                    // $shipdataupd->status='active'; 
                    // $shipdataupd->save();       

                  
                    
                }
            }
            else
            {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );
            }
        
    }


    public function storeinterestlist(Request $request)
    {
            // Add data interest
            $interest = $request->interest_insured;
            $cedingname = $request->ceding;
            $amount = $request->slipamount;
            $insured_id = $request->id_insured;
            $cn_dn = $request->cndn;
            $cert_no = $request->certno;
            $slip_no = $request->slipno;
            $policy_no = $request->policyno;
            $percentage = $request->percent;
            $slip_type = $request->sliptype;
            $ship_list_id = $request->shiplist_id;
        
            if($interest !='' && $amount !='' && $insured_id != '')
            {
                //$shiplist= ShipListTemp::select('percent')->where('insured_id',$insured_id)->orderby('id','desc')->get();
                
                if($slip_type == 'mc')
                {
                           
                    
                    
                    if (empty($cedingname) || empty($insured_id) || empty($ship_list_id)) {
                        return response()->json(
                            [
                                'success' => false,
                                'message' => 'Fill all fields',
                                'cedingname' => $cedingname,
                                'insured_id' => $insured_id,
                                'ship_list_id' => $ship_list_id
                            ]
                        );
                    }
                    $condition = InterestInsuredTemp::where('ceding_id', $cedingname)
                    ->where('slip_type','mc')
                    ->where('insured_id',$insured_id)
                    ->where('ship_id', $ship_list_id)      
                    ->where('interest_id', $interest)      
                    ->first();
                    if(empty($condition))
                    {
                            $sumperceding = DB::table('interest_insured_detail')
                            ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                            ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                            ->where('shiplist_detail.insured_id', '=', $insured_id)
                            ->select(DB::raw('sum(interest_insured_detail.amount) as amount'),'ceding_broker.name',DB::raw('sum(interest_insured_detail.percent) as percentage'))
                            ->groupBy('ceding_broker.name')
                            ->get();


                            $interestlist = new InterestInsuredTemp();
                            $interestlist->interest_id  = $interest;
                            $interestlist->ceding_id  = $cedingname;
                            $interestlist->percent = $percentage;
                            $interestlist->amount = $amount;
                            $interestlist->cndn = $cn_dn;
                            $interestlist->certno = $cert_no;
                            $interestlist->slipno = $slip_no;
                            $interestlist->policyno = $policy_no;
                            $interestlist->insured_id = $insured_id; 
                            $interestlist->status = 'passive'; 
                            $interestlist->slip_type = $slip_type; 
                            $interestlist->ship_id = $ship_list_id; 


                            if(!empty($sumperceding[0]->percentage))
                            {
                                $totalpercent=$sumperceding[0]->percentage+$percentage;
                            }
                            else
                            {
                                $totalpercent=0+$percentage;
                            }
                            

                            if($totalpercent<=100)
                            {
                                $interestlist->save();
                            }

                            $interestdata= InterestInsured::where('id','=',$interest)->first();
                            $cedingdata= CedingBroker::where('id','=',$cedingname)->first();


                                $brokerchoice = DB::table('interest_insured_detail')
                                    ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                                    ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                                    ->where('shiplist_detail.insured_id', '=', $insured_id)
                                    ->orWhere('ceding_broker.type', '=', 5)
                                    ->orWhere('ceding_broker.type', '=', 4)
                                    ->select('interest_insured_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                                    ->distinct()
                                    ->get();

                                // dd($brokerchoice);

                            $sumperceding = DB::table('interest_insured_detail')
                            ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                            ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                            ->where('shiplist_detail.insured_id', '=', $insured_id)
                            ->select(DB::raw('sum(interest_insured_detail.amount) as amount'),'ceding_broker.name',DB::raw('sum(interest_insured_detail.percent) as percentage'))
                            ->groupBy('ceding_broker.name')
                            ->get();
            


                            return response()->json(
                                [
                                    'success' => true,
                                    'id' => $interestlist->id,
                                    'interest_id' => $interestlist->interest_id,
                                    'percentage' => $interestlist->percent,
                                    'cndn' => $interestlist->cndn,
                                    'certno' => $interestlist->certno,
                                    'slipno' => $interestlist->slipno,
                                    'policyno' => $interestlist->policy_no,
                                    'amount' => $interestlist->amount,
                                    'sumceding' => $sumperceding,
                                    'insured_id' => $interestlist->insured_id,
                                    'description' => $interestdata->description,
                                    'id_ceding' => $cedingdata->id,
                                    'code_ceding' => $cedingdata->code,
                                    'name_ceding' => $cedingdata->name,
                                    'totalpercent'=>$totalpercent
                                ]
                            );
                    }
                    else {
                        # code...
                        return response()->json(
                            [
                                'success' => false,
                                'message' => 'Duplicated'
                            ]
                        );
                    }

                }
                else
                {

                    $interestlist = new InterestInsuredTemp();
                    $interestlist->interest_id  = $interest;
                    $interestlist->percent = $percentage;
                    $interestlist->amount = $amount;
                    $interestlist->status = 'passive'; 
                    //$interestlist->save();


                    $interestdata= InterestInsured::where('id','=',$interest)->first();
                    $cedingdata= CedingBroker::where('id','=',$cedingname)->first();

                    return response()->json(
                        [
                            'success' => true,
                            'id' => $interestlist->id,
                            'interest_id' => $interestlist->interest_id,
                            'percentage' => $interestlist->percent,
                            'amount' => $interestlist->amount,
                            'insured_id' => $interestlist->insured_id,
                            'description' => $interestdata->description
                        ]
                    );
                }
        
            }
            else
            {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );
            }
        
    }


    public function storeinstallmentlist(Request $request)
    {

            $percentage = $request->percentage;
            $installmentdate = $request->installmentdate;
            $amount = $request->slipamount;
            $slip_id = $request->id_slip;
            $insured_id = $request->insured_id;
            $slip_type = $request->sliptype;
            $status = 'passive';
            $count_endorsement = null;
            if($request->countendorsement){
                $count_endorsement = $request->countendorsement;
            }else{
                $count_endorsement = 0;
            }
            $slipdata = SlipTable::where('number', '=', $slip_id)->where('insured_id', '=', $insured_id)->where('slip_type', $slip_type)->where('status','passive')->orderby('id', 'desc')->first();
            
            if(!empty($slipdata->endorsment))
            {
             $id_ed = ($slipdata->endorsment);
            }
            else
            {
                $id_ed =0;
            }


            $checkit = InstallmentTemp::where('slip_id',$slip_id)
            ->where('insured_id',$insured_id)
            ->where('slip_type',$request->sliptype)
            ->where('status','passive')
            ->where('minus','false')
            ->where('count_endorsement',$count_endorsement)
            ->where('deleted_at',null)
            ->sum('percentage');
            $totalpercent = $checkit + $percentage;
        
            if($percentage !='' && $amount !='' && $slip_id != '')
            {
                $checkdateins = InstallmentTemp::where('slip_id',$slip_id)->orderby('id','desc')->get();


                if(floatval($totalpercent) <= 100.00 || floatval($totalpercent) <= 100)
                {
                    $old_date_timestamp = strtotime($installmentdate);
                    $new_date = date('Y-m-d', $old_date_timestamp); 
                    $checkdatesame = InstallmentTemp::where('insured_id',$insured_id)->where('slip_id',$slip_id)->where('slip_type',$slip_type)->where('installment_date',$new_date)->where('status','passive')->orderby('id','desc')->get();
                    $count_datesame = count($checkdatesame);

                    if($count_datesame > 0 ){
                        return response()->json(
                            [
                                'code_error' => '404',
                                'message' => 'sorry date installment cannot same'
                            ]
                        );
                    }else{

                        $installmentlist = new InstallmentTemp();
                        $installmentlist->installment_date  = $new_date;
                        $installmentlist->percentage  = $percentage;
                        $installmentlist->amount = $amount;
                        $installmentlist->slip_id = $slip_id; 
                        $installmentlist->insured_id = $insured_id; 
                        $installmentlist->slip_type = $slip_type; 
                        $installmentlist->status = $status; 
                        $installmentlist->count_endorsement = $count_endorsement; 
                        $installmentlist->minus = "false"; 
                        $installmentlist->save();

                        $checkit2 = DB::table('installment_panel_detail')->where('installment_panel_detail.slip_id',$installmentlist->slip_id)->sum('installment_panel_detail.percentage');
                        $checkit3 = DB::table('installment_panel_detail')->where('installment_panel_detail.slip_id',$installmentlist->slip_id)->sum('installment_panel_detail.amount');
                        
                        if(empty($checkit3))
                        {
                            $checkit3=0;
                        }

                        $minpercent2 = 100 - $checkit2;



                        if(floatval($checkit2) < 100.00)
                        {
                                return response()->json(
                                    [
                                        'id' => $installmentlist->id,
                                        'percentage' => $installmentlist->percentage,
                                        'installment_date' => date("d/m/Y", strtotime($new_date)),
                                        'amount' => $installmentlist->amount,
                                        'totalamount' => $checkit3,
                                        'slip_id' => $installmentlist->slip_id,
                                        'message' => 'sorry percent must 100%, your percent minus '. $minpercent2.'percent'
                                    ]
                                );
                        }
                        elseif (floatval($checkit2) == 100.00) 
                        {
                            return response()->json(
                                    [
                                        'id' => $installmentlist->id,
                                        'percentage' => $installmentlist->percentage,
                                        'installment_date' => date("d/m/Y", strtotime($new_date)),
                                        'amount' => $installmentlist->amount,
                                        'totalamount' => $checkit3,
                                        'slip_id' => $installmentlist->slip_id
                                    ]
                                );
                        }
                        else
                        {
                            return response()->json(
                                [
                                    'id' => $installmentlist->id,
                                    'percentage' => $installmentlist->percentage,
                                    'installment_date' => date("d/m/Y", strtotime($new_date)),
                                    'amount' => $installmentlist->amount,
                                    'totalamount' => $checkit3,
                                    'slip_id' => $installmentlist->slip_id
                                ]
                            );
                        }

                    }
                }
                else
                {
                    return response()->json(
                        [
                            'code_error' => '404',
                            'message' => 'sorry percent cannot more than 100%'
                        ]
                    );
                }
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }

    public function storedeductiblelist(Request $request)
    {

            $deductibletype_id = $request->slipdptype;
            // $currency = $request->slipdpcurrency;
            $minamount = $request->minamount;
            $amount = $request->amount;
            $percentage = $request->percentage;
            $slip_id = $request->id_slip;
            $insured_id = $request->insured_id;
            $slip_type = $request->sliptype;
            $status = 'passive';
            $count_endorsement = null;

            


            if($request->countendorsement){
                $count_endorsement = $request->countendorsement;
            }else{
                $count_endorsement = 0;
            }
            if (empty($deductibletype_id)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill Type first'
                    ]
                );                
            }
            if($percentage !='' && $amount !='' && $slip_id != '')
            {
                
                $condition = DeductibleTemp::where('slip_id',$slip_id)
                ->where('insured_id',$insured_id)
                ->where('deductibletype_id',$deductibletype_id)
                ->where('count_endorsement',$count_endorsement)
                ->where('deleted_at',null)
                ->where('status','passive')->first();
        
                if(empty($condition))
                {
                    $deductiblelist = new DeductibleTemp();
                    $deductiblelist->deductibletype_id  = $deductibletype_id;
                    // $deductiblelist->currency_id  = $currency;
                    $deductiblelist->percentage  = $percentage;
                    $deductiblelist->amount = $amount;
                    $deductiblelist->min_claimamount = $minamount;
                    $deductiblelist->slip_id = $slip_id; 
                    $deductiblelist->insured_id = $insured_id;
                    $deductiblelist->slip_type = $slip_type;
                    $deductiblelist->status = $status;
                    $deductiblelist->count_endorsement = $count_endorsement;
                    $deductiblelist->minus = 'false';
                    $deductiblelist->save();

                        return response()->json(
                        [
                            'success' => true,
                            'id' => $deductiblelist->id,
                            'deductibletype_id' => $deductiblelist->deductibletype_id,
                            'deductibletype' => $deductiblelist->DeductibleType->description,
                            'dtdescript' => $deductiblelist->DeductibleType->description,
                            'dtabbrev' => $deductiblelist->DeductibleType->abbreviation,
                            'percentage' => $deductiblelist->percentage,
                            // 'currency_id' => $deductiblelist->currency_id,
                            // 'currencydata' => $deductiblelist->currency->code.'-'.$deductiblelist->currency->symbol_name,
                            'amount' => $deductiblelist->amount,
                            'min_claimamount' => $deductiblelist->min_claimamount,
                            'slip_id' => $deductiblelist->slip_id                        
                        ]
                    );
                }
                else {
                    # code...
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Duplicate Data'
                        ]
                    );
                }
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }


    public function storeextendcoveragelist(Request $request)
    {

            $percentage = $request->percentage;
            $slipcncode = $request->slipcncode;
            $amount = $request->amount;
            $slip_id = $request->id_slip;
            $insured_id = $request->insured_id;
            $slip_type = $request->sliptype;
            if($request->countendorsement){
                $count_endorsement = $request->countendorsement;
            }else{
                $count_endorsement = 0;
            }
            $status = 'passive';
        
            if($percentage !='' && $amount !='' && $slip_id != '')
            {
                $checkextendcoverage = ExtendCoverageTemp::where('extendcoverage_id',$slipcncode)->where('slip_id',$slip_id)->where('insured_id',$insured_id)->where('slip_type',$slip_type)->where('count_endorsement',$count_endorsement)->where('status',$status)->get();
                $countextend = count($checkextendcoverage);
                if($countextend > 0){
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Perill code already submit'
                        ]
                    );
                }else{
                    $extendcoveragelist = new ExtendCoverageTemp();
                    $extendcoveragelist->extendcoverage_id  = $slipcncode;
                    $extendcoveragelist->percentage  = $percentage;
                    $extendcoveragelist->amount = $amount;
                    $extendcoveragelist->slip_id = $slip_id; 
                    $extendcoveragelist->insured_id = $insured_id; 
                    $extendcoveragelist->slip_type = $slip_type; 
                    $extendcoveragelist->status = $status;
                    $extendcoveragelist->count_endorsement = $count_endorsement;
                    $extendcoveragelist->minus = "false";
                    $extendcoveragelist->save();

                    return response()->json(
                        [
                            'id' => $extendcoveragelist->id,
                            'percentage' => $extendcoveragelist->percentage,
                            'extendcoverage_id' => $extendcoveragelist->extendcoverage_id,
                            'coveragetype' => $extendcoveragelist->extendcoveragedata->description,
                            'coveragename' => $extendcoveragelist->extendcoveragedata->name,
                            'coveragecode' => $extendcoveragelist->extendcoveragedata->code,
                            'amount' => $extendcoveragelist->amount,
                            'slip_id' => $extendcoveragelist->slip_id
                        ]
                    );
                }
                
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }


    public function storeconditionneededlist(Request $request)
    {        
            $slipcncode = $request->slipcncode;
            $cn = ConditionNeeded::where('id',$slipcncode)->first();
            $information = $cn->description;
            $slip_id = $request->id_slip;
            $insured_id = $request->insured_id;
            $slip_type = $request->slip_type;
            
            if($request->countendorsement)
            {
                $count_endorsement = $request->countendorsement;
            }else{
                $count_endorsement = 0;
            }

            
            if($slipcncode !='' && $slip_id != '')
            {
            
                $condition = ConditionNeededTemp::where('slip_id',$slip_id)
                ->where('insured_id',$insured_id)
                ->where('count_endorsement',$count_endorsement)
                ->where('deleted_at',null)
                ->where('status','passive')
                ->where('condition_id',$slipcncode)->first();
        
                if(empty($condition))
                {
                    $conditionneededlist = new ConditionNeededTemp();
                    $conditionneededlist->condition_id  = $slipcncode;
                    $conditionneededlist->information  = $information;
                    $conditionneededlist->slip_id = $slip_id; 
                    $conditionneededlist->insured_id = $insured_id; 
                    $conditionneededlist->slip_type = $slip_type; 
                    $conditionneededlist->count_endorsement = $count_endorsement; 
                    $conditionneededlist->status = "passive"; 
                    $conditionneededlist->minus = "false"; 
                    $conditionneededlist->save();

                    return response()->json(
                        [
                            'success' => true,
                            'id' => $conditionneededlist->id,
                            'conditionneeded_id' => $conditionneededlist->condition_id,
                            'condition' => $conditionneededlist->conditionneeded->name,
                            'information' => $conditionneededlist->information,
                            'slip_id' => $conditionneededlist->slip_id
                        ]
                    );
                }
                else {
                    
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Duplicate Data',
                            'count_endorsement' => $count_endorsement,
                        ]
                    );
                }
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }

    public function storeretrocessionlist(Request $request)
    {

            $percentage = $request->percentage;
            $contract = $request->contract;
            // $type = $request->type;
            $amount = $request->amount;
            $slip_id = $request->id_slip;
            $percentage_or = $request->or_percent;
            $insured_id = $request->insured_id;
            $slip_type = $request->sliptype;
            $status = 'passive';
            $count_endorsement = null;
            if($request->countendorsement){
                $count_endorsement = $request->countendorsement;
            }else{
                $count_endorsement = 0;
            }
            $checkit = RetrocessionTemp::where('contract',$contract)
            ->where('insured_id',$insured_id)
            ->where('slip_id',$slip_id)
            ->where('status','passive')
            ->where('count_endorsement',$count_endorsement)
            ->where('deleted_at',null)
            ->first();
            if ($checkit) {
                return response()->json(
                        [
                            'code_error' => '404',
                            'message' => 'Duplicate'
                        ]
                    );
            }
            if (empty($contract)) {
                    return response()->json(
                        [
                            'code_error' => '404',
                            'message' => 'Contract cannot be null'
                        ]
                    );
                }
            $checkit = RetrocessionTemp::where('insured_id',$insured_id)
            ->where('slip_id',$slip_id)
            ->where('status','passive')
            ->where('deleted_at',null)
            ->sum('percentage');
            $totalpercent = $checkit + $percentage;
            
            if($percentage !='' && $amount !='' && $slip_id != '')
            {
                
                if($totalpercent <= 100){
                    $retrocessionlist = new RetrocessionTemp();
                    // $retrocessionlist->type  = $type;
                    $retrocessionlist->contract  = $contract;
                    $retrocessionlist->percentage  = $percentage;
                    $retrocessionlist->amount = $amount;
                    $retrocessionlist->slip_id = $slip_id; 
                    $retrocessionlist->insured_id = $insured_id; 
                    $retrocessionlist->slip_type = $slip_type; 
                    $retrocessionlist->status = $status; 
                    $retrocessionlist->count_endorsement = $count_endorsement; 
                    $retrocessionlist->minus = 'false'; 
                    $retrocessionlist->save();

                    $checkit2 = DB::table('retrocession_panel_detail')->where('retrocession_panel_detail.slip_id',$retrocessionlist->slip_id)->sum('retrocession_panel_detail.percentage');
                    $totalpercent2 = $percentage_or + $checkit2;
                    $minpercent2 = 100 - $totalpercent2;

                    return response()->json(
                            [
                                'id' => $retrocessionlist->id,
                                'percentage' => $retrocessionlist->percentage,
                                'contract' => $retrocessionlist->contract,
                                // 'type' => $retrocessionlist->type,
                                'amount' => $retrocessionlist->amount,
                                'slip_id' => $retrocessionlist->slip_id
                            ]
                        );
                }
                else{
                    return response()->json(
                        [
                            'code_error' => '404',
                            'message' => 'percent morethan 100'
                        ]
                    );
                }
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }

    public function storepropertytypelist(Request $request)
    {
        
            $property_type_id = $request->property_type_id;
            $slip_id = $request->id_slip;
            $insured_id = $request->insured_id;
            $status = 'passive';
            // $count_endorsement = null;
            // if($request->countendorsement){
            //     $count_endorsement = $request->countendorsement;
            // }else{
            //     $count_endorsement = 0;
            // }
        
            if($property_type_id !='' && $slip_id != '')
            {
            
                $retrocessionlist = new PropertyTypeTemp();
                $retrocessionlist->property_type_id  = $property_type_id;
                $retrocessionlist->slip_id = $slip_id; 
                $retrocessionlist->insured_id = $insured_id; 
                $retrocessionlist->status = $status; 
                $retrocessionlist->save();

                $retrocessionlist = new TransPropertyTemp();
                $retrocessionlist->property_type_id  = $property_type_id;
                $retrocessionlist->insured_id = $insured_id; 
                $retrocessionlist->save();

                return response()->json(
                    [
                        'id' => $retrocessionlist->id,
                        'propertydata' => $retrocessionlist->propertytypedata->name,
                        'property_type_id' => $retrocessionlist->property_type_id,
                        'slip_id' => $retrocessionlist->slip_id
                    ]
                );
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }

    public function storeholedetaillist(Request $request)
    {

            $golffieldhole = $request->golffield_hole;
            $event = $request->event;
            $insured_id = $request->insuredID;
            $mydate = date("Y").date("m").date("d");
            $golffield = GolfFieldHole::where('id',$golffieldhole)->first();
            $count_hole = HoleDetail::where('insured_id',$insured_id)->get();
            $lastid = count($count_hole);

            if($lastid != null){
                if($lastid < 10)
                {
                    $code =  $mydate . "00000" . strval($lastid + 1);
                }   
                elseif($lastid > 9 && $lastid < 100)
                {
                    $code = "IN" . $mydate . "0000" . strval($lastid + 1);
                }

            }
            else{
                $code =  $mydate . "00000" . strval(1);
            }


            if($golffieldhole !='' && $insured_id !='' )
            {
            
                $holedetaillist = new HoleDetail();
                $holedetaillist->code  = $code;
                $holedetaillist->golffieldhole_id  = $golffieldhole;
                $holedetaillist->event  = $event;
                $holedetaillist->insured_id = $insured_id;
                $holedetaillist->save();

                return response()->json(
                    [
                        'id' => $holedetaillist->id,
                        'code' => $holedetaillist->code,
                        'golffield_hole' => $golffield->golf_field,
                        'event' => $holedetaillist->event,
                        'insured_id' => $holedetaillist->insured_id
                    ]
                );
        
            }
            else
            {

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fill all fields'
                    ]
                );

            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRouteList(Request $request)
    {
        $route = DB::table("route")
        ->join('ship_port as sp1', 'route.from', '=', 'sp1.id')
        ->join('ship_port as sp2', 'route.to', '=', 'sp2.id')
        ->where("route.id",$request->route_code)
        ->select('route.*','sp1.name as route_from','sp2.name as route_to')
        ->first();

        // dd($route);
        return response()->json([
            'route_from' => $route->route_from,
            'route_to' => $route->route_to
        ]);
    }

    public function showShipList(Request $request)
    {
        $ship = DB::table("marine_lookup")
        ->where("code",$request->ship_code)
        ->first();
        return response()->json($ship);
    }

    public function showinterestinsuredList(Request $request)
    {
        $interestlist = InterestInsuredTemp::where("id",$request->ins_code)->first();
        return response()->json(
            [
                'id' => $interestlist->id,
                'interest_id' => $interestlist->interest_id,
                'amount' => $interestlist->amount,
                'slip_id' => $interestlist->slip_id,
                'description' => $interestlist->interestinsureddata->description
            ]
        );
    }

    public function showdeductibleList(Request $request)
    {
        $deductibletemp = DB::table("deductible_type_detail")
        ->where("id",$request->deductible_code)
        ->first();
        return response()->json($deductibletemp);
    }

    public function showconditionneededList(Request $request)
    {
        $conditionneeded = DB::table("condition_needed_detail")
        ->where("id",$request->cn_code)
        ->first();
        return response()->json($conditionneeded);
    }

    public function showextendcoverageList(Request $request)
    {
        $extendcoverage = DB::table("extended_coverage_detail")
        ->where("id",$request->ec_code)
        ->first();
        return response()->json($extendcoverage);
    }

    public function showinstallmentList(Request $request)
    {
        $installmenttemp = DB::table("installment_panel_detail")
        ->where("id",$request->intem_code)
        ->first();
        return response()->json($installmenttemp);
    }

    public function showretrocessionList(Request $request)
    {
        $retrocessionlist = DB::table("retrocession_panel_detail")
        ->where("id",$request->rsc_code)
        ->first();
        return response()->json($retrocessionlist);
    }

    public function showholedetailList(Request $request)
    {
        $holedetaillist = DB::table("golf_field_hole_detail")
        ->where("id",$request->hd_code)
        ->first();
        return response()->json($holedetaillist);
    }

    public function showinsureddetails($id)
    {
        $user = Auth::user();
        $route_active = 'Marine - Insured Details';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");
        
        $insured = Insured::where('id',$id)->orderby('id','desc')->get();
        // dd($insured);
        $route = $insured[0]->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::where('id','=',$route)->first();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        $ms_ids = response()->json($insured->modelKeys());
        $lastid = count($insured);
            
        $code_ms = $insured[0]->number;
        
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();
        


        return view('crm.transaction.marine_insured_details', compact(['user','routeship','customer','shiplist','mlu','insured','route_active','ms_ids']));
    }

    public function showslipdetails($id)
    {
        $user = Auth::user();
        $userid = Auth::user()->id;
        $route_active = 'Marine - Slip and Insured Details';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");

        
        // $sl_ids = response()->json($slip->modelKeys());
        
        $insured = Insured::where('id',$id)->orderby('id','desc')->get();
        // dd($insured[0]->number);
        $slip = SlipTable::orderby('id','desc')->get();
        // dd($slip);
        $route = $insured[0]->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $routeship= RouteShip::where('id','=',$route)->first();
        $currency = Currency::orderby('id','asc')->get();
        $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
        $koc = Koc::orderby('id','asc')->get();
        $ocp = Occupation::orderby('id','asc')->get();
        $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
        $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $felookup = FelookupLocation::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        $ms_ids = response()->json($insured->modelKeys());
        $lastid = count($insured);
        $code_ms = $insured[0]->number;
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();
        // dd($slip);
        $sliplastid = count($slip);
        if($sliplastid != null){
            if($sliplastid < 10)
            {
                $code_sl = "M". $mydate . "0000" . strval($sliplastid + 1);
            }   
            elseif($sliplastid > 9 && $sliplastid < 100)
            {
                $code_sl = "M". $mydate . "000" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 99 && $sliplastid < 1000)
            {
                $code_sl = "M". $mydate . "00" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 999 && $sliplastid < 10000)
            {
                $code_sl = "M". $mydate . "0" . strval($sliplastid + 1);
            }
            elseif($sliplastid > 9999 && $sliplastid < 100000)
            {
                $code_sl = "M". $mydate . strval($sliplastid + 1);
            }
        }
        else{
            $code_sl = "M" . $mydate . "0000" . strval(1);
        }

        
        // $currency = Currency::orderby('id','asc')->get();
        // $cob = COB::where('id',$id)->orderby('id','asc')->first();
        // $koc = Koc::where('id',$id)->orderby('id','asc')->first();
        // $ocp = Occupation::where('id',$id)->orderby('id','asc')->first();
        // $cedingbroker = CedingBroker::where('id',$id)->orderby('id','asc')->first();
        // $ceding = CedingBroker::where('id',$id)->orderby('id','asc')->where('type','4')->first();
        // $felookup = FelookupLocation::where('id',$id)->orderby('id','asc')->get();
        // $cnd = ConditionNeeded::where('id',$id)->orderby('id','asc')->get();

        //$cobmodal =  COB::orderby('id','desc')->get();
        $cobmodal = COB::where('form','ms')->orderby('id','desc')->first();
        
        $kocmodal =  Koc::orderby('id','desc')->get();
        $ocpmodal =  Occupation::orderby('id','desc')->get();
        $cedbrokmodal =  CedingBroker::orderby('id','desc')->get()->unique('code');
        $cedingmodal =  CedingBroker::where('type','4')->orderby('id','desc')->get()->unique('code');
        $currencymodal =  Currency::orderby('id','desc')->get();

        // $sliplastid = count($slip);

        $slipdata2 = SlipTable::where('insured_id',$code_ms)->where('slip_type','ms')->where('endorsment','true')->orderby('id','desc')->get();
        $filelist=SlipTableFile::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $interestlist= InterestInsuredTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $deductibletemp= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $installmentpanel= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $retrocessiontemp= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $statuslist= StatusLog::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        // dd($slip->prod_year);
       
        return view('crm.transaction.marine_slip_details', compact(['user','kocmodal','ocpmodal','cedbrokmodal','cedingmodal','currencymodal','cobmodal','slipdata2','filelist','statuslist','retrocessiontemp','installmentpanel','conditionneededtemp','deductibletemp','interestlist','cnd','felookup','currency','cob','koc','ocp','ceding','cedingbroker','deductibletype','interestinsured','slip','route_active','code_sl','code_ms','currdate','routeship','shiplist','mlu','insured','ms_ids']));
    }

    public function showslipmodaldetails($id)
    {
        $user = Auth::user();
        $route_active = 'Marine - Slip and Insured Details';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");

        $slip = SlipTable::where('id',$id)->orderby('id','asc')->first();
        // $sl_ids = response()->json($slip->modelKeys());
        $insured = Insured::where('number',$slip->insured_id)->orderby('id','desc')->first();
        // dd($insured);
        $route = $insured->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::where('id','=',$route)->first();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        // $ms_ids = response()->json($insured->modelKeys());
        // $lastid = count($insured);
        $code_ms = $insured->number;
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();

        $code_sl = $slip->number;
        
        $currency = Currency::orderby('id','asc')->get();
        $cob = COB::where('id',$slip->cob)->orderby('id','asc')->first();
        $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
        $koc = Koc::where('id',$slip->koc)->orderby('id','asc')->first();
        $ocp = Occupation::where('id',$id)->orderby('id','asc')->first();
        $cedingbroker = CedingBroker::where('id',$slip->source)->orderby('id','asc')->first();
        $ceding = CedingBroker::where('id',$slip->source_2)->orderby('id','asc')->where('type','4')->first();
        $felookup = FelookupLocation::where('id',$id)->orderby('id','asc')->get();
        $cnd = ConditionNeeded::where('id',$id)->orderby('id','asc')->get();

        // $sliplastid = count($slip);

        $filelist=SlipTableFile::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $interestlist = DB::table('interest_insured_detail')
            ->join('interest_insured', 'interest_insured.id', '=', 'interest_insured_detail.interest_id')
            ->select('interest_insured_detail.*', 'interest_insured.code', 'interest_insured.description')
            ->where('interest_insured_detail.slip_id',$code_sl)
            ->get();
        // $deductibletemp= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $deductibletemp = DB::table('deductible_temp')
            ->join('deductible_type', 'deductible_type.id', '=', 'deductible_type_detail.deductibletype_id')
            ->join('currencies', 'currencies.id', '=', 'deductible_type_detail.currency_id')
            ->select('deductible_type_detail.*', 'currencies.code','currencies.symbol_name','deductible_type.abbreviation', 'deductible_type.description')
            ->where('deductible_type_detail.slip_id',$code_sl)
            ->get();
        // $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $conditionneededtemp = DB::table('condition_needed_detail')
        ->join('condition_needed', 'condition_needed.id', '=', 'condition_needed_detail.condition_id')
        ->select('condition_needed_detail.*', 'condition_needed.name','condition_needed.code' ,'condition_needed.description')
        ->where('condition_needed_detail.slip_id',$code_sl)
        ->get();
        $installmentpanel= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $retrocessiontemp= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $statuslist= StatusLog::where('slip_id','=',$code_sl)->orderby('created_at','DESC')->get();

        // dd($cob);
        if($slip->all())
        {
            return response()->json([
                "id" => $slip->id,
                "insured_id" => $slip->insured_id,
                "slip_number" => $slip->number,
                "username" => $slip->username,
                "prod_year" => $slip->prod_year,
                "uy" => $slip->uy,
                "status" => $slip->status,
                "endorsment" => $slip->endorsment,
                "selisih" => $slip->selisih,
                "cedbrok_id" => $slip->source,
                "cedbrok" => $slip->cedingbroker->name,
                "cedbrok_code" => $slip->cedingbroker->code,
                "cedbrok_cn" => $slip->cedingbroker->companytype->name,
                "ceding_id" => $slip->source_2,
                "ceding" => $slip->ceding->name,
                "ceding_cn" => $slip->ceding->companytype->name,
                "ceding_code" => $slip->ceding->code,
                "currency_id" => $slip->currency,
                "currency" => $slip->currencies->symbol_name,
                "currency_code" => $slip->currencies->code,
                "cob_id" => $slip->cob,
                "cob" => $slip->corebusiness->description,
                "cob_code" => $slip->corebusiness->code,
                "koc_id" => $slip->koc,
                "koc" => $slip->kindcontract->description,
                "koc_code" => $slip->kindcontract->code,
                "occupacy_id" => $slip->occupacy,
                "occupacy" => $slip->occupation->description,
                "occupacy_code" => $slip->occupation->code,
                "build_const" => $slip->build_const,
                "slip_no" => $slip->slip_no,
                "cn_dn" => $slip->cn_dn,
                "policy_no" => $slip->policy_no,
                "build_const" => $slip->build_const,
                "insured_type" => $slip->insured_type,
                "insured_pct" => $slip->insured_pct,
                "total_sum_insured" => $slip->total_sum_insured,
                "total_sum_pct" => $slip->total_sum_pct,
                "insurance_period_from" => $slip->insurance_period_from,
                "insurance_period_to" => $slip->insurance_period_to,
                "reinsurance_period_from" => $slip->reinsurance_period_from,
                "reinsurance_period_to" => $slip->reinsurance_period_to,
                "proportional" => $slip->proportional,
                "layer_non_proportional" => $slip->layer_non_proportional,
                "rate" => $slip->rate,
                "share" => $slip->share,
                "v_broker" => $slip->v_broker,
                "sum_share" => $slip->sum_share,
                "basic_premium" => $slip->basic_premium,
                "commission" => $slip->commission,
                "sum_commission" => $slip->sum_commission,
                "grossprm_to_nr" => $slip->grossprm_to_nr,
                "netprm_to_nr" => $slip->netprm_to_nr,
                "retro_backup" => $slip->retro_backup,
                "own_retention" => $slip->own_retention,
                "sum_own_retention" => $slip->sum_own_retention,
                "coinsurance_slip" => $slip->coinsurance_slip,
                "interestinsured" => $interestlist,
                // "interestinsured_interest" => $interestlist->interestinsureddata->description,
                // "interestinsured_interestid" => $interestlist->interest_id,
                "attachment" => $filelist,
                "deductible" => $deductibletemp,
                // "deductible_type" => $deductibletemp->DeductibleType->abbreviation,
                // "deductible_desc" => $deductibletemp->DeductibleType->description,
                // "deductible_typeid" => $deductibletemp->deductibletype_id,
                // "deductible_currency" => $deductibletemp->currency->symbol_name,
                // "deductible_currencyid" => $deductibletemp->currency_id,
                // "deductible_percentage" => $deductibletemp->percentage,
                // "deductible_min_claimamount" => $deductibletemp->min_claimamount,
                // "deductible_amount" => $deductibletemp->amount,
                "condition_needed" => $conditionneededtemp,
                // "condition_needed_cnid" => $conditionneededtemp->codition_id,
                // "condition_needed_cn" => $conditionneededtemp->conditionneeded->name,
                // "condition_needed_id" => $conditionneededtemp->information,
                "installment_panel" => $installmentpanel,
                // "installment_panel_percentage" => $installmentpanel->percentage,
                // "installment_panel_amount" => $installmentpanel->amount,
                "retrocession" => $retrocessiontemp,
                // "retrocession_type" => $retrocessiontemp->type,
                // "retrocession_contract" => $retrocessiontemp->contract,
                // "retrocession_percentage" => $retrocessiontemp->percentage,
                // "retrocession_amount" => $retrocessiontemp->amount,
                "status_log" => $statuslist
                // "status_status" => $statuslist->status,
                // "status_datetime" => $statuslist->datetime,
                // "status_user" => $statuslist->user
            ]);
        }
        else{
            return response()->json([
                "message" => "some data missing"
            ]);
        }
        
    }

    public function getdetailmarineSlip($idm)
    {
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $idm)->first();
        $deductibledata = DeductibleTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mc')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();

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



         $conditionneededdata = ConditionNeededTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mc')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('deleted_at', null)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();

        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarraycn = [];

        if (!empty($conditionneededdata)) 
        {
            foreach ($conditionneededdata as $mydata) 
            {
               
                $cndesc = ConditionNeeded::where('id', '=', $mydata->condition_id)->first();
                if(!empty($cndesc))
                {
                    $mydata->cndesc = $cndesc->description;
                    $mydata->cnname = $cndesc->name;
                    $mydata->cncode = $cndesc->code;
                    
                }

                array_push($newarraycn, $mydata);
            }
        }
        $newarraycndata = json_encode($newarraycn);
      

        $installmentpdata = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', $slipdata->insured_id)
            ->where('slip_type', 'mc')
            ->where('minus','false')
            ->where('deleted_at', null)
            ->where('count_endorsement', $slipdata->endorsment)
            ->orderby('id', 'desc')->get();
            $installmentpdata=json_encode($installmentpdata);

        
        $retrocessiondata = RetrocessionTemp::where('slip_id', '=', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', '=', 'mc')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('deleted_at', null)
            ->where('minus', 'false')
            ->where('status', 'active')
            ->orderby('id', 'desc')->get();

        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarrayr = [];

        if (!empty($retrocessiondata)) 
        {
            foreach ($retrocessiondata as $mydata) 
            {
               
                $cndesc = ConditionNeeded::where('id', '=', $mydata->condition_id)->first();
                if(!empty($cndesc))
                {
                    $mydata->cndesc = $cndesc->description;
                    $mydata->cnname = $cndesc->name;
                    $mydata->cncode = $cndesc->code;
                    
                }

                array_push($newarrayr, $mydata);
            }
        }
        $newarrayrdata = json_encode($newarrayr);


        $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));

        // $currdate = date("d/m/Y");

        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','mc')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mc')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();


        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mc')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();


        // $sum_permilec = DB::table('extended_coverage_detail')
        //     ->where('slip_id', $slipdata->number)
        //     ->where('insured_id', '=', $slipdata->insured_id)
        //     ->where('slip_type', 'mc')
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
                    ->where('slip_type', 'mc')
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
                ->where('slip_type', 'mc')
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
                'installment_panel' => $installmentpdata,
                'sum_commission' => $slipdata->sum_commission,
                'retro_backup' => $slipdata->retro_backup,
                'own_retention' => $slipdata->own_retention,
                'sum_own_retention' => $slipdata->sum_own_retention,
                'retrocession_panel' => $newarrayrdata,
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

    public function getdetailEndorsementmarineSlip($idm)
    {
        $user = Auth::user();
        $slipdata = SlipTable::where('id', $idm)->first();
        // dd($slipdata);

        

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



        if (!empty($slipdata->deductible_panel) && strlen($slipdata->deductible_panel) >= 10) 
        {
            //$deductibledata = json_decode($slipdata->deductible_panel);
            $deductibledata = DB::table('deductible_type_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('deleted_at', null)->orderby('id', 'desc')->get();
        
        } 
        else 
        {
            $deductibledata = DB::table('deductible_type_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('deleted_at', null)->orderby('id', 'desc')->get();
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

        if (!empty($slipdata->condition_needed) && strlen($slipdata->condition_needed) >= 10) {
            //$conditionneededdata = json_decode($slipdata->condition_needed);
            $conditionneededdata = DB::table('condition_needed_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('deleted_at', null)->orderby('id', 'desc')->get();
       
        } else {
            //$conditionneededdata = null;
            $conditionneededdata = DB::table('condition_needed_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('deleted_at', null)->orderby('id', 'desc')->get();
        }

        // $extendcoverdata=json_decode($slipdata->extend_coverage);   
        $newarraycn = [];

        if (!empty($conditionneededdata)) 
        {
            foreach ($conditionneededdata as $mydata) 
            {
               
                $cndesc = ConditionNeeded::where('id', '=', $mydata->condition_id)->first();
                if(!empty($cndesc))
                {
                    $mydata->cndesc = $cndesc->description;
                    $mydata->cnname = $cndesc->name;
                    $mydata->cncode = $cndesc->code;
                    
                }

                array_push($newarraycn, $mydata);
            }
        }
        $newarraycndata = json_encode($newarraycn);
      

        if (!empty($slipdata->installment_panel) && strlen($slipdata->installment_panel) >= 10) 
        {
            //$installmentpdata = $slipdata->installment_panel;
            $installmentpdata = DB::table('installment_panel_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $installmentpdata=json_encode($installmentpdata);
        } 
        else 
        {
            //$installmentpdata = null;
            $installmentpdata = DB::table('installment_panel_detail')->where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $installmentpdata=json_encode($installmentpdata);
        }


        // $statuslist= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','mc')->orderby('created_at','DESC')->get();
        $statustable = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mc')->orderby('created_at', 'DESC')->get();
        $statuslist = $statustable->unique('status');
        $statuslist->values()->all();

        $attachmenttable = collect(SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mc')->where('count_endorsement', $slipdata->endorsment)->orderby('id', 'DESC')->get());
        $attachmentlist = $attachmenttable->unique('filename');
        $attachmentlist->values()->all();

        $dateyeardata =  date("d/m/Y", strtotime($slipdata->prod_year));


        // $sum_permilec = DB::table('extended_coverage_detail')
        //     ->where('slip_id', $slipdata->number)
        //     ->where('insured_id', '=', $slipdata->insured_id)
        //     ->where('slip_type', 'mc')
        //     ->where('count_endorsement', $slipdata->endorsment)
        //     ->where('status', 'active')
        //     ->where('deleted_at', null)
        //     ->sum('extended_coverage_detail.percentage');

        $sum_inspanpercent = DB::table('installment_panel_detail')
            ->where('slip_id', $slipdata->number)
            ->where('insured_id', '=', $slipdata->insured_id)
            ->where('slip_type', 'mc')
            ->where('count_endorsement', $slipdata->endorsment)
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->sum('installment_panel_detail.percentage');


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
                'installment_panel' => $installmentpdata,
                'sum_commission' => $slipdata->sum_commission,
                'retro_backup' => $slipdata->retro_backup,
                'own_retention' => $slipdata->own_retention,
                'sum_own_retention' => $slipdata->sum_own_retention,
                'retrocession_panel' => $slipdata->retrocession_panel,
                'endorsment' => $slipdata->endorsment,
                'prev_endorsement' => $slipdata->prev_endorsement,
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

    public function editmarineinsured($id)
    {
        $user = Auth::user();
        $route_active = 'Marine - Update Insured ';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");
        
        $insured = Insured::where('id',$id)->orderby('id','desc')->get();
        // dd($insured);
        $route = $insured[0]->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::orderby('id','asc')->get();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        $ms_ids = response()->json($insured->modelKeys());
        $lastid = count($insured);
        $code_ms = $insured[0]->number;
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();


        return view('crm.transaction.marine_insured_edit', compact(['user','routeship','customer','shiplist','mlu','insured','route_active','ms_ids']));
    }

    public function editmarineslip($id)
    {
        $user = Auth::user();
        $route_active = 'Marine - Slip Details';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");

        $slip = SlipTable::where('id',$id)->orderby('id','asc')->get();
        $sl_ids = response()->json($slip->modelKeys());
        // dd($slip[0]->insured_id);
        $insured = Insured::where('number',$slip[0]->insured_id)->orderby('id','desc')->get();
        
        $route = $insured[0]->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::orderby('id','asc')->get();
        $ms_ids = response()->json($insured->modelKeys());
        $lastid = count($insured);
        $code_ms = $insured[0]->number;
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();

        $code_sl = $slip[0]->number;
        
        $currency = Currency::orderby('id','asc')->get();
        $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
        //$cob = COB::orderby('id','asc')->get();
        //$koc = Koc::orderby('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
       
        $ocp = Occupation::orderby('id','asc')->get();
        $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
        $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $felookup = FelookupLocation::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id','asc')->get();
        $interestinsured = InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();

        $sliplastid = count($slip);

        $filelist=SlipTableFile::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        $interestlist= InterestInsuredTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $deductibletemp= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $installmentpanel= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $retrocessiontemp= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $statuslist= StatusLog::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        return view('crm.transaction.marine_slip_edit', compact(['user','filelist','interestinsured','statuslist','retrocessiontemp','installmentpanel','conditionneededtemp','deductibletemp','deductibletype','interestlist','cnd','felookup','currency','cob','koc','ocp','ceding','cedingbroker','slip','route_active','code_sl','currdate','routeship','shiplist','mlu','insured','ms_ids']));
    }

    public function updatemarineinsured(request $request, $id)
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
        }else{
            return response()->json($validator);
        }
    }
    
    public function updatemarineslip($idm)
    {
        $user = Auth::user();
        //print_r($user);
        //exit();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();
        $route_active = 'Marine Cargo - Slip Entry';
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
        
        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();
        
        //$cob = COB::orderby('id', 'asc')->get();
        $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
        $business_type = BusinessType::orderby('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get()->unique('code');
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get()->unique('code');
        $broker = CedingBroker::orderby('id', 'asc')->where('type', 5)->get()->unique('code');
        $cedinginsured = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
        $prefixinsured =  PrefixInsured::orderby('id', 'asc')->get();
        // $felookup = FelookupLocation::orderby('id','asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();
        $mlu = MarineLookup::orderby('id','asc')->get();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $conditionneeded = ConditionNeeded::orderby('id', 'asc')->get();
        $routeship = RouteShip::orderby('id', 'asc')->get();

        $mc_ids = response()->json($insured->modelKeys());
        $ms_ids = response()->json($insured->modelKeys());

        $insureddata = Insured::find(base64_decode($idm));
        
        $brokerchoice = DB::table('interest_insured_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                        ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                        ->where('shiplist_detail.insured_id', '=', $insureddata->number)
                        ->where('shiplist_detail.slip_type', '=', 'mc')
                        ->where('ceding_broker.type', '=', 5)
                        ->orWhere('ceding_broker.type', '=', 4)
                        ->select('interest_insured_detail.ceding_id','ceding_broker.code','ceding_broker.name')
                        ->orderByRaw("FIELD(ceding_broker.id , interest_insured_detail.ceding_id) ASC")
                        ->distinct()
                        ->get();

        $sumperceding = DB::table('interest_insured_detail')
                        ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                        ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                        ->where('shiplist_detail.insured_id', '=', $insureddata->number)
                        ->where('shiplist_detail.slip_type', '=', 'mc')
                        ->select(DB::raw('sum(interest_insured_detail.amount) as amountlocation'),'ceding_broker.name', DB::raw('sum(interest_insured_detail.percent) as percentage'))
                        ->groupBy('ceding_broker.name')
                        ->orderBy('ceding_broker.name','asc')
                        ->get();

        $code_ms = $insureddata->number;
        $slipdata = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mc')->first();
        // $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('slip_type', 'mc')->orderBy('endorsment','desc')->get();

        $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mc')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->get();
        // $slipdatadistict = DB::table('slip_table')->select('slip_table.*')->where('slip_table.insured_id', $insureddata->number)->where('slip_table.selisih', 'false')->where('slip_table.slipshow', 'yes')->where('slip_table.slip_type', 'fe')->distinct('slip_table.number')->get();
        //$slipdatadistict = SlipTable::select('number')->distinct()->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'mc')->get();
        $maxdata = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mc')->orderby('endorsment', 'desc')->first();

        $dataslipdistict = collect(SlipTable::where('insured_id',$insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'mc')->get());
        $slipdatadistict = $dataslipdistict->unique('number');
        $slipdatadistict->values()->all();

        if (!empty($slipdata)) {
            $code_sl = $slipdata->number;
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','mc')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mc')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
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
                            $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = "MC" .  $mydate . strval($sliplastid + $i);
                        }
                    } else {
                        $code_sl = "MC" .  $mydate . "0000" . strval(1);
                    }
                }

                $i++;
            }
        } 
        else {
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate)->where('slip_type','fe')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', 'mc')->where('slipshow', 'yes')->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);

            if ($sliplastid != null) {
                if ($sliplastid < 9) {
                    $code_sl = "MC" .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sl = "MC" .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sl = "MC" .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sl = "MC" .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sl = "MC" .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sl = "MC" .  $mydate . "0000" . strval(1);
            }


            $slipdata = SlipTable::orderBy('id', 'desc')->first();
        }

        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', 'mc')->where('status', 'passive')->first();


        if ($checkslipnumber != null) {
            $slipnumform = $code_sl;
        } elseif ($checkslipnumber == null) {


            $reservedslipnumber = SlipNumber::create([
                'number' => $code_sl,
                'slip_type' => 'mc',
                'status' => 'passive',
                'insured_number' => $code_ms
            ]);

            $slipnumform = $reservedslipnumber->number;
        }

                foreach($slip_now as $list_slip){
                    InstallmentTemp::where('slip_id', '=', $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    ConditionNeededTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    DeductibleTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    RetrocessionTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    ShiplistTemp::where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    SlipTableFile::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                    
                    $shiplistidcurrent = ShiplistTemp::select('id')->where('insured_id', '=', $list_slip->insured_id)->where('slip_type','mc')->where('status','passive')->orderby('id', 'desc')->get();
                    foreach ($shiplistidcurrent as $dataid) {
                        InterestInsuredTemp::where('ship_id', '=', $dataid->id)->where('insured_id', '=', $dataid->insured_id)->where('slip_type','mc')->where('status','passive')->delete();
                    }

                }

                

                $shiplistid = ShiplistTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type','mc')->where('status','passive')->orderby('id', 'desc')->get();
                foreach ($shiplistid as $dataid) {
                    InterestInsuredTemp::where('ship_id', '=', $dataid->id)->where('insured_id', '=', $dataid->insured_id)->where('slip_type','mc')->where('status','passive')->delete();
                }

       
                // $interestlist2= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->delete();
                $installmentlist2= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','fe')->where('status','=','passive')->orderby('id','desc')->delete();
                $conditionneededlist2= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $deductiblelist2= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $retrocessionlist2=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                // $locationlist = TransLocationTemp::where('insured_id','=',$code_ms)->where('slip_type','=','fe')->where('status','=','passive')->orderby('id','desc')->delete();
                $shiplist2 = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                $interestlist= InterestInsuredTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $installmentlist= InstallmentTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                // $extendcoveragelist= ExtendCoverageTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','fe')->orderby('id','desc')->get();
                $conditionneededlist= ConditionNeededTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $deductiblelist= DeductibleTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $retrocessionlist=RetrocessionTemp::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','mc')->orderby('id','desc')->get();
                $shiplist = ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','=','mc')->where('status','=','passive')->orderby('id','desc')->get();
                $filelist = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', 'mc')->where('status', '=', 'passive')->orderby('id', 'desc')->get();

                
                $shiplist3= ShiplistTemp::where('insured_id','=',$code_ms)->where('slip_type','mc')->orderby('id','desc')->get();

                
                $listship=[];
                if (!empty($shiplist3)) {
                    foreach ($shiplist3 as $datadetail) {
                        $interestinsureddetaildata = InterestInsuredTemp::where('ship_id', '=', $datadetail->id)->where('status','active')->join('ceding_broker','interest_insured_detail.ceding_id','=','ceding_broker.id')->select('interest_insured_detail.*','ceding_broker.name')->orderBy('ceding_broker.name','asc')->get();

                        $intinsdetaillist = [];

                        foreach ($interestinsureddetaildata as $iistt) {

                            $interestdata = InterestInsured::where('id', '=', $iistt->interest_id)->first();
                            $cedingdata = CedingBroker::where('id', '=', $iistt->ceding_id)->first();

                            $iistt->interestdetail = $interestdata;
                            $iistt->cedingdetail = $cedingdata;

                            array_push($intinsdetaillist, $iistt);
                        }


                        $datadetail->interestinsureddetail = $intinsdetaillist;

                        array_push($listship, $datadetail);
                    }
                }

        $statuslist = StatusLog::where('insured_id', '=', $code_sl)->orderby('id', 'desc')->get();


        return view('crm.transaction.marine_slipupdate', compact(['maxdata','slipdatadistict','sign','ms_ids','customer','cedinginsured','mlu','routeship','sumperceding','brokerchoice','broker','prefixinsured', 'slipnumform', 'user', 'userid', 'cnd', 'slipdata2', 'filelist', 'slipdata', 'insureddata', 'statuslist', 'retrocessionlist', 'installmentlist', 'conditionneededlist', 'deductiblelist', 'conditionneeded', 'deductibletype', 'interestinsured', 'listship', 'interestlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'mc_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
    }

    public function updatemarineslipmodal(Request $request)
    {
        $validator = $request->validate([
            'slipnumber' => 'required'
        ]);

        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('number', '=', $request->slipnumber)->first();

            // $interestlist = InterestInsuredTemp::where('insured_id', '=', $request->code_ms)->orderby('id', 'desc')->get();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', '=', 'mc')->where('count_endorsement',$request->countendorsement)->where('minus','false')->where('deleted_at', null)->orderby('id', 'desc')->get();

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
            //         'slip_type'=>'fe',
            //         'count_endorsement'=> $slipdatalatest->endorsment
            //     ]);
            // }

            $slipdataup->number = $request->slipnumber;
            $slipdataup->username = Auth::user()->name;
            $slipdataup->insured_id = $request->code_ms;
            $slipdataup->slip_type = 'mc';
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
            $slipdataup->remarks = $request->remarks;
            $slipdataup->remarkscancel = $request->remarkscancel;
            $slipdataup->slipshow = "yes";

            $slipdataup->save();


            $notification = array(
                'message' => 'Marine Cargo Slip Update successfully!',
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

            $deductibleup = DeductibleTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($deductibleup as $ddup) {
                $deductibleprocessup = DeductibleTemp::findOrFail($ddup->id);
                $deductibleprocessup->status = 'active';
                $deductibleprocessup->save();
            }

            $conditionneededup = ConditionNeededTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($conditionneededup as $cnup) {
                $conditionneededprocessup = ConditionNeededTemp::findOrFail($cnup->id);
                $conditionneededprocessup->status = 'active';
                $conditionneededprocessup->save();
            }

            $installmentpansup = InstallmentTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
            foreach ($installmentpansup as $ipup) {
                $inspanprocessup = InstallmentTemp::findOrFail($ipup->id);
                $inspanprocessup->status = 'active';
                $inspanprocessup->save();
            }

            $retrocessionpanup = RetrocessionTemp::where('slip_id', $request->slipnumber)->where('insured_id', '=', $request->code_ms)->where('slip_type', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
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
                'message' => 'Marine Cargo Slip added Failed!, missing data',
                'alert-type' => 'Failed'
            );

            return response($notification);
        }
    }

    public function updateshiplist(Request $request, $id)
   {
        $validator = $request->validate([
            'ship_code'=>'required',
                'ship_name'=>'required',
                'insuredID'=>'required'
        ]);
        
        if($validator){

            $slt = ShipListTemp::find($id);
            $slt->insured_id = $request->insuredID;
            $slt->ship_code = $request->ship_code;
            $slt->ship_name = $request->ship_name;
            $slt->save();
            // $notification = array(
            //     'message' => 'Ship List updated successfully!',
            //     'alert-type' => 'success'
            // );
            return response()->json($slt);
        }else{
            return response()->json($validator);
        }
   }

   public function updateinterestlist(Request $request, $id)
   {
        $validator = $request->validate([
            'interest_insured'=>'required',
                'interest_amount'=>'required',
                'slip_number'=>'required'
        ]);
        
        if($validator){

            $interestlist = InterestInsuredTemp::find($id);
            $interestlist->interest_id = $request->interest_insured;
            $interestlist->amount = $request->interest_amount;
            $interestlist->slip_id = $request->slip_number;
            $interestlist->save();
            
            $interestdata= InterestInsured::where('id','=',$request->interest_insured)->first();

                return response()->json(
                    [
                        'id' => $interestlist->id,
                        'interest_id' => $interestlist->interest_id,
                        'amount' => $interestlist->amount,
                        'slip_id' => $interestlist->slip_id,
                        'description' => $interestdata->description
                    ]
                );
        }else{
            return response()->json($validator);
        }
   }

   public function updateinstallmentlist(Request $request, $id)
   {
        $validator = $request->validate([
            'installment_date'=>'required',
                'percentage'=>'required',
                'slip_number'=>'required'
        ]);
        
        if($validator){

            $installmentlist = InstallmentTemp::find($id);
            $installmentlist->installment_date = $request->installment_date;
            $installmentlist->percentage = $request->percentage;
            $installmentlist->amount = $request->amount;
            $installmentlist->slip_id = $request->slip_number;
            $installmentlist->save();
              
            return response()->json(
                [
                    'id' => $installmentlist->id,
                    'percentage' => $installmentlist->percentage,
                    'installment_date' => $installmentlist->installment_date,
                    'amount' => $installmentlist->amount,
                    'slip_id' => $installmentlist->slip_id
                ]
            );

        }else{
            return response()->json($validator);
        }
   }

   public function updateextendcoveragelist(Request $request, $id)
   {
        $validator = $request->validate([
            'ship_code'=>'required',
                'ship_name'=>'required',
                'insuredID'=>'required'
        ]);
        
        if($validator){

            $slt = ShipListTemp::find($id);
            $slt->insured_id = $request->insuredID;
            $slt->ship_code = $request->ship_code;
            $slt->ship_name = $request->ship_name;
            $slt->save();
            // $notification = array(
            //     'message' => 'Ship List updated successfully!',
            //     'alert-type' => 'success'
            // );
            return response()->json($slt);
        }else{
            return response()->json($validator);
        }
   }

   public function updateconditionneededlist(Request $request, $id)
   {
        $validator = $request->validate([
            'condition_needed'=>'required',
                'slip_number'=>'required'
        ]);

        $cn = ConditionNeeded::where('id', $request->condition_needed)->first();
        $information = $cn->description;
        
        if($validator){

            $conditionneededlist = ConditionNeededTemp::find($id);
            $conditionneededlist->condition_id = $request->condition_needed;
            $conditionneededlist->information = $information;
            $conditionneededlist->slip_id = $request->slip_number;
            $conditionneededlist->save();
            
            return response()->json(
                [
                    'id' => $conditionneededlist->id,
                    'conditionneeded_id' => $conditionneededlist->condition_id,
                    'condition' => $conditionneededlist->conditionneeded->name,
                    'information' => $conditionneededlist->information,
                    'slip_id' => $conditionneededlist->slip_id
                ]
            );
        }else{
            return response()->json($validator);
        }
   }

   public function updatedeductiblelist(Request $request, $id)
   {
        $validator = $request->validate([
            'type'=>'required',
            'currency'=>'required',
            'slip_number'=>'required'
        ]);
        
        if($validator){

            $deductiblelist = DeductibleTemp::find($id);
            $deductiblelist->deductibletype_id = $request->type;
            $deductiblelist->currency_id = $request->currency;
            $deductiblelist->percentage = $request->percentage;
            $deductiblelist->amount = $request->amount;
            $deductiblelist->min_claimamount = $request->min_amount;
            $deductiblelist->slip_id = $request->slip_number;
            $deductiblelist->save();
            
            return response()->json(
                [
                    'id' => $deductiblelist->id,
                    'deductibletype_id' => $deductiblelist->deductibletype_id,
                    'dtdescript' => $deductiblelist->DeductibleType->description,
                    'dtabbrev' => $deductiblelist->DeductibleType->abbreviation,
                    'percentage' => $deductiblelist->percentage,
                    'currency_id' => $deductiblelist->currency_id,
                    'currencydata' => $deductiblelist->currency->code.'-'.$deductiblelist->currency->symbol_name,
                    'amount' => $deductiblelist->amount,
                    'min_claimamount' => $deductiblelist->min_claimamount,
                    'slip_id' => $deductiblelist->slip_id
                ]
            );

        }else{
            return response()->json($validator);
        }
   }


   public function updateretrocessionlist(Request $request, $id)
   {
        $validator = $request->validate([
            'type'=>'required',
                'contract'=>'required',
                'slip_number'=>'required'
        ]);
        
        if($validator){

            $retrocessionlist = RetrocessionTemp::find($id);
            $retrocessionlist->type = $request->type;
            $retrocessionlist->contract = $request->contract;
            $retrocessionlist->percentage = $request->percentage;
            $retrocessionlist->amount = $request->amount;
            $retrocessionlist->slip_id = $request->slip_number;
            $retrocessionlist->save();
            
            return response()->json(
                [
                    'id' => $retrocessionlist->id,
                    'percentage' => $retrocessionlist->percentage,
                    'contract' => $retrocessionlist->contract,
                    'type' => $retrocessionlist->type,
                    'amount' => $retrocessionlist->amount,
                    'slip_id' => $retrocessionlist->slip_id
                ]
            );

        }else{
            return response()->json($validator);
        }
   }

   public function updateholedetaillist(Request $request, $id)
   {
        $validator = $request->validate([
            'type'=>'required',
                'contract'=>'required',
                'slip_number'=>'required'
        ]);
        
        if($validator){

            $holedetaillist = HoleDetail::find($id);
            $holedetaillist->code = $request->code;
            $holedetaillist->golffieldhole_id = $request->golffieldhole_id;
            $holedetaillist->event = $request->event;
            $holedetaillist->insured_id = $request->insured_id;
            $holedetaillist->save();
            
            return response()->json(
                [
                    'code' => $holedetaillist->code,
                    'golffieldhole_id' => $holedetaillist->golffieldhole_id,
                    'event' => $holedetaillist->event,
                    'insured_id' => $holedetaillist->insured_id,
                ]
            );

        }else{
            return response()->json($validator);
        }
   }

   public function showslipmodalendorsement($id)
    {
        $user = Auth::user();
        $route_active = 'Marine - Slip and Insured Details';
        $mydate = date("Y").date("m").date("d");
        $currdate = date("Y-m-d");

        $slip = SlipTable::where('id',$id)->orderby('id','asc')->first();
        // $sl_ids = response()->json($slip->modelKeys());
        $insured = Insured::where('number',$slip->insured_id)->orderby('id','desc')->first();
        // dd($insured);
        $route = $insured->route;
        $mlu = MarineLookup::orderby('id','asc')->get();
        $customer= CustomerCustomer::orderby('id','asc')->get();
        $routeship= RouteShip::where('id','=',$route)->first();
        $interestinsured= InterestInsured::orderby('id','asc')->get();
        $deductibletype= DeductibleType::orderby('id','asc')->get();
        // $ms_ids = response()->json($insured->modelKeys());
        // $lastid = count($insured);
        $code_ms = $insured->number;
        $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();

        $code_sl = $slip->number;
        
        $currency = Currency::orderby('id','asc')->get();
        //$cob = COB::where('id',$id)->orderby('id','asc')->first();
        $cob = COB::where('id',$id)->where('form','ms')->orderby('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
       
        $ocp = Occupation::where('id',$id)->orderby('id','asc')->first();
        $cedingbroker = CedingBroker::where('id',$id)->orderby('id','asc')->first();
        $ceding = CedingBroker::where('id',$id)->orderby('id','asc')->where('type','4')->first();
        $felookup = FelookupLocation::where('id',$id)->orderby('id','asc')->get();
        $cnd = ConditionNeeded::where('id',$id)->orderby('id','asc')->get();

        // $sliplastid = count($slip);

        $countendorsement = $slip->slip_idendorsementcount;
    //    dd($countendorsement);
        if($countendorsement == null){
            $code_sl_new = $slip->number . '-END' . '000' . '1';
            $ed_count = 1;
            $selisih = "false";
        }
        else{
            if($countendorsement < 9)
            {
                $code_sl_new = substr($slip->number,0,15) . '-END' . '000' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 8 && $countendorsement < 100)
            {
                $code_sl_new = substr($slip->number,0,15) . '-END' . '00' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 99 && $countendorsement < 1000)
            {
                $code_sl_new = substr($slip->number,0,15) . '-END' . '0' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 999 && $countendorsement < 10000)
            {
                $code_sl_new = substr($slip->number,0,15) . '-END' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
        }
      
        $sl_number = substr($slip->number,0,15);

        $filelist=SlipTableFile::where('slip_id','=',$code_sl)->orderby('id','desc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $interestlist = DB::table('interest_insured_detail')
            ->join('interest_insured', 'interest_insured.id', '=', 'interest_insured_detail.interest_id')
            ->select('interest_insured_detail.*', 'interest_insured.code', 'interest_insured.description')
            ->where('interest_insured_detail.slip_id',$code_sl)
            ->get();
        // $deductibletemp= DeductibleTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $deductibletemp = DB::table('deductible_type_detail')
            ->join('deductible_type', 'deductible_type.id', '=', 'deductible_type_detail.deductibletype_id')
            ->join('currencies', 'currencies.id', '=', 'deductible_type_detail.currency_id')
            ->select('deductible_type_detail.*', 'currencies.code','currencies.symbol_name','deductible_type.abbreviation', 'deductible_type.description')
            ->where('deductible_type_detail.slip_id',$code_sl)
            ->get();
        // $conditionneededtemp= ConditionNeededTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $conditionneededtemp = DB::table('condition_needed_detail')
        ->join('condition_needed', 'condition_needed.id', '=', 'condition_needed_detail.condition_id')
        ->select('condition_needed_detail.*', 'condition_needed.name','condition_needed.code' ,'condition_needed.description')
        ->where('condition_needed_detail.slip_id',$code_sl)
        ->get();
        $installmentpanel= InstallmentTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $retrocessiontemp= RetrocessionTemp::where('slip_id',$code_sl)->orderby('id','desc')->get();
        $statuslist= StatusLog::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        return response()->json([
            "id" => $slip->id,
            "insured_id" => $slip->insured_id,
            "slip_new_number" => $code_sl_new,
            "slip_old_number" => $slip->number,
            "count_endorsement" => $ed_count,
            "username" => $slip->username,
            "prod_year" => $slip->prod_year,
            "uy" => $slip->uy,
            "status" => $slip->status,
            "endorsment" => $slip->endorsment,
            "selisih" => $slip->selisih,
            "cedbrok_id" => $slip->source,
            "cedbrok" => $slip->cedingbroker->name,
            "cedbrok_code" => $slip->cedingbroker->code,
            "cedbrok_cn" => $slip->cedingbroker->companytype->name,
            "ceding_id" => $slip->source_2,
            "ceding" => $slip->ceding->name,
            "ceding_cn" => $slip->ceding->companytype->name,
            "ceding_code" => $slip->ceding->code,
            "currency_id" => $slip->currency,
            "currency" => $slip->currencies->symbol_name,
            "currency_code" => $slip->currencies->code,
            "cob_id" => $slip->cob,
            "cob" => $slip->corebusiness->description,
            "cob_code" => $slip->corebusiness->code,
            "koc_id" => $slip->koc,
            "koc" => $slip->kindcontract->description,
            "koc_code" => $slip->kindcontract->code,
            "occupacy_id" => $slip->occupacy,
            "occupacy" => $slip->occupation->description,
            "occupacy_code" => $slip->occupation->code,
            "build_const" => $slip->build_const,
            "slip_no" => $slip->slip_no,
            "cn_dn" => $slip->cn_dn,
            "policy_no" => $slip->policy_no,
            "build_const" => $slip->build_const,
            "insured_type" => $slip->insured_type,
            "insured_pct" => $slip->insured_pct,
            "total_sum_insured" => $slip->total_sum_insured,
            "total_sum_pct" => $slip->total_sum_pct,
            "insurance_period_from" => $slip->insurance_period_from,
            "insurance_period_to" => $slip->insurance_period_to,
            "reinsurance_period_from" => $slip->reinsurance_period_from,
            "reinsurance_period_to" => $slip->reinsurance_period_to,
            "proportional" => $slip->proportional,
            "layer_non_proportional" => $slip->layer_non_proportional,
            "rate" => $slip->rate,
            "share" => $slip->share,
            "sum_share" => $slip->sum_share,
            "basic_premium" => $slip->basic_premium,
            "commission" => $slip->commission,
            "sum_commission" => $slip->sum_commission,
            "grossprm_to_nr" => $slip->grossprm_to_nr,
            "netprm_to_nr" => $slip->netprm_to_nr,
            "retro_backup" => $slip->retro_backup,
            "own_retention" => $slip->own_retention,
            "sum_own_retention" => $slip->sum_own_retention,
            "coinsurance_slip" => $slip->coinsurance_slip,
            "interestinsured" => $interestlist,
            // "interestinsured_interest" => $interestlist->interestinsureddata->description,
            // "interestinsured_interestid" => $interestlist->interest_id,
            "attachment" => $filelist,
            "deductible" => $deductibletemp,
            // "deductible_type" => $deductibletemp->DeductibleType->abbreviation,
            // "deductible_desc" => $deductibletemp->DeductibleType->description,
            // "deductible_typeid" => $deductibletemp->deductibletype_id,
            // "deductible_currency" => $deductibletemp->currency->symbol_name,
            // "deductible_currencyid" => $deductibletemp->currency_id,
            // "deductible_percentage" => $deductibletemp->percentage,
            // "deductible_min_claimamount" => $deductibletemp->min_claimamount,
            // "deductible_amount" => $deductibletemp->amount,
            "condition_needed" => $conditionneededtemp,
            // "condition_needed_cnid" => $conditionneededtemp->codition_id,
            // "condition_needed_cn" => $conditionneededtemp->conditionneeded->name,
            // "condition_needed_id" => $conditionneededtemp->information,
            "installment_panel" => $installmentpanel,
            // "installment_panel_percentage" => $installmentpanel->percentage,
            // "installment_panel_amount" => $installmentpanel->amount,
            "retrocession" => $retrocessiontemp,
            // "retrocession_type" => $retrocessiontemp->type,
            // "retrocession_contract" => $retrocessiontemp->contract,
            // "retrocession_percentage" => $retrocessiontemp->percentage,
            // "retrocession_amount" => $retrocessiontemp->amount,
            "status_log" => $statuslist
            // "status_status" => $statuslist->status,
            // "status_datetime" => $statuslist->datetime,
            // "status_user" => $statuslist->user
        ]);
    }

   public function indexmarineendorsement($id)
   {
       $user = Auth::user();
       $route_active = 'Marine - Endorsement Form';
       $mydate = date("Y").date("m").date("d");
       $currdate = date("Y-m-d");

       $slip = SlipTable::where('id',$id)->orderby('id','desc')->get();
       $sl_ids = response()->json($slip->modelKeys());
    //    dd($slip[0]->slip_idendorsementcount);
       $insured = Insured::where('number',$slip[0]->insured_id)->orderby('id','desc')->get();
       
       $route = $insured[0]->route;
       $mlu = MarineLookup::orderby('id','asc')->get();
       $customer= CustomerCustomer::orderby('id','asc')->get();
       $routeship= RouteShip::orderby('id','asc')->get();
       $ms_ids = response()->json($insured->modelKeys());
       $lastid = count($insured);
       $code_ms = $insured[0]->number;
       $shiplist= ShipListTemp::where('insured_id',$code_ms)->orderby('id','desc')->get();

       $countendorsement = $slip[0]->slip_idendorsementcount;
    //    dd($countendorsement);
        if($countendorsement = null){
            $code_sl = $slip[0]->number . '-END' . '000' . '1';
            $ed_count = 1;
            $selisih = "false";
        }
        else{
            if($countendorsement < 10)
            {
                $code_sl = substr($slip[0]->number,0,15) . '-END' . '000' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 9 && $countendorsement < 100)
            {
                $code_sl = substr($slip[0]->number,0,15) . '-END' . '00' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 99 && $countendorsement < 1000)
            {
                $code_sl = substr($slip[0]->number,0,15) . '-END' . '0' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
            elseif($countendorsement > 999 && $countendorsement < 10000)
            {
                $code_sl = substr($slip[0]->number,0,15) . '-END' . ($countendorsement + 1);
                $ed_count = ($countendorsement + 1);
                $selisih = "true";
            }
        }
      
        $sl_number = substr($slip[0]->number,0,15);


       
       $currency = Currency::orderby('id','asc')->get();
       //$cob = COB::orderby('id','asc')->get();
       $cob = COB::whereRaw('LEFT(code,2) = 03')->orWhereRaw('LEFT(code,2) = 04')->orWhereRaw('LEFT(code,2) = 11')->orderby('id', 'asc')->get();
       //$koc = Koc::orderby('id','asc')->get();
       $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
       
       $ocp = Occupation::orderby('id','asc')->get();
       $cedingbroker = CedingBroker::orderby('id','asc')->get()->unique('code');
       $ceding = CedingBroker::orderby('id','asc')->where('type','4')->get()->unique('code');
       $felookup = FelookupLocation::orderby('id','asc')->get();
       $cnd = ConditionNeeded::orderby('id','asc')->get();
       $interestinsured = InterestInsured::orderby('id','asc')->get();
       $deductibletype= DeductibleType::orderby('id','asc')->get();

       $sliplastid = count($slip);

       $filelist=SlipTableFile::where('slip_id','=',$sl_number)->orderby('id','desc')->get();
       $interestlist= InterestInsuredTemp::where('slip_id',$sl_number)->orderby('id','desc')->get();
       $deductibletemp= DeductibleTemp::where('slip_id',$sl_number)->orderby('id','desc')->get();
       $conditionneededtemp= ConditionNeededTemp::where('slip_id',$sl_number)->orderby('id','desc')->get();
       $installmentpanel= InstallmentTemp::where('slip_id',$sl_number)->orderby('id','desc')->get();
       $retrocessiontemp= RetrocessionTemp::where('slip_id',$sl_number)->orderby('id','desc')->get();
       $statuslist= StatusLog::where('slip_id','=',$sl_number)->orderby('id','desc')->get();

       return view('crm.transaction.marine_endorsement', compact(['user','sl_number','filelist','selisih','ed_count','interestinsured','statuslist','retrocessiontemp','installmentpanel','conditionneededtemp','deductibletemp','deductibletype','interestlist','cnd','felookup','currency','cob','koc','ocp','ceding','cedingbroker','slip','route_active','code_sl','currdate','routeship','shiplist','mlu','insured','ms_ids']));
   }



   public function storeendorsementmarineslip(Request $request)
    {
        $validator = $request->validate([
            'slipid' => 'required'
        ]);


        if ($validator) {
            $user = Auth::user();

            $slipdata = SlipTable::where('id', '=', $request->slipid)->first();
            // $slipdatalist= SlipTable::where('insured_id','=',$slipdata->insured_id)->where('slip_type','fe')->where('selisih','=','false')->get();
            $slipdatalist = SlipTable::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mc')->orderby('id', 'desc')->first();
            $insureddata = Insured::where('number', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('count_endorsement', $slipdata->endorsment)->first();

            // $id_ed = ($slipdata->id + 1);
            $num = "1";
            $id_ed = ((int)$slipdata->endorsment + (int)$num);
            $slipdatalisttest = SlipTable::where('endorsment', $id_ed)->where('number', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
          
            while(!empty($slipdatalisttest))
            {
             $slipdatalisttest = SlipTable::where('endorsment', $id_ed)->where('number', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', 'mh')->orderby('id', 'desc')->first();
             $id_ed=$id_ed+1;
           }

            $slipdatalast = SlipTable::where('endorsment', $id_ed)->where('id', '=', $request->slipid)->first();
            // dd($slipdatalast);
            // $interestlist= InterestInsuredTemp::where('slip_id','=',$slipdata->number)->orderby('id','desc')->get();
            $installmentlist = InstallmentTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $conditionneededlist = ConditionNeededTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $deductiblelist = DeductibleTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('minus','false')->where('count_endorsement',$request->countendorsement)->where('deleted_at', null)->where('status', 'passive')->orderby('id', 'desc')->get();
            $locationlist = TransLocationTemp::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->where('status', 'passive')->orderby('id', 'desc')->get();
            $attachmentlist = SlipTableFile::where('slip_id', '=', $slipdata->number)->where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->orderby('id', 'desc')->get();


            if ($slipdata == null) {
                $notification = array(
                    'message' => 'Marine Cargo Slip Endorsement Fail!',
                    'alert-type' => 'danger'
                );
            } else {

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
                    $dtlistupminus = ' ';
                    $jsondtlistupminus = ' ';
                    $cntlistupminus = ' ';
                    $jsoncntlistupminus = ' ';
                    $iptlistupminus = ' ';
                    $jsoniptlistupminus = ' ';
                    $rctlistupminus = ' ';
                    $jsonrctlistupminus = ' ';
                    $slipdataupminus = '';

                    // if (!empty($locationlist)) {
                    //     foreach ($locationlist as $ll) {
                    //         $locationlistup = TransLocationTemp::create([
                    //             'insured_id' => $ll->insured_id,
                    //             'lookup_location_id' => $ll->lookup_location_id,
                    //             'country_id' => $ll->country_id,
                    //             'state_id' => $ll->state_id,
                    //             'city_id' => $ll->city_id,
                    //             'address_location_id' => $ll->address_location_id,
                    //             'slip_type' => 'fe',
                    //             'count_endorsement' => ($ll->count_endorsement + 1),
                    //             'status' => 'active'
                    //         ]);

                    //         $lookuplocationlist = DB::table('trans_location_detail')
                    //             ->join('fe_lookup_location', 'fe_lookup_location.id', '=', 'trans_location_detail.lookup_location_id')
                    //             ->select('trans_location_detail.*', 'fe_lookup_location.address', 'fe_lookup_location.loc_code', 'fe_lookup_location.latitude', 'fe_lookup_location.longtitude', 'fe_lookup_location.postal_code')
                    //             ->where('trans_location_detail.id', $locationlistup->id)
                    //             ->get();

                    //         $lldata =  TransLocationTemp::findOrFail($locationlistup->id);
                    //         $lldata->status = "passive";
                    //         $lldata->save();


                    //         $risklocationlist = RiskLocationDetail::where('translocation_id', '=', $ll->id)->orderby('id', 'desc')->get();
                    //         if ($risklocationlist != null) {
                    //             foreach ($risklocationlist as $rl) {
                    //                 $risklocationlistup = RiskLocationDetail::create([
                    //                     'ceding_id' => $rl->ceding_id,
                    //                     'translocation_id' => $locationlistup->id,
                    //                     'interest_id' => $rl->interest_id,
                    //                     'cndn' => $rl->cndn,
                    //                     'certno' => $rl->certno,
                    //                     'slipno' => $rl->slipno,
                    //                     'percentage' => $rl->percentage,
                    //                     'amountlocation' => $rl->amountlocation,
                    //                     'count_endorsement' => ($rl->count_endorsement + 1),
                    //                     'status' => 'active'

                    //                 ]);

                    //                 $rldata =  RiskLocationDetail::findOrFail($rl->id);
                    //                 // $rldata->amountlocation = ($rl->amountlocation * (-1));
                    //                 $rldata->status = "passive";
                    //                 $rldata->save();

                    //                 $risklocationlistdetail = DB::table('risk_location_detail')
                    //                     ->join('interest_insured', 'interest_insured.id', '=', 'risk_location_detail.interest_id')
                    //                     ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                    //                     ->select('risk_location_detail.*', 'interest_insured.description', 'ceding_broker.name')
                    //                     ->where('risk_location_detail.id', $risklocationlistup->id)
                    //                     ->get();
                    //             }
                    //         }
                    //     }
                    // }

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
                                'slip_type' => 'mc',
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
                                'slip_type' => 'mc',
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
                                'slip_type' => 'mc',
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
                                'slip_type' => 'mc',
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
                        $i=0;
                        foreach ($installmentlist as $ipt) 
                        {
                            if($i==0)
                            {
                                $iptlistup = InstallmentTemp::create([
                                    'installment_date' => $ipt->installment_date,
                                    'percentage' => $ipt->percentage,
                                    'amount' => $ipt->amount,
                                    'slip_id' => $ipt->slip_id,
                                    'count_endorsement' => ($ipt->count_endorsement + 1),
                                    'insured_id' => $ipt->insured_id,
                                    'slip_type' => "mc",
                                    'status' => 'active',
                                    'minus' => 'false'
                                ]);

                                $jsoniptlistup = InstallmentTemp::where('slip_id', '=', $iptlistup->slip_id)->where('count_endorsement', $iptlistup->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();

                                $iptlistupminus = InstallmentTemp::create([
                                    'installment_date' => $ipt->installment_date,
                                    'percentage' => $ipt->percentage,
                                    'amount' => $ipt->amount,
                                    'slip_id' => $ipt->slip_id,
                                    'count_endorsement' => ($ipt->count_endorsement + 1),
                                    'insured_id' => $ipt->insured_id,
                                    'slip_type' => "mc",
                                    'status' => 'active',
                                    'minus' => 'false'
                                ]);

                                $jsoniptlistupminus = InstallmentTemp::where('slip_id', '=', $iptlistupminus->slip_id)->where('count_endorsement', $iptlistupminus->count_endorsement)->where('deleted_at', null)->orderby('id', 'desc')->get();


                                $iptdata =  InstallmentTemp::findOrFail($iptlistupminus->id);
                                $iptdata->amount = ($iptlistupminus->amount * (-1));
                                $iptdata->minus = "true";
                                $iptdata->save();
                                $i++;
                            }
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
                                'count_endorsement' => $rct->count_endorsement,
                                'insured_id' => $rct->insured_id,
                                'slip_type' => 'mc',
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
                                'count_endorsement' => $rct->count_endorsement,
                                'insured_id' => $rct->insured_id,
                                'slip_type' => 'mc',
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




                    if ($slipdatalist != null) 
                    {
                        if ($jsondtlistup == ' ') 
                        {
                        
                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
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
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'true',
                                'date_transfer' => null,
                                'status' => 'endorsement',
                                'endorsment' => $id_ed,
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'no'

                            ]);
                        } elseif ($jsoniptlistup == ' ') {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
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
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'true',
                                'date_transfer' => null,
                                'status' => 'endorsement',
                                'endorsment' => $id_ed,
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'no'

                            ]);
                        }
                        elseif ($jsonrctlistup == ' ') 
                        {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
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
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'true',
                                'date_transfer' => null,
                                'status' => 'endorsement',
                                'endorsment' => $id_ed,
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'no'

                            ]);
                        } else {

                            $slipdataup = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
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
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'yes'

                            ]);

                            $slipdataupminus = SlipTable::create([
                                'number' => $slipdatalist->number,
                                'username' => $slipdatalist->username,
                                'insured_id' => $slipdatalist->insured_id,
                                'slip_type' => 'mc',
                                'prod_year' => $slipdatalist->prod_year,
                                'selisih' => 'true',
                                'date_transfer' => null,
                                'status' => 'endorsement',
                                'endorsment' => $id_ed,
                                'selisih' => 'true',
                                'source' => $request->slipcedingbroker,
                                'source_2' => $request->slipceding,
                                // 'currency'=>$request->slipcurrency,
                                'cob' => $request->slipcob,
                                'koc' => $request->slipkoc,
                                'slip_no' => $request->slipno,
                                'cn_dn' => $request->slipcndn,
                                'policy_no' => $request->slippolicy_no,
                                //'attacment_file'=>json_encode($attachmentlist),
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
                                'deductible_panel' => json_encode($jsondtlistup),
                                'condition_needed' => json_encode($jsoncntlistup),
                                'insurance_period_from' => date("Y-m-d", strtotime(str_replace('/','-',$request->slipipfrom))),
                                'insurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->slipipto))),
                                'reinsurance_period_from' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpfrom))),
                                    'reinsurance_period_to' => date("Y-m-d", strtotime(str_replace("/","-",$request->sliprpto))),
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
                                'installment_panel' => json_encode($jsoniptlistup),
                                'retrocession_panel' => json_encode($jsonrctlistup),
                                'retro_backup' => $request->sliprb,
                                'own_retention' => $request->slipor,
                                'sum_own_retention' => $request->slipsumor,
                                'wpc' => $request->wpc,
                                'remarks' => $request->remarks,
                                'slipshow' => 'no'

                            ]);
                        }
                    }

                    // $insureddataup = Insured::findOrFail($insureddata->id);
                    // $insureddataup->count_endorsement = ($insureddata->count_endorsement + 1);
                    // $insureddataup->save();

                    $notification = array(
                        'message' => 'Marine Cargo Slip added Endorsement successfully!',
                        

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

                    $attachmentcheck = SlipTableFile::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mc')->get();

                    if ($attachmentcheck) {
                        foreach ($attachmentcheck as $atc) {
                            $attachmentupdate = SlipTableFile::findOrFail($atc->id);
                            $attachmentupdate->slip_id = $slipdataup->number;
                            $attachmentupdate->count_endorsement = ($atc->count_endorsement + 1);
                            $attachmentupdate->save();
                        }
                    }

                    $statuslogcheck = StatusLog::where('slip_id', $slipdata->number)->where('insured_id', $slipdata->insured_id)->where('count_endorsement', $slipdata->endorsment)->where('slip_type', 'mc')->get();

                    if ($statuslogcheck) {
                        foreach ($statuslogcheck as $slc) {
                            $statuslogupdate = StatusLog::findOrFail($slc->id);
                            $statuslogupdate->slip_id = $slipdataup->number;
                            $statuslogupdate->count_endorsement = ($slc->count_endorsement + 1);
                            $statuslogupdate->save();
                        }

                        StatusLog::create([
                            'insured_id' => $slipdataup->insured_id,
                            'status' => $slipdataup->status,
                            'datetime' => date('Y-m-d H:i:s '),
                            'slip_id' => $slipdataup->number,
                            'user' => $slipdataup->username,
                            'count_endorsement' => $slipdataup->endorsment,
                            'slip_type' => 'mc'
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

                    $slipdatalist2 = SlipTable::where('insured_id', '=', $slipdata->insured_id)->where('slip_type', '=', 'mc')->get();

                    //$locationlist2= TransLocationTemp::where('insured_id','=',$code_ms)->orderby('id','desc')->get();


                    $slipdatalist = array();
                    foreach ($slipdatalist2 as $datadetail) 
                    {
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

                        $datadetail->status="endorsment";
                        $datadetail->slipstatus="endorsment";
                        
                        $datadetail->count_endorsement= $id_ed;

                        $slipdatalist[] = $datadetail;
                    }

                    

                    return response()->json(
                        [
                            'slip_data' => $slipdataup->toJson(),
                            'slip_dataarray' => json_encode($slipdatalist),
                            'oldid' => $request->slipid,
                            // 'insured_data' => $insureddataup->toJson(),
                            // 'location_data' => $lookuplocationlist->toJson(),
                            // 'risklocation_data' => $risklocationlistdetail->toJson(),
                        ]
                    );
                } else {
                    $notification = array(
                        'message' => 'Marine Cargo Slip added Endorsement Failed! data already endorsed!',
                        'alert-type' => 'error'
                    );

                    return response()->json(
                        $notification
                    );
                }
            }
        } else {

            $notification = array(
                'message' => 'Marine Cargo Slip added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }



   public function destroymarineinsured($id)
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

    public function destroymarineslip($id)
    {
        $insured = SlipTable::find($id);
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


    public function changeCancelMarine(Request $request)
    {
        $slipdata = SlipTable::where('insured_id',  $request->code_ms)->where('number',  $request->slipnumber)->first(); 
        $slipdata->status = "cancel";
        $slipdata->remarkscancel = $request->remarkscancel;
        $slipdata->save();


        $notification = array(
            'message' => 'Marine Cargo Slip Status Cancel successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyshiplist($id)
    {
        $shiplist = ShipListTemp::find($id);


        $shiplist->delete();

        $sumperceding = ShipListTemp::join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                ->where('shiplist_detail.insured_id', '=', $shiplist->insured_id)
                ->where('shiplist_detail.slip_type', '=', $shiplist->slip_type)
                ->select(DB::raw('sum(shiplist_detail.amount) as amount'), 'ceding_broker.name', DB::raw('sum(shiplist_detail.percent) as percentage'))
                ->groupBy('ceding_broker.name')
                ->get();
        

        return response()->json([
            'success'=>'Data has been deleted',
            'sumceding' => $sumperceding
        ]);
    }

    public function destroyinterestlist($id)
    {
        
        $interestlist = InterestInsuredTemp::find($id);
        
        $shiplist = ShiplistTemp::find($interestlist->ship_id);

        $amountinterest = $interestlist->amount;
        
        $interestlist->delete();

        $sumperceding = DB::table('interest_insured_detail')
                                    ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                                    ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                                    ->where('shiplist_detail.insured_id', '=', $shiplist->insured_id)
                                    ->select(DB::raw('sum(interest_insured_detail.amount) as amount'),'ceding_broker.name',DB::raw('sum(interest_insured_detail.percent) as percentage'))
                                    ->groupBy('ceding_broker.name')
                                    ->get();
        
        return response()->json(['success'=>'Data has been deleted','amount'=>$amountinterest,'suminterest'=> $sumperceding]);
    
    }

    public function destroyinstallmentlist($id)
    {
        $installmentlist = InstallmentTemp::find($id);
        
        $installmentpercentage = $installmentlist->percentage;
        $installmentamount = $installmentlist->amount;
        
        $installmentlist->delete();
        
        return response()->json(['success'=>'Data has been deleted','amount'=>$installmentamount,'percentage'=>$installmentpercentage]);
    }


    public function destroyextendcoveragelist($id)
    {
        $extendcoveragelist = ExtendCoverageTemp::find($id);
        
        $extendcoveragepercentage = $extendcoveragelist->percentage;

        $extendcoveragelist->delete();
        
        return response()->json(['success'=>'Data has been deleted','percentage'=>$extendcoveragepercentage]);
    }

    public function destroyconditionneededlist($id)
    {
        $extendcoveragelist = ConditionNeededTemp::find($id);
        
        $extendcoveragelist->delete();
        
        return response()->json(['success'=>'Data has been deleted']);
    }


    public function destroydeductiblelist($id)
    {
        $deductiblelist = DeductibleTemp::find($id);
        
        $deductiblelist->delete();
        
        return response()->json(['success'=>'Data has been deleted']);
    }

    public function destroyretrocessionlist($id)
    {
        $retrocessionTemplist = RetrocessionTemp::find($id);
        $percentage = $retrocessionTemplist->percentage;
        $retrocessionTemplist->delete();
        
        return response()->json(['success'=>'Data has been deleted','percentage' => $percentage]);
    }
    

    public function destroypropertytypelist($id)
    {
        $propertytypeTemplist = PropertyTypeTemp::find($id);
        
        $propertytypeTemplist->delete();
        
        return response()->json(['success'=>'Data has been deleted']);
    }

    public function destroyholedetaillist($id)
    {
        $holedetaillist = HoleDetail::find($id);
        
        $holedetaillist->delete();
        
        return response()->json(['success'=>'Data has been deleted']);
    }
    

}
