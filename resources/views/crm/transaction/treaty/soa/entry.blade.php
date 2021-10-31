@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .styled-border {
    border-width: 3px !important;
    border-color: black !important
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">

  @include('crm.transaction.treaty.templates.soa.bordero_modal')
  @include('crm.transaction.treaty.templates.soa.copy_modal')
  @include('crm.transaction.treaty.templates.soa.sub_detail_modal')
  @include('crm.transaction.treaty.templates.soa.ban_limit_modal')

  <div class="container-fluid">

    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('Statement Of Account Entry') }}
      </div>

      <div class="card-body bg-light-gray">
        <div class="card">
          <div class="card-header bg-gray">
            {{ __('Document Registration') }}
          </div>
          <div class="card-body bg-light-gray">

            <!-- region  document registration  -->
            @include('crm.transaction.treaty.templates.soa.document_registration')
            <!-- end of region  document registration  -->

          </div>

          <div class="card-body bg-light-gray">
            <form action="/treaty/soa/store" method="post" id="soa_form">
              @csrf
              <input type="hidden" name="sub_detail_contract_id" id="sub_detail_contract_id"
                value="{{ @$soa->sub_detail_contract_id }}">
              <input type="hidden" name="registration_id" id="registration_id" value="{{ @$soa->registration->id }}">
              <input type="hidden" id="vat_check" value="{{ @$soa->getprop->getsubdetail->vat_check }}">
              <div class="card">
                <div class="card-body bg-light-gray">


                  @if($errors->any())
                  {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                  @endif

                  <!-- region  TOP FORM  -->
                  @include('crm.transaction.treaty.templates.soa.top_form')
                  <!-- end of region  TOP FORM  -->

                  <div class="col-md-6">
                    <!-- region  bordero upload  -->
                    @include('crm.transaction.treaty.templates.soa.bordero_upload')
                    <!-- end of region  bordero upload  -->

                    <!-- region  cash loss  -->
                    @include('crm.transaction.treaty.templates.soa.cash_loss')
                    <!-- end of region  cash loss  -->
                  </div>

                </div>

                <div class="row mt-4">
                  <!-- region  TREATY 100%  -->
                  @include('crm.transaction.treaty.templates.soa.treaty_100')
                  <!-- end of region  TREATY 100%  -->

                  <!-- region  NASIONALRE SHARE  -->
                  @include('crm.transaction.treaty.templates.soa.nasionalre_share')
                  <!-- end of region  NASIONALRE SHARE  -->
                </div>

                <!-- region  BUTTONS  -->
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <div class="row justify-content-center my-4">
                      <div class="col-md-4 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of region  BUTTONS  -->

              </div>
          </div>
          </form>
        </div>

      </div>
    </div>



  </div>

  <div class="card">
    <div class="card-body bg-light-gray">

      <!-- region  TABLE  -->
      @include('crm.transaction.treaty.templates.soa.bottom_table')
      <!-- end of region  TABLE  -->

    </div>
  </div>

</div>

</div>

@endsection


@section('scripts')

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/treaty/soa/index.js') }}"></script>
<script src="{{ asset('/js/treaty/soa/entry.js') }}"></script>

@endsection