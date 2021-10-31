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
            
            <div class="card-header bg-gray">
              Detail COB
            </div>
            
            <hr>
              @include('crm.transaction.treaty.templates.filter.nonpropmasterentry')
            <hr>
              @include('crm.transaction.treaty.templates.filter.nonpropsubmasterentry')
            <hr>
              @include('crm.transaction.treaty.templates.filter.nonpropgroupcobentry2')
            <hr>
              @include('crm.transaction.treaty.templates.filter.nonproplayerentry2')
            <hr>

            <div class="form-group">

                      <div class="row">
                      <div class="col-md-2">
                          <label for="">{{ __('Detail COB ') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <select class="form-control form-control-sm">
                                  <option> Detail COB LIST</option>
                                  <option> Detail COB LIST</option>
                                </select>
                              </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{ __('OGRPI %') }}</label>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-sm amount"> &nbsp;&nbsp; %
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-2">
                            <label for="">{{__('Business Source')}}</label>
                          </div>

                          <div class="col-md-4 col-offsets-4">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <br>
                              <div class="form-check form-check-inline">
                                <div class="form-check">
                                  <input type="radio" class="form-check-input position-static" name="flag_overseas" id="local" value="0" 
                                  {{ @$insureddata->flag_overseas === 0 ? "checked" : "" }}
                                  > <label for="local">{{__('Local')}}</label>
                                </div>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input position-static" name="flag_overseas" id="overseas_checkbox" value="1" {{ @$insureddata->flag_overseas === 1 ? "checked" : "" }}> <label for="overseas_checkbox" >Overseas</label>
                                </div>  
                              </div>  
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="">{{__('Business Type')}}</label>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" name="business_id" id="business_id" required>
                                <option value selected disabled>Pilih</option>
                                @if (!empty($insureddata))
                                  @foreach ($business_type as $bt)
                                    @if ($insureddata->business_id == $bt->id)
                                      <option value="{{ $bt->id }}" selected>{{ $bt->name }}</option>
                                    @else
                                      <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                    @endif
                                  @endforeach
                                @endif
                              </select>
                            </div>
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


                      <div class="form-group">
                          
                            @include('crm.transaction.treaty.templates.filter.table', ["headers"=>['No', 'Due Date',
                            'Rep Date', 'PCT (%)', 'Gross', 'Broker', 'Amount']])
                            
                      </div>

                      <div class="row">
                        <div class="col-md-6 form-group d-flex">
                        </div>
                        <label for="" class="col-1">{{ __('Total Share %') }}</label>
                        <div class="col-md-5 form-group d-flex">
                            <input type="text" name="periodfrom" id="periodfrom" class="form-control form-control-sm ml-2" autocomplete="off">
                        </div>
                      </div>
                          
                            
                      </div>
              <hr>

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