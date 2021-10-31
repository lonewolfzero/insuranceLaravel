<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Treaty\Commission\Check as CommissionCheck;
use App\Models\Treaty\Commission\Claim as CommissionClaim;
use App\Models\Treaty\Commission\Commission;
use App\Models\Treaty\Commission\DocumentRegistration;
use App\Models\Treaty\Commission\Soa as CommissionSoa;
use App\Models\Treaty\Prop\Prop;
use App\Models\Treaty\Soa\Soa;

class CommissionController extends Controller
{

    public function validationHandler($request)
    {
        return $request->validate([
            'registration_id' => 'required',
            'treaty_year' => 'required',
            'ceding_broker' => 'required',
            'ceding_company' => 'required',
            'cob' => 'required',
            'koc' => 'required',
            'prop_id' => 'required',
            'currency_radio' => 'required',
            'os_claim_position' => 'required',
            'date_prod' => 'required',
            'prod_year_start' => 'required',
            'prod_year_end' => 'required',
            'user_entry' => 'required',
        ]);
    }

    public function requestHandler($request)
    {
        $request->merge([
            'premium' => str_replace(',', '', $request->premium),
            'commission_percentage' => str_replace(',', '', $request->commission_percentage),
            'commission_amount' => str_replace(',', '', $request->commission_amount),
            'losses_paid' => str_replace(',', '', $request->losses_paid),
            'outstanding_losses' => str_replace(',', '', $request->outstanding_losses),
            'management_expenses_percentage' => str_replace(',', '', $request->management_expenses_percentage),
            'management_expenses_amount' => str_replace(',', '', $request->management_expenses_amount),
            'dcf' => str_replace(',', '', $request->dcf),
            'profit_loss_first' => str_replace(',', '', $request->profit_loss_first),
            'rupiah_exchange_rate' => str_replace(',', '', $request->rupiah_exchange_rate),
            'profit_loss_second' => str_replace(',', '', $request->profit_loss_second),
            'profit_loss_dcf' => str_replace(',', '', $request->profit_loss_dcf),
            'profit_commission_percentage' => str_replace(',', '', $request->profit_commission_percentage),
            'profit_commission_amount' => str_replace(',', '', $request->profit_commission_amount),
            'our_share_percentage' => str_replace(',', '', $request->our_share_percentage),
            'our_share_amount' => str_replace(',', '', $request->our_share_amount),
            'total_previous_settlement' => str_replace(',', '', $request->total_previous_settlement),
            'balance_due' => str_replace(',', '', $request->balance_due),
            'date_prod' => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_prod))),
            'os_claim_position' => date("Y-m-d", strtotime(str_replace('/', '-', $request->os_claim_position))),
            'user_entry' => auth()->id(),
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
        $validation = $this->validationHandler($request);
        if ($validation) {
            $this->requestHandler($request);
            $year = date('Y');
            $month = strlen((string)date('m')) < 2 ? "0" . (string)date('m') : (string)date('m');
            $var = Commission::whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->orderBy('counter_number', 'desc')
                ->first();
            $counter = isset($var) ? $var->counter_number + 1 : 1;
            while (strlen((string)$counter) < 2) $counter = "0" . $counter;
            $request->merge([
                'commission_id' => 'PC' . $year . $month . $counter,
                'counter_number' => $counter,
            ]);
            $commission = Commission::create($request->except([
                '_token',
                'check_u_w_year',
                'check_premi',
                'check_komisi',
                'check_klaim',
                'check_cash_call',
                'check_os_klaim',
                'check_net_balance',
                'find_soa_id',
                'find_soa_checkbox',
            ]));
            if ($commission && $request->find_soa_id) {
                foreach ($request->find_soa_id as $key => $id) {
                    CommissionSoa::create([
                        'commission_id' => $commission->id,
                        'soa_id' => $id,
                        'checked' => $request->find_soa_checkbox[$key] == 'on' ? 1 : 0,
                    ]);
                }
            }
            if ($commission && $request->find_claim_id) {
                foreach ($request->find_claim_id as $key => $id) {
                    CommissionClaim::create([
                        'commission_id' => $commission->id,
                        'claim_id' => $id,
                        'checked' => $request->find_claim_checkbox[$key] == 'on' ? 1 : 0,
                    ]);
                }
            }
            if ($commission && $request->check_u_w_year) {
                foreach ($request->check_u_w_year as $key => $uy) {
                    CommissionCheck::create([
                        'commission_id' => $commission->id,
                        'uy' => $uy,
                        'premi' => str_replace(',', '', $request->check_premi[$key]),
                        'komisi' => str_replace(',', '', $request->check_komisi[$key]),
                        'klaim' => str_replace(',', '', $request->check_klaim[$key]),
                        'cash_call' => str_replace(',', '', $request->check_cash_call[$key]),
                        'os_klaim' => str_replace(',', '', $request->check_os_klaim[$key]),
                        'net_balance' => str_replace(',', '', $request->check_net_balance[$key]),
                    ]);
                }
            }
            $notification = array(
                'message' => 'Commission added successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/commission/entry?id=' . base64_encode($commission->id))->with($notification);
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
    public function update(Request $request, Commission $commission)
    {
        $validation = $this->validationHandler($request);
        if ($validation) {
            $this->requestHandler($request);
            $input = $request->except([
                '_token',
                'check_u_w_year',
                'check_premi',
                'check_komisi',
                'check_klaim',
                'check_cash_call',
                'check_os_klaim',
                'check_net_balance',
                'find_soa_id',
                'find_soa_checkbox',
            ]);
            $commission->fill($input)->save();
            if ($commission && $request->find_soa_id) {
                foreach ($request->find_soa_id as $key => $id) {
                    $commissionSoa = CommissionSoa::where('commission_id', $commission->id)->where('soa_id', $id)->first();
                    $check = $request->find_soa_checkbox[$key] == 'on' ? 1 : 0;
                    $commissionSoa->update([
                        'checked' => $check,
                    ]);
                }
            }
            if ($commission && $request->find_claim_id) {
                foreach ($request->find_claim_id as $key => $id) {
                    $commissionClaim = CommissionClaim::where('commission_id', $commission->id)->where('claim_id', $id)->first();
                    $check = $request->find_claim_checkbox[$key] == 'on' ? 1 : 0;
                    $commissionClaim->update([
                        'checked' => $check,
                    ]);
                }
            }
            $notification = array(
                'message' => 'Commission updated successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/commission/entry?id=' . base64_encode($commission->id))->with($notification);
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
        return $id;
    }

    public function mainVariable($route)
    {
        $route_active = 'TREATY | Profit Commission ' . $route;
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

    public function list()
    {
        extract($this->mainVariable('- List'));
        $commission = Commission::all()->load('getprop');
        return view('crm.transaction.treaty.commission.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'commission',
        ));
    }

    public function entry(Request $request)
    {
        extract($this->mainVariable('- Entry'));
        $commission = $soa = $check =  null;
        if ($request->id) {
            $commission = Commission::with(
                'getprop.getsubdetail',
                'getkoc',
                'getcob',
                'getbroker',
                'getcompany',
                'getuser',
                'registration',
                'getsoa',
            )->find(base64_decode($request->id));
            if (!$commission) abort(404);
            $soa = CommissionSoa::with('getsoa')->where('commission_id', $commission->id)->get();
            $check = CommissionCheck::where('commission_id', $commission->id)->get();
        } elseif ($request->registration) {
            $registration = DocumentRegistration::find(base64_decode($request->registration));
            if (!$registration) abort(404);
            $commission = (object)[];
            $commission->registration = (object)[];
            $commission->registration = $registration;
        }
        return view('crm.transaction.treaty.commission.entry', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'commission',
            'soa',
            'check',
        ));
    }

    public function checkForm(Request $request)
    {
        $prop = Prop::with('getsoa', 'getsubdetail')
            ->where('ceding_broker', $request->ccb)
            ->where('ceding_company', $request->ccc)
            ->where('cob', $request->cc)
            ->where('koc', $request->ck)
            ->where('treaty_year', $request->cty);
        $prop = $prop
            ->latest()
            ->first();
        return $prop;
    }

    public function find(Request $request)
    {
        $soa = Soa::with('getprop', 'getcurrency');
        $soa = $soa->where('u_w_year', $request->cty)
            ->where('ceding_broker', $request->ccb)
            ->where('ceding_company', $request->ccc)
            ->whereHas('getprop', function ($q) use ($request) {
                $q->where('cob', $request->cc);
            })->whereHas('getprop', function ($q) use ($request) {
                $q->where('koc', $request->ck);
            })
            ->has('getprop');
        return $soa->get()
            ->groupBy('soa_id');
    }

    public function registrationList(Request $request)
    {
        extract($this->mainVariable('Registration - List'));
        $registrations = DocumentRegistration::all()->load('commission');
        return view('crm.transaction.treaty.commission.list_registration', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'registrations',
        ));
    }

    public function registration(Request $request)
    {
        $y = substr((string)$request->accounting_year, -2);
        $type = $request->type;
        $period = $request->period;
        $ceding = $request->ceding_broker;
        $var = DocumentRegistration::orderBy('counter', 'desc')->first();
        $counter = isset($var) ? $var->counter + 1 : 1;
        $counter_reg = $counter;
        while (strlen((string)$counter_reg) < 3) $counter_reg = "0" . $counter_reg;
        $reg_number = $y . '/' . $type . '/' . $period . '/' . $ceding . '/' . $counter_reg;

        $request->merge([
            'reg_number' => $reg_number,
            'counter' => $counter,
            'date_of_doc' => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_of_doc))),
            'incoming_date' => date("Y-m-d", strtotime(str_replace('/', '-', $request->incoming_date))),
        ]);

        $regist = DocumentRegistration::create($request->except(['_token']));
        return $regist;
    }
}
