
@extends('crm.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')

            @if($route_active == 'Fire Engineering - Slip Update')
              <form>
                  @csrf
                  <div class="card">
                    <div class="card-header bg-gray">
                      {{ __('Insured') }}
                    </div>
          
                    <div class="card-body bg-light-gray ">
                      <div class="tab-content" id="custom-tabs-three-tabContent">
                        <!-- <div class="tab-pane fade show active" id="l" role="tabpanel" aria-labelledby="lead-details"> -->
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                              <label for="">{{ __('Number') }} </label>
                              <input type="text" name="fenumber" id="insuredIDtxt" value="{{ $insureddata->number }}"
                                class="form-control form-control-sm" readonly required />
                            </div>
                          </div>
                        </div>
          
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-4">
                                  <label for="">{{ __('Insured') }}</label>
                                  <select id="feinsured" name="feinsured" class="e1 form-control form-control-sm ">
          
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
                                  <label for="" style="opacity: 0">{{ __('insured 1') }}</label>
                                  <input type="text" name="fesuggestinsured" id='autocomplete' style="text-transform:uppercase;"
                                    value="{{ $insureddata->insured_name }}" class="form-control form-control-sm "
                                    data-validation="length" data-validation-length="1-350"
                                    placeholder="search for insured suggestion" required />
                                </div>
                                <div class="col-md-4">
                                  <label for="" style="opacity: 0">{{ __('insured 2') }}</label>
                                  <input type="text" name="fesuffix" id='autocomplete2' style="text-transform:uppercase;"
                                    value="{{ $insureddata->insured_suffix }}" class="form-control form-control-sm "
                                    data-validation="length" data-validation-length="0-350" placeholder="suffix: QQ or TBk"
                                    required />
          
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
                                  <label for="">{{ __('NASIONAL RE Share') }}</label>
                                  <input id="fesharefrom" type="hidden" name="fesharefrom"
                                    value="{{ strval(number_format($insureddata->share_from, 2, '.', ',')) }}"
                                    class="form-control form-control-sm amount floatamount" data-validation="length"
                                    data-validation-length="0-150" />
                                  <input id="fesharefrom2" type="text" name="fesharefrom2"
                                    value="{{ strval(number_format($insureddata->share_from, 2, '.', ',')) }}"
                                    class="form-control form-control-sm amount floatamount" data-validation="length"
                                    data-validation-length="0-150" disabled />
                                </div>
                              </div>
          
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">{{ __('All Ceding Share') }}</label>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="input-group" lang="en-US">
                                        <input type="hidden" id="feshare" name="feshare"
                                          value="{{ strval(number_format($insureddata->share, 2, '.', ',')) }}"
                                          class="form-control form-control-sm amount floatamount" data-validation="length"
                                          data-validation-length="0-150" />
                                        <input type="text" id="feshare2" name="feshare2"
                                          value="{{ strval(number_format($insureddata->share, 2, '.', ',')) }}"
                                          class="form-control form-control-sm amount floatamount" data-validation="length"
                                          data-validation-length="0-150" disabled/>
                                        <!-- <div class="input-group-append">
                                                                                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                                </div> -->
                                      </div>
          
                                    </div>
                                  </div>
                                </div>
                              </div>
          
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">{{ __('Currency') }}</label>
                                  <select id="fecurrency" name="fecurrency" class="e1 form-control form-control-sm ">
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
                                  <input type="hidden" name="fekurs" id="fekurs">
                                </div>
                              </div>
          
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="">{{ __('Total Sum Insured') }}</label>
                                  <input id="feshareto2" type="text" name="feshareto"
                                    value="{{ strval(number_format($insureddata->share_to, 2, '.', ',')) }}"
                                    class="form-control form-control-sm amount floatamount" data-validation="length"
                                    data-validation-length="1-150" />
                                  <input id="feshareto" type="hidden" name="feshareto"
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
                                    {{ __('Location') }}
          
                                    <a class="text-primary mr-3 float-right " data-toggle="modal" data-target="#addlocation">
                                      <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                        data-target="#addrisklocr">{{ __('Add Risk Location') }}</button>
                                    </a>
          
                                  </div>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="col-md-12 com-sm-12 mt-3">
                                  <table id="locRiskTable" class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th>{{ __('Risk Location') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('Latitude Longitude') }}</th>
                                        <th width="20%">{{ __('Actions') }}</th>
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
                                                  <th>CN/DN</th>
                                                  <th>Cert No</th>
                                                  <th>Slip No</th>
                                                  <th>Policy No</th>
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
                              <label for="">{{ __('UY') }}</label>
                              <select id="feuy" name="feuy" class="form-control form-control-sm ">
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
          
                        <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">{{ __('Count Endorsement') }}</label>
                                                                <input type="number" id="fecountendorsement" name="fecountendorsement" value="{{ $insureddata->count_endorsement }}" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-12" readonly="readonly"/>
                                                            </div>
                                                        </div>
                                                    </div> -->
          
                        <div class="row">
                          <div class="col-md-12 com-sm-12 mt-3">
                            <button type="button" id="addinsuredsave-btn" class="btn btn-primary btn-block ">UPDATE</button>
                          </div>
                        </div>
          
                        <!-- </div> -->
                      </div>
                    </div>
                  </div>
              </form>
        
            @else 
                <form autocomplete="off">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-gray">
                            {{__('Insured')}}
                        </div>
                        
                        <div class="card-body bg-light-gray ">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <!-- <div class="tab-pane fade show active" id="l" role="tabpanel" aria-labelledby="lead-details"> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                <label for="">{{__('Number')}} </label>
                                                <input type="text" name="fesnumber"  id="insuredIDtxt"  value="{{$code_ms}}" class="form-control form-control-sm" readonly required/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    
                                                    <div class="col-md-4">
                                                        <label for="">{{__('Insured')}}</label>
                                                        <select id="feinsured" name="feinsured" class="form-control form-control-sm ">
                                                            <option selected disabled>{{__('Select Prefix')}}</option>
                                                            @foreach($prefixinsured as $pi)
                                                            <option value="{{ $pi->id }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                        <input type="text"name="fesuggestinsured" id='autocomplete' style="text-transform:uppercase;"  class="form-control form-control-sm " data-validation="length" data-validation-length="1-350" placeholder="search for insured suggestion" required/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                        <input type="text" name="fesuffix" id='autocomplete2' style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-350" placeholder="suffix: QQ or TBk" />
                                                        
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
                                                        <input id="fesharefrom" type="hidden"   name="fesharefrom" class="form-control form-control-sm amount floatamount" value="" data-validation="length" data-validation-length="0-50"   />
                                                        <input id="fesharefrom2" type="text"   name="fesharefrom2" class="form-control form-control-sm amount floatamount" value="" data-validation="length" data-validation-length="0-50"  disabled />
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('All Ceding Share')}}</label>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="input-group" lang="en-US">
                                                                    <input type="hidden" id="feshare" name="feshare" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-250"  />
                                                                    <input type="text" id="feshare2" name="feshare2" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-250" disabled />
                                                                    <!-- <div class="input-group-append">
                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('Currency')}}</label>
                                                        <select id="fecurrency" name="fecurrency" class="e1 form-control form-control-sm ">
                                                            <option selected readonly value='0'>{{__('Select Currency')}}</option>
                                                            @foreach($currency as $crc)
                                                            <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} - {{ $crc->year }} -  Rp : @currency($crc->kurs)</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="fekurs" id="fekurs">
                                                    </div> 
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">{{__('Total Sum Insured')}}</label>
                                                        {{-- <input id="feshareto2" type="text"  name="feshareto" class="form-control form-control-sm amount " value="" data-validation="length" data-validation-length="1-250" /> --}}
                                                        <input id="feshareto" type="text"  name="feshareto" class="form-control form-control-sm amount " value="" data-validation="length" data-validation-length="1-250" />
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
                                                                <th>All Ceding</th>
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
                                                <label for="">{{__('UY')}}</label>
                                                <select id="feuy" name="feuy" class="form-control form-control-sm ">
                                                    <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                                    <option value="{{ (intval(date('Y')) - 1) }}">{{ (intval(date('Y')) - 1) }}</option>
                                                </select>
                                                <input type="hidden" id="fecountendorsement" name="fecountendorsement" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-12" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Endorsement')}}</label>
                                                <input type="number" id="fecountendorsement" name="fecountendorsement" class="form-control form-control-sm " data-validation="length"  data-validation-length="0-12" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-md-12 com-sm-12 mt-3">
                                            <button type="button" id="addinsuredsave-btn" class="btn btn-primary btn-block ">Save</button>
                                        </div>
                                    </div>
                                    
                                <!-- </div> -->
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
@include('crm.transaction.facultative_syariah.js.header_fe_js')
@endsection