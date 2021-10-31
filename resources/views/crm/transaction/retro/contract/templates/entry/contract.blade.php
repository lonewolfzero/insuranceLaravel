<div class="row mb-3">
  <div class="col-md-2 align-self-center">Contract Name</div>
  <div class="col-md-2 align-self-center">
    <x-input-text-format all="contract_name" style="text-transform: uppercase" :var="@$specialContract" />
  </div>
  <div class="col"></div>
  <div class="col-md-2 align-self-center">Username</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control" name="user_entry" id="user_entry" @if(@$specialContract->user_entry)
    value="{{ $specialContract->getuser->name }}" @else value="{{ auth()->user()->name }}"
    @endif
    readonly>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">U/W Year</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control yearmask yearpicker" name="u_w_year" id="u_w_year"
      @if(@$specialContract->u_w_year) value="{{ $specialContract->u_w_year }}" @endif
    autocomplete="off">
  </div>
  <div class="col"></div>
  <div class="col-md-2 align-self-center">Date Entry</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control" name="date_entry" id="date_entry" @if(@$specialContract->date_entry)
    value="{{ date('d/m/Y',strtotime($specialContract->date_entry)) }}" @else value="{{ date('d/m/Y', strtotime(now()))
    }}" @endif readonly>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">KOC</div>
  <div class="col-md-4 align-self-center">
    <x-select-option all="koc" text="Select KOC" :master="$koc" :var="@$specialContract" col1="code" col2="description"
      :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">COB</div>
  <div class="col-md-4 align-self-center">
    <x-select-option all="cob" text="Select COB" :master="$cob" :var="@$specialContract" col1="code" col2="description"
      :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Currency</div>
  <div class="col-md-4 align-self-center">
    <select class="e1 form-control" name="currency" id="currency" required>
      <option value="" disabled selected>Select Currency</option>
      @foreach ($currency as $a)
      <option value="{{ $a->id }}" @if(@$specialContract->currency==$a->id) selected @endif>
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
      required @if(@$specialContract->period_from) value="{{ date('d/m/Y',strtotime($specialContract->period_from)) }}"
    @endif>
  </div>
  <div class="col-md-1 align-self-center text-center">To</div>
  <div class="col-md-1 align-self-center">
    <input type="text" class="form-control datemask datepicker" name="period_to" id="period_to" autocomplete="off"
      required @if(@$specialContract->period_to) value="{{ date('d/m/Y',strtotime($specialContract->period_to)) }}"
    @endif>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Type</div>
  <div class="col-md-4 align-self-center">
    @php
    $var = [
    (object)["id"=>"Treaty Retrocession"],
    (object)["id"=>"Facultative Proportional Retrocession"],
    (object)["id"=>"Facultative Non Retrocession"]
    ]
    @endphp
    <x-select-option all="type" text="Select Type" :master="$var" :var="@$specialContract" col1="id"
      :isrequired="true" />
  </div>
</div>