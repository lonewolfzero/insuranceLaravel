
@extends('crm.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')

            @if($route_active == 'Marine Cargo - Slip Update')
                <form id="formmarineinsured">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-gray">
                            {{__('Insured')}}
                        </div>
                        
                        <div class="card-body bg-light-gray ">
                            
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                    <label for="">{{__('Number')}} </label>
                                                    <input type="text" name="mcnumber" id="mcnumber" class="form-control form-control-sm" data-validation="length" data-validation-length="1-25" value="{{ $insureddata->number }}" readonly="readonly" required/>
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
                                                                @foreach ($prefixinsured as $pi)
                                                                @if ($insureddata->prefix_id == $pi->id)
                                                                    <option value="{{ $pi->id }}" selected>{{ $pi->code }} - {{ $pi->name }}
                                                                    </option>
                                                                @else
                                                                    <!-- <option selected readonly>{{ __('Select Prefix') }}</option> -->
                                                                    <option value="{{ $pi->code }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                            <input type="text" value="{{ $insureddata->insured_name }}" id="autocomplete" name="msisuggestinsured" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="search for insured suggestion" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                            <input type="text" name="mcsuffix" id="autocomplete2" value="{{ $insureddata->insured_suffix }}" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="suffix: QQ or TBk" />
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
                                                                
        
                                                                @foreach ($routeship as $rs)
                                                                    @if ($insureddata->route == $rs->id)
                                                                        <option value="{{ $rs->id }}" selected>{{ $rs->name }} - {{ $rs->description }}
                                                                        </option>
                                                                    @else
                                                                        <!-- <option selected readonly>{{ __('Select Prefix') }}</option> -->
                                                                        <option value="{{ $rs->id }}">{{ $rs->name }} - {{ $rs->description }}</option>
                                                                    @endif
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" style="opacity: 0">{{__('b')}}</label>
                                                            <input type="text" id="mcroutefrom" value="{{ $insureddata->route_from }}" name="mcroutefrom" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="*from" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" style="opacity: 0">{{__('a')}}</label>
                                                            <input type="text" id="mcrouteto" name="mcrouteto" value="{{ $insureddata->route_to }}" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="*to" />
        
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
                                                                        <input type="text" id="mcsharefrom" value="{{ strval(number_format($insureddata->share_from, 3, '.', ',')) }}" name="mcsharefrom" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-350" readonly="readonly" />
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">{{__('All Ceding Share')}}</label>
                                                            <input type="text" id="mcshare" name="mcshare" value="{{ strval(number_format($insureddata->share, 3, '.', ',')) }}" class="form-control form-control-sm amount floatamount"  data-validation="length" data-validation-length="0-350" readonly="readonly" />
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">{{__('Currency')}}</label>
                                                            <select id="mccurrency" name="mccurrency" class="e1 form-control form-control-sm ">
                                                                <option  selected readonly value='placeholder'>{{__('Select Currency')}}</option>
                                                                
                                                                @foreach ($currency as $crc)
                                                                    @if ($insureddata->currency_id == $crc->id)
                                                                        <option value="{{ $crc->id }}" selected>{{ $crc->code }} -
                                                                        {{ $crc->symbol_name }}</option>
                                                                    @else
                                                                        <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="mckurs" class="form-control form-control-sm ">
                                                        </div> 
                                                    </div>
        
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">{{__('Total Sum Insured')}}</label>
                                                            <input type="text" id="mcshareto" name="mcshareto" value="{{ strval(number_format($insureddata->share_to, 3, '.', ',')) }}" class="form-control form-control-sm amount floatamount"  data-validation="length" data-validation-length="0-350" />
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
                                                            <table id="shipdetailTable" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('Ship Code')}}</th>
                                                                        <th>{{__('Ship Name')}}</th>
                                                                        <th width="20%">{{__('Actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($listship as $slt)
                                                                    <tr id="sid{{ $slt->id }}" data-name="shiplistvalue[]">
                                                                            <td data-name="{{ $slt->ship_code }}">{{ $slt->ship_code }}</td>
                                                                            <td data-name="{{ $slt->ship_name }}">{{ $slt->ship_name }}</td>
                                                                            <td>
                                                                                <a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="{{ $slt->id }}" data-target="#ModalAddInterestInsured">
                                                                                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#ModalAddInterestInsured2">Add</button>
                                                                                </a>
                                                                                <a href="javascript:void(0)" onclick="deleteshipdetail({{ $slt->id }})"><i class="fas fa-trash text-danger"></i></a></td>
                                                                    </tr>
                                                                    <tr id="iidid{{ $slt->id }}">
                                                                        <td></td>
                                                                        <td colspan="2">
                                                                            <table id="tiidid{{ $slt->id }}" width="600" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Interest Insured</th>
                                                                                        <th>Ceding Source</th>
                                                                                        <th>Credit Note/Debit Note</th>
                                                                                        <th>Certificate Number</th>
                                                                                        <th>Slip Number</th>
                                                                                        <th>Policy Number</th>
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
                                                                                        <td>@if ($detaillocrisk->cndn){{ $detaillocrisk->cndn }} @else - @endif</td>
                                                                                        <td>@if ($detaillocrisk->certno){{ $detaillocrisk->certno }}@else - @endif</td>
                                                                                        <td>@if ($detaillocrisk->slipno){{ $detaillocrisk->slipno }}@else - @endif</td>
                                                                                        <td>@if ($detaillocrisk->policyno){{ $detaillocrisk->policyno }}@else - @endif</td>
                                                                                        <td>{{ $detaillocrisk->percent }} %</td>
                                                                                        <td>@currency($detaillocrisk->amount)</td>
                                                                                        <td>
                                                                                            <a href="javascript:void(0)" onclick="deleteinterestdetail({{ $detaillocrisk->id }})"><i class="fas fa-trash text-danger"></i></a>
                                                                                        </td>
                                                                                    </tr>
        
                                                                                    @endforeach
        
                                                                                    @endif
                                                                                </tbody>
                                                                                <tr>
                                                                                        <th></th>
                                                                                        <th>All Ceding</th>
                                                                                        <th>Total Share %</th>
                                                                                        <th>Total Amount</th>
                                                                                </tr>
                                                                                @foreach($sumperceding as $spc)
                                                                                    <tr id="totalamount">
                                                                                    <td></td>
                                                                                    <td >{{$spc->name}}</td>
                                                                                    <td >{{strval(number_format($spc->percentage, 2, '.', ','))}}%</td>
                                                                                    <td >{{strval(number_format($spc->amountlocation, 2, '.', ','))}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        </td>
                                                                    </tr>   
                                                                    @endforeach
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
                                                      <input type="radio" class="form-check-input position-static" name="flag_overseas" id="local" value="0" 
                                                      {{ $insureddata->flag_overseas === 0 ? "checked" : "" }}
                                                      > <label for="local">{{__('Local')}}</label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input type="radio" class="form-check-input position-static" name="flag_overseas" id="overseas_checkbox" value="1" {{ $insureddata->flag_overseas === 1 ? "checked" : "" }}> <label for="overseas_checkbox" >Overseas</label>
                                                    </div>  
                                                  </div>  
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label>{{__('Business Type')}}</label>
                                                  <select class="form-control" name="business_id" id="business_id" required>
                                                    <option value selected disabled>Pilih</option>
                                                    @foreach ($business_type as $bt)
                                                      @if ($insureddata->business_id == $bt->id)
                                                        <option value="{{ $bt->id }}" selected>{{ $bt->name }}</option>
                                                      @else
                                                        <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                                      @endif
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
                                                            @if($insureddata->uy == date('Y'))
                                                            <option value="{{ $insureddata->uy }}" selected>{{ $insureddata->uy }}</option>
                                                            <option value="{{ intval(date('Y')) - 1 }}">{{ intval(date('Y')) - 1 }}</option>
                                                            @else if($insureddata->uy == (intval(date('Y')) - 1))
                                                            <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                                            <option value="{{ $insureddata->uy }}">{{ $insureddata->uy }}</option>
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="row">
                                            <div class="col-md-12 com-sm-12 mt-3">
                                                <button id="addinsuredsave-btn" class="btn btn-primary btn-block ">Update</button>
                                            </div>
                                        </div>
                                        
                            
                        </div>
                    </div>
                </form>
        
            @else 
                <form id="formmarineinsured">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-gray">
                            {{__('Insured')}}
                        </div>
                        
                        <div class="card-body bg-light-gray ">
                        
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
                                                            <input type="text" id="autocomplete" name="msisuggestinsured" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="search for insured suggestion" required/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                            <input type="text" name="mcsuffix" id="autocomplete2" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="suffix: QQ or TBk" />
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
                                                                        <input type="text" id="mcsharefrom" name="mcsharefrom" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-350" readonly="readonly" />
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">{{__('All Ceding Share')}}</label>
                                                            <input type="text" id="mcshare" name="mcshare" class="form-control form-control-sm amount floatamount"  data-validation="length" data-validation-length="0-350" readonly="readonly" />
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
                                                            <input type="text" id="mcshareto" name="mcshareto" class="form-control form-control-sm amount floatamount"  data-validation="length" data-validation-length="0-350" />
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
                                                            <table id="shipdetailTable" class="table table-bordered table-striped">
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
                                                                                        <th>Interest Insured</th>
                                                                                        <th>Ceding Source</th>
                                                                                        <th>Credit Note/Debit Note</th>
                                                                                        <th>Certificate Number</th>
                                                                                        <th>Slip Number</th>
                                                                                        <th>Policy Number</th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            @endif

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
                                        
                                        <label for="">{{__('Ship Code')}}</label><br>
                                        <select name="insshipcode" id="shipcodetxt" class="form-control form-control-sm e1">
                                            <option selected value="placeholder" disabled>{{__('Select Ship Code')}}</option>
                                            @foreach($mlu as $mrnlu)
                                                <option value="{{  $mrnlu->code }}">{{  $mrnlu->code  }} - {{ $mrnlu->shipname }}</option>
        
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-12 col-md-12">
                                    <div class="form-group">
                                    <label for="">{{__('Ship Name')}}</label>
                                    <input type="text" name="insshipname" id="shipnametxt" class="form-control" value="" />
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
                        <h5 class="modal-title">{{__('Interest Insured Detail')}}</h5>
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
                                    <label for="">{{__('Ceding Source')}}</label><br>
                                    <select id="mccedinglist" name="slipinterestlist" class="e1 form-control form-control-sm ">
                                        <option selected value="placeholder" disabled>{{__('Ceding list')}}</option>
                                        @foreach($cedinginsured as $cii)
                                            <option value="{{ $cii->id }}">{{ $cii->code }} - {{ $cii->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-md-12 col-md-12">
                                <div class="form-group">
                                    <label for="">{{__('Interest Insured')}}</label><br>
                                    <select id="mcinterestlist" name="slipinterestlist" class=" form-control form-control-sm e1">
                                        <option value="placeholder" selected disabled>{{__('Interest list')}}</option>
                                        @foreach($interestinsured as $ii)
                                            <option value="{{ $ii->id }}">{{ $ii->code }} - {{ $ii->description }}</option>
                                        @endforeach
                                    </select>
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
                                        <label for="">{{__('Policy Number')}}</label>
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
                                                    <input type="text" id="mcpercent" name="mcpercent"  class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50"  />
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
                                        <input type="text" id="mcamount" name="mcamount" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50"  />
                                    </div>
                                </div>
                            </div>
    
                        </div>
            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-info" id="addinterestinsured-btn">Add Interest Insured</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            @include('crm.transaction.facultative.slip_facultative')
        
        </div>
    </div>

        @include('crm.transaction.facultative.modal.modal_update')
@endsection

@section('scripts')
@include('crm.transaction.facultative.js.slip_facultative_js')
@include('crm.transaction.facultative.js.header_marine_cargo_js')
@endsection