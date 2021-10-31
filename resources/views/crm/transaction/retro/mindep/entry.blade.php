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
        Retrocession Entry
      </div>

      <div class="card-body bg-light-gray">

        <input type="hidden" name="form_view" id="form_view" value="{{ @$form_view }}">
        <input type="hidden" name="main_contract_id" class="main_contract_id" value="{{ @$maincontract->id }}">
        <input type="hidden" name="layer_id" class="layer_id" value="{{ @$layer->id }}">

        @include('crm.transaction.retro.mindep.templates.modal_spreading')
        @include('crm.transaction.retro.mindep.templates.modal_installment')
        @include('crm.transaction.retro.mindep.templates.modal_detail_layer')
        @include('crm.transaction.retro.mindep.templates.modal_panel_member')

        @include('crm.transaction.retro.mindep.templates.breadcumb')

        @include('crm.transaction.retro.mindep.templates.maincontract')

        @include('crm.transaction.retro.mindep.templates.layer')

        @include('crm.transaction.retro.mindep.templates.panelretro')

        @include('crm.transaction.retro.mindep.templates.adjusment')

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

<script src="{{ asset('/js/retro/mindep/entry/index.js') }}"></script>
<script src="{{ asset('/js/retro/mindep/entry/entry.js') }}"></script>

@endsection