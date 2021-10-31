
@extends('crm.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')

            @if($route_active == 'HE & Motor - Slip Update')
            <form>
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
                                                  <input type="text" name="hemnumber"  id="insuredIDtxt"  value="{{$code_ms}}" class="form-control form-control-sm" readonly required/>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <div class="row">
                                                      <div class="col-md-4">
                                                          <label for="">{{__('Insured')}}</label>
                                                          <select id="heminsured" name="heminsured" class="form-control form-control-sm ">
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
                                                          <input type="text" name="hemsuggestinsured" id='autocomplete' value="{{$insureddata->insured_name}}" class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="2-50" placeholder="search for insured suggestion" required/>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                          <input type="text" name="hemsuffix" id='autocomplete2'  value="{{$insureddata->insured_suffix}}"  class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="2-50" placeholder="suffix: QQ or TBk" required/>
                                                     
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
                                                          <label for="">{{__('Nasional Reinsurance')}}</label>
                                                          <input id="hemsharefrom" type="text"  name="hemsharefrom" value="{{$insureddata->share_from}}"  class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50" readonly="readonly" />
                                                      </div>
                                                  </div>
      
                                                  <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label for="">{{__('All Ceding Share')}}</label>
                                                          <div class="row">
                                                              <div class="col-md-10">
                                                                  <div class="input-group">
                                                                     <input type="text"  value="{{$insureddata->share}}"  id="hemshare"  name="hemshare" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-250" readonly/>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                 
                                                  <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label for="">{{ __('Currency') }}</label>
                                                          <select id="hemcurrency" name="hemcurrency" class="e1 form-control form-control-sm ">
                                                          @foreach ($currency as $crc)
                                                              @if ($insureddata->currency_id == $crc->id)
                                                              <option value="{{ $crc->id }}" selected>{{ $crc->code }} -
                                                                  {{ $crc->symbol_name }} -  {{ $crc->year }} -  Rp : {{ $crc->kurs }}</option>
                                                              @else
                                                              <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} -  {{ $crc->year }} -  Rp : {{ $crc->kurs }}
                                                              </option>
                                                              @endif
                                                          @endforeach
      
                                                          </select>
                                                          <input type="hidden" name="hemkurs" id="hemkurs">
                                                   </div>
                                                  </div>
      
                                              
                                                  
                                              
      
                                                  <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label for="">{{ __('Total Sum Insured') }}</label>
                                                      <input id="hemshareto2" type="text" name="hemshareto"
                                                      value="{{ strval(number_format($insureddata->share_to, 2, '.', ',')) }}"
                                                      class="form-control form-control-sm amount floatamount" data-validation="length"
                                                      data-validation-length="1-150" />
                                                      <input id="hemshareto" type="hidden" name="hemshareto"
                                                      value="{{ strval(number_format($insureddata->share_to, 3, '.', ',')) }}"
                                                      class="form-control form-control-sm amount floatamount" data-validation="length"
                                                      data-validation-length="0-150" />
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
                                                                      
                                                                         
                                                                  @foreach($locationlist as $slt)
                                                                          <tr id="sid{{ $slt->id }}">
                                                                                  <td >{{ $slt->felookuplocation->loc_code }}<br>
                                                                                       <br>
                                                                                  </td>
                                                                                  <td> {{ $slt->felookuplocation->address }}<br>
                                                                                        {{@$slt->felookuplocation->state->id}} - {{@$slt->felookuplocation->state->name}}<br>
                                                                                        {{@$slt->felookuplocation->city->id}} - {{@$slt->felookuplocation->city->name}}<br>
                                                                                        {{ $slt->felookuplocation->postal_code }}</td>
                                                                                  <td>{{ $slt->felookuplocation->latitude , $slt->felookuplocation->longtitude  }}</td>
                                                                                  <td>
                                                                                      
                                                                                      <a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="{{ $slt->id }}" data-target="#addlocdetailmodaldata">
                                                                                          <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addlocdetailmodaldata2">Add</button>
                                                                                      </a>
                                                                                      <a href="javascript:void(0)" onclick="deletelocationdetail({{ $slt->id }})"><i class="fas fa-trash text-danger"></i></a>
                                                                                       
                                                                                  </td>
                                                                          </tr>   
                                                                          <tr id="cid{{ $slt->id }}">
                                                                                  <td><a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#addrisklocdetailmodaldata5">
                                                                                          <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addrisklocdetailmodaldata5">Addb Detail</button></td>
                                                                                  <td colspan="3">
                                                                                  <table id="tcid{{ $slt->id }}" width="600" class="table table-bordered table-striped">
                                                                                      <thead>
                                                                                          <tr>
                                                                                              <th>Interest Insured</th>
                                                                                              <th>Ceding</th>
                                                                                              <th>CN/DN</th>
                                                                                              <th>Cert No</th>
                                                                                              <th>Slip No</th>
                                                                                              <th>Policy No</th>
                                                                                              <th>Percentage</th>
                                                                                              <th>Amount</th>
                                                                                              <th>Action</th>
                                                                                          </tr>
                                                                                      </thead>
                                                                                      <tbody id="tbcid{{ $slt->id }}">
                                                                                      
                                                                                          @if(!empty($slt->risklocationdetail))
                                                                                          
      
                                                                                          @foreach($slt->risklocationdetail as $detaillocrisk)
      
                                                                                          <tr id="riskdetailsid{{ $detaillocrisk->id }}">
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
                                                                                  </table>
                                                                              </td>
                                                                          </tr>
                                                                          @endforeach
                                                                      </tbody>
      
                                                                      <tr>
                                                                          <th></th>
                                                                          <th>Ceding</th>
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
                                                  <label>{{__('Attachment')}} </label>
                                                      
                                                      <div class="input-group">
                                                      <div class="input-group control-group increment" >
                                                      <input type="file" name="hemfile_att[]" class="form-control" multiple>
                                                     </div>
      
                                                      
                                                      @foreach($filelist as $isl)
                                                      <div class="control-group input-group" id="control-group2" style="margin-top:10px">
                                                          <a href="{{ asset('files')}}/{{$isl->filename}}">{{$isl->filename}}</a>
                                                      </div>
                                                      @endforeach
      
                                                  
      
      
                                                      </div>
                                              </div>
                                          </div>
                                      </div>
      
                                      <div class="row">
                                          <div class="col-md-6 d-flex justify-content-start">
                                              <div class="col-md-12 com-sm-12 mt-3">
                                                  <label for="">{{__('Format')}}</label>
      
                                                  <table id="hemFormat" class="table table-bordered table-striped">
                                                      <thead>
                                                          <tr>
                                                              <th>{{__('Motor / Machine Type')}}</th>
                                                              <th>{{__('chassis Number')}}</th>
                                                              <th>{{__('Police Number')}}</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          <tr>
                                                              <td>{{__('AAA')}}</td>
                                                              <td>{{__('EA001')}}</td>
                                                              <td>{{__('B 1000 AA')}}</td>
                                                          </tr>
                                                          <tr>
                                                              <td>{{__('BBB')}}</td>
                                                              <td>{{__('EA002')}}</td>
                                                              <td>{{__('B 2000 BB')}}</td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
      
                                      <div class="row">
                                          <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="">{{ __('UY') }}</label>
                                              <select id="hemuy" name="hemuy" class="form-control form-control-sm ">
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
            <form  autocomplete="off">
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
                                                  <input type="text" name="hemnumber"  id="insuredIDtxt"  value="{{$code_ms}}" class="form-control form-control-sm" readonly="readonly" required/>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <div class="row">
                                                      
      
                                                      <div class="col-md-4">
                                                          <label for="">{{__('Insured')}}</label>
                                                          <select id="heminsured" name="heminsured" class="form-control form-control-sm ">
                                                              <option selected disabled>{{__('Select Prefix')}}</option>
                                                              @foreach($prefixinsured as $pi)
                                                              <option value="{{ $pi->id }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>
      
                                                      <div class="col-md-4">
                                                          <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                          <input type="text" name="hemsuggestinsured" id='autocomplete' class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="0-50" placeholder="search for insured suggestion" required/>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                          <input type="text" name="hemsuffix" id='autocomplete2' class="form-control form-control-sm " style="text-transform:uppercase;" data-validation="length" data-validation-length="0-50" placeholder="suffix: QQ or TBk" />
                                                     
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
                                                          <input id="hemsharefrom" type="hidden" name="hemsharefrom" value="0"class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50"   />
                                                          <input id="hemsharefrom2" type="text" name="hemsharefrom2" value="0"class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50"  disabled />
                                                      </div>
                                                  </div>
      
                                                  <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label for="">{{__('All Ceding Share')}}</label>
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <div class="input-group">
                                                                      <input type="hidden" id="hemshare"  name="hemshare" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-250"  />
                                                                      <input type="text" id="hemshare2"  name="hemshare2" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-250" disabled />
                                                                      
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
      
                                                  <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label for="">{{__('Currency')}}</label>
                                                          <select id="hemcurrency" name="hemcurrency" class="e1 form-control form-control-sm ">
                                                              <option selected readonly value='0'>{{__('Select Currency')}}</option>
                                                              @foreach($currency as $crc)
                                                              <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} - {{ $crc->month }} {{ $crc->year }} -  Rp : @currency($crc->kurs)</option>
                                                              @endforeach
                                                          </select>
                                                          <input type="hidden" name="hemkurs" id="hemkurs">
                                                      </div> 
                                                  </div>
      
                                                 
                                                  <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label for="">{{__('Total Sum Insured')}}</label>
                                                          <input id="hemshareto2" type="text"  name="hemshareto" class="form-control form-control-sm amount floatamount" value="" data-validation="length" data-validation-length="1-50" />
                                                          <input id="hemshareto"  type="hidden" name="hemshareto" value="0" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50" />
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
                                                                      
                                                                         
                                                                  @foreach($locationlist as $slt)
                                                                          <tr id="sid{{ $slt->id }}">
                                                                              <td >{{ $slt->felookuplocation->loc_code }}<br>
                                                                                      <br>
                                                                              </td>
                                                                              <td> {{ $slt->felookuplocation->address }}<br>
                                                                                      {{@$slt->felookuplocation->state->id}} - {{@$slt->felookuplocation->state->name}}<br>
                                                                                      {{@$slt->felookuplocation->city->id}} - {{@$slt->felookuplocation->city->name}}<br>
                                                                                      {{ $slt->felookuplocation->postal_code }}</td>
                                                                              <td>{{ $slt->felookuplocation->latitude , $slt->felookuplocation->longtitude  }}</td>
                                                                              <td>
                                                                                  
                                                                                  <a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="{{ $slt->id }}" data-target="#addlocdetailmodaldata">
                                                                                      <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addlocdetailmodaldata2">Add</button>
                                                                                  </a>
                                                                                  <a href="javascript:void(0)" onclick="deletelocationdetail({{ $slt->id }})"><i class="fas fa-trash text-danger"></i></a>
                                                                                      
                                                                              </td>
                                                                          </tr>   
                                                                          <tr id="cid{{ $slt->id }}">
                                                                                  <td><a class="text-primary mr-3 float-right " data-toggle="modal" data-look-id="'+response.id+'" data-target="#addrisklocdetailmodaldata5">
                                                                                          <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#addrisklocdetailmodaldata5">Addb Detail</button></td>
                                                                                  <td colspan="3">
                                                                                  <table id="tcid{{ $slt->id }}" width="600" class="table table-bordered table-striped">
                                                                                      <thead>
                                                                                          <tr>
                                                                                              <th>Interest Insured</th>
                                                                                              <th>Ceding</th>
                                                                                              <th>CN/DN</th>
                                                                                              <th>Cert No</th>
                                                                                              <th>Slip No</th>
                                                                                              <th>Policy No</th>
                                                                                              <th>Percentage</th>
                                                                                              <th>Amount</th>
                                                                                              <th>Action</th>
                                                                                          </tr>
                                                                                      </thead>
                                                                                      <tbody id="tbcid{{ $slt->id }}">
                                                                                      
                                                                                          @if(!empty($slt->risklocationdetail))
                                                                                          
      
                                                                                          @foreach($slt->risklocationdetail as $detaillocrisk)
      
                                                                                          <tr id="riskdetailsid{{ $detaillocrisk->id }}">
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
                                                                                  </table>
                                                                              </td>
                                                                          </tr>
                                                                          @endforeach
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
                                                  <label>{{__('Attachment')}} </label>
                                                  <div class="input-group">
                                                      <div class="input-group control-group increment" >
                                                      <input type="file" name="hemfile_att[]" class="form-control">
                                                      <div class="input-group-btn"> 
                                                          <button class="btn btn-success" id="btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                                      </div>
                                                      </div>
                                                      <div class="clone hide">
                                                      <div class="control-group input-group" id="control-group" style="margin-top:10px">
                                                          <input type="file" name="hemfile_att[]" class="form-control">
                                                          <div class="input-group-btn"> 
                                                          <button class="btn btn-danger" id="btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
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
                                                  <select id="hemuy" name="hemuy" class="form-control form-control-sm ">
                                                      <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                                      <option value="{{ (intval(date('Y')) - 1) }}">{{ (intval(date('Y')) - 1) }}</option>
                                                  </select>
                                                  <input type="hidden" id="hemcountendorsement" name="hemcountendorsement" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-12" readonly="readonly"/>
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

            @include('crm.transaction.facultative_syariah.slip_facultative')
        
        </div>
    </div>

        @include('crm.transaction.facultative_syariah.modal.modal_update')
@endsection

@section('scripts')
@include('crm.transaction.facultative_syariah.js.slip_facultative_js')
@include('crm.transaction.facultative_syariah.js.header_hem_js')
@endsection