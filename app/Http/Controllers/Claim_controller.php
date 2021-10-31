<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Models\TransLocation;
use App\Models\Currency;
use App\Models\COB;
use App\Models\Occupation;
use App\Models\Koc;
use App\Models\User;
use App\Models\Insured;
use App\Models\CedingBroker;
use App\Models\ClaimInsuredData;
use App\Models\ClaimViewAttachment;
use App\Models\CurrencyExchange;
use App\Models\TransLocationTemp;
use App\Models\SlipTable;
use App\Models\EarthQuakeZone;
use App\Models\FeLookupLocation;
use App\Models\FloodZone;
use App\Models\NatureOfLoss;
use App\Models\MasterCauseOfLoss;
use App\Models\Surveyor;
use App\Models\InterestInsured;
use App\Models\InstallmentTemp;
use App\Models\PrefixInsured;
use App\Models\ClaimDetail;
use App\Models\ClaimLossDescription;
use App\Models\RiskLocationDetail;
use App\Models\InterestInsuredTemp;
use App\Models\LossDescription;
use App\Models\ShipListTemp;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Session;
use Mail;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\each;

class Claim_controller extends Controller
{

    public function __construct()
    {
        $type = request()->route('type');
        if (in_array($type, ['mc', 'mh'])) {
            $type = 'marine';
        }
        $this->middleware(['can:create-claim-' . $type]);
    }

    public function amountClaimDuplicate($amount, $counter, $iscorrection = false, $ismulti = false)
    {
        foreach ($amount as $amountdata) {

            $new_amountdata = $amountdata->replicate();

            if ($iscorrection) {
                $new_amountdata->doc_counter = $counter + 1;
                $new_amountdata->amount = ($amountdata->amount * -1);
                $new_amountdata->is_correction = 1;
            } else {
                $new_amountdata->doc_counter = $counter;
            }

            if ($ismulti) {
                $new_amountdata->reg_comp = $ismulti;
            }

            $new_amountdata->save();
        }
    }

    public function toNegative($claimdata, $status_flag = null, $interim_count = null, $close_dla = false)
    {
        if ($close_dla) {
            $claimdata->nasre_liab = 0;
            $claimdata->nasre_liabdesc = 0;
            $claimdata->nasre_share_loss = 0;
            $claimdata->ced_share = 0;
            $claimdata->total_loss_amount = 0;
            $claimdata->potential_recovery = 0;
            $claimdata->estimate_percent_subro = 0;
            $claimdata->estimate_amount_subro = 0;

            $claimdata->pureor_liability = 0;
            $claimdata->pureor_loss = 0;
            $claimdata->pureor_recovery = 0;

            $claimdata->qs_liability = 0;
            $claimdata->qs_loss = 0;
            $claimdata->qs_recovery = 0;

            $claimdata->arr1_liability = 0;
            $claimdata->arr1_loss = 0;
            $claimdata->arr1_recovery = 0;

            $claimdata->extra_liability = 0;
            $claimdata->extra_loss = 0;
            $claimdata->extra_recovery = 0;

            $claimdata->facultative_liability = 0;
            $claimdata->facultative_loss = 0;
            $claimdata->facultative_recovery = 0;

            $claimdata->arr2_liability = 0;
            $claimdata->arr2_loss = 0;
            $claimdata->arr2_recovery = 0;

            $claimdata->arr3_liability = 0;
            $claimdata->arr3_loss = 0;
            $claimdata->arr3_recovery = 0;

            $claimdata->totalrecovery = 0;
            $claimdata->nrsgrossret = 0;
            $claimdata->xol = 0;
        } else {
            $claimdata->nasre_liabdesc = $claimdata->nasre_liabdesc * -1;
            $claimdata->nasre_share_loss = $claimdata->nasre_share_loss * -1;
            $claimdata->ced_share = $claimdata->ced_share * -1;
            $claimdata->total_loss_amount = $claimdata->total_loss_amount * -1;
            $claimdata->potential_recovery = $claimdata->potential_recovery * -1;
            $claimdata->estimate_amount_subro = $claimdata->estimate_amount_subro * -1;

            $claimdata->pureor_liability = $claimdata->pureor_liability * -1;
            $claimdata->pureor_loss = $claimdata->pureor_loss * -1;
            $claimdata->pureor_recovery = $claimdata->pureor_recovery * -1;

            $claimdata->qs_liability = $claimdata->qs_liability * -1;
            $claimdata->qs_loss = $claimdata->qs_loss * -1;
            $claimdata->qs_recovery = $claimdata->qs_recovery * -1;

            $claimdata->arr1_liability = $claimdata->arr1liability * -1;
            $claimdata->arr1_loss = $claimdata->arr1loss * -1;
            $claimdata->arr1_recovery = $claimdata->arr1recovery * -1;

            $claimdata->extra_liability = $claimdata->extraliability * -1;
            $claimdata->extra_loss = $claimdata->extraloss * -1;
            $claimdata->extra_recovery = $claimdata->extrarecovery * -1;

            $claimdata->facultative_liability = $claimdata->facultativeliability * -1;
            $claimdata->facultative_loss = $claimdata->facultativeloss * -1;
            $claimdata->facultative_recovery = $claimdata->facultativerecovery * -1;

            $claimdata->arr2_liability = $claimdata->arr2liability * -1;
            $claimdata->arr2_loss = $claimdata->arr2loss * -1;
            $claimdata->arr2_recovery = $claimdata->arr2recovery * -1;

            $claimdata->arr3_liability = $claimdata->arr3liability * -1;
            $claimdata->arr3_loss = $claimdata->arr3loss * -1;
            $claimdata->arr3_recovery = $claimdata->arr3recovery * -1;

            $claimdata->totalrecovery = $claimdata->totalrecovery * -1;
            $claimdata->nrsgrossret = $claimdata->nrsgrossret * -1;
            $claimdata->xol = $claimdata->xol * -1;
        }

        if ($status_flag) {
            $claimdata->status_flag = $status_flag;
        }

        if ($interim_count) {
            $claimdata->interim_count = $interim_count;
        }

        $claimdata->save();
    }

    public function replicateClaim($new_claim, $request)
    {
        $new_claim->number = $request->number;
        $new_claim->reg_comp = $request->regcomp;
        $new_claim->doc_number = $request->docnumber;
        $new_claim->docpladla = $request->docpladla;
        $new_claim->date_receipt = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofreceipt))) ?? date("Y-m-d", strtotime($request->dateofreceipt));
        $new_claim->date_document = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofdocument))) ?? date("Y-m-d", strtotime($request->dateofdocument));
        $new_claim->causeofloss_id = $request->causeofloss;
        $new_claim->natureofloss_id = $request->natureofloss;
        $new_claim->date_of_loss = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss));
        $new_claim->curr_id_loss = $request->currofloss;
        $new_claim->adjuster_id = $request->adjuster;
        $new_claim->surveyor_id = $request->surveyor;
        $new_claim->desc_surveyor = $request->descsurveyor;
        $new_claim->nasre_liab = $request->nationalresliab;
        $new_claim->nasre_liabdesc = $request->descnationalresliab;
        $new_claim->nasre_share_loss = $request->shareonloss;
        $new_claim->ced_share = $request->cedantshare;
        $new_claim->total_loss_amount = $request->totallossamount;
        $new_claim->potential_recovery = $request->potentialrecoverydecision;
        $new_claim->estimate_percent_subro = $request->subrogasipersen;
        $new_claim->estimate_amount_subro = $request->subrogasi;
        $new_claim->desc_poten_rec = $request->potentialrecovery;
        $new_claim->kronologi = $request->kronologi;
        $new_claim->staff_recomendation = $request->staffrecomend;
        $new_claim->ass_man_recomen = $request->assistantmanagerrecomend;
        $new_claim->man_recomen = $request->managerrecomend;
        $new_claim->gen_man_recomen = $request->generalmanagerrecomend;
        $new_claim->is_delete = 0;
        $new_claim->dateofentry = now();
    }

    public function updateClaimEntry($claimdata, $request)
    {
        $claimdata->number = $request->number;
        $claimdata->reg_comp = $request->regcomp;
        $claimdata->doc_number = $request->docnumber;
        $claimdata->docpladla = $request->docpladla;
        $claimdata->date_receipt = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofreceipt))) ?? date("Y-m-d", strtotime($request->dateofreceipt));
        $claimdata->date_document = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofdocument))) ?? date("Y-m-d", strtotime($request->dateofdocument));
        $claimdata->causeofloss_id = $request->causeofloss;
        $claimdata->natureofloss_id = $request->natureofloss;
        $claimdata->date_of_loss = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss));
        $claimdata->curr_id_loss = $request->currofloss;
        $claimdata->adjuster_id = $request->adjuster;
        $claimdata->surveyor_id = $request->surveyor;
        $claimdata->desc_surveyor = $request->descsurveyor;
        $claimdata->nasre_liab = $request->nationalresliab;
        $claimdata->nasre_liabdesc = $request->descnationalresliab;
        $claimdata->nasre_share_loss = $request->shareonloss;
        $claimdata->ced_share = $request->cedantshare;
        $claimdata->total_loss_amount = $request->totallossamount;
        $claimdata->estimate_percent_subro = $request->subrogasipersen;
        $claimdata->estimate_amount_subro = $request->subrogasi;

        $claimdata->potential_recovery = $request->potentialrecoverydecision;
        $claimdata->desc_poten_rec = $request->potentialrecovery;
        $claimdata->kronologi = $request->kronologi;
        $claimdata->staff_recomendation = $request->staffrecomend;
        $claimdata->ass_man_recomen = $request->assistantmanagerrecomend;
        $claimdata->man_recomen = $request->managerrecomend;
        $claimdata->gen_man_recomen = $request->generalmanagerrecomend;

        $claimdata->description = $request->description;
        $claimdata->dateofentry = now();
        $claimdata->dateoftrans = $request->datetrans ? date("Y-m-d", strtotime(str_replace('/', '-', $request->datetrans))) ?? date("Y-m-d", strtotime($request->datetrans)) : null;
        $claimdata->dateofsupporting = $request->datesupporting ? date("Y-m-d", strtotime(str_replace('/', '-', $request->datesupporting))) ?? date("Y-m-d", strtotime($request->datesupporting)) : null;

        $claimdata->user_id = auth()->id();
        $claimdata->save();

        $claim_datas = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('doc_counter', '<', $claimdata->doc_counter)->get();

        foreach ($claim_datas as $cd) {
            $cd->causeofloss_id = $request->causeofloss;
            $cd->natureofloss_id = $request->natureofloss;
            $cd->date_of_loss = date("Y-m-d", strtotime($request->dateofloss));
            $cd->adjuster_id = $request->adjuster;
            $cd->desc_adjuster = $request->descadjuster;
            $cd->surveyor_id = $request->surveyor;
            $cd->desc_surveyor = $request->descsurveyor;
            $cd->save();
        }

        return response()->json(['id' => $claimdata->id, 'id_base' => base64_encode($claimdata->id),]);
    }

    public function index($type)
    {
        if ($type == 'fe') {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'CLAIM FIRE & ENGINEERING - Entry';
        } elseif ($type == 'fl') {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'CLAIM FINANCIAL LINES - Entry';
        } elseif ($type == 'hem') {
            $form_name = 'HE & MOTOR';
            $route_active = 'CLAIM HE & MOTOR - Entry';
        } elseif ($type == 'mp') {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'CLAIM MOVEABLE PROPERTY - Entry';
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'CLAIM HOLE IN ONE - Entry';
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'CLAIM PERSONAL ACCIDENT - Entry';
        } elseif ($type == 'mc') {
            $form_name = 'MARINE CARGO';
            $route_active = 'CLAIM MARINE CARGO - Entry';
        } elseif ($type == 'mh') {
            $form_name = 'MARINE HULL';
            $route_active = 'CLAIM MARINE HULL - Entry';
        } else {
            abort(404);
        }

        $currency = Currency::orderby('id', 'asc')->get();
        $cob = COB::where('form', $type == "mh" || $type == "mc" ? "ms" : $type)->orderby('id', 'asc')->get();
        $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02%')->orderby('code', 'asc')->get();
        $ocp = Occupation::orderby('id', 'asc')->get();
        $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
        $ceding = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
        $surveyor = Surveyor::orderby('id', 'asc')->get();
        $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
        $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
        $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
        $lossdesc = LossDescription::orderby('id', 'asc')->get();
        $cedings = CedingBroker::orderby('id', 'asc')->get();
        $insureds = InterestInsured::orderby('id', 'asc')->get();

        $allcob = COB::all();
        $allkoc = Koc::all();

        return view('crm.transaction.claim.index', compact(
            'form_name',
            'type',
            'insureds',
            'cedings',
            'lossdesc',
            'prefixinsured',
            'causeofloss',
            'natureofloss',
            'surveyor',
            'ceding',
            'cedingbroker',
            'currency',
            'cob',
            'koc',
            'ocp',
            'route_active',
            'allcob',
            'allkoc',
        ));
    }

    public function getCountClaim($number)
    {
        if ($number != '') {

            $claimdata = ClaimDetail::where('number', 'like', '%' . $number . '%')->orderby('id', 'DESC')->count();

            if (!empty($claimdata)) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Count Data",
                        'countsum' => $claimdata,
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Slip Number, No Count Data",
                        'countsum' => 0,
                    ]
                );
            }
        } else {

            return response()->json(
                [
                    'status' => 201,
                    'message' => "Slip Number, No Count Data"
                ]
            );
        }
    }

    public function destroyamountmanuallist($type, $id)
    {
        $claimTemplist = ClaimLossDescription::find($id);

        $claimTemplist->delete();

        return response()->json(['success' => 'Data has been deleted']);
    }

    public function storemanualamountlist($type, Request $request)
    {

        $amountmanual = intval(preg_replace('/[^\d.-]/', '', $request->amountmanual));
        $reg_comp = $request->reg_comp;
        $description_id = $request->description_id;

        if ($reg_comp != '' && $amountmanual != '') {

            $retrocessionlist = new ClaimLossDescription();
            $retrocessionlist->description_id  = $description_id;
            $retrocessionlist->amount = $amountmanual;
            $retrocessionlist->reg_comp = $reg_comp;
            $retrocessionlist->doc_counter = $request->doc_counter;
            $retrocessionlist->doc_counter_created = $request->doc_counter;
            $retrocessionlist->save();

            $sumdata = ClaimLossDescription::where('reg_comp', $reg_comp)->where('is_correction', 0)->sum('amount');
            $data = ClaimLossDescription::with('descLoss')->find($retrocessionlist->id);

            return response()->json(
                [
                    'data' => $data,
                    'sumamount' => $sumdata
                ]
            );
        } else {

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fill all fields & Fill SLip Number First'
                ]
            );
        }
    }

    public function storelocationamountlist(Request $request)
    {

        $descripitonriskselect = $request->descripitonriskselect;
        $slipnumber = $request->slipnumber;
        $amounttablerisk = $request->amounttablerisk;

        if ($slipnumber != '' && $descripitonriskselect != '') {

            $risklocationdetaildata = RiskLocationDetail::where('id', '=', $descripitonriskselect)->first();

            $retrocessionlist = new ClaimLossDescription();

            $interestdata = InterestInsured::where('id', '=', $risklocationdetaildata->interest_id)->first();
            $cedingdata = CedingBroker::where('id', '=', $risklocationdetaildata->ceding_id)->first();

            $retrocessionlist->descripiton  = $interestdata->description . " " . $cedingdata->name;

            if (!empty($amounttablerisk)) {
                $retrocessionlist->amount = $amounttablerisk;
            } else {
                $retrocessionlist->amount = $risklocationdetaildata->amountlocation;
            }


            $retrocessionlist->slip_number = $slipnumber;
            $retrocessionlist->risk_location_id = $descripitonriskselect;
            //$retrocessionlist->slip_id = $slip_number; 
            //$retrocessionlist->insured_id = $slip_number; 
            $retrocessionlist->save();


            return response()->json(
                [
                    'id' => $retrocessionlist->id,
                    'descripiton' => $retrocessionlist->descripiton,
                    'amount' => $retrocessionlist->amount,
                    'slip_number' => $retrocessionlist->slip_number
                ]
            );
        } else {

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fill all fields & Fill SLip Number First'
                ]
            );
        }
    }

    public function updateindex($type, $id)
    {
        $mainClaimEntryFAC = ClaimDetail::find(base64_decode($id));
        $claimtype = $mainClaimEntryFAC->load('slip')->slip->slip_type;
        if ($type == 'fe' && $type == $claimtype) {
            $form_name = 'FIRE & ENGINEERING';
            $route_active = 'CLAIM FIRE & ENGINEERING - Entry';
        } elseif ($type == 'fl' && $type == $claimtype) {
            $form_name = 'FINANCIAL LINES';
            $route_active = 'CLAIM FINANCIAL LINES - Entry';
        } elseif ($type == 'hem' && $type == $claimtype) {
            $form_name = 'HE & MOTOR';
            $route_active = 'CLAIM HE & MOTOR - Entry';
        } elseif ($type == 'mp' && $type == $claimtype) {
            $form_name = 'MOVEABLE PROPERTY';
            $route_active = 'CLAIM MOVEABLE PROPERTY - Entry';
        } elseif ($type == 'hio' && $type == $claimtype) {
            $form_name = 'HOLE IN ONE';
            $route_active = 'CLAIM HOLE IN ONE - Entry';
        } elseif ($type == 'pa' && $type == $claimtype) {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'CLAIM PERSONAL ACCIDENT - Entry';
        } elseif ($type == 'mc' && $type == $claimtype) {
            $form_name = 'MARINE CARGO';
            $route_active = 'CLAIM MARINE CARGO - Entry';
        } elseif ($type == 'mh' && $type == $claimtype) {
            $form_name = 'MARINE HULL';
            $route_active = 'CLAIM MARINE HULL - Entry';
        } else {
            abort(404);
        }
        if ($type == 'mh' || $type == 'mc') {
            if ($type == 'mc') {
                $claiminsureds = ClaimInsuredData::has('ship')->with('ship', 'interestceding', 'interest')->where('reg_comp', $mainClaimEntryFAC->reg_comp)->get()->groupBy('ship.ship_name');
            } elseif ($type == 'mh') {
                $claiminsureds = ClaimInsuredData::has('ship')->with('ship', 'interestceding')->where('reg_comp', $mainClaimEntryFAC->reg_comp)->get();
            }
            $idclaim = $mainClaimEntryFAC->id;
            $claimdata = $mainClaimEntryFAC->load(
                'slip.insureddata',
                'slip.kindcontract',
                'slip.corebusiness',
                'slip.cedingbroker',
                'slip.ceding',
                'slip.insureddata.currency'
            );

            $users = User::all();
            $currency = Currency::orderby('id', 'asc')->get();
            $cob = COB::where('form', 'mc')->orWhere('form', 'mh')->orderby('id', 'asc')->get();
            $koc = Koc::where('code', 'like', '02%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
            $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
            $status_flag = $claimdata->status_flag;
            $viewattachs = $claimdata->viewattachs;
            $lossdesc = LossDescription::orderby('id', 'asc')->get();
            $cedings = CedingBroker::orderby('id', 'asc')->get();
            $insureds = InterestInsured::orderby('id', 'asc')->get();
            $surveyor = Surveyor::orderby('id', 'asc')->get();
            // $adjusters = Surveyor::orderby('id', 'asc')->where('type_flag', 2)->get();
            $placlaim = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('status_flag', 1)->orderby('id', 'DESC')->first();
            $desclosses = ClaimLossDescription::with('descLoss')->where('reg_comp', $claimdata->reg_comp)
                ->where('doc_counter', $placlaim->doc_counter)->get();

            $claims = ClaimDetail::where('reg_comp', $placlaim->reg_comp)->where('doc_counter', '>', $placlaim->doc_counter)->get();
            if ($claims) {
                $placlaimloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                    ->where('doc_counter', $placlaim->doc_counter)
                    ->where('is_correction', 0)
                    ->sum('amount');
                $lossamountlimit = 0;
                if ($claimdata->doc_counter != 1 && $claims) {
                    $lossamountlimit = $placlaimloss;
                    foreach ($claims as $cl) {
                        $clloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                            ->where('doc_counter', $cl->doc_counter)
                            ->where('is_correction', 0);
                        if ($clloss->get()) {
                            $clloss->sum('amount');
                            $lossamountlimit -= $clloss->sum('amount');
                        }
                    }
                }
            }

            $insured = $claimdata->slip->insureddata;
            $exchange =  CurrencyExchange::where('currency', $insured->currency_id)
                ->where('month', date('m', strtotime($insured->created_at)))
                ->where('year', date('Y', strtotime($insured->created_at)))
                ->latest()->first();

            $claimdata->slip->insureddata->exchange = $exchange;

            $allcob = COB::all();
            $allkoc = Koc::all();

            return view('crm.transaction.claim.updateindex', compact(
                'viewattachs',
                'users',
                'claiminsureds',
                'type',
                'desclosses',
                'surveyor',
                'placlaimloss',
                'insureds',
                'cedings',
                'lossamountlimit',
                'lossdesc',
                'idclaim',
                'claimdata',
                'prefixinsured',
                'causeofloss',
                'natureofloss',
                'ceding',
                'cedingbroker',
                'currency',
                'cob',
                'koc',
                'ocp',
                'route_active',
                'status_flag',
                'allcob',
                'allkoc',
            ));
        } else {
            $claimdata = $mainClaimEntryFAC->load(
                'slip.insureddata.currency',
                'slip.kindcontract',
                'slip.corebusiness',
                'userce',
                'viewattachs'
            );
            $idclaim = $mainClaimEntryFAC->id;
            if ($claimdata) {
                $users = User::all();
                $currency = Currency::orderby('id', 'asc')->get();
                $cob = COB::where('form', $type)->orderby('id', 'asc')->get();
                $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02%')->orderby('code', 'asc')->get();
                $ocp = Occupation::orderby('id', 'asc')->get();
                $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
                $ceding = CedingBroker::orderby('id', 'asc')->where('type', '4')->get();
                $surveyor = Surveyor::orderby('id', 'asc')->get();
                $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
                $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();
                $prefixinsured = PrefixInsured::orderby('id', 'asc')->get();
                $status_flag = $claimdata->status_flag;
                $viewattachs = $claimdata->viewattachs;
                $lossdesc = LossDescription::orderby('id', 'asc')->get();
                $cedings = CedingBroker::orderby('id', 'asc')->get();
                $insureds = InterestInsured::orderby('id', 'asc')->get();
                $placlaim = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('status_flag', 1)->orderby('id', 'DESC')->first();
                // dd($placlaim);
                $claims = ClaimDetail::where('reg_comp', $placlaim->reg_comp)->where('doc_counter', '>', $placlaim->doc_counter)->get();
                if ($claims) {
                    $placlaimloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                        ->where('doc_counter', $placlaim->doc_counter)
                        ->where('is_correction', 0)
                        ->sum('amount');
                    $lossamountlimit = 0;
                    if ($claimdata->doc_counter != 1 && $claims) {
                        $lossamountlimit = $placlaimloss;
                        foreach ($claims as $cl) {
                            $clloss = ClaimLossDescription::where('reg_comp', $claimdata->reg_comp)
                                ->where('doc_counter', $cl->doc_counter)
                                ->where('is_correction', 0);
                            if ($clloss->get()) {
                                $clloss->sum('amount');
                                $lossamountlimit -= $clloss->sum('amount');
                            }
                        }
                    }
                }

                $insured = $claimdata->slip->insureddata;
                $exchange =  CurrencyExchange::where('currency', $insured->currency_id)
                    ->where('month', date('m', strtotime($insured->created_at)))
                    ->where('year', date('Y', strtotime($insured->created_at)))
                    ->latest()->first();

                $claimdata->slip->insureddata->exchange = $exchange;

                $allcob = COB::all();
                $allkoc = Koc::all();

                return view('crm.transaction.claim.updateindex', compact(
                    'viewattachs',
                    'users',
                    'form_name',
                    'type',
                    'placlaimloss',
                    'insureds',
                    'cedings',
                    'lossamountlimit',
                    'lossdesc',
                    'idclaim',
                    'claimdata',
                    'prefixinsured',
                    'causeofloss',
                    'natureofloss',
                    'surveyor',
                    'ceding',
                    'cedingbroker',
                    'currency',
                    'cob',
                    'koc',
                    'ocp',
                    'route_active',
                    'status_flag',
                    'allcob',
                    'allkoc',
                ));
            }
        }
    }

    public function indexclaim($type, Request $request)
    {
        if ($type == 'fe') {
            $route_active = 'CLAIM FIRE & ENGINEERING - Index';
        } elseif ($type == 'fl') {
            $route_active = 'CLAIM FINANCIAL LINES - Index';
        } elseif ($type == 'hem') {
            $route_active = 'CLAIM HE & MOTOR - Index';
        } elseif ($type == 'mp') {
            $route_active = 'CLAIM MOVEABLE PROPERTY - Index';
        } elseif ($type == 'hio') {
            $form_name = 'HOLE IN ONE';
            $route_active = 'CLAIM HOLE IN ONE - Index';
        } elseif ($type == 'pa') {
            $form_name = 'PERSONAL ACCIDENT';
            $route_active = 'CLAIM PERSONAL ACCIDENT - Index';
        } elseif ($type == 'marine') {
            $form_name = 'MARINE';
            $route_active = 'CLAIM MARINE - Index';
        } else {
            abort(404);
        }
        $user = Auth::user();
        $country = User::orderby('id', 'asc')->get();

        $mydate = date("Y") . date("m") . date("d");
        $fe_ids = response()->json($country->modelKeys());
        $search = @$request->input('search');
        $searchregcomp = @$request->input('searchregcomp');
        $searchuy = @$request->input('searchuy');
        $searchinsured = @$request->input('searchinsured');
        $searchceding = @$request->input('searchceding');
        $searchdate = @$request->input('searchdate');
        $searchcauseofloss = @$request->input('searchcauseofloss');
        $searchsurveyor = @$request->input('searchsurveyor');
        $searchnatureofloss = @$request->input('searchnatureofloss');
        $searchdocpladla = @$request->input('searchdocpladla');

        $costumer = Customer::orderby('id', 'asc')->get();


        if (!empty($search) || !empty($searchcauseofloss) || !empty($searchnatureofloss) || !empty($searchregcomp) || !empty($searchdate) || !empty($searchsurveyor) || !empty($searchuy) || !empty($searchinsured) || !empty($searchceding) || !empty($searchdocpladla)) {

            $query = ClaimDetail::query()->with('slip.cedingbroker', 'slip.ceding', 'slip.insureddata')
                ->whereHas('slip.insureddata', function ($q) use ($type) {
                    if ($type == "marine") {
                        $q->where('slip_type', 'mc');
                        $q->orWhere('slip_type', 'mh');
                    } else {
                        $q->where('slip_type', $type);
                    }
                })
                ->where('is_delete', 0);

            if (!empty($search)) {
                $query = $query->where('number', $search);
            }

            if (!empty($searchregcomp)) {
                $query = $query->where('reg_comp', 'like', '%' . $searchregcomp . '%');
            }

            if (!empty($searchdocpladla)) {
                $query = $query->where('docpladla', 'like', '%' . $searchdocpladla . '%');
            }

            if (!empty($searchdate)) {
                $query = $query->whereDate('date_of_loss', date('Y-m-d', strtotime(str_replace('/', '-', $searchdate))));
            }

            if (!empty($searchuy)) {
                $query = $query->whereHas('slip.insureddata', function ($q) use ($searchuy) {
                    $q->where('uy', $searchuy);
                });
            }

            if (!empty($searchinsured)) {
                $query = $query->whereHas('slip.insureddata', function ($q) use ($searchinsured) {
                    $q->where('insured_name', 'like', '%' . $searchinsured . '%');
                });
            }

            if (!empty($searchceding)) {
                $query = $query->whereHas('slip', function ($q) use ($searchceding) {
                    $q->where('source', $searchceding)->orWhere('source_2', $searchceding);
                });
            }

            // Ordering
            //$query = $query->where('slip_type', '=', 'fe')->orderBy('id', 'DESC');

            //$insured =$query->paginate(10);
            //$insured_ids = response()->json($insured->modelKeys());

            $claimlist = $query->where('is_delete', 0)->orderby('id', 'desc')->paginate(10);
            $claimlist_ids = response()->json($claimlist->modelKeys());


            $cob = COB::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
            $currency = Currency::orderby('id', 'asc')->get();
            $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();

            $surveyor = Surveyor::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();

            return view('crm.transaction.claim.claim_index', compact(
                'type',
                'claimlist_ids',
                'claimlist',
                'costumer',
                'causeofloss',
                'natureofloss',
                'surveyor',
                'ocp',
                'koc',
                'currency',
                'searchceding',
                'search',
                'searchinsured',
                'searchuy',
                'searchregcomp',
                'searchdate',
                'searchcauseofloss',
                'searchsurveyor',
                'searchnatureofloss',
                'cob',
                'cedingbroker',
                'ceding',
                'user',
                'route_active',
                'country'
            ))->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            //$felookuplocation=FeLookupLocation::where('loc_code', 'LIKE', '%' . $search . '%')->orWhere('address', 'LIKE', '%' . $search . '%')->orderBy('created_at','desc')->paginate(10);

            //$felookuplocation=FeLookupLocation::orderBy('created_at','desc')->paginate(10);
            //$insured = Insured::where('slip_type', '=', 'fe')->orderby('id','desc')->paginate(10);
            //$insured_ids = response()->json($insured->modelKeys());


            $cob = COB::orderby('id', 'asc')->get();
            $cedingbroker = CedingBroker::orderby('id', 'asc')->get();
            $ceding = CedingBroker::orderby('id', 'asc')->where('type', 4)->get();
            $currency = Currency::orderby('id', 'asc')->get();
            $koc = Koc::where('parent_id', 2)->orWhere('code', 'like',  '02%')->orderby('code', 'asc')->get();
            $ocp = Occupation::orderby('id', 'asc')->get();

            $surveyor = Surveyor::orderby('id', 'asc')->get();
            $natureofloss = NatureOfLoss::orderby('id', 'asc')->get();
            $causeofloss = MasterCauseOfLoss::orderby('id', 'asc')->get();

            $claimlist = ClaimDetail::with('slip.cedingbroker', 'slip.ceding', 'slip.insureddata')
                ->whereHas('slip.insureddata', function ($q) use ($type) {
                    if ($type == "marine") {
                        $q->where('slip_type', 'mc');
                        $q->orWhere('slip_type', 'mh');
                    } else {
                        $q->where('slip_type', $type);
                    }
                })
                ->where('is_delete', 0)
                ->orderby('id', 'desc')
                ->paginate(10);

            $claimlist_ids = response()->json($claimlist->modelKeys());

            return view('crm.transaction.claim.claim_index', compact(
                'type',
                'claimlist_ids',
                'claimlist',
                'costumer',
                'causeofloss',
                'natureofloss',
                'surveyor',
                'ocp',
                'koc',
                'currency',
                'searchceding',
                'search',
                'searchinsured',
                'searchuy',
                'searchregcomp',
                'searchdate',
                'searchcauseofloss',
                'searchsurveyor',
                'searchnatureofloss',
                'cob',
                'cedingbroker',
                'ceding',
                'user',
                'route_active',
                'country'
            ))->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function storeclaiminsured($type, Request $request)
    {
        if ($type == "mc" || $type == "mh") {
            $request->validate(['surveyor' => 'required']);
        }
        $validator = $request->validate([
            'number' => 'required',
            'regcomp' => 'required',
            'docpladla' => 'required',
            'dateofreceipt' => 'required',
            'dateofdocument' => 'required',
            'causeofloss' => 'required',
            'natureofloss' => 'required',
            'dateofloss' => 'required',
            'currofloss' => 'required',
            'adjuster' => 'required',
            'nationalresliab' => 'required',
            'shareonloss' => 'required',
            'cedantshare' => 'required',
            'totallossamount' => 'required',
            'subrogasipersen' => 'required',
        ]);
        if ($validator) {

            $claimdata = ClaimDetail::where('reg_comp', $request->regcomp)->where('doc_counter', $request->doc_counter)->orderby('id', 'DESC')->first();

            if ($claimdata) {
                if ($claimdata->status_flag != 1) {
                    $validator = $request->validate([
                        'potentialrecoverydecision' => 'required',
                        'potentialrecovery' => 'required',
                        'kronologi' => 'required',
                        'staffrecomend' => 'required',
                        'assistantmanagerrecomend' => 'required',
                        'generalmanagerrecomend' => 'required',
                        'managerrecomend' => 'required',
                    ]);
                    if ($validator) {

                        $claim_datas = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('doc_counter', '<', $request->doc_counter)->get();
                        foreach ($claim_datas as $cd) {
                            $cd->causeofloss_id = $request->causeofloss;
                            $cd->natureofloss_id = $request->natureofloss;
                            $cd->date_of_loss = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss));
                            $cd->surveyor_id = $request->surveyor;
                            $cd->desc_surveyor = $request->descsurveyor;
                            $cd->adjuster_id = $request->adjuster;
                            $cd->desc_adjuster = $request->descadjuster;
                            $cd->save();
                        }

                        return $this->updateClaimEntry($claimdata, $request);
                    }
                } else {
                    return $this->updateClaimEntry($claimdata, $request);
                }
            } else {
                $mcef = ClaimDetail::create([
                    'number' => $request->number,
                    'reg_comp' => $request->regcomp,
                    'doc_number' => $request->docnumber,
                    'docpladla' => $request->docpladla,
                    'date_receipt' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofreceipt))) ?? date("Y-m-d", strtotime($request->dateofreceipt)),
                    'date_document' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofdocument))) ?? date("Y-m-d", strtotime($request->dateofdocument)),
                    'causeofloss_id' => $request->causeofloss,
                    'natureofloss_id' => $request->natureofloss,
                    'date_of_loss' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss)),
                    'curr_id_loss' => $request->currofloss,
                    'adjuster_id' => $request->adjuster,
                    'surveyor_id' => $request->surveyor,
                    'desc_surveyor' => $request->descsurveyor,
                    'nasre_liab' => $request->nationalresliab,
                    'nasre_liabdesc' => $request->descnationalresliab,
                    'nasre_share_loss' => $request->shareonloss,
                    'ced_share' => $request->cedantshare,
                    'total_loss_amount' => $request->totallossamount,
                    'potential_recovery' => $request->potentialrecoverydecision,
                    'estimate_percent_subro' => $request->subrogasipersen,
                    'estimate_amount_subro' => $request->subrogasi,
                    'desc_poten_rec' => $request->potentialrecovery,
                    'kronologi' => $request->kronologi,
                    'staff_recomendation' => $request->staffrecomend,
                    'ass_man_recomen' => $request->assistantmanagerrecomend,
                    'is_delete' => 0,
                    'status_flag' => $request->status_flag ? $request->status_flag : 1,
                    'description' => $request->description,
                    'dateofentry' => now(),
                    'dateoftrans' => $request->datetrans ? date("Y-m-d", strtotime(str_replace('/', '-', $request->datetrans))) ?? date("Y-m-d", strtotime($request->datetrans)) : null,
                    'dateofsupporting' => $request->datesupporting ? date("Y-m-d", strtotime(str_replace('/', '-', $request->datesupporting))) ?? date("Y-m-d", strtotime($request->datesupporting)) : null,
                    'reg_comp_counter' => (int)substr($request->regcomp, -4),
                    'doc_counter' => $request->doc_counter,
                    'koc_abb' => $request->koc_abb,
                    'user_id' => auth()->id(),
                ]);

                return response()->json(['id' => $mcef->id, 'id_base' => base64_encode($mcef->id), 'regcomp' => $mcef->reg_comp]);
            }
        }
    }

    public function changeSlipClaimInterim($regcomp, $counter)
    {
        $user = Auth::user();

        if ($regcomp && $counter) {

            $claimdata = ClaimDetail::where('reg_comp', $regcomp)->where('doc_counter', $counter)->first();

            if (!empty($claimdata)) {
                // $user = Auth::user();
                $id_ed = ($claimdata->interim_count + 1);

                $lastdoccount = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->orderby('doc_counter', 'DESC')->first()->doc_counter;
                $mainclaim = $claimdata->replicate();
                $mainclaim->doc_counter = $lastdoccount + 1;
                $mainclaim->status_flag = 2;
                $mainclaim->is_delete = 0;
                $mainclaim->interim_count = $id_ed;
                $mainclaim->dateofentry = now();
                $mainclaim->save();

                $retrocessionlist = ClaimLossDescription::where('reg_comp', $regcomp)->where('doc_counter', $counter)->get();
                $this->amountClaimDuplicate($retrocessionlist, $mainclaim->doc_counter);

                $this->toNegative($claimdata, null, $id_ed);

                return response()->json(['id' => $mainclaim->id, 'doc_counter' => $mainclaim->doc_counter]);
            }
        } else {
            Session::flash('flash_message', 'Change Status To Interim Error!');

            return redirect()->route('claimindex');
        }
    }

    public function changeSlipClaimPLA($regcomp, $counter)
    {
        $user = Auth::user();

        if ($regcomp && $counter) {

            $claimdata = ClaimDetail::where('reg_comp', $regcomp)->where('doc_counter', $counter)->first();

            if (!empty($claimdata)) {

                $lastdoccount = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->orderby('doc_counter', 'DESC')->first()->doc_counter;
                $mainclaim = $claimdata->replicate();
                $mainclaim->doc_counter = $lastdoccount + 1;
                $mainclaim->status_flag = 3;
                $mainclaim->is_delete = 0;
                $mainclaim->dateofentry = now();
                $mainclaim->save();

                $retrocessionlist = ClaimLossDescription::where('reg_comp', $regcomp)->where('doc_counter', $counter)->get();
                $this->amountClaimDuplicate($retrocessionlist, $mainclaim->doc_counter);

                $this->toNegative($claimdata, null);

                return response()->json(['id' => $mainclaim->id, 'doc_counter' => $mainclaim->doc_counter]);
            }
        } else {
            Session::flash('flash_message', 'Change Status To DLA Error!');

            return redirect()->route('claimindex');
        }
    }

    public function changeDocumentStatus($type, Request $request)
    {
        if ($type == "mc" || $type == "mh") {
            $request->validate(['surveyor' => 'required']);
        }
        $validator = $request->validate([
            'number' => 'required',
            'regcomp' => 'required',
            'docpladla' => 'required',
            'dateofreceipt' => 'required',
            'dateofdocument' => 'required',
            'causeofloss' => 'required',
            'natureofloss' => 'required',
            'dateofloss' => 'required',
            'currofloss' => 'required',
            'adjuster' => 'required',
            'nationalresliab' => 'required',
            'descnationalresliab' => 'required',
            'shareonloss' => 'required',
            'cedantshare' => 'required',
            'totallossamount' => 'required',
            'subrogasipersen' => 'required',
            'subrogasi' => 'required',
            'potentialrecoverydecision' => 'required',
            'potentialrecovery' => 'required',
            'kronologi' => 'required',
            'staffrecomend' => 'required',
            'assistantmanagerrecomend' => 'required',
            'generalmanagerrecomend' => 'required',
            'managerrecomend' => 'required',
        ]);

        if ($validator) {
            $claimdata = ClaimDetail::where('reg_comp', $request->regcomp)->where('doc_counter', $request->old_doc_counter)->firstOrFail();
            if ($claimdata) {

                $lastdoccount = $request->doc_counter;

                $mainclaim = $claimdata->replicate([
                    'pureor_liability',
                    'pureor_loss',
                    'pureor_retro',
                    'pureor_recovery',
                    'qs_liability',
                    'qs_loss',
                    'qs_retro',
                    'qs_recovery',
                    'arr1_liability',
                    'arr1_loss',
                    'arr1_retro',
                    'arr1_recovery',
                    'arr2_liability',
                    'arr2_loss',
                    'arr2_retro',
                    'arr2_recovery',
                    'arr3_liability',
                    'arr3_loss',
                    'arr3_retro',
                    'arr3_recovery',
                    'extra_liability',
                    'extra_loss',
                    'extra_retro',
                    'extra_recovery',
                    'facultative_liability',
                    'facultative_loss',
                    'facultative_retro',
                    'facultative_recovery',
                    'totalrecovery',
                    'nrsgrossret',
                    'xol',
                    'cereffno',
                    'dateofprod',
                    'ceno',
                    'ceuser',
                    'description',
                    'dateoftrans',
                    'dateofsupporting',
                    'status_ce',
                    'user_create_ce',
                    'examiner',
                    'ast_manager',
                    'dec_manager',
                    'gen_manager',
                    'dec_board',
                    'dateprintce',
                    'ce_created_at',
                    'ce_status_counter',
                    'acc_retro'
                ]);

                $this->replicateClaim($mainclaim, $request);
                $mainclaim->doc_counter = $lastdoccount;
                $mainclaim->user_id = auth()->id();

                if (@$request->interim) {
                    $id_ed = ($claimdata->interim_count + 1);
                    $mainclaim->interim_count = $id_ed;
                    $mainclaim->status_flag = 2;
                } else {
                    $mainclaim->status_flag = 3;
                }

                $mainclaim->save();

                $retrocessionlist = ClaimLossDescription::where('doc_counter', $lastdoccount - 1)->where('reg_comp', $request->regcomp)->get();
                $this->amountClaimDuplicate($retrocessionlist, $lastdoccount);

                $claim_datas = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->where('doc_counter', '<', $request->doc_counter)->get();

                foreach ($claim_datas as $cd) {
                    $cd->causeofloss_id = $request->causeofloss;
                    $cd->natureofloss_id = $request->natureofloss;
                    $cd->date_of_loss = date("Y-m-d", strtotime(str_replace('/', '-', $request->dateofloss))) ?? date("Y-m-d", strtotime($request->dateofloss));
                    $cd->surveyor_id = $request->surveyor;
                    $cd->desc_surveyor = $request->descsurveyor;
                    $cd->adjuster_id = $request->adjuster;
                    $cd->desc_adjuster = $request->descadjuster;
                    $cd->save();
                }

                return response()->json(['id' => $mainclaim->id, 'id_base' => base64_encode($mainclaim->id), 'doc_counter' => $mainclaim->doc_counter]);
            }
        }
    }

    public function getdetailAmountSlip($type, $regcomp, $counter = 1)
    {
        $transamount = ClaimLossDescription::with('descLoss')
            ->where('reg_comp', $regcomp)
            ->where('doc_counter', $counter);
        // $iscorrection = ClaimLossDescription::where('doc_counter', $counter)->where('reg_comp', $regcomp)->first();
        // if (@$iscorrection->is_correction == 1) {
        // } else {
        //     $claimamountdata = $transamount->where('doc_counter', $counter)->where('is_correction', 0);
        // }
        $data = $transamount->orderby('id', 'asc')->get();
        $sumdata = $transamount->where('is_correction', 0)->sum('amount');

        if ($data) {
            return response()->json(
                [
                    'status' => 200,
                    'message' => "Amount Data",
                    'data' => $data,
                    'sumamount' => $sumdata,
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 201,
                    'message' => "Slip Number, No Amount Data"
                ]
            );
        }
    }

    public function getRiskLocationSlip($number)
    {
        $user = Auth::user();

        $slipdata = SlipTable::where('number', $number)->first();

        $locationlist2 = TransLocationTemp::where('insured_id', '=', $slipdata->insured_id)->orderby('id', 'desc')->get();

        //dd($locationlist2);

        $locationlist = [];

        if (!empty($locationlist2)) {
            foreach ($locationlist2 as $datadetail) {
                //$risklocationdetaildata= RiskLocationDetail::where('translocation_id','=',$datadetail->id)->where('count_endorsement',$insureddata->count_endorsement)->get();
                $risklocationdetaildata = RiskLocationDetail::where('translocation_id', '=', $datadetail->id)->get();

                $riskdetaillist = [];

                foreach ($risklocationdetaildata as $stt) {

                    $interestdata = InterestInsured::where('id', '=', $stt->interest_id)->first();
                    $cedingdata = CedingBroker::where('id', '=', $stt->ceding_id)->first();

                    $stt->interestdetail = $interestdata;
                    $stt->cedingdetail = $cedingdata;

                    array_push($riskdetaillist, $stt);
                }


                $datadetail->risklocationdetail = $riskdetaillist;

                array_push($locationlist, $datadetail);
            }
        }

        if (!empty($locationlist2)) {
            return response()->json(
                [
                    'status' => 200,
                    'message' => "Location Data",
                    'data' => json_encode($locationlist)
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 201,
                    'message' => "No Location Data"
                ]
            );
        }
    }

    public function getdetailSlipClaim($number)
    {
        $user = Auth::user();
        $claimdata = ClaimDetail::with('claiminsureddata:id,main_claim_id,loc_code,active')->where('number', $number)->orderby('id', 'DESC')->first();

        if (!empty($claimdata)) {
            $lossamounts = ClaimDetail::where('reg_comp', $claimdata->reg_comp)->get();
            $lossamountlimit = 0;
            if ($claimdata->doc_counter != 1) {
                foreach ($lossamounts as $lm) {
                    if ($lm->doc_counter == 1) {
                        $lossamountlimit < 0 ? $lossamountlimit = ((int)$lossamountlimit * -1) + $lm->total_loss_amount : $lossamountlimit += $lm->total_loss_amount;
                    } else {
                        $lossamountlimit < 0 ? $lossamountlimit = ((int)$lossamountlimit * -1) - $lm->total_loss_amount : $lossamountlimit -= $lm->total_loss_amount;
                    }
                }
            }
            $datereceipt =  date("d/m/Y", strtotime($claimdata->date_receipt));

            if ($claimdata->date_document == null) {
                $datedocument = "";
            } else {
                $datedocument = date("d/m/Y", strtotime($claimdata->date_document));
            }

            // $statustable= StatusLog::where('slip_id',$slipdata->number)->where('insured_id',$slipdata->insured_id)->where('count_endorsement',$slipdata->endorsment)->where('slip_type','fe')->orderby('created_at','DESC')->get();
            // $statuslist= $statustable->unique('status');
            // $statuslist->values()->all();

            // $attachmenttable = collect(SlipTableFile::where('slip_id','=',$slipdata->number)->where('insured_id','=',$slipdata->insured_id)->where('slip_type','fe')->where('count_endorsement',$slipdata->endorsment)->orderby('id','DESC')->get());
            // $attachmentlist = $attachmenttable->unique('filename');
            // $attachmentlist->values()->all();

            return response()->json(
                [
                    'claiminsureddata' => $claimdata->claiminsureddata,
                    'id' => $claimdata->id,
                    'number' => $claimdata->number,
                    'doc_number' => $claimdata->doc_number,
                    'reg_comp' => $claimdata->reg_comp,
                    'date_receipt' => date("d/m/Y", strtotime($claimdata->date_receipt)),
                    'date_document' => date("d/m/Y", strtotime($claimdata->date_document)),
                    'causeofloss_id' => $claimdata->causeofloss_id,
                    'natureofloss_id' => $claimdata->natureofloss_id,
                    'id_col' => $claimdata->id_col,
                    'id_nol' => $claimdata->id_nol,
                    'date_of_loss' => date("d/m/Y", strtotime($claimdata->date_of_loss)),
                    'curr_id_loss' => $claimdata->curr_id_loss,
                    'curr_lossdesc' => $claimdata->curr_lossdesc,
                    'surveyor_id' => $claimdata->surveyor_id,
                    'desc_surveyor' => $claimdata->desc_surveyor,
                    'nasre_liab' => $claimdata->nasre_liab,
                    'nasre_liabdesc' => $claimdata->nasre_liabdesc,
                    'nasre_share_loss' => $claimdata->nasre_share_loss,
                    'ced_share' => $claimdata->ced_share,
                    'total_loss_amount' => $claimdata->total_loss_amount,
                    'potential_recovery' => $claimdata->potential_recovery,
                    'route' => $claimdata->route,
                    'estimate_percent_subro' => $claimdata->estimate_percent_subro,
                    'estimate_amount_subro' => $claimdata->estimate_amount_subro,
                    'desc_poten_rec' => $claimdata->desc_poten_rec,
                    'kronologi' => $claimdata->kronologi,
                    'staff_recomendation' => $claimdata->staff_recomendation,
                    'ass_man_recomen' => $claimdata->ass_man_recomen,
                    'route_from' => $claimdata->route_from,
                    'route_to' => $claimdata->route_to,
                    'pureor_liability' => $claimdata->pureor_liability,
                    'pureor_loss' => $claimdata->pureor_loss,
                    'pureor_retro' => $claimdata->pureor_retro,
                    'pureor_recovery' => $claimdata->pureor_recovery,
                    'qs_liability' => $claimdata->qs_liability,
                    'qs_loss' => $claimdata->qs_loss,
                    'qs_retro' => $claimdata->qs_retro,
                    'qs_recovery' => $claimdata->qs_recovery,
                    'arr1_liability' => $claimdata->arr1_liability,
                    'arr1_loss' => $claimdata->arr1_loss,
                    'arr1_retro' => $claimdata->arr1_retro,
                    'arr1_recovery' => $claimdata->arr1_recovery,
                    'extra_liability' => $claimdata->extra_liability,
                    'extra_loss' => $claimdata->extra_loss,
                    'extra_retro' => $claimdata->extra_retro,
                    'extra_recovery' => $claimdata->extra_recovery,
                    'facultative_liability' => $claimdata->facultative_liability,
                    'facultative_loss' => $claimdata->facultative_loss,
                    'facultative_retro' => $claimdata->facultative_retro,
                    'facultative_recovery' => $claimdata->facultative_recovery,
                    'arr2_liability' => $claimdata->arr2_liability,
                    'arr2_loss' => $claimdata->arr2_loss,
                    'arr2_retro' => $claimdata->arr2_retro,
                    'arr2_recovery' => $claimdata->arr2_recovery,
                    'arr3_liability' => $claimdata->arr3_liability,
                    'arr3_loss' => $claimdata->arr3_loss,
                    'arr3_retro' => $claimdata->arr3_retro,
                    'arr3_recovery' => $claimdata->arr3_recovery,
                    'totalrecovery' => $claimdata->totalrecovery,
                    'nrsgrossret' => $claimdata->nrsgrossret,
                    'xol' => $claimdata->xol,
                    'cereffno' => $claimdata->cereffno,
                    'dateofprod' => date("d/m/Y", strtotime($claimdata->dateofprod)),
                    'ceno' => $claimdata->ceno,
                    'ceuser' => $claimdata->ceuser,
                    'status_ce' => $claimdata->status_ce,
                    'description' => $claimdata->description,
                    'dateofentry' => now(),
                    'dateoftrans' => date("d/m/Y", strtotime($claimdata->dateoftrans)),
                    'dateofsupporting' => date("d/m/Y", strtotime($claimdata->dateofsupporting)),
                    'status_flag' => $claimdata->status_flag,
                    'is_delete' => $claimdata->is_delete,
                    'attacment_file' => $claimdata->attacment_file,
                    'reg_comp_counter' => $claimdata->reg_comp_counter,
                    'doc_counter' => $claimdata->doc_counter,
                    'status' => 200,
                    'message' => "Data Claim",
                    "lossamountlimit" => $lossamountlimit
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 201,
                    'message' => "Slip Number, No Claim Data"
                ]
            );
        }
    }

    public function destroy($id)
    {
        $claim = ClaimDetail::find($id);
        $claim->is_delete = 1;

        if ($claim->save()) {
            $notification = array(
                'message' => 'Claim Data deleted successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Contact admin!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function multiDocument($type, Request $request)
    {
        $validator = $request->validate([
            'old_regcomp' => 'required',
            'doc_counter' => 'required',
            'cancel' => 'required',
        ]);

        if ($validator) {

            $claimdata = ClaimDetail::with('slip.insureddata', 'slip.corebusiness', 'slip.kindcontract')
                ->where('reg_comp', $request->old_regcomp)
                ->where('doc_counter', $request->doc_counter)->first();

            if ($claimdata) {
                $lastregcompcount = ClaimDetail::orderby('reg_comp_counter', 'DESC')->first()->reg_comp_counter;

                $koc = substr($claimdata->slip->kindcontract->code, 0, 2);
                $cob = $claimdata->slip->corebusiness->code;
                while (strlen($cob) < 4) $cob =  $cob . "B";
                $month = date('m', strtotime(now()));
                $year = date('y', strtotime(now()));
                $counter = (string)$lastregcompcount + 1;
                while (strlen($counter) < 4) $counter = "0" . $counter;
                $regcomp = "C" . $koc . $cob . $year . $month . $counter;

                if ($request->status_flag == 1 && $request->cancel) {
                    $lastdoccount = ClaimDetail::where('reg_comp', $request->old_regcomp)
                        ->orderby('doc_counter', 'DESC')
                        ->first()->doc_counter;

                    $dlanol = $claimdata->replicate([
                        'pureor_liability',
                        'pureor_loss',
                        'pureor_retro',
                        'pureor_recovery',
                        'qs_liability',
                        'qs_loss',
                        'qs_retro',
                        'qs_recovery',
                        'arr1_liability',
                        'arr1_loss',
                        'arr1_retro',
                        'arr1_recovery',
                        'arr2_liability',
                        'arr2_loss',
                        'arr2_retro',
                        'arr2_recovery',
                        'arr3_liability',
                        'arr3_loss',
                        'arr3_retro',
                        'arr3_recovery',
                        'extra_liability',
                        'extra_loss',
                        'extra_retro',
                        'extra_recovery',
                        'facultative_liability',
                        'facultative_loss',
                        'facultative_retro',
                        'facultative_recovery',
                        'totalrecovery',
                        'nrsgrossret',
                        'xol',
                        'cereffno',
                        'dateofprod',
                        'ceno',
                        'ceuser',
                        'description',
                        'dateoftrans',
                        'dateofsupporting',
                        'status_ce',
                        'user_create_ce',
                        'examiner',
                        'ast_manager',
                        'dec_manager',
                        'gen_manager',
                        'dec_board',
                        'dateprintce',
                        'ce_created_at',
                        'ce_status_counter',
                    ]);
                    $dlanol->is_delete = 0;
                    $dlanol->status_ce = 2;
                    $dlanol->description = "automatically decline from multi pla";
                    $dlanol->dateofprod = date("Y-m-d h:m:s", strtotime(now()));
                    $dlanol->doc_counter = $lastdoccount + 1;
                    $dlanol->user_id = auth()->id();
                    $this->toNegative($dlanol, 3, null, true);

                    $retrocessionlist = ClaimLossDescription::where('reg_comp', $request->old_regcomp)
                        ->where('doc_counter', $request->doc_counter)->get();
                    $this->amountClaimDuplicate($retrocessionlist, $dlanol->doc_counter);
                    // $this->amountClaimDuplicate($retrocessionlist, 1, false, $regcomp);
                }

                $new_claimdata = $claimdata->replicate([
                    'pureor_liability',
                    'pureor_loss',
                    'pureor_retro',
                    'pureor_recovery',
                    'qs_liability',
                    'qs_loss',
                    'qs_retro',
                    'qs_recovery',
                    'arr1_liability',
                    'arr1_loss',
                    'arr1_retro',
                    'arr1_recovery',
                    'arr2_liability',
                    'arr2_loss',
                    'arr2_retro',
                    'arr2_recovery',
                    'arr3_liability',
                    'arr3_loss',
                    'arr3_retro',
                    'arr3_recovery',
                    'extra_liability',
                    'extra_loss',
                    'extra_retro',
                    'extra_recovery',
                    'facultative_liability',
                    'facultative_loss',
                    'facultative_retro',
                    'facultative_recovery',
                    'totalrecovery',
                    'nrsgrossret',
                    'xol',
                    'cereffno',
                    'dateofprod',
                    'ceno',
                    'ceuser',
                    'description',
                    'dateoftrans',
                    'dateofsupporting',
                    'status_ce',
                    'user_create_ce',
                    'examiner',
                    'ast_manager',
                    'dec_manager',
                    'gen_manager',
                    'dec_board',
                    'dateprintce',
                    'ce_created_at',
                    'ce_status_counter',
                ]);
                $this->replicateClaim($new_claimdata, $request);
                $new_claimdata->status_flag = 1;
                $new_claimdata->copy_from_claim_id = $claimdata->id;
                $new_claimdata->doc_counter = 1;
                $new_claimdata->reg_comp_counter = $lastregcompcount + 1;
                $new_claimdata->reg_comp = $regcomp;
                $new_claimdata->user_id = auth()->id();
                $new_claimdata->save();

                $claiminsured = ClaimInsuredData::where('reg_comp', $request->old_regcomp)->get();
                foreach ($claiminsured as $cinsured) {
                    $cinsured->replicate();
                    $cinsured->reg_comp = $regcomp;
                    $cinsured->save();
                }

                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Multi Success!",
                        'id' => $new_claimdata->id,
                        'id_base' => base64_encode($new_claimdata->id),
                        'reg_comp' => $new_claimdata->reg_comp,
                        'doc_counter' => $new_claimdata->doc_counter,
                    ]
                );
            }
            return response()->json(
                [
                    'status' => 404,
                    'message' => "Document Not Found!",
                ]
            );
        }
        return response()->json(
            [
                'status' => 500,
                'message' => $validator,
            ]
        );
    }

    public function retrieveData($type, Request $request)
    {
        $locations = RiskLocationDetail::has('translocationtemp.slip')->with(
            'translocationtemp.slip.insureddata.currency',
            'translocationtemp.slip.cedingbroker',
            'translocationtemp.slip.ceding',
            'translocationtemp.slip.corebusiness',
            'translocationtemp.slip.kindcontract',
            'interestdata',
            'cedingbroker'
        )->has('translocationtemp.slip.kindcontract')->has('translocationtemp.slip.corebusiness');
        $locations = $locations->whereHas('translocationtemp', function ($q) use ($type) {
            $q->where('slip_type', $type);
        })->has('translocationtemp.slip.insureddata');

        if (isset($request->insured)) {
            $locations = $locations->where('interest_id', $request->insured);
        }

        if (isset($request->ceding)) {
            $locations = $locations->where('ceding_id', $request->ceding);
        }

        if (isset($request->no)) {
            $locations = $locations->where(function ($q) use ($request) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`cndn`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`certno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`slipno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
                $q->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`policyno`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $request->no . '%']);
            });
        }

        if (isset($request->uy)) {
            $locations = $locations->whereHas('translocationtemp.insured', function ($q) use ($request) {
                $q->where('uy', $request->uy);
            })->has('translocationtemp.insured');
        }

        if (isset($request->koc)) {
            $locations = $locations->whereHas('translocationtemp.slip', function ($q) use ($request) {
                $q->where('koc', $request->koc);
            })->has('translocationtemp.slip');
        }

        if (isset($request->cob)) {
            $locations = $locations->whereHas('translocationtemp.slip', function ($q) use ($request) {
                $q->where('cob', $request->cob);
            })->has('translocationtemp.slip');
        }

        $slips = [];
        foreach ($locations->get() as $key => $loc) {
            if ($loc->translocationtemp->slip && !in_array($loc->translocationtemp->slip, $slips, true)) {
                $insured = $loc->translocationtemp->slip->insureddata;
                $exchange =  CurrencyExchange::where('currency', $insured->currency_id)
                    ->where('month', date('m', strtotime($insured->created_at)))
                    ->where('year', date('Y', strtotime($insured->created_at)))
                    ->latest()->first();
                if ($exchange) {
                    $loc->translocationtemp->slip->insureddata->exchange = $exchange;
                    array_push($slips, $loc->translocationtemp->slip);
                }
            }
        }

        $locations = $locations->get()->groupBy('translocationtemp.lookup_location_id');

        $addresses = [];
        foreach ($locations as $key => $value) {
            array_push(
                $addresses,
                FeLookupLocation::find($key)
            );
        }
        return response()->json(['locations' => $locations, 'addresses' => $addresses, 'slips' => $slips]);
    }

    public function getFilterData($type, $regcomp)
    {
        $claiminsured = ClaimInsuredData::with(
            'mainclaim',
            'slipceding',
            'slipbroker',
            'address',
            'interest',
            'interestceding',
            'slip.insureddata',
            'kocdata',
            'cobdata'
        )->where('reg_comp', $regcomp)->get();

        return response()->json(['claiminsured' => $claiminsured]);
    }

    public function getLatestRegCompCounter($type, $regcomp)
    {
        $mainclaim = ClaimDetail::where('reg_comp', 'LIKE', '%' . $regcomp . '%')->orderby('reg_comp_counter', 'DESC')->first();
        if ($mainclaim) {
            return $mainclaim->reg_comp_counter;
        }
        return 0;
    }

    public function getLatestDocCounter($type, $regcomp)
    {
        return ClaimDetail::where('reg_comp', $regcomp)->orderby('doc_counter', 'DESC')->first()->doc_counter;
    }

    public function getClaimByCounter($type, Request $request)
    {
        $mainclaim = ClaimDetail::with('slip')->where('reg_comp', $request->regcomp);
        $claim = $mainclaim->where('doc_counter', $request->doccounter)->first();
        if ($claim) {
            $lossamounts = $mainclaim->where('doc_counter', '<=', $request->doccounter)->get();

            $lossamountlimit = 0;
            if ($claim->doc_counter != 1) {
                foreach ($lossamounts as $lm) {
                    if ($lm->doc_counter == 1) {
                        $lossamountlimit < 0 ? $lossamountlimit = ((int)$lossamountlimit * -1) + $lm->total_loss_amount : $lossamountlimit += $lm->total_loss_amount;
                    } else {
                        $lossamountlimit < 0 ? $lossamountlimit = ((int)$lossamountlimit * -1) - $lm->total_loss_amount : $lossamountlimit -= $lm->total_loss_amount;
                    }
                }
            }

            return response()->json(['claim' => $claim, 'lossamountlimit' => $lossamountlimit]);
        }
        return response()->json(['error' => 'No data Found!']);
    }

    public function correctionClaim($type, Request $request)
    {
        $mainclaim = ClaimDetail::where('reg_comp', $request->regcomp)->where('doc_counter', $request->old_doc_counter)->firstOrFail();
        $lastcount = ClaimDetail::where('reg_comp', $request->regcomp)->orderby('doc_counter', 'DESC')->firstOrFail()->doc_counter;

        if ($mainclaim && $lastcount) {

            $correctionclaim = $mainclaim->replicate([
                'pureor_liability',
                'pureor_loss',
                'pureor_retro',
                'pureor_recovery',
                'qs_liability',
                'qs_loss',
                'qs_retro',
                'qs_recovery',
                'arr1_liability',
                'arr1_loss',
                'arr1_retro',
                'arr1_recovery',
                'arr2_liability',
                'arr2_loss',
                'arr2_retro',
                'arr2_recovery',
                'arr3_liability',
                'arr3_loss',
                'arr3_retro',
                'arr3_recovery',
                'extra_liability',
                'extra_loss',
                'extra_retro',
                'extra_recovery',
                'facultative_liability',
                'facultative_loss',
                'facultative_retro',
                'facultative_recovery',
                'totalrecovery',
                'nrsgrossret',
                'xol',
                'cereffno',
                'dateofprod',
                'ceno',
                'ceuser',
                'description',
                'dateoftrans',
                'dateofsupporting',
                'status_ce',
                'user_create_ce',
                'examiner',
                'ast_manager',
                'dec_manager',
                'gen_manager',
                'dec_board',
                'dateprintce',
                'ce_created_at',
                'ce_status_counter',
            ]);
            $correctionclaim->dateofentry = now();
            $correctionclaim->doc_counter = $lastcount + 1;
            $correctionclaim->user_id = auth()->id();
            $correctionclaim->save();


            // SET TO NEGATIVE NEW DOC_COUNTER
            $retrocessionlist = ClaimLossDescription::where('reg_comp', $request->regcomp)->where('doc_counter', $request->old_doc_counter)->get();
            $this->amountClaimDuplicate($retrocessionlist, $lastcount, true);

            // MONEY VALUE TO NEGATIVE
            $this->toNegative($correctionclaim, $request->Status_flag);

            // CREATE NEW DESC LOSS FOR THE NEXT DOC_COUNTER
            // $newamount = ClaimLossDescription::where('reg_comp', $request->regcomp)->where('doc_counter', $request->old_doc_counter - 1)->get();
            // $this->amountClaimDuplicate($newamount, $correctionclaim->doc_counter + 1);

            // CREATE NEW DOC
            $new_claim = $mainclaim->replicate([
                'pureor_liability',
                'pureor_loss',
                'pureor_retro',
                'pureor_recovery',
                'qs_liability',
                'qs_loss',
                'qs_retro',
                'qs_recovery',
                'arr1_liability',
                'arr1_loss',
                'arr1_retro',
                'arr1_recovery',
                'arr2_liability',
                'arr2_loss',
                'arr2_retro',
                'arr2_recovery',
                'arr3_liability',
                'arr3_loss',
                'arr3_retro',
                'arr3_recovery',
                'extra_liability',
                'extra_loss',
                'extra_retro',
                'extra_recovery',
                'facultative_liability',
                'facultative_loss',
                'facultative_retro',
                'facultative_recovery',
                'totalrecovery',
                'nrsgrossret',
                'xol',
                'cereffno',
                'dateofprod',
                'ceno',
                'ceuser',
                'description',
                'dateoftrans',
                'dateofsupporting',
                'status_ce',
                'user_create_ce',
                'examiner',
                'ast_manager',
                'dec_manager',
                'gen_manager',
                'dec_board',
                'dateprintce',
                'ce_created_at',
                'ce_status_counter',
            ]);
            $this->replicateClaim($new_claim, $request);
            $new_claim->doc_counter = $correctionclaim->doc_counter + 1;
            $new_claim->user_id = auth()->id();
            $new_claim->save();

            return response()->json(['id' => $new_claim->id, 'id_base' => base64_encode($new_claim->id), 'doc_counter' => $new_claim->doc_counter]);
        }
    }

    public function updateTotalLoss($type, $regcomp, $doc_counter)
    {
        $desclosses = ClaimLossDescription::with('descLoss')->where('reg_comp', $regcomp)->where('doc_counter', $doc_counter)->get();
        $sumamount = 0;
        foreach ($desclosses as $descloss) {
            $sumamount += (int)$descloss->descLoss->factor * $descloss->amount;
        }
        $claimdata = ClaimDetail::where('reg_comp', $regcomp)->where('doc_counter', $doc_counter)->first();
        $claimdata->update(['total_loss_amount' => $sumamount]);
        return response()->json(['sumamount' => $sumamount, 'claim' => $claimdata]);
    }

    public function getInsuredandRiskLocation($type, $number)
    {
        if ($type == "mh") {
            $slip = SlipTable::with(
                'insureddata.prefixinsured',
                'insureddata.currency',
            )->where('number', $number)->first();
            $ships = ShipListTemp::with(
                'cedingdata',
                'insured.currency',
                'insured.slip.kindcontract',
                'insured.slip.corebusiness',
                'insured.slip.cedingbroker',
                'insured.slip.ceding',
            )->where('slip_type', 'mh')
                ->where('insured_id', $slip->insured_id)
                ->has('insured.slip')->get();
            $slip->ships = $ships;
        } else if ($type == "mc") {
            $slip = SlipTable::with(
                'insureddata.prefixinsured',
                'insureddata.currency',
            )->where('number', $number)->first();
            $ships = InterestInsuredTemp::with(
                'cedingdata',
                'interestinsureddata',
                'ship.cedingdata',
                'ship.insured.slip.kindcontract',
                'ship.insured.slip.corebusiness',
                'ship.insured.slip.cedingbroker',
                'ship.insured.slip.ceding',
                'ship.insured.currency',
            )
                ->where('slip_type', 'mc')
                ->whereHas('ship', function ($query) use ($slip) {
                    $query->where('insured_id', $slip->insured_id);
                })
                ->has('ship')->get();
            $slips = [];
            foreach ($ships as $interest) {
                if ($interest->ship->insured->slip && !in_array($interest->ship->insured->slip, $slips, true)) {
                    $interest->ship->insured->slip->uy = $interest->ship->insured->uy;
                    $interest->ship->insured->slip->currency = $interest->ship->insured->currency;
                    array_push($slips, $interest->ship->insured->slip);
                }
            }
            $ship_sorted = [];
            foreach ($ships as $interest) {
                $shp = (object)[];
                if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) {
                    $shp->id = $interest->ship->id;
                    $shp->name = $interest->ship->ship_name;
                    $shp->insured = $interest->ship->insured;
                    $shp->slip = $interest->ship->insured->slip;
                    $shp->slip_type = $interest->slip_type;
                    $shp->interest = [];
                }
                $intrs = (object)[];
                $intrs->id = $interest->id;
                $intrs->ship_id = $interest->ship_id;
                $intrs->amount = $interest->amount;
                $intrs->insured_id = $interest->insured_id;
                $intrs->ceding_id = $interest->ceding_id;
                $intrs->cndn = $interest->cndn;
                $intrs->certno = $interest->certno;
                $intrs->slipno = $interest->slipno;
                $intrs->policyno = $interest->policyno;
                $intrs->percent = $interest->percent;
                $intrs->slip_type = $interest->slip_type;
                $intrs->status = $interest->status;
                $intrs->cedingdata = $interest->cedingdata;
                $intrs->slip_number = $interest->ship->insured->slip->number;
                $intrs->interestinsureddata = $interest->interestinsureddata;
                array_push(
                    $shp->interest,
                    $intrs
                );
                if ($interest->ship->ship_name && !in_array($interest->ship->ship_name, $slips, true)) array_push(
                    $ship_sorted,
                    $shp
                );
            }
            $slip->ships = $ship_sorted;
        } else {
            $slip = SlipTable::with(
                'insureddata.prefixinsured',
                'insureddata.currency',
                'insureddata.locations.felookuplocation',
                'insureddata.locations.risklocationdetail.interestdata',
                'insureddata.locations.risklocationdetail.cedingbroker'
            )->where('id', $number)->first();
        }
        return $slip;
    }

    public function getLastRegcompStatus($type, $regcomp)
    {
        return ClaimDetail::where('reg_comp', $regcomp)->orderBy('doc_counter', 'desc')->first()->status_flag;
    }

    public function testing()
    {
        // $test = 'interim1dla';
        // return ClaimDetail::orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(`number`, '-', ''), '.', ''), ',', ''), '/', '') LIKE ?", ['%' . $test . '%'])->get();
        // return ClaimLossDescription::with('descLoss')->where('reg_comp', 'C20302210500003')->where('doc_counter', '<=', 3)->where('is_correction', 0)->get();
        // $data = ClaimLossDescription::with('descLoss')->find(125);
        // $claimdata = ClaimDetail::where('reg_comp', 'C2010121050003')->first();
        // $slip = SlipTable::with('insureddata.prefixinsured', 'insureddata.currency', 'insureddata.locations.felookuplocation', 'insureddata.locations.risklocationdetail.interestdata')->where('number', "FE2021050500001")->first();
        // return TransLocationTemp::has('risklocationdetail')
        //     ->with('felookuplocation', 'risklocationdetail.interestdata', 'risklocationdetail.cedingbroker')
        //     ->get()
        //     ->groupBy('lookup_location_id');
        // return date('y', strtotime(now()));
        // $status_flag = ClaimDetail::where('reg_comp', 'C2010221070001')->orderBy('doc_counter', 'desc')->first()->status_flag;
        // return $status_flag;
        // return ClaimLossDescription::where('doc_counter', '8')->where('reg_comp', 'C2010121070003')->first();
        // $desclosses = ClaimLossDescription::with('descLoss')->where('reg_comp', 'C2010421070001')->where('doc_counter', 2)->get();
        // $sumamount = 0;
        // foreach ($desclosses as $descloss) {
        //     $sumamount += (int)$descloss->descLoss->factor * $descloss->amount;
        // }
        // return ClaimDetail::with('slip.insureddata.currency')->orderby('id', 'DESC')->get();
        // return ClaimDetail::where('reg_comp', 'C020121070001')->where('doc_counter', '>', 1)->get();
        // return ClaimLossDescription::where('reg_comp', 'C020121070001')
        //     ->where('doc_counter', 1)
        //     ->where('is_correction', 0)
        //     ->sum('amount');
        $lastce = ClaimDetail::where('slip_type', 'fl')
            ->where('status_ce', 'CL')
            ->orderBy('ce_status_counter', 'desc')
            ->whereMonth('ce_created_at', Carbon::now()->format('m'))
            ->whereYear('ce_created_at', Carbon::now()->format('Y'))
            ->first();
        return $lastce->ce_status_counter ?? 0;
    }

    public function getLastCeCounter($type, $abb)
    {
        $lastce = ClaimDetail::where('koc_abb', $abb)
            ->whereYear('ce_created_at', Carbon::now()->format('Y'))
            ->orderBy('ce_counter', 'desc')
            ->first();
        return $lastce->ce_counter ?? 0;
    }

    public function storeCe($type, ClaimDetail $mainClaimEntryFAC, Request $request)
    {
        $mainClaimEntryFAC->update([
            'ce_counter' => $request->ce_counter,
            'user_create_ce' => auth()->id(),
            'cereffno' => $request->cereffno,
            'examiner' => $request->examiner,
            'ast_manager' => $request->ast_manager,
            'dec_manager' => $request->dec_manager,
            'gen_manager' => $request->gen_manager,
            'dec_board' => $request->dec_board,
            'acc_retro' => $request->acc_retro,
            'dateprintce' => date("Y-m-d", strtotime(str_replace('/', '-', $request->dateprintce))) ?? date("Y-m-d", strtotime($request->dateprintce)),
            'ce_created_at' => now(),
        ]);
        return response('ok', 200);
    }

    public function agendaCE($type, Request $request)
    {
        $route_active = "CLAIM AGENDA CE";
        $noce = @$request->input('noce');
        $ceding = @$request->input('cedingsource');
        $accretro = @$request->input('accumulationretro');
        $regcomp = @$request->input('regcomp');
        $dateofloss = @$request->input('dateofloss');
        if (isset($noce) || isset($ceding) || isset($accretro) || isset($regcomp) || isset($dateofloss)) {
            $claims = ClaimDetail::with('userce', 'slip')->has('slip')
                ->whereNotNull('cereffno')
                ->whereNotNull('koc_abb');

            if (isset($noce)) $claims = $claims->where('cereffno', $noce);
            if (isset($ceding)) $claims = $claims->whereHas('slip', function ($q) use ($ceding) {
                $q->where('source_2', $ceding);
            })->has('slip');
            if (isset($accretro)) $claims = $claims->where('acc_retro', $accretro);
            if (isset($regcomp)) $claims = $claims->where('reg_comp', $regcomp);
            if (isset($dateofloss)) $claims = $claims->where('date_of_loss', date("Y-m-d", strtotime(str_replace('/', '-', $dateofloss))));

            $claims = $claims->paginate(10);

            return view('crm.transaction.claim.layouts.agendace', compact(
                'route_active',
                'claims',
            ));
        } else {
            $claims = ClaimDetail::with('userce', 'slip')->has('slip')
                ->whereNotNull('cereffno')
                ->whereNotNull('koc_abb')->paginate(10);
            // return $claims;
            return view('crm.transaction.claim.layouts.agendace', compact(
                'route_active',
                'claims',
            ));
        }
    }

    public function getLastCeStatusCounter($type, $status_ce)
    {
        $lastce = ClaimDetail::where('status_ce', $status_ce)
            ->orderBy('ce_status_counter', 'desc')
            ->whereMonth('ce_created_at', Carbon::now()->format('m'))
            ->whereYear('ce_created_at', Carbon::now()->format('Y'))
            ->first();
        return $lastce->ce_status_counter ?? 0;
    }

    public function storeNoCe($type, ClaimDetail $mainClaimEntryFAC, Request $request)
    {
        $mainClaimEntryFAC->update([
            'status_ce' => $request->status_ce,
            'dateofprod' => date("Y-m-d h:m:s", strtotime(now())),
            'ceno' => $request->ceno,
            'ceuser' => auth()->id(),
            'ce_status_counter' => $request->ce_status_counter,
        ]);
        return response()->json(['user' => auth()->user()]);
    }

    public function storeViewAttachment($type, Request $request)
    {
        $claimVA = ClaimViewAttachment::create($request->all());
        return $claimVA;
    }

    public function deleteViewAttachment($type, ClaimViewAttachment $claimViewAttachment)
    {
        if ($claimViewAttachment->delete()) {
            $notification = array(
                'message' => 'Claim View Attachment deleted successfully!',
                'alert_type' => 'success'
            );
            return $notification;
        } else {
            $notification = array(
                'message' => 'Contact admin!',
                'alert_type' => 'error'
            );
            return $notification;
        }
    }
}
