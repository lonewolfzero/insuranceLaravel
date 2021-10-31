<hr class="my-5">

<div class="row mb-3">
  <div class="col-md-2 align-self-center">Max Liability</div>
  <div class="col-md-2 align-self-center">
    <input type="text" class="form-control money text-left" name="max_liability" id="max_liability"
      @if(@$specialContract->max_liability) value="{{ number_format($specialContract->max_liability, 2) }}" @endif
    autocomplete="off">
  </div>
</div>

<section id="treaty" style="display: none">
  <div class="row mb-3">
    <div class="col-md-2 align-self-center">Source Amount</div>
    <div class="col-md-4 align-self-center">
      @php
      $var = [
      (object)["id"=>"Gross Premium 100%"],
      (object)["id"=>"Nasionalre Share Gross Premium"],
      (object)["id"=>"Nasionalre Share Nett Premium"],
      (object)["id"=>"Nasionalre Share Nett Balance"],
      ]
      @endphp
      <x-select-option all="source_amount" text="Select Source Amount" :master="$var" :var="@$specialContract"
        col1="id" />
    </div>
  </div>

  <div class="row">

    <div class="col-md-6">
      @include('crm.transaction.retro.contract.templates.entry.commission_card')
    </div>

    <div class="col-md-6">
      @include('crm.transaction.retro.contract.templates.entry.retrocession_card')
    </div>

  </div>
</section>

<section id="facultative" style="display: none">
  @include('crm.transaction.retro.contract.templates.entry.commission_panel')
</section>

<div class="row mb-3 justify-content-center">
  <div class="col-md-2 align-self-center text-center">
    <button class="btn btn-primary">Submit</button>
  </div>
</div>