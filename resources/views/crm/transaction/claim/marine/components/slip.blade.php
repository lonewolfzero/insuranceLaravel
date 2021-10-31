<div class="card" id="slipcomponent" style="display:none">
  <div class="card-header bg-gray btn text-left" data-toggle="collapse" data-target="#collapseInsuredSection"
    aria-expanded="false" aria-controls="collapseInsuredSection">
    <div class="row">
      <div class="col-md-1">
        Location
      </div>
    </div>
  </div>

  <div class="card-body collapse show" id="collapseInsuredSection">

    <div class="row">
      <div class="col">
        <input type="hidden" id="loc_code_hidden" val="">
        <input type="hidden" id="slip_index" val="">
        <table id="tableships" class="table table-bordered table-striped">
          <thead>
            <tr>
              @if (@$type=='cargo' )
              <th>Ceding Source</th>
              <th>Insured Name</th>
              <th>Ship Name</th>
              @endif
              @if (@$type == 'hull')
              <th>Ceding Source</th>
              <th>Insured Name</th>
              <th>Ship Name</th>
              <th>CN/DN</th>
              <th>Cert No</th>
              <th>Slip No</th>
              <th>Policy No</th>
              <th>Share</th>
              <th>Amount</th>
              <th>Action</th>
              @endif
            </tr>
          </thead>
          <tbody id="mainbodyships">
            @if (@$type=='cargo' && @$claimdata)
            @foreach (@$claiminsureds as $key=>$insureds)
            <tr>
              <td>{{ $claimdata->slip->cedingbroker->name }}</td>
              <td>{{ $claimdata->slip->insureddata->insured_name }}</td>
              <td>{{ $key }}</td>
            </tr>
            <tr>
              <td width='15%'></td>
              <td colspan="2">
                <table class="table table-bordered table-striped" style="table-layout: fixed;">
                  <thead>
                    <tr>
                      <th width='15%'>Interest Insured</th>
                      <th width='20%'>Ceding Source</th>
                      <th>CN/DN</th>
                      <th>Cert No</th>
                      <th>Slip No</th>
                      <th>Policy No</th>
                      <th>Share%</th>
                      <th width='15%'>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id='slipinsured${key}'>
                    @foreach ($insureds as $ins)
                    <tr>
                      <td>{{ $ins->interest->code }} - {{ $ins->interest->description }}</td>
                      <td>{{ $ins->interestceding->name }}</td>
                      <td>{{ $ins->interest_cndn_no ?? '-' }}</td>
                      <td>{{ $ins->interest_cert_no ?? '-' }}</td>
                      <td>{{ $ins->interest_slip_no ?? '-' }}</td>
                      <td>{{ $ins->interest_policy_no ?? '-' }}</td>
                      <td>{{strval(number_format($ins->percentage, 2, '.', ','))}}%</td>
                      <td>{{strval(number_format($ins->amountlocation, 2, '.', ','))}}</td>
                      <td>
                        <input type='checkbox' checked disabled></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </td>
            </tr>

            @endforeach
            @elseif(@$type == 'hull' && @$claimdata)
            @foreach (@$claimdata->claiminsureddata as $ins)
            <tr>
              <input type='hidden' id='share{{ $ins->slip_number }}{{ $ins->id }}' value='{{ $ins->percentage }}'>
              <input type='hidden' id='amount{{ $ins->slip_number }}{{ $ins->id }}' value='{{ $ins->amountlocation }}'>
              <td>{{ $ins->interestceding->name }}</td>
              <td>{{ $ins->slip->insureddata->insured_name }}</td>
              <td>{{ $ins->ship->ship_name }}</td>
              <td>{{ $ins->interest_cndn_no ?? '-' }}</td>
              <td>{{ $ins->interest_cert_no ?? '-' }}</td>
              <td>{{ $ins->interest_slip_no ?? '-' }}</td>
              <td>{{ $ins->interest_policy_no ?? '-' }}</td>
              <td>{{strval(number_format($ins->percentage, 2, '.', ','))}}%</td>
              <td>{{strval(number_format($ins->amountlocation, 2, '.', ','))}}</td>
              <td>
                <input type='checkbox' id="check{{ @$claimdata->slip->id }}"
                  name="interestinsured{{ @$claimdata->slip->number }}" checked disabled>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table id="tableslips" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Slip Number</th>
              <th>Ceding/Broker</th>
              <th>Ceding Source</th>
              <th>Reinsurance Period</th>
              <th>Status</th>
              <th>Transfer Date</th>
              <th>Username</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="mainbodyslips">
            @if (@$claimdata->slip)
            <tr>
              <input type='hidden' id='number_slip{{ @$claimdata->slip->id }}' value='{{ @$claimdata->slip->number }}'>
              <input type='hidden' id='uy{{ @$claimdata->slip->id }}' value='{{ @$claimdata->slip->insureddata->uy }}'>
              <input type='hidden' id='kocid{{ @$claimdata->slip->id }}' value='{{ @$claimdata->slip->koc }}'>
              <input type='hidden' id='koc{{ @$claimdata->slip->id }}'
                value='{{ @$claimdata->slip->kindcontract->code }}'>
              <input type='hidden' id='cobid{{ @$claimdata->slip->id }}' value='{{ @$claimdata->slip->cob }}'>
              <input type='hidden' id='cob{{ @$claimdata->slip->id }}'
                value='{{ @$claimdata->slip->corebusiness->code }}'>
              <input type='hidden' id='broker_slip{{ @$claimdata->slip->id }}'
                value='{{ @$claimdata->slip->cedingbroker->name }}'>
              <input type='hidden' id='ceding_slip{{ @$claimdata->slip->id }}'
                value='{{ @$claimdata->slip->ceding->name }}'>
              <input type='hidden' id='status_slip{{ @$claimdata->slip->id }}' value='{{ @$claimdata->slip->status }}'>
              <input type='hidden' id='date_transfer{{ @$claimdata->slip->id }}'
                value='{{ @$claimdata->slip->date_transfer }}'>
              <input type='hidden' id='reinsurance_from{{ @$claimdata->slip->number }}'
                value='{{ @$claimdata->slip->reinsurance_period_from }}'>
              <input type='hidden' id='reinsurance_to{{ @$claimdata->slip->number }}'
                value='{{ @$claimdata->slip->reinsurance_period_to }}'>
              <input type='hidden' id='currency{{ @$claimdata->slip->number }}'
                value='{{ @$claimdata->slip->insureddata->currency }}'>

              <td>{{ @$claimdata->slip->number }}</td>
              <td>{{ @$claimdata->slip->cedingbroker->name }}</td>
              <td>{{ @$claimdata->slip->ceding->name }}</td>
              <td>
                {{ date('d/m/Y',strtotime(@$claimdata->slip->reinsurance_period_from)) }} -
                {{ date('d/m/Y',strtotime(@$claimdata->slip->reinsurance_period_to)) }}
              </td>
              <td>{{ @$claimdata->slip->status }}</td>
              <td>{{ date('d/m/Y',strtotime(@$claimdata->slip->date_transfer)) }}</td>
              <td>{{ @$claimdata->slip->username }}</td>
              <td>
                <a class="text-primary mx-auto" data-toggle="modal" data-target="#detailmodaldata"
                  href="#detailmodaldata">
                  <button type="button" id='btn{{ @$claimdata->slip->id }}' name="btn{{ @$claimdata->slip->number }}"
                    class="btn btn-sm btn-primary mx-auto" data-toggle="modal" data-target="#detailmodaldata2"
                    disabled>Detail
                    Slip</button>
                </a>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>