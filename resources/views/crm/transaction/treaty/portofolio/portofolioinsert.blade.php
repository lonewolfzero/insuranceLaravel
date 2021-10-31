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
        {{ __('Portofolio Form') }}
      </div>

      
      <div class="card-body">
       
                {{ Form::open(array('url'=>'transaction-data/marine-index')) }}
                  
                  <div class="row">
                    
                    <div class="col-md-2">
                        <label for="">{{__('U/W Year')}}</label>
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
                        <label for="">{{ __('Ceding/Broker') }}</label>
                      </div>
                        
                      <div class="col-md-6">
                            <div class="form-group">
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
                       
                      <div class="col-md-4">
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Ceding Company') }}</label>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
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
                       
                      <div class="col-md-4">
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Period') }}</label>
                      </div>
                      
                      <div class="col-md-3">
                          <div class="form-group">
                          <input type="text" class="form-control form-control-sm">
                          </div>
                      </div>

                      <div class="col-md-2">
                        <label for="">{{ __('to') }}</label>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                          <input type="text" class="form-control form-control-sm">
                          </div>
                      </div>

                      <div class="col-md-2">
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Currency') }}</label>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                          <select id="currency" name="currency" class="e1 form-control form-control-sm ml-2">
                            <option selected disabled>{{ __('Currency') }}</option>
                          </select>
                          </div>
                      </div>
                       
                      <div class="col-md-4">
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                          Debit
                      </div>
                       
                      <div class="col-md-4">
                          Credit
                      </div>
                  </div>

                  
                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Gross Premium') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Accuisition Cost') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Net Premium') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Premium Portofolio') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Reinsurance Comm') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                          Transfer
                      </div>
                       
                      <div class="col-md-4">
                          Withdraw
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Paid Losses') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Loss Portfolio') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                          Debit
                      </div>
                       
                      <div class="col-md-4">
                          Credit
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Net Balance') }}</label>
                      </div>

                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                       
                      <div class="col-md-4">
                            <div class="form-group">
                            <input type="text" class="form-control form-control-sm">
                            </div>
                      </div>
                  </div>

                  
                  <hr>

                  <div class="row justify-content-center">
                      <div class="col-md-8">
                        <div class="row justify-content-center my-4">
                          <div class="col-md-4 text-center"><button type="submit" id="addslipinsured-btn"  class="btn btn-primary">Submit</button>
                          </div>
                          {{ Form::close() }}
                          <div class="col-md-4 text-center">
                            <button class="btn btn-primary">
                              <a href="{{ url('/treaty/porto/list') }}" style="color:white;">Cancel </a>
                            </button>
                          </div>
                        </div>
                      </div>
                  </div>

                <hr>
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