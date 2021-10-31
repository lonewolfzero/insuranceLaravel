<div class="row">
  <div class="col-md-12">

    <div class="row mb-3">
      <div class="col-md-2 align-self-center">KOC</div>
      <div class="col-md-3">
        <input type="hidden" name="koc" class="koc form-control">
        <x-select-option all="koc" :master="$koc" col1="code" col2="description" :isdisabled="true"
          :isrequired="true" />
      </div>
      <div class="col-md-2 align-self-center text-center">COB</div>
      <div class="col-md-3">
        <input type="hidden" name="cob" class="cob form-control">
        <x-select-option all="cob" :master="$cob" col1="code" col2="description" :isdisabled="true"
          :isrequired="true" />
      </div>
      <div class="col-md-1 align-self-center text-center">UY</div>
      <div class="col-md-1">
        <x-input-text-format all="uy" :isrequired="true" :isreadonly="true" />
      </div>
    </div>

    <div class="row">

      <div class="col-md-6">

        @include('crm.transaction.claim.v2.templates.form_left')

      </div>

      <div class="col-md-6">

        @include('crm.transaction.claim.v2.templates.form_right')

      </div>

    </div>

    @include('crm.transaction.claim.v2.templates.form_bottom')

  </div>
</div>