<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currencies;
use App\Models\CurrencyExchange;
use App\Models\Treaty\Prop\Prop;
use App\Models\Treaty\Sliding\Sliding;

class SlidingScaleController extends Controller
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
        $validation = $request->validate([
            'total_premium_idr' => "required",
            'total_premium_usd' => "required",
            'total_paid_losses_idr' => "required",
            'total_paid_losses_usd' => "required",
            'total_incured_losses_idr' => "required",
            'total_incured_losses_usd' => "required",
            'total_outstanding_losses_idr' => "required",
            'total_outstanding_losses_usd' => "required",
            'loss_ratio' => "required",
            'sliding_scale_idr' => "required",
            'sliding_scale_usd' => "required",
            'total_claim_paid_idr' => "required",
            'total_claim_paid_usd' => "required",
            'total_commission_idr' => "required",
            'total_commission_usd' => "required",
            'version' => "required",
            'finalized_sliding_scale' => "required",
            'date_prod' => "required",
            'remark' => "required",
        ]);
        if ($validation) {
            $year = date('Y');
            $month = strlen((string)date('m')) < 2 ? "0" . (string)date('m') : (string)date('m');
            $var = Sliding::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->orderBy('counter_number', 'desc')
                ->first();
            $counter = isset($var) ? $var->counter_number + 1 : 1;
            while (strlen((string)$counter) < 2) $counter = "0" . $counter;

            $request->merge([
                'sliding_scale_id' => 'SS' . $year . $month . $counter,
                'counter_number' => $counter,
                'total_premium_idr' => str_replace(',', '', $request->total_premium_idr),
                'total_premium_usd' => str_replace(',', '', $request->total_premium_usd),
                'total_paid_losses_idr' => str_replace(',', '', $request->total_paid_losses_idr),
                'total_paid_losses_usd' => str_replace(',', '', $request->total_paid_losses_usd),
                'total_incured_losses_idr' => str_replace(',', '', $request->total_incured_losses_idr),
                'total_incured_losses_usd' => str_replace(',', '', $request->total_incured_losses_usd),
                'total_outstanding_losses_idr' => str_replace(',', '', $request->total_outstanding_losses_idr),
                'total_outstanding_losses_usd' => str_replace(',', '', $request->total_outstanding_losses_usd),
                'loss_ratio' => str_replace(',', '', $request->loss_ratio),
                'sliding_scale_idr' => str_replace(',', '', $request->sliding_scale_idr),
                'sliding_scale_usd' => str_replace(',', '', $request->sliding_scale_usd),
                'total_claim_paid_idr' => str_replace(',', '', $request->total_claim_paid_idr),
                'total_claim_paid_usd' => str_replace(',', '', $request->total_claim_paid_usd),
                'total_commission_idr' => str_replace(',', '', $request->total_commission_idr),
                'total_commission_usd' => str_replace(',', '', $request->total_commission_usd),
                'finalized_sliding_scale' => str_replace(',', '', $request->finalized_sliding_scale),
                'date_prod' => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_prod))),
                'user_entry' => auth()->id(),
            ]);

            $sliding = Sliding::create($request->except(['_token']));

            $notification = array(
                'message' => 'Prop Summary added successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/sliding?id=' . base64_encode($sliding->id))->with($notification);
        }
        $notification = array(
            'message' => $validation,
            'alert-type' => 'error'
        );
        return back()->with($notification);
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
    }

    public function mainVariable()
    {
        $route_active = 'TREATY | Sliding Scale';
        $koc = Koc::where('parent_id', 6)->get();
        $cob = COB::all();
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        return compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        );
    }

    public function form(Request $request)
    {
        extract($this->mainVariable());
        $sliding = $slidings = null;
        if ($request->id) {
            $sliding = Sliding::find(base64_decode($request->id));
            if (!$sliding) abort(404);
            $sliding = $sliding->load('getprop.getsubdetail.getsliding', 'getuser');
            $slidings = Sliding::with('getuser')->where('prop_id', $sliding->prop_id)->get();
        }
        return view('crm.transaction.treaty.sliding.form', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'sliding',
            'slidings',
        ));
    }

    public function filter(Request $request)
    {
        $prop = Prop::with('getsubdetail.getsliding', 'getsoa')
            ->where('treaty_year', $request->u_w_year)
            ->where('ceding_broker', $request->ceding_broker)
            ->where('ceding_company', $request->ceding_company)
            ->where('cob', $request->cob)
            ->where('koc', $request->koc)
            ->first();
        if ($prop) {
            $soa = $prop->getsoa->sortDesc()->unique('soa_id');
            foreach ($soa as $s) {
                $idr = CurrencyExchange::where('month', date('m', strtotime($s->created_at)))
                    ->where('year', date('Y', strtotime($s->created_at)))
                    ->where('currency', 2)->first();
                $usd = CurrencyExchange::where('month', date('m', strtotime($s->created_at)))
                    ->where('year', date('Y', strtotime($s->created_at)))
                    ->where('currency', 1)->first();
                $s->idr = $idr;
                $s->usd = $usd;
            }
            $slidings = Sliding::where('prop_id', $prop->id)->with('getuser')->get();
            return response()->json(['prop' => $prop, 'soa' => $soa, 'slidings' => $slidings]);
        }
        return response()->json(['msg' => 'no data']);
    }

    public function cancelReplace(Sliding $Sliding)
    {
        $cancel = $Sliding->replicate();
        $cancel->version = (int)$cancel->version + 1;
        $columns = [
            'total_premium_idr',
            'total_premium_usd',
            'total_paid_losses_idr',
            'total_paid_losses_usd',
            'total_incured_losses_idr',
            'total_incured_losses_usd',
            'total_outstanding_losses_idr',
            'total_outstanding_losses_usd',
            'loss_ratio',
            'sliding_scale_idr',
            'sliding_scale_usd',
            'total_claim_paid_idr',
            'total_claim_paid_usd',
            'total_commission_idr',
            'total_commission_usd',
            'finalized_sliding_scale',
        ];
        foreach ($columns as $c) {
            $cancel->{$c} = (float)$cancel->{$c} == 0 ? $cancel->{$c} : $cancel->{$c} * -1;
        }
        $cancel->save();
    }
}
