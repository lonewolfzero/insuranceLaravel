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
        {{ __('Treaty Summary Proportional List') }}
      </div>

      <div class="card-body">

        @include('crm.transaction.treaty.templates.filter.form', ["url"=>"/treaty/prop/list"])

        <hr>

        @php
        $headers = [
        'Status',
        'Treaty Code',
        'ID Detail - Sub Contract',
        'Ceding',
        'Member',
        'Date Production',
        'Treaty Year',
        'Treaty Limit',
        'Currency',
        'Share',
        'Net OR',
        'Brokerage',
        'RI Gross',
        'RI Com Nett',
        'Action'];
        $column = [
        ['one'=>'status'],
        ['one'=>'getprop','two'=>'treaty_code'],
        ['one'=>'id_sub_detail_contract'],
        ['one'=>'getprop','two'=>'getbroker', 'three'=>'name'],
        ['one'=>'leader_member_status'],
        ['one'=>'date_prod', 'type'=>'date'],
        ['one'=>'getprop','two'=>'treaty_year'],
        ['one'=>'treaty_limit', 'type'=>'money'],
        ['one'=>'getcurrency', 'two'=>'code'],
        ['one'=>'nasionalre_share_first', 'type'=>'percent'],
        ['one'=>'net_or', 'type'=>'money'],
        ['one'=>'brokerage', 'type'=>'percent'],
        ['one'=>'r_i_comm_gross', 'type'=>'percent'],
        ['one'=>'r_i_comm_nett', 'type'=>'percent'],
        ['one'=>'action']];
        @endphp
        @include('crm.transaction.treaty.templates.filter.table',
        ["headers"=>$headers, "column"=>$column, "data"=>$subdetail,
        'delete_url'=>'/treaty/prop/delete'])

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

<script src="{{ asset('/js/treaty/prop/index.js') }}"></script>
@endsection