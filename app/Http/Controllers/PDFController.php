<?php

namespace App\Http\Controllers;

use App\Models\ClaimDetail;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function claimDataGetter($regcomp, $doccounter)
    {
        $claim = ClaimDetail::with(
            'slip.insureddata.currency',
            'slip.cedingbroker',
            'slip.ceding',
            'slip.corebusiness',
            'slip.kindcontract',
            'slip.occupation',
            'lossdescs.descLoss',
            'currloss',
            'userboard',
            'userexaminer',
            'userdecman',
            'userastman',
            'usergenman',
            'claiminsureddata.address',
            'claiminsureddata.ship',
            'user',
        )
            ->where('reg_comp', $regcomp)
            ->where('doc_counter', $doccounter)
            ->first();

        $docpla = ClaimDetail::where('reg_comp', $regcomp)
            ->where('status_flag', '1')
            ->orderBy('doc_counter', 'desc')
            ->first()->docpladla;

        $addresses = [];
        if ($claim->slip->slip_type == 'mc' || $claim->slip->slip_type == 'mh') {
            foreach ($claim->claiminsureddata as $cid) {
                if (!in_array($cid->ship, $addresses)) array_push($addresses, $cid->ship);
            }
        } else {
            foreach ($claim->claiminsureddata as $cid) {
                if (!in_array($cid->address, $addresses)) array_push($addresses, $cid->address);
            }
        }

        $options = [];
        $options = [
            (object)['name' => 'Cause of Loss', 'yes' => 'Claimable', 'no' => 'Not Claimable'],
            (object)['name' => 'Loss Amount Paid', 'yes' => 'Agreeble', 'no' => 'Not Agreeble'],
            (object)['name' => 'Reinsurance Agreement', 'yes' => 'Compiled with', 'no' => 'Not Compiled with'],
            (object)['name' => 'NASIONAL RE is therefore', 'yes' => 'Liable', 'no' => 'Not Liable'],
            (object)['name' => 'Amount claimed to NASIONAL RE', 'yes' => 'Agreeble', 'no' => 'Not Agreeble'],
            (object)['name' => 'Method of Settlement', 'yes' => 'Cash Loss', 'no' => 'Through Account Statement'],
        ];

        $data = [
            'company' => 'PT. REASURANSI NASIONAL INDONESIA',
            'division' => 'Claim Division',
            'claim' => $claim,
            'docpla' => $docpla,
            'addresses' => $addresses,
            'options' => $options,
            'date' => date('d/m/Y h:m:s')
        ];

        return array('data' => $data, 'claim' => $claim);
    }
    public function reportCEPDF($regcomp, $doccounter)
    {
        $result = $this->claimDataGetter($regcomp, $doccounter);
        extract($result);

        PDF::setPaper('A4');
        $pdf = PDF::loadView('crm.transaction.claim.layouts.printce', $data);
        $claim_status = '';
        if ($claim->status_flag == 1) {
            $claim_status = 'PLA';
        } elseif ($claim->status_flag == 2) {
            $claim_status = 'INTERIM';
        } else {
            "DLA";
        }
        $pdfname = $claim->reg_comp . '-' . $claim->doc_counter . '-' . $claim_status . '.pdf';
        return $pdf->stream($pdfname);
        // return $pdf->download($pdfname);
    }

    public function hardcopyPDF($regcomp, $doccounter)
    {
        $result = $this->claimDataGetter($regcomp, $doccounter);
        extract($result);

        $company = 'PT. REASURANSI NASIONAL INDONESIA';
        $division = 'Claim Division';

        PDF::setPaper('A4');
        $pdf = PDF::loadView('crm.transaction.claim.layouts.printhardcopy', $data);
        $doctype = '';
        if ($claim->slip->slip_type == 'mc' || $claim->slip->slip_type == 'mh') {
            $doctype = "Marine";
        } else {
            $doctype = "Non-Marine";
        }


        $pdfname = 'Hardcopy-' . $doctype . '.pdf';
        return $pdf->stream($pdfname);
        // return $pdf->download();
    }

    public function test()
    {
        $result = $this->claimDataGetter('C0202BB21070001', '1');
        extract($result);

        $company = 'PT. REASURANSI NASIONAL INDONESIA';
        $division = 'Claim Division';

        // return view('crm.transaction.claim.layouts.printhardcopy', compact(
        //     'claim',
        //     'company',
        //     'division',
        //     'docpla',
        // ));
        PDF::setPaper('A4');
        $pdf = PDF::loadView('crm.transaction.claim.layouts.printhardcopy', $data);
        // $pdf = PDF::loadView('crm.transaction.claim.layouts.printce', $data);

        return $pdf->stream();
    }
}
