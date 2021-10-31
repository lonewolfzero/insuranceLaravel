
@extends('crm.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')

            @if($route_active == 'Hole in One - Slip Update')
                <form id="formhioinsured">
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
                                            <input type="text" name="hionumber" id="insuredIDtxt" class="form-control form-control-sm" data-validation="length" data-validation-length="1-25" value="{{ $insureddata->number }}" readonly="readonly" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">{{__('Insured')}}</label>
                                                    <select name="hioprefix" id="hioprefix" class="e1 form-control form-control-sm ">
                                                        
                                                        <option selected readonly>{{ __('Select Prefix') }}</option>
                                                        @foreach ($prefixinsured as $pi)
                                                        @if ($insureddata->prefix_id == $pi->id)
                                                            <option value="{{ $pi->id }}" selected>{{ $pi->code }} - {{ $pi->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $pi->code }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                    <input type="text" id="autocomplete" name="hiosuggestinsured" value="{{ $insureddata->insured_name }}" style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="search for insured suggestion" required/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                    <input type="text" name="hiosuffix" id="autocomplete2" value="{{ $insureddata->insured_suffix }}" style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="suffix: QQ or TBk" />
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
                                                    <label for="">{{__('All Ceding Share')}}</label>
                                                    <input type="text" id="hiosharefrom" name="hiosharefrom" value="{{ strval(number_format($insureddata->share_from, 2, '.', ',')) }}" class="form-control form-control-sm amount floatamount" placeholder="total nasre share" data-validation="length" data-validation-length="0-50" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('NASIONAL RE Share')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="text" id="hioshare" name="hioshare" value="{{ strval(number_format($insureddata->share, 2, '.', ',')) }}" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50" readonly="readonly" />
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
                                                    <select id="hiocurrency" name="hiocurrency" class="e1 form-control form-control-sm ">
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
                                                    <input type="hidden" name="hiokurs" id="hiokurs">
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Total Sum Insured')}}</label>
                                                    <input type="text" id="hioshareto" name="hioshareto" value="{{ strval(number_format($insureddata->share_to, 2, '.', ',')) }}" class="form-control form-control-sm amount floatamount" placeholder="total sum insured" data-validation="length" data-validation-length="0-50" />
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
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Hole Detail')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="holeDetailTable" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('Code')}}</th>
                                                                        <th>{{__('Golf Field - Hole Number')}}</th>
                                                                        <th>{{__('Event')}}</th>
                                                                        <th width="20%">{{__('Actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($hiolist as $hdl)
                                                                        <tr id="hdid{{ $hdl->id }}" data-name="holedetailvalue[]">
                                                                                <td data-name="{{ $hdl->code }}">{{ $hdl->code }}</td>
                                                                                <td data-name="{{ $hdl->interest_id }}">{{ $hdl->golffieldhole->golf_field }} - {{ $hdl->golffieldhole->hole_number }}</td>
                                                                                <td data-name="{{ $hdl->event }}">{{ $hdl->event }}</td>
                                                                                <td><a href="javascript:void(0)" onclick="deleteholedetail({{ $hdl->id }})">delete</i></a></td>
                                                                        </tr>   
                                                                    @endforeach
                                                                    <tr>
                                                                        <form id="form-addholedetail">
                                                                            @csrf
                                                                            <td colspan="2">
                                                                                <div class="form-group">
                                                                                    <select id="hiogolffield" name="hiogolffield" class="form-control form-control-sm ">
                                                                                        <option selected disabled>{{__('Golf Field Hole')}}</option>
                                                                                        @foreach($golffieldhole as $gfh)
                                                                                            <option value="{{ $gfh->id }}">{{ $gfh->code }} - {{ $gfh->golf_field }} - {{ $gfh->hole_number }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
        
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="hioevent" name="hioevent" class="form-control form-control-sm " data-validation="length" data-validation-length="0-15" />
                                                                                </div>
                                                                            </td>
        
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <button type="button" id="addholedetail-btn" class="btn btn-md btn-primary ">{{__('Add')}}</button>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('UY')}}</label>
                                            <select id="hiouy" name="hiouy" class="form-control form-control-sm ">
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
                    </div>
                </form>
        
            @else 
                <form id="formhioinsured">
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
                                            <input type="text" name="hionumber" id="insuredIDtxt" class="form-control form-control-sm" data-validation="length" data-validation-length="1-25" value="{{ $code_ms }}" readonly="readonly" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">{{__('Insured')}}</label>
                                                    <select name="hioprefix" id="hioprefix" class="e1 form-control form-control-sm ">
                                                        <option selected disabled>{{__('Select Prefix')}}</option>
                                                        @foreach($prefixinsured as $pi)
                                                            <option value="{{ $pi->id }}">{{ $pi->code }} - {{ $pi->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 1')}}</label>
                                                    <input type="text" id="autocomplete" name="hiosuggestinsured" style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="search for insured suggestion" required/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" style="opacity: 0">{{__('insured 2')}}</label>
                                                    <input type="text" name="hiosuffix" id="autocomplete2" style="text-transform:uppercase;" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="suffix: QQ or TBk" />
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
                                                    <input type="hidden" id="hiosharefrom" name="hiosharefrom" class="form-control form-control-sm amount floatamount" placeholder="total nasre share" data-validation="length" data-validation-length="0-50"  />
                                                    <input type="text" id="hiosharefrom2" name="hiosharefrom" class="form-control form-control-sm amount floatamount" placeholder="total nasre share" data-validation="length" data-validation-length="0-50" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('All Ceding Share')}}</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden" id="hioshare" name="hioshare" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50" />
                                                                <input type="text" id="hioshare2" name="hioshare2" class="form-control form-control-sm amount floatamount" data-validation="length" data-validation-length="0-50" disabled />
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Currency')}}</label>
                                                    <select id="hiocurrency" name="hiocurrency" class="e1 form-control form-control-sm ">
                                                        <option selected readonly value='0'>{{__('Select Currency')}}</option>
                                                        @foreach($currency as $crc)
                                                        <option value="{{ $crc->id }}">{{ $crc->code }} - {{ $crc->symbol_name }} - {{ $crc->year }} -  Rp : @currency($crc->kurs)</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="hiokurs" id="hiokurs">
                                                </div> 
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{__('Total Sum Insured')}}</label>
                                                    <input type="text" id="hioshareto" name="hioshareto" class="form-control form-control-sm amount floatamount" placeholder="total sum insured" data-validation="length" data-validation-length="0-50" />
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
                                        <div class="card">
                                            <div class="card-header bg-gray">
                                                {{__('Hole Detail')}}
                                            </div>
                                            <div class="card-body bg-light-gray ">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="col-md-12 com-sm-12 mt-3">
                                                            <table id="holeDetailTable" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('Code')}}</th>
                                                                        <th>{{__('Golf Field - Hole Number')}}</th>
                                                                        <th>{{__('Event')}}</th>
                                                                        <th width="20%">{{__('Actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($hiolist as $hdl)
                                                                        <tr id="hdid{{ $hdl->id }}" data-name="holedetailvalue[]">
                                                                                <td data-name="{{ $hdl->code }}">{{ $hdl->code }}</td>
                                                                                <td data-name="{{ $hdl->interest_id }}">{{ $hdl->golffieldhole->golf_field }} - {{ $hdl->golffieldhole->hole_number }}</td>
                                                                                <td data-name="{{ $hdl->event }}">{{ $hdl->event }}</td>
                                                                                <td><a href="javascript:void(0)" onclick="deleteholedetail({{ $hdl->id }})">delete</i></a></td>
                                                                        </tr>   
                                                                    @endforeach
                                                                    <tr>
                                                                        <form id="form-addholedetail">
                                                                            @csrf
                                                                            <td colspan="2">
                                                                                <div class="form-group">
                                                                                    <select id="hiogolffield" name="hiogolffield" class="form-control form-control-sm ">
                                                                                        <option selected disabled>{{__('Golf Field Hole')}}</option>
                                                                                        @foreach($golffieldhole as $gfh)
                                                                                            <option value="{{ $gfh->id }}">{{ $gfh->code }} - {{ $gfh->golf_field }} - {{ $gfh->hole_number }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
        
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="hioevent" name="hioevent" class="form-control form-control-sm " />
                                                                                </div>
                                                                            </td>
        
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <button type="button" id="addholedetail-btn" class="btn btn-md btn-primary ">{{__('Add')}}</button>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">{{__('UY')}}</label>
                                            <select id="hiouy" name="hiouy" class="form-control form-control-sm ">
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
@include('crm.transaction.facultative_syariah.js.header_hio_js')
@endsection