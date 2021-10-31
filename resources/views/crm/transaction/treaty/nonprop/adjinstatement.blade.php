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
        {{ __('Treaty Summary TTY Entry Non Prop') }}
      </div>

      <div class="card-body">

            @include('crm.transaction.treaty.templates.filter.filternonprop', ["url"=>"/treaty/sharing/list"])
            <hr>

       
            @include('crm.transaction.treaty.templates.filter.formnonpropCOB', ["url"=>"/treaty/sharing/list"])
          
            <hr>

            <div class="col-md-12">
                <div class="card-header bg-gray">
                 Layer
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                      
                    @include('crm.transaction.treaty.templates.filter.table', ["headers"=>['No', 'Layer Level',
                    'U/W Retention','Limit(100%)', 'Reinstatement','Nasre Share', 'Liability', 'MD Premium', 'AA Deductible', 'OGRP1', 'Adj Prem Rate', 'Mindep (100%)', 'Premium Type', 
                    'Retro Share','Liability', 'MD Premium','AAD Limit', 'Status']])
                      
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card-header bg-gray">
                Detail COB
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                      
                    @include('crm.transaction.treaty.templates.filter.table', ["headers"=>['No', 'Detail COB',
                    'Currency','Brokerage', 'Action']])
            
                    
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card-header bg-gray">
                 Calculation Reinstatement
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                      
                    @include('crm.transaction.treaty.templates.filter.table', ["headers"=>['No', 'Reins ID',
                    'Statu Doc','Date Prod', 'DLA Reff','Insured ', 'Currency', 'Settlement', 'Loss Nasre', 'Reins Rate', 'Action']])
                      
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card-header bg-gray">
                 Adjustment Reinstatement
                </div>
                <div class="card card-primary">
                    <div class="card-body">

                    <div class="row">
                        
                      <div class="col-md-2">
                        <label for="">{{ __('Reins ID') }}</label>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                          <input type="text" class="form-control form-control-sm">
                          </div>
                      </div>
                      
                      <div class="col-md-1">
                        <label for="">{{ __('Counter Number') }}</label>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                          <input type="text" class="form-control form-control-sm">
                          </div>
                      </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                          <label for="">{{ __('Due Date') }}</label>
                        </div>
  
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <label for="">{{ __('Position') }}</label>
                        </div>
  
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <label for="">{{ __('Reinstatement') }}</label>
                        </div>
  
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <label for="">{{ __('Nasre Share') }}</label>
                        </div>
  
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="row justify-content-center">

                            <div class="row">   
                                <div class="col-md-12">
                                  <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block ">
                                              {{__('Add  ')}}
                                        </button>
                                  </div>
                                </div>
                            </div>
                                
                        </div>
                      </div>
                      
                    @include('crm.transaction.treaty.templates.filter.table', ["headers"=>['No', 'Reins ID',
                    'Due Date','Position', 'Reinstatement','Nasre Share','Action']])
                      
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row justify-content-center">

                    <div class="col-md-8">
                      <div class="row justify-content-center my-4">
                        <div class="col-md-4 text-center"><button type="submit" id="addslipinsured-btn"  class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-md-4 text-center"><button  id="cancelslipinsured-btn" class="btn btn-primary">Cancel</button></div>
                      </div>
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