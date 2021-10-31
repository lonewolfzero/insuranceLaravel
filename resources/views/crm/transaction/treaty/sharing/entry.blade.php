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
        {{ __('Profit Sharing Entry') }}
      </div>

      <div class="card-body">
       
              @if(@$sharingdata->id)
              <form id="multi-file-upload-ajax" method="POST" autocomplete="off"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @else
              <form id="multi-file-upload-ajax" method="POST" autocomplete="off"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @endif   
                  
                  <div class="row">
                    <div class="col-md-4">
                        <label for="">{{__('ID')}}</label>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="userid2" id="userid2" value="{{ Auth::user()->id }}">
                            <input type="text" id="sharingid" name="sharingid" value="{{ @$sharingdata->number?@$sharingdata->number:$code_ms }}" class="form-control form-control-sm">
                        </div>
                    </div>          
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                    <label for="">{{ __('Ceding/Broker') }}</label>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <select id="brokerid" name="brokerid" class="e1 form-control form-control-sm ml-2">
                          <option selected disabled>{{ __('Ceding/Broker') }}</option>
                          @foreach ($ceding as $c)
                          @if ($c->id == @$sharingdata->broker_id)
                          <option value="{{ $c->id }}" selected>{{ $c->name }}
                            @else
                          <option value="{{ $c->id }}">{{ $c->name }}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <label for="">{{ __('Ceding Company') }}</label>
                      </div>
                      <div class="col-md-8">
                          <div class="form-group">
                          <select id="cedingid" name="cedingid" class="e1 form-control form-control-sm ml-2">
                            <option selected disabled>{{ __('Ceding Company') }}</option>
                            @foreach ($ceding as $c)
                            @if ($c->id == @$sharingdata->ceding_id )
                            <option value="{{ $c->id }}" selected>{{ $c->name }}
                              @else
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endif
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="row">
                            <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ __('Doc Date') }}</label>
                                            <input type="text" id="docdate" name="docdate"   value="{{ @$sharingdata->doc_date }}" class="form-control form-control-sm tanggal datepicker">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">{{ __('U/W Year') }}</label>
                                            <input type="text"  id="uwyear" name="uwyear"   value="{{ @$sharingdata->uwyear }}" class="form-control form-control-sm">
                                          </div>
                                      </div>
                                    </div>  
                            </div>
                      </div> 

                      <div class="row">
                            <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ __('Date Production') }}</label>
                                            <input type="text"  id="dateproduction" name="dateproduction"   value="{{ @$sharingdata->date_production }}"  class="form-control form-control-sm tanggal datepicker">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="">{{ __('Acc Year') }}</label>
                                            <input type="text"  id="accyear" name="accyear"   value="{{ @$sharingdata->acc_year }}" class="form-control form-control-sm">
                                          </div>
                                      </div>
                                    </div>  
                            </div>
                      </div> 

                      <div class="row">
                        
                        <div class="col-md-2">
                          <label for="">{{ __('Doc Number') }}</label>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                              
                            <select id="docnumber" name="docnumber" class="e1 form-control form-control-sm ml-2">
                              <option selected disabled>{{ __('Doc Number') }}</option>
                              @foreach ($ceding as $c)
                              @if ($c->id == @$sharingdata->doc_number)
                              <option value="{{ $c->id }}" selected>{{ $c->name }}
                                @else
                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endif
                              @endforeach
                            </select>
                            </div>
                          </div>

                      </div>

                      <div class="row">
                        
                        <div class="col-md-2">
                          <label for="">{{ __('Currency') }}</label>
                        </div>

                         <div class="col-md-10">
                            <div class="form-group">
                            <select id="currency" name="currency" class="e1 form-control form-control-sm ml-2">
                              <option selected disabled>{{ __('Currency') }}</option>
                              @foreach ($currencies as $c)
                                @if ($c->id == @$sharingdata->currency_id)
                                <option value="{{ $c->id }}" selected>{{ $c->symbol_name }}
                                  @else
                                <option value="{{ $c->id }}">{{ $c->symbol_name }}</option>
                                @endif
                              @endforeach
                            </select>
                            </div>
                          </div>
                          
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-2">
                                    <label for="">{{ __('Remarks') }}</label>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" id="remarks" name="remarks"    value="{{ @$sharingdata->remarks }}"  class="form-control form-control-sm">
                                    </div>
                                  </div>
                                </div>  
                          </div>
                      </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card-header bg-gray">
                          Profit Sharing
                        </div>
                        <div class="card card-primary">
                           <div class="card-body">
                              
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-2">
                                          <label for="">{{ __('Share %') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                              <input type="text" id="share" name="share"   value="{{ @$sharingdata->share }}" class="form-control form-control-sm">
                                          </div>
                                        </div>
                                      </div>  
                                   </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-2">
                                          <label for="">{{ __('Mindep') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                              <input type="text" id="mindep" name="mindep"   value="{{ @$sharingdata->mindep }}" class="form-control form-control-sm money">
                                          </div>
                                        </div>
                                      </div>  
                                   </div>
                              </div>

                              
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-md-2">
                                          <label for="">{{ __('Nilai') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                              <input type="text" id="nilai" name="nilai"   value="{{ @$sharingdata->nilai }}" class="form-control form-control-sm money">
                                          </div>
                                        </div>
                                      </div>  
                                   </div>
                              </div>

                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                            <div class="row justify-content-center my-4">
                              <div class="col-md-4 text-center"><button type="submit" id="addslipinsured-btn"  class="btn btn-primary">Submit</button>
                              </div>
                            
                              <div class="col-md-4 text-center">
                                <button class="btn btn-primary">
                                  <a href="{{ url('/treaty/sharing/list') }}" style="color:white;">Cancel </a>
                                </button>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                  </div>

                {{ Form::close() }}
          
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

<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1100 !important;
        background: rgba(255,255,255,0.8) url("{{asset('loader.gif')}}") center no-repeat;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>


  <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/treaty/prop/index.js') }}"></script>
<script src="{{ asset('/js/treaty/prop/entry.js') }}"></script>

<script type='text/javascript'>
    
$(".money").mask("#,##0", {
    reverse: true,
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});

$(".percentage").mask("#P99", {
    reverse: true,
    translation: {
        P: { pattern: /\./, optional: true },
    },
    onChange: function (value, e) {
        e.target.value = value
            .replace(/(?!^)-/g, "")
            .replace(/^,/, "")
            .replace(/^-,/, "-");
    },
});


$('#multi-file-upload-ajax').submit(function(e){
       e.preventDefault();

    var number = $('#sharingid').val();
    var broker_id = $('#brokerid').val();
    var ceding_id = $('#cedingid').val();
    var doc_date = $('#docdate').val();
    var uwyear = $('#uwyear').val();
    var date_production = $('#dateproduction').val();
    var acc_year = $('#accyear').val();
    var currency_id = $('#currency').val();
    var doc_number = $('#docnumber').val();
    var remarks = $('#remarks').val();
    var share = $('#share').val();
    var mindep = $('#mindep').val();
    var nilai = $('#nilai').val();
    var token2 = $('input[name=_token]').val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
          url:"{{url('treaty/sharing/store')}}",
          type:"POST",
          data:{
            number:number,
            broker_id:broker_id,
            ceding_id:ceding_id,
            doc_date:doc_date,
            uwyear:uwyear,
            date_production:date_production,
            acc_year:acc_year,
            currency_id:currency_id,
            doc_number:doc_number,
            remarks:remarks,
            share:share,
            mindep:mindep,
            nilai:nilai,
            _token:token2
          },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              console.log(response);
              if(response.success==true)
              {
                swal("Success!", "Sharing Profit Entry Insert Success", "success")
                console.log(response)
              }
              else
              {
                swal("Error!", "Sharing Profit Entry Insert Error : Insert Error");
              }
          
          },
          error: function (request, status, error) {
                  //alert(request.responseText);
                  swal("Error!", "Sharing Profit Entry Insert Error : " + request.responseText, "Insert Error");
              }
          });



    
});

</script>

@endsection