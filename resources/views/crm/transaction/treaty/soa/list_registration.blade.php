@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('Statement Of Account Nil Reminder') }}
      </div>

      <div class="card-body">

        @include('crm.transaction.treaty.templates.filter.form', ["url"=>"/treaty/soa/nil/list"])

        <hr>

        @php
        $headers = [
        'Reg Number',
        'Ref Number',
        'Delivered By',
        'Type',
        'Period',
        'Accounting Year',
        'action'];
        $column = [
        ['one'=>'reg_number'],
        ['one'=>'ref_number'],
        ['one'=>'delivered_by'],
        ['one'=>'type'],
        ['one'=>'period'],
        ['one'=>'accounting_year'],
        ['one'=>'action']];
        @endphp
        @include('crm.transaction.treaty.templates.filter.table', [
        "headers"=>$headers,
        "column"=>$column,
        "data"=>$registrations,
        "custom_id"=>'soa',
        "url"=>'/treaty/soa/entry',
        'delete_url'=>'/treaty/registration/delete'
        ])

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

<script src="{{ asset('/js/treaty/soa/index.js') }}"></script>
@endsection