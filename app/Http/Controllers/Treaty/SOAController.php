<?php

namespace App\Http\Controllers\Treaty;

use App\Models\COB;
use App\Models\Koc;
use App\Models\Currencies;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Treaty\Prop\Prop;
use App\Models\Treaty\Soa\AttachmentDocument;
use App\Models\Treaty\Soa\Bordero\KlaimKredit;
use App\Models\Treaty\Soa\Bordero\KlaimNonMarine;
use App\Models\Treaty\Soa\Bordero\PremiKredit;
use App\Models\Treaty\Soa\Bordero\PremiNonMarine;
use App\Models\Treaty\Soa\DocumentRegistration;
use App\Models\Treaty\Soa\PremiumReserved;
use App\Models\Treaty\Soa\Soa;
use Carbon\Carbon;

class SOAController extends Controller
{

    public function mainVariable($route)
    {
        $route_active = 'TREATY | Statement Of Account' . $route;
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
            'status' => 'required',
            'version' => 'required',
            'ceding_broker' => 'required',
            'ceding_company' => 'required',
            'u_w_year' => 'required',
            'tty_summary' => 'required',
            'currency' => 'required',
            'r_i_comm_percentage' => 'required',
            'cash_call_limit' => 'required',
            'doc_number' => 'required',
            'date_prod' => 'required',
            'remark' => 'required',
            'treaty_gross_premium' => 'required',
            'treaty_premium_released' => 'required',
            'treaty_premium_reserved' => 'required',
            'treaty_interest_on_premium_percentage' => 'required',
            'treaty_interest_on_premium_amount' => 'required',
            'treaty_r_i_comm_percentage' => 'required',
            'treaty_r_i_comm_amount' => 'required',
            'treaty_overrider_percentage' => 'required',
            'treaty_overrider_amount' => 'required',
            'treaty_net_premium' => 'required',
            'treaty_paid_losses' => 'required',
            'treaty_claim_recovery' => 'required',
            'treaty_result' => 'required',
            'treaty_cash_loss' => 'required',
            'treaty_common_a_c_xol' => 'required',
            'treaty_balance' => 'required',
            'nasionalre_share' => 'required',
            'nasionalre_gross_premium' => 'required',
            'nasionalre_r_i_comm_type' => 'required',
            'nasionalre_r_i_comm_percentage' => 'required',
            'nasionalre_r_i_comm_amount' => 'required',
            'nasionalre_overrider_percentage' => 'required',
            'nasionalre_overrider_amount' => 'required',
            'nasionalre_interest_percentage' => 'required',
            'nasionalre_interest_amount' => 'required',
            'nasionalre_net_premium' => 'required',
            'nasionalre_paid_losses' => 'required',
            'nasionalre_claim_recovery' => 'required',
            'nasionalre_result' => 'required',
            'nasionalre_cash_loss' => 'required',
            'nasionalre_common_a_c_xol' => 'required',
            'nasionalre_balance' => 'required',
        ]);
    }

    public function requestHanlder($request, $action, $data = [])
    {
        $nasionalre_share_checked = 0;
        if ($request->nasionalre_share_checkbox == 'on') {
            $nasionalre_share_checked = 1;
        }
        $date_prod_extend_check = 0;
        if ($request->date_prod_extend_check == 'on') {
            $date_prod_extend_check = 1;
        }
        $request->merge([
            'cash_call_limit' => str_replace(',', '', $request->cash_call_limit),
            'date_prod' => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_prod))),
            'treaty_gross_premium' => str_replace(',', '', $request->treaty_gross_premium),
            'treaty_premium_released' => str_replace(',', '', $request->treaty_premium_released),
            'treaty_premium_reserved' => str_replace(',', '', $request->treaty_premium_reserved),
            'treaty_interest_on_premium_amount' => str_replace(',', '', $request->treaty_interest_on_premium_amount),
            'treaty_r_i_comm_amount' => str_replace(',', '', $request->treaty_r_i_comm_amount),
            'treaty_overrider_amount' => str_replace(',', '', $request->treaty_overrider_amount),
            'treaty_net_premium' => str_replace(',', '', $request->treaty_net_premium),
            'treaty_paid_losses' => str_replace(',', '', $request->treaty_paid_losses),
            'treaty_claim_recovery' => str_replace(',', '', $request->treaty_claim_recovery),
            'treaty_result' => str_replace(',', '', $request->treaty_result),
            'treaty_cash_loss' => str_replace(',', '', $request->treaty_cash_loss),
            'treaty_common_a_c_xol' => str_replace(',', '', $request->treaty_common_a_c_xol),
            'treaty_balance' => str_replace(',', '', $request->treaty_balance),
            'nasionalre_share' => str_replace(',', '', $request->nasionalre_share),
            'nasionalre_gross_premium' => str_replace(',', '', $request->nasionalre_gross_premium),
            'nasionalre_r_i_comm_amount' => str_replace(',', '', $request->nasionalre_r_i_comm_amount),
            'nasionalre_overrider_amount' => str_replace(',', '', $request->nasionalre_overrider_amount),
            'nasionalre_interest_amount' => str_replace(',', '', $request->nasionalre_interest_amount),
            'nasionalre_net_premium' => str_replace(',', '', $request->nasionalre_net_premium),
            'nasionalre_paid_losses' => str_replace(',', '', $request->nasionalre_paid_losses),
            'nasionalre_claim_recovery' => str_replace(',', '', $request->nasionalre_claim_recovery),
            'nasionalre_result' => str_replace(',', '', $request->nasionalre_result),
            'nasionalre_cash_loss' => str_replace(',', '', $request->nasionalre_cash_loss),
            'nasionalre_common_a_c_xol' => str_replace(',', '', $request->nasionalre_common_a_c_xol),
            'nasionalre_balance' => str_replace(',', '', $request->nasionalre_balance),
            'nasionalre_share_checked' => $nasionalre_share_checked,
            'date_prod_extend_check' => $date_prod_extend_check,
        ]);
        if ($action == 'store') {
            $request->merge([
                'soa_id' => $data[0],
                'counter_number' => $data[1],
            ]);
        } elseif ($action == 'replace') {
            $request->merge([
                'counter_number' => $data[0],
            ]);
        }
        if ($request->treaty_vat_percentage && $request->treaty_vat && $request->treaty_vat_balance && $request->nasionalre_vat_percentage && $request->nasionalre_vat && $request->nasionalre_vat_balance) {
            $request->merge([
                'treaty_vat_percentage' => str_replace(',', '', $request->treaty_vat_percentage),
                'treaty_vat' => str_replace(',', '', $request->treaty_vat),
                'treaty_vat_balance' => str_replace(',', '', $request->treaty_vat_balance),
                'nasionalre_vat_percentage' => str_replace(',', '', $request->nasionalre_vat_percentage),
                'nasionalre_vat' => str_replace(',', '', $request->nasionalre_vat),
                'nasionalre_vat_balance' => str_replace(',', '', $request->nasionalre_vat_balance),
            ]);
        } else {
            $request->merge([
                'treaty_vat_percentage' => 0,
                'treaty_vat' => 0,
                'treaty_vat_balance' => 0,
                'nasionalre_vat_percentage' => 0,
                'nasionalre_vat' => 0,
                'nasionalre_vat_balance' => 0,
            ]);
        }
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
            $uw_year = $request->u_w_year;
            $month = strlen((string)date('m')) < 2 ? "0" . (string)date('m') : (string)date('m');
            $var = Soa::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->orderBy('counter_number', 'desc')->first();
            $counter = isset($var) ? $var->counter_number + 1 : 1;
            while (strlen((string)$counter) < 4) $counter = "0" . $counter;

            $data = ['SOA' . $uw_year . $month . $counter, $counter];
            $this->requestHanlder($request, 'store', $data);

            $soa = Soa::create($request->except(['premium_reserved_id', 'premium_reserved_amount', '_token', 'nasionalre_share_checkbox', 'attach_id', 'attach_description', 'attach_url']));
            if ($soa) {
                if ($request->premium_reserved_amount && count($request->premium_reserved_amount) > 0) foreach ($request->premium_reserved_amount as $amount) {
                    PremiumReserved::create([
                        'soa_id' => $soa->id,
                        'amount' => $amount,
                    ]);
                }
                if ($request->attach_description && count($request->attach_description) > 0) foreach ($request->attach_description as $key => $description) {
                    AttachmentDocument::create([
                        'soa_id' => $soa->id,
                        'description' => $description,
                        'url' => $request->attach_url[$key],
                    ]);
                }
            }
            $notification = array(
                'message' => 'SOA added successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/soa/entry?id=' . base64_encode($soa->id))->with($notification);
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
    public function show(Soa $soa)
    {
        return $soa;
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
    public function update(Request $request, Soa $soa)
    {
        $validation = $this->validationHanlder($request);
        if ($validation) {
            $this->requestHanlder($request, 'update');

            $input = $request->except(['premium_reserved_id', 'premium_reserved_amount', '_token', 'nasionalre_share_checkbox', 'attach_id', 'attach_description', 'attach_url']);
            $soa->fill($input)->save();

            //#region update premium reserved
            if (@$request->premium_reserved_id) {
                PremiumReserved::where('soa_id', $soa->id)->whereNotIn('id', $request->premium_reserved_id)->delete();
                foreach ($request->premium_reserved_id as $key => $id) {
                    if (!PremiumReserved::where('id', $id)->exists()) {
                        PremiumReserved::create([
                            'soa_id' => $soa->id,
                            'amount' => $request->premium_reserved_amount[$key],
                        ]);
                    }
                }
            } elseif (PremiumReserved::where('soa_id', $soa->id)->exists()) {
                PremiumReserved::where('soa_id', $soa->id)->delete();
            }
            //#region update premium reserved

            //#region update attachment document
            if (@$request->attach_id) {
                AttachmentDocument::where('soa_id', $soa->id)->whereNotIn('id', $request->attach_id)->delete();
                foreach ($request->attach_id as $key => $id) {
                    if (!AttachmentDocument::where('id', $id)->exists()) {
                        AttachmentDocument::create([
                            'soa_id' => $soa->id,
                            'description' => $request->attach_description[$key],
                            'url' => $request->attach_url[$key],
                        ]);
                    }
                }
            } elseif (AttachmentDocument::where('soa_id', $soa->id)->exists()) {
                AttachmentDocument::where('soa_id', $soa->id)->delete();
            }
            //#region update attachment document

            $notification = array(
                'message' => 'SOA updated successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/soa/entry?id=' . base64_encode($soa->id))->with($notification);
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

    public function destroyNil($id)
    {
        return $id;
    }

    public function list(Request $request)
    {
        extract($this->mainVariable(' - List'));
        $soa = Soa::with('getprop', 'getbroker', 'getcompany', 'registration');
        if ($request->treatyyear) {
            $soa = $soa->where('u_w_year', $request->treatyyear);
        }
        if ($request->prodyear) {
            $soa = $soa->whereYear('date_prod', $request->prodyear);
        }
        if ($request->ceding_broker) {
            $soa = $soa->where('ceding_broker', $request->ceding_broker);
        }
        if ($request->ceding_company) {
            $soa = $soa->where('ceding_company', $request->ceding_company);
        }
        if ($request->cob_input) {
            $soa = $soa->whereHas('getprop', function ($q) use ($request) {
                $q->where('cob', $request->cob_input);
            })->has('getprop');
        }
        if ($request->koc_input) {
            $soa = $soa->whereHas('getprop', function ($q) use ($request) {
                $q->where('koc', $request->koc_input);
            })->has('getprop');
        }
        $soa = $soa->get();
        return view('crm.transaction.treaty.soa.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'soa',
        ));
    }

    public function bordero_reporting($i, $period, $days, $soa)
    {
        $add_days = ($period * $i) + (int)$soa->getprop->total_account_period - $days;
        // dd(Carbon::now()->format('m-Y') == date('m-Y', strtotime(Carbon::parse($soa->getprop->period_from)->addDays($add_days))));
        if (Carbon::now()->format('m-Y') == date('m-Y', strtotime(Carbon::parse($soa->getprop->period_from)->addDays($add_days)))) {
            $soa->period_month = Carbon::now()->format('F');
            // dd($soa);
            return $soa;
        }
    }

    public function registrationList(Request $request)
    {
        extract($this->mainVariable(' Registration - List'));
        $registrations = DocumentRegistration::all()->load('soa');
        return view('crm.transaction.treaty.soa.list_registration', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'registrations',
        ));
    }

    public function nilList(Request $request)
    {
        extract($this->mainVariable(' Nil Reminder - List'));
        $soa_list = Soa::with('getprop.getcob', 'getprop.getkoc', 'getprop.getsubdetail', 'getbroker', 'getcompany', 'registration');
        if ($request->treatyyear) {
            $soa_list = $soa_list->where('u_w_year', $request->treatyyear);
        }
        if ($request->prodyear) {
            $soa_list = $soa_list->whereYear('date_prod', $request->prodyear);
        }
        if ($request->ceding_broker) {
            $soa_list = $soa_list->where('ceding_broker', $request->ceding_broker);
        }
        if ($request->ceding_company) {
            $soa_list = $soa_list->where('ceding_company', $request->ceding_company);
        }
        if ($request->cob_input) {
            $soa_list = $soa_list->whereHas('getprop', function ($q) use ($request) {
                $q->where('cob', $request->cob_input);
            })->has('getprop');
        }
        if ($request->koc_input) {
            $soa_list = $soa_list->whereHas('getprop', function ($q) use ($request) {
                $q->where('koc', $request->koc_input);
            })->has('getprop');
        }
        if ($request->reg_number) {
            $soa_list = $soa_list->whereHas('registration', function ($q) use ($request) {
                $q->where('reg_number', $request->reg_number);
            })->has('registration');
        }
        if ($request->ref_number) {
            $soa_list = $soa_list->whereHas('registration', function ($q) use ($request) {
                $q->where('ref_number', $request->ref_number);
            })->has('registration');
        }
        $soa_list = $soa_list->get();
        $soa_l = [];
        foreach ($soa_list as $val) {
            if ($val->getprop->getsubdetail->bordereaux_reporting == 'Monthly') {
                for ($i = 1; $i <= 12; $i++) {
                    $res = $this->bordero_reporting($i, 30, 15, $val, $soa_l);
                    if ($res) {
                        array_push($soa_l, $res);
                    }
                }
            } elseif ($val->getprop->getsubdetail->bordereaux_reporting == 'Quarterly') {
                for ($i = 1; $i <= 4; $i++) {
                    $res = $this->bordero_reporting($i, 90, 30, $val, $soa_l);
                    if ($res) {
                        array_push($soa_l, $res);
                    }
                }
            } elseif ($val->getprop->getsubdetail->bordereaux_reporting == 'Half Yearly') {
                for ($i = 1; $i <= 2; $i++) {
                    $res = $this->bordero_reporting($i, 180, 30, $val, $soa_l);
                    if ($res) {
                        array_push($soa_l, $res);
                    }
                }
            }
        }
        $soa_list = collect($soa_l);
        return view('crm.transaction.treaty.soa.nil_list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'soa_list',
        ));
    }

    public function entry(Request $request)
    {
        $soa = $premium_reserved = $bordero = $document_attach = $soa_list =  null;
        $klaim_non_marine = $premi_non_marine = $klaim_kredit = $premi_kredit = [];

        if ($request->id) {
            $soa = Soa::find(base64_decode($request->id));
            if (!$soa) abort(404);

            $soa = $soa->load('registration', 'getprop');
            $soa_list = Soa::with('registration')->where('registration_id', $soa->registration_id)->get();

            $premium_reserved = PremiumReserved::where('soa_id', $soa->id)->get();
            $document_attach = AttachmentDocument::where('soa_id', $soa->id)->get();
            if (KlaimNonMarine::where('soa_id', $soa->soa_id)->first()) $bordero = 'nonmarine';
            if (PremiNonMarine::where('soa_id', $soa->soa_id)->first()) $bordero = 'nonmarine';
            if (KlaimKredit::where('soa_id', $soa->soa_id)->first()) $bordero = 'kredit';
            if (PremiKredit::where('soa_id', $soa->soa_id)->first()) $bordero = 'kredit';
            $klaim_non_marine = KlaimNonMarine::where('soa_id', $soa->soa_id)->get();
            $premi_non_marine = PremiNonMarine::where('soa_id', $soa->soa_id)->get();
            $klaim_kredit = KlaimKredit::where('soa_id', $soa->soa_id)->get();
            $premi_kredit = PremiKredit::where('soa_id', $soa->soa_id)->get();
        } else if ($request->registration) {
            $registration = DocumentRegistration::find(base64_decode($request->registration));
            if (!$registration) abort(404);
            $soa = (object)[];
            $soa->registration = (object)[];
            $soa->registration = $registration;
        }

        extract($this->mainVariable(' - Entry'));
        $props = Prop::all()->load('getcob');
        return view('crm.transaction.treaty.soa.entry', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'props',
            'soa',
            'soa_list',
            'premium_reserved',
            'document_attach',
            'klaim_non_marine',
            'premi_non_marine',
            'klaim_kredit',
            'premi_kredit',
            'bordero',
        ));
    }

    public function bordero()
    {
        extract($this->mainVariable(' - Bordero Form'));
        return view('crm.transaction.treaty.soa.bordero', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
        ));
    }

    public function getTreatySummary(Request $request)
    {
        $props = new Prop;
        if ($request->uwy != null) {
            $props = $props->where('treaty_year', $request->uwy);
        }
        if ($request->cb != null) {
            $props = $props->where('ceding_broker', $request->cb);
        }
        if ($request->cc != null) {
            $props = $props->where('ceding_company', $request->cc);
        }
        $props = $props->with('getcob')->get();
        return response()->json(['props' => $props]);
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

    public function getCopy(Request $request)
    {
        // $soa = Soa::where('date_prod', date('Y-m-d', strtotime(str_replace('/', '-', $request->date_prod))));
        $soa = new Soa;
        if ($request->period) {
            $soa = $soa->where('date_prod_period', $request->period);
        }
        if ($request->month) {
            $soa = $soa->where('date_prod_month', $request->month);
        }
        if ($request->year) {
            $soa = $soa->where('date_prod_year', $request->year);
        }
        $soa = $soa->with('getprop.getkoc', 'getprop.getcob', 'getbroker', 'getcompany')->get();
        return $soa;
    }

    public function replace(Request $request, Soa $soa)
    {
        $validation = $this->validationHanlder($request);
        if ($validation) {
            $data = [$soa->counter_number];
            $this->requestHanlder($request, 'replace', $data);

            //#region create soa minus
            $soa_minus = $soa->replicate();
            $soa_minus->status = 'Cancelation';
            $columns = [
                'r_i_comm_percentage',
                'cash_call_limit',
                'treaty_gross_premium',
                'treaty_premium_released',
                'treaty_premium_reserved',
                'treaty_interest_on_premium_percentage',
                'treaty_interest_on_premium_amount',
                'treaty_r_i_comm_percentage',
                'treaty_r_i_comm_amount',
                'treaty_overrider_percentage',
                'treaty_overrider_amount',
                'treaty_net_premium',
                'treaty_paid_losses',
                'treaty_claim_recovery',
                'treaty_result',
                'treaty_cash_loss',
                'treaty_common_a_c_xol',
                'treaty_balance',
                'treaty_vat_percentage',
                'treaty_vat',
                'treaty_vat_balance',
                'nasionalre_share',
                'nasionalre_gross_premium',
                'nasionalre_r_i_comm_percentage',
                'nasionalre_r_i_comm_amount',
                'nasionalre_overrider_percentage',
                'nasionalre_overrider_amount',
                'nasionalre_interest_percentage',
                'nasionalre_interest_amount',
                'nasionalre_net_premium',
                'nasionalre_paid_losses',
                'nasionalre_claim_recovery',
                'nasionalre_result',
                'nasionalre_cash_loss',
                'nasionalre_common_a_c_xol',
                'nasionalre_balance',
                'nasionalre_vat_percentage',
                'nasionalre_vat',
                'nasionalre_vat_balance',
            ];
            foreach ($columns as $c) {
                $soa_minus->{$c} = (float)$soa_minus->{$c} == 0 ? $soa_minus->{$c} : $soa_minus->{$c} * -1;
            }
            $soa_minus->save();
            //#region create soa minus

            //#region create soa new
            $soa_new = Soa::create($request->except(['premium_reserved_id', 'premium_reserved_amount', '_token', 'nasionalre_share_checkbox', 'attach_id', 'attach_description', 'attach_url']));
            if ($request->premium_reserved_amount && count($request->premium_reserved_amount) > 0) foreach ($request->premium_reserved_amount as $amount) {
                PremiumReserved::create([
                    'soa_id' => $soa_new->id,
                    'amount' => $amount,
                ]);
            }
            if ($request->attach_description && count($request->attach_description) > 0) foreach ($request->attach_description as $key => $description) {
                AttachmentDocument::create([
                    'soa_id' => $soa_new->id,
                    'description' => $description,
                    'url' => $request->attach_url[$key],
                ]);
            }
            //#region create soa new

            $notification = array(
                'message' => 'SOA cancel replace successfully!',
                'alert-type' => 'success'
            );
            return redirect('/treaty/soa/entry?id=' . base64_encode($soa_new->id))->with($notification);
        }
        $notification = array(
            'message' => $validation,
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
