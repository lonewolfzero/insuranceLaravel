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
                                                                    <div class="input-group date" id="date" data-target-input="nearest">
                                                                            <input type="text" id="slipprodyearendorsement" class="form-control form-control-sm datepicker-input" data-target="#date" name="slipprodyearendorsement" value="" readonly="readonly">
                                                                            <div class="input-group-append" >
                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
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
                                                                <input type="text" id="sliptdendorsement" name="sliptdendorsement" class="form-control form-control-sm datepicker-input" data-validation="length"  data-validation-length="0-50" readonly="readonly"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">{{__('Status')}}</label>
                                                            <select name="slipstatusendorsement" id="slipstatusendorsement" class="form-control form-control-sm " readonly>
                                                                <option value="slip"  >Slip</option>
                                                                <option value="endorsement">Endorsement</option>
                                                                <option value="cancel">Cancel</option>
                                                            </select>
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
                                                        <label for="">{{__('Source')}}</label>
                                                        <select id="slipcedingbrokerendorsement" name="slipcedingbrokerendorsement" class=" form-control form-control-sm ">
                                                            @foreach($cedingbroker as $cb)
                                                                <option value="{{ $cb->id }}" selected="selected">{{ $cb->type }} - {{ $cb->code }} - {{ $cb->name }}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>    
                                                    <div class="form-group">
                                                        <select id="slipcedingendorsement" name="slipcedingendorsement" class=" form-control form-control-sm ">
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
                                                    <div class="row">
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
                                                    </div>
                            
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
                                                        <input type="number" min="0" value="" step=".0001" id="wpcendorsement" name="wpcendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" />
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
                                                        <input type="text" min="0" value="" step=".0001" id="countendorsmentdata" name="countendorsmentdata" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" />
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
                                                                <label for="">{{__('Total Sum Insured/Ceding Shared') }}</label>
                                                                <select id="sliptypetsiendorsement" name="sliptypetsiendorsement" class="form-control form-control-sm ">
                                                                    <option selected disabled>{{__('Select Share')}}</option>
                                                                    <option value="1">Total Sum Insured</option>
                                                                    <option value="2">Ceding Share</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""  style="opacity: 0;" >{{__('Total Sum Insured') }}</label>
                                                                <input type="hidden" id="sliptotalsumendorsement" value="" name="sliptotalsumendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  placeholder="tsi(*total/sum from interest insured)" />
                                                                <input type="text" id="sliptotalsumendorsement2" value="" name="sliptotalsumendorsement2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled placeholder="tsi(*total/sum from interest insured)" />
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
                                                                            <input type="number" value="" step=".0001" id="slippctendorsement" name="slippctendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="pct" />
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
                                                                <input type="text" value="" id="sliptotalsumpctendorsement" name="sliptotalsumpctendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="=pct*tsi" readonly="readonly"/>
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
                                                                            <th>{{__('Percentage')}}</th>
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
                                                                                <div class="form-group">
                                                                                    <input type="number" value="0" step=".0001" id="slipdppercentageendorsement" name="slipdppercentageendorsement" placeholder="x" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="slipdpamountendorsement" name="slipdpamountendorsement" placeholder="=x*tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" readonly="readonly" />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"  id="slipdpminamountendorsement" name="slipdpminamountendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" />
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
                                                            {{__('Extend Coverage')}}
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
                                                                                    <select id="slipcncodeendorsement" name="slipcncodeendorsement" class="form-control form-control-sm ">
                                                                                        <option selected readonly>{{__('Peril List')}}</option>
                                                                                        @foreach($extendedcoverage as $ncd)
                                                                                        <option value="{{ $ncd->id }}">{{ $ncd->code }} - {{ $ncd->name }} - {{ $ncd->description }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="number" value="0" step=".0001" id="slipnilaiecendorsement" name="slipnilaiecendorsement" placeholder="y" class="form-control form-control-sm "/>
                                                                                    <input type="text"  id="sliptotalnilaiecendorsement" name="sliptotalnilaiecendorsement" hidden="true" placeholder="sum y &permil;" class="form-control form-control-sm floatTextBox2"/>
                                                                                
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"  id="slipamountecendorsement" name="slipamountecendorsement" placeholder="=y*tsi" class="form-control form-control-sm amount" readonly="readonly"/>
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
                                                                <label for=""  style="opacity: 0;" >{{__('Total Sum Insured') }}</label>
                                                                <input type="hidden" id="sharetotalsumendorsement" value="" name="sharetotalsumendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  placeholder="tsi(*total/sum from interest insured)" />
                                                                <input type="text" id="sharetotalsumendorsement2" value="" name="sharetotalsumendorsement2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled placeholder="tsi(*total/sum from interest insured)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                                <input type="text"  id="sliprateendorsement" name="sliprateendorsement" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" placeholder="a &permil;" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""  style="opacity: 0;" >{{__('Total Rate') }}</label>
                                                                <input type="hidden" id="sliptotalrateendorsement" value="" name="sliptotalrateendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  placeholder="= a &permil; * sum y &permil; " />
                                                                <input type="text" id="sliptotalrateendorsement2" value="" name="sliptotalrateendorsement2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled placeholder="= a &permil; * sum y &permil; " />
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
                                                            <input type="text" id="slipbasicpremiumendorsement" name="slipbasicpremiumendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="a &permil; * tsi" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('Share')}}</label>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <input type="text"  id="slipshareendorsement" name="slipshareendorsement" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="b%" />
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
                                                                <label for="" style="opacity: 0;">{{__('slip sum share')}}</label>
                                                                <input type="hidden" id="slipsumshareendorsement" name="slipsumshareendorsement" placeholder="= b% * tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50"  />
                                                                <input type="text" id="slipsumshareendorsement2" name="slipsumshareendorsement2" placeholder="= b% * tsi" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" disabled/>
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
                                                                            <input type="text" id="slipcommissionendorsement" name="slipcommissionendorsement" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="d" />
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
                                                                <input type="hidden" id="slipsumcommissionendorsement" name="slipsumcommissionendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - d%)"  />
                                                                <input type="text" id="slipsumcommissionendorsement2" name="slipsumcommissionendorsement2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - d%)" disabled />
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
                                                                            <input type="text" id="slipvbrokerendorsement" name="slipvbrokerendorsement" value="0" class="form-control form-control-sm floatTextBox" data-validation="length" data-validation-length="0-50" placeholder="a" />
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
                                                                            <input type="hidden"  id="slipsumfeeendorsement" name="slipsumfeeendorsement"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="= a &permil; * b% * tsi * (100% - e%)" />
                                                                            <input type="text"  id="slipsumfeeendorsement2" name="slipsumfeeendorsement2"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" disabled placeholder="= a &permil; * b% * tsi * (100% - e%)" />
                                                                            
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
                                                                <input type="hidden" id="slipgrossprmtonrendorsement" name="slipgrossprmtonrendorsement" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                                <input type="text" id="slipgrossprmtonrendorsement2" name="slipgrossprmtonrendorsement2" class="form-control form-control-sm amount" data-validation="length" data-validation-length="0-50" placeholder="a &permil; * tsi * b% " disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Net Prm to NR')}}</label>
                                                                <input type="hidden" id="slipnetprmtonrendorsement" name="slipnetprmtonrendorsement" class="form-control form-control-sm amount" data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                                <input type="text" id="slipnetprmtonrendorsement2" name="slipnetprmtonrendorsement2" class="form-control form-control-sm amount" data-validation="length" placeholder="= a &permil; * b% * tsi * (100% - d% - e%)" data-validation-length="0-50" disabled/>
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
                                                                            <th>{{__('Percentage')}}</th>
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
                                                                                <input type="text" class="form-control form-control-sm datepicker-input tanggal" value="" data-target="#date" id="dateinstallmentdataendorsement" name="slipipdateendorsement">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="number" min="0" max="100" value="" step=".001"  id="slipippercentageendorsement" name="slipippercentageendorsement" placeholder="w" class="form-control form-control-sm " />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"  id="slipipamountendorsement" name="slipipamountendorsement" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" readonly/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"  id="sliptotalpercentinspanendorsement" name="sliptotalpercentinspanendorsement" hidden="true">
                                                                                    
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
                                                <div class="col-md-6 d-flex justify-content-start">
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
                                                                        <input type="text" id="slipsumorendorsement" value=""   name="slipsumorendorsement" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                                            <th>{{__('Type')}}</th>
                                                                            <th>{{__('Retrocession Contract')}}</th>
                                                                            <th>{{__('Percentage')}}</th>
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
                                                                                            <select id="sliprptypeendorsement" name="sliprptypeendorsement" class="form-control form-control-sm ">
                                                                                                <option selected disabled>{{__('Type list')}}</option>
                                                                                                <option value="NM XOL">NM XOL</option>
                                                                                            </select>
                                                                                        </div>  
                                                                                    </td>
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
                                                                                                        <input type="number" min="0" max="100" value="" step=".01" id="sliprppercentageendorsement" name="sliprppercentageendorsement" class="form-control form-control-sm " />
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
                                                                                            <input type="text" id="sliprpamountendorsement" name="sliprpamountendorsement" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" readonly/>
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
                                <div class="row">
                                
                                
                                </div>
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
            {{-- Edit Modal Ends --}}