@extends('crm.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="container-fluid">
         
        {{-- NOTE Show All Errors Here --}}
        @include('crm.layouts.error')
        
        <form id="formmarineinsured">
          @csrf
            <div class="card">
                <div class="card-header bg-gray">
                    {{__('Insured')}}
                </div>
                
                <div class="card-body bg-light-gray ">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <label for="">{{__('Number')}} </label>
                                            <input type="text" name="mcnumber" id="mcnumber" class="form-control form-control-sm" data-validation="length" data-validation-length="1-25" value="{{ $code_ms }}" readonly="readonly" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">{{__('Insured')}}</label>
                                                    <select name="mcprefix" id="mcprefix" class="e1 form-control form-control-sm ">
                                                        <option value="placeholder" selected disabled>{{__('Select Prefix')}}</option>
                                                        @foreach($prefixinsured as $pi)
                                                            <option value="{{ $pi->id }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                    <input type="text" id="autocomplete" name="msisuggestinsured" style="text-transform:uppercase;"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="search for insured suggestion" required/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                    <input type="text" name="mcsuffix" id="autocomplete2" style="text-transform:uppercase;"  class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="suffix: QQ or TBk" />
                                                    <label class="text-right label-max"> 0 / 300</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{__('Route')}}</label>
                                                    <select id="mcroute" name="msiroute" class="e1 form-control form-control-sm ">
                                                        <option value="placeholder" selected disabled>{{__('Select Route')}}</option>
                                                        @foreach($routeship as $rs)
                                                            <option value="{{ $rs->id }}">{{ $rs->name }} - {{ $rs->description }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" style="opacity: 0">{{__('b')}}</label>
                                                    <input type="text" id="mcroutefrom" name="mcroutefrom" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="*from" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" style="opacity: 0">{{__('a')}}</label>
                                                    <input type="text" id="mcrouteto" name="mcrouteto" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="*to" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('NASIONAL RE Share')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden" id="mcsharefrom" name="mcsharefrom" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-350"  />
                                                                <input type="text" id="mcsharefrom2" name="mcsharefrom2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-350" disabled/>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('All Ceding Share')}}</label>
                                                    <input type="hidden" id="mcshare" name="mcshare" class="form-control form-control-sm money text-left"  data-validation="length" data-validation-length="0-350" />
                                                    <input type="text" id="mcshare2" name="mcshare2" class="form-control form-control-sm money text-left"  data-validation="length" data-validation-length="0-350" disabled/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Currency')}}</label>
                                                    <select id="mccurrency" name="mccurrency" class="e1 form-control form-control-sm ">
                                                        <option  selected readonly value='placeholder'>{{__('Select Currency')}}</option>
                                                        @foreach($currency as $crc)
                                                        <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} - {{ $crc->month }} {{ $crc->year }} -  Rp : @currency($crc->kurs)</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="mckurs" class="form-control form-control-sm ">
                                                </div> 
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Total Sum Insured')}}</label>
                                                    <input type="text" id="mcshareto" name="mcshareto" class="form-control form-control-sm money text-left"  data-validation="length" data-validation-length="0-350" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-header bg-gray">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{__('Ship Detail')}}
                                                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#ModalAddShip">{{__('Add Ship')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 com-sm-12 mt-3">
                                                    <table id="shipdetailTable" id="" class="table table-bordered table-striped">

                                                        <thead>
                                                            <tr>
                                                                <th>{{__('Ship Code')}}</th>
                                                                <th>{{__('Ship Name')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($shiplist as $slt)
                                                             <tr id="sid{{ $slt->id }}" data-name="shiplistvalue[]">
                                                                    <td data-name="{{ $slt->ship_code }}">{{ $slt->ship_code }}</td>
                                                                    <td data-name="{{ $slt->ship_name }}">{{ $slt->ship_name }}</td>
                                                                    <td>
                                                                        <a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="{{ $slt->id }}" data-target="#ModalAddInterestInsured">
                                                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#ModalAddInterestInsured">Add</button>
                                                                        </a>
                                                                        <a href="javascript:void(0)" onclick="deleteshipdetail({{ $slt->id }})"><i class="fas fa-trash text-danger"></i></a></td>
                                                             </tr>
                                                             <tr id="iidid{{ $slt->id }}">
                                                                <td colspan="3">
                                                                    <table id="tiidid{{ $slt->id }}" width="600" class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Insurable Interest </th>
                                                                                <th>Ceding Source</th>
                                                                                <th>Credit Note/Debit Note</th>
                                                                                <th>Certificate Number</th>
                                                                                <th>Slip Number</th>
                                                                                <th>Policy No</th>
                                                                                <th>Percentage</th>
                                                                                <th>Amount</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbiidid{{ $slt->id }}">
                                                                          
                                                                            @if(!empty($slt->interestinsureddetail))
                                                                            

                                                                            @foreach($slt->interestinsureddetail as $detaillocrisk)

                                                                            <tr id="intinsdetail{{ $detaillocrisk->id }}">
                                                                                <td>{{ $detaillocrisk->interestdetail->code }} - {{ $detaillocrisk->interestdetail->description }}</td>
                                                                                <td>{{ $detaillocrisk->cedingdetail->name }}</td>
                                                                                <td>{{ $detaillocrisk->cndn }}</td>
                                                                                <td>{{ $detaillocrisk->certno }}</td>
                                                                                <td>{{ $detaillocrisk->slipno }}</td>
                                                                                <td>{{ $detaillocrisk->policyno }}</td>
                                                                                <td>{{ $detaillocrisk->percentage }}</td>
                                                                                <td>@currency($detaillocrisk->amountlocation)</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)" onclick="deletelocationriskdetail({{ $detaillocrisk->id }})"><i class="fas fa-trash text-danger"></i></a>
                                                                                </td>
                                                                            </tr>

                                                                            @endforeach

                                                                            @endif
                                                                        </tbody>
                                                                        <tr>
                                                                              <th></th>
                                                                              <th>Ceding</th>
                                                                              <th>Total Share %</th>
                                                                              <th>Total Amount</th>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>   
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <table id="shipdetailTable2" id="" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Ceding</th>
                                                                <th>Share</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <!-- Bussiness -->
                        
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="card card-primary">
                                          <div class="card-header bg-gray">{{__('Business')}}</div>
                                          <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-4 col-offsets-4">
                                                <div class="form-group">
                                                  <label>&nbsp;</label>
                                                  <br>
                                                  <div class="form-check form-check-inline">
                                                    <label>{{__('Business Source')}}</label>
                                                    <div class="form-check">
                                                      <input type="radio" class="form-check-input position-static" name="flag_overseas" id="local" value="0" checked> <label for="local">{{__('Local')}}</label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input type="radio" class="form-check-input position-static" name="flag_overseas" id="overseas_checkbox" value="1"> <label for="overseas_checkbox" >Overseas</label>
                                                    </div>  
                                                  </div>  
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>{{__('Business Type')}}</label>
                                                  <select class="form-control" name="business_id" id="business_id" required>
                                                    <option value selected disabled>Pilih</option>
                                                    @foreach($business_type as $bt)
                                                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- END Bussiness -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('UY')}}</label>
                                            <select id="mcuy" name="mcuy" class="form-control form-control-sm ">
                                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                                <option value="{{ (intval(date('Y')) - 1) }}">{{ (intval(date('Y')) - 1) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 com-sm-12 mt-3">
                                        <button id="addinsuredsave-btn" class="btn btn-primary btn-block ">Save</button>
                                    </div>
                                </div>
                                
                    
                </div>
            </div>
        </form>

        <div class="modal fade" id="ModalAddShip" tabindex="-1" user="dialog" aria-hidden="true">
            <div class="modal-dialog" user="document">
                <div class="modal-content bg-light-gray">
                <div class="modal-header bg-gray">
                    <h5 class="modal-title">{{__('Ship Detail')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-addship" >
                    @csrf
                    <div class="modal-body">
                            <div class="col-md-12 col-md-12">
                                <div class="form-group">
                                    
                                    <label for="">{{__('Ship')}}</label><br>
                                    <div class="input-group">
                                    
                                    <select name="shipcodetxt" id="shipcodetxt" class="form-control e1" style="width: 90%;">
                                        <option value="" disabled selected>Ship</option>
                                        @foreach($mlu as $mrnlu)
                                            <option value="{{  $mrnlu->code }}">{{  $mrnlu->code  }} - {{ $mrnlu->shipname }}</option>

                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btnRefreshShip"><i class="fa fa-history" aria-hidden="true" ></i></button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-info" id="addship-btn">Add Ship</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="ModalAddInterestInsured" tabindex="-1" user="dialog" aria-hidden="true">
            <div class="modal-dialog" user="document">
                <div class="modal-content bg-light-gray">
                <div class="modal-header bg-gray">
                    <h5 class="modal-title">{{__('Insurable Interest  Detail')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addinterestinsured" >
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Ship Id')}}</label>
                                    <input type="text" id="mcshiplistid" name="mcshiplistid" class="form-control form-control-sm" value="" readonly/>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-12 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Ceding')}}</label>
                                <div class="input-group">
                                    
                                    <select id="mhcedinglist" name="mhcedinglist" class="e1 form-control form-control-sm " style="width: 90%;">
                                    <option value="" disabled selected>Ceding</option>
                                    @foreach($cedinginsured as $cii)
                                        <option value="{{ $cii->id }}">{{ $cii->code }} - {{ $cii->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btnRefreshCeding"><i class="fa fa-history" aria-hidden="true" ></i></button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Insurable Interest ')}}</label>
                                <div class="input-group">
                                    <select id="mcinterestlist" name="slipinterestlist" class=" form-control form-control-sm e1" style="width:90%">
                                    <option value="placeholder" selected disabled>{{__('Interest list')}}</option>
                                    @foreach($interestinsured as $ii)
                                        <option value="{{ $ii->id }}">{{ $ii->code }} - {{ $ii->description }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btnInsurableList"><i class="fa fa-history" aria-hidden="true" ></i></button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Credit Note/Debit Note')}}</label>
                                    <input type="text" id="mccndn" name="mccndn" class="form-control form-control-sm" value="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Certificate Number')}}</label>
                                    <input type="text" id="mccertno" name="mccertno" class="form-control form-control-sm" value="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Slip Number')}}</label>
                                    <input type="text" id="mcslipno" name="mcslipno" class="form-control form-control-sm" value="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Policy No')}}</label>
                                    <input type="text" id="mcpolicyno" name="mcpolicyno" class="form-control form-control-sm" value="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Percentage')}}</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group" lang="en-US">
                                                <input type="text" id="mcpercent" name="mcpercent"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Amount')}}</label>
                                    <input type="text" id="mcamount" name="mcamount" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                </div>
                            </div>
                        </div>

                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-info" id="addinterestinsured-btn">Add Insurable Interest </button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <div class="card ">
            <div class="card-header bg-gray">
                {{__('Slip Detail')}}
            </div>
            <div class="card-body">
                <table id="SlipInsuredTableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{__('Number')}}</th>
                            <th>{{__('Ceding/Broker')}}</th>
                            <th>{{__('Ceding Source')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Endorsement')}}</th>
                            <th width="20%">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                    <!--  -->
                        </tbody>

                  </table>


                </div>
        </div>

        <div class="modal fade" id="cancelmodaldata" tabindex="-1" user="dialog" aria-labelledby="cancelmodalLabel" aria-hidden="true">
            <div class="modal-dialog" user="document">
                <div class="modal-content bg-light-gray">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title" id="cancelmodalLabel">{{__('Cancel')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                        <form id="form-cancelstatus">
                        @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-md-12">
                                        <input type="hidden" name="slipnumberdetail" id="slipnumberdetail">
                                        <input type="hidden" name="slipiddetail" id="slipiddetail">
                                        <div class="form-group">
                                            <label for="">{{__('Remarks')}}</label>
                                            <textarea id="remarkscancelcargo" name="remarkscancelcargo" class="form-control form-control-sm" placeholder="">
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                <button type="submit" class="btn btn-info" id="cancelmodal-btn">Confirm</button>
                            </div>
                        </form>     
                </div>
            </div>
        </div>
            


        <div class="card ">
            <div class="card-header bg-gray">
                {{__('Slip Detail')}}
            </div>
            
            <div class="card-body bg-light-gray">
                <div class="container-fluid p-3">

                        <form id="multi-file-upload-ajax" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="card card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

                                        <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                                        
                                        <li class="nav-item " href="#general-details-id-tabpanel">
                                            <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id-tabpanel" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                                        </li>
                                        
                                        <li class="nav-item" href="#insured-details-id-tabpanel">
                                            <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id-tabpanel" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                                        </li>
                                        
                                        <li class="nav-item" href="#installment-details-id-tabpanel">
                                            <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id-tabpanel" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body bg-light-gray">
                                    <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
                                        
                                        <div class="tab-pane fade show active" id="general-details-id-tabpanel"  role="tabpanel" aria-labelledby="general-details">
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="slipmsinumber" id="slipmsinumber" value="{{ $code_ms }}">
                                                            <label for="">{{__('Number')}} </label>
                                                            <input type="text" id="slipnumber" name="slipnumber" class="form-control form-control-sm" data-validation="length" data-validation-length="0-25" value="{{ $code_sl }}" readonly="readonly" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Username')}}</label>
                                                                <input type="text" id="slipusername" name="slipusername" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="{{Auth::user()->name}}" readonly="readonly" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>{{__('Prod Date')}}:</label>
                                                                    <div class="input-group " >
                                                                    <input type="hidden" id="slipprodyear" class="form-control form-control-sm "  name="slipprodyear" value="{{ $currdate }}" >
                                                                    <input type="text" id="slipprodyear2" class="form-control form-control-sm "  name="slipprodyear2" value="{{ $currdate }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Transfer Date')}}</label>
                                                                <input type="hidden" id="sliptd" name="sliptd" class="form-control form-control-sm datetimepicker-input" data-validation="length"  data-validation-length="0-50" />
                                                                <input type="text" id="sliptd2" name="sliptd" class="form-control form-control-sm datetimepicker-input" data-validation="length"  data-validation-length="0-50" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">{{__('Status')}}</label>
                                                            <input type="text" id="slipstatus" name="slipstatus" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="proposal" readonly="readonly"/>
                                                        </div>    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            {{-- <div class="form-group">
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="" class="d-flex justify-content-center" style="opacity: 0;">{{__('Endorsement / Selisih')}}</label>
                                                                        <label for="" class="d-flex justify-content-center">{{__('Endorsement / Selisih')}}</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="" class="d-flex justify-content-center" style="opacity: 0;">{{__('Endorsement / Selisih')}}</label>
                                                                        <input type="text" id="sliped" name="sliped" class="form-control form-control-sm " data-validation="length" value="0" readonly="readonly" data-validation-length="0-50"/>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="" class="d-flex justify-content-center" style="opacity: 0;">{{__('Endorsement / Selisih')}}</label>
                                                                        <input type="text" id="slipsls" name="slipsls" class="form-control form-control-sm " data-validation="length" value="0" readonly="readonly" data-validation-length="0-50"/>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="slipStatusTable" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('Status')}}</th>
                                                                    <th>{{__('Datetime')}}</th>
                                                                    <th>{{__('User')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($statuslist as $stl)
                                                                 <tr id="sid{{ $stl->id }}" data-name="shiplistvalue[]">
                                                                        <td data-name="{{ $stl->id }}">{{ $stl->status }}</td>
                                                                        <td data-name="{{ $stl->datetime }}">{{ date('d/m/Y H:i:s',$stl->datetime) }}</td>
                                                                        <td data-name="{{ $stl->user }}">{{ $stl->user }}</td>
                                                                 </tr>   
                                                                @endforeach
                                                            </tbody>
                                                            
                                                            </table>
                                                            <i class="fa fa-info-circle" style="color: grey;" hidden="true"> Data is Transferred!</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">{{__('Ceding/Broker')}}</label>
                                                        <select id="slipcedingbroker" name="slipcedingbroker" class="e1 form-control form-control-sm ">
                                                            <option value="placeholder"  disabled selected>Ceding or Broker</option>
                                                            @foreach($broker as $cb)
                                                                <option value="{{ $cb->id }}">{{ $cb->code }} - {{ $cb->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>    
                                                    <div class="form-group">
                                                        <label for="">{{__('Source')}}</label>
                                                        <select id="slipceding" name="slipceding" class="e1 form-control form-control-sm ">
                                                            <option value="placeholder" disabled selected>Ceding </option>
                                                            {{-- @foreach($ceding as $cd)
                                                                <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">{{__('COB')}}</label>
                                                            <select id="slipcob" name="slipcob" class="e1 form-control form-control-sm select2">
                                                                <option value="placeholder" selected disabled>{{__('COB list')}}</option>
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
                                                            <select id="slipkoc" name="slipkoc" class="e1 form-control form-control-sm ">
                                                                <option value="placeholder" selected disabled>{{__('KOC list')}}</option>
                                                                @foreach($koc as $cok)
                                                                    <option value="{{ $cok->id }}">{{ $cok->code }} - {{ $cok->description }}</option>
                                                                @endforeach
                                                            </select>
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
                                                                    <input type="text"  id="wpc" name="wpc" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-150" placeholder="" />
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
                                                                <input type="file" name="files[]" id="attachment" class="form-control" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">{{__('Remarks')}}</label>
                                                        <textarea type="text"  id="remarks" name="remarks" class="form-control form-control-sm" placeholder="" ></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="insured-details-id-tabpanel"  role="tabpanel" aria-labelledby="insured-details">
                                            
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('TSI/Ceding Share') }}</label>
                                                                <select id="sliptypetsi" name="sliptype" class="form-control form-control-sm ">
                                                                    <option value="placeholder" selected disabled>{{__('Select Share')}}</option>
                                                                    <option value="1">Total Sum Insured</option>
                                                                    <option value="2">Ceding Share</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""  >{{__('TSI/Ceding Share Value') }}</label>
                                                                <input type="hidden" id="sliptotalsum" value="" name="sliptotalsum" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                                <input type="text" id="sliptotalsum2" value="" name="sliptotalsum2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
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
                                                                <select id="sliptype" name="sliptype" class="form-control form-control-sm ">
                                                                    {{-- <option value="placehoder" selected disabled>{{__('Select Type')}}</option> --}}
                                                                    <option value="PML" selected >PML</option>
                                                                    <option value="LOL">LOL</option>
                                                                    <option value="TSI">TSI</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="" style="opacity: 0;">{{__('Type')}}</label>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <input type="text" id="slippct" name="slippct" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="pct" />
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
                                                                <input type="hidden"  id="sliptotalsumpct" name="sliptotalsumpct" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-150"   />
                                                                <input type="text"  id="sliptotalsumpct2" name="sliptotalsumpct2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-150"  disabled />
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
                                                                        <table id="deductiblePanel" class="table table-bordered table-striped">
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
                                                                                <tr>
                                                                                    @foreach($deductiblelist as $dtt)
                                                                                        <tr id="ddtid{{ $dtt->id }}">
                                                                                                <td data-name="{{ $dtt->deductible_id }}">{{ $dtt->DeductibleType->abbreviation }} - {{ $dtt->DeductibleType->description }}</td>
                                                                                                <td data-name="{{ $dtt->percentage }}">{{ $dtt->percentage }}</td>
                                                                                                <td data-name="{{ $dtt->amount }}">@currency($dtt->amount)</td>
                                                                                                <td data-name="{{ $dtt->min_claimamount }}">@currency($dtt->min_claimamount)</td>
                                                                                                <td><a href="javascript:void(0)" onclick="deletedeductibletype({{ $dtt->id }})">delete</i></a></td>
                                                                                        </tr>   
                                                                                    @endforeach
                                                                                </tr>
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td >
                                                                                        <div class="form-group">
                                                                                            <select id="slipdptype" name="slipdptype" class="form-control form-control-sm ">
                                                                                                <option value="placeholder" selected disabled>{{__('Type')}}</option>
                                                                                                @foreach($deductibletype as $dt)
                                                                                                <option value="{{ $dt->id }}">{{ $dt->abbreviation }} - {{ $dt->description }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <input type="text" id="slipdppercentage" name="slipdppercentage" placeholder="x" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                                            <div class="input-group-append">
                                                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input type="hidden" id="slipdpamount" name="slipdpamount" placeholder="=x*tsi" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                                            <input type="text" id="slipdpamount2" name="slipdpamount2" placeholder="=x*tsi" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled />
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input type="text"   id="slipdpminamount" name="slipdpminamount" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                                        </div>
                                                                                    </td> 
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <button type="button" id="adddeductibleinsured-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tfoot>
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
                                                            {{__('Condition Needed')}}
                                                        </div>
                                                        <div class="card-body bg-light-gray ">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-12 com-sm-12 mt-3">
                                                                        <table id="conditionNeeded" class="table table-bordered table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>{{__('Condition Needed Code - Name')}}</th>
                                                                            <th>{{__('Information')}}</th>
                                                                            <th width="20%">{{__('Actions')}}</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($conditionneededlist as $cnt)
                                                                                <tr id="cnid{{ $cnt->id }}">
                                                                                        <td data-name="{{ $cnt->condition_id }}">{{ $cnt->conditionneeded->name }} - {{ $cnt->conditionneeded->description }}</td>
                                                                                        <td data-name="{{ $cnt->information }}">@if($cnt->information == null)
                                                                                                - 
                                                                                            @else
                                                                                                {{ $cnt->information }}
                                                                                            @endif
                                                                                        </td>
                                                                                        <td><a href="javascript:void(0)" onclick="deleteconditionneeded({{ $cnt->id }})">delete</i></a></td>
                                                                                </tr>   
                                                                            @endforeach
                                                                            <tr>
                                                                                <form id="addconditionneeded">
                                                                                    @csrf
                                                                                    <td colspan="2">
                                                                                        <div class="form-group">
                                                                                            <select id="slipcncode" name="slipcncode" class="e1 form-control form-control-sm ">
                                                                                                <option selected value="placeholder" disabled>{{__('Condition Needed Code - Name - Information List')}}</option>
                                                                                                @foreach($cnd as $ncd)
                                                                                                <option value="{{ $ncd->id }}">{{ $ncd->code }} - {{ $ncd->name }} - {{ $ncd->description }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>  
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <button type="button" class="btn btn-md btn-primary" id="addconditionneeded-btn">{{__('Add')}}</button>
                                                                                        </div>
                                                                                    </td>
                                                                                </form>
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
                                                                <input type="text" class="form-control form-control-sm tanggal" data-target="#date" id="slipipfrom" name="slipipfrom" maxlength = "10">
                                                                    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label style="opacity: 0;">{{__('p')}}:</label>
                                                            <p class="d-flex justify-content-center">to</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                                <input type="text" class="form-control form-control-sm datepicker-input tanggal" data-target="#date" id="slipipto" maxlength = "10" name="slipipto" >
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>{{__('Reinsurance Periode')}}:</label>
                                                                <input type="text" class="form-control form-control-sm datetimepicker-input tanggal" data-target="#date" id="sliprpfrom" maxlength = "10" name="sliprpfrom" >
                                                                    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label style="opacity: 0;">{{__('p')}}:</label>
                                                            <p class="d-flex justify-content-center">to</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label style="opacity: 0;">{{__('p')}}:</label>
                                                                    <input type="text" class="form-control form-control-sm datetimepicker-input tanggal" data-target="#date" id="sliprpto" maxlength = "10" name="sliprpto" >
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Total Days')}}</label>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <input type="hidden"  id="slipdaytotal" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                                        <input type="text"  id="slipdaytotal2" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <h2>/</h2>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <input type="hidden"  id="slipdaytotal3" name="slipdaytotal" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                                        <input type="text"  id="slipdaytotal4" name="slipdaytotal2" class="form-control form-control-sm intTextBox" data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                                    </div>
                                                                </div>                                                                       
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">{{__('Total Summary Insurance Periode')}}</label>
                                                                <input type="hidden"  id="sliptotalsumdate" name="sliptotalsumdate" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a"  />
                                                                <input type="text"  id="sliptotalsumdate2" name="sliptotalsumdate2" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="a" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                            <div class="row d-flex justify-content-start">
                                                <i class="fa fa-info-circle" style="color: grey;" id="labelnp" aria-hidden="true"> non proportional panel</i>
                                            </div>

                                            <div class="row d-flex justify-content-end">
                                                <div class="col-md-4">
                                                    <label class="cl-switch cl-switch-green">
                                                        <span for="switch-proportional" class="label"> {{__('Proportional')}} </span>
                                                        <input type="checkbox" name="slipproportional[]" value="1" id="switch-proportional"
                                                        class="submit" checked>
                                                        <span class="switcher"></span>
                                                        <span  class="label"> {{__('Non Proportional')}} </span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group d-flex justify-content-end">
                                                        <label style="opacity: 0;">{{__('p')}}:</label>
                                                        <button type="button" class="btn plus-button" id="btnaddlayer" data-toggle="modal" data-target="#addLayerModal">
                                                            <span data-toggle="tooltip" data-placement="top" title="{{__('Add New layer')}}"> + add layer </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="" id="labelnonprop">{{__('Layer for non proportional')}}</label>
                                                        <select id="sliplayerproportional" name="sliplayerproportional" class="form-control form-control-sm ">
                                                            <option value="placeholder" selected disabled>{{__('Choose layer')}}</option>
                                                            <option value="Layer 1">Layer 1</option>
                                                            <option value="Layer 2">Layer 2</option>
                                                            <option value="Layer 3">Layer 3</option>
                                                            <option value="Layer 4">Layer 4</option>
                                                            <option value="Layer 5">Layer 5</option>
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
                                                                <select id="sharetypetsi" name="sharetypetsi" class="form-control form-control-sm ">
                                                                    <option value="placeholder" selected disabled>{{__('Select Share')}}</option>
                                                                    <option value="1">Total Sum Insured</option>
                                                                    <option value="2">Ceding Share</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" >{{__('TSI/Ceding Share Value') }}</label>
                                                                <input type="hidden" id="sharetotalsum" value="" name="sharetotalsum" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"   />
                                                                <input type="text" id="sharetotalsum2" value="" name="sharetotalsum2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('Rate (%)')}}</label>
                                                                <div class="input-group">
                                                                    <input type="text"  id="sliprate" name="sliprate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="" />
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""  >{{__('Total Rate') }}</label>
                                                                <input type="hidden" id="sliptotalrate" value="" name="sliptotalrate" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  placeholder="= a %; * sum y %; " />
                                                                <input type="text" id="sliptotalrate2" value="" name="sliptotalrate2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled placeholder="= a %;(rate)" />
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
                                                            <input type="text" id="slipbasicpremium" name="slipbasicpremium" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a%; * tsi" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{__('Share to NR')}}</label>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-group">
                                                                            <input type="text"  id="slipshare" name="slipshare" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
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
                                                                <input type="hidden" id="slipsumshare" name="slipsumshare"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
                                                                <input type="text" id="slipsumshare2" name="slipsumshare2"  class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
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
                                                                            <input type="text" id="slipcommission" name="slipcommission" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50"  />
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
                                                                <input type="hidden" id="slipsumcommission" name="slipsumcommission" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="= a %; * b% * tsi * (100% - d%)"  />
                                                                <input type="text" id="slipsumcommission2" name="slipsumcommission2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="= a %; * b% * tsi * (100% - d%)" />
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
                                                                            <input type="text" id="slipvbroker" name="slipvbroker" value="0" class="form-control form-control-sm money text-left money text-left" data-validation="length" data-validation-length="0-50" placeholder="a" />
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
                                                                            <input type="hidden"  id="slipsumfee" name="slipsumfee"  class="form-control form-control-sm money text-left money text-left" data-validation="length" data-validation-length="0-50" placeholder="= a %; * b% * tsi * (100% - e%)" />
                                                                            <input type="text"  id="slipsumfee2" name="slipsumfee"  class="form-control form-control-sm money text-left money text-left" data-validation="length" data-validation-length="0-50" placeholder="= a %; * b% * tsi * (100% - e%)" />
                                                                            
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
                                                                <input type="hidden" id="slipgrossprmtonr" name="slipgrossprmtonr" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a%  * tsi * b%"  />
                                                                <input type="text" id="slipgrossprmtonr2" name="slipgrossprmtonr2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="a%; * tsi * b% " disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{__('Net Prm to NR')}}</label>
                                                                <input type="hidden" id="slipnetprmtonr" name="slipnetprmtonr" class="form-control form-control-sm money text-left" data-validation="length" placeholder="=a %;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                                <input type="text" id="slipnetprmtonr2" name="slipnetprmtonr2" class="form-control form-control-sm money text-left" data-validation="length" placeholder="= a %; * b% * tsi * (100% - d% - e%)" data-validation-length="0-50" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="installment-details-id-tabpanel"  role="tabpanel" aria-labelledby="installment-details">
                                            
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
                                                                        <table id="installmentPanel" class="table table-bordered table-striped">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>{{__('Installment Date')}}</th>
                                                                                <th>{{__('Percentage')}}</th>
                                                                                <th>{{__('Amount')}}</th>
                                                                                <th width="20%">{{__('Actions')}}</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($installmentlist as $isp)
                                                                                    <tr id="ispid{{ $isp->id }}">
                                                                                            <td data-name="{{ $isp->installment_date }}">{{ $isp->installment_date }}</td>
                                                                                            <td data-name="{{ $isp->percentage }}">{{ $isp->percentage }}</td>
                                                                                            <td data-name="{{ $isp->amount }}">@currency( $isp->amount)</td>
                                                                                            <td><a href="javascript:void(0)" onclick="deleteinstallmentpanel({{ $isp->id }})">delete</i></a></td>
                                                                                    </tr>   
                                                                                @endforeach
                                                                                
                                                                            </tbody>
                                                                            <tfoot>
                                                                                    <tr>
                                                                                        <form id="addinstallmentinsured">
                                                                                            @csrf
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group" id="dateinstallment" >
                                                                                            <input type="text" id="slipipdate" class="form-control form-control-sm datetimepicker-input tanggal" maxlength = "10" name="slipipdate" >
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <input type="text"  id="slipippercentage" name="slipippercentage" placeholder="w" class="form-control form-control-sm money text-left"/>
                                                                                        <div class="input-group-append">
                                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" id="slipipamount" name="slipipamount" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" />
                                                                                        <!-- <input type="text" id="slipipamount2" name="slipipamount2" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" /> -->
                                                                                    </div>
                                                                                </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <input type="text" id="sliptotalpercentinspan" class="money text-left" name="sliptotalpercentinspan" hidden="true" >
                                                                                                    <input type="text" id="sliptotalamountinspan" class="money text-left" name="sliptotalamountinspan" hidden="true" >
                                                                                                    
                                                                                                    <button type="button" id="addinstallmentinsured-btn"  class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                                                </div>
                                                                                            </td>
                                                                                        </form>
                                                                                    </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" id="sliprb" name="sliprb" value="YES">
                                            <input type="hidden" id="retropercent" name="retropercent">
                                            <input type="hidden" id="slipsumor"  name="slipsumor" class="form-control form-control-sm money text-left " />
                                            <input type="hidden" id="slipor" value="100" name="slipor" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                            <!-- <div class="row">
                                                <div class="col-md-6 d-flex justify-content-start">
                                                    <div class="form-group">
                                                        <label for="">{{__('Retro Backup?')}}</label>
                                                        <select id="sliprb" name="sliprb" class="form-control form-control-sm ">
                                                            {{-- <option selected disabled>{{__('Select Continent')}}</option> --}}
                                                            <option value="NO" selected>NO</option>
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
                                                                        <input type="number" value="100" step=".0001" id="slipor" name="slipor" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" id="slipsumor" name="slipsumor" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" placeholder="= x% * b% * tsi" readonly="readonly" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                        <div class="row" id="tabretro">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-gray">
                                        {{__('Retrocession Panel')}}
                                    </div>
                                    <div class="card-body bg-light-gray ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12 com-sm-12 mt-3">
                                                    <table id="retrocessionPanel" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>{{__('Type')}}</th> -->
                                                                <th>{{__('Retrocession Contract')}}</th>
                                                                <th>{{__('Percentage %')}}</th>
                                                                <th>{{__('Amount')}}</th>
                                                                <th width="20%">{{__('Actions')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($retrocessionlist as $rsc)
                                                                <tr id="rscid{{ $rsc->id }}">
                                                                       <!--  <td data-name="{{ $rsc->type }}">{{ $rsc->type }}</td> -->
                                                                        <td data-name="{{ $rsc->contract }}">{{ $rsc->contract }}</td>
                                                                        <td data-name="{{ $rsc->percentage }}">{{ $rsc->percentage }}</td>
                                                                        <td data-name="{{ $rsc->amount }}">@currency( $rsc->amount)</td>
                                                                        <td><a href="javascript:void(0)" onclick="deleteretrocessiontemp({{ $rsc->id }})">delete</i></a></td>
                                                                </tr>   
                                                            @endforeach
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <!-- <td>
                                                                    <div class="form-group">
                                                                        <select id="sliprptype" name="sliprptype" class="form-control form-control-sm ">
                                                                            <option value="placeholder" selected disabled>{{__('Type list')}}</option>
                                                                            <option value="NM XOL">NM XOL</option>
                                                                        </select>
                                                                    </div>  
                                                                </td> -->
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select id="sliprpcontract" name="sliprpcontract" class="form-control form-control-sm ">
                                                                            <option value="placeholder" selected disabled>{{__('Contract list')}}</option>
                                                                            <option selected disabled>{{__('Contract list')}}</option><option value="OWN RETENTION">OWN RETENTION</option>
                                                                            <option value="20NM11110">20NM11110</option>
                                                                            <option value="20ABC">20ABC</option>
                                                                        </select>
                                                                    </div>  
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                    <input type="text" id="sliprppercentage" name="sliprppercentage" class="form-control form-control-sm money text-left" />
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
                                                                        <input type="hidden" id="sliprpamount" name="sliprpamount" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" />
                                                                        <input type="text" id="sliprpamount2" name="sliprpamount2" placeholder="= w% * net premium to NR" class="form-control form-control-sm money text-left" disabled/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="sliptotalpercentrpor" value="0" name="sliptotalpercentrpor">
                                                                        <button type="button" id="addretrocessioninsured-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
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
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <button type="submit" id="addslipsave-btn" class="btn btn-primary btn-block ">
                                                                {{__('Save')}}
                                                            </button>
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
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tabbottom" role="tablist">
                                        
                                        <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                                        
                                        <li class="nav-item active" href="#general-details-id-tabpanel">
                                            <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id-tabpanel" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                                        </li>

                                        <li class="nav-item" href="#insured-details-id-tabpanel">
                                            <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id-tabpanel" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                                        </li>
                                        
                                        <li class="nav-item" href="#installment-details-id-tabpanel">
                                            <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id-tabpanel" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            
                        </form>
                </div>
                    
            </div>

                

        </div> 

    </div>
</div>

@include('crm.transaction.marine_slipmodaldetail')
@include('crm.transaction.marine_slipmodalendorsement')
@include('crm.transaction.marine_slipmodalupdate')

@endsection

@section('scripts')
@include('crm.transaction.marine_slip_js')
@endsection