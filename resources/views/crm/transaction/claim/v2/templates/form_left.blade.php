<div class="row mb-3">
  <div class="col-md-4 align-self-center">Regcomp</div>
  <div class="col-md-3">
    <x-input-text-format all="regcomp" :isreadonly="true" />
  </div>
  <div class="col-md-1">
    <x-input-money-format all="counter" defval="0" :style="'padding: 5px'" :isreadonly="true" />
  </div>
  <div class="col-md-2 align-self-center text-center">Status</div>
  <div class="col-md-2">
    <x-input-text-format all="status" defval="PLA" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Doc Ref Number</div>
  <div class="col-md-8">
    <x-input-text-format all="doc_ref_number" :isrequired="true" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Doc Number DLA/PLA</div>
  <div class="col-md-8">
    <x-input-text-format all="doc_number_pla_dla" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Cause Of Loss</div>
  <div class="col-md-8">
    <x-select-option all="cause_of_loss" :master="$causeofloss" text="Select Cause Of Loss" col1="number" col2="nama"
      :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Nature Of Loss</div>
  <div class="col-md-8">
    <x-select-option all="nature_of_loss" :master="$natureofloss" text="Select Nature Of Loss" col1="number"
      col2="accident" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Reinsurance Periode</div>
  <div class="col-md-1 align-self-center">From</div>
  <div class="col-md-3">
    <x-input-text-format all="reinsurance_periode_from" :isreadonly="true" :isrequired="true" />
  </div>
  <div class="col-md-1 align-self-center text-center">To</div>
  <div class="col-md-3">
    <x-input-text-format all="reinsurance_periode_to" :isreadonly="true" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Date Of Loss</div>
  <div class="col-md-3">
    <x-input-date-format all="date_of_loss" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Curr Of Loss</div>
  <div class="col-md-8">
    <x-select-option all="curr_of_loss" :master="$currency" text="Select Curr Of Loss" col1="code" col2="symbol_name"
      :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Adjuster</div>
  <div class="col-md-8">
    <x-select-option all="adjuster" :master="$adjuster" text="Select Adjuster" col1="keterangan" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Surveyor</div>
  <div class="col-md-8">
    <x-select-option all="surveyor" :master="$surveyor" text="Select Surveyor" col1="keterangan" :isrequired="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">National Re's Liab</div>
  <div class="col-md-3">
    <div class="input-group">
      <x-input-money-format all="nasionalre_liab_percentage" :isreadonly="true" />
      <div class="input-group-append">
        <span class="input-group-text">%</span>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <x-input-money-format all="nasionalre_liab_amount" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">Cedant's Share</div>
  <div class="col-md-8">
    <x-input-money-format all="cedant_Share" :isreadonly="true" />
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-4 align-self-center">National Re's Share on Loss</div>
  <div class="col-md-8">
    <x-input-money-format all="nasionalre_share_on_loss" :isreadonly="true" />
  </div>
</div>