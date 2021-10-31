@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<script type="text/javascript">
    
    $('input.amount').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
            console.log(event.which)
            console.log($(this).val())
                // format number
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });

    $('input.tanggal').mask("##/##/####",{
        mask: "1/2/y", 
        placeholder: "dd/mm/yyyy", 
        leapday: "-02-29", 
        separator: "/", 
        alias: "dd/mm/yyyy"
      });  


    $(".money").click(function() {
        var inputLength = $(".money").val().length;
        setCaretToPos($(".money")[0], inputLength)
    });


    $(".uang").keyup(function() {
        $('.uang').mask("#,##0.00", {reverse: true});
        console.log($('#slipvbroker').val())

    });

</script>


<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('Accumulation Control Entry') }}
      </div>

      <div class="card-body">
              <form id="multi-file-upload-ajax" method="POST" autocomplete="off"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              
                    <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                       
                    </div>
                    <div class="col-md-4">
                      <label for="">{{__('Date Prod')}}</label>  
                      <div class="form-group">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="userid2" id="userid2" value="{{ Auth::user()->id }}">
                            <input type="text"  id="dateprod"  name="dateprod"  class="form-control form-control-sm" value="{{ date('d/m/Y') }}" readonly="true">
                        </div>
                    </div>          
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                       
                    </div>
                    <div class="col-md-4">
                      <label for="">{{__('User Entry')}}</label>
                      <div class="form-group">
                            <input type="text" id="userid"  name="userid"  class="form-control form-control-sm" value="{{ Auth::user()->name }}" readonly="true">
                        </div>
                    </div>          
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                        <label for="">{{__('ID')}}</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" id="formid"  name="formid" readonly="true" value="{{ $code_ms }}" class="form-control form-control-sm">
                        </div>
                    </div>        
                    
                    <div class="col-md-4">
                    </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Type') }}</label>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <select id="type" name="type" class="e1 form-control form-control-sm ml-2">
                            <option disabled selected>{{ __('Type') }}</option>
                            <option value="1">{{ __('Flood') }}</option>
                            <option value="2">{{ __('EarthQuake (4.2)') }}</option>
                            <option value="3">{{ __('RSMD (4.1)') }}</option>
                           
                          </select>
                      </div>
                       
                      <div class="col-md-4">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Sub Type') }}</label>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <select id="subtype" name="subtype" class="e1 form-control form-control-sm ml-2">
                            <option disabled>{{ __('Sub Type') }}</option>
                            <option value="1" selected>{{ __('Agricultural') }}</option>
                            <option value="2">{{ __('Commercial') }}</option>
                            <option value="3">{{ __('Industrial') }}</option>
                            <option value="4">{{ __('Residential') }}</option>
                            <option value="5">{{ __('All') }}</option>
                          
                          </select>
                      </div>
                       
                      <div class="col-md-4">
                      </div>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-md-2">
                        <label for="">{{__('Position as at')}}</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" id="position" value="" name="position" class="form-control form-control-sm datepicker">
                        </div>
                    </div>        
                    
                    <div class="col-md-4">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-2">
                        <label for="">{{__('U/W Year')}}</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" id="uwyear"  value="" name="uwyear" value="{{ date('Y') }}" class="form-control form-control-sm">
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
                          <select id="cedingbroker" name="cedingbroker" class="e1 form-control form-control-sm ml-2">
                              <option selected>{{ __('Ceding Company') }}</option>
                              @foreach ($ceding as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                          </select>
                      </div>
                       
                      <div class="col-md-4">
                      </div>
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
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-md-4">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Currency') }}</label>
                      </div>
                      <div class="col-md-6 form-group d-flex">
                        <select id="currency" name="currency" class="e1 form-control form-control-sm ml-2">
                          <option selected disabled>{{ __('Currency') }}</option>
                          @foreach ($currencies as $c)
                                <option value="{{ $c->id }}">{{ $c->code }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('COB') }}</label>
                      </div>
                      <div class="col-md-6 form-group d-flex">
                        <select id="cedingcob" name="cedingcob" class="e1 form-control form-control-sm ml-2">
                          <option selected disabled>{{ __('COB') }}</option>
                          @foreach ($cob as $c)
                                <option value="{{ $c->id }}">{{ $c->description }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('KOC') }}</label>
                      </div>
                   
                      <div class="col-md-6 form-group d-flex">
                        <select id="cedingkoc" name="cedingkoc" class="e1 form-control form-control-sm ml-2">
                          <option selected disabled>{{ __('KOC') }}</option>
                          @foreach ($koc as $c)
                                <option value="{{ $c->id }}">{{ $c->description }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-2">
                        <label for="">{{ __('Zone Number') }}</label>
                      </div>
                      <div class="col-md-6 form-group d-flex">
                        <select id="zonenumber" name="zonenumber" class="e1 form-control form-control-sm ml-2">
                          @foreach ($earthquake as $c)
                               <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>


                  <div class="row">
                    <div class="col-md-2">
                        <label for="">{{__('State Code')}}</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">

                            <input type="text" id="statecode" name="statecode" value="" class="form-control form-control-sm amount">
                        </div>
                    </div>        
                    
                    <div class="col-md-4">
                    </div>
                  </div>


                  <div class="row">
                    
                    <div class="col-md-8">
                        <div class="card-header bg-gray">
                          Number And Amount
                        </div>
                        <div class="card card-primary">
                           <div class="card-body">

                            <div class="row">
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-3">
                                      <label for="">{{__('Number of Risk')}}</label>
                                </div>        
                                
                                <div class="col-md-6">
                                      <label for="">{{__('Amount')}}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Buildings')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="buildingpercentage" name="buildingpercentage"  value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="buildingamount" name="buildingamount"   value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Machineries')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="machineriespercentage" name="machineriespercentage"  value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="machineriesamount" name="machineriesamount"  value="0"  class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Stocks')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="stokspercentage" name="stokspercentage"  value="0"  class="money form-control form-control-sm">
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="stoksamount" name="stoksamount"  value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Loss Of Profit/Consequential Loss')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="losspercentage" name="losspercentage"   value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="lossamount" name="lossamount"   value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Contents / House Holder ')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text"  id="contentspercentage" name="contentspercentage" value="0"  class="money form-control form-control-sm">
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"  id="contentsamount" name="contentsamount"  value="0"  class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Total')}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="totalpercentage" name="totalpercentage"  value="0" class="money form-control form-control-sm" >
                                    </div>
                                </div>        
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="totalamount" name="totalamount"  value="0" class="money form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                              
                          </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>
                  
                  </div>

                  <div class="row justify-content-center">
                      <div class="col-md-8">
                        <div class="row justify-content-center my-4">
                          <div class="col-md-4 text-center"><button type="submit" id="addslipinsured-btn"  class="btn btn-primary">Submit</button>
                          </div>
                          {{ Form::close() }}
                          <div class="col-md-4 text-center">
                            <button class="btn btn-primary">
                              <a href="{{ url('/treaty/acc/list') }}" style="color:white;">Cancel </a>
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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


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

    $('#buildingpercentage').keyup(function()
    {
        
        var buildingpercentagedata = $('#buildingpercentage').val();
        var buildingpercentagedata = buildingpercentagedata.replace(/,/g, "");
        //var buildingpercentagedata = buildingpercentagedata.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var machineriespercentagedata = $('#machineriespercentage').val();
        var machineriespercentagedata = machineriespercentagedata.replace(/,/g, "");
        
        var stokspercentagedata = $('#stokspercentage').val();
        var stokspercentagedata = stokspercentagedata.replace(/,/g, "");

        var contentspercentagedata = $('#contentspercentage').val();
        var contentspercentagedata = contentspercentagedata.replace(/,/g, "");

        var losspercentagedata = $('#losspercentage').val();
        var losspercentagedata = losspercentagedata.replace(/,/g, "");

        var totalpersen=parseFloat(buildingpercentagedata)+parseFloat(machineriespercentagedata)+parseFloat(stokspercentagedata)+parseFloat(contentspercentagedata)+parseFloat(losspercentagedata);
        var totalrealpersen = totalpersen.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(totalrealpersen)
        {
          $('#totalpercentage').val(totalrealpersen);
        }
    });


    $('#machineriespercentage').keyup(function()
    {
        
        var buildingpercentagedata = $('#buildingpercentage').val();
        var buildingpercentagedata = buildingpercentagedata.replace(/,/g, "");
        //var buildingpercentagedata = buildingpercentagedata.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var machineriespercentagedata = $('#machineriespercentage').val();
        var machineriespercentagedata = machineriespercentagedata.replace(/,/g, "");
        
        var stokspercentagedata = $('#stokspercentage').val();
        var stokspercentagedata = stokspercentagedata.replace(/,/g, "");

        var contentspercentagedata = $('#contentspercentage').val();
        var contentspercentagedata = contentspercentagedata.replace(/,/g, "");

        var losspercentagedata = $('#losspercentage').val();
        var losspercentagedata = losspercentagedata.replace(/,/g, "");

        var totalpersen=parseFloat(buildingpercentagedata)+parseFloat(machineriespercentagedata)+parseFloat(stokspercentagedata)+parseFloat(contentspercentagedata)+parseFloat(losspercentagedata);
        var totalrealpersen = totalpersen.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(totalrealpersen)
        {
          $('#totalpercentage').val(totalrealpersen);
        }
    });


    $('#stokspercentage').keyup(function()
    {
        
        var buildingpercentagedata = $('#buildingpercentage').val();
        var buildingpercentagedata = buildingpercentagedata.replace(/,/g, "");
        //var buildingpercentagedata = buildingpercentagedata.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var machineriespercentagedata = $('#machineriespercentage').val();
        var machineriespercentagedata = machineriespercentagedata.replace(/,/g, "");
        
        var stokspercentagedata = $('#stokspercentage').val();
        var stokspercentagedata = stokspercentagedata.replace(/,/g, "");

        var contentspercentagedata = $('#contentspercentage').val();
        var contentspercentagedata = contentspercentagedata.replace(/,/g, "");

        var losspercentagedata = $('#losspercentage').val();
        var losspercentagedata = losspercentagedata.replace(/,/g, "");

        var totalpersen=parseFloat(buildingpercentagedata)+parseFloat(machineriespercentagedata)+parseFloat(stokspercentagedata)+parseFloat(contentspercentagedata)+parseFloat(losspercentagedata);
        var totalrealpersen = totalpersen.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(totalrealpersen)
        {
          $('#totalpercentage').val(totalrealpersen);
        }
    });


    $('#contentspercentage').keyup(function()
    {
        
        var buildingpercentagedata = $('#buildingpercentage').val();
        var buildingpercentagedata = buildingpercentagedata.replace(/,/g, "");
        //var buildingpercentagedata = buildingpercentagedata.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var machineriespercentagedata = $('#machineriespercentage').val();
        var machineriespercentagedata = machineriespercentagedata.replace(/,/g, "");
        
        var stokspercentagedata = $('#stokspercentage').val();
        var stokspercentagedata = stokspercentagedata.replace(/,/g, "");

        var contentspercentagedata = $('#contentspercentage').val();
        var contentspercentagedata = contentspercentagedata.replace(/,/g, "");

        var losspercentagedata = $('#losspercentage').val();
        var losspercentagedata = losspercentagedata.replace(/,/g, "");

        var totalpersen=parseFloat(buildingpercentagedata)+parseFloat(machineriespercentagedata)+parseFloat(stokspercentagedata)+parseFloat(contentspercentagedata)+parseFloat(losspercentagedata);
        var totalrealpersen = totalpersen.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(totalrealpersen)
        {
          $('#totalpercentage').val(totalrealpersen);
        }
    });

    

    $('#losspercentage').keyup(function()
    {
        
        var buildingpercentagedata = $('#buildingpercentage').val();
        var buildingpercentagedata = buildingpercentagedata.replace(/,/g, "");
        //var buildingpercentagedata = buildingpercentagedata.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var machineriespercentagedata = $('#machineriespercentage').val();
        var machineriespercentagedata = machineriespercentagedata.replace(/,/g, "");
        
        var stokspercentagedata = $('#stokspercentage').val();
        var stokspercentagedata = stokspercentagedata.replace(/,/g, "");

        var contentspercentagedata = $('#contentspercentage').val();
        var contentspercentagedata = contentspercentagedata.replace(/,/g, "");

        var losspercentagedata = $('#losspercentage').val();
        var losspercentagedata = losspercentagedata.replace(/,/g, "");

        var totalpersen=parseFloat(buildingpercentagedata)+parseFloat(machineriespercentagedata)+parseFloat(stokspercentagedata)+parseFloat(contentspercentagedata)+parseFloat(losspercentagedata);
        var totalrealpersen = totalpersen.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(totalrealpersen)
        {
          $('#totalpercentage').val(totalrealpersen);
        }
    });


    
    

    $('#buildingamount').keyup(function(){
        
        var buildingamountdata = $('#buildingamount').val();
        var buildingamountdata = buildingamountdata.replace(/,/g, "");

        var machineriesamountdata = $('#machineriesamount').val();
        var machineriesamountdata = machineriesamountdata.replace(/,/g, "");
        
        var stoksamountdata = $('#stoksamount').val();
        var stoksamountdata = stoksamountdata.replace(/,/g, "");
        
        var contentsamountdata = $('#contentsamount').val();
        var contentsamountdata = contentsamountdata.replace(/,/g, "");
        
        var lossamountdata = $('#lossamount').val();
        var lossamountdata = lossamountdata.replace(/,/g, "");

        var totalamount=parseFloat(buildingamountdata)+parseFloat(machineriesamountdata)+parseFloat(stoksamountdata)+parseFloat(contentsamountdata)+parseFloat(lossamountdata);
        var totalrealamount = totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        if(totalrealamount)
        {
         $('#totalamount').val(totalrealamount);
        }

    });

    $('#machineriesamount').keyup(function(){
        
        var buildingamountdata = $('#buildingamount').val();
        var buildingamountdata = buildingamountdata.replace(/,/g, "");

        var machineriesamountdata = $('#machineriesamount').val();
        var machineriesamountdata = machineriesamountdata.replace(/,/g, "");
        
        var stoksamountdata = $('#stoksamount').val();
        var stoksamountdata = stoksamountdata.replace(/,/g, "");
        
        var contentsamountdata = $('#contentsamount').val();
        var contentsamountdata = contentsamountdata.replace(/,/g, "");
        
        var lossamountdata = $('#lossamount').val();
        var lossamountdata = lossamountdata.replace(/,/g, "");

        var totalamount=parseFloat(buildingamountdata)+parseFloat(machineriesamountdata)+parseFloat(stoksamountdata)+parseFloat(contentsamountdata)+parseFloat(lossamountdata);
        var totalrealamount = totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        if(totalrealamount)
        {
         $('#totalamount').val(totalrealamount);
        }

    });


    $('#stoksamount').keyup(function(){
        
        var buildingamountdata = $('#buildingamount').val();
        var buildingamountdata = buildingamountdata.replace(/,/g, "");

        var machineriesamountdata = $('#machineriesamount').val();
        var machineriesamountdata = machineriesamountdata.replace(/,/g, "");
        
        var stoksamountdata = $('#stoksamount').val();
        var stoksamountdata = stoksamountdata.replace(/,/g, "");
        
        var contentsamountdata = $('#contentsamount').val();
        var contentsamountdata = contentsamountdata.replace(/,/g, "");
        
        var lossamountdata = $('#lossamount').val();
        var lossamountdata = lossamountdata.replace(/,/g, "");

        var totalamount=parseFloat(buildingamountdata)+parseFloat(machineriesamountdata)+parseFloat(stoksamountdata)+parseFloat(contentsamountdata)+parseFloat(lossamountdata);
        var totalrealamount = totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        if(totalrealamount)
        {
         $('#totalamount').val(totalrealamount);
        }

    });


    $('#contentsamount').keyup(function(){
        
        var buildingamountdata = $('#buildingamount').val();
        var buildingamountdata = buildingamountdata.replace(/,/g, "");

        var machineriesamountdata = $('#machineriesamount').val();
        var machineriesamountdata = machineriesamountdata.replace(/,/g, "");
        
        var stoksamountdata = $('#stoksamount').val();
        var stoksamountdata = stoksamountdata.replace(/,/g, "");
        
        var contentsamountdata = $('#contentsamount').val();
        var contentsamountdata = contentsamountdata.replace(/,/g, "");
        
        var lossamountdata = $('#lossamount').val();
        var lossamountdata = lossamountdata.replace(/,/g, "");

        var totalamount=parseFloat(buildingamountdata)+parseFloat(machineriesamountdata)+parseFloat(stoksamountdata)+parseFloat(contentsamountdata)+parseFloat(lossamountdata);
        var totalrealamount = totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        if(totalrealamount)
        {
         $('#totalamount').val(totalrealamount);
        }

    });

    
    $('#lossamount').keyup(function(){
        
        var buildingamountdata = $('#buildingamount').val();
        var buildingamountdata = buildingamountdata.replace(/,/g, "");

        var machineriesamountdata = $('#machineriesamount').val();
        var machineriesamountdata = machineriesamountdata.replace(/,/g, "");
        
        var stoksamountdata = $('#stoksamount').val();
        var stoksamountdata = stoksamountdata.replace(/,/g, "");
        
        var contentsamountdata = $('#contentsamount').val();
        var contentsamountdata = contentsamountdata.replace(/,/g, "");
        
        var lossamountdata = $('#lossamount').val();
        var lossamountdata = lossamountdata.replace(/,/g, "");

        var totalamount=parseFloat(buildingamountdata)+parseFloat(machineriesamountdata)+parseFloat(stoksamountdata)+parseFloat(contentsamountdata)+parseFloat(lossamountdata);
        var totalrealamount = totalamount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


        if(totalrealamount)
        {
         $('#totalamount').val(totalrealamount);
        }

    });
    


    $('#multi-file-upload-ajax').submit(function(e){
       e.preventDefault();

       var dateprod = $('#dateprod').val();
       var userid = $('#userid2').val();
       var formid = $('#formid').val();
       var type = $('#type').val();
       var subtype = $('#subtype').val();
       var position = $('#position').val();
       var uwyear = $('#uwyear').val();
       var cedingbroker = $('#cedingbroker').val();
       var cedingsource = $('#cedingsource').val();
       var currency = $('#currency').val();
       var cedingcob = $('#cedingcob').val();
       var cedingkoc = $('#cedingkoc').val();
       var zonenumber = $('#zonenumber').val();
       var statecode = $('#statecode').val();
       //var statecode = 0;
      
      
       var buildingpercentage = $('#buildingpercentage').val();
       var buildingamount = $('#buildingamount').val();
       
       var machineriespercentage = $('#machineriespercentage').val();
       var machineriesamount = $('#machineriesamount').val();

       var stokspercentage = $('#stokspercentage').val();
       var stoksamount = $('#stoksamount').val();

       var losspercentage = $('#losspercentage').val();
       var lossamount = $('#lossamount').val();

       var contentspercentage = $('#contentspercentage').val();
       var contentsamount = $('#contentsamount').val();

       var totalpercentage = $('#totalpercentage').val();
       var totalamount = $('#totalamount').val();

       var token2 = $('input[name=_token]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              url:"{{url('treaty/acc/store')}}",
              type:"POST",
              data:{
                dateprod:dateprod,
                userid:userid,
                formid:formid,
                type:type,
                subtype:subtype,
                position:position,
                uwyear:uwyear,
                cedingbroker:cedingbroker,
                cedingsource:cedingsource,
                currency:currency,
                cedingcob:cedingcob,
                cedingkoc:cedingkoc,
                zonenumber:zonenumber,
                statecode:statecode,
                buildingpercentage:buildingpercentage,
                buildingamount:buildingamount,
                machineriespercentage:machineriespercentage,
                machineriesamount:machineriesamount,
                stokspercentage:stokspercentage,
                stoksamount:stoksamount,
                losspercentage:losspercentage,
                lossamount:lossamount,
                contentspercentage:contentspercentage,
                contentsamount:contentsamount,
                totalpercentage:totalpercentage,
                totalamount:totalamount,
                _token:token2
              },
              beforeSend: function() { $("body").addClass("loading");  },
              complete: function() {  $("body").removeClass("loading"); },
              success:function(response)
              {

                  console.log(response);
                  if(response.success==true)
                  {
                    swal("Success!", "Accumulation Entry Insert Success", "success")
                    console.log(response)
                  }
                  else
                  {
                    swal("Error!", "Accumulation Entry Insert Error : Insert Error");
                  }
              
              },
              error: function (request, status, error) {
                      //alert(request.responseText);
                      swal("Error!", "Accumulation Entry Insert Error : " + request.responseText, "Insert Error");
                  }
              });



       
    });

</script>

@endsection