<div class="row mt-5 mb-3">
  <div class="col align-self-center">Commission Panel for Whole COB</div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Commission</div>
  <div class="col-md-2 align-self-center">
    <div class="input-group">
      <input type="text" class="form-control money text-left" name="commission" id="commission"
        @if(@$specialContract->commission) value="{{ number_format($specialContract->commission, 2) }}" @endif
      autocomplete="off">
      <div class="input-group-append">
        <span class="input-group-text">%</span>
      </div>
    </div>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Overriding by Gross Premium</div>
  <div class="col-md-2 align-self-center">
    <div class="input-group">
      <input type="text" class="form-control money text-left" name="overriding_by_gross_premium"
        id="overriding_by_gross_premium" @if(@$specialContract->overriding_by_gross_premium) value="{{
      number_format($specialContract->overriding_by_gross_premium, 2) }}" @endif autocomplete="off">
      <div class="input-group-append">
        <span class="input-group-text">%</span>
      </div>
    </div>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Overriding by Nett Premium</div>
  <div class="col-md-2 align-self-center">
    <div class="input-group">
      <input type="text" class="form-control money text-left" name="overriding_by_nett_premium"
        id="overriding_by_nett_premium" @if(@$specialContract->overriding_by_nett_premium) value="{{
      number_format($specialContract->overriding_by_nett_premium, 2) }}" @endif autocomplete="off">
      <div class="input-group-append">
        <span class="input-group-text">%</span>
      </div>
    </div>
  </div>
</div>