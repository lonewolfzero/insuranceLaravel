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
        {{ __('Transfer SOA') }}
      </div>

      <div class="card-body">
       
              @if(@$transferdata->id)
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
                            <input type="text" id="transferid" name="transferid" value="{{ @$transferdata->number_transfer?@$transferdata->number_transfer:$code_ms }}" class="form-control form-control-sm">
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
                          @if ($c->id == @$cedingsource)
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
                            @if ($c->id == @$cedingsource)
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
                        <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-2">
                                     <label for="">{{ __('Date Of Prod') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="dateofprod" name="dateofprod" class="form-control form-control-sm tanggal datepicker">
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                     <label for="">{{ __('To') }}</label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <input type="text" id="dateofto" name="dateofto" class="form-control form-control-sm datepicker">
                                      </div>
                                  </div>
                                </div>  
                        </div>
                  </div> 

                  <div class="row">
                    
                    <div class="col-md-8">
                        <div class="card-header bg-gray">
                          Proportional
                        </div>
                        <div class="card card-primary">
                           <div class="card-body">

                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="statementacc" id="statementacc" value="Statement Of Account">
                                <label class="form-check-label" for="exampleRadios1">
                                  Statement Of Account
                                </label>
                              </div>
                              
                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="profitcommission" id="profitcommission" value="Profit Commision">
                                <label class="form-check-label" for="exampleRadios1">
                                  Profit Commision
                                </label>
                              </div>

                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="lossparticipation" id="lossparticipation" value="Loss Participation">
                                <label class="form-check-label" for="exampleRadios1">
                                 Loss Participation
                                </label>
                              </div>
                              
                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="slidingscale" id="slidingscale" value="Sliding Scale">
                                <label class="form-check-label" for="exampleRadios1">
                                 Sliding Scale
                                </label>
                              </div>
                              

                          </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>
                  
                  </div>


                  <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <div class="card-header bg-gray">
                        </div>
                        <div class="card card-primary">
                           <div class="card-body">
                                 <div class="form-group">
                                      <button class="btn btn-primary btn-block ">
                                            {{__('Tranfer Data')}}
                                      </button>
                                </div>
                           </div>
                        </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-8">
                        <div class="card-header bg-gray">
                         Non Proportional
                        </div>
                        <div class="card card-primary">
                           <div class="card-body">

                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="minimumdeposit" id="minimumdeposit" value="Minimum Deposit">
                                <label class="form-check-label" for="exampleRadios1">
                                  Minimum Deposit
                                </label>
                              </div>
                              
                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="adjminimumdeposit" id="adjminimumdeposit" value="Adjusment Minimum Deposit">
                                <label class="form-check-label" for="exampleRadios1">
                                  Adjusment Minimum Deposit
                                </label>
                              </div>

                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="reinstatement" id="reinstatement" value="Reinstatement">
                                <label class="form-check-label" for="exampleRadios1">
                                 Reinstatement
                                </label>
                              </div>
                              
                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="adjreinstatement" id="adjreinstatement" value="Adjustment Reinstatement">
                                <label class="form-check-label" for="exampleRadios1">
                                 Adjusment Reinstatement
                                </label>
                              </div>

                              <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="profitsharing" id="profitsharing" value="Profit Sharing">
                                <label class="form-check-label" for="exampleRadios1">
                                Profit Sharing
                                </label>
                              </div>
                              

                          </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>
                  
                  </div>


                  <div class="col-md-12">
                      <div class="row justify-content-center">

                          <div class="row">   
                              <div class="col-md-6">
                                <div class="form-group">
                                      <button type="submit" onclick="storetransfersubmit2()" class="btn btn-primary btn-block ">
                                            {{__('Transfer Save')}}
                                      </button>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                      <button type="button" class="btn btn-primary btn-block ">
                                            {{__('Cancel')}}
                                      </button>
                                </div>
                              </div>
                          </div>
                              
                      </div>
                  </div>


                
                <hr>
      </div>

    </div>
  </div>
</div>

{{ Form::close() }}
          
          

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

function storetransfersubmit2()
{
  alert('masuk');
}

//$('#multi-file-upload-ajax').submit(function(e)
//{
    //e.preventDefault();

function storetransfersubmit()
{
    var number_transfer = $('#transferid').val();
    var broker_id = $('#brokerid').val();
    var ceding_id = $('#cedingid').val();
    var date_from = $('#dateofprod').val();
    var date_to = $('#dateofto').val();
    var statement_ofaccount = $('#statementacc').val();
    var profit_commission = $('#profitcommission').val();
    var loss_participation = $('#lossparticipation').val();
    var sliding_scale = $('#slidingscale').val();
    var minimum_deposit = $('#minimumdeposit').val();
    var adjusment_minimum_deposit = $('#adjminimumdeposit').val();
    var reinstatement = $('#reinstatement').val();
    var adjustment_reinstatement = $('#adjreinstatement').val();
    var profit_sharing = $('#profitsharing').val();

    var token2 = $('input[name=_token]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
          url:"{{url('treaty/transfer/store')}}",
          type:"POST",
          data:{
            number_transfer:number_transfer,
            broker_id:broker_id,
            ceding_id:ceding_id,
            date_from:date_from,
            date_to:date_to,
            statement_ofaccount:statement_ofaccount
            profit_commission:profit_commission,
            loss_participation:loss_participation,
            sliding_scale:sliding_scale,
            minimum_deposit:minimum_deposit,
            adjusment_minimum_deposit:adjusment_minimum_deposit,
            reinstatement:reinstatement,
            adjustment_reinstatement:adjustment_reinstatement,
            profit_sharing:profit_sharing,
            _token:token2
          },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
              console.log(response);
              if(response.success==true)
              {
                swal("Success!", "Transfer Form Entry Insert Success", "success")
                console.log(response)
              }
              else
              {
                swal("Error!", "Transfer Form Entry Insert Error : Insert Error");
              }
          
          },
          error: function (request, status, error) {
                  //alert(request.responseText);
                  swal("Error!", "Transfer Form Entry Insert Error : " + request.responseText, "Insert Error");
              }
          });

}

</script>

@endsection