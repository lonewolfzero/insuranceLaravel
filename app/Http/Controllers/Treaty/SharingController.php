<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurrencyExchange;
use App\Models\Currency;
use App\Models\Treaty\NonProp\SharingMindep;
use App\Models\Treaty\NonProp\TransferMindep;
use Illuminate\Support\Facades\Auth;

class SharingController extends Controller
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
            'number' => 'required',
            'ceding_id' => 'required'
        ]);

        if($validator) 
        {
            $user = Auth::user();

            $sharingdata = SharingMindep::where('number', $request->number)->first();

            if(empty($sharingdata)) 
            {

                $posdate =  $request->doc_date;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));

                $sharingdataup = SharingMindep::create([
                    'date_production' => $request->date_production,
                    'number' => $request->number,
                    'ceding_id' => $request->ceding_id,
                    'doc_date' => $newposDate,
                    'uwyear' => $request->uwyear,
                    'doc_number'=> $request->doc_number,
                    'acc_year' => $request->acc_year,
                    'currency_id' => $request->currency_id,
                    'remarks' => $request->remarks,
                    'share' => $request->share,
                    'mindep' => $request->mindep,
                    'nilai' => $request->nilai,
                    'broker_id' => $request->broker_id,
                    'status' => 'active'
                ]);

                $sharingdataup = SharingMindep::where('number', $request->number)->orderby('id', 'desc')->first();
                $sharingdataup->status = 'active';
                $sharingdataup->save();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Profit Sharing Update successfully!',
                    ]
                );

            } 
            else 
            {
                $posdate =  $request->doc_date;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));


                $sharingdataid = $sharingdata->id;
                $sharingdata = SharingMindep::findOrFail($sharingdataid);
                $sharingdata->date_production = $request->date_production;
                $sharingdata->number = $request->number;
                $sharingdata->ceding_id = $request->ceding_id;
                $sharingdata->doc_date = $newposDate;
                
                $sharingdata->uwyear = $request->uwyear;
                $sharingdata->doc_number = $request->doc_number;
                $sharingdata->acc_year = $request->acc_year;
                $sharingdata->currency_id = $request->currency_id;
                $sharingdata->currency_name = $request->currency_name;
                $sharingdata->remarks = $request->remarks;
                $sharingdata->share = $request->share;
                $sharingdata->mindep = $request->mindep;
                $sharingdata->nilai = $request->nilai;
                $sharingdata->broker_id = $request->broker_id;
                $sharingdata->save();

                
                $sharingdataup = SharingMindep::where('number', $request->number)->orderby('id', 'desc')->first();
                $sharingdataup->status = 'active';
                
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Profit Sharing  Update successfully !!!',
                    ]
                );
            }
        } 
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Profit Sharing Entry added Failed!',
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


    public function list(Request $request)
    {
        $route_active = 'TREATY | Profit Sharing - List';
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

            $query = SharingMindep::query();

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


            // $accu = SharingMindep::all();
            $sharingdata = $query->get();

            $sharingdata_ids = response()->json($sharingdata->modelKeys());
        } else {
            $sharingdata = SharingMindep::all();
        }

        return view('crm.transaction.treaty.sharing.list', compact(
            'route_active',
            'sharingdata',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }

    public function entry(Request $request)
    {

        if(!empty($request->id)) 
        {
            $sharingdata = SharingMindep::where('id', base64_decode($request->id))->first();
        }

        $route_active = 'TREATY | Profit Sharing - Entry';
        $koc = Koc::all();
        $cob = COB::all();

        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $sharing_now = SharingMindep::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
        $lastid = count($sharing_now);

        if ($lastid != null) 
        {
            if ($lastid < 9) {
                $code_ms = "SHARING" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "SHARING" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "SHARING" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "SHARING" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "SHARING" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "SHARING" . $mydate . "0000" . strval(1);
        }


          
        $datatest=SharingMindep::where('number','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "SHARING" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "SHARING" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "SHARING" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "SHARING" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "SHARING" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "SHARING" . $mydate . "0000" . strval(1);
            }
        }


        
        $datatest=SharingMindep::where('number','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "SHARING" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "SHARING" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "SHARING" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "SHARING" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "SHARING" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "SHARING" . $mydate . "0000" . strval(1);
            }

        }

        $currencies = Currencies::all();
        $ceding = CedingBroker::all();

        if(empty($sharingdata)) 
        {
            return view('crm.transaction.treaty.sharing.entry', compact(
                'route_active',
                'code_ms',
                'koc',
                'cob',
                'currencies',
                'ceding',
            ));
        }
        else if(!empty($sharingdata)) 
        {
            return view('crm.transaction.treaty.sharing.entry', compact(
                'route_active',
                'sharingdata',
                'code_ms',
                'koc',
                'cob',
                'currencies',
                'ceding',
            ));
        }

    }


    public function destroy($id)
    {
        $sharing = SharingMindep::findOrFail($id);

        if ($sharing->delete()) 
        {
            $notification = array(
                'message' => 'Sharing Mindep deleted successfully!',
                'alert-type' => 'success'
            );

            //return back()->with($notification);
            return redirect('treaty/sharing/list')->with('message', 'Sharing Mindep deleted successfully!');
        } 
        else 
        {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );

            //return back()->with($notification);
            return redirect('treaty/sharing/list')->with('message', 'Error Contact Admin');
        }
    }

    
}
