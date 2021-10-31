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
        {{ __('Accumulation Control List') }}
      </div>

      <div class="card-body">
      
        @include('crm.transaction.treaty.templates.filter.form', ["url"=> url("/treaty/acc/list")])

        <hr>

        {{ Form::open(array('url'=>'treaty/acc/list')) }}
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-2">
                <div class="form-group">
                 {!! link_to('treaty/acc/upload','Upload Accumulation Control',['class'=>'btn btn-primary']) !!}
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                 {!! link_to('treaty/acc/entry','Entry Accumulation Control',['class'=>'btn btn-primary']) !!}
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                   
                </div>
                <div class="col-md-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                              <div class="form-group">
                                  <label for="">{{__('Search')}}</label>
                                  {{ Form::text('search',@$search,['class'=>'form-control form-control-sm','placeholder'=>'Cari Number']) }}
                              </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

        {{ Form::close() }}

    
        @php
        $headers = [
        'ID',
        'Ceding',
        'Member', 'Type', 'Position as at', 'Currency', 'COB', 'KOC','Zone Number','Total Amount','Created',
        'Action'];
        $column = [
        ['one'=>'number'],
        ['one'=>'cedingbroker', 'two'=>'name'],
        ['one'=>'userid', 'two'=>'name'],
        ['one'=>'type'],
        ['one'=>'position', 'type'=>'date'],
        ['one'=>'currencies', 'two'=>'symbol_name'],
        ['one'=>'cob', 'two'=>'description'],
        ['one'=>'koc', 'two'=>'description'],
        ['one'=>'zoneearth', 'two'=>'name'],
        ['one'=>'total_amount', 'type'=>'money'],
        ['one'=>'created_at', 'type'=>'date'],
        ['one'=>'action']];
        @endphp

        @include('crm.transaction.treaty.templates.filter.table', [
        "headers"=>$headers,
        "column"=>$column,
        "data"=>$accu,
        "url"=>'/treaty/acc/entry',
        "delete_url"=>'/treaty/acc/delete',
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


<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }

  /* Firefox */
  input[type=number] {
      -moz-appearance: textfield;
  }

  .swal-wide{
    width:850px !important;
}
</style>


<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/treaty/prop/index.js') }}"></script>
<script src="{{ asset('/js/treaty/prop/entry.js') }}"></script>

@endsection