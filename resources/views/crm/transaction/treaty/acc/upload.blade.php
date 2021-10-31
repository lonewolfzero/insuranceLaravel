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
        {{ __('Accumulation Control Upload') }}
      </div>

      <div class="card-body">

        @if(@@$accu->id)
        <form id="multi-file-upload-ajax" method="POST" autocomplete="off" action="javascript:void(0)"
          accept-charset="utf-8" enctype="multipart/form-data">
          @else
          <form id="multi-file-upload-ajax" method="POST" autocomplete="off" action="javascript:void(0)"
            accept-charset="utf-8" enctype="multipart/form-data">
            @endif

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
                  <input type="hidden" id="formid" name="formid" readonly="true"
                    value="{{ @$accu->number?@$accu->number:$code_ms }}" class="form-control form-control-sm">
                  <input type="text" id="dateprod" name="dateprod" class="form-control form-control-sm"
                    value="{{ date('d/m/Y') }}" readonly="true">
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
                  <input type="text" id="userid" name="userid" class="form-control form-control-sm"
                    value="{{ Auth::user()->name }}" readonly="true">
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-2">
                <label for="">{{__('Position At')}}</label>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" id="position" name="position" value="{{ @@$accu->position }}"
                    class="form-control form-control-sm datepicker">
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
                  <input type="text" id="uwyear" name="uwyear" value="{{ @@$accu->uw?@$accu->uw:date('Y') }}"
                    class="form-control form-control-sm">
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
                    <option selected disabled>{{ __('Ceding Company') }}</option>
                    @foreach ($ceding as $c)
                    @if(@$accu->broker_id == $c->id)
                    <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                    @else
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endif
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

                    @foreach ($ceding2 as $c)
                    @if(@$accu->ceding_id == $c->id)
                    <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                    @else
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <label for="">{{ __('Type') }}</label>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select id="type" name="type" class="e1 form-control form-control-sm ml-2">
                    <option disabled>{{ __('Type') }}</option>
                    @if(@$accu->type == 1 && !empty(@$accu->type))
                    <option value="1" selected>{{ __('Flood') }}</option>
                    @else
                    <option value="1">{{ __('Flood') }}</option>
                    @endif

                    @if(@$accu->type == 2 && !empty(@$accu->type))
                    <option value="2" selected>{{ __('EarthQuake (4.2)') }}</option>
                    @else
                    <option value="2">{{ __('EarthQuake (4.2)') }}</option>
                    @endif

                    @if(@$accu->type == 3 && !empty(@$accu->type))
                    <option value="3" selected>{{ __('RSMD (4.1)') }}</option>
                    @else
                    <option value="3">{{ __('RSMD (4.1)') }}</option>
                    @endif

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

                    @if(@$accu->subtype == 1 && !empty(@$accu->subtype))
                    <option value="1" selected>{{ __('Agricultural') }}</option>
                    @else
                    <option value="1">{{ __('Agricultural') }}</option>
                    @endif


                    @if(@$accu->subtype == 2 && !empty(@$accu->subtype))
                    <option value="2" selected>{{ __('Commercial') }}</option>
                    @else
                    <option value="2">{{ __('Commercial') }}</option>
                    @endif



                    @if(@$accu->subtype == 3 && !empty(@$accu->subtype))
                    <option value="3" selected>{{ __('Industrial') }}</option>
                    @else
                    <option value="3">{{ __('Industrial') }}</option>
                    @endif


                    @if(@$accu->subtype == 4 && !empty(@$accu->subtype))
                    <option value="4" selected>{{ __('Residential') }}</option>
                    @else
                    <option value="4">{{ __('Residential') }}</option>
                    @endif


                    @if(@$accu->subtype == 5 && !empty(@$accu->subtype))
                    <option value="5" selected>{{ __('All') }}</option>
                    @else
                    <option value="5">{{ __('All') }}</option>
                    @endif


                  </select>
                </div>

                <div class="col-md-4">
                </div>
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
                  @if(@$accu->cob_id == $c->id)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}</option>
                  @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
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
                  @if(@$accu->koc_id == $c->id)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}</option>
                  @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
              </div>
            </div>


            <div class="row">
              <div class="col-md-2">
                <label for="">{{ __('Treaty Of Summary') }}</label>
              </div>
              <div class="col-md-6 form-group d-flex">
                <select id="treatydata" name="treatydata" class="e1 form-control form-control-sm ml-2">
                  <option value="" selected disabled>Treaty Of Summary</option>
                  @foreach ($props as $prop)
                  <option value="{{ $prop->id }}" class="options" @if(@$accu->teratysummary==$prop->id) selected
                    @endif>{{ $prop->id_detail_contract }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <label for="">{{__('Date Of Doc')}}</label>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" id="dateofdoc" name="dateofdoc" value="{{ @@$accu->dateofdoc }}"
                    class="form-control form-control-sm datepicker">
                </div>
              </div>

              <div class="col-md-4">
              </div>
            </div>



            <div class="row">
              <div class="col-md-2">
                <label for="">{{__('Document')}}</label>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="file" name="files[]" id="attachment" multiple class="form-control form-control-sm">
                </div>
                <?php
                         //print_r($datafile);
                         if(!empty($datafile))
                         {
                          foreach($datafile as $filedata)
                          {
                            echo "<li><div class='control-group input-group' id='control-group2' style='margin-top:10px'><a href='".asset("files")."/".$filedata->filename."'>".$filedata->filename."</a></div></li>";
                          
                          }
                        }
                        ?>
              </div>

              <div class="col-md-4">
              </div>
            </div>


            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="row justify-content-center my-4">
                  <div class="col-md-4 text-center"><button type="submit" id="addslipinsured-btn"
                      class="btn btn-primary">Submit</button>
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

  .swal-wide {
    width: 850px !important;
  }
</style>


<style>
  .overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1100 !important;
    background: rgba(255, 255, 255, 0.8) url("{{asset('loader.gif')}}") center no-repeat;
  }

  /* Turn off scrollbar when body element has the loading class */
  body.loading {
    overflow: hidden;
  }

  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay {
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
  $('#multi-file-upload-ajax').submit(function(e)
  {
       
        e.preventDefault();

        var dateprod = $('#dateprod').val();
        var userid = $('#userid2').val();
        var formid = $('#formid').val();
        var position = $('#position').val();
        var uwyear = $('#uwyear').val();
        var cedingbroker = $('#cedingbroker').val();
        var cedingsource = $('#cedingsource').val();
        var type = $('#type').val();
        var subtype = $('#subtype').val();
        var cedingcob = $('#cedingcob').val();
        var cedingkoc = $('#cedingkoc').val();
        var treatydata = $('#treatydata').val();
        var dateofdoc = $('#dateofdoc').val();
        var token2 = $('input[name=_token]').val();

        $.ajaxSetup({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        
        $.ajax({
          url:"{{url('treaty/acc/storeupload')}}",
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
              cedingcob:cedingcob,
              cedingkoc:cedingkoc,
              treatydata:treatydata,
              dateofdoc:dateofdoc,
             _token:token2
          },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {

                //swal("Success!", "Accumulation Upload Entry Insert Success", "success")
                //console.log(response)
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
                  swal("Error!", "Accumulation Upload Entry Insert Error : " + request.responseText, "Insert Error");
              }
          });
        
  

          var formData = new FormData(this);
          let TotalFiles = $('#attachment')[0].files.length; //Total files
          let files = $('#attachment')[0];
          var acc_id = formid;
          
          if(TotalFiles > 0)
          {
              for (let i = 0; i < TotalFiles; i++){
                  formData.append('files' + i, files.files[i]);
              }

              formData.append('TotalFiles', TotalFiles);
              formData.append('acc_id', acc_id);
             

              $.ajax({
                  type:'POST',
                  url: "{{ url('store-multi-file-ajax-acc')}}",
                  data: formData,
                  cache:false,
                  contentType: false,
                  processData: false,
                  dataType: 'json',
                  success: (data) => {
                              //this.reset();
                              //alert('Files has been uploaded using jQuery ajax');
                              swal("Success!", "Files has been uploaded", "success")
                          },
                  error: function(data){
                        //alert(data.responseJSON.errors.files[0]);
                        //swal("Error!", data.responseJSON.errors.files[0], "Insert Error");
                        //console.log(data.responseJSON.errors);
                    }
              });

          }


        //var formData = new FormData(this);
        //let TotalFiles = $('#attachment')[0].files.length; //Total files
        //let files = $('#attachment')[0];
        
    });

</script>

@endsection