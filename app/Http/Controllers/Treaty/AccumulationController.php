<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use App\Models\Treaty\acc\Accumulation;
use App\Models\Treaty\acc\AccTableFile;
use App\Models\CurrencyExchange;
use App\Models\Currency;
use App\Models\Treaty\acc\Portofolio;
use Illuminate\Http\Request;
use App\Models\EarthQuakeZone;
use App\Models\Treaty\Prop\Prop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AccumulationController extends Controller
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
        //
        $validator = $request->validate([
            'userid' => 'required',
            'formid' => 'required'
        ]);

        if ($validator) {
            $user = Auth::user();

            $accdata = Accumulation::where('number', $request->formid)->first();

            if (empty($accdata)) {

                $posdate =  $request->position;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));

                $accdataup = Accumulation::create([
                    'date_prod' => $request->dateprod,
                    'user_id' => $request->userid,
                    'number' => $request->formid,
                    'type' => $request->type,
                    'subtype' => $request->subtype,
                    'position' => $newposDate,
                    'uw' => $request->uwyear,
                    'broker_id' => $request->cedingbroker,
                    'ceding_id' => $request->cedingsource,
                    'currency_id' => $request->currency,
                    'cob_id' => $request->cedingcob,
                    'koc_id' => $request->cedingkoc,
                    'zonenumber_id' => $request->zonenumber,
                    'state_id' => $request->statecode,
                    'state_code' => $request->statecode,
                    'buildings_percentage' => $request->buildingpercentage,
                    'buildings_amount' => $request->buildingamount,
                    'machineries_percentage' => $request->machineriespercentage,
                    'machineries_amount' => $request->machineriesamount,
                    'stoks_percentage' => $request->stokspercentage,
                    'stoks_amount' => $request->stoksamount,
                    'loss_percentage' => $request->losspercentage,
                    'loss_amount' => $request->lossamount,
                    'contents_percentage' => $request->contentspercentage,
                    'contents_amount' => $request->contentsamount,
                    'total_percentage' => $request->totalpercentage,
                    'total_amount' => $request->totalamount,
                    'status' => 'active',
                    'typeacc' => "1"

                ]);

                $accdataup = Accumulation::where('number', $request->formid)->orderby('id', 'desc')->first();
                $accdataup->status = 'active';
                $accdataup->save();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Accumulation Upload Update successfully!, but tsi changed. Must Change!!!',
                    ]
                );
            } else {
                $posdate =  $request->position;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));


                $accuid = $accdata->id;
                $accudata = Accumulation::findOrFail($accuid);
                $accudata->date_prod = $request->dateprod;
                $accudata->user_id = $request->userid;
                $accudata->number = $request->formid;
                $accudata->type = $request->type;
                $accudata->subtype = $request->subtype;
                $accudata->position = $newposDate;
                $accudata->uw = $request->uwyear;
                $accudata->broker_id = $request->cedingbroker;
                $accudata->ceding_id = $request->cedingsource;
                $accudata->currency_id = $request->currency;
                $accudata->cob_id = $request->cedingcob;
                $accudata->koc_id = $request->cedingkoc;
                $accudata->zonenumber_id = $request->zonenumber;
                $accudata->state_id = $request->statecode;
                $accudata->buildings_percentage = $request->buildingpercentage;
                $accudata->buildings_amount = $request->buildingamount;

                $accudata->machineries_percentage = $request->machineriespercentage;
                $accudata->machineries_amount = $request->machineriesamount;

                $accudata->stoks_percentage = $request->stokspercentage;
                $accudata->stoks_amount = $request->stoksamount;

                $accudata->loss_percentage = $request->losspercentage;
                $accudata->loss_amount = $request->lossamount;

                $accudata->contents_percentage = $request->contentspercentage;
                $accudata->contents_amount = $request->contentsamount;

                $accudata->total_percentage = $request->totalpercentage;
                $accudata->total_amount = $request->totalamount;

                $accudata->save();

                $accdataup = Accumulation::where('number', $request->formid)->orderby('id', 'desc')->first();
                $accdataup->status = 'active';
                //$accdataup->save();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Accumulation Upload Update successfully!, but tsi changed. Must Change!!!',
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Accumulation Entry added Failed!',
                ]
            );
            //return back()->with($validator)->withInput();

        }
    }


    public function storeupload(Request $request)
    {
        //
        $validator = $request->validate([
            'userid' => 'required',
            'dateprod' => 'required'
        ]);

        if ($validator) {
            $user = Auth::user();

            $accdata = Accumulation::where('number', $request->formid)->first();

            if (empty($accdata)) {
                $posdate =  $request->position;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));


                $dateofdoc =  $request->dateofdoc;
                $date2 = str_replace('/', '-', $dateofdoc);
                $newdateofdoc = date('Y-m-d', strtotime($date2));


                $accdataup = Accumulation::create([
                    'date_prod' => $request->dateprod,
                    'user_id' => $request->userid,
                    'number' => $request->formid,
                    'type' => $request->type,
                    'subtype' => $request->subtype,
                    'position' => $newposDate,
                    'uw' => $request->uwyear,
                    'treaty_id' => $request->treatydata,
                    'broker_id' => $request->cedingbroker,
                    'ceding_id' => $request->cedingsource,
                    'cob_id' => $request->cedingcob,
                    'koc_id' => $request->cedingkoc,
                    'dateofdoc' => $newdateofdoc,
                    'state_id' => $request->statecode,
                    'status' => 'active',
                    'typeacc' => "2"
                ]);

                $accdataup = Accumulation::where('number', $request->formid)->orderby('id', 'desc')->first();
                $accdataup->status = 'active';
                $accdataup->save();


                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Accumulation Upload Update successfully!, but tsi changed. Must Change!!!',
                    ]
                );
            } else {

                $posdate =  $request->position;
                $newposDate = date("Y-m-d", strtotime($posdate));

                $dateofdoc =  $request->dateofdoc;
                $newdateofdoc = date("Y-m-d", strtotime($dateofdoc));

                $accuid = $accdata->id;
                $accudata = Accumulation::findOrFail($accuid);
                $accudata->date_prod = $request->dateprod;
                $accudata->type = $request->type;
                $accudata->subtype = $request->subtype;
                $accudata->user_id = $request->userid;
                $accudata->position = $newposDate;
                $accudata->uw = $request->uwyear;
                $accudata->treaty_id = $request->treatydata;
                $accudata->broker_id = $request->cedingbroker;
                $accudata->ceding_id = $request->cedingsource;
                $accudata->cob_id = $request->cedingcob;
                $accudata->koc_id = $request->cedingkoc;
                $accudata->dateofdoc = $newdateofdoc;
                $accudata->state_id = $request->statecode;

                $accudata->save();

                $accdataup = Accumulation::where('number', $request->formid)->orderby('id', 'desc')->first();
                $accdataup->status = 'active';
                //$accdataup->save();


                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Accumulation Upload Update successfully!, but tsi changed. Must Change!!!',
                    ]
                );
            }
        } else {

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Accumulation Entry added Failed!',
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

    public function list(Request $request)
    {
        $route_active = 'TREATY | Accumulation Control - List';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        //$data = Accumulation::where('status', '=', 'active')->orderby('id','desc')->paginate(10);


        $treatyyeardata = @$request->input('treatyyear');
        $prodyeardata = @$request->input('prodyear');
        $ceding_brokerdata = @$request->input('ceding_broker');
        $ceding_companydata = @$request->input('ceding_company');
        $cob_inputdata = @$request->input('cob_input');
        $koc_inputdata = @$request->input('koc_input');
        $search = @$request->input('search');


        if (!empty($search) || !empty($treatyyeardata) || !empty($prodyeardata)  || !empty($ceding_brokerdata)  || !empty($ceding_companydata) || !empty($cob_inputdata) || !empty($koc_inputdata)) {

            $query = Accumulation::query();

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
            $accu = $query->get();

            $accu_ids = response()->json($accu->modelKeys());
        } else {
            $accu = Accumulation::all();
        }

        return view('crm.transaction.treaty.acc.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'accu'
        ));
    }


    public function entry(Request $request)
    {
        if (!empty($request->id)) {
            $accu = Accumulation::where('id', base64_decode($request->id))->first();
        }

        $route_active = 'TREATY | Accumulation Control - List';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        $currency = Currency::orderby('id', 'asc')->get();
        $earthquake = EarthQuakeZone::orderby('id', 'asc')->get();

        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $accu_now = Accumulation::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
        $lastid = count($accu_now);


        if ($lastid != null) {
            if ($lastid < 9) {
                $code_ms = "ACCU" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "ACCU" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "ACCU" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "ACCU" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "ACCU" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "ACCU" . $mydate . "0000" . strval(1);
        }
        

        $datatest=Accumulation::where('number','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "ACCU" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "ACCU" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "ACCU" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "ACCU" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "ACCU" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "ACCU" . $mydate . "0000" . strval(1);
            }

        }


        $ceding = CedingBroker::all();
        $ceding2 = CedingBroker::all();

        $props = Prop::get();


        if (empty($accu)) 
        {
            return view('crm.transaction.treaty.acc.entryinsert', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'earthquake',
                'currency',
                'ceding',
            ));
        } else if ($accu->typeacc == 1) 
        {
            return view('crm.transaction.treaty.acc.entry', compact(
                'route_active',
                'accu',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'earthquake',
                'currency',
                'ceding',
            ));
        } else if ($accu->typeacc == 2) 
        {
            if (!empty($request->id)) {
                $idm = base64_decode($request->id);
                $accu = Accumulation::where('id', $idm)->first();

                $datafile = AccTableFile::where('acc_id',  $accu->number)->orderby('id', 'asc')->get();
                //print_r($datafile);
                //exit();
            }

            return view('crm.transaction.treaty.acc.upload', compact(
                'route_active',
                'datafile',
                'accu',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'props',
                'ceding2',
                'ceding',
            ));
        }
    }


    public function upload()
    {
        $route_active = 'TREATY | Accumulation Control - List';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        $ceding2 = CedingBroker::all();

        $props = Prop::get();

        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $accu_now = Accumulation::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
        $lastid = count($accu_now);


        if ($lastid != null) {
            if ($lastid < 9) {
                $code_ms = "ACCU" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "ACCU" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "ACCU" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "ACCU" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "ACCU" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "ACCU" . $mydate . "0000" . strval(1);
        }

        
        $datatest=Accumulation::where('number','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "ACCU" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "ACCU" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "ACCU" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "ACCU" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "ACCU" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "ACCU" . $mydate . "0000" . strval(1);
            }

        }


        return view('crm.transaction.treaty.acc.upload', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'code_ms',
            'props',
            'ceding2',
            'ceding',
        ));
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
                        //$file->move(public_path()."/files/", $name);

                        $file->move(public_path("files"), $name);

                        $path = '/files/' . $name;

                        $insert[$x]['filename'] = $name;
                        $insert[$x]['path'] = $path;
                        $insert[$x]['user_id'] = Auth::user()->name;
                        $insert[$x]['acc_id'] = $request->acc_id;
                        AccTableFile::insert($insert);
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


    public function portofolio()
    {
        $route_active = 'TREATY | Portofolio Form - List';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.acc.portofolio', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function destroy($id)
    {
        $accu = Accumulation::findOrFail($id);

        if ($accu->delete()) {
            $notification = array(
                'message' => 'Accumulation deleted successfully!',
                'alert-type' => 'success'
            );

            //return back()->with($notification);
            return redirect('treaty/acc/list')->with('message', 'Accumulation deleted successfully!');
        } else {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );

            //return back()->with($notification);
            return redirect('treaty/acc/list')->with('message', 'Error Contact Admin');
        }
    }

}
