<div class="row mb-3">
  <div class="col-md-2 align-self-center">Contract Name</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control" name="contract_name" id="contract_name"
      value="{{ @$contract->contract_name }}" autocomplete="off" style="text-transform: uppercase" disabled>
  </div>
  <div class="col"></div>
  <div class="col-md-2 align-self-center">Username</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control" name="username" id="username" value="{{ @$contract->getuser->name }}"
      disabled>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">U/W Year</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control yearmask yearpicker" name="u_w_year" id="u_w_year"
      value="{{ @$contract->u_w_year }}" autocomplete="off" disabled>
  </div>
  <div class="col"></div>
  <div class="col-md-2 align-self-center">Date Entry</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control" name="date_entry" id="date_entry"
      value="{{ date('d/m/Y',strtotime(@$contract->date_entry)) }}" disabled>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">KOC</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="koc" id="koc" disabled>
      <option value="" disabled selected>Select KOC</option>
      @foreach ($koc as $a)
      <option value="{{ $a->id }}" @if(@$contract->koc == $a->id) selected @endif>
        {{ $a->code }} - {{ $a->description }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">COB</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="cob" id="cob" disabled>
      <option value="" disabled selected>Select COB</option>
      @foreach ($cob as $a)
      <option value="{{ $a->id }}" @if(@$contract->cob == $a->id) selected @endif>
        {{ $a->code }} - {{ $a->description }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Currency</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="currency" id="currency" disabled>
      <option value="" disabled selected>Select Currency</option>
      @foreach ($currency as $a)
      <option value="{{ $a->id }}" @if(@$contract->currency == $a->id) selected @endif>
        {{ $a->curr->code }} - {{ $a->curr->symbol_name }} : {{ $a->kurs }} Rupiah
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Period</div>
  <div class="col-md-1 align-self-center">From</div>
  <div class="col-md-1 align-self-center">
    <input type="text" class="form-control datemask datepicker" name="period_from" id="period_from" autocomplete="off"
      value="{{ date('d/m/Y',strtotime(@$contract->period_from)) }}" disabled>
  </div>
  <div class="col-md-1 align-self-center text-center">To</div>
  <div class="col-md-1 align-self-center">
    <input type="text" class="form-control datemask datepicker" name="period_to" id="period_to" autocomplete="off"
      value="{{ date('d/m/Y',strtotime(@$contract->period_to)) }}" disabled>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Type</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="type" id="type" disabled>
      <option value="" disabled selected>Select Type</option>
      <option @if(@$contract->type == "Treaty Retrocession") selected @endif
        value="Treaty Retrocession">
        Treaty Retrocession
      </option>
      <option @if(@$contract->type == "Facultative Proportional Retrocession") selected @endif
        value="Facultative Proportional Retrocession">
        Facultative Proportional Retrocession
      </option>
      <option @if(@$contract->type == "Facultative Non Proportional Retrocession") selected @endif
        value="Facultative Non Proportional Retrocession">
        Facultative Non Proportional Retrocession
      </option>
    </select>
  </div>
</div>

<hr class="my-5">
@if (@$show)
<div class="row mb-3">
  <div class="col-md-2 align-self-center">Max Liability</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control money text-left" name="max_liability" id="max_liability"
      value="{{ @$contract->max_liability }}" autocomplete="off" disabled>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Source Amount</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="source_amount" id="source_amount" disabled>
      <option value="" disabled selected>Select Source Amount</option>
      <option value="Gross Premium 100%" @if(@$contract->source_amount == "Gross Premium 100%") selected @endif>Gross
        Premium 100%</option>
      <option value="Nasionalre Share Gross Premium" @if(@$contract->source_amount == "Nasionalre Share Gross Premium")
        selected @endif>Nasionalre Share Gross Premium</option>
      <option value="Nasionalre Share Nett Premium" @if(@$contract->source_amount == "Nasionalre Share Nett Premium")
        selected @endif>Nasionalre Share Nett Premium
      <option value="Nasionalre Share Nett Balance" @if(@$contract->source_amount == "Nasionalre Share Nett Balance")
        selected @endif>Nasionalre Share Nett Balance
      </option>
    </select>
  </div>
</div>

<hr class="my-5">
@endif