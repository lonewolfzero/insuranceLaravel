
@extends('crm.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')

            @if($route_active == 'Personal Accident - Slip Update')
                <form method="POST" id="formpainsured" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
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
                                            <input type="text" id="insuredIDtxt" name="panumber" class="form-control form-control-sm" value="{{ $insureddata->number }}" data-validation="length" data-validation-length="0-16" readonly="readonly" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">{{__('Insured')}}</label>
                                                    <select id="paprefix" name="paprefix" class="form-control form-control-sm ">
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
                                                    <input type="text" id="autocomplete" name="pasuggestinsured" value="{{ $insureddata->insured_name }}" style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="search for insured suggestion" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                    <input type="text" id="autocomplete2" name="pasuffix" value="{{ $insureddata->insured_suffix }}" style="text-transform:uppercase;" class="form-control form-control-sm " maxlength="300" data-validation="length" data-validation-length="0-300" placeholder="suffix: QQ or TBk" />
                                                    <label class="text-right label-max"> 0 / 300</label>
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
                                                    <input type="hidden" id="pasharefrom" name="pasharefrom" value="{{ strval(number_format($insureddata->share_from, 2, '.', ',')) }}" class="form-control form-control-sm money text-left" data-validation="length" readonly="readonly" data-validation-length="0-50" required/>
                                                    <input type="text" id="pasharefrom2" name="pasharefrom" value="{{ strval(number_format($insureddata->share_from, 2, '.', ',')) }}" class="form-control form-control-sm money text-left" data-validation="length" readonly="readonly" data-validation-length="0-50" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('All Ceding Share')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="pashare" name="pashare" value="{{ strval(number_format($insureddata->share, 2, '.', ',')) }}" class="form-control form-control-sm money text-left" data-validation="length" readonly="readonly" data-validation-length="0-50" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Currency')}}</label>
                                                    <select id="pacurrency" name="pacurrency" class="e1 form-control form-control-sm ">
                                                        <option selected readonly value='0'>{{__('Select Currency')}}</option>
                                                        @foreach ($currency as $crc)
                                                            @if ($insureddata->currency_id == $crc->id)
                                                                <option value="{{ $crc->id }}" selected>{{ $crc->code }} -
                                                                {{ $crc->symbol_name }} -  {{ $crc->year }} -  Rp : {{ $crc->kurs }} </option>
                                                            @else
                                                                <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} -  {{ $crc->year }} -  Rp : {{ $crc->kurs }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="pakurs" id="pakurs" class="e1 form-control form-control-sm ">
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Total Sum Insured')}}</label>
                                                    <input type="text" id="pashareto" name="pashareto" value="{{ strval(number_format($insureddata->share_to, 2, '.', ',')) }}" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" required/>
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
                                                        {{__('Location')}}
                                                        <a class="text-primary mr-3 float-right " data-toggle="modal" data-target="#addlocation">
                                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addrisklocr">{{__('Add Risk Location')}}</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 com-sm-12 mt-3">
                                                    <table id="locRiskTable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>{{__('Risk Location')}}</th>
                                                            <th>{{__('Address')}}</th>
                                                            <th>{{__('Latitude Longitude')}}</th>
                                                            <th width="20%">{{__('Actions')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
        
                                                    @foreach ($locationlist as $slt)
                                                        <tr id="sid{{ $slt->id }}">
                                                        <td>{{ $slt->felookuplocation->loc_code }}<br>
                                                            <br>
                                                        </td>
                                                        <td> {{ $slt->felookuplocation->address }}<br>
                                                            {{ @$slt->felookuplocation->state->id }} -
                                                            {{ @$slt->felookuplocation->state->name }}<br>
                                                            {{ @$slt->felookuplocation->city->id }} -
                                                            {{ @$slt->felookuplocation->city->name }}<br>
                                                            {{ $slt->felookuplocation->postal_code }}</td>
                                                        <td>{{ $slt->felookuplocation->latitude, $slt->felookuplocation->longtitude }}</td>
                                                        <td>
        
                                                            <a class="text-primary mr-3 float-right " data-toggle="modal"
                                                            data-look-id="{{ $slt->id }}" data-target="#addlocdetailmodaldata">
                                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                                                data-target="#addlocdetailmodaldata2">Add</button>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="deletelocationdetail({{ $slt->id }})"><i
                                                                class="fas fa-trash text-danger"></i></a>
        
                                                        </td>
                                                        </tr>
                                                        <tr id="cid{{ $slt->id }}">
                                                        <td></td>
                                                        <td colspan="3">
                                                            <table id="tcid{{ $slt->id }}" width="600"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                <th>Ceding Source</th>
                                                                <th>Interest Insured</th>
                                                                <th>Credit Note/Debit Note</th>
                                                                <th>Certificate Number</th>
                                                                                <th>Slip Number</th>
                                                                                <th>Policy Number</th>
                                                                <th>Share %</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbcid{{ $slt->id }}">
        
        
                                                                @if (!empty($slt->risklocationdetail))
        
        
                                                                @foreach ($slt->risklocationdetail as $detaillocrisk)
        
                                                                        <tr id="riskdetailsid{{ $detaillocrisk->id }}">
                                                                        <td>{{ $detaillocrisk->cedingdetail->name }}</td>
                                                                        <td>{{ @$detaillocrisk->interestdetail->code }} -
                                                                            {{ @$detaillocrisk->interestdetail->description }}</td>
                                                                        <td>
                                                                            @if ($detaillocrisk->cndn)
                                                                            {{ $detaillocrisk->cndn }} @else - @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($detaillocrisk->certno)
                                                                            {{ $detaillocrisk->certno }} @else - @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($detaillocrisk->slipno)
                                                                            {{ $detaillocrisk->slipno }} @else - @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($detaillocrisk->policyno)
                                                                            {{ $detaillocrisk->policyno }} @else - @endif
                                                                        </td>
                                                                        <td>{{ number_format($detaillocrisk->percentage, 2, '.', ',') }}%</td>
                                                                        <td class="amount">
                                                                            {{ strval(number_format($detaillocrisk->amountlocation, 2, '.', ',')) }}
                                                                        </td>
                                                                        <td>
                                                                            <a href="javascript:void(0)"
                                                                            onclick="deletelocationriskdetail({{ $detaillocrisk->id }})"><i
                                                                                class="fas fa-trash text-danger float-left"></i></a>
                                                                        </td>
                                                                        </tr>
        
                                                                    @endforeach
        
                                                                    @endif
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                            </tr>
                                                        @endforeach
                                            
                                        
                                                        </tbody>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>All Ceding</th>
                                                                    <th >Total Share %</th>
                                                                    <th >Total Amount</th>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('List Detail')}} </label>
                                            <div class="input-group control-group increment2" >
                                                <input type="file" name="files[]" id="paattachment" class="form-control" multiple>
                                            </div>
                                            <div class="input-group">
                                                <ul id="palistdetail">
                                                    @foreach($insuredfilelist as $ifl)
                                                        <li><div class="control-group input-group" id="control-group2" style="margin-top:10px"><a href="{{ asset('files')}}/{{$ifl->filename}}">{{$ifl->filename}}</a></div></li>
                                                    @endforeach
        
                                                </ul>
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
                                                    <option value selected disabled>{{__('Business Type')}}</option>
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
                                            <select id="pauy" name="pauy" class="form-control form-control-sm ">
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
                                        <button type="button" id="addinsuredsave-btn" class="btn btn-primary btn-block ">Update</button>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </form>
            @else 
               
            

                <form method="POST" id="formpainsured" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
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
                                            <input type="text" id="insuredIDtxt" name="panumber" class="form-control form-control-sm" value="{{ $code_ms }}" data-validation="length" data-validation-length="0-16" readonly="readonly" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">{{__('Insured')}}</label>
                                                    <select id="paprefix" name="paprefix" class="form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Prefix')}}</option>
                                                        @foreach($prefixinsured as $pi)
                                                            <option value="{{ $pi->id }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                    <input type="text" id="autocomplete" name="pasuggestinsured" class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="0-50" placeholder="search for insured suggestion" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                    <input type="text" id="autocomplete2" name="pasuffix" class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="0-50" placeholder="suffix: QQ or TBk" />
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
                                                    <input type="hidden" id="pasharefrom" name="pasharefrom" class="form-control form-control-sm money text-left" data-validation="length"  data-validation-length="0-50" />
                                                    <input type="text" id="pasharefrom2" name="pasharefrom2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('All Ceding Share')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden" id="pashare" name="pashare" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" />
                                                                <input type="text" id="pashare2" name="pashare2" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" disabled/>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Currency')}}</label>
                                                    <select id="pacurrency" name="pacurrency" class="e1 form-control form-control-sm ">
                                                        <option selected readonly value='0'>{{__('Select Currency')}}</option>
                                                        @foreach($currency as $crc)
                                                        <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} - {{ $crc->year }} -  Rp : @currency($crc->kurs)</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="pakurs" id="pakurs" class="e1 form-control form-control-sm ">
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Total Sum Insured')}}</label>
                                                    <input type="text" id="pashareto" name="pashareto" class="form-control form-control-sm money text-left" data-validation="length" data-validation-length="0-50" required/>
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
                                                        {{__('Location')}}
                                                        <a class="text-primary mr-3 float-right " data-toggle="modal" data-target="#addlocation">
                                                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addrisklocr">{{__('Add Risk Location')}}</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12 com-sm-12 mt-3">
                                                    <table id="locRiskTable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>{{__('Risk Location')}}</th>
                                                            <th>{{__('Address')}}</th>
                                                            <th>{{__('Latitude Longitude')}}</th>
                                                            <th width="20%">{{__('Actions')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        
                                                        
                                                            
                                                        
                                                    </tbody>
                                                    <tr>
                                                            <th></th>
                                                            <th>Ceding</th>
                                                            <th>Total Share %</th>
                                                            <th>Total Amount</th>
                                                    </tr>
                                                    
                                                    
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('List Detail')}} </label>
                                            <div class="input-group control-group increment2" >
                                                <input type="file" name="files[]" id="paattachment" class="form-control" multiple>
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
                                                    <option value selected disabled>{{__('Business Type')}}</option>
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
                                            <select id="pauy" name="pauy" class="form-control form-control-sm ">
                                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                                <option value="{{ (intval(date('Y')) - 1) }}">{{ (intval(date('Y')) - 1) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-12 com-sm-12 mt-3">
                                        <button type="button" id="addinsuredsave-btn" class="btn btn-primary btn-block ">Save</button>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @include('crm.transaction.facultative.slip_facultative')
        
        </div>
    </div>

        @include('crm.transaction.facultative.modal.modal_update')
@endsection

@section('scripts')
@include('crm.transaction.facultative.js.slip_facultative_js')
@include('crm.transaction.facultative.js.header_pa_js')
@endsection