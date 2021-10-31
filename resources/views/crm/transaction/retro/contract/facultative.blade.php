@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1100 !important;
    background: rgba(255, 255, 255, 0.8) url("{{ asset('loader.gif') }}") center no-repeat;
  }

  /* Turn off scrollbar when body element has the loading class */
  body.loading {
    overflow: hidden;
  }

  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay {
    display: block;
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    <div class="card">

      <div class="card-header bg-gray">
        Treaty Retrocession
      </div>

      <div class="card-body bg-light-gray">

        @include('crm.transaction.retro.contract.templates.modal_member_panel')
        @include('crm.transaction.retro.contract.templates.modal_edit_detail_data')
        @include('crm.transaction.retro.contract.templates.modal_incoming_panel')
        @include('crm.transaction.retro.contract.templates.disabled_contract')
        @include('crm.transaction.retro.contract.templates.facultative.retrocession_card')

        <div class="card card-tabs">
          <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs nav-tabs-top" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#premium" role="tab" aria-controls="premium"
                  aria-selected="true">Premium Production</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" data-toggle="pill" href="#claim" role="tab" aria-controls="claim"
                  aria-selected="true">Claim Production</a>
              </li>
            </ul>
          </div>
          <div class="card-body bg-light-gray">
            <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="premium" href="#premium" role="tabpanel"
                aria-labelledby="general-details">
                @include('crm.transaction.retro.contract.templates.document', ['data'=>$premiums,'table'=>'premium'])

              </div>

              <div class="tab-pane fade" id="claim" href="#claim" role="tabpanel" aria-labelledby="general-details">
                @include('crm.transaction.retro.contract.templates.document', ['data'=>$claims,'table'=>'claim'])
              </div>
            </div>
          </div>
        </div>

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

<script src="{{ asset('/js/templates/main.js') }}"></script>
<script src="{{ asset('/js/retro/contract/facultative.js') }}"></script>

@endsection