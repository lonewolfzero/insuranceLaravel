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
        {{ __('Lost Participation List') }}
      </div>

      <div class="card-body">

        @include('crm.transaction.treaty.templates.filter.form', ["url"=>"/treaty/lost/list"])

        <hr>

        @php
        $headers = [
        'ID',
        'Ceding',
        'Member',
        'U/W Year',
        'Treaty Contract',
        'Doc Date',
        'Share Nasre',
        'Currency',
        'Lost Participation',
        'Lost Part Paid',
        'Date Entry',
        'Action'];
        $column = [
        ['one'=>'loss_id'],
        ['one'=>'getprop', 'two'=>'getbroker', 'three'=>'name'],
        ['one'=>'getprop', 'two'=>'getcompany', 'three'=>'name'],
        ['one'=>'getprop', 'two'=>'treaty_year'],
        ['one'=>'getprop', 'two'=>'id_detail_contract'],
        ['one'=>'date_prod', 'type'=>'date'],
        ['one'=>'nasionalre_share', 'type'=>'money'],
        ['one'=>'getprop', 'two'=>'getsubdetail', 'three'=>'getcurrency', 'four'=>'code'],
        ['one'=>'loss_participation_idr', 'type'=>'money'],
        ['one'=>'loss_participation_idr', 'type'=>'money'],
        ['one'=>'created_at', 'type'=>'date'],
        ['one'=>'action']];
        @endphp
        @include('crm.transaction.treaty.templates.filter.table', [
        "headers"=>$headers,
        "column"=>$column,
        "data"=>$loss,
        "url"=>'/treaty/loss/entry',
        'delete_url'=>'/treaty/loss/delete'
        ])

      </div>

    </div>
  </div>
</div>

</div>

</div>

@endsection

@section('scripts')
{{-- @include('crm.transaction.claim.index_script') --}}
@endsection