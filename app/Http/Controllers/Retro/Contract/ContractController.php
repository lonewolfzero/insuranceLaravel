<?php

namespace App\Http\Controllers\Retro\Contract;

use App\Http\Controllers\Controller;
use App\Models\CedingBroker;
use App\Models\COB;
use App\Models\CurrencyExchange;
use App\Models\Koc;
use App\Models\Retro\Contract\Commission;
use App\Models\Retro\Contract\Retrocession;
use App\Models\Retro\Contract\SpecialContract;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContractController extends Controller
{
    public function requestHandler($request, $id = null)
    {
        $request->validate([
            'contract_name' => ['required', Rule::unique('retro_special_contracts')->ignore($id)],
            'u_w_year' => 'required',
            'koc' => 'required',
            'cob' => 'required',
            'currency' => 'required',
            'period_from' => 'required',
            'period_to' => 'required',
            'type' => 'required',
            'max_liability' => 'required',
        ]);

        if (str_contains($request->type, 'Facultative')) {
            $request->validate([
                'commission' => 'required',
                'overriding_by_gross_premium' => 'required',
                'overriding_by_nett_premium' => 'required',
            ]);
            $request->merge([
                'commission' => $this->money_format($request->commission),
                'overriding_by_gross_premium' => $this->money_format($request->overriding_by_gross_premium),
                'overriding_by_nett_premium' => $this->money_format($request->overriding_by_nett_premium),
            ]);
        } else {
            $request->validate([
                'source_amount' => 'required',
                'total_share' => 'required',
            ]);
            $request->merge([
                'total_share' => $this->money_format($request->total_share),
            ]);
        }

        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'period_from' => date('Y-m-d', strtotime(str_replace('/', '-', $request->period_from))),
            'period_to' => date('Y-m-d', strtotime(str_replace('/', '-', $request->period_to))),
            'max_liability' => $this->money_format($request->max_liability),
        ]);
    }

    public $except_request = [
        '_token',
        'c_id',
        'c_cob',
        'c_commission',
        'c_gross',
        'c_nett',
        'r_id',
        'r_retrocession',
        'r_share',
    ];

    public function money_format($var)
    {
        return str_replace(',', '', $var);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route_active = 'retro - contract entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currency = CurrencyExchange::where('month', date('m'))->where('year', date('Y'))->get();
        $ceding = CedingBroker::all();
        return view('crm.transaction.retro.contract.entry', compact([
            'route_active',
            'koc',
            'cob',
            'currency',
            'ceding',
        ]));
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
        $this->requestHandler($request);

        $specialContract = SpecialContract::create($request->except($this->except_request));

        if ($specialContract && str_contains($request->type, 'Treaty')) {
            if ($request->c_id && count($request->c_id) > 0) foreach ($request->c_id as $key => $id) {
                Commission::create([
                    'special_contract_id' => $specialContract->id,
                    'cob' => $request->c_cob[$key],
                    'commission' => $this->money_format($request->c_commission[$key]),
                    'overriding_by_gross_premium' => $this->money_format($request->c_gross[$key]),
                    'overriding_by_nett_premium' => $this->money_format($request->c_nett[$key]),
                ]);
            }
            if ($request->r_id && count($request->r_id) > 0) foreach ($request->r_id as $key => $id) {
                Retrocession::create([
                    'special_contract_id' => $specialContract->id,
                    'retrocession' => $request->r_retrocession[$key],
                    'share' => $this->money_format($request->r_share[$key]),
                ]);
            }
        }

        $notification = array(
            'message' => 'Special Contract added successfully!',
            'alert-type' => 'success'
        );
        return redirect('/retro/contract/entry/' . base64_encode($specialContract->id))
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialContract = SpecialContract::find(base64_decode($id));
        if (!$specialContract) {
            abort(404);
        }
        $route_active = 'retro - contract entry';
        $koc = Koc::all();
        $cob = COB::all();
        $currency = CurrencyExchange::where('month', date('m'))->where('year', date('Y'))->get();
        $ceding = CedingBroker::all();
        $retrocessions = Retrocession::where('special_contract_id', $specialContract->id)->with('getceding')->get();
        $commissions = Commission::where('special_contract_id', $specialContract->id)->with('getcob')->get();
        return view('crm.transaction.retro.contract.entry', compact([
            'route_active',
            'koc',
            'cob',
            'currency',
            'ceding',
            'specialContract',
            'retrocessions',
            'commissions',
        ]));
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
    public function update(Request $request, SpecialContract $specialContract)
    {
        $this->requestHandler($request, $specialContract->id);
        $specialContract->fill($request->except($this->except_request))->save();

        if (@$request->c_id) {
            Commission::where('special_contract_id', $specialContract->id)->whereNotIn('id', $request->c_id)->delete();
            foreach ($request->c_id as $key => $id) {
                if (!Commission::where('id', $id)->exists()) {
                    Commission::create([
                        'special_contract_id' => $specialContract->id,
                        'cob' => $request->c_cob[$key],
                        'commission' => $this->money_format($request->c_commission[$key]),
                        'overriding_by_gross_premium' => $this->money_format($request->c_gross[$key]),
                        'overriding_by_nett_premium' => $this->money_format($request->c_nett[$key]),
                    ]);
                }
            }
        } elseif (Commission::where('special_contract_id', $specialContract->id)->exists()) {
            Commission::where('special_contract_id', $specialContract->id)->delete();
        }

        if (@$request->r_id) {
            Retrocession::where('special_contract_id', $specialContract->id)->whereNotIn('id', $request->r_id)->delete();
            foreach ($request->r_id as $key => $id) {
                if (!Retrocession::where('id', $id)->exists()) {
                    Retrocession::create([
                        'special_contract_id' => $specialContract->id,
                        'retrocession' => $request->r_retrocession[$key],
                        'share' => $this->money_format($request->r_share[$key]),
                    ]);
                }
            }
        } elseif (Retrocession::where('special_contract_id', $specialContract->id)->exists()) {
            Retrocession::where('special_contract_id', $specialContract->id)->delete();
        }

        $notification = array(
            'message' => 'Special Contract updated successfully!',
            'alert-type' => 'success'
        );
        return redirect('/retro/contract/entry/' . base64_encode($specialContract->id))
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialContract $specialContract)
    {
        $specialContract->delete();
        return 'deleted';
    }
}
