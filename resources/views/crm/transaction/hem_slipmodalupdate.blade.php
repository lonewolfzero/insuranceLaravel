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
                                                            <input type="hidden" name="slipidupdate" id="slipidupdate" value="">
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
                                                        <label for="">{{__('Source')}}</label>
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
                                                            @foreach($ceding as $cd)
                                                                <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}</option>
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
                                                                <input type="hidden" id="sliptotalsumupdate" value="" name="sliptotalsumupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  placeholder="tsi(*total/sum from interest insured)" />
                                                                <input type="text" id="sliptotalsumupdate2" value="" name="sliptotalsumupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled placeholder="tsi(*total/sum from interest insured)" />
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
                                                                            <input type="text" id="slippctupdate" name="slippctupdate" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="pct" />
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
                                                                <input type="hidden" value="" id="sliptotalsumpctupdate" name="sliptotalsumpctupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="=pct*tsi" />
                                                                <input type="text" value="" id="sliptotalsumpctupdate2" name="sliptotalsumpctupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="=pct*tsi" disabled/>
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
                                                                                    <input type="text"  id="slipdppercentageupdate" name="slipdppercentageupdate" placeholder="x" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" />
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" value=""  id="slipdpamountupdate" name="slipdpamountupdate" placeholder="=x*tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  />
                                                                                    <input type="text" value=""  id="slipdpamountupdate2" name="slipdpamountupdate2" placeholder="=x*tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" value=""  id="slipdpminamountupdate" name="slipdpminamountupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" />
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
                                                                                        <input type="text"  id="slipnilaiecupdate" name="slipnilaiecupdate" placeholder="y" class="form-control form-control-sm floatTextBox2"/>
                                                                                        <input type="text"  id="sliptotalnilaiecupdate" name="sliptotalnilaiecupdate" hidden="true" placeholder="sum y &permil;" class="form-control form-control-sm floatTextBox2"/>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" value=""  id="slipamountecupdate" name="slipamountecupdate" placeholder="=y*tsi" class="form-control form-control-sm amount" />
                                                                                        <input type="text" value=""  id="slipamountecupdate2" name="slipamountecupdate2" placeholder="=y*tsi" class="form-control form-control-sm amount" disabled/>
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
                                                                <input type="hidden" id="sharetotalsumupdate" value="" name="sharetotalsumupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  placeholder="tsi(*total/sum from interest insured)" />
                                                                <input type="text" id="sharetotalsumupdate2" value="" name="sharetotalsumupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled placeholder="tsi(*total/sum from interest insured)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                                <input type="text"  id="sliprateupdate" name="sliprateupdate" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" placeholder="a &permil;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" >{{__('Total Rate') }}</label>
                                                                <input type="hidden" id="sliptotalrateupdate" value="" name="sliptotalrateupdate" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50"  placeholder="= a &permil; * sum y &permil; " />
                                                                <input type="text" id="sliptotalrateupdate2" value="" name="sliptotalrateupdate2" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" disabled placeholder="= a &permil; * sum y &permil; " />
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
                                                            <input type="text" id="slipbasicpremiumupdate" name="slipbasicpremiumupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-150" placeholder="a &permil; * tsi" />
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
                                                                            <input type="text"  id="slipshareupdate" name="slipshareupdate" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="b%" />
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
                                                                <input type="hidden" id="slipsumshareupdate" name="slipsumshareupdate" placeholder="= b% * tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  />
                                                                <input type="text" id="slipsumshareupdate2" name="slipsumshareupdate2" placeholder="= b% * tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled/>
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
                                                                            <input type="text" id="slipcommissionupdate" name="slipcommissionupdate" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="d" />
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
                                                                <input type="hidden" id="slipsumcommissionupdate" name="slipsumcommissionupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - d%)"  />
                                                                <input type="text" id="slipsumcommissionupdate2" name="slipsumcommissionupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - d%)" />
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
                                                                            <input type="text" id="slipvbrokerupdate" name="slipvbrokerupdate"  class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="a" />
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
                                                                            <input type="hidden"  id="slipsumfeeupdate" name="slipsumfeeupdate"  class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - e%)" />
                                                                            <input type="text"  id="slipsumfeeupdate2" name="slipsumfeeupdate2"  class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - e%)" />
                                                                            
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
                                                                <input type="hidden" id="slipgrossprmtonrupdate" name="slipgrossprmtonrupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                                <input type="text" id="slipgrossprmtonrupdate2" name="slipgrossprmtonrupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="a &permil; * tsi * b% " disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Net Prm to NR')}}</label>
                                                                <input type="hidden" id="slipnetprmtonrupdate" name="slipnetprmtonrupdate" class="form-control form-control-sm amount" data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                                <input type="text" id="slipnetprmtonrupdate2" name="slipnetprmtonrupdate2" class="form-control form-control-sm amount" data-validation="length" placeholder="= a &permil; * b% * tsi * (100% - d% - e%)" data-validation-length="0-50" disabled/>
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
                                                                                    <input type="text"  id="slipippercentageupdate" name="slipippercentageupdate" placeholder="w" class="form-control form-control-sm floatTextBox" />
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="slipipamountupdate" name="slipipamountupdate" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" />
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
                                            <div class="row">
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
                                                                        <input type="text" id="sliporupdate" value="" name="sliporupdate" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="slipsumorupdate" value=""   name="slipsumorupdate" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" />
                                                                        <input type="text" id="slipsumorupdate2" value=""   name="slipsumorupdate2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                            <th>{{__('Type')}}</th>
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
                                                                                            <select id="sliprptypeupdate" name="sliprptypeupdate" class="form-control form-control-sm ">
                                                                                                <option selected disabled>{{__('Type list')}}</option>
                                                                                                <option value="NM XOL">NM XOL</option>
                                                                                            </select>
                                                                                        </div>  
                                                                                    </td>
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
                                                                                                        <input type="text" id="sliprppercentageupdate" name="sliprppercentageupdate" class="form-control form-control-sm floatTextBox" />
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
                                                                                            <input type="hidden" id="sliprpamountupdate" name="sliprpamountupdate" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" />
                                                                                            <input type="text" id="sliprpamountupdate2" name="sliprpamountupdate2" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" disabled/>
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
                            <input type="submit" class="btn btn-secondary"  value="Update"/>
                        </div>



                    </form>
                </div>
                </div>
            </div>
            {{-- Edit Modal Ends --}}