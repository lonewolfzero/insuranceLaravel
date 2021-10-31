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

      <div class="card" id="group_adjustment_card2">
            <div class="card-header bg-gray">Detail Adjusment Mindep Layer Contract</div>
            <div class="card-body bg-light-gray">

                        <div class="col-md-2">
                            <h3>Master Contract</h3>
                        </div>
                        <hr>

                        <section class="my-4">
                        <div class="row mb-2">
                            <div class="col-md-2">ID</div>
                                <div class="col-md-2">
                                    <input type="hidden" id="groucobidlayerdata" name="groucobidlayerdata" value="{{ @$ajdmindep->id?@$ajdmindep->id:'' }}" class="form-control form-control-sm">
                                    <input type="text" id="masterid62" name="masterid62" class="form-control form-control-sm" readonly>
                                </div>
                            <div class="col"></div>
                            <div class="col-md-2">Date Entry</div>
                                <div class="col-md-2"><input type="text" id="masterdateentry62" name="masterdateentry62" class="form-control form-control-sm" readonly></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">Ceding/Broker</div>
                            <div class="col-md-3"><input type="text" id="masterceding62" name="masterceding62"
                                class="form-control form-control-sm" readonly></div>
                            <div class="col"></div>
                            <div class="col-md-2">User</div>
                            <div class="col-md-2"><input type="text" id="masteruser62" name="masteruse63"
                                class="form-control form-control-sm" readonly></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">U/W Year</div>
                            <div class="col-md-2"><input type="text" id="masteruwyear62" name="masteruwyear62"
                                class="form-control form-control-sm" readonly></div>
                            <div class="col-md-1">Ceding Type</div>
                            <div class="col-md-2"><input type="text" id="mastercedingtype62" name="mastercedingtype62"
                                class="form-control form-control-sm" readonly></div>
                        </div>
                        </section>

                        <div class="col-md-2">
                            <h3>Sub Master Contract</h3>
                        </div>
                        <hr>

                        <section class="my-4">
                        
                        <div class="row mb-2">
                            <div class="col-md-2">ID</div>
                            <div class="col-md-2"><input type="text" id="submasterid62" name="submasterid62"
                                class="form-control form-control-sm" readonly></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">Ceding Company</div>
                            <div class="col-md-3"><input type="text" id="submasterceding62" name="submasterceding62"
                                class="form-control form-control-sm" readonly></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">Period</div>
                            <div class="col-md-2"><input type="text" id="submasterperiod62" name="submasterperiod62" class="form-control form-control-sm" readonly></div>
                            <div class="col-md-2"><input type="text" id="submasterperiod622" name="submasterperiod622" class="form-control form-control-sm" readonly></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">Type</div>
                            <div class="col-md-2"><input type="text" id="submastertype62" name="submastertype62"
                                class="form-control form-control-sm" readonly></div>
                        </div>
                        
                        <div class="col-md-2">
                            <h3>Group COB</h3>
                        </div>
                        <hr>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('ID') }}</div>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="idgroupcob62" id="idgroupcob62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('Grop COB') }}</div>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="groucob62" id="groucob62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('OGRPI') }}</div>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="groupcoborgpi62" id="groupcoborgpi62" class="form-control form-control-sm ml-2 money text-left" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('Type Of Treaty') }}</div>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="groupcobtype62" id="groupcobtype62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('Brokerage') }}</div>
                            <div class="col-md-4 form-group d-flex">
                                <input type="text" name="groupcobbrokerage62" id="groupcobbrokerage62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">{{ __('Brokerage Persentage') }}</div>
                            <div class="col-md-4 form-group d-flex">
                                <input type="text" name="groupcobbrokeragepersen62" id="groupcobbrokeragepersen62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                        </div>
                        </div>


                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table id="tablegroupcob62" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>Retro Contract</th>
                                    <th>Retro (%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    
                                    </tr>
                                </tbody>
                                </table>
                            </div>                                                
                        </div>
                        
                        <hr>
                        <div class="col-md-2">
                            <h3>Layer Data</h3>
                        </div>
                        <hr>
                        
                        <div class="row mb-2">
                                <div class="col-md-2">{{ __('Layer Level') }}</div>
                                <div class="col-md-4 form-group d-flex">
                                <input type="text" name="levellayer62" id="levellayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                                </div>

                                <label for="" class="col-2">{{ __('Adj Prem Rate') }}</label>
                                <div class="col-md-4 form-group d-flex">
                                <input type="text" name="premratelayer62" id="premratelayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                                </div>
                        </div>

                        <div class="row">
                                <label for="" class="col-2">{{ __('U/W Retention') }}</label>
                                <div class="col-md-4 form-group d-flex">
                                <input type="text" name="uwretlayer62" id="uwretlayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                                </div>

                                <label for="" class="col-2">{{ __('Mindep (100%)') }}</label>
                                <div class="col-md-4 form-group d-flex">
                                <input type="text" name="mindeplayer62" id="mindeplayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                                </div>
                            
                        </div>

                        <div class="row">
                            <label for="" class="col-2">{{ __('Limit (100%)') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="limitlayer62" id="limitlayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('Premium Type') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="premiumtypelayer62" id="premiumtypelayer62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>
                    
                        <div class="row">
                            <label for="" class="col-2"></label>
                            <div class="col-md-4 form-group d-flex">
                                    <a class="text-primary mr-3 float-right " data-toggle="modal"  data-looklayer-id="0" data-target="#addreinstmodal2">
                                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addreinstmodal2">{{__('Reinstatement')}}</button>
                                    </a>
                            </div>
                            <label for="" class="col-2">{{ __('Nasre Share') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="nasreshare62" id="nasreshare62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>


                        
                        <div class="modal fade" id="addreinstmodal2" tabindex="-1" user="dialog" aria-labelledby="addreinstmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" user="document">
                                        <div class="modal-content bg-light-gray">
                                            <div class="modal-header bg-gray">
                                                <h5 class="modal-title" id="addreinstmodalLabel">{{__('Reinstatement Rate')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                    
                                            <div class="col-md-12">
                                                <div class="card card-primary">
                                                <div class="card-body">
                                                            
                                                                <div class="form-group">
                                                            
                                                                <hr>

                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label for="">{{ __('Number Reinstatement ') }}</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <input type="hidden"  id="layerid43" name="layerid43"  class="form-control form-control-sm">
                                                                            <input type="hidden"  id="groupcobid43" name="groupcobid43"  class="form-control form-control-sm">
                                                                            <input type="text" id="numberinstatement" name="numberinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                                            </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <button class="btn btn-primary btn-block" onclick="storereinstatementsubmit()">{{__('Add Instatement')}}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label for="">{{ __('Percentage %') }}</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <input type="text" id="percentagereinstatement" name="percentagereinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                                            </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="row">   
                                                                    <!--div class="col-md-2">
                                                                    <label for="">{{ __('Note') }}</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                        <input type="text" id="notereinstatement" name="notereinstatement" class="form-control form-control-sm"> &nbsp;&nbsp; 
                                                                        </div>
                                                                    </div-->
                                                                </div>
                                                                
                                                            
                                                                <div class="form-group">
                                                                    <div class="table-responsive">
                                                                        <table id="reinstatementable33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Number</th>
                                                                                <th>Percentage</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>

                                                                        </div>
                                                                </div>
                                        
                                                            </div>
                                                        <hr>
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                                {{-- Location Modal Ends --}}

                        <div class="row">
                            <label for="" class="col-2">{{ __('Liability') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="liability62" id="liability62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('MD Premium') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="mdpremium62" id="mdpremium62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        
                        </div>

                        <div class="row">

                            <label for="" class="col-2">{{ __('AA Limit') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="aadlimit62" id="aadlimit62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>

                            <label for="" class="col-2">{{ __('AA Deductible') }}</label>
                            <div class="col-md-4 form-group d-flex">
                            <input type="text" name="aadedcutible62" id="aadedcutible62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="row">
                          <label for="" class="col-2">{{ __('Brokerage') }}</label>
                          <div class="col-md-4 form-group d-flex">
                          <input type="text" name="brokerage62" id="brokerage62" class="form-control form-control-sm ml-2" autocomplete="off" readonly>
                          </div>

                          <label for="" class="col-2"></label>
                          <div class="col-md-4 form-group d-flex">
                          </div>
                        </div>



                        <div class="row mb-2">
                            <div class="table-responsive">
                                <table id="tablelayer32" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>Detail COB</th>
                                    <th>Share (%)</th>
                                    <th>Group COB</th>
                                    <th>OGRPI (%)</th>
                                    <th>OGRPI Amount</th>
                                    <th>Mindep Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>                                                
                        </div>

                        <hr>

                        <div class="col-md-12">            
                            <div class="card card-primary">
                                <div class="card-body">

                            <div class="row">    
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="">{{ __('Counter Number') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <input type="hidden" class="form-control form-control-sm" name="layerid62" id="layerid62">
                                    <input type="hidden" class="form-control form-control-sm" name="layerid32" id="layerid32">
                                    <input type="text" id="counternumber52" name="counternumber52" class="form-control form-control-sm">
                                    </div>
                                </div>
                                </div>

                                
                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Position') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input type="text" id="position52" name="position52" class="form-control form-control-sm datepicker">
                                    </div>
                                </div>
                                    <div class="col-md-1">
                                        <label for="">{{ __('Transfer Date') }}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <input type="text" id="adjtransferdate52" name="adjtransferdate52"  value="{{ date('d/m/Y') }}"  class="form-control form-control-sm datepicker" readonly>
                                        </div>
                                    </div>    
                                </div>

                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Due Date') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input type="text" id="duedate52" name="duedate52"  value="{{ date('d/m/Y') }}" class="form-control form-control-sm datepicker">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Actual GRPI') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input type="text" id="ogrpi52" name="ogrpi52" class="form-control form-control-sm money text-left">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Adjustment') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input type="text" id="adjustment52" name="adjustment52"  class="form-control form-control-sm money text-left">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">{{ __('Additional Premium') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <input type="text" id="additional_premium52" name="additional_premium52"  class="form-control form-control-sm money text-left">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">{{ __('Brokerage Percentage') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="brokeragepercentage52" name="brokeragepercentage52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">{{ __('Brokerage Amount') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="brokerage52" name="brokerage52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                    <label for="">{{ __('Disc Percentage%') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" id="discpecentage52" name="discpecentage52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-md-2">
                                    <label for="">{{ __('Disc Amount') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" id="disc52" name="disc52" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    <label for="">{{ __('Re Sharer') }}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="text" id="re_sharer52" name="re_sharer52"  class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{ __('Net Add Premium') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="text" id="net_add_premium52" name="net_add_premium52"  class="form-control form-control-sm money text-left">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <!--input type="text" id="retro_share52" name="retro_share52" class="form-control form-control-sm money text-left"-->
                                    </div>
                                </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                        <div class="row justify-content-center my-4">
                                            <div class="col-md-4 text-center">
                                                <button class="btn btn-primary btn-block" onclick="storeadjustmentsubmit()">{{__('Add  Adjusment')}}</button>
                                            </div>
                                        </div>
                                        </div>
                                            
                                    </div>
                                </div>
                                

                                
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="tableadjusment33" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>No </th>
                                            <th>Layer ID</th>
                                            <th>Due Date</th>
                                            <th>Actual GRPI</th>
                                            <th>Adjustment</th>
                                            <th>Additional Premium</th>
                                            <th>Brokerage</th>
                                            <th>Disc (%)</th>
                                            <th>Net Add Premium</th>
                                            <th>Re Share</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        </table>
                                    </div>                                                
                                </div>
                                
                                </div>
                            </div>
                        
                        </div>


            </div>
            </div>


        <div class="modal fade" id="editdetailadjmodal" tabindex="-1" user="dialog" aria-labelledby="editdetailadjmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" user="document">
                <div class="modal-content bg-light-gray">
                            <div class="modal-header bg-gray">
                                <h5 class="modal-title" id="editdetailadjmodalLabel">{{__('Layer')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-body">

                                    <div class="row">    
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="">{{ __('Counter Number') }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <input type="hidden" class="form-control form-control-sm" name="layerid62" id="layerid62">
                                            <input type="text" id="counternumberupdate52" name="counternumberupdate52" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        </div>

                                        
                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('Position') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" id="positionupdate52" name="positionupdate52" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                            <div class="col-md-1">
                                                <label for="">{{ __('Transfer Date') }}</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <input type="text" id="adjtransferdateupdate52" name="adjtransferdateupate52" class="form-control form-control-sm datepicker" readonly>
                                                </div>
                                            </div>    
                                        </div>

                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('Due Date') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" id="duedateupdate52" name="duedateupdate52" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('Actual GRPI') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" id="ogrpiupdate52" name="ogrpiupdate52" class="form-control form-control-sm money text-left">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('Adjusment') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" id="adjustmentupdate52" name="adjustmentupdate52"  class="form-control form-control-sm money text-left">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        </div>


                                        <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('Additional Premium') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" id="additional_premiumupdate52" name="additional_premiumupdate52"  class="form-control form-control-sm money text-left">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">{{ __('Brokerage Percentage') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="brokeragepercentageupdate52" name="brokeragepercentageupdate52" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="">{{ __('Brokerage Amount') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="brokerageupdate52" name="brokerageupdate52" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-2">
                                            <label for="">{{ __('Disc Percentage%') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input type="text" id="discpecentageupdate52" name="discpecentageupdate52" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                        </div>


                                        <div class="row"> 
                                            <div class="col-md-2">
                                            <label for="">{{ __('Disc Amount') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input type="text" id="discupdate52" name="discupdate52" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                            <label for="">{{ __('Re Sharer') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input type="text" id="re_sharerupdate52" name="re_sharerupdate52"  class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">{{ __('Net Add Premium') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input type="text" id="net_add_premiumupdate52" name="net_add_premiumupdate52"  class="form-control form-control-sm money text-left">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <!--input type="text" id="retro_share52" name="retro_share52" class="form-control form-control-sm money text-left"-->
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="row justify-content-center">
                                            
                                                <div class="col-md-8">
                                                <div class="row justify-content-center my-4">
                                                    <div class="col-md-4 text-center">
                                                        <button class="btn btn-primary btn-block" onclick="updateadjustmentsubmit()">{{__('Edit  Adjusment')}}</button>
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                                    
                                            </div>
                                        </div>
                                        
                                        
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                </div>
                                    
                                    </div>
                                    <hr>
                                </div>
                            </div>
                                
                            
                    </div>
                </div>
            </div>
            {{-- Location Modal Ends --}}

     
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

<script>
  $(document).on('click','.accept', function(e){
     $(".modal-fade").modal("hide");
     $(".modal-backdrop").remove();  
     
    
  });

 
</script>


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
   $(document).ready(function() {
        var groucobidlayerdata=$("#groucobidlayerdata").val();
        //alert('masuk');
        showadjustmentsubmit(groucobidlayerdata);
   });
</script>



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