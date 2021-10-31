<?php

namespace App\Http\Controllers\Treaty;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CedingBroker;
use App\Models\COB;
use App\Models\Currencies;
use App\Models\Koc;
use App\Models\Retro\Contract\SpecialContract;
use App\Models\Retro\Mindep\MainContract;
use App\Models\Treaty\Prop\BackupRetro;
use App\Models\Treaty\Prop\BankLnkb;
use App\Models\Treaty\Prop\LossParticipation;
use App\Models\Treaty\Prop\Prop;
use App\Models\Treaty\Prop\SlidingScale;
use App\Models\Treaty\Prop\StructureLimit;
use App\Models\Treaty\Prop\SubDetailContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PropController extends Controller
{

    public function validationHanlder($request)
    {
        return $request->validate([
            'retro_contract_no' => 'required',
            'treaty_code' => 'required',
            'treaty_year' => 'required',
            'ceding_broker' => 'required',
            'ceding_company' => 'required',
            'id_detail_contract' => 'required',
            'cob' => 'required',
            'koc' => 'required',
            'type_perusahaan' => 'required',
            'period_from' => 'required',
            'period_to' => 'required',
            'business_type' => 'required',
            'currency' => 'required',
            'treaty_limit' => 'required',
            'gross_or' => 'required',
            'net_or' => 'required',
            'line' => 'required',
            'event_limit' => 'required',
            'cession_limit' => 'required',
            'pla' => 'required',
            'cash_call_limit' => 'required',
            'claim_coop_limit' => 'required',
            'accumulation_control_interval' => 'required',
            'accumulation_control_day' => 'required',
            'date_prod' => 'required',
            'e_p_i' => 'required',
            'treaty_system' => 'required',
            'nasionalre_share_first' => 'required',
            'nasionalre_share_second' => 'required',
            'prof_comm_decision' => 'required',
            'year_dcf' => 'required',
            'prof_comm_percentage' => 'required',
            'mgt_exp' => 'required',
            'r_i_comm_gross' => 'required',
            'r_i_comm_nett' => 'required',
            'brokerage' => 'required',
            'bordereaux_reporting' => 'required',
            'bordereaux_reporting_account' => 'required',
            'submission' => 'required',
            'confirmation' => 'required',
            'settlement' => 'required',
            'total_account_period' => 'required',
            'remark' => 'required',
            'status' => 'required',
            'leader_member_id' => 'required',
            'leader_member_status' => 'required',
            'basis_of_contract' => 'required',
        ]);
    }

    public function requestHanlder($request)
    {
        $request->merge([
            'period_from' => date("Y-m-d", strtotime(str_replace('/', '-', $request->period_from))),
            'period_to' => date("Y-m-d", strtotime(str_replace('/', '-', $request->period_to))),
            'date_prod' => date("Y-m-d", strtotime(str_replace('/', '-', $request->date_prod))),
            'roe' => str_replace(',', '', $request->roe),
            'treaty_limit' => str_replace(',', '', $request->treaty_limit),
            'gross_or' => str_replace(',', '', $request->gross_or),
            'net_or' => str_replace(',', '', $request->net_or),
            'event_limit' => str_replace(',', '', $request->event_limit),
            'cession_limit' => str_replace(',', '', $request->cession_limit),
            'pla' => str_replace(',', '', $request->pla),
            'cash_call_limit' => str_replace(',', '', $request->cash_call_limit),
            'claim_coop_limit' => str_replace(',', '', $request->claim_coop_limit),
            'e_p_i' => str_replace(',', '', $request->e_p_i),
            'nasionalre_share_first' => str_replace(',', '', $request->nasionalre_share_first),
            'nasionalre_share_second' => str_replace(',', '', $request->nasionalre_share_second),
            'prof_comm_percentage' => str_replace(',', '', $request->prof_comm_percentage),
            'mgt_exp' => str_replace(',', '', $request->mgt_exp),
            'r_i_comm_gross' => str_replace(',', '', $request->r_i_comm_gross),
            'r_i_comm_nett' => str_replace(',', '', $request->r_i_comm_nett),
            'brokerage' => str_replace(',', '', $request->brokerage),
            'vat_check' => (bool)$request->vat_check,
            'user_entry' => auth()->id(),
        ]);
    }

    public $prop_col = [
        'treaty_code',
        'treaty_year',
        'ceding_broker',
        'id_detail_contract',
        'ceding_company',
        'cob',
        'koc',
        'type_perusahaan',
        'type',
        'ceding_broker_type',
    ];

    public $subdetail_col = [
        '_token',
        'retro_ids',
        'retro_contract_no',
        'retro_percentage',
        'sliding_ids',
        'sliding_r_i_comm',
        'sliding_loss_ratio_first',
        'sliding_loss_ratio_second',
        'par_ids',
        'par_share',
        'par_loss_ratio_first',
        'par_loss_ratio_second',
        'treaty_code',
        'treaty_year',
        'ceding_broker',
        'id_detail_contract',
        'ceding_company',
        'cob',
        'koc',
        'type_perusahaan',
        'type',
        'ceding_broker_type',
        'sl_ids',
        'sl_ban_limit',
        'sl_net_or',
        'sl_nasionalre_first',
        'sl_nasionalre_second',
        'bank_ids',
        'banks',
    ];

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

            $this->requestHanlder($request);

            $prop = Prop::firstOrCreate($request->only($this->prop_col));

            $var = SubDetailContract::where('prop_id', $prop->id)
                ->orderBy('counter_number', 'desc')->first();
            $counter = isset($var) ? $var->counter_number + 1 : 1;
            $var = $counter;
            while (strlen((string)$counter) < 3) $counter = '0' . $counter;
            $id_sub_detail_contract = $request->id_detail_contract . '/' . $counter;

            $request->merge([
                'prop_id' => $prop->id,
                'id_sub_detail_contract' => $id_sub_detail_contract,
                'counter_number' => (int)$var,
            ]);

            $subdetail = SubDetailContract::create($request->except($this->subdetail_col));

            if ($subdetail) {
                if ($request->retro_contract_no) foreach ($request->retro_contract_no as $key => $retro) {
                    BackupRetro::create([
                        'retro_contract_no' => $retro,
                        'retro_percentage' => str_replace(',', '', $request->retro_percentage[$key]),
                        'sub_detail_id' => $subdetail->id,
                    ]);
                }
                if ($request->sliding_r_i_comm) foreach ($request->sliding_r_i_comm as $key => $ri_comm) {
                    SlidingScale::create([
                        'r_i_comm' => str_replace(',', '', $ri_comm),
                        'loss_ratio_first' => str_replace(',', '', $request->sliding_loss_ratio_first[$key]),
                        'loss_ratio_second' => str_replace(',', '', $request->sliding_loss_ratio_second[$key]),
                        'sub_detail_id' => $subdetail->id,
                    ]);
                }
                if ($request->par_share) foreach ($request->par_share as $key => $share) {
                    LossParticipation::create([
                        'share' => str_replace(',', '', $share),
                        'loss_ratio_first' => str_replace(',', '', $request->par_loss_ratio_first[$key]),
                        'loss_ratio_second' => str_replace(',', '', $request->par_loss_ratio_second[$key]),
                        'sub_detail_id' => $subdetail->id,
                    ]);
                }
                if ($request->banks) foreach ($request->banks as $key => $bank) {
                    BankLnkb::create([
                        'bank_id' => $bank,
                        'sub_detail_id' => $subdetail->id,
                    ]);
                }
                if ($request->sl_ban_limit)
                    foreach ($request->sl_ban_limit as $key => $ban) {
                        $var = StructureLimit::where('sub_detail_id', $subdetail->id)
                            ->orderBy('counter_number', 'desc')->first();
                        $counter = isset($var) ? $var->counter_number + 1 : 1;
                        $var = $counter;
                        while (strlen((string)$counter) < 3) $counter = '0' . $counter;
                        $id_structure_limit = $subdetail->id_sub_detail_contract . '/BL/' . $counter;
                        StructureLimit::create([
                            'id_structure_limit' => $id_structure_limit,
                            'counter_number' => $var,
                            'sub_detail_id' => $subdetail->id,
                            'ban_limit' => str_replace(',', '', $ban),
                            'net_or' => str_replace(',', '', $request->sl_net_or[$key]),
                            'nasionalre_first' => str_replace(',', '', $request->sl_nasionalre_first[$key]),
                            'nasionalre_second' => str_replace(',', '', $request->sl_nasionalre_second[$key]),
                        ]);
                    }
            }

            $notification = array(
                'message' => $request->type == 'credit' ? 'Summary Prop Credit added successfully!' : 'Summary Prop added successfully!',
                'alert-type' => 'success'
            );
            $url = '/treaty/prop/entry?id=';
            if ($request->type == 'credit') $url = '/treaty/prop/credit/entry?id=';
            return redirect($url . base64_encode($subdetail->id))->with($notification);
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
    public function show(Prop $prop)
    {
        return $prop->load('getsubdetail');
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
    public function update(Request $request, SubDetailContract $subDetailContract)
    {
        $this->requestHanlder($request);

        $input = $request->except($this->subdetail_col);
        $subDetailContract->fill($input)->save();

        if (@$request->retro_ids) {
            BackupRetro::where('sub_detail_id', $subDetailContract->id)->whereNotIn('id', $request->retro_ids)->delete();
            foreach ($request->retro_ids as $key => $id) {
                if (!BackupRetro::where('id', $id)->exists()) {
                    BackupRetro::create([
                        'sub_detail_id', $subDetailContract->id,
                        'retro_contract_no' => $request->retro_contract_no[$key],
                        'retro_percentage' => str_replace(',', '', $request->retro_percentage[$key]),
                    ]);
                }
            }
        } elseif (BackupRetro::where('sub_detail_id', $subDetailContract->id)->exists()) {
            BackupRetro::where('sub_detail_id', $subDetailContract->id)->delete();
        }

        if (@$request->sliding_ids) {
            SlidingScale::where('sub_detail_id', $subDetailContract->id)->whereNotIn('id', $request->sliding_ids)->delete();
            foreach ($request->sliding_ids as $key => $id) {
                if (!SlidingScale::where('id', $id)->exists()) {
                    SlidingScale::create([
                        'r_i_comm' => str_replace(',', '', $request->sliding_r_i_comm[$key]),
                        'loss_ratio_first' => str_replace(',', '', $request->sliding_loss_ratio_first[$key]),
                        'loss_ratio_second' => str_replace(',', '', $request->sliding_loss_ratio_second[$key]),
                        'sub_detail_id' => $subDetailContract->id,
                    ]);
                }
            }
        } elseif (SlidingScale::where('sub_detail_id', $subDetailContract->id)->exists()) {
            SlidingScale::where('sub_detail_id', $subDetailContract->id)->delete();
        }

        if (@$request->par_ids) {
            LossParticipation::where('sub_detail_id', $subDetailContract->id)->whereNotIn('id', $request->par_ids)->delete();
            foreach ($request->par_ids as $key => $id) {
                if (!LossParticipation::where('id', $id)->exists()) {
                    LossParticipation::create([
                        'share' => str_replace(',', '', $request->par_share[$key]),
                        'loss_ratio_first' => str_replace(',', '', $request->par_loss_ratio_first[$key]),
                        'loss_ratio_second' => str_replace(',', '', $request->par_loss_ratio_second[$key]),
                        'sub_detail_id' => $subDetailContract->id,
                    ]);
                }
            }
        } elseif (LossParticipation::where('sub_detail_id', $subDetailContract->id)->exists()) {
            LossParticipation::where('sub_detail_id', $subDetailContract->id)->delete();
        }

        if (@$request->bank_ids) {
            BankLnkb::where('sub_detail_id', $subDetailContract->id)->whereNotIn('id', $request->bank_ids)->delete();
            foreach ($request->bank_ids as $key => $id) {
                if (!BankLnkb::where('id', $id)->exists()) {
                    BankLnkb::create([
                        'bank_id' => $request->banks[$key],
                        'sub_detail_id' => $subDetailContract->id,
                    ]);
                }
            }
        } elseif (BankLnkb::where('sub_detail_id', $subDetailContract->id)->exists()) {
            BankLnkb::where('sub_detail_id', $subDetailContract->id)->delete();
        }

        if (@$request->sl_ids) {
            StructureLimit::where('sub_detail_id', $subDetailContract->id)->whereNotIn('id', $request->sl_ids)->delete();
            foreach ($request->sl_ids as $key => $id) {
                if (!StructureLimit::where('id', $id)->exists()) {
                    $var = StructureLimit::where('sub_detail_id', $subDetailContract->id)
                        ->orderBy('counter_number', 'desc')->first();
                    $counter = isset($var) ? $var->counter_number + 1 : 1;
                    $var = $counter;
                    while (strlen((string)$counter) < 3) $counter = '0' . $counter;
                    $id_structure_limit = $subDetailContract->id_sub_detail_contract . '/BL/' . $counter;
                    StructureLimit::create([
                        'id_structure_limit' => $id_structure_limit,
                        'counter_number' => $var,
                        'sub_detail_id' => $subDetailContract->id,
                        'ban_limit' => str_replace(',', '', $request->sl_ban_limit[$key]),
                        'net_or' => str_replace(',', '', $request->sl_net_or[$key]),
                        'nasionalre_first' => str_replace(',', '', $request->sl_nasionalre_first[$key]),
                        'nasionalre_second' => str_replace(',', '', $request->sl_nasionalre_second[$key]),
                    ]);
                }
            }
        } elseif (StructureLimit::where('sub_detail_id', $subDetailContract->id)->exists()) {
            StructureLimit::where('sub_detail_id', $subDetailContract->id)->delete();
        }

        $notification = array(
            'message' => $request->type == 'credit' ? 'Summary Prop Credit updated successfully!' : 'Summary Prop updated successfully!',
            'alert-type' => 'success'
        );
        $url = '/treaty/prop/entry?id=';
        if ($request->type == 'credit') $url = '/treaty/prop/credit/entry?id=';
        return redirect($url . base64_encode($subDetailContract->id))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return SubDetailContract::where('id', $id)->update(['is_delete', true]);
    }

    public function mainVariable($route, $iscredit = false)
    {
        $route_active = 'TREATY & RETROCESSION Summary Prop ' . $route;
        $koc = Koc::where('parent_id', 6)->get();
        if ($iscredit) {
            $cob = COB::where('code', 'like', '052%')->get();
        } else {
            $cob = COB::where('code', 'not like', '052%')->get();
        }
        $currencies = Currencies::all();
        $ceding = CedingBroker::all();
        $mainContract = MainContract::all();
        $specialContract = SpecialContract::all();
        return compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'mainContract',
            'specialContract',
        );
    }

    public function entry(Request $request)
    {
        $subdetail = $retros = $slidings = $losses = $contracts = $has_soa = null;
        if ($request->id) {
            $subdetail = SubDetailContract::find(base64_decode($request->id));
            if (!$subdetail) abort(404);
            $subdetail = $subdetail->load('getprop.getkoc', 'getuser');
            $retros = BackupRetro::where('sub_detail_id', $subdetail->id)->get();
            $slidings = SlidingScale::where('sub_detail_id', $subdetail->id)->get();
            $losses = LossParticipation::where('sub_detail_id', $subdetail->id)->get();
            $contracts = SubDetailContract::with('getprop.getkoc', 'getprop.getcob', 'getprop.getbroker')
                ->where('prop_id', $subdetail->prop_id)
                ->whereHas('getprop', function ($q) {
                    $q->where('type', 'prop');
                })
                ->has('getprop')
                ->where('is_delete', 0)
                ->get();
            $has_soa = count(Prop::where('id', $subdetail->prop_id)->has('getsoa')->get());
        }
        if ($request->treaty_year && $request->treaty_code && $request->ceding_broker) {
            $subdetail = (object)[];
            $subdetail->getprop = (object)[];
            $subdetail->getprop->treaty_year = $request->treaty_year;
            $subdetail->getprop->treaty_code = $request->treaty_code;
            $subdetail->getprop->ceding_broker = $request->ceding_broker;
        }
        extract($this->mainVariable('- Entry'));
        return view('crm.transaction.treaty.prop.entry', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'subdetail',
            'retros',
            'slidings',
            'losses',
            'contracts',
            'has_soa',
            'mainContract',
            'specialContract',
        ));
    }

    public function list(Request $request)
    {
        extract($this->mainVariable('- List'));
        $subdetail = SubDetailContract::with('getprop.getbroker', 'getcurrency')->where('is_delete', 0);
        // return $subdetail->get();
        if ($request->treatyyear) {
            $subdetail = $subdetail->whereHas('getprop', function ($q) use ($request) {
                $q->where('treaty_year', $request->treatyyear);
            })->has('getprop');
        }
        if ($request->ceding_broker) {
            $subdetail = $subdetail->whereHas('getprop', function ($q) use ($request) {
                $q->where('ceding_broker', $request->ceding_broker);
            })->has('getprop');
        }
        if ($request->ceding_company) {
            $subdetail = $subdetail->whereHas('getprop', function ($q) use ($request) {
                $q->where('ceding_company', $request->ceding_company);
            })->has('getprop');
        }
        if ($request->cob_input) {
            $subdetail = $subdetail->whereHas('getprop', function ($q) use ($request) {
                $q->where('cob', $request->cob_input);
            })->has('getprop');
        }
        if ($request->koc_input) {
            $subdetail = $subdetail->whereHas('getprop', function ($q) use ($request) {
                $q->where('koc', $request->koc_input);
            })->has('getprop');
        }
        if ($request->periodfrom) {
            $subdetail = $subdetail->whereDate('period_from', date('Y-m-d', strtotime(str_replace('/', '-', $request->periodfrom))));
        }
        if ($request->periodto) {
            $subdetail = $subdetail->whereDate('period_to', date('Y-m-d', strtotime(str_replace('/', '-', $request->periodto))));
        }
        if ($request->status) {
            $subdetail = $subdetail->where('status', $request->status);
        }
        $subdetail = $subdetail->get();
        foreach ($subdetail as $sd) {
            if ($sd->getprop->type == "prop") {
                $sd->url = "/treaty/prop/entry";
            } elseif ($sd->getprop->type == "credit") {
                $sd->url = "/treaty/prop/credit/entry";
            }
        }
        return view('crm.transaction.treaty.prop.list', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'subdetail',
        ));
    }

    public function credit(Request $request)
    {
        extract($this->mainVariable('Credit - Entry', true));
        $subdetail = $retros = $slidings = $losses = $contracts = $has_soa = $structure = $credit_banks = null;
        if ($request->id) {
            $subdetail = SubDetailContract::find(base64_decode($request->id));
            if (!$subdetail) abort(404);
            $subdetail = $subdetail->load('getprop.getkoc', 'getuser');
            $retros = BackupRetro::where('sub_detail_id', $subdetail->id)->get();
            $slidings = SlidingScale::where('sub_detail_id', $subdetail->id)->get();
            $losses = LossParticipation::where('sub_detail_id', $subdetail->id)->get();
            $structure = StructureLimit::where('sub_detail_id', $subdetail->id)->get();
            $credit_banks = BankLnkb::where('sub_detail_id', $subdetail->id)->with('getbank')->get();
            $contracts = SubDetailContract::with('getprop.getkoc', 'getprop.getcob', 'getprop.getbroker')
                ->where('prop_id', $subdetail->prop_id)
                ->whereHas('getprop', function ($q) {
                    $q->where('type', 'prop');
                })
                ->has('getprop')
                ->where('is_delete', 0)
                ->get();
            $has_soa = count(Prop::where('id', $subdetail->prop_id)->has('getsoa')->get());
        }
        if ($request->treaty_year && $request->treaty_code && $request->ceding_broker) {
            $subdetail = (object)[];
            $subdetail->getprop = (object)[];
            $subdetail->getprop->treaty_year = $request->treaty_year;
            $subdetail->getprop->treaty_code = $request->treaty_code;
            $subdetail->getprop->ceding_broker = $request->ceding_broker;
        }
        $banks = Bank::all();
        return view('crm.transaction.treaty.prop.credit', compact(
            'route_active',
            'koc',
            'cob',
            'currencies',
            'ceding',
            'subdetail',
            'retros',
            'slidings',
            'losses',
            'contracts',
            'has_soa',
            'banks',
            'structure',
            'credit_banks',
            'mainContract',
            'specialContract',
        ));
    }

    public function getsubdetail(Prop $prop)
    {
        return collect($prop->load('getcob', 'getallsubdetail'));
    }

    public function getbanlimit(SubDetailContract $subDetailContract)
    {
        return collect($subDetailContract->load('banlimit'))->get('banlimit');
    }
}
