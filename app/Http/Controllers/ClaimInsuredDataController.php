<?php

namespace App\Http\Controllers;

use App\Models\ClaimInsuredData;
use Illuminate\Http\Request;

class ClaimInsuredDataController extends Controller
{
    public function index()
    {
        return ClaimInsuredData::all();
    }

    public function show(ClaimInsuredData $claimInsuredData)
    {
        return $claimInsuredData;
    }

    public function store(Request $request)
    {
        ClaimInsuredData::updateOrCreate(
            [
                'reg_comp' => $request->reg_comp,
                'doc_counter' => $request->doc_counter,
                'main_claim_id' => $request->main_claim_id,
                'slip_number' => $request->slip_number,
                'interest_id' => $request->interest,
                'percentage' => $request->share,
                'amountlocation' => $request->amount,
            ],
            [
                'slip_status' => $request->slip_status,
                'slip_ceding_id' => $request->slip_ceding,
                'slip_broker_id' => $request->slip_broker,

                'address_id' => $request->address,
                'ship_id' => $request->ship,
                'koc' => $request->koc,
                'cob' => $request->cob,

                'interest_ceding_id' => $request->interest_ceding,
                'interest_slip_no' => $request->slip_no,
                'interest_cndn_no' => $request->cndn,
                'interest_cert_no' => $request->cert,
                'interest_policy_no' => $request->policy_no,


                'active' => $request->checked == 'true' ? 1 : 0,
            ]
        );
        return response()->json(['message' => 'created!']);
    }

    public function update(Request $request, ClaimInsuredData $claimInsuredData)
    {
        $validator = $request->validate([
            'main_claim_id' => 'required',
            'number' => 'required',
            'prefix_id' => 'required',
            'insured_name' => 'required',
            'insured_suffix' => 'required',
            'share' => 'required',
            'share_from' => 'required',
            'share_to' => 'required',
            'loc_code' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'uy' => 'required',
        ]);

        if ($validator) {
            $data = $request->all();
            $claimInsuredData->update($data);

            $notification = array(
                'message' => 'Claim insured data updated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            return back()->with($validator)->withInput();
        }
    }

    public function destroy(ClaimInsuredData $claimInsuredData)
    {
        if ($claimInsuredData->delete()) {
            $notification = array(
                'message' => 'Claim Insured Data deleted successfully!',
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
}
