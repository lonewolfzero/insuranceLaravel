<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\COB;
use App\Models\Currency;
use App\Models\CurrencyExchange;
use App\Models\Occupation;
use App\Models\ShipType;
use App\Models\PropertyType;
use App\Models\ConditionNeeded;
use App\Models\InterestInsured;
use App\Models\DeductibleType;
use App\Models\ExtendedCoverage;
use App\Models\ShipPort;
use App\Models\RouteShip;
use App\Models\City;
use App\Models\Collection;
use App\Models\Construction;
use App\Models\CompanyType;
use App\Models\MarineLookup;
use App\Models\PrefixInsured;
use App\Models\InsuredMarineType;
use App\Models\BusinessType;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexbt(Request $request)
    {
        $route_active = 'Business Type Master';
        $user = Auth::user();
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        
        if(empty($search))
        {

            $business_type = BusinessType::orderby('code')->get();
            $countparent= BusinessType::get();
            // dd($countparent);
            $lastid = count($countparent);
            $ids = response()->json($business_type->modelKeys());

            $code = '0' . strval(1);
            if($lastid != null)
            {

                if($lastid < 9){
                    $code = '0' . strval($lastid + 1);
                }   
                elseif($lastid > 8){
                    $code = strval($lastid + 1);
                } 

                //$code = $mydate . strval($lastid + 1);
                // if($lastid->id == 9){
                //     $code = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 10){
                //     $code = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 99){
                //     $code = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 100){
                //     $code = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 999){
                //     $code = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 1000){
                //     $code = $mydate . strval($lastid->id + 1);
                // }else{
                //     $code = $mydate . strval($lastid->id + 1);
                // }
            }
            else
            {
                $code = '0' . strval(1);
                //$code = $mydate . strval(1);
            }

            // dd($country);
            return view('crm.master.business_type', compact(['route_active', 'business_type','ids','code'])); 

        }
        else
        {
            $business_type = BusinessType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
            $lastid = BusinessType::select('id')->latest()->first();
            $ids = response()->json($business_type->modelKeys());

          return view('crm.master.business_type', compact('user','business_type','route_active','ids'))->with('i', ($request->input('page', 1) - 1) * 10);

        }

               

    }
    public function indexcountry(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Country Master';
        $search = @$request->input('search');
        

        // dd($country);
        if(empty($search))
         {
            $country = Country::orderby('id','asc')->get();
            $country_ids = response()->json($country->modelKeys());
            return view('crm.master.country', compact(['route_active', 'country','country_ids']));   
        return view('crm.master.country', compact(['route_active', 'country','country_ids']));        
            return view('crm.master.country', compact(['route_active', 'country','country_ids']));   
         }
        else
        {
          $country = Country::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $country_ids = response()->json($country->modelKeys());
          return view('crm.master.country', compact('user','country','route_active','country_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }


    }

    public function indexcob(Request $request)
    {
        $route_active = 'COB Master';
        $user = Auth::user();
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        
        if(empty($search))
        {

            $cob = COB::orderby('code')->get();
            $cobparent = COB::whereRaw('LENGTH(code) < 9')->orderby('code','desc')->get();
            // $cobparent = COB::orderby('code')->get();
            $countparent= COB::where('parent_id',null)->whereRaw('LENGTH(code) < 5')->orderby('code','desc')->get();
            // dd($countparent);
            $lastid = count($countparent);
            $cob_ids = response()->json($cob->modelKeys());

            $code_cob = '0' . strval(1);
            if($lastid != null)
            {

                if($lastid < 9){
                    $code_cob = '0' . strval($lastid + 1);
                }   
                elseif($lastid > 8){
                    $code_cob = strval($lastid + 1);
                } 

                //$code_cob = $mydate . strval($lastid + 1);
                // if($lastid->id == 9){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 10){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 99){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 100){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 999){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 1000){
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }else{
                //     $code_cob = $mydate . strval($lastid->id + 1);
                // }
            }
            else
            {
                $code_cob = '0' . strval(1);
                //$code_cob = $mydate . strval(1);
            }

            // dd($country);
            return view('crm.master.cob', compact(['route_active','cobparent', 'cob','cob_ids','code_cob'])); 

        }
        else
        {
            $cob = COB::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
            $lastid = COB::select('id')->latest()->first();
            $cob_ids = response()->json($cob->modelKeys());

          return view('crm.master.cob', compact('user','cob','route_active','cob_ids'))->with('i', ($request->input('page', 1) - 1) * 10);

        }

               

    }

    public function indexoccupation(Request $request)
    {
        $route_active = 'Occupation Master';
        $user = Auth::user();
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        

        if(empty($search))
         {
            $occupation = Occupation::orderby('code','desc')->take(10)->get();
            // $ocpparent = Occupation::orderby('code')->get();
            $ocpparent = Occupation::whereRaw('LENGTH(code) < 9')->orderby('code','desc')->get();
            $countparent= Occupation::where('parent_id',null)->whereRaw('LENGTH(code) < 5')->orderby('code','desc')->get();
            $lastparent= Occupation::where('parent_id',null)->whereRaw('LENGTH(code) < 5')->orderby('code','desc')->first();
            $lastid = count($countparent);
            $ocp_ids = response()->json($occupation->modelKeys());
            $cob = COB::orderby('id','asc')->get();


            if($lastid != null){
                //$code_ocp = $mydate . strval($lastid + 1);
                // $code_ocp = strval($lastid + 1);

                if($lastid < 9){
                    $code_ocp = '0' . strval($lastid + 1);
                } 
                elseif($lastid > 8 && $lastid < 99){
                    $code_ocp = strval($lastid + 1);
                } 
                
                
                // if($lastid->id == 9){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 10){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 99){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 100){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id == 999){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }elseif($lastid->id >= 1000){
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }else{
                //     $code_ocp = $mydate . strval($lastid->id + 1);
                // }
            }
            else{
                $code_ocp = '0' . strval( 1);
                //$code_ocp = $mydate . strval(1);
            }

        return view('crm.master.occupation', compact(['route_active', 'ocpparent','occupation','cob','ocp_ids','code_ocp']));        

        }
        else
        {
            $occupation =Occupation::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
            $ocp_ids = response()->json($occupation->modelKeys());
            $cob = COB::orderby('id','asc')->get();


            return view('crm.master.occupation', compact('user','occupation','cob','route_active','ocp_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }


        // dd($lastid);
        // return view('crm.master.occupation', compact(['route_active', 'occupation','cob','ocp_ids','code_ocp']));        

    }

    public function indexcurrency(Request $request)
    {
        $route_active = 'Currency Master';
        $user = Auth::user();
        $search = @$request->input('search');

        if(empty($search))
         {
            $currency = Currency::orderby('id','asc')->get();
            $crc_ids = response()->json($currency->modelKeys());
            $country = Country::orderby('id','asc')->get();

            // dd($country);
            return view('crm.master.currency', compact(['route_active', 'currency','crc_ids','country']));        
        }
        else
        {
            $currency = Currency::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
            $crc_ids = response()->json($currency->modelKeys());
            $country = Country::orderby('id','asc')->get();

            return view('crm.master.currency', compact('user','currency','country','route_active','crc_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexexchange(Request $request)
    {
        $route_active = 'Currency Exchange Master';
        $user = Auth::user();
        $search = @$request->input('search');

        if(empty($search))
         {
            $currency_exchange = CurrencyExchange::orderby('id','asc')->get();
            $exc_ids = response()->json($currency_exchange->modelKeys());
            $currency = Currency::orderby('id','asc')->get();

            // dd($country);
            return view('crm.master.exchange', compact(['route_active','exc_ids','currency','currency_exchange']));        
        }
        else
        {
            $currency_exchange = CurrencyExchange::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
            $exc_ids = response()->json($currency_exchange->modelKeys());
            $currency = Currency::orderby('id','asc')->get();

            return view('crm.master.currency', compact('user','currency_exchange','currency','route_active','exc_ids'))->with('i', ($request->input('page', 1) - 1) * 10);

        }

    }

    public function indexshiptype(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Ship Type Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $shiptype = ShipType::orderby('id','asc')->get();
            $shiptype_ids = response()->json($shiptype->modelKeys());
            $lastid = count($shiptype);

            if($lastid != null){
                // $code_st = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_st = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_st = '0000' . strval($lastid + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_st = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_st = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_st = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_st =  strval($lastid + 1);
                }
            }
            else{
                $code_st = '00000' . strval(1);
            }

            return view('crm.master.ship_type', compact(['route_active', 'shiptype','shiptype_ids','code_st']));  
         }
        else
        {
          $shiptype = ShipType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $shiptype_ids = response()->json($shiptype->modelKeys());
          return view('crm.master.ship_type', compact('user','shiptype','route_active','shiptype_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexclassification(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Classification Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");
        // dd($country);
        if(empty($search))
         {
            $classification = Classification::orderby('id','asc')->get();
            $classification_ids = response()->json($classification->modelKeys());
            $lastid = count($classification);

            if($lastid != null){
                // $code_cs = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_cs = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_cs = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_cs = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_cs = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_cs = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_cs =  strval($lastid + 1);
                }
                
                
            }
            else{
                $code_cs = '00000' . strval(1);
            }

            return view('crm.master.classification', compact(['route_active', 'code_cs','classification','classification_ids']));   
         }
        else
        {
          $classification = Classification::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $classification_ids = response()->json($classification->modelKeys());
          return view('crm.master.classification', compact('user','classification','route_active','classification_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexconstruction(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Construction Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $construction = Construction::orderby('id','asc')->get();
            $construction_ids = response()->json($construction->modelKeys());
            $lastid = count($construction);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_cr = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_cr = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_cr = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_cr = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_cr = '0' . strval($lastid + 1);
                }elseif($lastid > 99998){
                    $code_cr =  strval($lastid + 1);
                }

                
            }
            else{
                $code_cr = '00000' . strval(1);
            }
            return view('crm.master.construction', compact(['route_active','code_cr','construction','construction_ids']));   
         }
        else
        {
          $construction = Construction::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $construction_ids = response()->json($construction->modelKeys());
          return view('crm.master.construction', compact('user','construction','route_active','construction_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexmarinelookup(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Marine - Lookup Ship';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");
        $country = Country::orderby('id','asc')->get();
        $shiptype = ShipType::orderby('id','asc')->get();
        $classification = Classification::orderby('id','asc')->get();
        $construction = Construction::orderby('id','asc')->get();


        // dd($country);
        if(empty($search))
         {
            $mlu = MarineLookup::orderby('id','asc')->get();
            $mlu_ids = response()->json($mlu->modelKeys());
            $lastid = count($mlu);

            //$counter = (string)$lastid + 1;
            //while (strlen($counter) < 4) $counter = "0" . $counter;
            //$lastid = $counter;

            if($lastid != null)
            {
                // $code_mlu = $mydate . strval($lastid + 1);
                if($lastid <= 9){
                    $code_mlu = '00000' . strval($lastid + 1);
                }elseif($lastid > 9 && $lastid <= 99){
                    $code_mlu = '0000' . strval($lastid- + 1);
                }elseif($lastid > 99 && $lastid <= 999){
                    $code_mlu = '000' . strval($lastid + 1);
                }elseif($lastid > 999 && $lastid <= 9999){
                    $code_mlu = '00' . strval($lastid + 1);
                }elseif($lastid > 9999 && $lastid <= 99999){
                    $code_mlu = '0' . strval($lastid + 1);
                }elseif($lastid > 99999){
                    $code_mlu =  strval($lastid + 1);
                }
                
            }
            else{
                $code_mlu ='00000' . strval(1);
            }

            return view('crm.master.marine_lookup', compact(['user','country','shiptype','classification','construction','code_mlu','mlu','route_active','mlu_ids']));     
         
        }
        else
        {
          $mlu = MarineLookup::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $mlu_ids = response()->json($mlu->modelKeys());
          return view('crm.master.marine_lookup', compact('user','country','shiptype','classification','construction','mlu','route_active','mlu_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }


    public function indexpropertytype(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Property Type Master';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $propertytype = PropertyType::orderby('id','asc')->get();
            $propertytype_ids = response()->json($propertytype->modelKeys());
            $lastid = count($propertytype);

            if($lastid != null){
                $code_pt = $mydate . strval($lastid + 1);

                if($lastid <= 9){
                    $code_pt = '00000' . strval($lastid + 1);
                }elseif($lastid > 9 && $lastid <= 99){
                    $code_pt = '0000' . strval($lastid- + 1);
                }elseif($lastid > 99 && $lastid <= 999){
                    $code_pt = '000' . strval($lastid + 1);
                }elseif($lastid > 999 && $lastid <= 9999){
                    $code_pt = '00' . strval($lastid + 1);
                }elseif($lastid > 9999 && $lastid <= 99999){
                    $code_pt = '0' . strval($lastid + 1);
                }elseif($lastid > 99999 ){
                    $code_pt =  strval($lastid + 1);
                }
            }
            else{
                $code_pt = '00000' . strval(1);
            }

            return view('crm.master.property_type', compact(['route_active', 'propertytype','propertytype_ids','code_pt']));  
         }
        else
        {
          $propertytype = PropertyType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $propertytype_ids = response()->json($propertytype->modelKeys());
          return view('crm.master.property_type', compact('user','propertytype','route_active','propertytype_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexconditionneeded(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Condition Needed Master';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $cdn = ConditionNeeded::orderby('id','asc')->get();
            $cob = COB::orderby('id','asc')->get();
            $cdn_ids = response()->json($cdn->modelKeys());
            $lastid = count($cdn);

            if($lastid != null){
                // $code_cdn = $mydate . strval($lastid + 1);

                if($lastid <= 9){
                    $code_cdn = '00000' . strval($lastid + 1);
                }elseif($lastid > 9 && $lastid <= 99){
                    $code_cdn = '0000' . strval($lastid- + 1);
                }elseif($lastid > 99 && $lastid <= 999){
                    $code_cdn = '000' . strval($lastid + 1);
                }elseif($lastid > 999 && $lastid <= 9999){
                    $code_cdn = '00' . strval($lastid + 1);
                }elseif($lastid > 9999 && $lastid <= 99999){
                    $code_cdn = '0' . strval($lastid + 1);
                }elseif($lastid > 99999 ){
                    $code_cdn =  strval($lastid + 1);
                }

                
            }
            else{
                $code_cdn = '00000' . strval(1);
            }

            return view('crm.master.condition_needed', compact(['route_active', 'cob','cdn','cdn_ids','code_cdn']));  
         }
        else
        {
          $cdn = PropertyType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $cdn_ids = response()->json($cdn->modelKeys());
          return view('crm.master.condition_needed', compact('user','cdn','route_active','cdn_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexcompanytype(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Company Type Master';
        $search = @$request->input('search');
        $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $companytype = CompanyType::orderby('id','asc')->get();
            $companytype_ids = response()->json($companytype->modelKeys());
            $lastid = count($companytype);

            if($lastid != null){
                $code_ct = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_ct = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_ct = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_ct = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_ct = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_ct = '0' . strval($lastid + 1);
                }elseif($lastid > 99998){
                    $code_ct =  strval($lastid + 1);
                }
            }
            else{
                $code_ct ='00000' . strval(1);
            }

            return view('crm.master.companytype', compact(['route_active', 'companytype','companytype_ids','code_ct']));  
         }
        else
        {
          $companytype = CompanyType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $companytype_ids = response()->json($companytype->modelKeys());
          return view('crm.master.companytype', compact('user','companytype','route_active','companytype_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexinterestinsured(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Interest Insured Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $interestinsured = InterestInsured::orderby('id','asc')->get();
            $cob = COB::orderby('id','asc')->get();
            $interestinsured_ids = response()->json($interestinsured->modelKeys());
            $lastid = count($interestinsured);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_ii = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_ii = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_ii = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_ii = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_ii = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_ii =  strval($lastid + 1);
                }

                
            }
            else{
                $code_ii = '00000' . strval(1);
            }
            return view('crm.master.interest_insured', compact(['route_active','cob','code_ii','interestinsured','interestinsured_ids']));   
         }
        else
        {
          $interestinsured = InterestInsured::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $interestinsured_ids = response()->json($interestinsured->modelKeys());
          return view('crm.master.interest_insured', compact('user','interestinsured','route_active','interestinsured_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexdeductibletype(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Deductible Type Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $deductibletype = DeductibleType::orderby('id','asc')->get();
            $deductibletype_ids = response()->json($deductibletype->modelKeys());
            $lastid = count($deductibletype);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_dt = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_dt = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_dt = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_dt = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_dt = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_dt =  strval($lastid + 1);
                }

                
            }
            else{
                $code_dt = '00000' . strval(1);
            }
            return view('crm.master.deductible_type', compact(['route_active','code_dt','deductibletype','deductibletype_ids']));   
         }
        else
        {
          $deductibletype = DeductibleType::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $deductibletype_ids = response()->json($deductibletype->modelKeys());
          return view('crm.master.deductible_type', compact('user','deductibletype','route_active','deductibletype_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function indexextendedcoverage(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Extend Coverage Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $extendcoverage = ExtendedCoverage::orderby('id','asc')->get();
            $cob = COB::orderby('id','asc')->get();
            $extendcoverage_ids = response()->json($extendcoverage->modelKeys());
            $lastid = count($extendcoverage);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_ec = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_ec = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_ec = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_ec = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_ec = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_ec =  strval($lastid + 1);
                }

                
            }
            else{
                $code_ec = '00000' . strval(1);
            }
            return view('crm.master.extend_coverage', compact(['route_active','cob','code_ec','extendcoverage','extendcoverage_ids']));   
         }
        else
        {
          $extendcoverage = Construction::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $extendcoverage_ids = response()->json($extendcoverage->modelKeys());
          return view('crm.master.extend_coverage', compact('user','extendcoverage','route_active','extendcoverage_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }


    public function indexshipport(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Ship Port Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $shipport = ShipPort::orderby('id','asc')->get();
            $city = DB::table('cities')->whereBetween('state_id', [4121, 4154])->orWhereBetween('state_id', [3805, 3978])->get();
            // $city = DB::table('cities')->get();
            $country = Country::orderby('id','asc')->get();
            $shipport_ids = response()->json($shipport->modelKeys());
            $lastid = count($shipport);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_sp = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_sp = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_sp = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_sp = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_sp = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_sp =  strval($lastid + 1);
                }

                
            }
            else{
                $code_sp = '00000' . strval(1);
            }
            return view('crm.master.ship_port', compact(['route_active','country','city','code_sp','shipport','shipport_ids']));   
         }
        else
        {
          $shipport = ShipPort::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $shipport_ids = response()->json($shipport->modelKeys());
          return view('crm.master.ship_port', compact('user','shipport','route_active','shipport_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }



    public function indexrouteform(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Route Form Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $routeform = RouteShip::orderby('id','asc')->get();
            $shipport = ShipPort::orderby('id','asc')->get();
            $routeform_ids = response()->json($routeform->modelKeys());
            $lastid = count($routeform);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_rf = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_rf = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_rf = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_rf = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_rf = '0' . strval($lastid + 1);
                }elseif($lastid > 99998){
                    $code_rf =  strval($lastid + 1);
                }

                
            }
            else{
                $code_rf = '00000' . strval(1);
            }
            return view('crm.master.route_form', compact(['route_active','shipport','code_rf','routeform','routeform_ids']));   
         }
        else
        {
          $routeform = RouteShip::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $routeform_ids = response()->json($routeform->modelKeys());
          return view('crm.master.route_form', compact('user','routeform','route_active','routeform_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }



    public function indexprefixinsured(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Prefix Insured Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        // dd($country);
        if(empty($search))
         {
            $prefixinsured = PrefixInsured::orderby('id','asc')->get();
            // $cob = COB::orderby('id','asc')->get();
            $prefixinsured_ids = response()->json($prefixinsured->modelKeys());
            $lastid = count($prefixinsured);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_pi = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_pi = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_pi = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_pi = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_pi = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_pi =  strval($lastid + 1);
                }

                
            }
            else{
                $code_pi = '00000' . strval(1);
            }
            return view('crm.master.prefix_insured', compact(['route_active','code_pi','prefixinsured','prefixinsured_ids']));   
         }
        else
        {
          $prefixinsured = PrefixInsured::where('code', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
          $prefixinsured_ids = response()->json($interestinsured->modelKeys());
          return view('crm.master.prefix_insured', compact('user','prefixinsured','route_active','prefixinsured_ids'))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }


    public function indexinsuredmarinetype(Request $request)
    {
        $user = Auth::user();
        $route_active = 'Insured Marine Type Master';
        $search = @$request->input('search');
        // $mydate = date("Y").date("m").date("d");

        $insuredmarine = InsuredMarineType::orderby('id','asc')->get();
            $cob = COB::where('form','ms')->orderby('id','asc')->get();
            $insuredmarinetype_ids = response()->json($insuredmarine->modelKeys());
            $lastid = count($insuredmarine);

            if($lastid != null){
                // $code_cr = $mydate . strval($lastid + 1);

                if($lastid < 9){
                    $code_imt = '00000' . strval($lastid + 1);
                }elseif($lastid > 8 && $lastid < 99){
                    $code_imt = '0000' . strval($lastid- + 1);
                }elseif($lastid > 98 && $lastid < 999){
                    $code_imt = '000' . strval($lastid + 1);
                }elseif($lastid > 998 && $lastid < 9999){
                    $code_imt = '00' . strval($lastid + 1);
                }elseif($lastid > 9998 && $lastid < 99999){
                    $code_imt = '0' . strval($lastid + 1);
                }elseif($lastid > 99998 ){
                    $code_imt =  strval($lastid + 1);
                }

                
            }
            else{
                $code_imt = '00000' . strval(1);
            }
            return view('crm.master.insuredmarinetype', compact(['cob','route_active','code_imt','insuredmarine','insuredmarinetype_ids']));
    }


    public function generatecodecob(request $request)
    {
        $cob_parent = COB::where('id',$request->cob_code)->first();
        $cob = COB::where('parent_id',$request->cob_code)->orderby('id','desc')->get();
        $coblastparent = COB::where('parent_id',$request->cob_code)->orderby('id','desc')->first();
        $lastid = count($cob);
        
        if(!$coblastparent){
            $code_cob =  $cob_parent->code . '0' . strval(0);

            return response()->json(
                [
                    'autocode' => $code_cob
                ]
            );
        }
        else{
            
            $parentlastcode = substr($coblastparent->code,2) ;
            // $sumlastcode = strval($parentlastcode + 1);

                if($parentlastcode < 9){
                    $code_cob = $cob_parent->code . '0' . strval($parentlastcode + 1);

                    return response()->json(
                        [
                            'autocode' => $code_cob
                        ]
                    );
                }elseif($parentlastcode > 8 && $parentlastcode < 100){
                    $code_cob = $cob_parent->code . strval($parentlastcode + 1);

                    return response()->json(
                        [
                            'autocode' => $code_cob
                        ]
                    );
                }
        }
       

          
    }

    public function generatecodeocp(request $request)
    {
        $ocp_parent = Occupation::where('id',$request->ocp_code)->first();
        $ocp = Occupation::where('parent_id',$request->ocp_code)->orderby('id','desc')->get();
        $ocplastparent = Occupation::where('parent_id',$request->ocp_code)->orderby('id','desc')->first();
        $lastid = count($ocp);

        
        if(!$ocplastparent){
            $code_ocp =  $ocp_parent->code . '0' . strval(0);

            return response()->json(
                [
                    'autocode' => $code_ocp
                ]
            );
        }
        else{
            
            $parentlastcode = substr($ocplastparent->code,2) ;
            $sumlastcode = strval($parentlastcode + 1);

                if($parentlastcode < 9){
                    $code_ocp = $ocp_parent->code . '0' . strval($parentlastcode + 1);

                    return response()->json(
                        [
                            'autocode' => $code_ocp
                        ]
                    );
                }elseif($parentlastcode > 8 && $parentlastcode < 100){
                    $code_ocp = $ocp_parent->code . strval($parentlastcode + 1);

                    return response()->json(
                        [
                            'autocode' => $code_ocp
                        ]
                    );
                }
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
    public function storecountry(Request $request)
    {
        $validator = $request->validate([
            'countryname'=>'required',
            'countrycode'=>'required|max:3',
            'continent'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            Country::create([
                'name'=>$request->countryname,
                'code'=>$request->countrycode,
                'continent'=>$request->continent
            ]);
            $notification = array(
                'message' => 'Country added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storecob(Request $request)
    {
        $validator = $request->validate([
            'cobcode'=>'required|max:15|unique:cob,code',
            'cobdescription'=>'required',
            'cobabbreviation'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            COB::create([
                'code'=>$request->cobcode,
                'description'=>$request->cobdescription,
                'abbreviation'=>$request->cobabbreviation,
                'parent_id'=>$request->parent_id,
                'remarks'=>$request->cobremarks,
            ]);
            $notification = array(
                'message' => 'COB added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }
    public function storebt(Request $request)
    {
        $validator = $request->validate([
            'code'=>'required|max:15|unique:business_types,code',
            'name'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            BusinessType::create([
                'code'=>$request->code,
                'name'=>$request->name
            ]);
            $notification = array(
                'message' => 'Business Type added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }


    public function storeoccupation(Request $request)
    {
        $validator = $request->validate([
            'ocpcode'=>'required|max:35|unique:occupation,code'
        ]);

        // dd($request);
        if($validator){
            $user = Auth::user();
            Occupation::create([
                'code'=>$request->ocpcode,
                'description'=>$request->ocpdescription,
                'abbreviation'=>$request->ocpabbreviation,
                'group_type'=>$request->ocpgrouptype,
                'parent_id'=>$request->parent_id,
                'cob'=>$request->ocpcob,
                'rate_batas_bawah_building_class_1'=>$request->ocprrbc1,
                'rate_batas_bawah_building_class_2'=>$request->ocprrbc2,
                'rate_batas_bawah_building_class_3'=>$request->ocprrbc3,
                'rate_batas_atas_building_class_1'=>$request->ocprrac1,
                'rate_batas_atas_building_class_2'=>$request->ocprrac2,
                'rate_batas_atas_building_class_3'=>$request->ocprrac3
                
            ]);
            $notification = array(
                'message' => 'Occupation added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }


    public function storecurrency(Request $request)
    {
        $validator = $request->validate([
            'crccode'=>'required|max:5|unique:currencies,code',
            'crcsymbolname'=>'required',
            'crccountry'=>'required|unique:currencies,country'
        ]);
        if($validator){
            $user = Auth::user();
            Currency::create([
                'symbol_name'=>$request->crcsymbolname,
                'is_base_currency' => '',
                'code'=>$request->crccode,
                'country'=>$request->crccountry
            ]);
            $notification = array(
                'message' => 'Currency added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }


    public function storeexchange(Request $request)
    {
        $validator = $request->validate([
            'exccurrency'=>'required|max:5',
            'excmonth'=>'required',
            'excyear'=>'required',
            'exckurs'=>'required'
        ]);

        if($validator){

            $checkcrrexc = CurrencyExchange::where('currency',$request->exccurrency)->where('month',$request->excmonth)->where('year',$request->excyear)->get();
            $count_chk = count($checkcrrexc);

            if($count_chk > 0){
                $notification = array(
                    'message' => 'Currency, Month, And year cannot exactly same!',
                    'alert-type' => 'failed'
                );
                return back()->with($notification);                
            }else{
                $user = Auth::user();
                CurrencyExchange::create([
                    'currency'=>$request->exccurrency,
                    'month' => $request->excmonth,
                    'year'=>$request->excyear,
                    'kurs'=>$request->exckurs
                ]);
                $notification = array(
                    'message' => 'Currency Exchange added successfully!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);    
            }
        }else{
            return back()->with($validator)->withInput();
        }
        
    }

    public function storeshiptype(Request $request)
    {
        $validator = $request->validate([
            'stcode'=>'required|max:12|unique:ship_type,code',
            'stname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            ShipType::create([
                'code'=>$request->stcode,
                'name' => $request->stname
            ]);
            $notification = array(
                'message' => 'Ship Type added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeclassification(Request $request)
    {
        $validator = $request->validate([
            'cscode'=>'required|max:12|unique:classification,code',
            'csname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            Classification::create([
                'code'=>$request->cscode,
                'name' => $request->csname
            ]);
            $notification = array(
                'message' => 'Classification data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeconstruction(Request $request)
    {
        $validator = $request->validate([
            'crcode'=>'required|max:12|unique:construction,code',
            'crname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            Construction::create([
                'code'=>$request->crcode,
                'name' => $request->crname
            ]);
            $notification = array(
                'message' => 'Construction Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }


    public function storemarinelookup(Request $request)
    {
        $validator = $request->validate([
            'mlucode'=>'required|max:12|unique:marine_lookup,code',
            'mlushipname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            MarineLookup::create([
                'code'=>$request->mlucode,
                'shipname' => $request->mlushipname,
                'owner' => $request->mluowner,
                'grt' => $request->mlugrt,
                'dwt' => $request->mludwt,
                'nrt' => $request->mlunrt,
                'power' => $request->mlupower,
                'ship_year' => $request->mlushipyear,
                'repair_year' => $request->mlurepairyear,
                'galangan' => $request->mlugalangan,
                'ship_type' => $request->mlushiptype,
                'classification' => $request->mluclassification,
                'construction' => $request->mluconstruction,
                'country' => $request->mlucountry,

            ]);
            $notification = array(
                'message' => 'Marine Lookup added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storepropertytype(Request $request)
    {
        $validator = $request->validate([
            'ptcode'=>'required|max:12|unique:property_type,code',
            'ptname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            PropertyType::create([
                'code'=>$request->ptcode,
                'name' => $request->ptname
            ]);
            $notification = array(
                'message' => 'Property Type added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeconditionneeded(Request $request)
    {
        $validator = $request->validate([
            'cdncode'=>'required|max:12|unique:condition_needed,code',
            'cdnname'=>'required',
            'cdncob'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            ConditionNeeded::create([
                'code'=>$request->cdncode,
                'name' => $request->cdnname,
                'description' => $request->cdndescription,
                'cob_id' => $request->cdncob
            ]);
            $notification = array(
                'message' => 'Condition Needed Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storecompanytype(Request $request)
    {
        $validator = $request->validate([
            'ctcode'=>'required|max:12|unique:company_type,code',
            'ctname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            CompanyType::create([
                'code'=>$request->ctcode,
                'name' => $request->ctname
            ]);
            $notification = array(
                'message' => 'Company Type added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeinterestinsured(Request $request)
    {
        $validator = $request->validate([
            'iicode'=>'required|max:12|unique:interest_insured,code',
            'iidescription'=>'required',
            'iicob'=>'required',
        ]);
        if($validator){
            $user = Auth::user();
            InterestInsured::create([
                'code'=>$request->iicode,
                'description' => $request->iidescription,
                'cob_id' => $request->iicob
            ]);
            $notification = array(
                'message' => 'Interest Insured Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storedeductibletype(Request $request)
    {
        $validator = $request->validate([
            'dtcode'=>'required|max:12|unique:deductible_type,code',
            'dtabbreviation'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            DeductibleType::create([
                'code'=>$request->dtcode,
                'abbreviation' => $request->dtabbreviation,
                'description' => $request->dtdescription
            ]);
            $notification = array(
                'message' => 'Deductible Type Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeextendedcoverage(Request $request)
    {
        $validator = $request->validate([
            'eccode'=>'required|max:12|unique:extended_coverage,code',
            'ecname'=>'required',
        ]);
        if($validator){
            $user = Auth::user();
            ExtendedCoverage::create([
                'code'=>$request->eccode,
                'name' => $request->ecname,
                'description' => $request->ecdescription,
                'cob_id' => $request->eccob
            ]);
            $notification = array(
                'message' => 'Extend Coverage Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeshipport(Request $request)
    {
        $validator = $request->validate([
            'spcode'=>'required|max:16|unique:ship_port,code',
            'spname'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            ShipPort::create([
                'code'=>$request->spcode,
                'name' => $request->spname,
                'description' => $request->spdescription,
                'city_id' => $request->spcity
            ]);
            $notification = array(
                'message' => 'Ship Port Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storerouteform(Request $request)
    {
        $validator = $request->validate([
            'rfcode'=>'required|max:12|unique:route,code',
            'rfname'=>'required',
            'rffrom'=>'required',
            'rfto'=>'required'
        ]);
        if($validator){
            $user = Auth::user();
            RouteShip::create([
                'code'=>$request->rfcode,
                'name' => $request->rfname,
                'description' => $request->rfdescription,
                'from' => $request->rffrom,
                'to' => $request->rfto,
                'transit_1' => $request->rftransit,
                'transit_2' => $request->rftransit2,
            ]);
            $notification = array(
                'message' => 'Route Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeprefixinsured(Request $request)
    {
        $validator = $request->validate([
            'picode'=>'required|max:15|unique:prefix_insured,code',
            'piname'=>'required',
        ]);
        if($validator){
            $user = Auth::user();
            PrefixInsured::create([
                'code'=>$request->picode,
                'name' => $request->piname
            ]);
            $notification = array(
                'message' => 'Prefix Insured Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function storeinsuredmarinetype(Request $request)
    {
        $validator = $request->validate([
            'imtcode'=>'required|max:15|unique:insured_marine_type,code',
            'imtname'=>'required',
        ]);
        if($validator){
            $user = Auth::user();
            InsuredMarineType::create([
                'code'=>$request->imtcode,
                'type' => $request->imtname,
                'keterangan' => $request->imtdescription,
                'cob' => $request->imtcob,
                'group_type' => $request->imtgrouptype
            ]);
            $notification = array(
                'message' => 'Insured Marine Type Data added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function getCityList()
    {
        $cities = DB::table("cities")
        ->orderBy('name')
        ->get()
        ->pluck("name","id");
        return response()->json($cities);
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
    public function updatecountry(Request $request, Country $country)
    {
        $validator = $request->validate([
            'namecountry'=>'required',
            'codecountry'=>'required|max:3',
            'continentcountry'=>'required'
        ]);
        if($validator){
            $country->name = $request->namecountry;
            $country->code = $request->codecountry;
            $country->continent = $request->continentcountry;
            $country->save();
            $notification = array(
                'message' => 'Country updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function updatecob(Request $request, COB $cob)
    {
        $validator = $request->validate([
            'codecob'=>'max:20',
            'descriptioncob'=>'required',
            'abbreviationcob'=>'required'
        ]);
        if($validator){
            $cob->code = $request->codecob;
            $cob->description = $request->descriptioncob;
            $cob->abbreviation = $request->abbreviationcob;
            $cob->parent_id = $request->parent_id;
            $cob->remarks = $request->remarkscob;
            $cob->save();
            $notification = array(
                'message' => 'COB updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }
    public function updatebt(Request $request, BusinessType $bt)
    {
        $validator = $request->validate([
            'name'=>'required'
        ]);
        if($validator){
            $bt->name = $request->name;
            $bt->save();
            $notification = array(
                'message' => 'Business Type updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

    public function updateoccupation(Request $request, Occupation $ocp)
    {
        $validator = $request->validate([
            'codeocp'=>'required|max:40'
        ]);
        if($validator){
            $ocp->code = $request->codeocp;
            $ocp->description = $request->descriptionocp;
            $ocp->abbreviation = $request->abbreviationocp;
            $ocp->group_type = $request->grouptypeocp;
            $ocp->parent_id = $request->parent_id;
            $ocp->rate_batas_bawah_building_class_1 = $request->rrbc1ocp;
            $ocp->rate_batas_bawah_building_class_2 = $request->rrbc2ocp;
            $ocp->rate_batas_bawah_building_class_3 = $request->rrbc3ocp;
            $ocp->rate_batas_atas_building_class_1  = $request->rrac1ocp;
            $ocp->rate_batas_atas_building_class_2  = $request->rrac2ocp;
            $ocp->rate_batas_atas_building_class_3  = $request->rrac3ocp;
            $ocp->cob = $request->cobocp;
            $ocp->save();
            $notification = array(
                'message' => 'Occupation updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    }

   public function updatecurrency(Request $request, Currency $crc)
   {
    
    $validator = $request->validate([
        'codecrc'=>'required|max:5',
        'symbolnamecrc'=>'required',
        'countrycrc'=>'required'
    ]);
    
    if($validator){
        $crc->symbol_name = $request->symbolnamecrc;
        $crc->code = $request->codecrc;
        $crc->country = $request->countrycrc;
        $crc->save();
        $notification = array(
            'message' => 'Currency updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
   }

   public function updateexchange(Request $request, CurrencyExchange $exc)
   {
    
    $validator = $request->validate([
        'currencyexc'=>'required|max:5',
            'monthexc'=>'required',
            'yearexc'=>'required',
            'kursexc'=>'required'
    ]);
    
    if($validator){
        $exc->currency = $request->currencyexc;
        $exc->month = $request->monthexc;
        $exc->year = $request->yearexc;
        $exc->kurs = $request->kursexc;
        $exc->save();
        $notification = array(
            'message' => 'Currency updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
   }

   public function updateshiptype(Request $request, ShipType $st)
   {
    
        $validator = $request->validate([
            'codest'=>'required|max:12',
                'namest'=>'required'
        ]);
        
        if($validator){
            $st->code = $request->codest;
            $st->name = $request->namest;
            $st->save();
            $notification = array(
                'message' => 'Ship Type updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }

   }

   public function updateclassification(Request $request, Classification $cs)
   {
    
    $validator = $request->validate([
        'codecs'=>'required|max:12',
            'namecs'=>'required'
    ]);
    
    if($validator){
        $cs->code = $request->codecs;
        $cs->name = $request->namecs;
        $cs->save();
        $notification = array(
            'message' => 'Classification updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updateconstruction(Request $request, Construction $cr)
   {
    
    $validator = $request->validate([
        'codecr'=>'required|max:12',
            'namecr'=>'required'
    ]);
    
    if($validator){
        $cr->code = $request->codecr;
        $cr->name = $request->namecr;
        $cr->save();
        $notification = array(
            'message' => 'Construction updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updatemarinelookup(Request $request, MarineLookup $mlu)
   {
    
    $validator = $request->validate([
        'codemlu'=>'required|max:5',
            'shipnamemlu'=>'required'
    ]);
    
    if($validator){
        $mlu->code = $request->codemlu;
        $mlu->shipname = $request->shipnamemlu;
        $mlu->owner = $request->ownermlu;
        $mlu->grt = $request->grtmlu;
        $mlu->dwt = $request->dwtmlu;
        $mlu->nrt = $request->nrtmlu;
        $mlu->power = $request->powermlu;
        $mlu->ship_year = $request->ship_yearmlu;
        $mlu->repair_year = $request->repair_yearmlu;
        $mlu->galangan = $request->galanganmlu;
        $mlu->ship_type = $request->ship_typemlu;
        $mlu->classification = $request->classificationmlu;
        $mlu->construction = $request->constructionmlu;
        $mlu->save();
        $notification = array(
            'message' => 'Marine lookup data updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }


   public function updatepropertytype(Request $request, PropertyType $pt)
   {
    
        $validator = $request->validate([
            'codept'=>'required|max:12,unique:property_type,code',
                'namept'=>'required'
        ]);
        
        if($validator){
            $pt->code = $request->codept;
            $pt->name = $request->namept;
            $pt->save();
            $notification = array(
                'message' => 'Property Type Data updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }

   }

   public function updateconditionneeded(Request $request, ConditionNeeded $cdn)
   {
    
        $validator = $request->validate([
            'codecdn'=>'required|max:12,unique:condition_needed,code',
            'namecdn'=>'required',
            'cobcdn'=>'required',
        ]);
        
        if($validator){
            $cdn->code = $request->codecdn;
            $cdn->name = $request->namecdn;
            $cdn->description = $request->descriptioncdn;
            $cdn->cob_id = $request->cobcdn;
            $cdn->save();
            $notification = array(
                'message' => 'Condition Needed Data updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }

   }

   public function updatecompanytype(Request $request, CompanyType $ct)
   {
    
        $validator = $request->validate([
            'codect'=>'required|max:12,unique:company_type,code',
                'namect'=>'required'
        ]);
        
        if($validator){
            $ct->code = $request->codect;
            $ct->name = $request->namect;
            $ct->save();
            $notification = array(
                'message' => 'Company Type Data updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }

   }

   public function updateinterestinsured(Request $request, InterestInsured $ii)
   {
    
    $validator = $request->validate([
        'codeii'=>'required|max:12',
            'descriptionii'=>'required',
            'cobii'=>'required'

    ]);
    
    if($validator){
        $ii->code = $request->codeii;
        $ii->description = $request->descriptionii;
        $ii->cob_id = $request->cobii;
        $ii->save();
        $notification = array(
            'message' => 'Interest Insured updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updatedeductibletype(Request $request, DeductibleType $dt)
   {
    
    $validator = $request->validate([
        'codedt'=>'required|max:12',
        'abbreviationdt'=>'required'
    ]);
    
    if($validator){
        $dt->code = $request->codedt;
        $dt->abbreviation = $request->abbreviationdt;
        $dt->description = $request->descriptiondt;
        $dt->save();
        $notification = array(
            'message' => 'Deductible Type updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updateextendedcoverage(Request $request, ExtendedCoverage $ec)
   {
    
    $validator = $request->validate([
        'codeec'=>'required|max:12',
        'nameec'=>'required',
        'cobec'=>'required'
    ]);
    
    if($validator){
        $ec->code = $request->codeec;
        $ec->name = $request->nameec;
        $ec->description = $request->descriptionec;
        $ec->cob = $request->cobec;
        $ec->save();
        $notification = array(
            'message' => 'Extend Coverage updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updateshipport(Request $request, ShipPort $sp)
   {
    
        $validator = $request->validate([
            'codesp'=>'required|max:16',
            'namesp'=>'required'
        ]);
        
        if($validator){
            $sp->code = $request->codesp;
            $sp->name = $request->namesp;
            $sp->description = $request->descriptionsp;
            $sp->city_id = $request->citysp;
            $sp->save();
            $notification = array(
                'message' => 'Ship Port updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    
   }

   public function updaterouteform(Request $request, RouteShip $rf)
   {
    
    $validator = $request->validate([
        'coderf'=>'required|max:12',
        'namerf'=>'required',
        'fromrf'=>'required',
        'torf'=>'required',
    ]);
    
    if($validator){
        $rf->code = $request->coderf;
        $rf->name = $request->namerf;
        $rf->description = $request->descriptionrf;
        $rf->from = $request->fromrf;
        $rf->to = $request->torf;
        $rf->transit_1 = $request->transitrf;
        $rf->transit_2 = $request->transit2rf;
        $rf->save();
        $notification = array(
            'message' => 'Route updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }else{
        return back()->with($validator)->withInput();
    }
    
   }

   public function updateprefixinsured(Request $request, PrefixInsured $pi)
   {
    
        $validator = $request->validate([
            'codepi'=>'required|max:15',
            'namepi'=>'required'

        ]);
        
        if($validator){
            $pi->code = $request->codepi;
            $pi->name = $request->namepi;
            $pi->save();
            $notification = array(
                'message' => 'Prefix Insured updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    
   }

   public function updateinsuredmarinetype(Request $request, InsuredMarineType $imt)
   {
    
        $validator = $request->validate([
            'codeimt'=>'required|max:15',
            'nameimt'=>'required'

        ]);
        
        if($validator){
            $imt->code = $request->codeimt;
            $imt->type = $request->nameimt;
            $imt->keterangan = $request->descriptionimt;
            $imt->cob = $request->cobimt;
            $imt->group_type = $request->grouptypeimt;
            $imt->save();
            $notification = array(
                'message' => 'Insured Marine Type updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with($validator)->withInput();
        }
    
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroycountry(Country $country)
    {
        if($country->delete()){
            $notification = array(
                'message' => 'Country deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }


    public function destroycob(COB $cob)
    {
        if($cob->delete()){
            $notification = array(
                'message' => 'COB deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
    public function destroybt(BusinessType $bt)
    {
        if($bt->delete()){
            $notification = array(
                'message' => 'Business Type deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyoccupation(Occupation $ocp)
    {
        if($ocp->delete()){
            $notification = array(
                'message' => 'Occupation deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroycurrency(Currency $crc)
    {
        if($crc->delete()){
            $notification = array(
                'message' => 'Currency deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyExchange(CurrencyExchange $exc)
    {
        if($exc->delete()){
            $notification = array(
                'message' => 'Currency Exchange deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyshiptype(ShipType $st)
    {
        if($st->delete()){
            $notification = array(
                'message' => 'Ship Type deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyclassification(Classification $cs)
    {
        if($cs->delete()){
            $notification = array(
                'message' => 'Classification Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyconstruction(Construction $cr)
    {
        if($cr->delete()){
            $notification = array(
                'message' => 'Construction deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroymarinelookup(MarineLookup $mlu)
    {
        if($mlu->delete()){
            $notification = array(
                'message' => 'Marine Lookup Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroypropertytype(PropertyType $pt)
    {
        if($pt->delete()){
            $notification = array(
                'message' => 'Property Type Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyconditionneeded(ConditionNeeded $cdn)
    {
        if($cdn->delete()){
            $notification = array(
                'message' => 'Condition Needed Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroycompanytype(CompanyType $ct)
    {
        if($ct->delete()){
            $notification = array(
                'message' => 'Company Type Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyinterestinsured(InterestInsured $ii)
    {
        if($ii->delete()){
            $notification = array(
                'message' => 'Interest Insured Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyinsuredmarinetype(InsuredMarineType $imt)
    {
        if($imt->delete()){
            $notification = array(
                'message' => 'Insured Marine Type Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroydeductibletype(Construction $dt)
    {
        if($dt->delete()){
            $notification = array(
                'message' => 'Deductible Type deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyextendedcoverage(ExtendedCoverage $ec)
    {
        if($ec->delete()){
            $notification = array(
                'message' => 'Extend Coverage Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyshipport(ShipPort $sp)
    {
        if($sp->delete()){
            $notification = array(
                'message' => 'Ship Port deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyrouteform(RouteShip $rf)
    {
        if($rf->delete()){
            $notification = array(
                'message' => 'Route Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function destroyprefixinsured(PrefixInsured $pi)
    {
        if($pi->delete()){
            $notification = array(
                'message' => 'Prefix Insured  Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Contact admin! Delete error',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }



}
