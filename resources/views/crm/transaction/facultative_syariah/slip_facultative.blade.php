<div class="modal fade" id="addlocation" tabindex="-1" user="dialog" aria-labelledby="addlocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" user="document">
        <div class="modal-content bg-light-gray">
            <div class="modal-header bg-gray">
                <h5 class="modal-title" id="addlocationLabel">{{__('Add Lookup Location')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-addlocation">
                @csrf
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Country')}}</label>
                                <select name="country_location_id" id="country_location" class="e1 form-control form-control-sm " required>
                                    <option selected readonly>{{__('Select Country ')}}</option>
                                    @foreach($felookup as $felookuplocationdata)
                                    @if($felookuplocationdata->country_id  == 102 || $felookuplocationdata->country_id=="102")
                                    <option value="{{ $felookuplocationdata->country_id }}" selected>{{ $felookuplocationdata->country->code }} - {{ $felookuplocationdata->country->name }}</option>
                                    @else
                                    <option value="{{ $felookuplocationdata->country_id }}">{{ $felookuplocationdata->country->code }} - {{ $felookuplocationdata->country->name }}</option>
                                    @endif   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('State/Province')}}</label>
                                <select name="state_location_id" id="state_location" class="e1 form-control form-control-sm " required>
                                    {{-- <option selected readonly>{{__('Select State/Province ')}}</option>
                                    @foreach($felookup as $felookuplocationdata)
                                    <option value="{{ $felookuplocationdata->state_id }}">{{ $felookuplocationdata->state->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('City')}}</label>
                                <select name="city_location_id" id="city_location" class="e1 form-control form-control-sm " required>
                                    {{-- <option selected readonly>{{__('Select City ')}}</option>
                                    @foreach($felookup as $felookuplocationdata)
                                    <option value="{{ $felookuplocationdata->city_id }}">{{ $felookuplocationdata->city->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Address')}}</label>
                                <select name="address_location_id" id="address_location" class="e1 form-control form-control-sm " required>
                                    {{-- <option selected readonly>{{__('Select Address ')}}</option>
                                    @foreach($felookup as $felookuplocationdata)
                                    <option value="{{ $felookuplocationdata->id }}">{{ $felookuplocationdata->loc_code }} - {{ $felookuplocationdata->address }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Postal Code')}}</label>
                                <input type="text" id="postal_code_location_id" class=" form-control form-control-sm " readonly="true" name="postal_code_location">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-info" id="addship-btn">Add Risk Location</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Location Modal Ends --}}

<div class="modal fade" id="addlocdetailmodaldata" tabindex="-1" user="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" user="document">
        <div class="modal-content bg-light-gray">
            <div class="modal-header bg-gray">
                <h5 class="modal-title" id="addDetailLabel">{{__('Add Detail Risk ')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-addlocationdetail">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Location Id')}}</label>
                                <input type="text" id="insurednoloc" name="insurednoloc" class="form-control form-control-sm" value="" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Ceding Source')}}</label>
                                <select id="ceding_id" name="ceding_id" class="e1 form-control form-control-sm " aria-required="true">
                                    <option value=""  selected disabled >Ceding</option>
                                    @foreach($ceding as $cb)
                                    <option value="{{ $cb->id }}"> {{ $cb->code }} - {{ $cb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Interest list')}}</label>
                                <select id="slipinterestlistlocation" name="slipinterestlistlocation" class="e1 form-control form-control-sm " aria-required="true">
                                    <option selected disabled>{{__('Interest list')}}</option>
                                    @foreach($interestinsured as $ii)
                                    <option value="{{ $ii->id }}">{{ $ii->code }} - {{ $ii->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('CN/DN')}}</label>
                                <input type="text" id="cndn" name="cndn" class="form-control form-control-sm" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Cert No')}}</label>
                                <input type="text" id="certno" name="certno" class="form-control form-control-sm" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Slip No')}}</label>
                                <input type="text" id="slipno" name="slipno" class="form-control form-control-sm" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-12">
                            <div class="form-group">
                                <label for="">{{__('Policy No')}}</label>
                                <input type="text" id="policyno" name="policyno" class="form-control form-control-sm" value="" />
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
                                            <input type="text" id="percentceding" name="percentceding"  class="form-control form-control-sm floatTextBox2"   />
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
                                <input type="text" id="amountlocation" name="amountlocation" class="form-control form-control-sm amount "  />
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-info" id="addship-btn">Add Detail Risk Location</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Risk Location Modal Ends --}}
@if($route_active == 'Fire Engineering - Slip Entry' || $route_active == 'Financial Lines - Slip Entry' || $route_active == 'HE & Motor - Slip Entry' || $route_active == 'Moveable Property - Slip Entry' || $route_active == 'Hole in One - Slip Entry' || $route_active == 'Personal Accident - Slip Entry')
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
                </tbody>
            </table>
        </div>
    </div>
@else 
    <div class="card ">
        <div class="card-header bg-gray">
        {{ __('Slip Detail') }}
        </div>
        <div class="card-body">

        <table id="SlipInsuredTableData" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>{{ __('Slip Number') }}</th>
                <th>{{ __('Ceding/Broker') }}</th>
                <th>{{ __('Ceding Source') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{__('Endorsement')}}</th> 
                <th width="20%">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach (@$slipdatadistict as $slipdatadistictdetail)

                <tr>
                    <td>{{ @$slipdatadistictdetail->number }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    {{-- <td >{{ @$slipdatadistictdetail->endorsment }}</td> --}}
                    <td>
                    <div class="row">
                    </div>
                    </td>
                </tr>
                
                @foreach (@$slipdata2 as $slipdatatadetail)


                @if(@$slipdatadistictdetail->number==@$slipdatatadetail->number)
                    <tr>
                    <td></td>
                    <td>{{ @$slipdatatadetail->cedingbroker->name }} -
                        {{ @$slipdatatadetail->cedingbroker->company_name }}</td>
                    <td>{{ @$slipdatatadetail->ceding->name }} - {{ @$slipdatatadetail->ceding->company_name }}</td>
                    <td>{{ @$slipdatatadetail->status }}</td>
                    <td >{{ @$slipdatatadetail->endorsment }}</td>
                    @if($slipdatatadetail->endorsment == $maxdata->endorsment)
                    <td>
                        <div class="row">
                        @if ($slipdatatadetail->date_transfer == null)
                            @if($slipdatatadetail->status == 'decline' || $slipdatatadetail->status == 'cancel')
                                <a class="text-primary mr-3 float-right " data-toggle="modal"
                                data-book-id="{{ @$slipdatatadetail->id }}" data-target="#detailmodaldata"
                                href="#detailmodaldata">
                                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#detailmodaldata2">{{ __('Detail') }}</button>
                                </a>

                                <a class="text-primary mr-3 float-right " data-toggle="modal"
                                data-book-id="{{ @$slipdatatadetail->id }}" data-target="#endorsementmodaldata">
                                <button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right"
                                    data-toggle="modal" data-target="#endorsementmodaldata2">{{ __('Endorsement') }}</button>
                                </a>
                                    @if($slipdatatadetail->warning_flag == 1)
                                        <button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>
                                    @endif
                            @else
                                <a class="text-primary mr-3 float-right " data-toggle="modal"
                                data-book-id="{{ @$slipdatatadetail->id }}" data-target="#detailmodaldata"
                                href="#detailmodaldata">
                                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#detailmodaldata2">{{ __('Detail') }}</button>
                                </a>

                                <a class="text-primary mr-3 float-right " data-toggle="modal"
                                data-book-id="{{ @$slipdatatadetail->id }}" data-target="#updatemodaldata">
                                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#updatemodaldata2">{{ __('Edit') }}</button>
                                </a>

                                <a class="text-primary mr-3 float-right " data-toggle="modal"
                                data-book-id="{{ @$slipdatatadetail->id }}" data-target="#cancelmodaldata">
                                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#cancelmodaldata2">{{ __('Cancel') }}</button>
                                </a>
                                    @if($slipdatatadetail->warning_flag == 1)
                                        <button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>
                                    @endif
                            @endif
                            {{-- <button type="button" id="claim-endorse" class="btn btn-sm btn-warning float-right">Claim</button>
                            @include('crm.transaction.fe_slipupdate_claim_modal') --}}

                           

                            {{-- <a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="{{  @$slipdatatadetail->id }}" data-target="#endorsementmodaldata"> 
                                    <button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" onclick="addendorsement({{  @$slipdatatadetail->id }})">{{__('Endorsement')}}</button>
                                </a> --}}
                        @elseif($slipdatatadetail->date_transfer != null )
                            <a class="text-primary mr-3 float-right " data-toggle="modal"
                            data-book-id="{{ @$slipdatatadetail->id }}" data-target="#detailmodaldata"
                            href="#detailmodaldata">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#detailmodaldata2">{{ __('Detail') }}</button>
                            </a>

                            <a class="text-primary mr-3 float-right " data-toggle="modal"
                            data-book-id="{{ @$slipdatatadetail->id }}" data-target="#endorsementmodaldata">
                            <button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right"
                                data-toggle="modal" data-target="#endorsementmodaldata2">{{ __('Endorsement') }}</button>
                            </a>

                            <a class="text-primary mr-3 float-right " data-toggle="modal"
                            data-book-id="{{ @$slipdatatadetail->id }}" data-target="#cancelmodaldata">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#cancelmodaldata2">{{ __('Cancel') }}</button>
                            </a>

                            @if($slipdatatadetail->warning_flag == 1)
                            <button type="button" id="change-must" class="btn btn-sm btn-danger float-right">Must Change</button>
                            @endif

                            <!-- <a class="text-primary mr-3 float-right " data-toggle="modal" data-book-id="{{ @$slipdatatadetail->id }}" data-target="#endorsementmodaldata">
                                            <button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#endorsementmodaldata2" disabled>{{ __('Endorsement') }}</button>
                                        </a> -->

                            {{-- <button type="button" id="btnendorsementslip" class="btn btn-sm btn-primary float-right" onclick="addendorsement({{  @$slipdatatadetail->id }})">{{__('Endorsement')}}</button> --}}
                        @endif
                        </div>
                    </td>
                    @else
                    <td>
                        <div class="row">
                        <a class="text-primary mr-3 float-right " data-toggle="modal"
                            data-book-id="{{ @$slipdatatadetail->id }}" data-target="#detailmodaldata"
                            href="#detailmodaldata">
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#detailmodaldata2">{{ __('Detail') }}</button>
                            </a>
                        </div>
                    </td>
                    @endif


                    </tr>
                @endif
            
            @endforeach

            @endforeach

            </tbody>

        </table>


        </div>
    </div>
@endif

<div class="card ">
    <div class="card-header bg-gray">
        {{__('Slip Detail')}}
    </div>
    
    <div class="card-body bg-light-gray">
        <div class="container-fluid p-3">
            <form id="multi-file-upload-ajax" method="POST" autocomplete="off"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="card card-tabs">
                    
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs nav-tabs-top" id="custom-tabs-three-tab" role="tablist">
                            
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item active" href="#general-details-id">
                                <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>
                            
                            <li class="nav-item" href="#insured-details-id">
                                <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                            
                            <li class="nav-item" href="#installment-details-id">
                                <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>

                        </ul>
                    </div>
                    
                    <div class="card-body bg-light-gray">
                        <div class="tab-content p-0 pt-1" id="custom-tabs-three-tabContent">
                            
                            <div class="tab-pane fade show active" id="general-details-id" href="#general-details-id" role="tabpanel" aria-labelledby="general-details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="sliptypeform" id="sliptypeform" value="{{$type}}">
                                                    <label for="">{{__('Number')}} </label>
                                                    <input type="text" id="slipnumber" name="slipnumber" class="form-control form-control-sm" value="{{ $code_sl }}" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">{{__('Username')}}</label>
                                                    <input type="text" id="slipusername" name="slipusername" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="{{Auth::user()->name}}" readonly="readonly" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Prod Year')}}:</label>
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
                                                    <input type="text" id="slipstatus" name="slipstatus" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" value="slip" readonly="readonly"/>

                                                    <!-- <select name="slipstatus" id="slipstatus" class="form-control form-control-sm ">
                                                        {{-- <option selected readonly>{{__('Select Status')}}</option> --}}
                                                        <option value="slip" selected>Slip</option>
                                                        <option value="endorsement">Endorsement</option>
                                                        <option value="cancel">Cancel</option>
                                                        <option value="decline">Decline</option>
                                                    </select> -->
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        

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
                                                        @foreach($statuslist as $statlist)
                                                        <tr>
                                                            <td>{{ $statlist->status }}</td>
                                                            <td>{{ $statlist->updated_at }}</td>
                                                            <td>{{ $statlist->user }}</td>
                                                        </tr>   
                                                        @endforeach
                                                    </tbody>
                                                    
                                                </table>
                                                <i class="fa fa-info-circle" style="color: grey;"  aria-hidden="true"> Data is Transferred!</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">{{__('Ceding/Broker')}}</label>
                                                <select id="slipcedingbroker" name="slipcedingbroker" class="e1 form-control form-control-sm ">
                                                    <option value="placeholder"  selected disabled >Ceding or Broker</option>
                                                    @if($brokerchoice)
                                                        @foreach ($brokerchoice as $cbc)
                                                            <option value="{{ $cbc->ceding_id }}">{{ $cbc->code }} - {{ $cbc->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                    @foreach($broker as $cb)
                                                        <option value="{{ $cb->id }}"> {{ $cb->code }} - {{ $cb->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>    
                                            <div class="form-group">
                                                <label for="">{{__('Source')}}</label>
                                                <select id="slipceding" name="slipceding" class="e1 form-control form-control-sm ">
                                                    <option value="placehoder" selected disabled>Ceding </option>
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
                                                    <select id="slipcob" name="slipcob" class="e1 form-control form-control-sm ">
                                                        <option selected readonly  value='0'>{{__('COB list')}}</option>
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
                                                        <option selected readonly  value='0'>{{__('KOC list')}}</option>
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
                                            <label for="">{{__('Occupacy')}}</label>
                                                <select id="slipoccupacy" name="slipoccupacy" class="e1 form-control form-control-sm ">
                                                <option selected disabled>{{__('Occupation list')}}</option>
                                                @foreach($ocp as $ocpy)
                                                <option value="{{ $ocpy->id }}">{{ $ocpy->code }} - {{ $ocpy->description }}</option>
                                                @endforeach
                                                </select>
                                        </div>    
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('Building Const')}}</label>
                                            <select id="slipbld_const" name="slipbld_const" class="e1 form-control form-control-sm ">
                                                <option selected disabled>{{__('Building Const list')}}</option>
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
                                                    <input type="text" id="slipbcla" name="slipbcla" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('Rate Upper Area')}}</label>
                                                    <input type="text" id="slipbcua" name="slipbcua" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" placeholder="" readonly="readonly" />
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
                            
                            <div class="tab-pane fade" id="insured-details-id" href="#insured-details-id" role="tabpanel" aria-labelledby="insured-details">
                                        
                                    <input type="hidden" name="msitsi" id="msitsi" value="">
                                    <input type="hidden" name="msisharev" id="msisharev" value="">
                                    <input type="hidden" name="msisumsharev" id="msisumsharev" value="">
                    
                                    <input type="hidden" name="msitsi" id="msitsi" value="">
                                    <input type="hidden" name="msisharev" id="msisharev" value="">
                                    <input type="hidden" name="msisumsharev" id="msisumsharev" value="">

                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{__('TSI/Ceding Share') }}</label>
                                                        <select id="sliptypetsi" name="sliptype" class="form-control form-control-sm ">
                                                            <option selected disabled>{{__('Select Share')}}</option>
                                                            <option value="1">Total Sum Insured</option>
                                                            <option value="2">Ceding Share</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""  >{{__('TSI/Ceding Share Value') }}</label>
                                                        <input type="hidden" id="sliptotalsum" value="" name="sliptotalsum" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"   />
                                                        <input type="text" id="sliptotalsum2" value="" name="sliptotalsum2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" disabled  />
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
                                                            {{-- <option selected disabled>{{__('Select Type')}}</option> --}}
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
                                                                    <input type="text" id="slippct" name="slippct" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" placeholder="pct" />
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
                                                        <input type="hidden"  id="sliptotalsumpct" name="sliptotalsumpct" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-150"   />
                                                        <input type="text"  id="sliptotalsumpct2" name="sliptotalsumpct2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-150"  disabled />
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
                                                                            <!-- <th>{{__('Currency')}}</th> -->
                                                                            <th>{{__('Percentage %')}}</th>
                                                                            <th>{{__('Amount')}}</th>
                                                                            <th>{{__('Min Claim Amount')}}</th>
                                                                            <th width="20%">{{__('Actions')}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($deductiblelist as $isl)
                                                                        <tr id="iiddeductible{{ $isl->id }}">
                                                                            <td>{{ $isl->DeductibleType->description }}</td>
                                                                            <!-- <td>{{ @$isl->currency->code}} - {{@$isl->currency->symbol_name }}</td> -->
                                                                            <td>{{ $isl->percentage }}</td>
                                                                            <td class="uang">@currency($isl->amount)</td>
                                                                            <td>@currency($isl->min_claimamount)</td>
                                                                            <td><a href="#" onclick="deletedeductibledetail({{ $isl->id }})">delete</i></a></td>
                                                                        </tr>   
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td >
                                                                                <div class="form-group">
                                                                                    <select id="slipdptype" name="slipdptype" class="form-control form-control-sm ">
                                                                                        <option selected disabled>{{__('Type')}}</option>
                                                                                        @foreach($deductibletype as $dt)
                                                                                        <option value="{{ $dt->id }}">{{ $dt->abbreviation }} - {{ $dt->description }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <input type="text" id="slipdppercentage" name="slipdppercentage" placeholder="x" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" />
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" id="slipdpamount" name="slipdpamount" placeholder="=x*tsi" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  />
                                                                                    <input type="text" id="slipdpamount2" name="slipdpamount2" placeholder="=x*tsi" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" disabled />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"   id="slipdpminamount" name="slipdpminamount" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" />
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
                                                    {{__('Extend Coverage')}}
                                                </div>
                                                <div class="card-body bg-light-gray ">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12 com-sm-12 mt-3">
                                                                <table id="ExtendCoveragePanel" class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{__('Peril Code - Name')}}</th>
                                                                            <th>{{__('Rate (permil ')}} &permil; )</th>
                                                                            <th>{{__('Amount')}}</th>
                                                                            <th width="20%">{{__('Actions')}}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($extendcoveragelist as $isl)
                                                                        <tr id="iidextendcoverage{{ $isl->id }}">
                                                                            <td>{{ @$isl->extendcoveragedata->code}} - {{ @$isl->extendcoveragedata->name}} - {{@$isl->extendcoveragedata->description }}</td>
                                                                            <td>{{ $isl->percentage }}</td>
                                                                            <td class="uang">@currency($isl->amount)</td>
                                                                            <td><a href="#" onclick="deleteextendcoveragedetail({{ $isl->id }})">delete</i></a></td>
                                                                        </tr>   
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td >
                                                                                <div class="form-group">
                                                                                    <select id="slipcncode" name="slipcncode" class="e1 form-control form-control-sm ">
                                                                                        <option selected readonly>{{__('Peril List')}}</option>
                                                                                        @foreach($extendedcoverage as $ncd)
                                                                                        <option value="{{ $ncd->id }}">{{ $ncd->code }} - {{ $ncd->name }} - {{ $ncd->description }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="slipnilaiec" name="slipnilaiec" placeholder="y &permil;" class="form-control form-control-sm floatTextBox2"/>
                                                                                    <input type="text" id="sliptotalnilaiec" name="sliptotalnilaiec" placeholder="sum y &permil;" hidden="true" class="form-control form-control-sm floatTextBox2"/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" id="slipamountec" name="slipamountec" placeholder="=y*tsi" class="form-control form-control-sm amount " />
                                                                                    <input type="text" id="slipamountec2" name="slipamountec2" placeholder="=y*tsi" class="form-control form-control-sm amount " disabled/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <button type="button" id="addextendcoverageinsured-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
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
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>{{__('Insurance Periode')}}:</label>
                                                        {{-- <div class="input-group date" id="dateinfrom" data-target-input="nearest"> --}}
                                                            <input type="text" class="form-control form-control-sm tanggal" data-target="#date" id="slipipfrom" name="slipipfrom" maxlength = "10">
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
                                                            <input type="text" class="form-control form-control-sm datepicker-input tanggal" data-target="#date" id="slipipto" maxlength = "10" name="slipipto" >
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
                                                            <input type="text" class="form-control form-control-sm datetimepicker-input tanggal" data-target="#date" id="sliprpfrom" maxlength = "10" name="sliprpfrom" >
                                                            
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
                                                            <input type="text" class="form-control form-control-sm datetimepicker-input tanggal" data-target="#date" id="sliprpto" maxlength = "10" name="sliprpto" >
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
                                        <i class="fa fa-info-circle" id="labelnp" style="color: grey;" aria-hidden="true"> non proportional panel</i>
                                    </div>
                                    
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-4">
                                            <label class="cl-switch cl-switch-green">
                                                <span for="switch-proportional" class="label"> {{__('Proportional')}} </span>
                                                <input type="checkbox" name="slipproportional[]" id="switch-proportional"
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
                                                    <option selected disabled>{{__('Choose layer')}}</option>
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
                                                            <option selected disabled>{{__('Select Share')}}</option>
                                                            <option value="1">Total Sum Insured</option>
                                                            <option value="2">Ceding Share</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" >{{__('TSI/Ceding Share Value') }}</label>
                                                        <input type="hidden" id="sharetotalsum" value="" name="sharetotalsum" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"   />
                                                        <input type="text" id="sharetotalsum2" value="" name="sharetotalsum2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" disabled  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{__('Rate (permil.. ')}} &permil;)</label>
                                                        <input type="text"  id="sliprate" name="sliprate" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""  >{{__('Total Rate') }}</label>
                                                        <input type="hidden" id="sliptotalrate" value="" name="sliptotalrate" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50"   />
                                                        <input type="text" id="sliptotalrate2" value="" name="sliptotalrate2" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" disabled  />
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
                                                    <input type="text" id="slipbasicpremium" name="slipbasicpremium" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  />
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
                                                                    <input type="text"  id="slipshare" name="slipshare" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50"  />
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
                                                        <input type="hidden" id="slipsumshare" name="slipsumshare"  class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  />
                                                        <input type="text" id="slipsumshare2" name="slipsumshare2"  class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" disabled/>
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
                                                                    <input type="text" id="slipcommission" name="slipcommission" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50"  />
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
                                                        <input type="hidden" id="slipsumcommission" name="slipsumcommission" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"   />
                                                        <input type="text" id="slipsumcommission2" name="slipsumcommission2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"   />
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
                                                                    <input type="text" id="slipvbroker" name="slipvbroker" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" placeholder="a" />
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
                                                                    <input type="hidden"  id="slipsumfee" name="slipsumfee"  class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  />
                                                                    <input type="text"  id="slipsumfee2" name="slipsumfee"  class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"   />
                                                                    
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
                                                        <input type="hidden" id="slipgrossprmtonr" name="slipgrossprmtonr" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" placeholder="a &permil;  * tsi * b%"  />
                                                        <input type="text" id="slipgrossprmtonr2" name="slipgrossprmtonr2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">{{__('Net Prm to NR')}}</label>
                                                        <input type="hidden" id="slipnetprmtonr" name="slipnetprmtonr" class="form-control form-control-sm amount " data-validation="length" placeholder="=a &permil;. * b% * tsi * (100% - d%)" data-validation-length="0-50" />
                                                        <input type="text" id="slipnetprmtonr2" name="slipnetprmtonr2" class="form-control form-control-sm amount " data-validation="length"  data-validation-length="0-50" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="tab-pane fade" id="installment-details-id" href="#installment-details-id" role="tabpanel" aria-labelledby="installment-details">
                                
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
                                                                        <th>{{__('Percentage %')}}</th>
                                                                        <th>{{__('Amount')}}</th>
                                                                        <th width="20%">{{__('Actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($installmentlist as $isl)
                                                                        <tr id="iidinstallment{{ $isl->id }}">
                                                                            <td>{{ $isl->installment_date }}</td>
                                                                            <td>{{ $isl->percentage }}</td>
                                                                            <td class="uang">@currency($isl->amount)</td>
                                                                            <td><a href="#" onclick="deleteinstallmentdetail({{ $isl->id }})">delete</i></a></td>
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
                                                                                    <input type="text"  id="slipippercentage" name="slipippercentage" placeholder="w" class="form-control form-control-sm floatTextBox2"/>
                                                                                    <div class="input-group-append">
                                                                                        <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="slipipamount" name="slipipamount" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount " />
                                                                                    <!-- <input type="text" id="slipipamount2" name="slipipamount2" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount" /> -->
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="sliptotalpercentinspan" class="form-control form-control-sm floatTextBox2" name="sliptotalpercentinspan" hidden="true" >
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

                                <div class="row">
                                    <div class="col-md-6 d-flex justify-content-start">
                                        <div class="form-group">
                                            <label for="">{{__('Retro Backup?')}}</label>
                                            <select id="sliprb" name="sliprb" class="form-control form-control-sm ">
                                                {{-- <option selected readonly>{{__('Select Continent')}}</option> --}}
                                                <option value="NO"  >NO</option>
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
                                                        <div class="input-group" lang="en-US">
                                                            <input type="text" id="slipor" value="100" name="slipor" class="form-control form-control-sm floatTextBox2" data-validation="length" data-validation-length="0-50" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="slipsumor"  name="slipsumor" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50"  />
                                                            <input type="text" id="slipsumor2"  name="slipsumor2" class="form-control form-control-sm amount " data-validation="length" data-validation-length="0-50" disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                                        <th>{{__('Type')}}</th>
                                                                        <th>{{__('Retrocession Contract')}}</th>
                                                                        <th>{{__('Percentage %')}}</th>
                                                                        <th>{{__('Amount')}}</th>
                                                                        <th width="20%">{{__('Actions')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php setlocale(LC_MONETARY, 'id_ID'); ?>
                                                                    @foreach($retrocessionlist as $isl)
                                                                    <tr id="iidretrocession{{ $isl->id }}">
                                                                        <td>{{ $isl->type }}</td>
                                                                        <td>{{ $isl->contract }}</td>
                                                                        <td>{{ $isl->percentage }}</td>
                                                                        <td class="uang">@currency($isl->amount)</td>
                                                                        <td><a href="#" onclick="deleteretrocessiondetail({{ $isl->id }})">delete</i></a></td>
                                                                    </tr>   
                                                                    @endforeach
                                                                    
                                                                </tbody>
                                                                <tfoot>
                                                                    <form id="addretrocession">
                                                                    @csrf   
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select id="sliprptype" name="sliprptype" class="form-control form-control-sm ">
                                                                                        <option selected disabled>{{__('Type list')}}</option>
                                                                                        <option value="NM XOL">NM XOL</option>
                                                                                    </select>
                                                                                </div>  
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select id="sliprpcontract" name="sliprpcontract" class="form-control form-control-sm ">
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
                                                                                                <input type="text" id="sliprppercentage" name="sliprppercentage" class="form-control form-control-sm floatTextBox2" />
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
                                                                                    <input type="hidden" id="sliprpamount" name="sliprpamount" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount " />
                                                                                    <input type="text" id="sliprpamount2" name="sliprpamount2" placeholder="= w% * net premium to NR" class="form-control form-control-sm amount " disabled/>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" id="sliptotalpercentrpor" value="0" name="sliptotalpercentrpor">
                                                                                    <button type="button" id="addretrocessioninsured-btn" class="btn btn-md btn-primary" data-toggle="modal" data-target="#adduser">{{__('Add')}}</button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </form>
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
                                                    <button type="submit" id="addslipinsured-btn" class="btn btn-primary btn-block ">
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
                        <ul class="nav nav-tabs nav-tabs-bottom" id="custom-tabs-three-tabbottom" role="tablist">
                            
                            <li class="pt-1 px-3"><h3 class="card-title">{{__('Slip Form')}}</h3></li>
                            
                            <li class="nav-item active" href="#general-details-id">
                                <a class="nav-link active" id="general-details" data-toggle="pill" href="#general-details-id" role="tab" aria-controls="general-details-id" aria-selected="true">{{__('General Data')}}</a>
                            </li>

                            <li class="nav-item" href="#insured-details-id">
                                <a class="nav-link" id="insured-details" data-toggle="pill" href="#insured-details-id" role="tab" aria-controls="address-details-id" aria-selected="false">{{__('Insured Data & Insurance Measurement')}}</a>
                            </li>
                            
                            <li class="nav-item" href="#installment-details-id">
                                <a class="nav-link" id="installment-details" data-toggle="pill" href="#installment-details-id" role="tab" aria-controls="installment-details-id" aria-selected="false">{{__('Installment & Retrocession')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                        
            </form>

        </div> 
    </div> 

</div>