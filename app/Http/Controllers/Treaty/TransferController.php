<?php

namespace App\Http\Controllers\Treaty;

use App\Http\Controllers\Controller;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Models\CurrencyExchange;
use App\Models\Currency;
use App\Models\Treaty\NonProp\SharingMindep;
use App\Models\Treaty\NonProp\TransferMindep;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!empty($request->id)) {
            $transferdata= TransferMindep::where('id', base64_decode($request->id))->first();
        }

        $route_active = 'TREATY | Transfer Form - Transfer Form';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();


        $currdate2 = date("Y-m-d");
        $mydate = date("Y") . date("m") . date("d");

        $transfer_now = TransferMindep::whereDate('created_at', $currdate2)->orderby('id', 'asc')->get();
        $lastid = count($transfer_now);


        if ($lastid != null) 
        {
            if ($lastid < 9) {
                $code_ms = "TRANSFER" . $mydate . "0000" . strval($lastid + 1);
            } elseif ($lastid > 8 && $lastid < 99) {
                $code_ms = "TRANSFER" . $mydate . "000" . strval($lastid + 1);
            } elseif ($lastid > 98 && $lastid < 999) {
                $code_ms = "TRANSFER" . $mydate . "00" . strval($lastid + 1);
            } elseif ($lastid > 998 && $lastid < 9999) {
                $code_ms = "TRANSFER" . $mydate . "0" . strval($lastid + 1);
            } elseif ($lastid > 9998 && $lastid < 99999) {
                $code_ms = "TRANSFER" . $mydate  . strval($lastid + 1);
            }
        } else {
            $code_ms = "TRANSFER" . $mydate . "0000" . strval(1);
        }


          
        $datatest=TransferMindep::where('number_transfer','=',$code_ms)->whereDate('created_at', $currdate2)->get();
        if(!empty($datatest))
        {
            $lastid=$lastid + 1;
            if ($lastid != null) 
            {
                if ($lastid < 9) {
                    $code_ms = "TRANSFER" . $mydate . "0000" . strval($lastid + 1);
                } elseif ($lastid > 8 && $lastid < 99) {
                    $code_ms = "TRANSFER" . $mydate . "000" . strval($lastid + 1);
                } elseif ($lastid > 98 && $lastid < 999) {
                    $code_ms = "TRANSFER" . $mydate . "00" . strval($lastid + 1);
                } elseif ($lastid > 998 && $lastid < 9999) {
                    $code_ms = "TRANSFER" . $mydate . "0" . strval($lastid + 1);
                } elseif ($lastid > 9998 && $lastid < 99999) {
                    $code_ms = "TRANSFER" . $mydate  . strval($lastid + 1);
                }
            } 
            else 
            {
                $code_ms = "TRANSFER" . $mydate . "0000" . strval(1);
            }

        }



        if (empty($transferdata)) 
        {
            return view('crm.transaction.treaty.transfer.entry', compact(
                'route_active',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'ceding',
            ));
        
        } 
        else if (!empty($transferdata)) 
        {
            return view('crm.transaction.treaty.transfer.entry', compact(
                'route_active',
                'transferdata',
                'koc',
                'cob',
                'currencies',
                'code_ms',
                'ceding',
            ));
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
    public function store(Request $request)
    {
        
        $validator = $request->validate([
            'number_transfer' => 'required',
            'ceding_id' => 'required'
        ]);

        if($validator) 
        {
            $user = Auth::user();

            $transferdata = TransferMindep::where('number_transfer', $request->number)->first();

            if(empty($transferdata)) 
            {

                $posdate =  $request->date_from;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));

                $posdate2 =  $request->date_to;
                $date2 = str_replace('/', '-', $posdate2);
                $newposDate2 = date('Y-m-d', strtotime($date2));

                $transferdataup = TransferMindep::create([
                    'number_transfer' => $request->number_transfer,
                    'broker_id' => $request->broker_id,
                    'ceding_id' => $request->ceding_id,
                    'date_from' => $newposDate,
                    'date_to' => $newposDate2,
                    'statement_ofaccount'=> $request->statement_ofaccount,
                    'profit_commission' => $request->profit_commission,
                    'loss_participation' => $request->loss_participation,
                    'sliding_scale' => $request->sliding_scale,
                    'minimum_deposit' => $request->minimum_deposit,
                    'adjusment_minimum_deposit' => $request->adjusment_minimum_deposit,
                    'reinstatement' => $request->reinstatement,
                    'adjustment_reinstatement' => $request->adjustment_reinstatement,
                    'profit_sharing' => $request->profit_sharing,
                    'status' => 'active'
                ]);

                $transferdataup = TransferMindep::where('number_transfer', $request->number_transfer)->orderby('id', 'desc')->first();
                $transferdataup->status = 'active';
                $transferdataup->save();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Transfer Form Update successfully!',
                    ]
                );

            } 
            else 
            {
                $posdate =  $request->date_from;
                $date = str_replace('/', '-', $posdate);
                $newposDate = date('Y-m-d', strtotime($date));

                $posdate2 =  $request->date_to;
                $date2 = str_replace('/', '-', $posdate2);
                $newposDate2 = date('Y-m-d', strtotime($date2));


                $transferdataid = $transferdata->id;
                $transferdata = TransferMindep::findOrFail($transferdataid);
                $transferdata->number_transfer = $request->number_transfer;
                $transferdata->broker_id = $request->broker_id;
                $transferdata->ceding_id = $request->ceding_id;
                $transferdata->date_from = $newposDate;
                $transferdata->date_to = $newposDate2;
                $transferdata->statement_ofaccount = $request->statement_ofaccount;
                $transferdata->profit_commission = $request->profit_commission;
                $transferdata->loss_participation = $request->loss_participation;
                $transferdata->sliding_scale = $request->sliding_scale;

                $transferdata->minimum_deposit = $request->minimum_deposit;
                $transferdata->adjusment_minimum_deposit = $request->adjusment_minimum_deposit;
                $transferdata->reinstatement = $request->reinstatement;
                $transferdata->adjustment_reinstatement = $request->adjustment_reinstatement;
                $transferdata->profit_sharing = $request->profit_sharing;

                $transferdata->save();

                
                $transferdataup = TransferMindep::where('number_transfer', $request->number_transfer)->orderby('id', 'desc')->first();
                $transferdataup->status = 'active';
                
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Transfer Form  Update successfully !!!',
                    ]
                );
            }
        } 
        else 
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Transfer Form Entry added Failed!',
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
        $route_active = 'TREATY | Transfer Form - Bukti Transfer Prop';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.transfer.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }

    public function listnonprop(Request $request)
    {
        $route_active = 'TREATY | Transfer Form - Bukti Transfer Non Prop';
        $koc = Koc::all();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return view('crm.transaction.treaty.transfer.listnonprop', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }


    public function destroy($id)
    {
        $transfer = TransferMindep::findOrFail($id);

        if ($transfer->delete()) 
        {
            $notification = array(
                'message' => 'transfer Mindep deleted successfully!',
                'alert-type' => 'success'
            );

            //return back()->with($notification);
            return redirect('treaty/transfer/list')->with('message', 'transfer Mindep deleted successfully!');
        } 
        else 
        {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );

            //return back()->with($notification);
            return redirect('treaty/transfer/list')->with('message', 'Error Contact Admin');
        }
    }


}
