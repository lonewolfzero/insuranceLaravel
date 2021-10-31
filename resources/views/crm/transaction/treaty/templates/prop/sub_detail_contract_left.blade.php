<div class="col">
  <div class="row mb-2">
    <div class="col-md-3">ID Sub Detail Contract</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="id_sub_detail_contract" type="text"
        id="id_sub_detail_contract" value="{{ @$subdetail->id_sub_detail_contract }}" readonly>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Period</div>
    <div class="col-md-3">
      <input class="form-control form-control-sm datemask datepicker" name="period_from" type="text" id="period_from"
        @if(@$subdetail->period_from) value="{{ date('d/m/Y',strtotime(@$subdetail->period_from)) }}" @endif
      autocomplete="off" required>
    </div>
    <div class="col-md-1">To</div>
    <div class="col-md-3">
      <input class="form-control form-control-sm datemask datepicker" name="period_to" type="text" id="period_to"
        @if(@$subdetail->period_to) value="{{ date('d/m/Y',strtotime(@$subdetail->period_to)) }}" @endif
      autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Business Type</div>
    <div class="col-md-5">
      <select name="business_type" class="e1 form-control form-control-sm" id="business_type" required>
        <option value="" disabled selected></option>
        <option value="new" @if(@$subdetail->business_type == "new") selected @endif>New</option>
        <option value="renewal" @if(@$subdetail->business_type == "renewal") selected @endif>Renewal</option>
        <option value="unknown" @if(@$subdetail->business_type == "unknown") selected @endif>Unknown</option>
      </select>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Currency</div>
    <div class="col-md-5">
      <select name="currency" class="e1 form-control form-control-sm" id="currency" required>
        <option value="" disabled selected></option>
        @foreach ($currencies as $c)
        @if (@$subdetail->currency == $c->id)
        <option value="{{ $c->id }}" selected>{{ $c->code }}</option>
        @else
        <option value="{{ $c->id }}">{{ $c->code }}</option>
        @endif
        @endforeach
      </select>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">ROE</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="roe" id="roe"
        value="{{ @$subdetail->roe ? number_format(@$subdetail->roe, 2) : '' }}" autocomplete="off" required>
    </div>
  </div>

  {{-- @if (request()->path() == "treaty/subdetail/entry") --}}
  <div class="row mb-2">
    <div class="col-md-3">Treaty Limit (100%)</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="treaty_limit" type="tel"
        id="treaty_limit" value="{{ @$subdetail->treaty_limit ? number_format(@$subdetail->treaty_limit, 2) : '' }}"
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Gross OR (% for QS)</div>
    <div class="col-md-5">
      <div class="input-group input-group-sm">
        <input
          class="form-control form-control-sm @if(@$subdetail->getkoc->description == 'SURPLUS') money @endif text-left"
          name="gross_or" type="tel" id="gross_or"
          value="{{ @$subdetail->gross_or ? number_format(@$subdetail->gross_or, 2) : '' }}" autocomplete="off"
          required>
        <div class="input-group-append" id="label_percentage_gross" style="display: none"><span
            class="input-group-text">%</span></div>
      </div>
    </div>
  </div>
  {{-- @endif --}}

  <div class="row mb-2">
    <div class="col-md-3">Net OR</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="net_or" type="tel"
        id="net_or" value="{{ is_numeric(@$subdetail->net_or) ? number_format(@$subdetail->net_or, 2) : '' }}" readonly
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Line (Nil for QS)</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="line" type="text" id="line"
        value="{{ @$subdetail->line }}" readonly required></div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Event Limit</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="event_limit" type="text"
        id="event_limit" value="{{ @$subdetail->event_limit ? number_format(@$subdetail->event_limit, 2) : '0' }}"
        autocomplete="off" required></div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Cession Limit</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="cession_limit" type="text"
        id="cession_limit" value="{{ @$subdetail->cession_limit ? number_format(@$subdetail->cession_limit, 2) : '0' }}"
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">PLA</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="pla" type="text" id="pla"
        value="{{ @$subdetail->pla ? number_format(@$subdetail->pla, 2) : '' }}" autocomplete="off" required></div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Cash Call Limit</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="cash_call_limit" type="text"
        id="cash_call_limit"
        value="{{ @$subdetail->cash_call_limit ? number_format(@$subdetail->cash_call_limit, 2) : '' }}"
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Claim Coop Limit</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="claim_coop_limit"
        type="text" id="claim_coop_limit"
        value="{{ @$subdetail->claim_coop_limit ? number_format(@$subdetail->claim_coop_limit, 2) : '' }}"
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-3">Accumulation Control</div>
    <div class="col-md-5">
      <select name="accumulation_control_interval" class="form-control form-control-sm"
        id="accumulation_control_interval" required>
        <option value="" disabled selected>Select Interval</option>
        <option value="Non Reporting" @if(@$subdetail->accumulation_control_interval == "Non Reporting") selected
          @endif>Non Reporting
        </option>
        <option value="Quarterly" @if(@$subdetail->accumulation_control_interval == "Quarterly") selected
          @endif>Quarterly
        </option>
        <option value="Yearly" @if(@$subdetail->accumulation_control_interval == "Yearly") selected @endif>Yearly
        </option>
        <option value="Monthly" @if(@$subdetail->accumulation_control_interval == "Monthly") selected @endif>Monthly
        </option>
      </select>
    </div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input type="number" name="accumulation_control_day" class="form-control" aria-label="Recipient's username"
          aria-describedby="basic-addon2" id="accumulation_control_day"
          value="{{ @$subdetail->accumulation_control_day ?? '0' }}" autocomplete="off" required>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2">Days</span>
        </div>
      </div>
      {{-- <input class="form-control form-control-sm" type="number" id="accumulation_days"> --}}
    </div>
    {{-- <div class="col-md-1">
      <p>Days</p>
    </div> --}}
  </div>

</div>