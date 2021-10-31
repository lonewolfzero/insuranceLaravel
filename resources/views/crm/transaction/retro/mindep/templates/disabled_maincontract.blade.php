<div class="row mb-2">
  <div class="col"></div>
  <div class="col-md-2 align-self-center">User</div>
  <div class="col-md-2">
    <input type="text" class="disabled_user_entry form-control" disabled>
  </div>
</div>

<div class="row mb-5">
  <div class="col"></div>
  <div class="col-md-2 align-self-center">Date Entry</div>
  <div class="col-md-2">
    <input type="text" class="disabled_date_entry form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Main Contract</div>
  <div class="col-md-6">
    <input type="text" class="disabled_main_contract form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">U/W Year</div>
  <div class="col-md-6">
    <input type="text" class="disabled_u_w_year form-control" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">COB</div>
  <div class="col-md-6">
    <select class="disabled_cob e1 form-control" disabled>
      <option value="" disabled selected>Select COB</option>
      @foreach ($cob as $c)
      <option value="{{ $c->id }}">
        {{ $c->code }} - {{ $c->description }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Contract Description</div>
  <div class="col-md-6">
    <textarea name="contract_description" class="disabled_contract_description form-control" rows="3"
      disabled></textarea>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">EGNPI</div>
  <div class="col-md-6">
    <input type="text" class="disabled_egnpi form-control money text-left" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Currency</div>
  <div class="col-md-6">
    <select class="disabled_currency form-control" disabled>
      <option value="" disabled selected>Select Currency</option>
      @foreach ($currency as $c)
      <option value="{{ $c->id }}">
        {{ $c->code }} - {{ $c->symbol_name }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">Period</div>
  <div class="col-md-2">
    <input type="text" class="disabled_period_from form-control datemask datepicker" disabled>
  </div>
  <div class="col-md-2 align-self-center text-center">To</div>
  <div class="col-md-2">
    <input type="text" class="disabled_period_to form-control datemask datepicker" disabled>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-2 align-self-center">ROE</div>
  <div class="col-md-6">
    <input type="text" class="disabled_roe form-control money text-left" disabled>
  </div>
</div>