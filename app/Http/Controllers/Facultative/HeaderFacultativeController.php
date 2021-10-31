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
use App\Models\InsuredTableFile;
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
use App\Models\PropertyTypeTemp;
use App\Models\PropertyType;
use App\Models\HoleDetail;
use App\Models\GolfFieldHole;
use App\Models\BusinessType;

class HeaderFacultativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type)
    {

        $user = Auth::user();
        $country = User::orderby('id', 'asc')->get();
        if ($type == 'fe') {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'Fire Engineering - Index';
            $title = "Fire Engineering - Index";
        } elseif ($type == 'fl') {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'Financial Lines - Index';
            $title = "Financial Lines - Index";
        } elseif ($type == 'hem') {
            $form_name = 'HE & MOTOR';
            $route_active = 'HE & Motor - Index';
            $title = "HE & Motor - Index";
        } elseif ($type == 'mp') {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'Moveable Property - Index';
            $title = "Moveable Property - Index";
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'Hole in One - Index';
            $title = "Hole in One - Index";
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'Personal Accident - Index';
            $title = "'Personal Accident - Index";
        } else {
            abort(404);
        }
        $mydate = date("Y") . date("m") . date("d");
        $fe_ids = response()->json($country->modelKeys());
        $searchdata = @$request->input('searchdata');
        $searchinsured = @$request->input('searchinsured');
        $searchuy = @$request->input('searchuy');
        $searchshare = @$request->input('searchshare');
        $searchnre = @$request->input('searchnre');
        $searchtsi = @$request->input('searchtsi');
        $searchendorse = @$request->input('searchendorse');
        $searchslipnum = @$request->input('searchslipnum');
        $searchcob = @$request->input('searchcob');
        $searchceding = @$request->input('searchceding');

        $checkdatainsured = Insured::where('statmodified', '=', 1)->whereNull('share_to')->Where('share_to', '=', 0)->get();
        if (!empty($searchdata) || !empty($searchinsured) || !empty($searchuy)) {

            
            $query = Insured::query();
            
            if (!empty($searchdata)) {
                 $query->where('number', $searchdata);
            }

            if (!empty($searchinsured)) {
                 $query->where('insured_name', $searchinsured);
            }

            if (!empty($searchuy)) {
                 $query->where('uy', $searchuy);
            }
            $query->where('slip_type', $type);
            // Ordering
            //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);

            $insured = $query->orderby('id','desc')->paginate(10);
            $insured_ids = response()->json($insured->modelKeys());
            $slip = SlipTable::where('slip_type', '=', $type)->orderby('id', 'desc')->get();
            $slip_ids = response()->json($insured->modelKeys());

            $insuredlist = [];
            foreach (@$insured as $insureddata) {
                $slipdata = SlipTable::where('insured_id', '=', $insureddata->number)->where('slip_type',$type)->where('slipshow', '=', 'yes')->get()->toArray();

                $sliplist = [];
                foreach ($slipdata as $value) {
                    $value['cobdata'] = COB::where('id', '=', $value['cob'])->first();
                    $value['brokerdata'] = CedingBroker::where('id', '=', $value['source'])->first();
                    $value['cedingdata'] = CedingBroker::where('id', '=', $value['source_2'])->first();

                    array_push($sliplist, $value);
                }

                $insureddata->slipdata = $sliplist;

                // $insureddata->insured_name = strtoupper($insureddata->prefix_id) . ' - ' . strtoupper($insureddata->insured_name) . ' - ' . strtoupper($insureddata->insured_suffix);

                // $insureddata->share = number_format($insureddata->share, 0);
                // $insureddata->share_from = number_format($insureddata->share_from, 0);
                // $insureddata->share_to = number_format($insureddata->share_to, 0);

                array_push($insuredlist, $insureddata);
            }

            
        } else {
            //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);

            //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            $insured = Insured::where('slip_type', '=', $type)->orderby('id', 'desc')->paginate(10);
            // $insured = Insured::where('slip_type', '=', $type)->orderby('id', 'desc')->get();
            $insured_ids = response()->json($insured->modelKeys());
            $slip = SlipTable::where('slip_type', '=', $type)->orderby('id', 'desc')->get();
            $slip_ids = response()->json($insured->modelKeys());

            $insuredlist = [];
            foreach (@$insured as $insureddata) {
                $slipdata = SlipTable::where('insured_id', '=', $insureddata->number)->where('slip_type',$type)->where('slipshow', '=', 'yes')->get()->toArray();

                $sliplist = [];
                foreach ($slipdata as $value) {
                    $value['cobdata'] = COB::where('id', '=', $value['cob'])->first();
                    $value['brokerdata'] = CedingBroker::where('id', '=', $value['source'])->first();
                    $value['cedingdata'] = CedingBroker::where('id', '=', $value['source_2'])->first();

                    array_push($sliplist, $value);
                }

                $insureddata->slipdata = $sliplist;

                // $insureddata->insured_name = strtoupper($insureddata->prefix_id) . ' - ' . strtoupper($insureddata->insured_name) . ' - ' . strtoupper($insureddata->insured_suffix);

                // $insureddata->share = number_format($insureddata->share, 0);
                // $insureddata->share_from = number_format($insureddata->share_from, 0);
                // $insureddata->share_to = number_format($insureddata->share_to, 0);

                array_push($insuredlist, $insureddata);
            }

            //print_r($insuredlist);
            //exit();
            //$insured=$insuredlist;

            
        }
        $cob = COB::orderby('id', 'asc')->get();
            $business_type = BusinessType::orderBy('id','asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
        if (request()->ajax()) {
            return datatables()->of($insuredlist)
                ->addColumn('actions', function ($data) {
                    if (true) {
                        if ($data->id <= auth()->user()->role_id) {
                            //return "";
                        }

                        $html = '<a href="' . url('transaction-data/updatefeslip', $data->id) . '" target="_blank">
                                        <button class="btn btn-info btn-round btn-sm mb-1" data-ceding="' . $data->id . '" type="button" ><i class="ti-trash"></i>' . __('Update') . '</button>
                                        </a>';

                        $html .= '
                                        <form id="delete-felookuplocation-' . $data->id . '"
                                            action="' . url('transaction-data/fe-slip/destroy', $data->id) . '"
                                            method="POST">
                                            ' . csrf_field() . '
                                            <button class="btn btn-danger btn-round btn-sm mb-1 destroy" data-ceding="' . $data->id . '" type="submit" ><i class="ti-trash"></i>' . __('Delete') . '</button>
                                            
                                        </form>
                                        ';
                    } else {
                        $html = '<a href="' . url('transaction-data/updatefeslip', $data->id) . '" target="_blank">
                                        <button class="btn btn-info btn-round btn-sm mb-1" data-ceding="' . $data->id . '" type="button" ><i class="ti-trash"></i>' . __('Update') . '</button>
                                        </a>';

                        $html .= '
                                        <form id="delete-felookuplocation-' . $data->id . '"
                                            action="' . url('transaction-data/fe-slip/destroy', $data->id) . '"
                                            method="POST">
                                            ' . csrf_field() . '

                                            <button class="btn btn-danger btn-round btn-sm mb-1 destroy" data-ceding="' . $data->id . '" type="submit" ><i class="ti-trash"></i>' . __('Delete') . '</button>
                                            
                                        </form>
                                        ';
                    }


                    return $html;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }

        
        return view('crm.transaction.facultative.index_facultative', compact('title', 'user', 'searchslipnum', 'searchcob', 'searchceding', 'searchdata', 'searchinsured', 'searchuy', 'searchshare', 'searchnre', 'searchtsi', 'searchendorse', 'cob', 'cedingbroker', 'ceding', 'insuredlist', 'user', 'slip', 'slip_ids', 'insured', 'insured_ids', 'route_active', 'country'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function getCountries()
    {
        $countries = DB::table('countries')->get();
        return response()->json([
            'message' => 'success',
            'countries' => $countries
        ]);
    }

    public function getStates(Request $request, $id)
    {
        if ($request->ajax())
            return DB::table('states')->where(['country_id' => $id])->get();
        else {
            return 0;
        }
    }

    public function getCities(Request $request, $id)
    {
        if ($request->ajax())
            return DB::table('cities')->where(['state_id' => $id])->get();
        else {
            return 0;
        }
    }

    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id", $request->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->where("state_id", $request->state_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

    public function getStateLookup(Request $request)
    {
        $statestable = collect(DB::table("fe_lookup_location")
            ->join('states', 'fe_lookup_location.province_id', '=', 'states.id')
            ->where("fe_lookup_location.country_id", "=", $request->country_id)
            ->pluck("states.name", "fe_lookup_location.province_id"));

        //$statestable2 = $statestable->unique('fe_lookup_location.province_id');
        $statestable->values()->all();

        return response()->json($statestable);
    }


    public function getCurrencyLookup(Request $request)
    {
    
        $currencytable =  CurrencyExchange::where('id','=',$request->currencyexc_id)->join('currencies','currencies_exc.currency',"=","currencies.id")->select('currencies_exc.id','currencies_exc.kurs','currencies.symbol_name','currencies.code')->first();
       
        return response()->json($currencytable);
    }

    public function getCityLookup(Request $request)
    {
        // $cities = DB::table("fe_lookup_location")
        // ->join('cities', 'fe_lookup_location.city_id', '=', 'cities.id')
        // ->where("fe_lookup_location.province_id",$request->state_id)
        // ->pluck("cities.name","fe_lookup_location.city_id");
        $citiestable = collect(DB::table("fe_lookup_location")
            ->join('cities', 'fe_lookup_location.city_id', '=', 'cities.id')
            ->where("fe_lookup_location.province_id", $request->state_id)
            ->pluck("cities.name", "fe_lookup_location.city_id"));

        //$cities = $citiestable->unique('fe_lookup_location.province_id');
        $citiestable->values()->all();
        return response()->json($citiestable);
    }


    public function getAddressLookup(Request $request)
    {
        $address = DB::table("fe_lookup_location")
            ->where("city_id", $request->city_id)
            ->pluck("address", "id");
        return response()->json($address);
    }

    public function getPostalLookup(Request $request)
    {
        $postal_code = DB::table("fe_lookup_location")
            ->where("id", $request->address_id)
            ->first();
        return response()->json($postal_code);
    }


    public function getCostumers(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $costumers = Customer::orderby('company_name', 'asc')->select('id', 'company_name')->limit(10)->get();
        } else {
            $costumers = Customer::orderby('company_name', 'asc')->select('id', 'company_name')->where('company_name', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($costumers as $costumer) {
            $response[] = array("value" => $costumer->id, "label" => $costumer->company_name);
        }

        return response()->json($response);
    }


    
    public function getBuildingRate(Request $request)
    {

        $building_rate = $request->building;
        $ocp_id = $request->occupacy_id;

        // $rate_building = null;

        if ($building_rate == "Building 1") {
            $rate_building = Occupation::select('id', 'rate_batas_atas_building_class_1', 'rate_batas_bawah_building_class_1')->where('id', $ocp_id)->first();

            return response()->json($rate_building);
        } elseif ($building_rate == "Building 2") {
            $rate_building = Occupation::select('id', 'rate_batas_atas_building_class_2', 'rate_batas_bawah_building_class_2')->where('id', $ocp_id)->first();

            return response()->json($rate_building);
        } elseif ($building_rate == "Building 3") {
            $rate_building = Occupation::select('id', 'rate_batas_atas_building_class_3', 'rate_batas_bawah_building_class_3')->where('id', $ocp_id)->first();

            return response()->json($rate_building);
        } else {

            $notification = array(
                'message' => 'please choose building const!',
                'alert-type' => 'failed'
            );

            return response($notification);
        }
    }


    public function getCurrencyKurs(Request $request)
    {

        $search = $request->search;

        //CurrencyExchange

        if ($search == '') {
            $currency = Currency::where('code', '=', $search)->first();
        } else {
            $currency = Currency::where('code', '=', 'IDR')->where('country', '=', '102')->first();
        }

        $response = array();
        foreach ($currency as $cy) {
            $response[] = array("value" => $cy->id, "label" => $cy->code);
        }

        return response()->json($response);
    }

    public function getKursDetail(Request $request)
    {


        $currency = CurrencyExchange::where('id', '=', $request->currency_id)->first();

        return response()->json($currency);
    }



    public function getCedingDetail(Request $request)
    {

        $ceding_id = $request->ceding_id;
        $insured_id = $request->insured_id;
        $slip_type = $request->slip_type;
        $ceding = CedingBroker::where('id', $ceding_id)->first();
        // $ocp_id = $request->occupacy_id;]
        $insureddata = Insured::where('number', $insured_id)->first();
        // dd($insureddata);
        if ($ceding->type == 4) 
        {
            $ceding_list = CedingBroker::select('id', 'code', 'name', 'type')->where('id', $ceding_id)->first();

            $amount_list = null;

            $sum_amount = null;

            if ($slip_type == "mc") 
            {
                $interestinsured_detail = InterestInsuredTemp::where('ceding_id', $ceding->id)->get();
                $amount_list = count($interestinsured_detail);

                $sum_amount = DB::table('interest_insured_detail')
                    ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                    ->where('interest_insured_detail.insured_id', $insured_id)
                    ->where('interest_insured_detail.slip_type', '=', 'mc')
                    ->where('interest_insured_detail.ceding_id', $ceding->id)
                    ->sum('interest_insured_detail.amount');

            }
            else if($slip_type == "mh") 
            {
                $interestinsured_detail = ShiplistTemp::where('ceding_id', $ceding->id)->get();
                $amount_list = count($interestinsured_detail);

                $sum_amount = DB::table('shiplist_detail')
                    ->where('shiplist_detail.insured_id', $insured_id)->where('shiplist_detail.ceding_id', $ceding->id)
                    ->where('shiplist_detail.slip_type', '=', 'mh')
                    ->sum('shiplist_detail.amount');
                
            }
             else 
            {
                $risklocation_detail = RiskLocationDetail::where('ceding_id', $ceding->id)->get();
                $amount_list = count($risklocation_detail);

                $sum_amount = DB::table('risk_location_detail')
                    ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                    ->where('trans_location_detail.insured_id', $insured_id)
                    ->where('trans_location_detail.slip_type', '=', $slip_type)
                    ->where('risk_location_detail.ceding_id', $ceding->id)
                    ->sum('risk_location_detail.amountlocation');
            }

            // dd($sum_amount);
            return response()->json([
                'id' => $ceding_list->id,
                'code' => $ceding_list->code,
                'name' => $ceding_list->name,
                'type' => $ceding_list->type,
                'amountlist' => $amount_list,
                'sumamount' => $sum_amount
            ]);

        } 
        else 
        {

            if ($slip_type == "mc") 
            {
                $ceding_list = DB::table('interest_insured_detail')
                    ->join('ceding_broker', 'ceding_broker.id', '=', 'interest_insured_detail.ceding_id')
                    ->join('shiplist_detail', 'shiplist_detail.id', '=', 'interest_insured_detail.ship_id')
                    ->where('shiplist_detail.slip_type', '=', 'mc')
                    ->where('shiplist_detail.insured_id', '=', $insured_id)
                    ->orWhere('ceding_broker.type', '=', 5)
                    ->select('interest_insured_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
                    ->distinct()
                    ->get();

            } 
            elseif ($slip_type == "mh") 
            {
                $ceding_list = DB::table('shiplist_detail')
                    ->join('ceding_broker', 'ceding_broker.id', '=', 'shiplist_detail.ceding_id')
                    ->where('shiplist_detail.insured_id', '=', $insured_id)
                    ->where('shiplist_detail.slip_type', '=', 'mh')
                    ->orWhere('ceding_broker.type', '=', 5)
                    ->select('shiplist_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
                    ->distinct()
                    ->get();

            } else {
                $ceding_list = DB::table('risk_location_detail')
                    ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                    ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                    ->where('trans_location_detail.insured_id', '=', $insured_id)
                    ->where('trans_location_detail.slip_type', '=', $slip_type)
                    ->orWhere('ceding_broker.type', '=', 5)
                    ->select('risk_location_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
                    ->distinct()
                    ->get();

                // dd($ceding_list);
            }

            // $ceding_list = CedingBroker::select('id', 'code', 'name', 'type')->where('type', 4)->get();

            return response()->json([
                'ceding_list' => $ceding_list,
                'type' => 5
            ]);
        }
    }



    public function getsumAmount(Request $request)
    {
        $ceding_id = $request->ceding_id;
        $insured_id = $request->insured_id;
        $ceding = CedingBroker::where('id', $ceding_id)->first();
        // $ocp_id = $request->occupacy_id;

        if ($ceding->type == 4) {
            $ceding_list = CedingBroker::select('id', 'code', 'name', 'type')->where('id', $ceding_id)->first();
            $risklocation_detail = RiskLocationDetail::where('ceding_id', $ceding->id)->get();
            $amount_list = count($risklocation_detail);
            $sum_amount = DB::table('risk_location_detail')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', $insured_id)->where('risk_location_detail.ceding_id', $ceding->id)
                ->sum('risk_location_detail.amountlocation');
            // dd($sum_amount);
            return response()->json([
                'id' => $ceding_list->id,
                'code' => $ceding_list->code,
                'name' => $ceding_list->name,
                'type' => $ceding_list->type,
                'amountlist' => $amount_list,
                'sumamount' => $sum_amount
            ]);
        } else {
            $ceding_list = CedingBroker::select('id', 'code', 'name', 'type')->where('type', 4)->get();

            return response()->json($ceding_list);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {

        $user = Auth::user();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();

        if ($type == 'fe') {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'Fire Engineering - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,2) = 01')->orWhereRaw('LEFT(code,2) = 02')->orderby('id', 'asc')->get();            
        } elseif ($type == 'fl') {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'Financial Lines - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,2) = 05')->orWhereRaw('LEFT(code,2) = 06')->orderby('id', 'asc')->get();
        } elseif ($type == 'hem') {
            $form_name = 'HE & MOTOR';
            $route_active = 'HE & Motor - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,2) = 07')->orWhereRaw('LEFT(code,3) = 103')->orderby('id', 'asc')->get();
        } elseif ($type == 'mp') {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'Moveable Property - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,4) = 1020')->orderby('id', 'asc')->get();
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'Hole in One - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,4) = 1021')->orderby('id', 'asc')->get();
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'Personal Accident - Slip Entry';
            $cob = COB::whereRaw('LEFT(code,2) = 09')->orderby('id', 'asc')->get();
        } else {
            abort(404);
        }
        

        // $cob = COB::where(DB::raw('LEFT(code,2)'), 01)->orWhere(DB::raw('LEFT(code,2)'), 02)->orderby('id', 'asc')->get();
        $business_type = BusinessType::orderBy('id','asc')->get();
        $mydate = date("Y") . date("m") . date("d");
        $costumer = Customer::orderby('id', 'asc')->get();
        $cur_year = date("Y");
        $cur_month = date("m");
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $insured = Insured::orderby('id', 'asc')->get();
        $insured_now = Insured::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();
        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();
        
        $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('code', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 5)->orWhere('type', 4)->get();
        $broker = CedingBroker::orderby('id', 'asc')->where('type', 5)->orWhere('type', 4)->get()->unique('code');
        $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $extendedcoverage = ExtendedCoverage::orderby('id', 'asc')->get();
        $propertytype= PropertyType::orderby('id','asc')->get();
        $golffieldhole = GolfFieldHole::orderby('id','asc')->get();
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
            ->where('ceding_broker.type', '=', 4)
            ->orWhere('ceding_broker.type', '=', 5)
            ->select('risk_location_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
            ->orderByRaw("FIELD(ceding_broker.id , (SELECT GROUP_CONCAT(DISTINCT(ceding_id) SEPARATOR ',') FROM shiplist_detail WHERE insured_id= '".$code_ms."')) DESC")
            ->distinct()
            ->get();

        $slipdata = SlipTable::where('insured_id', $code_ms)->where('slip_type',$type)->first();
        $slipdatadistict = SlipTable::select('number')->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', $type)->distinct()->get();
        $slipdata2 = SlipTable::where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', $type)->get();
        $slip_now = SlipTable::whereDate('created_at', $currdate2)->where('slip_type', $type)->where('insured_id', $code_ms)->orderby('id', 'asc')->get();
        $sliplastid = count($slip_now);
        // dd($sliplastid);

        if ($sliplastid != null) {
            if ($sliplastid < 9) {
                $code_sl = strtoupper($type) .  $mydate . "0000" . strval($sliplastid + 1);
            } elseif ($sliplastid > 8 && $sliplastid < 99) {
                $code_sl = strtoupper($type) .  $mydate . "000" . strval($sliplastid + 1);
            } elseif ($sliplastid > 98 && $sliplastid < 999) {
                $code_sl = strtoupper($type) .  $mydate . "00" . strval($sliplastid + 1);
            } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                $code_sl = strtoupper($type) .  $mydate . "0" . strval($sliplastid + 1);
            } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                $code_sl = strtoupper($type) .  $mydate . strval($sliplastid + 1);
            }
        } else {
            $code_sl = strtoupper($type) .  $mydate . "0000" . strval(1);
        }

        $maxdata = SlipTable::select('endorsment')->where('insured_id', $code_ms)->where('number', $code_sl)->where('slipshow', 'yes')->where('slip_type', $type)->orderby('endorsment', 'desc')->first();
        $checkinsurednumber = InsuredNumber::where('number', $code_ms)->where('slip_type', $type)->where('status', 'passive')->first();
        // $insurednumform = '';
        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', $type)->where('status', 'passive')->first();
        // $slipnumform = '';
        if ($checkinsurednumber != null) {

            if ($checkslipnumber != null) {

                $insurednumform = $code_ms;
                $slipnumform = $code_sl;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                 $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                 $hiolist = HoleDetail::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                
                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', $type)->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'passive')->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();

                return view('crm.transaction.facultative.header_'.$type, compact(['golffieldhole','hiolist','propertytypelist','propertytype','type','maxdata', 'slipdatadistict', 'brokerchoice', 'broker', 'prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
            } elseif ($checkslipnumber == null) {


                $insurednumform = $code_ms;

                $reservedslipnumber = SlipNumber::create([
                    'number' => $code_sl,
                    'slip_type' => $type,
                    'status' => 'passive',
                    'insured_number' => $code_ms
                ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
                }

                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();

                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $hiolist = HoleDetail::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', $type)->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'passive')->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();

                return view('crm.transaction.facultative.header_'.$type, compact(['golffieldhole','hiolist','propertytypelist','propertytype','type','maxdata', 'slipdatadistict', 'brokerchoice', 'broker', 'prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
            }
        } elseif ($checkinsurednumber == null) {

            if ($checkslipnumber != null) {
                InsuredNumber::where('number', $code_ms)->where('slip_type', $type)->where('status', 'passive')->delete();

                $reservedinsurednumber = InsuredNumber::create([
                    'number' => $code_ms,
                    'status' => 'passive',
                    'slip_type' => $type
                ]);

                $insurednumform = $reservedinsurednumber->number;

                $slipnumform = $code_sl;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $hiolist = HoleDetail::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', $type)->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'passive')->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();

                return view('crm.transaction.facultative.header_'.$type, compact(['golffieldhole','hiolist','propertytypelist','propertytype','type','maxdata', 'slipdatadistict', 'brokerchoice', 'broker', 'prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
            } elseif ($checkslipnumber == null) {

                InsuredNumber::where('number', $code_ms)->where('slip_type', $type)->where('status', 'passive')->delete();
                // dd($code_ms);
                $reservedinsurednumber = InsuredNumber::create([
                    'number' => $code_ms,
                    'status' => 'passive',
                    'slip_type' => $type
                ]);

                $insurednumform = $reservedinsurednumber->number;

                $reservedslipnumber = SlipNumber::create([
                    'number' => $code_sl,
                    'slip_type' => $type,
                    'status' => 'passive',
                    'insured_number' => $code_ms
                ]);

                $slipnumform = $reservedslipnumber->number;

                $interestinsured = InterestInsured::orderby('id', 'asc')->get();

                $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
                foreach ($locationid as $dataid) {
                    RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
                }

                // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->delete();
                $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
                $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();

                // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();


                // $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
                $propertytypelist=PropertyTypeTemp::where('insured_id','=',$code_sl)->orderby('id','desc')->get();
                $hiolist = HoleDetail::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
                $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', $type)->orderby('id', 'desc')->get();


                $locationlist = array();
                foreach ($locationlist2 as $datadetail) {
                    if ($datadetail->risklocationdetail) {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'passive')->delete();
                    } else {
                        $datadetail->risklocationdetail = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->orderby('id', 'desc')->get();
                    }
                    $locationlist[] = $datadetail;
                }


                $statuslist = StatusLog::where('insured_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();

                return view('crm.transaction.facultative.header_'.$type, compact(['golffieldhole','hiolist','propertytypelist','propertytype','type','maxdata', 'slipdatadistict', 'brokerchoice', 'broker', 'prefixinsured', 'slipnumform', 'insurednumform', 'user', 'cnd', 'slipdata', 'slipdata2', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
            }
        }


          


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$type)
    {

        $validator = $request->validate([
            'fessuggestinsured' => 'required'
        ]);

        $sign = $request->btn_ins;

        $costumcheck = Customer::where('company_name', '=', $request->fessuggestinsured)->first();
        if ($costumcheck == null) {

            Customer::create([
                'owner_id' => '1',
                'industry_id' => '27',
                'company_prefix' => $request->fesinsured,
                'company_name' => $request->fessuggestinsured,
                'website' => $request->fessuggestinsured,
                'company_suffix' => $request->fessuffix
            ]);
        }

        if ($validator) {
            $user = Auth::user();


            $locationlist = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->orderby('id', 'desc')->get();

            $sum_amount = DB::table('risk_location_detail')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', $request->fesnumber)
                ->where('trans_location_detail.slip_type', $type)
                ->sum('risk_location_detail.amountlocation');

            $checkinsurednumber = Insured::where('number', $request->fesnumber)->where('slip_type', $type)->first();

            // $checkslipnumber= SlipNumber::where('number',$code_sl)->where('insured_number',$code_ms)->where('slip_type','fe')->where('status','passive')->first();


            if ($checkinsurednumber == null) {
                $insureddata = Insured::where('number', '=', $request->fesnumber)->where('slip_type', $type)->first();
                    $data = [
                        'number' => $request->fesnumber,
                        'slip_type' => $type,

                        'prefix_id' => $request->fesinsured,
                        'insured_name' => strtoupper($request->fessuggestinsured),
                        'insured_suffix' => strtoupper($request->fessuffix),
                        'share' => $sum_amount,
                        'share_from' => $request->fessharefrom,
                        'statmodified' => 1,
                        'share_to' => $request->fesshareto,
                        'coincurance' => $request->fescoincurance,
                        'location' => $locationlist->toJson(),
                        'uy' => $request->feuy,
                        'count_endorsement' => 0,
                        'flag_overseas' => $request->feflag_overseas,
                        'business_id' => $request->febusiness_id,
                        'currency_id' => $request->fecurrency

                    ];
                    if ($type == 'fl') {
                        $data['principal'] = $request->flprincipal;
                        $data['obligee'] = $request->flobligee;
                    }
                    


                    $insureddataup = Insured::create($data);

                    $insurednumberdata = InsuredNumber::where('number', $request->fesnumber)->orderby('id', 'desc')->first();
                    $insurednumberdata->status = 'active';
                    $insurednumberdata->save();

                    $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
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
                        'message' => ' Insured Data added successfully!',
                        'alert-type' => 'success',
                        'id' => $insureddataup->id,
                        'status' => 'insert',
                        'count_endorsement' => $insureddataup->count_endorsement,
                        'ceding_share' => $sum_amount,
                        'done' => 0
                    );
                
            } else {
                

                    // $newnumber2 = substr($request->fesnumber, 10, 15);
                    // $codenumber = substr($request->fesnumber, 0, 10);

                    // if (intval($newnumber2) < 9) {
                    //     $count = substr($newnumber2, 14);
                    //     $code_ms2 = $codenumber . "0000" . strval(intval($count) + 1);
                    // } elseif (intval($newnumber2) > 8 && intval($newnumber2) < 99) {
                    //     $count = substr($newnumber2, 13);
                    //     $code_ms2 = $codenumber . "000" . strval(intval($count) + 1);
                    // } elseif (intval($newnumber2) > 98 && intval($newnumber2) < 999) {
                    //     $count = substr($newnumber2, 12);
                    //     $code_ms2 = $codenumber . "00" . strval(intval($count) + 1);
                    // } elseif (intval($newnumber2) > 998 && intval($newnumber2) < 9999) {
                    //     $count = substr($newnumber2, 11);
                    //     $code_ms2 = $codenumber . "0" . strval(intval($count) + 1);
                    // } elseif (intval($newnumber2) > 9998 && intval($newnumber2) < 99999) {
                    //     $count = substr($newnumber2, 10);
                    //     $code_ms2 = $codenumber  . strval(intval($count) + 1);
                    // }


                    // $reservedinsurednumber = InsuredNumber::create([
                    //     'number' => $code_ms2,
                    //     'status' => 'active'
                    // ]);

                    $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
                    $arrayTest = null;
                    if ($TransLocationup != null) {
                        foreach ($TransLocationup as $tstup) {
                            $translocationprocessup = TransLocationTemp::findOrFail($tstup->id);
                            $translocationprocessup->insured_id = $request->fesnumber;
                            $translocationprocessup->save();

                            $risklocationup = RiskLocationDetail::where('translocation_id', '=', $tstup->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                            foreach ($risklocationup as $rlsup) {
                                $risklocationprocessup = RiskLocationDetail::findOrFail($rlsup->id);
                                $risklocationprocessup->translocation_id = $translocationprocessup->id;
                                $risklocationprocessup->save();
                            }
                        }
                    }
                    $checkExistLocation = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->orderby('id', 'desc')->first();
                        $arrayTest = json_encode($checkExistLocation);
                        if ($checkExistLocation != null) {
                            $checkExistRiskLocation = RiskLocationDetail::where('translocation_id', $checkExistLocation->id)->where('status', 'passive')->orderby('id', 'desc')->get();
                            foreach ($checkExistRiskLocation as $checkExistRiskLocation) {
                                $risklocationprocessup = RiskLocationDetail::findOrFail($checkExistRiskLocation->id);
                                $risklocationprocessup->status = 'active';
                                $risklocationprocessup->save();
                            }   
                        }
                    

                    $insureddata = Insured::where('number', '=', $request->fesnumber)->first();

                    // if ($insureddata == null) {
                        // $insureddataup = Insured::create([
                        //     'number' => $code_ms2,
                        //     'slip_type' => $type,

                        //     'prefix_id' => $request->fesinsured,
                        //     'insured_name' => strtoupper($request->fessuggestinsured),
                        //     'insured_suffix' => strtoupper($request->fessuffix),

                        //     'share' => $sum_amount,
                        //     'share_from' => $request->fessharefrom,
                        //     'statmodified' => 1,
                        //     'share_to' => $request->fesshareto,
                        //     'coincurance' => $request->fescoincurance,
                        //     'location' => $locationlist->toJson(),
                        //     'uy' => $request->feuy,
                        //     'flag_overseas' => $request->feflag_overseas,
                        //     'business_id' => $request->febusiness_id,
                        //     'count_endorsement' => 0,
                        //     'currency_id' => $request->fecurrency

                        // ]);


                        $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
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
                        $insureddataid = $insureddata->id;
                        $insureddataup = Insured::findOrFail($insureddataid);

                        $insureddataup->prefix_id = $request->fesinsured;
                        $insureddataup->insured_name = strtoupper($request->fessuggestinsured);
                        $insureddataup->insured_suffix = strtoupper($request->fessuffix);

                        $insureddataup->share = $sum_amount;
                        $insureddataup->statmodified = 1;
                        $insureddataup->share_from = $request->fessharefrom;
                        $insureddataup->share_to = $request->fesshareto;
                        $insureddataup->coincurance = $request->fescoincurance;
                        $insureddataup->location = $locationlist->toJson();
                        $insureddataup->uy = $request->feuy;
                        $insureddataup->currency_id = $request->fecurrency;
                        $insureddataup->flag_overseas = $request->feflag_overseas;
                        $insureddataup->business_id = $request->febusiness_id;

                        if ($type == 'fl') {
                            $insureddataup->principal = $request->flprincipal;
                            $insureddataup->obligee = $request->flobligee;
                        }
                        $insureddataup->save();

                        $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
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

                        $TransLocationup = TransLocationTemp::where('insured_id', '=', $request->fesnumber)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
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
                        // Add warning flags
                        if ($sum_amount != strval($request->fesshareto)) {
                            $warning_flag = 1;
                        }else{
                            $warning_flag = 0;
                        }
                        $SlipTableUp = SlipTable::where('insured_id', '=', $insureddataup->number)->where('slip_type', $type)->where('slipshow', 'yes')->orderby('id', 'desc')->get();
                            foreach ($SlipTableUp as $stu) {
                                $sliptableprocessup = SlipTable::findOrFail($stu->id);
                                $sliptableprocessup->warning_flag = $warning_flag;
                                $sliptableprocessup->save();
                            }
                            // End add warning flags
                        // checking trans_location_detail 
                        
                        $checkExist = TransLocationTemp::where('insured_id',$request->fesnumber)->where('slip_type', $type)->where('status', 'active')->orderby('id', 'desc')->first();

                        $translocation_id = $checkExist->id;
                        $dataRiskLocationDetail = RiskLocationDetail::where('translocation_id',$translocation_id)->where('status','active')->get();
                        foreach ($dataRiskLocationDetail as $dataRiskLocationDetail) {
                            $id = $dataRiskLocationDetail->id;
                            $amount = strval($dataRiskLocationDetail->amountlocation);
                            $amountup = strval($request->fesshareto);
                            $percent = ($amount/$amountup)*100;
                            $updateRiskLocationDetail = RiskLocationDetail::findOrFail($id);
                            $updateRiskLocationDetail->percentage = $percent;
                            $updateRiskLocationDetail->save();
                        }
                        
                        // End checking

                        $notification = array(
                            'message' => 'Insured Update successfully!',
                            'alert-type' => 'success',
                            'count_endorsement' => $insureddataup->count_endorsement,
                            'ceding_share' => $sum_amount,
                            'test' => $arrayTest,
                            'id' => $insureddataup->id,
                            'status' => 'update',
                            'done' => 1 
                        );
                    // }
                // }
            }

            return response($notification);
            //Session::flash('Success', 'Fire & Engginering Insured added successfully', 'success');
            //return redirect()->route('liniusaha.index');

        } else {

            $notification = array(
                'message' => 'Insured added Failed!',
                'alert-type' => 'success'
            );

            return back()->with($validator)->withInput();
            //Session::flash('Failed', 'Fire & Engginering Insured Failed added', 'danger');
            //return redirect()->route('liniusaha.index');
        }
    }

    function refresh_table_slip(Request $request,$type){
        if ($type == null) {
            $notification = array(
                'message' => 'Failed!',
                'alert-type' => 'success'
            );
            return response($notification);
        }
        $slipdata2 = DB::table('slip_table as stb')
                    ->where('stb.insured_id', $request->number)
                    ->where('stb.slipshow', 'yes')
                    ->where('stb.slip_type', $request->type)
                    ->join('ceding_broker as cb1', 'stb.source', '=', 'cb1.id')
                    ->join('ceding_broker as cb2', 'stb.source', '=', 'cb2.id')
                    ->select('stb.*', 'cb1.name','cb1.company_name','cb2.name as source_name','cb2.company_name as source_companyname')
                    ->orderBy('stb.endorsment','desc')
                    ->orderBy('cb1.name', 'asc')
                    ->get();
        $dataslipdistict = collect(SlipTable::where('insured_id',$request->number)
                            ->where('slipshow', 'yes')
                            ->where('selisih','false')
                            ->where('slip_type', $request->type)
                            ->orderBy('endorsment','desc')
                            ->distinct('endorsment')
                            ->get());
        $slipdatadistict = $dataslipdistict->unique('number','endorsment','insured_id');

        $slipdatadistict->values()->all();

        $maxdata = SlipTable::where('insured_id', $request->number)
                    ->where('slip_type', $request->type)
                    ->orderby('endorsment', 'desc')->first();
        $e = ($maxdata) ? $maxdata->endorsment : 0; 
        $notification = array(
            'message' => 'Fetched!',
            'alert-type' => 'success',
            'type' => $request->type,
            'max_endorsement' => $e,
            'slip_data2' => $slipdata2->toJson(),
            'slip_data_distinct' => $slipdatadistict->toJson()
        );
        return response($notification);
    }


    public function storeMultiFile(Request $request)
    {

        $validatedData = $request->validate([
            // 'files' => 'required'
        ]);

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {

                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);

                    $path = 'public/files';
                    //$file->move(base_path('\public\files'), $file->getClientOriginalName());
                    //$name = $file->getClientOriginalName();

                    $extension = $file->getClientOriginalExtension();

                    if ($extension == "csv" || $extension == "txt" || $extension == "xlsx" || $extension == "xls" || $extension == "pdf" || $extension == "ppt" || $extension == "pptx" || $extension == "doc" || $extension == "docx" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                        $name =  time() . rand(11111, 99999) . '' . $file->getClientOriginalName();
                        //$file->move(base_path('\public\files'), $name);

                        //$file->move(base_path('\public\files'), $name);
                        //$file->move(public_path()."/files/", $name);

                        $file->move(public_path("files"), $name);
                        
                        $path = '/files/' . $name;

                        $insert[$x]['filename'] = $name;
                        $insert[$x]['path'] = $path;
                        $insert[$x]['user_id'] = Auth::user()->name;
                        $insert[$x]['slip_id'] = $request->slip_id;
                        $insert[$x]['insured_id'] = $request->insured_id;
                        $insert[$x]['slip_type'] = $request->slip_type;
                        SlipTableFile::insert($insert);
                        
                    } else {
                        return response()->json(['message' => 'file type incorrect']);
                    }
                }
            }



            return response()->json(['success' => 'Ajax Multiple fIle has been uploaded']);
        } else {
            return response()->json(["message" => "Please try again."]);
        }
    }

    public function storelocationlist(Request $request)
    {

        $adrress = $request->adrress;
        $insured_id = $request->insuredID;
        // Checking is exist number
        $token = $request->_token;

        $checkExist = Insured::where('number',$insured_id)->where('slip_type',$request->sliptype)
        ->first();

        $mydate = date("Y") . date("m") . date("d");
        $checkExistTransLocation = TransLocationTemp::where('insured_id',$insured_id)->first();
        if ($checkExistTransLocation) {
            if ($checkExistTransLocation->token == null) {

                $code_ms = $insured_id;
            }else if ($token != null && $token != $checkExistTransLocation->token) {
                $code_ms = "IN". $mydate .str_pad( intval(ltrim(substr($checkExistTransLocation->insured_id,-5) , "0"))+1, 5, '0', STR_PAD_LEFT);
            }
        }else{
            $code_ms = $insured_id;
                
        }
        // End Checking is exist number
        if ($adrress != '' && $insured_id != '') {
            $locationlist = new TransLocationTemp();
            $locationlist->insured_id = $code_ms;
            $locationlist->lookup_location_id = $adrress;
            $locationlist->country_id = $request->country;
            $locationlist->state_id = $request->state;
            $locationlist->city_id = $request->city;
            $locationlist->address_location_id = $adrress;
            $locationlist->interest_id = $request->slipinterestid;
            $locationlist->slip_type = $request->sliptype;
            $locationlist->token = $token;
            $locationlist->status = "passive";
            $locationlist->save();

            $felookuplocations = FeLookupLocation::find($adrress);
            $locationlist2 = TransLocationTemp::where('id', '=', $locationlist->id);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'id' => $locationlist->id,
                'loc_code' => $felookuplocations->loc_code,
                'address' => $felookuplocations->address,
                'city_id' => $felookuplocations->city_id,
                'postal_code' => $felookuplocations->postal_code,
                'province_id' => $felookuplocations->province_id,
                'latitude' => $felookuplocations->latitude,
                'longtitude' => $felookuplocations->longtitude,
                'state_name' => $felookuplocations->state->name,
                'code_ms' => $code_ms,
                'city_name' => $felookuplocations->city->name
                //'interest_id'=> $request->slipinterestid,
                //'interest_name'=> $locationlist->interestdata->code.'-'.$locationlist->interestdata->description,
                //'cnno' => $request->cnno,
                //'certno' => $request->certno,
                //'refno' => $request->refno,
                //'amountlocation' => $request->amountlocation,
            ]);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fill all fields'
                ]
            );
        }
    }


    public function storedetaillocation(Request $request)
    {

        $amountlocation = $request->amountlocation;
        $translocation_id = $request->insurednoloc;
        $insuredid = $request->insured_id;
        $slip_type = $request->sliptype;
        

        if (empty($request->ceding_id) || empty($request->slipinterestid)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Ceding & Interest cannot be null'
                ]
            );
        }
        $check = RiskLocationDetail::where('ceding_id', trim($request->ceding_id))
        ->where('interest_id', trim($request->slipinterestid))
        ->where('translocation_id' ,trim($translocation_id))
        ->where('cndn' ,trim($request->cndn))
        ->where('certno' ,trim($request->certno))
        ->where('slipno' ,trim($request->slipno))
        ->where('policyno' ,trim($request->policyno))
        ->first();
        if ($check != null) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Duplicated'
                ]
            );
        }else{
           if ($amountlocation != '' && $translocation_id != '') {
            $locationlist = new RiskLocationDetail();
            $locationlist->translocation_id = $translocation_id;
            $locationlist->ceding_id = $request->ceding_id;
            $locationlist->interest_id = $request->slipinterestid;
            $locationlist->cndn = $request->cndn;
            $locationlist->certno = $request->certno;
            $locationlist->slipno = $request->slipno;
            $locationlist->policyno = $request->policyno;
            $locationlist->percentage = $request->percent_ceding;
            $locationlist->amountlocation = $request->amountlocation;
            $locationlist->status = "passive";
            $locationlist->save();

            //$felookuplocations = FeLookupLocation::find($adrress);
            $locationlist2 = RiskLocationDetail::where('id', '=', $locationlist->id);

            $cedingbroker = CedingBroker::where('id', $request->ceding_id)->first();
            $ceding = CedingBroker::where('id', $request->ceding_id)->first();

            // $risklocceding = RiskLocationDetail::where('ceding_id', '=', $request->ceding_id)->where('translocation_id','=',$translocation_id)->get();
            // $countriskceding = count($risklocceding);

            $brokerchoice = DB::table('risk_location_detail')
                ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', '=', $insuredid)
                ->where('ceding_broker.type', '=', 5)
                ->orWhere('ceding_broker.type', '=', 4)
                ->select('risk_location_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
                ->orderByRaw("FIELD(ceding_broker.id , risk_location_detail.ceding_id) ASC")
                ->distinct('risk_location_detail.ceding_id')
                ->get();

            // dd($brokerchoice);

            $sumperceding = DB::table('risk_location_detail')
                ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', '=', $insuredid)
                ->where('trans_location_detail.slip_type', '=', $slip_type)
                // ->where('trans_location_detail.status', '=', 'passive')
                ->select(DB::raw('sum(risk_location_detail.amountlocation) as amountlocation'), 'ceding_broker.name', DB::raw('sum(risk_location_detail.percentage) as percentage'))
                ->groupBy('ceding_broker.name')
                ->get();



            // if($request->kurs == '' || empty($request->kurs))
            // {
            //     $currency = Currency::where('code', '=', 'IDR')->where('country','=','102')->first();
            // }
            // else
            // {
            //     $currency = Currency::where('id', '=', $request->kurs)->first();
            // }

            return response()->json([
                'id' => $locationlist->id,
                'translocation_id' =>  $request->translocation_id,
                'interest_id' => $request->slipinterestid,
                'ceding' => $ceding->name,
                'cedingcode' => $ceding->code,
                'cedinglocation' => $locationlist->ceding_id,
                'cedingbroker' => $cedingbroker->name,
                'idceding' => $ceding->id,
                'interest_name' => $locationlist->interestdata->code . '-' . $locationlist->interestdata->description,
                'cndn' => $request->cndn,
                'certno' => $request->certno,
                'slipno' => $request->slipno,
                'sumceding' => $sumperceding,
                'policyno' => $request->policyno,
                'percent' => $request->percent_ceding,
                
                'amountlocation' => $request->amountlocation

                // 'kurs'=> $currency->code
            ]);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fill all fields'
                ]
            );
        } 
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showdetailform($type,$id)
    {
        $user = Auth::user();
        //print_r($user);
        //exit();
        $userid = Auth::user()->id;
        $country = User::orderby('id', 'asc')->get();
        if ($type == 'fe') {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'Fire Engineering - Slip Update';
            $cob = COB::whereRaw('LEFT(code,2) = 01')->orWhereRaw('LEFT(code,2) = 02')->orderby('id', 'asc')->get();            
        } elseif ($type == 'fl') {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'Financial Lines - Slip Update';
            $cob = COB::whereRaw('LEFT(code,2) = 05')->orWhereRaw('LEFT(code,2) = 06')->orderby('id', 'asc')->get();
        } elseif ($type == 'hem') {
            $form_name = 'HE & MOTOR';
            $route_active = 'HE & Motor - Slip Update';
            $cob = COB::whereRaw('LEFT(code,2) = 07')->orWhereRaw('LEFT(code,3) = 103')->orderby('id', 'asc')->get();
        } elseif ($type == 'mp') {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'Moveable Property - Slip Update';
            $cob = COB::whereRaw('LEFT(code,4) = 1020')->orderby('id', 'asc')->get();
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'Hole in One - Slip Update';
            $cob = COB::whereRaw('LEFT(code,4) = 1021')->orderby('id', 'asc')->get();
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'Personal Accident - Slip Update';
            $cob = COB::whereRaw('LEFT(code,2) = 09')->orderby('id', 'asc')->get();
        } else {
            abort(404);
        }
        $mydate = date("Y") . date("m") . date("d");
        $costumer = Customer::orderby('id', 'asc')->get();
        $cur_year = date("Y");
        $cur_month = date("m");
        $currdate = date("d/m/Y");
        $currdate2 = date("Y-m-d");
        $insured = Insured::orderby('id', 'asc')->get();
        $slip = SlipTable::orderby('id', 'asc')->get();
        $propertytype= PropertyType::orderby('id','asc')->get();

        $currency = Currency::join('currencies_exc', 'currencies_exc.currency', "=", "currencies.id")->where('currencies_exc.year', $cur_year)->where('currencies_exc.month', $cur_month)->select('currencies_exc.year','currencies_exc.kurs', 'currencies.symbol_name', 'currencies.code','currencies.id')->orderby('currencies_exc.id', 'asc')->get();

        
        $business_type = BusinessType::orderBy('id','asc')->get();
        $koc = KOC::where('parent_id', 2)->orWhere('code', 'like',  '02' . '%')->orWhere('code', '02')->orderby('id', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', 5)->orWhere('type', 4)->get();
        $broker = CedingBroker::orderby('id', 'asc')->where('type', 5)->orWhere('type', 4)->get();
        $propertytype= PropertyType::orderby('id','asc')->get();
        $golffieldhole = GolfFieldHole::orderby('id','asc')->get();
        $prefixinsured =  PrefixInsured::orderby('id', 'asc')->get();
        // $felookup = FelookupLocation::orderby('id','asc')->get();
        $felookuptable = collect(FelookupLocation::orderby('id', 'asc')->get());
        $felookup = $felookuptable->unique('country_id');
        $felookup->values()->all();
        $cnd = ConditionNeeded::orderby('id', 'asc')->get();
        $deductibletype = DeductibleType::orderby('id', 'asc')->get();
        $extendedcoverage = ExtendedCoverage::orderby('id', 'asc')->get();

        $fe_ids = response()->json($insured->modelKeys());

        $insureddata = Insured::find(base64_decode($id));
        if (!$insureddata) {
            abort(404);
        }
        $brokerchoice = DB::table('risk_location_detail')
            ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
            ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
            ->where('trans_location_detail.slip_type', '=', $type)
            ->where('trans_location_detail.insured_id', '=', $insureddata->number)
            ->where('ceding_broker.type', '=', 4)
            ->orWhere('ceding_broker.type', '=', 5)
            ->select('risk_location_detail.ceding_id', 'ceding_broker.code', 'ceding_broker.name')
            ->orderByRaw("FIELD(ceding_broker.id , risk_location_detail.ceding_id) ASC")
            ->distinct()
            ->get();

        $sumperceding = DB::table('risk_location_detail')
            ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
            ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
            ->where('trans_location_detail.insured_id', '=', $insureddata->number)
            ->where('trans_location_detail.slip_type', '=', $type)
            ->select(DB::raw('sum(risk_location_detail.amountlocation) as amountlocation'), 'ceding_broker.name', DB::raw('sum(risk_location_detail.percentage) as percentage'))
            ->groupBy('ceding_broker.name')
            ->orderBy('ceding_broker.name', 'asc')
            ->get();

        // dd($sumperceding);
        $code_ms = $insureddata->number;
        $slipdata = SlipTable::where('insured_id', $insureddata->number)
                                ->where('slipshow', 'yes')
                                ->where('selisih','false')
                                ->where('slip_type', $type)
                                ->first();
        // $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('slip_type', 'fe')->orderBy('endorsment','desc')->get();

        // $slipdata2 = SlipTable::where('insured_id', $insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', 'fe')->join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')->select('slip_table.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->orderBy('slip_table.endorsment', 'desc')->get();
        $slipdata2 = SlipTable::join('ceding_broker', 'slip_table.source', '=', 'ceding_broker.id')
                    // ->join('ceding_broker as ceding', 'slip_table.source_2', '=', 'ceding.id')
                    ->where('slip_table.insured_id', $insureddata->number)
                    ->where('slip_table.slipshow', 'yes')
                    ->where('slip_table.selisih','false')
                    ->where('slip_table.slip_type', $type)
                    ->select('slip_table.*', 'ceding_broker.name')
                    ->orderBy('ceding_broker.name', 'asc')
                    ->orderBy('slip_table.endorsment', 'desc')
                    ->get();
        
        // $slipdatadistict = DB::table('slip_table')->select('slip_table.*')->where('slip_table.insured_id', $insureddata->number)->where('slip_table.selisih', 'false')->where('slip_table.slipshow', 'yes')->where('slip_table.slip_type', 'fe')->distinct('slip_table.number')->get();
        //$slipdatadistict = SlipTable::select('number')->distinct()->where('insured_id', $code_ms)->where('slipshow', 'yes')->where('slip_type', 'fe')->get();
        
        $dataslipdistict = collect(SlipTable::where('insured_id',$insureddata->number)->where('slipshow', 'yes')->where('selisih','false')->where('slip_type', $type)->get());
        $slipdatadistict = $dataslipdistict->unique('created_at');
        $slipdatadistict->values()->all();

        // dd($slipdatadistict);
        //$slipdatadis2 = SlipTable::select('number')->distinct()->get();

        // dd($slipdata2);

        if (!empty($slipdata)) {
            $code_sl = $slipdata->number;
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate2)->where('slip_type','fe')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', $type)->where('slipshow', 'yes')->orderby('id', 'asc')->get();
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
                            $code_sl = strtoupper($type) .  $mydate . "0000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 8 && $sliplastid < 99) {
                            $code_sl = strtoupper($type) .  $mydate . "000" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 98 && $sliplastid < 999) {
                            $code_sl = strtoupper($type) .  $mydate . "00" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                            $code_sl = strtoupper($type) .  $mydate . "0" . strval($sliplastid + $i);
                        } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                            $code_sl = strtoupper($type) .  $mydate . strval($sliplastid + $i);
                        }
                    } else {
                        $code_sl = strtoupper($type) .  $mydate . "0000" . strval(1);
                    }
                }

                $i++;
            }
        } else {
            $slip = SlipTable::orderby('id', 'asc')->get();
            // $slip_now = SlipTable::whereDate('created_at',$currdate)->where('slip_type','fe')->orderby('id','asc')->get();
            $slip_now = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', $type)->where('slipshow', 'yes')->orderby('id', 'asc')->get();
            $sliplastid = count($slip_now);

            if ($sliplastid != null) {
                if ($sliplastid < 9) {
                    $code_sl = strtoupper($type) .  $mydate . "0000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 8 && $sliplastid < 99) {
                    $code_sl = strtoupper($type) .  $mydate . "000" . strval($sliplastid + 1);
                } elseif ($sliplastid > 98 && $sliplastid < 999) {
                    $code_sl = strtoupper($type) .  $mydate . "00" . strval($sliplastid + 1);
                } elseif ($sliplastid > 998 && $sliplastid < 9999) {
                    $code_sl = strtoupper($type) .  $mydate . "0" . strval($sliplastid + 1);
                } elseif ($sliplastid > 9998 && $sliplastid < 99999) {
                    $code_sl = strtoupper($type) .  $mydate . strval($sliplastid + 1);
                }
            } else {
                $code_sl = strtoupper($type) .  $mydate . "0000" . strval(1);
            }


            $slipdata = SlipTable::orderBy('id', 'desc')->first();
        }

        $maxdata = SlipTable::where('insured_id', $insureddata->number)->where('slip_type', $type)->where('selisih','false')->orderby('endorsment', 'desc')->first();
        // dd($maxdata);

        $interestinsured = InterestInsured::orderby('id', 'asc')->get();
        // $interestlist= InterestInsuredTemp::where('slip_id','=',$code_sl)->orderby('id','desc')->get();

        $checkslipnumber = SlipNumber::where('number', $code_sl)->where('insured_number', $code_ms)->where('slip_type', $type)->where('status', 'passive')->first();


        if ($checkslipnumber != null) {

            $slipnumform = $code_sl;
        } elseif ($checkslipnumber == null) {


            $reservedslipnumber = SlipNumber::create([
                'number' => $code_sl,
                'slip_type' => $type,
                'status' => 'passive',
                'insured_number' => $code_ms
            ]);

            $slipnumform = $reservedslipnumber->number;
        }

        
        foreach($slip_now as $list_slip){
            // HoleDetail::where('insured_id', '=', $list_slip->insured_id)->where('status','passive')->orderby('id','desc')->delete();
            InterestInsuredTemp::where('insured_id', '=', $list_slip->insured_id)->orderby('id', 'desc')->delete();
            InstallmentTemp::where('slip_id', '=', $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            ExtendCoverageTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            DeductibleTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            RetrocessionTemp::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            TransLocationTemp::where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            SlipTableFile::where('slip_id', '=',  $list_slip->number)->where('insured_id', '=', $list_slip->insured_id)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
            
            $locationidcurr = TransLocationTemp::select('id')->where('insured_id', '=', $list_slip->insured_id)->where('slip_type',$type)->where('status','passive')->orderby('id', 'desc')->get();
            foreach ($locationidcurr as $dataid) {
                RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('slip_type',$type)->where('status','passive')->delete();
            }

        }

        

        $locationid = TransLocationTemp::select('id')->where('insured_id', '=', $code_ms)->where('slip_type', $type)->where('status', 'passive')->orderby('id', 'desc')->get();
        foreach ($locationid as $dataid) {
            RiskLocationDetail::where('translocation_id', '=', $dataid->id)->where('status', 'passive')->delete();
        }

        $interestlist2 = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->delete();
        $installmentlist2 = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $extendcoveragelist2 = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $deductiblelist2 = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $retrocessionlist2 = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $locationlist3 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        $attachmentlist2 = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'passive')->orderby('id', 'desc')->delete();
        // $filelist = SlipTableFile::where('slip_id','=',$code_sl)->where('insured_id','=',$code_ms)->where('slip_type','=','fe')->where('status','=','passive')->orderby('id','desc')->delete();

        // $statuslist= StatusLog::where('insured_id','=',$code_sl)->orderby('id','desc')->get();

        $insuredfilelist = InsuredTableFile::where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'active')->orderby('id', 'desc')->get();
        $interestlist = InterestInsuredTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
        $installmentlist = InstallmentTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
        $extendcoveragelist = ExtendCoverageTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
        $deductiblelist = DeductibleTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
        $retrocessionlist = RetrocessionTemp::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->orderby('id', 'desc')->get();
        $filelist = SlipTableFile::where('slip_id', '=', $code_sl)->where('insured_id', '=', $code_ms)->where('slip_type', '=', $type)->where('status', '=', 'active')->orderby('id', 'desc')->get();
        $hiolist = HoleDetail::where('insured_id', '=', $code_ms)->where('status','active')->orderby('id', 'desc')->get();
        $propertytypelist = PropertyTypeTemp::where('insured_id', '=', $code_ms)->orderby('id', 'desc')->get();
        $locationlist2 = TransLocationTemp::where('insured_id', '=', $code_ms)->where('slip_type', $type)->orderby('id', 'desc')->get();

        //dd($locationlist2);

        $locationlist = [];

        if (!empty($locationlist2)) {
            foreach ($locationlist2 as $datadetail) {
                //$risklocationdetaildata= RiskLocationDetail::where('translocation_id','=',$datadetail->id)->where('count_endorsement',$insureddata->count_endorsement)->get();
                $risklocationdetaildata = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->where('status', 'active')->join('ceding_broker', 'risk_location_detail.ceding_id', '=', 'ceding_broker.id')->select('risk_location_detail.*', 'ceding_broker.name')->orderBy('ceding_broker.name', 'asc')->get();

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

        // return "coba";
        return view('crm.transaction.facultative.header_'.$type, compact(['insuredfilelist','propertytype','golffieldhole','propertytypelist','hiolist','type','maxdata', 'slipdatadistict', 'sumperceding', 'brokerchoice', 'broker', 'prefixinsured', 'slipnumform', 'user', 'userid', 'cnd', 'slipdata2', 'filelist', 'slipdata', 'insureddata', 'statuslist', 'retrocessionlist', 'installmentlist', 'extendcoveragelist', 'deductiblelist', 'extendedcoverage', 'extendedcoverage', 'deductibletype', 'interestinsured', 'locationlist', 'interestlist', 'felookup', 'currency', 'cob', 'koc', 'ocp', 'ceding', 'cedingbroker', 'route_active', 'currdate', 'slip', 'insured', 'fe_ids', 'code_ms', 'code_sl', 'costumer','business_type']));
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

    public function destroysliplocationlist($id)
    {
        $sliplistlocation = TransLocationTemp::find($id);
        $amountlocation = '0';
        $sliplistlocation->delete();

        return response()->json(['success' => 'Data has been deleted', 'amountlocation' => $amountlocation]);
    }


    public function destroysliplocationdetail($id)
    {
        $sliplistlocation = RiskLocationDetail::find($id);

        $transloc = TransLocationTemp::find($sliplistlocation->translocation_id);

        $amountlocation = $sliplistlocation->amountlocation;
        $cedinglocation = $sliplistlocation->ceding_id;
        $sliplistlocation->delete();

        $checkceding = RiskLocationDetail::where('translocation_id',$sliplistlocation->translocation_id)->where('ceding_id',$sliplistlocation->ceding_id)->get();
        $jumlahceding = count($checkceding);

        $sumperceding = DB::table('risk_location_detail')
            ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
            ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
            ->where('trans_location_detail.insured_id', '=', $transloc->insured_id)
            ->select(DB::raw('sum(risk_location_detail.amountlocation) as amountlocation'), 'ceding_broker.name', DB::raw('sum(risk_location_detail.percentage) as percentage'))
            ->groupBy('ceding_broker.name')
            ->get();

        return response()->json(['success' => 'Data has been deleted', 'amountlocation' => $amountlocation, 'cedinglocation' => $cedinglocation, 'sumceding' => $sumperceding, 'jumlahceding'=> $jumlahceding]);
    }

    function refreshRiskLocation(Request $request){
            $slip_type = $request->sliptype;
            $translocation = TransLocationTemp::where('id',$request->id)->first();
            $insuredid = $translocation->insured_id;
            $translocation_id = $translocation->id;

            $risklocation = RiskLocationDetail::where('id', '=', $translocation_id)->first();
            $sumperceding = DB::table('risk_location_detail')
                ->join('ceding_broker', 'ceding_broker.id', '=', 'risk_location_detail.ceding_id')
                ->join('trans_location_detail', 'trans_location_detail.id', '=', 'risk_location_detail.translocation_id')
                ->where('trans_location_detail.insured_id', '=', $insuredid)
                ->where('trans_location_detail.slip_type', '=', $slip_type)
                ->where('trans_location_detail.status', '=', 'passive')
                ->select(DB::raw('sum(risk_location_detail.amountlocation) as amountlocation'), 'ceding_broker.name', DB::raw('sum(risk_location_detail.percentage) as percentage'))
                ->groupBy('ceding_broker.name')
                ->get();




            return response()->json([
                'id' => $translocation->id,
                'interest_id' => $translocation->interest_id,
                // 'interest_name' => $translocation->interestdata->code . '-' . $translocation->interestdata->description,
                'cndn' => $risklocation->cndn,
                'cedingbroker' => $risklocation->cedingbroker->name,
                'certno' => $risklocation->certno,
                'slipno' => $risklocation->slipno,
                'sumceding' => $sumperceding,
                'policyno' => $risklocation->policyno,
                'percent' => $risklocation->percent_ceding,
                'amountlocation' => $risklocation->amountlocation
                // 'kurs'=> $currency->code
            ]);
    }    

}
