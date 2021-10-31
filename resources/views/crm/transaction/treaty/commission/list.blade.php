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
        {{ __('Profit Commission List') }}
      </div>

      <div class="card-body">

        @include('crm.transaction.treaty.templates.filter.form', ["url"=>"/treaty/profit/list"])

        <hr>

        @php
        $headers = [
        'Ceding',
        'Member',
        'U/W Year',
        'Treaty Contract',
        'Doc Date',
        'Currency',
        'Profit Comm',
        'Profit Comm Paid',
        'Action',
        ];
        $column = [
        ['one'=>'getbroker', 'two'=>['code', 'company_name']],
        ['one'=>'getcompany', 'two'=>['code', 'company_name']],
        ['one'=>'treaty_year'],
        ['one'=>'getprop', 'two'=>'id_detail_contract'],
        ['one'=>'date_prod', 'type'=>'date'],
        ['one'=>'currency_radio'],
        ['one'=>'profit_commission_amount', 'type'=>'money'],
        ['one'=>'losses_paid', 'type'=>'money'],
        ['one'=>'action']];
        @endphp
        @include('crm.transaction.treaty.templates.filter.table', [
        "headers"=>$headers,
        "column"=>$column,
        "data"=>$commission,
        "url"=>'/treaty/commission/entry',
        'delete_url'=>'/treaty/commission/delete'
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