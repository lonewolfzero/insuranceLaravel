<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurrencyExchange;
use App\Models\Treaty\Loss\Loss;
use App\Models\Treaty\Prop\Prop;

class LossController extends Controller
{

    public function mainVariable($route)
    {
        $route_active = 'TREATY | Loss Participation ' . $route;
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

    public function validationHanlder($request)
    {
        return $request->validate([
            "prop_id" => 'required',
            "version" => 'required',
            "date_prod" => 'required',
            "user_entry" => 'required',
            "roe" => 'required',
            "earned_premium_idr" => 'required',
            "earned_premium_usd" => 'required',
            "earned_premium_roe" => 'required',
            "earned_premium_total" => 'required',
            "commission_idr" => 'required',
            "commission_usd" => 'required',
            "commission_roe" => 'required',
            "commission_total" => 'required',
            "claim_idr" => 'required',
            "claim_usd" => 'required',
            "claim_roe" => 'required',
            "claim_total" => 'required',
            "reserves_idr" => 'required',
            "reserves_usd" => 'required',
            "reserves_roe" => 'required',
            "reserves_total" => 'required',
            "total_loss_figures" => 'required',
            "loss_figure" => 'required',
            "final_commission" => 'required',
            "combined_ratio" => 'required',
            "combined_ratio_less_percentage" => 'required',
            "combined_ratio_less_amount" => 'required',
            "of_loss_figure" => 'required',
            "earned_premium_as_at_idr" => 'required',
            "earned_premium_as_at_usd" => 'required',
            "nasionalre_share" => 'required',
            "loss_participation_idr" => 'required',
            "loss_participation_usd" => 'required',
            "due_to_nasionalre_idr" => 'required',
            "due_to_nasionalre_usd" => 'required',
            "remark" => 'required',
        ]);
    }

    public function requestHandler($request)
    {
        $request->merge([
            "date_prod" => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_prod))),
            "user_entry" => auth()->id(),
            "roe" => str_replace(',', '', $request->roe),
            "earned_premium_idr" => str_replace(',', '', $request->earned_premium_idr),
            "earned_premium_usd" => str_replace(',', '', $request->earned_premium_usd),
            "earned_premium_roe" => str_replace(',', '', $request->earned_premium_roe),
            "earned_premium_total" => str_replace(',', '', $request->earned_premium_total),
            "commission_idr" => str_replace(',', '', $request->commission_idr),
            "commission_usd" => str_replace(',', '', $request->commission_usd),
            "commission_roe" => str_replace(',', '', $request->commission_roe),
            "commission_total" => str_replace(',', '', $request->commission_total),
            "claim_idr" => str_replace(',', '', $request->claim_idr),
            "claim_usd" => str_replace(',', '', $request->claim_usd),
            "claim_roe" => str_replace(',', '', $request->claim_roe),
            "claim_total" => str_replace(',', '', $request->claim_total),
            "reserves_idr" => str_replace(',', '', $request->reserves_idr),
            "reserves_usd" => str_replace(',', '', $request->reserves_usd),
            "reserves_roe" => str_replace(',', '', $request->reserves_roe),
            "reserves_total" => str_replace(',', '', $request->reserves_total),
            "total_loss_figures" => str_replace(',', '', $request->total_loss_figures),
            "loss_figure" => str_replace(',', '', $request->loss_figure),
            "final_commission" => str_replace(',', '', $request->final_commission),
            "combined_ratio" => str_replace(',', '', $request->combined_ratio),
            "combined_ratio_less_loss_percentage" => str_replace(',', '', $request->combined_ratio_less_loss_percentage),
            "combined_ratio_less_percentage" => str_replace(',', '', $request->combined_ratio_less_percentage),
            "combined_ratio_less_amount" => str_replace(',', '', $request->combined_ratio_less_amount),
            "of_loss_figure" => str_replace(',', '', $request->of_loss_figure),
            "earned_premium_as_at_idr" => str_replace(',', '', $request->earned_premium_as_at_idr),
            "earned_premium_as_at_usd" => str_replace(',', '', $request->earned_premium_as_at_usd),
            "nasionalre_share" => str_replace(',', '', $request->nasionalre_share),
            "loss_participation_idr" => str_replace(',', '', $request->loss_participation_idr),
            "loss_participation_usd" => str_replace(',', '', $request->loss_participation_usd),
            "due_to_nasionalre_idr" => str_replace(',', '', $request->due_to_nasionalre_idr),
            "due_to_nasionalre_usd" => str_replace(',', '', $request->due_to_nasionalre_usd),
        ]);
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
    public function store(Request $request)
    {
        $validation = $this->validationHanlder($request);

        if ($validation) {
            $this->requestHandler($request);
            $year = date('Y');
            $month = strlen((string)date('m')) < 2 ? "0" . (string)date('m') : (string)date('m');
            $var = Loss::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->orderBy('counter_number', 'desc')
                ->first();
            $counter = isset($var) ? $var->counter_number + 1 : 1;
            while (strlen((string)$counter) < 2) $counter = "0" . $counter;
            $request->merge([
                'loss_id' => 'LPC' . $year . $month . $counter,
                'counter_number' => $counter,
            ]);

            $loss = Loss::create($request->except(['_token']));
            $notification = array(
                'message' => 'Loss Participation added successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/loss/entry?id=' . base64_encode($loss->id))->with($notification);
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
    public function update(Request $request, Loss $loss)
    {
        $validation = $this->validationHanlder($request);

        if ($validation) {
            $this->requestHandler($request);

            $input = $request->except(['_token']);
            $loss->fill($input)->save();
            $notification = array(
                'message' => 'Loss Participation updated successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/loss/entry?id=' . base64_encode($loss->id))->with($notification);
        }
        $notification = array(
            'message' => $validation,
            'alert-type' => 'error'
        );
        return back()->with($notification);
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

    public function list()
    {
        extract($this->mainVariable('- List'));
        $loss = Loss::all()->load('getprop');
        return view('crm.transaction.treaty.loss.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'loss',
        ));
    }

    public function entry(Request $request)
    {
        extract($this->mainVariable('- Entry'));
        $loss = $losses =  null;
        if ($request->id) {
            $loss = Loss::find(base64_decode($request->id))->load('getprop');
            $losses = Loss::where('prop_id', $loss->prop_id)->with('getprop.getbroker', 'getprop.getcompany', 'getprop.getsubdetail.getcurrency')->get();
        }
        return view('crm.transaction.treaty.loss.entry', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'loss',
            'losses',
        ));
    }

    public function filter(Request $request)
    {
        $prop = Prop::with('getsubdetail.getcurrency', 'getsubdetail.getloss', 'getsoa.getcurrency', 'getbroker', 'getcompany')
            ->where('treaty_year', $request->treaty_year)
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
                $s->to_idr = $idr;
                $s->to_usd = $usd;
            }
            $loss = Loss::where("prop_id", $prop->id)->get();
            return response()->json(['prop' => $prop, 'soa' => $soa, 'loss' => $loss]);
        }
        return response()->json(['msg' => 'no data']);
    }

    public function cancelReplace(Loss $loss)
    {
        $cancel = $loss->replicate();
        $cancel->version = (int)$cancel->version + 1;
        $columns = [
            'roe',
            'earned_premium_idr',
            'earned_premium_usd',
            'earned_premium_roe',
            'earned_premium_total',
            'commission_idr',
            'commission_usd',
            'commission_roe',
            'commission_total',
            'claim_idr',
            'claim_usd',
            'claim_roe',
            'claim_total',
            'reserves_idr',
            'reserves_usd',
            'reserves_roe',
            'reserves_total',
            'total_loss_figures',
            'loss_figure',
            'final_commission',
            'combined_ratio',
            'combined_ratio_less_loss_percentage',
            'combined_ratio_less_percentage',
            'combined_ratio_less_amount',
            'of_loss_figure',
            'earned_premium_as_at_idr',
            'earned_premium_as_at_usd',
            'nasionalre_share',
            'loss_participation_idr',
            'loss_participation_usd',
            'due_to_nasionalre_idr',
            'due_to_nasionalre_usd',
        ];
        foreach ($columns as $c) {
            $cancel->{$c} = (float)$cancel->{$c} == 0 ? $cancel->{$c} : $cancel->{$c} * -1;
        }
        $cancel->save();
    }
}
