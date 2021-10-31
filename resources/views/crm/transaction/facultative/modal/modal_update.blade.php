{{-- Detail Modal --}}
<div class="modal fade" id="detailmodaldata" tabindex="-1" user="dialog" aria-labelledby="addDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
        <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addDetailLabel">{{__('Slip Detail')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        
        <form id="multi-file-upload-ajaxdetail" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="general-details2" data-toggle="pill" href="#general-details-id2" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="insured-details2" data-toggle="pill" href="#insured-details-id2" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" id="installment-details2" data-toggle="pill" href="#installment-details-id2" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body bg-light-gray">
                        <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="general-details-id2" role="tabpanel" aria-labelledby="general-details">
                                <div class="row">
                                    
                                 
                                
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
                                                <label for="">{{__('Number')}} </label>
                                                <input type="text" id="slipnumberdetail" name="slipnumberdetail" class="form-control form-control-sm" value="{{ $code_sl }}" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Username')}}</label>
                                                    <input type="text" id="slipusernamedetail" name="slipusernamedetail" class="form-control form-control-sm " data-validation="length" data-validation-length="2-50" value="" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Prod Year')}}:</label>
                                                        <div class="input-group " >
                                                                <input type="text" id="slipprodyeardetail" class="form-control form-control-sm "  name="slipprodyeardetail" value="" disabled>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <div class="form-group">
                                                    <label for="">{{__('UY')}}</label>
                                                    <input type="number" id="slipuydetail" name="slipuydetail" value="" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-4" required/>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="">{{__('Transfer Date')}}</label>
                                                     <input type="text" id="sliptddetail" name="sliptddetail" class="form-control form-control-sm" value="" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Status')}}</label>
                                                <input type="text" id="slipstatusdetail" name="slipstatusdetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="slip" readonly="readonly"/>
                                             
                                            </div>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 com-sm-12 mt-3">
                                                <table id="statuslogdetailform" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Datetime')}}</th>
                                                        <th>{{__('User')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                       
                                                </tbody>
                                                </table>
                                                <i class="fa fa-info-circle" style="color: grey;" aria-hidden="true"> Data is Transferred!</i>
                                                 <!-- <ul id="statlistdetail">


                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Ceding/Broker')}}</label>
                                            <select id="slipcedingbrokerdetail" disabled="true" name="slipcedingbrokerdetail" class=" form-control form-control-sm ">
                                                @foreach($cedingbroker as $cb)
                                                    <option value="{{ $cb->id }}" >{{ $cb->type }} - {{ $cb->code }} - {{ $cb->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group">
                                            <label for="">{{__('Source')}}</label>
                                            <select id="slipcedingdetail" disabled="true" name="slipcedingdetail" class=" form-control form-control-sm ">
                                                {{-- <option value="" readonly selected  value='0'>Ceding </option> --}}
                                                {{-- @foreach($ceding as $cd)
                                                    <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}</option>
                                                @endforeach --}}
                                                @foreach ($brokerchoice as $cbc)
                                                    <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                    </option>
                                                  @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Currency')}}</label>
                                                <select id="slipcurrencydetail" disabled="true" name="slipcurrencydetail" class=" form-control form-control-sm ">
                                                    @foreach($currency as $crc)
                                                        <option value="{{ $crc->id }}" hidden="true">{{ $crc->code }} - {{ $crc->symbol_name }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('COB')}}</label>
                                                <select id="slipcobdetail" name="slipcobdetail" disabled="true" class=" form-control form-control-sm ">
                                                    @foreach($cob as $boc)
                                                        <option value="{{ $boc->id }}">{{ $boc->code }} - {{ $boc->description }}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('KOC')}}</label>
                                                <select id="slipkocdetail" name="slipkocdetail" disabled="true" class=" form-control form-control-sm ">
                                                    @foreach($koc as $cok)
                                                        <option value="{{ $cok->id }}">{{ $cok->code }} - {{ $cok->description }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Occupacy')}}</label>
                                                <select id="slipoccupacydetail" disabled="true" name="slipoccupacydetail"  class=" form-control form-control-sm ">
                                                    @foreach($ocp as $ocpy)
                                                        <option value="{{ $ocpy->id }}">{{ $ocpy->code }} - {{ $ocpy->description }}</option>
                                                      
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('Building Const')}}</label>
                                            <select id="slipbld_constdetail" name="slipbld_constdetail" disabled="true" class=" form-control form-control-sm ">
                                                <option  disabled>{{__('Building Const list')}}</option>
                                                <option value="Building 1">Building 1</option>
                                                <option value="Building 2">Building 2</option>
                                                <option value="Building 3">Building 3</option>
                                            
                                            </select>
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Upper Area')}}</label>
                                                    <input type="text" id="slipbcuadetail" name="slipbcuadetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Lower Area')}}</label>
                                                    <input type="text" id="slipbcladetail" name="slipbcladetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('WPC')}}</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="number" min="0" value="" readonly="readonly" step=".0001" id="wpcdetail" name="wpcdetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><span style="font-size: 12px;">Days</span></div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Attachment')}} </label>
                                            <div class="input-group">
                                                <ul id="aidlistdetail">


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Endorsement')}}</label>
                                            <input type="text" min="0" value=""  step=".0001" id="countendorsmentdetail" name="countendorsmentdetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" disabled />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Remarks')}}</label>
                                            <textarea type="text"  id="remarksdetail" name="remarksdetail" class="form-control form-control-sm" data-validation="length" data-validation-length="0-50" placeholder="" readonly></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="insured-details-id2" role="tabpanel" aria-labelledby="insured-details">
                               
                               
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share') }}</label>
                                                    <select id="sliptypetsidetail" disabled="true" name="sliptypetsiupdate" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Share')}}</option>
                                                        <option value="1">Total Sum Insured</option>
                                                        <option value="2">Ceding Share</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share Value') }}</label>
                                                    <input type="text" value="" id="sliptotalsumdetail"  name="sliptotalsumdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" readonly="readonly"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">{{__('Type')}}</label>
                                                    <select id="sliptypedetail" disabled="true" name="sliptypedetail" class="form-control form-control-sm ">
                                                        {{-- <option selected disabled>{{__('Select Continent')}}</option> --}}
                                                        <option value="PML" >PML</option>
                                                        <option value="LOL" >LOL</option>
                                                        <option value="TSI" >TSI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" style="opacity: 0;">{{__('Type')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="number" value="" step=".0001" readonly="readonly" id="slippctdetail" name="slippctdetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="pct" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><span><i class="fa fa-percent" aria-hidden="true"></i></span></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for=""style="opacity: 0;">{{__('Type')}}</label>
                                                    <input type="text" value="" id="sliptotalsumpctdetail" name="sliptotalsumpctdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Deductible Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="deductiblePaneldetail" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Type')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th>{{__('Min Claim Amount')}}</th>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Extended Coverage')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="ExtendCoveragePaneldetail" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Peril Code - Name')}}</th>
                                                                <th>{{__('Nilai (permil %.)')}}</th>
                                                                <th>{{__('Amount')}}</th>
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


                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Insurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinfrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input" value="" readonly="readonly" data-target="#date" id="slipipfromdetail" name="slipipfromdetail">
                                                                {{-- <div class="input-group-append datepickerinfrom" data-target="#dateinfrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input"  readonly="readonly" value="" data-target="#date" id="slipiptodetail" name="slipiptodetail">
                                                                {{-- <div class="input-group-append datepickerinto" data-target="#dateinto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Reinsurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="daterefrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" readonly="readonly" value="" data-target="#date" id="sliprpfromdetail" name="sliprpfromdetail">
                                                                {{-- <div class="input-group-append" data-target="#daterefrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="datereto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" value="" readonly="readonly"  data-target="#date" id="sliprptodetail" name="sliprptodetail">
                                                                {{-- <div class="input-group-append" data-target="#datereto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <div class="form-group" id="daytotal">                         
                                                Total Days :0
                                                
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="">{{__('Total Days')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotaldetail" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text" disabled="true"  id="slipdaytotaldetail2" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <h2>/</h2>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotaldetail3" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text" disabled="true"  id="slipdaytotaldetail4" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                    </div>                                                                       
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{__('Total Summary Insurance Periode')}}</label>
                                                    <input type="text"  id="sliptotalsumdatedetail" name="sliptotalsumdatedetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                

                                
                                <div class="row d-flex justify-content-start">
                                    <i class="fa fa-info-circle" id="labelnpdetail" style="color: grey;" aria-hidden="true"> non proportional panel</i>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-4">
                                        <label class="cl-switch cl-switch-green">
                                            <span for="switch-proportionaldetail" class="label"> {{__('Proportional')}} </span>
                                            <input type="checkbox" name="slipproportionaldetail[]" id="switch-proportional"
                                            class="submit" checked>
                                            <span class="switcher"></span>
                                            <span  class="label"> {{__('Non Proportional')}} </span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group d-flex justify-content-end">
                                            <label style="opacity: 0;">{{__('p')}}:</label>
                                            <button type="button" id="btnaddlayerdetail" class="btn plus-button" data-toggle="modal" data-target="#addLayerModal">
                                                <span data-toggle="tooltip" data-placement="top" title="{{__('Add New layer')}}"> + add layer </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" id="labelnonpropdetail">{{__('Layer for non proportional')}}</label>
                                            <select id="sliplayerproportionaldetail" disabled="true" name="sliplayerproportionaldetail" class="form-control form-control-sm ">
                                                <option selected disabled>{{__('Choose layer')}}</option>
                                                <option value="Layer 1" >Layer 1</option>
                                                <option value="Layer 2" >Layer 2</option>
                                                <option value="Layer 3">Layer 3</option>
                                                <option value="Layer 4" >Layer 4</option>
                                                <option value="Layer 5" >Layer 5</option>
                                            </select>
                                        </div>  
                                    </div>
                                </div>

                                
                                <div class="row">
                                <div class="col-md-6 ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('TSI/Ceding Share') }}</label>
                                                <select id="sharetypetsidetail" disabled="true" name="sharetypetsidetail" class="form-control form-control-sm ">
                                                    <option selected disabled>{{__('Select Share')}}</option>
                                                    <option value="1">Total Sum Insured</option>
                                                    <option value="2">Ceding Share</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  >{{__('TSI/Ceding Share Value') }}</label>
                                                <!-- /<input type="hidden" id="sharetotalsumdetail" value="" name="sharetotalsumdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   /> -->
                                                <input type="text" id="sharetotalsumdetail" value="" name="sharetotalsumdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                <input type="text" disabled="true" id="slipratedetail" name="slipratedetail" class="form-control form-control-sm 2" data-validation="length" data-validation-length="0-50" placeholder="a &permil;" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  >{{__('Total Rate') }}</label>
                                                <!-- <input type="hidden" id="sliptotalratedetail" value="" name="sliptotalratedetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   /> -->
                                                <input type="text" id="sliptotalratedetail" value="" name="sliptotalratedetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Basic Premium')}}</label>
                                            <input type="text" disabled="true"  id="slipbasicpremiumdetail" name="slipbasicpremiumdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('Share to NR %')}}</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <input type="text"  id="slipsharedetail" disabled="true" name="slipsharedetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" >{{__('Nasional RE Share')}}</label>
                                                <input type="hidden" id="slipsumsharedetail" name="slipsumsharedetail"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                <input type="text" id="slipsumsharedetail2" name="slipsumsharedetail2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('RI Com')}}</label>
                                                <div class="row d-flex flex-wrap">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <input type="text" disabled="true" id="slipcommissiondetail" name="slipcommissiondetail" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('RI Com Amount')}}</label>
                                                <input type="hidden" id="slipsumcommissiondetail" name="slipsumcommissiondetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                <input type="text" id="slipsumcommissiondetail2" name="slipsumcommissiondetail2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  disabled />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('Fee Broker')}}</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <input type="text" disabled="true" id="slipvbrokerdetail" name="slipvbrokerdetail" value="0" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('Fee Broker Amount')}}</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <input type="hidden"  id="slipsumfeedetail" name="slipsumfeedetail"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                            <input type="text"  id="slipsumfeedetail2" name="slipsumfeedetail"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" disabled  />
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="row"> 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Gross Prm to NR')}}</label>
                                                <input type="hidden" id="slipgrossprmtonrdetail" name="slipgrossprmtonrdetail" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                <input type="text" id="slipgrossprmtonrdetail2" name="slipgrossprmtonrdetail2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Net Prm to NR')}}</label>
                                                <input type="hidden" id="slipnetprmtonrdetail" name="slipnetprmtonrdetail" class="form-control form-control-sm money text-left" data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                <input type="text" id="slipnetprmtonrdetail2" name="slipnetprmtonrdetail2" class="form-control form-control-sm money text-left" data-validation="length"  data-validation-length="0-50" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                

                            </div>
                            
                            <div class="tab-pane fade" id="installment-details-id2" role="tabpanel" aria-labelledby="installment-details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Installment Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="installmentPaneldetail" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Installment Date')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
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
                                <div class="row" id="tabretrodetail">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Retrocession Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="retrocessionPaneldetail" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Retrocession Contract')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
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
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card card-primary">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-bottom" id="custom-tabs-three-tabbottom" role="tablist">
                            
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="general-details2" data-toggle="pill" href="#general-details-id2" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="insured-details2" data-toggle="pill" href="#insured-details-id2" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" id="installment-details2" data-toggle="pill" href="#installment-details-id2" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </form>
    </div>
    </div>
</div>
{{-- Detail Modal Ends --}}

{{-- Update Modal --}}
<div class="modal fade" id="updatemodaldata" tabindex="-1" user="dialog" aria-labelledby="addupdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
        <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addupdateLabel">{{__('Slip Update')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        
        <form id="multi-file-upload-ajaxupdate" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id4" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id4" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id4" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body bg-light-gray">
                        <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="general-details-id4" role="tabpanel" aria-labelledby="general-details">
                                <div class="row">
                                    
                                 
                                
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="insuredIDtxtupdate" id="insuredIDtxtupdate" value="">
                                                <label for="">{{__('Number')}} </label>
                                                <input type="text" id="slipnumberupdate" name="slipnumberupdate" class="form-control form-control-sm" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Username')}}</label>
                                                    <input type="text" id="slipusernameupdate" name="slipusernameupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="2-50" value="" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Prod Year')}}:</label>
                                                        <div class="input-group ">
                                                                <input type="hidden" id="slipprodyearupdate" class="form-control form-control-sm "  name="slipprodyearupdate" value="" >
                                                                <input type="text" id="slipprodyearupdate2" class="form-control form-control-sm "  name="slipprodyearupdate2" value="" disabled>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Transfer Date')}}</label>
                                                    <input type="hidden" id="sliptdupdate" name="sliptdupdate" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-50" />
                                                        <input type="text" id="sliptdupdate2" name="sliptdupdate2" class="form-control form-control-sm" data-validation="length"  data-validation-length="0-50" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Status')}}</label>
                                                <input type="text" id="slipstatusupdate" name="slipstatusupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="slip" readonly="readonly"/>
                                                
                                                
                                                <!-- <select name="slipstatusupdate" id="slipstatusupdate" class="form-control form-control-sm ">
                                                    <option value="slip" >Slip</option>
                                                    <option value="endorsement" >Endorsement</option>
                                                    <option value="cancel" >Cancel</option>
                                                </select> -->
                                            </div>    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 com-sm-12 mt-3">
                                                <table id="slipStatusTableupdate" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Datetime')}}</th>
                                                        <th>{{__('User')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                       
                                                </tbody>
                                                
                                                </table>
                                                <i class="fa fa-info-circle" style="color: grey;" aria-hidden="true"> Data is Transferred!</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Ceding/Broker')}}</label>
                                            <select id="slipcedingbrokerupdate" name="slipcedingbrokerupdate" class=" form-control form-control-sm ">
                                                <option value="placehoder" selected disabled>Ceding or Broker</option>
                                              @foreach ($brokerchoice as $cbc)
                                                <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                </option>
                                              @endforeach
                                              @foreach ($broker as $cb)
                                                <option value="{{ $cb->id }}">{{ $cb->code }} - {{ $cb->name }}
                                                </option>
                                              @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group">
                                            <label for="">{{ __('Source') }}</label>
                                            <select id="slipcedingupdate" name="slipcedingupdate" class=" form-control form-control-sm ">
                                                <option value="" readonly selected  value='0'>Ceding </option>
                                                {{-- @foreach($ceding as $cd)
                                                    <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}</option>
                                                @endforeach --}}
                                                @foreach ($brokerchoice as $cbc)
                                                    <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                    </option>
                                                  @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Currency')}}</label>
                                                <select id="slipcurrencyupdate" name="slipcurrencyupdate" class=" form-control form-control-sm ">
                                                    @foreach($currency as $crc)
                                                       <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div> -->
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('COB')}}</label>
                                                <select id="slipcobupdate" name="slipcobupdate" class=" form-control form-control-sm ">
                                                    @foreach($cob as $boc)
                                                       <option value="{{ $boc->id }}">{{ $boc->code }} - {{ $boc->description }}</option>
                                                    
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('KOC')}}</label>
                                                <select id="slipkocupdate" name="slipkocupdate" class=" form-control form-control-sm ">
                                                    @foreach($koc as $cok)
                                                        <option value="{{ $cok->id }}">{{ $cok->code }} - {{ $cok->description }}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Occupacy')}}</label>
                                                <select id="slipoccupacyupdate" name="slipoccupacyupdate" class=" form-control form-control-sm ">
                                                    @foreach($ocp as $ocpy)
                                                       <option value="{{ $ocpy->id }}">{{ $ocpy->code }} - {{ $ocpy->description }}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('Building Const')}}</label>
                                            <select id="slipbld_constupdate" name="slipbld_constupdate" class=" form-control form-control-sm ">
                                                <option  disabled>{{__('Building Const list')}}</option>
                                                <option value="Building 1">Building 1</option>
                                                <option value="Building 2">Building 2</option>
                                                <option value="Building 3">Building 3</option>
                                            
                                            </select>
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Lower Area')}}</label>
                                                    <input type="text" id="slipbclaupdate" name="slipbclaupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Upper Area')}}</label>
                                                    <input type="text" id="slipbcuaupdate" name="slipbcuaupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('WPC')}}</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <input type="text"  id="wpcupdate" name="wpcupdate" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><span style="font-size: 12px;">Days</span></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Attachment')}} </label>
                                            <div class="input-group">
                                                <div class="input-group control-group increment2" >
                                                    <input type="file" name="filesupdate[]" id="attachmentupdate" class="form-control" multiple>
                                                </div>
                                                <ul id="aidlistupdate">


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Endorsement')}}</label>
                                            <input type="hidden" min="0" value="" step=".0001" id="countendorsmentupdate" name="countendorsmentupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" />
                                            <input type="text" min="0" value="" step=".0001" id="countendorsmentupdate2" name="countendorsmentupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" disabled="" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Remarks')}}</label>
                                            <textarea type="text"  id="remarksupdate" name="remarksupdate" class="form-control form-control-sm" data-validation="length" data-validation-length="0-50" placeholder="" ></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="insured-details-id4" role="tabpanel" aria-labelledby="insured-details">
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share') }}</label>
                                                    <select id="sliptypetsiupdate" name="sliptypetsiupdate" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Share')}}</option>
                                                        <option value="1">Total Sum Insured</option>
                                                        <option value="2">Ceding Share</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""   >{{__('TSI/Ceding Share Value') }}</label>
                                                    <input type="hidden" id="sliptotalsumupdate" value="" name="sliptotalsumupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sliptotalsumupdate2" value="" name="sliptotalsumupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">{{__('Type')}}</label>
                                                    <select id="sliptypeupdate" name="sliptypeupdate" class="form-control form-control-sm ">
                                                        {{-- <option selected disabled>{{__('Select Continent')}}</option> --}}
                                                        <option value="PML"  >PML</option>
                                                        <option value="LOL"  >LOL</option>
                                                        <option value="TSI"  >TSI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" style="opacity: 0;">{{__('Type')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slippctupdate" name="slippctupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="pct" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for=""style="opacity: 0;">{{__('Type')}}</label>
                                                    <input type="hidden" value="" id="sliptotalsumpctupdate" name="sliptotalsumpctupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                    <input type="text" value="" id="sliptotalsumpctupdate2" name="sliptotalsumpctupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Deductible Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="deductiblePanelupdate" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Type')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th>{{__('Min Claim Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                            </tbody>
                                                            </table>


                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select id="slipdptypeupdate" name="slipdptypeupdate" class="form-control form-control-sm ">
                                                                            <option selected disabled>{{__('Type')}}</option>
                                                                            @foreach($deductibletype as $dt)
                                                                                <option value="{{ $dt->id }}">{{ $dt->abbreviation }} - {{ $dt->description }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>  
                                                                </td>
                                                               
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text"  id="slipdppercentageupdate" name="slipdppercentageupdate" placeholder="x" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="hidden" value=""  id="slipdpamountupdate" name="slipdpamountupdate" placeholder="=x*tsi" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                        <input type="text" value=""  id="slipdpamountupdate2" name="slipdpamountupdate2" placeholder="=x*tsi" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" value=""  id="slipdpminamountupdate" name="slipdpminamountupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                    </div>
                                                                </td> 
                                                                <td>
                                                                    <div class="form-group">
                                                                        <button type="button" id="adddeductibleinsuredupdate-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Extend Coverage')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="ExtendCoveragePanelupdate" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Peril Code - Name')}}</th>
                                                                <th>{{__('Nilai (permil %.)')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td >
                                                                        <div class="form-group">
                                                                            <select id="slipcncodeupdate" name="slipcncodeupdate" class="e1 form-control form-control-sm ">
                                                                                <option selected readonly>{{__('Peril List')}}</option>
                                                                                @foreach($extendedcoverage as $ncd)
                                                                                <option value="{{ $ncd->id }}">{{ $ncd->code }} - {{ $ncd->name }} - {{ $ncd->description }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>  
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text"  id="slipnilaiecupdate" name="slipnilaiecupdate" placeholder="y" class="form-control form-control-sm "/>
                                                                            <input type="text"  id="sliptotalnilaiecupdate" name="sliptotalnilaiecupdate" hidden="true" placeholder="sum y &permil;" class="form-control form-control-sm "/>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="hidden" value=""  id="slipamountecupdate" name="slipamountecupdate" placeholder="=y*tsi" class="form-control form-control-sm money text-left" />
                                                                            <input type="text" value=""  id="slipamountecupdate2" name="slipamountecupdate2" placeholder="=y*tsi" class="form-control form-control-sm money text-left" disabled/>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <button type="button" id="addextendcoverageinsuredupdate-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Insurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinfrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input" value="" data-target="#date" id="slipipfromupdate" name="slipipfromupdate">
                                                                {{-- <div class="input-group-append datepickerinfrom" data-target="#dateinfrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input"  value="" data-target="#date" id="slipiptoupdate" name="slipiptoupdate">
                                                                {{-- <div class="input-group-append datepickerinto" data-target="#dateinto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Reinsurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="daterefrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" value="" data-target="#date" id="sliprpfromupdate" name="sliprpfromupdate">
                                                                {{-- <div class="input-group-append" data-target="#daterefrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="datereto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" value=""  data-target="#date" id="sliprptoupdate" name="sliprptoupdate">
                                                                {{-- <div class="input-group-append" data-target="#datereto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <div class="form-group" id="daytotal">                         
                                                Total Days :0
                                                
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="">{{__('Total Days')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotalupdate" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text"  id="slipdaytotalupdate2" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <h2>/</h2>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotalupdate3" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text"  id="slipdaytotalupdate4" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                    </div>                                                                       
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{__('Total Summary Insurance Periode')}}</label>
                                                    <input type="hidden"  id="sliptotalsumdateupdate" name="sliptotalsumdateupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                    <input type="text"  id="sliptotalsumdateupdate2" name="sliptotalsumdateupdate2" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                

                                
                                <div class="row d-flex justify-content-start">
                                    <i class="fa fa-info-circle" id="labelnpupdate" style="color: grey;" aria-hidden="true"> non proportional panel</i>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-4">
                                        <label class="cl-switch cl-switch-green">
                                            <span for="switch-proportional" class="label"> {{__('Proportional')}} </span>
                                            <input type="checkbox" name="slipproportionalupdate[]" id="switch-proportionalupdate"
                                            class="submit" checked>
                                            <span class="switcher"></span>
                                            <span  class="label"> {{__('Non Proportional')}} </span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group d-flex justify-content-end">
                                            <label style="opacity: 0;">{{__('p')}}:</label>
                                            <button type="button" id="btnaddlayerupdate" class="btn plus-button" data-toggle="modal" data-target="#addLayerModal">
                                                <span data-toggle="tooltip" data-placement="top" title="{{__('Add New layer')}}"> + add layer </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" id="labelnonpropupdate">{{__('Layer for non proportional')}}</label>
                                            <select id="sliplayerproportionalupdate" name="sliplayerproportionalupdate" class="form-control form-control-sm ">
                                                <option selected disabled>{{__('Choose layer')}}</option>
                                                <option value="Layer 1" >Layer 1</option>
                                                <option value="Layer 2" >Layer 2</option>
                                                <option value="Layer 3" >Layer 3</option>
                                                <option value="Layer 4" >Layer 4</option>
                                                <option value="Layer 5" >Layer 5</option>
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share') }}</label>
                                                    <select id="sharetypetsiupdate" name="sharetypetsiupdate" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Share')}}</option>
                                                        <option value="1">Total Sum Insured</option>
                                                        <option value="2">Ceding Share</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""  >{{__('TSI/Ceding Share value') }}</label>
                                                    <input type="hidden" id="sharetotalsumupdate" value="" name="sharetotalsumupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sharetotalsumupdate2" value="" name="sharetotalsumupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                    <input type="text"  id="sliprateupdate" name="sliprateupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a &permil;" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" >{{__('Total Rate') }}</label>
                                                    <input type="hidden" id="sliptotalrateupdate" value="" name="sliptotalrateupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sliptotalrateupdate2" value="" name="sliptotalrateupdate2" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Basic Premium')}}</label>
                                                <input type="text" id="slipbasicpremiumupdate" name="slipbasicpremiumupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-150"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Share to NR %')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text"  id="slipshareupdate" name="slipshareupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" >{{__('Nasional RE Share')}}</label>
                                                    <input type="hidden" id="slipsumshareupdate" name="slipsumshareupdate"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                    <input type="text" id="slipsumshareupdate2" name="slipsumshareupdate2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('RI Com')}}</label>
                                                    <div class="row d-flex flex-wrap">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slipcommissionupdate" name="slipcommissionupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('RI Com Amount')}}</label>
                                                    <input type="hidden" id="slipsumcommissionupdate" name="slipsumcommissionupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="slipsumcommissionupdate2" name="slipsumcommissionupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Fee Broker')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slipvbrokerupdate" name="slipvbrokerupdate"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Fee Broker Amount')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden"  id="slipsumfeeupdate" name="slipsumfeeupdate"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                <input type="text"  id="slipsumfeeupdate2" name="slipsumfeeupdate2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Gross Prm to NR')}}</label>
                                                    <input type="hidden" id="slipgrossprmtonrupdate" name="slipgrossprmtonrupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                    <input type="text" id="slipgrossprmtonrupdate2" name="slipgrossprmtonrupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Net Prm to NR')}}</label>
                                                    <input type="hidden" id="slipnetprmtonrupdate" name="slipnetprmtonrupdate" class="form-control form-control-sm money text-left" data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                    <input type="text" id="slipnetprmtonrupdate2" name="slipnetprmtonrupdate2" class="form-control form-control-sm money text-left" data-validation="length"  data-validation-length="0-50" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="installment-details-id4" role="tabpanel" aria-labelledby="installment-details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Installment Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="installmentPanelupdate" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Installment Date')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                              
                                                            </tbody>
                                                            </table>
                                                            
                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                            <tr>
                                                               <td>
                                                                    <div class="form-group">
                                                                            <input type="text" id="slipipdateupdate" class="form-control form-control-sm datepicker-input" >
                                                                     </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text"  id="slipippercentageupdate" name="slipippercentageupdate" placeholder="w" class="form-control form-control-sm " />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" id="slipipamountupdate" name="slipipamountupdate" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text"  id="sliptotalpercentinspanupdate" name="sliptotalpercentinspanupdate" hidden="true">
                                                                        <button type="button" id="addinstallmentinsuredupdate-btn"  class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="sliprbupdate" name="sliprbupdate" value="YES">
                                <input type="hidden" id="retropercent" name="retropercent">
                                <input type="hidden" id="slipsumorupdate"  name="slipsumorupdate" class="form-control form-control-sm money text-left " />
                                <input type="hidden" id="sliporupdate" value="100" name="sliporupdate" class="form-control form-control-sm 2" data-validation="length" data-validation-length="0-50" />
                                
                                <input type="hidden" id="sliptotalpercentrporupdate" name="sliptotalpercentrporupdate">
                                <!-- <div class="row">
                                    <div class="col-md-6 d-flex justify-content-start">
                                        <div class="form-group">
                                            <label for="">{{__('Retro Backup?')}}</label>
                                            <select id="sliprbupdate" name="sliprbupdate" class="form-control form-control-sm ">
                                                <option value="NO" >NO</option>
                                                <option value="YES" >YES</option>
                                            </select>
                                        </div>   
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">{{__('Own Retention')}}</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type="text" id="sliporupdate" value="" name="sliporupdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="slipsumorupdate" value=""   name="slipsumorupdate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                            <input type="text" id="slipsumorupdate2" value=""   name="slipsumorupdate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row" id="tabretroupdate">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Retrocession Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="retrocessionPanelupdate" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Retrocession Contract')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                              
                                                              
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select id="sliprpcontractupdate" name="sliprpcontractupdate" class="form-control form-control-sm ">
                                                                                    <option selected disabled>{{__('Contract list')}}</option><option value="OWN RETENTION">OWN RETENTION</option>
                                                                                    <option value="20NM11110">20NM11110</option>
                                                                                    <option value="20ABC">20ABC</option>
                                                                                </select>
                                                                            </div>  
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="input-group">
                                                                                            <input type="text" id="sliprppercentageupdate" name="sliprppercentageupdate" class="form-control form-control-sm " />
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="hidden" id="sliprpamountupdate" name="sliprpamountupdate" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" />
                                                                                <input type="text" id="sliprpamountupdate2" name="sliprpamountupdate2" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" disabled/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <button type="button" id="addretrocessioninsuredupdate-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
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
                </div>

                <div class="card card-primary">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-bottom" id="custom-tabs-three-tabbottom" role="tablist">
                            
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id4" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id4" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id4" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <!-- <button type="button" class="btn btn-secondary" id="updatebuttonfeslip" >{{__('Update')}}</button> -->
                <input type="submit" class="btn btn-secondary" id="btnUpdate"  value="Update"/>
            </div>



        </form>
    </div>
    </div>
</div>
{{-- Update Modal Ends --}}

{{-- Endorsement Modal --}}
<div class="modal fade" id="endorsementmodaldata" tabindex="-1" user="dialog" aria-labelledby="addendorsementLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" user="document">
    <div class="modal-content bg-light-gray">
        <div class="modal-header bg-gray">
        <h5 class="modal-title" id="addendorsementLabel">{{__('Slip Endorsement')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        
        <form id="multi-file-upload-ajaxendorsement" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id3" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id3" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id3" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body bg-light-gray">
                        <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="general-details-id3" role="tabpanel" aria-labelledby="general-details">
                                <div class="row">
                                    
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="slipidendorsement" id="slipidendorsement" >
                                                    <input type="hidden" name="insuredIDtxtendorsement" id="insuredIDtxtendorsement">
                                                    <input type="hidden" name="codeslreal" id="codeslreal">
                                                    <label for="">{{__('Number')}} </label>
                                                    <input type="text" id="slipnumberendorsement" name="slipnumberendorsement" class="form-control form-control-sm" value="" readonly="readonly" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- label for="">{{__('Endorsement')}} </label>
                                                    <input type="text" id="slipcountedendorsement" name="slipcountedendorsement" class="form-control form-control-sm" value="" readonly="readonly"/>
                                                    -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Username')}}</label>
                                                    <input type="text" id="slipusernameendorsement" name="slipusernameendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="2-50" value="" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Prod Year')}}:</label>
                                                        <div class="input-group" >
                                                                <input type="hidden" id="slipprodyearendorsement" class="form-control form-control-sm "  name="slipprodyearendorsement" value="" >
                                                                <input type="text" id="slipprodyearendorsement2" class="form-control form-control-sm "  name="slipprodyearendorsement2" value="" disabled>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <div class="form-group">
                                                    <label for="">{{__('UY')}}</label>
                                                    <input type="number" id="slipuyendorsement" name="slipuyendorsement" value="" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-4" required/>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="">{{__('Transfer Date')}}</label>
                                                    <!-- <input type="text" id="sliptdendorsement" name="sliptdendorsement" class="form-control form-control-sm datepicker-input" data-validation="length"  data-validation-length="0-50" readonly="readonly"/>
                                                     -->
                                                     <input type="hidden" id="sliptdendorsement" name="sliptd" class="form-control form-control-sm datetimepicker-input" data-validation="length"  data-validation-length="0-50" />
                                                        <input type="text" id="sliptdendorsement2" name="sliptd" class="form-control form-control-sm datetimepicker-input" data-validation="length"  data-validation-length="0-50" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Status')}}</label>
                                               
                                                <input type="text" id="slipstatusendorsement" name="slipstatusendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="slip" readonly="readonly"/>
                                                
                                            </div>    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 com-sm-12 mt-3">
                                                <table id="slipStatusTableendorsement" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Datetime')}}</th>
                                                        <th>{{__('User')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                       
                                                </tbody>
                                                
                                                </table>
                                                <i class="fa fa-info-circle" style="color: grey;" aria-hidden="true"> Data is Transferred!</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Ceding/Broker')}}</label>
                                            <select id="slipcedingbrokerendorsement" name="slipcedingbrokerendorsement" class=" form-control form-control-sm ">
                                                <option value="placehoder" selected disabled>Ceding or Broker</option>
                                                  @foreach ($brokerchoice as $cbc)
                                                    <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                    </option>
                                                  @endforeach
                                                  @foreach ($broker as $cb)
                                                    <option value="{{ $cb->id }}">{{ $cb->code }} - {{ $cb->name }}
                                                    </option>
                                                  @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group">
                                            <label for="">{{ __('Source') }}</label>
                                            <select id="slipcedingendorsement" name="slipcedingendorsement" class=" form-control form-control-sm ">
                                                <option value="" readonly selected  value='0'>Ceding </option>
                                                {{-- @foreach($ceding as $cd)
                                                    <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}</option>
                                                @endforeach --}}
                                                @foreach ($brokerchoice as $cbc)
                                                    <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                    </option>
                                                  @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Currency')}}</label>
                                                <select id="slipcurrencyendorsement" name="slipcurrencyendorsement" class=" form-control form-control-sm ">
                                                    @foreach($currency as $crc)
                                                        <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div> -->
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('COB')}}</label>
                                                <select id="slipcobendorsement" name="slipcobendorsement" class=" form-control form-control-sm ">
                                                    @foreach($cob as $boc)
                                                        <option value="{{ $boc->id }}">{{ $boc->code }} - {{ $boc->description }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('KOC')}}</label>
                                                <select id="slipkocendorsement" name="slipkocendorsement" class=" form-control form-control-sm ">
                                                    @foreach($koc as $cok)
                                                        <option value="{{ $cok->id }}">{{ $cok->code }} - {{ $cok->description }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Occupacy')}}</label>
                                                <select id="slipoccupacyendorsement" name="slipoccupacyendorsement" class=" form-control form-control-sm ">
                                                    @foreach($ocp as $ocpy)
                                                        <option value="{{ $ocpy->id }}">{{ $ocpy->code }} - {{ $ocpy->description }}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('Building Const')}}</label>
                                            <select id="slipbld_constendorsement" name="slipbld_constendorsement" class=" form-control form-control-sm ">
                                                <option  disabled>{{__('Building Const list')}}</option>
                                                <option value="Building 1">Building 1</option>
                                                <option value="Building 2">Building 2</option>
                                                <option value="Building 3">Building 3</option>
                                            
                                            </select>
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Upper Area')}}</label>
                                                    <input type="text" id="slipbcuaendorsement" name="slipbcuaendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Lower Area')}}</label>
                                                    <input type="text" id="slipbclaendorsement" name="slipbclaendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('WPC')}}</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text"  id="wpcendorsement" name="wpcendorsement" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><span style="font-size: 12px;">Days</span></div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Attachment')}} </label>
                                            <div class="input-group">
                                                <div class="input-group control-group increment2" >
                                                    <input type="file" name="filesendorsement[]" id="attachmentendorsement" class="form-control" multiple>
                                                    
                                                </div>
                                                <ul id="aidlistendorsement">


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Endorsement')}}</label>
                                            <input type="hidden" id="countendorsmentdata" name="countendorsmentdata" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="" />
                                            <input type="text" id="countendorsmentdata2" name="countendorsmentdata" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="" disabled />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('Remarks')}}</label>
                                            <textarea type="text"  id="remarksendorsement" name="remarksendorsement" class="form-control form-control-sm" data-validation="length" data-validation-length="0-50" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="insured-details-id3" role="tabpanel" aria-labelledby="insured-details">
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share') }}</label>
                                                    <select id="sliptypetsiendorsement" name="sliptypetsiendorsement" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Share')}}</option>
                                                        <option value="1">Total Sum Insured</option>
                                                        <option value="2">Ceding Share</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""   >{{__('TSI/Ceding Share Value') }}</label>
                                                    <input type="hidden" id="sliptotalsumendorsement" value="" name="sliptotalsumendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sliptotalsumendorsement2" value="" name="sliptotalsumendorsement2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">{{__('Type')}}</label>
                                                    <select id="sliptypeendorsement" name="sliptypeendorsement" class="form-control form-control-sm ">
                                                        {{-- <option selected disabled>{{__('Select Continent')}}</option> --}}
                                                        <option value="PML" >PML</option>
                                                        <option value="LOL" >LOL</option>
                                                        <option value="TSI" >TSI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" style="opacity: 0;">{{__('Type')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slippctendorsement" name="slippctendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="pct" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for=""style="opacity: 0;">{{__('Type')}}</label>
                                                    <input type="text" value="" id="sliptotalsumpctendorsement" name="sliptotalsumpctendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  readonly="readonly"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Deductible Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="deductiblePanelendorsement" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Type')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th>{{__('Min Claim Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select id="slipdptypeendorsement" name="slipdptypeendorsement" class="form-control form-control-sm ">
                                                                            <option selected disabled>{{__('Type')}}</option>
                                                                            @foreach($deductibletype as $dt)
                                                                                <option value="{{ $dt->id }}">{{ $dt->abbreviation }} - {{ $dt->description }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>  
                                                                </td>
                                                              
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text" id="slipdppercentageendorsement" name="slipdppercentageendorsement" placeholder="x" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" id="slipdpamountendorsement" name="slipdpamountendorsement" placeholder="=x*tsi" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" readonly="readonly" />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text"  id="slipdpminamountendorsement" name="slipdpminamountendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                    </div>
                                                                </td> 
                                                                <td>
                                                                    <div class="form-group">
                                                                        <button type="button" id="adddeductibleinsuredendorsement-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Extended Coverage')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="ExtendCoveragePanelendorsement" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Peril Code - Name')}}</th>
                                                                <th>{{__('Nilai (permil %.)')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <td >
                                                                    <div class="form-group">
                                                                        <select id="slipcncodeendorsement" name="slipcncodeendorsement" class="e1 form-control form-control-sm ">
                                                                            <option selected readonly>{{__('Peril List')}}</option>
                                                                            @foreach($extendedcoverage as $ncd)
                                                                            <option value="{{ $ncd->id }}">{{ $ncd->code }} - {{ $ncd->name }} - {{ $ncd->description }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>  
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" id="slipnilaiecendorsement" name="slipnilaiecendorsement" placeholder="y" class="form-control form-control-sm "/>
                                                                        <input type="text" id="sliptotalnilaiecendorsement" name="sliptotalnilaiec" placeholder="sum y &permil;" hidden="true" class="form-control form-control-sm "/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text"  id="slipamountecendorsement" name="slipamountecendorsement" placeholder="=y*tsi" class="form-control form-control-sm money text-left" readonly="readonly"/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <button type="button" id="addextendcoverageinsuredendorsement-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Insurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinfrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input" value="" data-target="#date" id="slipipfromendorsement" name="slipipfromendorsement">
                                                                {{-- <div class="input-group-append datepickerinfrom" data-target="#dateinfrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datepicker-input"  value="" data-target="#date" id="slipiptoendorsement" name="slipiptoendorsement">
                                                                {{-- <div class="input-group-append datepickerinto" data-target="#dateinto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>{{__('Reinsurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="daterefrom" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" value="" data-target="#date" id="sliprpfromendorsement" name="sliprpfromendorsement">
                                                                {{-- <div class="input-group-append" data-target="#daterefrom" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                <p class="d-flex justify-content-center">to</p>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label style="opacity: 0;">{{__('p')}}:</label>
                                                        {{-- <div class="input-group date" id="datereto" data-target-input="nearest"> --}}
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" value=""  data-target="#date" id="sliprptoendorsement" name="sliprptoendorsement">
                                                                {{-- <div class="input-group-append" data-target="#datereto" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <div class="form-group" id="daytotal">                         
                                                Total Days :0
                                                
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="">{{__('Total Days')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotalendorsement" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text"  id="slipdaytotalendorsement2" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <h2>/</h2>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="hidden"  id="slipdaytotalendorsement3" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                            <input type="text"  id="slipdaytotalendorsement4" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                        </div>
                                                    </div>                                                                       
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{__('Total Summary Insurance Periode')}}</label>
                                                    <input type="text"  id="sliptotalsumdateendorsement" name="sliptotalsumdateendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" readonly="readonly" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-start">
                                    <i class="fa fa-info-circle" id="labelnpendorsement" style="color: grey;" aria-hidden="true"> non proportional panel</i>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-4">
                                        <label class="cl-switch cl-switch-green">
                                            <span for="switch-proportional" class="label"> {{__('Proportional')}} </span>
                                            <input type="checkbox" name="slipproportionalendorsement[]" id="switch-proportionalendorsement"
                                            class="submit" checked>
                                            <span class="switcher"></span>
                                            <span  class="label"> {{__('Non Proportional')}} </span>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group d-flex justify-content-end">
                                            <label style="opacity: 0;">{{__('p')}}:</label>
                                            <button type="button" id="btnaddlayerendorsement" class="btn plus-button" data-toggle="modal" data-target="#addLayerModal">
                                                <span data-toggle="tooltip" data-placement="top" title="{{__('Add New layer')}}"> + add layer </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" id="labelnonpropendorsement">{{__('Layer for non proportional')}}</label>
                                            <select id="sliplayerproportionalendorsement" name="sliplayerproportionalendorsement" class="form-control form-control-sm ">
                                                <option selected disabled>{{__('Choose layer')}}</option>
                                                <option value="Layer 1"  >Layer 1</option>
                                                <option value="Layer 2" >Layer 2</option>
                                                <option value="Layer 3" >Layer 3</option>
                                                <option value="Layer 4" >Layer 4</option>
                                                <option value="Layer 5" >Layer 5</option>
                                            </select>
                                        </div>  
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('TSI/Ceding Share') }}</label>
                                                    <select id="sharetypetsiendorsement" name="sharetypetsiendorsement" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Share')}}</option>
                                                        <option value="1">Total Sum Insured</option>
                                                        <option value="2">Ceding Share</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""   >{{__('TSI/Ceding Share Value') }}</label>
                                                    <input type="hidden" id="sharetotalsumendorsement" value="" name="sharetotalsumendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sharetotalsumendorsement2" value="" name="sharetotalsumendorsement2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                    <input type="text"  id="sliprateendorsement" name="sliprateendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a &permil;" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""  >{{__('Total Rate') }}</label>
                                                    <input type="hidden" id="sliptotalrateendorsement" value="" name="sliptotalrateendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="sliptotalrateendorsement2" value="" name="sliptotalrateendorsement2" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" disabled  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Basic Premium')}}</label>
                                                <input type="text" id="slipbasicpremiumendorsement" name="slipbasicpremiumendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Share to NR %')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text"  id="slipshareendorsement" name="slipshareendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" >{{__('Nasional RE Share')}}</label>
                                                    <input type="hidden" id="slipsumshareendorsement" name="slipsumshareendorsement"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                    <input type="text" id="slipsumshareendorsement2" name="slipsumshareendorsement2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('RI Com')}}</label>
                                                    <div class="row d-flex flex-wrap">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slipcommissionendorsement" name="slipcommissionendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"  />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('RI Com Amount')}}</label>
                                                    <input type="hidden" id="slipsumcommissionendorsement" name="slipsumcommissionendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                    <input type="text" id="slipsumcommissionendorsement2" name="slipsumcommissionendorsement2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Fee Broker')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="slipvbrokerendorsement" name="slipvbrokerendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Fee Broker Amount')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden"  id="slipsumfeeendorsement" name="slipsumfeeendorsement"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                <input type="text"  id="slipsumfeeendorsement2" name="slipsumfeeendorsement2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Gross Prm to NR')}}</label>
                                                    <input type="hidden" id="slipgrossprmtonrendorsement" name="slipgrossprmtonrendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                    <input type="text" id="slipgrossprmtonrendorsement2" name="slipgrossprmtonrendorsement2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Net Prm to NR')}}</label>
                                                    <input type="hidden" id="slipnetprmtonrendorsement" name="slipnetprmtonrendorsement" class="form-control form-control-sm money text-left" data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                    <input type="text" id="slipnetprmtonrendorsement2" name="slipnetprmtonrendorsement2" class="form-control form-control-sm money text-left" data-validation="length"  data-validation-length="0-50" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="tab-pane fade" id="installment-details-id3" role="tabpanel" aria-labelledby="installment-details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Installment Panel')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="installmentPanelendorsement" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Installment Date')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                              
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                            <tr>

                                                               <td>
                                                                    <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm datepicker-input" value="" data-target="#date" id="slipipdateendorsement" name="slipipdateendorsement">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="text"   id="slipippercentageendorsement" name="slipippercentageendorsement" placeholder="w" class="form-control form-control-sm " />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text"  id="slipipamountendorsement" name="slipipamountendorsement" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" readonly/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" id="sliptotalpercentinspanendorsement" name="sliptotalpercentinspanendorsement" hidden="true" >
                                                                        <button type="button" id="addinstallmentinsuredendorsement-btn"  class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                            </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" id="sliprbendorsement" name="sliprbendorsement" value="YES">
                                        <input type="hidden" id="retropercent" name="retropercent">
                                        <input type="hidden" id="slipsumorendorsement"  name="slipsumorendorsement" class="form-control form-control-sm money text-left " />
                                        <input type="hidden" id="sliporendorsement" value="100" name="sliporendorsement" class="form-control form-control-sm 2" data-validation="length" data-validation-length="0-50" />
                                        <input type="hidden" id="sliptotalpercentrporendorsement"  name="sliptotalpercentrporendorsement" />
                                        
                                    <!-- <div class="col-md-6 d-flex justify-content-start">

                                        <div class="form-group">
                                            <label for="">{{__('Retro Backup?')}}</label>
                                            <select id="sliprbendorsement" name="sliprbendorsement" class="form-control form-control-sm ">
                                                <option value="NO" >NO</option>
                                                <option value="YES" selected>YES</option>
                                                
                                            </select>
                                        </div>   
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">{{__('Own Retention')}}</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type="text" id="sliporendorsement" value="" name="sliporendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50"/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="slipsumorendorsement" value=""   name="slipsumorendorsement" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                            <input type="text" id="slipsumorendorsement2" value=""   name="slipsumorendorsement2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row" id="tabretroendorsement">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Retrocession Panel')}}
                                            </div>
                                            
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="retrocessionPanelendorsement" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Retrocession Contract')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                              
                                                            </tbody>
                                                            </table>

                                                            <table class="table table-bordered table-striped">
                                                            <tbody>
                                                                    <tr>
                                                                        
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select id="sliprpcontractendorsement" name="sliprpcontractendorsement" class="form-control form-control-sm ">
                                                                                    <option selected disabled>{{__('Contract list')}}</option><option value="OWN RETENTION">OWN RETENTION</option>
                                                                                    <option value="20NM11110">20NM11110</option>
                                                                                    <option value="20ABC">20ABC</option>
                                                                                </select>
                                                                            </div>  
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="input-group">
                                                                                            <input type="text" id="sliprppercentageendorsement" name="sliprppercentageendorsement" class="form-control form-control-sm " />
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text" id="sliprpamountendorsement" name="sliprpamountendorsement" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" readonly/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <button type="button" id="addretrocessioninsuredendorsement-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>

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
                </div>

            <div class="card card-primary">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bottom" id="custom-tabs-three-tabbottom" role="tablist">
                        
                        <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                        
                        <li class="nav-item">
                            <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id3" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id3" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id3" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        

            
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <input type="submit" class="btn btn-secondary"  value="Endorsement"/>
            </div>
        </form>
    </div>
    </div>
</div>
{{-- Endorsement Modal End --}}

{{-- cancel modal data --}}
<div class="modal fade" id="cancelmodaldata" tabindex="-1" user="dialog" aria-labelledby="cancelmodalLabel" aria-hidden="true">
    <div class="modal-dialog" user="document">
        <div class="modal-content bg-light-gray">
            <div class="modal-header bg-gray">
                <h5 class="modal-title" id="cancelmodalLabel">{{__('Cancel')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-cancelstatus" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <input type="hidden" name="slipnumbercancel" id="slipnumbercancel">
                            <input type="hidden" name="countendorsementcancel" id="countendorsementcancel">
                            <input type="hidden" name="usernamecancel" id="usernamecancel">
                            <input type="hidden" name="cancelmodaldataslipid" id="cancelmodaldataslipid">
                            <div class="form-group">
                                <label for="">{{__('Remarks')}}</label>
                                <textarea type="text"  id="remarkscancel" name="remarkscancel" class="form-control form-control-sm" placeholder="" ></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <input type="submit" class="btn btn-secondary"  value="Confirm"/>
                    </div>
            </form>     
        </div>
    </div>
</div>
{{-- cancel modal data End --}}