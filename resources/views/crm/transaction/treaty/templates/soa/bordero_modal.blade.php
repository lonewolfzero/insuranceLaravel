<div class="modal fade" id="bordero_modal" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
      <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addlocationLabel">{{ __('Bordero') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        @if(count(@$klaim_non_marine) == 0 && count(@$premi_non_marine) == 0 && count(@$klaim_kredit) == 0 &&
        count(@$premi_kredit) == 0)
        <div class="row">
          <div class="col d-flex align-items-center justify-content-center" style="height: 200px">
            <h2>No Bordero Uploaded!</h2>
          </div>
        </div>
        @endif

        @if (@$klaim_non_marine && count(@$klaim_non_marine))
        @php
        $headers = [
        'No',
        'Register Number',
        'Policy Number',
        'Insured',
        'Start Period',
        'End Period',
        'COL',
        'Claim 100%',
        'Cedant Share (%)',
        'Cedant Amount',
        'OR Claim',
        'QS Claim',
        'Surplus Claim',
        ];
        $cells = [
        ['name'=>'', 'type'=>''],
        ['name'=>'reg_number', 'type'=>''],
        ['name'=>'policy_number', 'type'=>''],
        ['name'=>'insured', 'type'=>''],
        ['name'=>'period_from', 'type'=>'date'],
        ['name'=>'period_to', 'type'=>'date'],
        ['name'=>'col', 'type'=>''],
        ['name'=>'claim_percentage', 'type'=>'money'],
        ['name'=>'cedant_share_percentage', 'type'=>'money'],
        ['name'=>'cedant_share_amount', 'type'=>'money'],
        ['name'=>'or_claim', 'type'=>'money'],
        ['name'=>'qs_claim', 'type'=>'money'],
        ['name'=>'surplus_claim', 'type'=>'money'],
        ];
        @endphp
        @include('crm.transaction.treaty.templates.soa.bordero_table',
        ['headers' => $headers, 'cells' => $cells, 'data' => $klaim_non_marine, 'title'=>'Klaim Non Marine'])
        @endif

        @if (@$premi_non_marine && count(@$premi_non_marine))
        @php
        $headers = [
        'No',
        'Policy Number',
        'Insured',
        'Start Period',
        'End Period',
        'Prorata',
        'Location',
        'TSI 100%',
        'Premi 100%',
        'SI OR',
        'SI QS/SPL',
        'Rate (%)',
        'Premi QS/SPL',
        'COM QS/SPL',
        'Net QS/SPL',
        'Net Due To You',
        'Remark',
        ];
        $cells = [
        ['name'=>'', 'type'=>''],
        ['name'=>'policy_number', 'type'=>''],
        ['name'=>'insured', 'type'=>''],
        ['name'=>'period_from', 'type'=>'date'],
        ['name'=>'period_to', 'type'=>'date'],
        ['name'=>'prorata', 'type'=>''],
        ['name'=>'location', 'type'=>''],
        ['name'=>'tsi', 'type'=>'money'],
        ['name'=>'premi', 'type'=>'money'],
        ['name'=>'si_or', 'type'=>'money'],
        ['name'=>'si_qs_spl', 'type'=>'money'],
        ['name'=>'rate', 'type'=>'money'],
        ['name'=>'premi_qs_spl', 'type'=>'money'],
        ['name'=>'com_qs_spl', 'type'=>'money'],
        ['name'=>'net_qs_spl', 'type'=>'money'],
        ['name'=>'net_due_to_you', 'type'=>'money'],
        ['name'=>'remark', 'type'=>''],
        ];
        @endphp
        @include('crm.transaction.treaty.templates.soa.bordero_table',
        ['headers' => $headers, 'cells' => $cells, 'data' => $premi_non_marine, 'title'=>'Premi Non Marine'])
        @endif

        @if (@$klaim_kredit && count(@$klaim_kredit))
        @php
        $headers = [
        'No',
        'Treaty Year',
        'Bank',
        'Participant Name',
        'Participant Number',
        'Born Date',
        'Age At Contract',
        'Age End Contract',
        'Bordero Month',
        'Insurance Period',
        'Insurance Start',
        'Insurance End',
        'DLOSS',
        'Cause Of Loss',
        'Plafond',
        'Claim 100%',
        'Bank Section',
        'Jamkirda Kalbar Section',
        'Reinsurance Section',
        ];
        $cells = [
        ['name'=>'', 'type'=>''],
        ['name'=>'treaty_year', 'type'=>''],
        ['name'=>'bank', 'type'=>''],
        ['name'=>'participant_name', 'type'=>''],
        ['name'=>'participant_number', 'type'=>''],
        ['name'=>'born_date', 'type'=>'date'],
        ['name'=>'age_at_contract', 'type'=>''],
        ['name'=>'age_end_contract', 'type'=>''],
        ['name'=>'bordero_month', 'type'=>''],
        ['name'=>'insurance_period', 'type'=>''],
        ['name'=>'insurance_start', 'type'=>'date'],
        ['name'=>'insurance_end', 'type'=>'date'],
        ['name'=>'dloss', 'type'=>'date'],
        ['name'=>'cause_of_loss', 'type'=>''],
        ['name'=>'plafond', 'type'=>'money'],
        ['name'=>'claim', 'type'=>'money'],
        ['name'=>'bank_section', 'type'=>'money'],
        ['name'=>'jamkrida_kalbar_section', 'type'=>'money'],
        ['name'=>'reinsurance_section', 'type'=>'money'],
        ];
        @endphp
        @include('crm.transaction.treaty.templates.soa.bordero_table',
        ['headers' => $headers, 'cells' => $cells, 'data' => $klaim_kredit, 'title'=>'Klaim kredit'])
        @endif

        @if (@$premi_kredit && count(@$premi_kredit))
        @php
        $headers = [
        'No',
        'Treaty Year',
        'Bank',
        'Participant Name',
        'Participant Number',
        'Born Date',
        'Age At Contract',
        'Age End Contract',
        'Date Of SP',
        'Insurance Period',
        'Insurance Start',
        'Insurance End',
        'Plafond',
        'Reinsurance Section',
        'Rate',
        'IJP',
        'RIC 20%',
        'Fee Base 15%',
        'Brokerage Fee 2.5%',
        'Premi Nett',
        ];
        $cells = [
        ['name'=>'', 'type'=>''],
        ['name'=>'treaty_year', 'type'=>''],
        ['name'=>'bank', 'type'=>''],
        ['name'=>'participant_name', 'type'=>''],
        ['name'=>'participant_number', 'type'=>''],
        ['name'=>'born_date', 'type'=>'date'],
        ['name'=>'age_at_contract', 'type'=>''],
        ['name'=>'age_end_contract', 'type'=>''],
        ['name'=>'date_of_sp', 'type'=>''],
        ['name'=>'insurance_period', 'type'=>''],
        ['name'=>'insurance_start', 'type'=>'date'],
        ['name'=>'insurance_end', 'type'=>'date'],
        ['name'=>'plafond', 'type'=>'money'],
        ['name'=>'reinsurance_section', 'type'=>'money'],
        ['name'=>'rate', 'type'=>'money'],
        ['name'=>'ijp', 'type'=>'money'],
        ['name'=>'ric', 'type'=>'money'],
        ['name'=>'fee_base', 'type'=>'money'],
        ['name'=>'brokerage_fee', 'type'=>'money'],
        ['name'=>'premi_nett', 'type'=>'money'],
        ];
        @endphp
        @include('crm.transaction.treaty.templates.soa.bordero_table',
        ['headers' => $headers, 'cells' => $cells, 'data' => $premi_kredit, 'title'=>'Premi kredit'])
        @endif

      </div>

    </div>
  </div>
</div>