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
        {{ __('TREATY & RETROCESSION Summary Non Prop Adj Mindep List') }}
      </div>

      <div class="card-body">

        <form method="get" action="">
          @csrf
          <div class="row">
            <div class="col-md-12 com-sm-12 mt-3">

              <div class="row">

                <label for="" class="col-1">{{ __('U/W Year') }}</label>
                <div class="col-md-1 form-group d-flex">
                  <input type="text" name="treatyear" id="treatyear" class="form-control form-control-sm ml-2"
                    autocomplete="off">
                </div>

                @if (request()->path() == "treaty/prop/list")
                <div class="col-md-3 form-group d-flex">
                  <label for="">{{ __('Period') }}</label>
                  <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm mx-2"
                    autocomplete="off">
                  <label for="">{{ __('To') }}</label>
                  <input type="text" name="periodto" id="periodto" class="form-control form-control-sm ml-2" autocomplete="off">
                </div>
              </div>
              @else
              <label for="" class="col-1 text-right">{{ __('Prod Year') }}</label>
              <div class="col-md-1 form-group d-flex">
                <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2"
                  autocomplete="off">
              </div>
            </div>
            @endif

            <div class="row">
              <label for="" class="col-1">{{ __('Ceding/Broker') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option selected disabled>{{ __('Ceding/Broker') }}</option>
                  @foreach ($ceding as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->name }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <label for="" class="col-1">{{ __('Ceding Company') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option selected disabled>{{ __('Ceding Company') }}</option>
                  @foreach ($ceding as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->name }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <label for="" class="col-1">{{ __('COB') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option selected disabled>{{ __('COB') }}</option>
                  @foreach ($cob as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              <label for="" class="col-1">{{ __('Detail COB') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option selected disabled>{{ __('COB') }}</option>
                  @foreach ($cob as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <label for="" class="col-1">{{ __('KOC') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option selected disabled>{{ __('KOC') }}</option>
                  @foreach ($koc as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            @if (request()->path() == "treaty/prop/list")
            <div class="row">
              <label for="" class="col-1">{{ __('Status') }}</label>
              <div class="col-md-5 form-group d-flex">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ml-2">
                  <option value="" selected disabled>{{ __('Select Status') }}</option>
                  <option value="0">Pre Summary</option>
                  <option value="1">Draft</option>
                  <option value="2">Original</option>
                  <option value="3">Endorsment</option>
                </select>
              </div>
            </div>
            @endif

          </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-md btn-primary">{{ @$button_text ? $button_text : 'Search' }}</button>
              </div>
            </div>
          </div>
        </form>

        <hr>

        {{ Form::open(array('url'=>'transaction-data/marine-index')) }}
            

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

        <hr>

        <div class="col-md-12">
            <div class="card-header bg-gray">
              Adjusment Installment Mindep
            </div>
            <div class="card card-primary">
                <div class="card-body">
                  
                 @php
                  
                  $headers = ['ID(GROUP COB NUMBER)', 'Layer Level',
                  'Limit (100%) ','Reinstatement', 'Nasre Share','OGRP1', 'Mindep (100%)', 'Status','Date Entry', 'Action'];

                  $column = [
                  ['one'=>'groupcob_number'],
                  ['one'=>'layer_level'],
                  ['one'=>'limit_rate'],
                  ['one'=>'reinstatement', 'type'=>'money'],
                  ['one'=>'nasre_share', 'type'=>'money'],
                  ['one'=>'nasre_share', 'type'=>'money'],
                  ['one'=>'mindep_rate'],
                  ['one'=>'status_layer'],
                  ['one'=>'created_at', 'type'=>'date'],
                  ['one'=>'action']];
                  @endphp

                  @include('crm.transaction.treaty.templates.filter.table', [
                  "headers"=>$headers,
                  "column"=>$column,
                  "data"=>$adjinstallmindep,
                  "url"=>'/treaty/nonprop/adjentry',
                  ])
            
              
                </div>
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