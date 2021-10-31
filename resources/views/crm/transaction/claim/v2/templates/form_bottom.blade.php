<div class="row mb-3">

  <div class="col-md-6">

    <div class="row mb-3">
      <div class="col-md-4 align-self-center">Estimate Amount Subrogasi</div>
      <div class="col-md-3">
        <div class="input-group">
          <x-input-money-format all="estimate_subrogasi_percentage" :isrequired="true" />
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <x-input-money-format all="estimate_subrogasi_amount" :isreadonly="true" />
      </div>
    </div>

  </div>

  <div class="col-md-6">

    <div class="row mb-3">
      <div class="col-md-4 align-self-center text-center">Total Loss Amount</div>
      <div class="col-md-7">
        <x-input-money-format all="total_loss_amount" :isreadonly="true" />
      </div>
    </div>

  </div>

</div>

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Potential Recovery</div>
  <div class="col-md-1 align-self-center">
    @php
    $var = [
    (object)["id"=>"Yes"],
    (object)["id"=>"No"],
    ]
    @endphp
    <x-select-option all="potential_recovery_decision" text="" :master="$var" :var="@$claim" col1="id" />
  </div>
  <div class="col-md-8">
    <x-input-text-area all="potential_recovery" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3 align-self-center">Kronologi</div>
  <div class="col-md-8">
    <x-input-text-area all="kronologi" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3 align-self-center">Staff Recommendation</div>
  <div class="col-md-8">
    <x-input-text-area all="staff_recommeandation" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3 align-self-center">Assistan Manager Recommendation</div>
  <div class="col-md-8">
    <x-input-text-area all="assistan_manager_recommendation" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3 align-self-center">Manager Recommendation</div>
  <div class="col-md-8">
    <x-input-text-area all="manager_recommendation" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-3 align-self-center">General Manager Recommendation</div>
  <div class="col-md-8">
    <x-input-text-area all="general_manager_recommendation" />
  </div>
</div>

<div class="row justify-content-center mt-5">
  <div class="col-md-2 text-center">
    <button class="btn btn-primary">Submit</button>
  </div>
</div>