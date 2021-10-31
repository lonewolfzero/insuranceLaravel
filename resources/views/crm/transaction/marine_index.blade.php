@extends('crm.layouts.app')

<style type="text/css">    
      #map {
        margin: 10px;
        width: 600px;
        height: 300px;  
        padding: 10px;
      }
</style>

@section('content')
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            
            {{-- NOTE Show All Errors Here --}}
            @include('crm.layouts.error')
             
                <div class="card card-primary">
                    <div class="card-header bg-gray">
                        {{__('Marine - Slip and Insured Data')}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 com-sm-12 mt-3">
                          
                  {!! link_to('transaction-data/marine-slip','Add Data Marine Cargo',['class'=>'btn btn-primary']) !!}
                  {!! link_to('transaction-data/marine-hull-slip','Add Data Marine Hull',['class'=>'btn btn-primary']) !!}
                  <hr>
                  {{ Form::open(array('url'=>'transaction-data/marine-index')) }}
                      <div class="row">
                          <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Insured Number')}}</label>
                                        {{ Form::text('search',@$search,['class'=>'form-control form-control-sm','placeholder'=>'Cari Number']) }}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Insured Name')}}</label>
                                        {{ Form::text('searchinsured',@$searchinsured,['class'=>'form-control form-control-sm','placeholder'=>'Cari Insured']) }}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('UY')}}</label>
                                        {{ Form::text('searchuy',@$searchuy,['class'=>'form-control form-control-sm','placeholder'=>'Cari UY']) }}
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">{{__('COB')}}</label><br>
                                      <select id="searchcob" name="searchcob" class="e1 form-control form-control-sm ">
                                          <option selected readonly  value='0'>{{__('COB list')}}</option>
                                          @foreach($cob as $boc)
                                            @if($boc->id  == @$searchcob)
                                                <option value="{{ $boc->id }}" selected>{{ $boc->code }} - {{ $boc->description }}</option>
                                            @else
                                                <option value="{{ $boc->id }}">{{ $boc->code }} - {{ $boc->description }}</option>
                                            @endif
                                          @endforeach
                                      </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Ceding / Broker')}}</label><br>
                                        <select id="searchceding" name="searchceding" class="e1 form-control form-control-sm ">
                                            <option value=""  selected disabled >Ceding or Broker</option>
                                            @foreach($cedingbroker as $cb)
                                                @if($cb->id  == @$searchceding)
                                                <option value="{{ $cb->id }}" selected> {{ $cb->code }} - {{ $cb->name }}</option>
                                                @else
                                                <option value="{{ $cb->id }}"> {{ $cb->code }} - {{ $cb->name }}</option>
                                                 @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Slip Number')}}</label>
                                          {{ Form::text('searchslipnum',@$searchslipnum,['class'=>'form-control form-control-sm','placeholder'=>'Slip Number']) }}
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">{{__('Search')}}</button>
                          </div>
                        </div>
                      </div>
                  {{ Form::close() }}
                            <hr>
                            <table id="marineslip" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                <th>{{__('Number')}}</th>
                                <th>{{__('UY')}}</th>
                                <th>{{__('Slip Type')}}</th>
                                <th>{{__('Insured')}}</th>
                                <th>{{__('All Ceding Share')}}</th>
                                <th>{{__('National Reinsurance Share')}}</th>
                                <th>{{__('Total Sum Insurance')}}</th>
                                <th>{{__('Currency')}}</th>                                </tr>
                                </thead>
                                <tbody>
                                    @foreach (@$insured as $insdata)
                                            <tr>
                                                <td>@if($insdata->slip_type == "mc")<a href="{{  url('transaction-data/updatemarineslip', base64_encode($insdata->id)) }}">{{@$insdata->number}}</a>@elseif($insdata->slip_type == "mh")<a href="{{  url('transaction-data/updatemarinehullslip', base64_encode($insdata->id)) }}">{{@$insdata->number}}</a>@endif</td>
                                                <td>{{$insdata->uy}}</td>
                                                <td>@if($insdata->slip_type == "mc")Marine Cargo @elseif($insdata->slip_type == "mh")Marine Hull @endif</td>
                                                <td>
                                                    @if(strlen($insdata->insured_suffix) > 35)
                                                        @if($insdata->prefix_id == 1)
                                                          PT 
                                                        @else 
                                                          CV 
                                                        @endif 
                                                        <br> 

                                                          @php echo strtoupper($insdata->insured_name) ; @endphp

                                                        @if($insdata->insured_suffix) 
                                                        - <br>
                                                          @php
                                                          
                                                          echo substr(strtoupper(@$insdata->insured_suffix),0,15);
                                                          echo "<br>";
                                                          echo substr(strtoupper(@$insdata->insured_suffix),15,30);
                                                          echo "<br>";
                                                          echo substr(strtoupper(@$insdata->insured_suffix),30,45);
                                                          echo "<br>";
                                                          echo substr(strtoupper(@$insdata->insured_suffix),45,60);
                                                          echo "<br>";
                                                          echo substr(strtoupper(@$insdata->insured_suffix),60,75);
                                                          echo "<br>";
                                                          echo substr(strtoupper(@$insdata->insured_suffix),75,90);
                                                          
                                                          @endphp
                                                        @endif
                                                  @else
                                                        @if($insdata->prefix_id == 1)
                                                          PT 
                                                        @else 
                                                          CV 
                                                        @endif 
          
                                                        @php echo strtoupper($insdata->insured_name) ; @endphp
                                                        
                                                        @if($insdata->insured_suffix) -  @php echo strtoupper($insdata->insured_suffix);  @endphp
                                                          
                                                        @endif
                                                  @endif
                                                </td>
                                                <td>{{ number_format((float)$insdata->share, 2, '.', ',') }}</td>
                                                <td>{{ number_format((float)$insdata->share_from, 2, '.', ',') }}</td>
                                                <td>{{ number_format((float)$insdata->share_to, 2, '.', ',') }}</td>
                                                <td>{{@$insdata->currency->curr->code}} - {{@$insdata->currency->curr->symbol_name}}</td>
                                                <td width="10%">
                                                </td> 

                                            </tr>

                                            <tr>
                                                  <th></th>
                                                  <th></th>
                                                  <th>{{__('Slip Number')}}</th>
                                                  <th>{{__('COB')}}</th>
                                                  <th>{{__('Ceding/Broker')}}</th>
                                                  <th>{{__('Ceding')}}</th>
                                                  <th>{{__('Endorsement')}}</th>
                                                  <th>{{__('Status Slip')}}</th>
                                                  <th>{{__('User Entry')}}</th>
                                            </tr>
                                        @foreach (@$insdata->slipdata as $slipdata)
                                            <tr>
                                                  <td></td>
                                                  <td></td>
                                                  <td>{{@$slipdata['number'] }}</td>
                                                  <td>{{@$slipdata['cobdata']->code }} - {{@$slipdata['cobdata']->description }}</td>
                                                  <td>{{@$slipdata['brokerdata']->name}} - {{@$slipdata['brokerdata']->company_name }}</td>
                                                  <td>{{@$slipdata['cedingdata']->name}} - {{@$slipdata['cedingdata']->company_name }}</td>
                                                  <td>{{@$slipdata['endorsment']}}</td>
                                                  <td>{{@$slipdata['status']}}</td>
                                                  <td>{{@$slipdata['username']}}</td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                </tbody>
                                
                            </table>

                            {!! $insured->render() !!}

                            </div>
                        
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection

@section('scripts')
@include('crm.transaction.marine_index_js')
@endsection
