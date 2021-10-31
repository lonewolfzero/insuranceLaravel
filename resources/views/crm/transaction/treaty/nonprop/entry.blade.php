@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .styled-border {
    border-width: 3px !important;
    border-color: black !important
  }

.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>



<script type="text/javascript">
   
    $('.numberdata').keyup(function(event) 
    {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
          
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
        {{ __('Non Prop Entry') }}
      </div>

       <div id="master_card" class="card-body bg-light-gray">
          <div class="card">
          <div class="card-header bg-gray">Master Contract</div>
          <div class="card-body bg-light-gray">

            <div class="row">
                <div class="col"></div>
                <div class="col-md-2 d-flex">
                <button class="btn btn-sm btn-primary mr-2">Print</button>
                <button class="btn btn-sm btn-primary">Attach Document</button>
                </div>
            </div>

            <section class="my-4">
              <div class="row mb-2">
                <div class="col-md-2">ID</div>
                <div class="col-md-2">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="userid2" id="userid2" value="{{ Auth::user()->id }}">
                  <input type="text" id="masterid" name="masterid" value="{{ @$mindep->number?@$mindep->number:$code_ms }}" class="form-control form-control-sm">
                </div>
                <div class="col"></div>
                <div class="col-md-2">Date Entry</div>
                <div class="col-md-2"><input type="text" value="{{ date('d/m/Y') }}"  id="masterdateentry"  name="masterdateentry" readonly="true" class="form-control form-control-sm datepicker datemask"></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">Ceding/Broker</div>
                <div class="col-md-3">
                  <select  id="mastercedingID"  name="mastercedingID" class="e1 form-control form-control-sm ml-2">
                    @foreach ($ceding as $c)
                        @if(@$mindep->ceding_id  == $c->id)
                            <option value="{{ $c->id }}" selected >{{ $c->name }}</option>
                        @else
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
                <div class="col"></div>
                <div class="col-md-2">User</div>
                <div class="col-md-2"><input type="text" value="{{ Auth::user()->name }}" id="masteruser"  name="masteruser" readonly="true" class="form-control form-control-sm"></div>
              </div>

              <div class="row mb-2">
                <div class="col-md-2">U/W Year</div>
                <div class="col-md-2"><input type="text" id="masteruwyear"  value="{{ @$mindep->uwyear?@$mindep->uwyear:date('Y') }}"  name="masteruwyear" class="form-control form-control-sm"></div>
                <div class="col-md-1">Ceding Type</div>
                <div class="col-md-2">
                  <select  id="mastercedingtype"  name="mastercedingtype" class="form-control form-control-sm">
                    <option value="Broker"  @if(@$mindep->ceding_type  == "Broker") selected @endif >Broker</option>
                    <option value="Ceding"  @if(@$mindep->ceding_type  == "Ceding") selected @endif >Ceding</option>
                    <option value="Deduction" @if(@$mindep->ceding_type  == "Deduction") selected @endif >Deduction</option>
                  </select>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col"></div>
                <div class="col-md-2">
                  <button class="btn btn-primary" onclick="showsubmastersubmit()">Submit</button>
                </div>
              </div>
            </section>

            

          </div>
        </div>        
      </div>

      @include('crm.transaction.treaty.nonprop.v2.template.submaster')

        <!-- Circles which indicates the steps of the form: 
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>-->

    </div>

  </div>

</div>


</div>

</div>

@endsection


@section('scripts')


<style>
    .input-group {
      align-self: flex-start;
    }
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/treaty/nonprop/v2/index.js') }}"></script>
<script src="{{ asset('/js/treaty/nonprop/v2/entry.js') }}"></script>



<script type='text/javascript'>
function showsubmastersubmit() 
{
    
    //e.preventDefault();
    var masterid = $('#masterid').val();
    var masterdateentry = $('#masterdateentry').val();
    var mastercedingid = $("#mastercedingID").val();
    var masteruser = $('#masteruser').val();
    var masteruwyear = $('#masteruwyear').val();
    var mastercedingtype = $('#mastercedingtype').val();
    var mastercedingtext =$("#mastercedingID option:selected").text();
  

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $.ajax({
        url:"{{url('treaty/nonprop/mindep/store')}}",
        type:"POST",
        data:{
            masterid:masterid,
            masterdateentry:masterdateentry,
            masterceding:mastercedingid,
            masteruser:masteruser,
            masteruwyear:masteruwyear,
            mastercedingname:mastercedingtext,
            mastercedingtype:mastercedingtype
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Master Contracct Insert Success", "success")

                  $("#masterid2").val(masterid);
                  $('#masterdateentry2').val(masterdateentry);
                  $('#masterceding2').val(mastercedingtext);
                  $('#masteruser2').val(masteruser);
                  $('#masteruwyear2').val(masteruwyear);
                  $('#mastercedingtype2').val(mastercedingtype);
                  $('#submasterid').val(response.code_sub);

                  
                  $("#sub_master_card").show();
                  $("#master_card").hide();

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });

 
    $.ajax({
        url:"{{url('treaty/nonprop/getsubcontractbyid/')}}/"+masterid,
        type:"GET",
        data:{
            masterid:masterid,
        },
          beforeSend: function() { $("body").addClass("loading");  },
          complete: function() {  $("body").removeClass("loading"); },
          success:function(response)
          {
                  swal("Success!", "Master Contracct Insert Success", "success")
                  $('#submasterPanel tbody').empty();
                  
                  if(response.success==true)
                  {
                        subcontarctjson=JSON.parse(response.subcontractdata);

                        for(var i = 0; i < subcontarctjson.length; i++)
                        {

                           
                            var date= subcontarctjson[i].period_from;
                            var d=new Date(date.split("/").reverse().join("-"));
                            var dd=d.getDate();
                            var mm=d.getMonth()+1;
                            var yy=d.getFullYear();
                            var newdatefrom=dd+"/"+mm+"/"+yy;

                            var dateto= subcontarctjson[i].period_to;
                            var dto=new Date(dateto.split("/").reverse().join("-"));
                            var ddto=dto.getDate();
                            var mmto=dto.getMonth()+1;
                            var yyto=dto.getFullYear();
                            var newdateto=ddto+"/"+mmto+"/"+yyto;
                            
                           
                            $('#submasterPanel tbody').prepend('<tr id="sumasterslipid'+subcontarctjson[i].id+'" data-name="slipvalue[]">'
                            +'<td data-name="'+subcontarctjson[i].number_subcontract+'">'+subcontarctjson[i].number_subcontract+'</td>'
                            +'<td data-name="'+subcontarctjson[i].ceding_name+'">'+subcontarctjson[i].ceding_name+'</td>'
                            +'<td data-name="'+subcontarctjson[i].period_from+'">'+newdatefrom+' - '+newdateto+'</td>'
                            +'<td>'+subcontarctjson[i].subcontract_type+'</td>'
                            +'<td><div class="row"></div>'
                            
                            +'<div class="btn-group" role="group">'
                            +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> (Option)</button>'
                            +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'

                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="deletesubmaster(\''+subcontarctjson[i].id+'\',\''+masterid+'\')" >Delete Sub Master</button>'
                            
                            +'<a class="text-primary mr-3" data-toggle="modal"  data-looksubmaster="'+subcontarctjson[i].id+'" onclick="showdatalooksubmaster('+subcontarctjson[i].id+')" data-target="#editsubmastermodal">'
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" data-toggle="modal" data-target="#editsubmastermodal">Edit Sub Master</button>'
                            +'</a>'
                            
                            +'<button type="button" class="btn btn-sm btn-primary float-right dropdown-item" onclick="showgroupcob(\''+subcontarctjson[i].number_subcontract+'\')" >Add Group COB</button>'
                            
                            // +'<button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>'

                            +'</div>'
                            +'</div>'

                            +'</div></td></tr>');  
                        }
                         
                  }

           },
           error: function (request, status, error) 
           {
               //alert(request.responseText);
               swal("Error!", "Master Contracct Insert Error", "Insert Error");
           }
       });

       console.log('sudah insert');
      
}
</script>

@include('crm.transaction.treaty.nonprop.entry_js')

@endsection
