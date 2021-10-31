<?php

namespace App\Http\Controllers\Retro\Contract;

use App\Models\COB;
use App\Models\Koc;
use App\Models\CedingBroker;
use Illuminate\Http\Request;
use App\Models\CurrencyExchange;
use App\Http\Controllers\Controller;
use App\Models\Retro\Contract\Facultative\Claim;
use App\Models\Retro\Contract\Facultative\Member;
use App\Models\Retro\Contract\Facultative\Premium;
use App\Models\Retro\Contract\Facultative\Retrocession;
use App\Models\Retro\Contract\SpecialContract;

class FacultativeController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route_active = 'retro - contract entry';
        $contract = SpecialContract::find(base64_decode($id));
        if (!$contract)
            abort(404);
        $retrocessions = $contract->getretrocession;
        $premiums = $contract->getpremium;
        $claims = $contract->getclaim;
        $koc = Koc::all();
        $cob = COB::all();
        $currency = CurrencyExchange::where('month', date('m'))->where('year', date('Y'))->get();
        $ceding = CedingBroker::all();
        return view('crm.transaction.retro.contract.facultative', compact([
            'route_active',
            'contract',
            'retrocessions',
            'premiums',
            'claims',
            'koc',
            'cob',
            'currency',
            'ceding',
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

    public function indexMember($id)
    {
        return Member::where('retrocession_id', $id)->with('getceding')->get();
    }

    public function storePremium(Request $request)
    {
        $request->validate([
            'contract_id' => 'required',
            'production_date' => 'required',
            'document_date' => 'required',
        ]);
        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'document_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->document_date))),
            'production_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->production_date))),
        ]);
        return Premium::create($request->all());
    }

    public function storeClaim(Request $request)
    {
        $request->validate([
            'contract_id' => 'required',
            'production_date' => 'required',
            'document_date' => 'required',
        ]);
        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'document_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->document_date))),
            'production_date' => date('Y-m-d', strtotime(str_replace('/', '-', $request->production_date))),
        ]);
        return Claim::create($request->all());
    }

    public function storeRetrocession(Request $request)
    {
        $request->validate([
            'contract_id' => 'required',
            'retrocession' => 'required',
            'share' => 'required',
            'commission' => 'required',
            'overriding_by_gross_premium' => 'required',
            'overriding_by_nett_premium' => 'required',
        ]);
        $request->merge([
            'user_entry' => auth()->id(),
            'date_entry' => date('Y-m-d', strtotime(now())),
            'share' => str_replace(',', '', $request->share),
            'commission' => str_replace(',', '', $request->commission),
            'overriding_by_gross_premium' => str_replace(',', '', $request->overriding_by_gross_premium),
            'overriding_by_nett_premium' => str_replace(',', '', $request->overriding_by_nett_premium),
        ]);
        return Retrocession::create($request->all())->load('getceding');
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'retrocession_id' => 'required',
            'member' => 'required',
            'share' => 'required',
            'rating' => 'required',
            'rater' => 'required',
        ]);
        $request->merge([
            'share' => str_replace(',', '', $request->share),
        ]);
        return Member::create($request->all())->load('getceding');
    }

    public function destroyPremium(Premium $premium)
    {
        if ($premium->delete())
            return true;

        return false;
    }

    public function destroyClaim(Claim $claim)
    {
        if ($claim->delete())
            return true;

        return false;
    }

    public function destroyRetrocession(Retrocession $retrocession)
    {
        if ($retrocession->delete())
            return true;

        return false;
    }

    public function destroyMember(Member $member)
    {
        if ($member->delete())
            return true;

        return false;
    }
}
