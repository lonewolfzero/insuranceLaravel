
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
            {{$route_active}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 com-sm-12 mt-3">
                
                  {!! link_to('transaction-data/fe/entry','Add Data',['class'=>'btn btn-primary']) !!}
                  <hr>
                  {{ Form::open(array('url'=>'transaction-data/fe/index')) }}
                      <div class="row">
                          <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Insured Number')}}</label>
                                        {{ Form::text('searchdata',@$searchdata,['class'=>'form-control form-control-sm','placeholder'=>'Cari Number']) }}
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
  
                  <div class="pull-right">
                  </div>

                  <table id="felookupTable2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>{{__('Number')}}</th>
                      <th>{{__('Insured')}}</th>
                      <th>{{__('UY')}}</th>
                      <th>{{__('All Ceding Share')}}</th>
                      <th>{{__('National Reinsurance')}}</th>
                      <th>{{__('Total Sum Insurance')}}</th>
                      <th>{{__('Currency')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach (@$insuredlist as $insureddata)
                            <tr>
                              <td ><a href="{{  url('transaction-data/'.$insureddata->slip_type.'/detailform', base64_encode($insureddata->id)) }}">{{@$insureddata->number}}</a></td>
                              <td> 
                                    @if(strlen($insureddata->insured_suffix) > 50)
                                            @if($insureddata->prefix_id == 1)
                                              PT 
                                            @else 
                                              CV 
                                            @endif 
                                            <br> 

                                              @php echo strtoupper($insureddata->insured_name) ; @endphp
                                              
                                            @if($insureddata->insured_suffix) 
                                            - <br>
                                              @php
                                              
                                              echo substr(strtoupper(@$insureddata->insured_suffix),0,30);
                                              echo "<br>";
                                              echo substr(strtoupper(@$insureddata->insured_suffix),30,60);
                                              echo "<br>";
                                              echo substr(strtoupper(@$insureddata->insured_suffix),60,90);
                                              
                                              @endphp
                                            @endif
                                      @else
                                            @if($insureddata->prefix_id == 1)
                                              PT 
                                            @else 
                                              CV 
                                            @endif 

                                            @php echo strtoupper($insureddata->insured_name) ; @endphp
                                            
                                            @if($insureddata->insured_suffix) -  @php echo strtoupper($insureddata->insured_suffix);  @endphp
                                              
                                            @endif
                                      @endif
                              </td>

                              <td>{{@$insureddata->uy }}</td>
                              <td>{{ number_format(@$insureddata->share, 2, '.', ',') }}</td>
                              <td>{{ number_format(@$insureddata->share_from, 2, '.', ',') }}</td>
                              <td>{{ number_format(@$insureddata->share_to, 2, '.', ',') }}</td>
                              <td>{{@$insureddata->currency->code}} - {{@$insureddata->currency->symbol_name}}</td>
                              <td>
                               
                                
                              </td>

                            </tr>
                            
                            <tr>
                              <th></th>
                              <th>{{__('Slip Number')}}</th>
                              <th>{{__('COB')}}</th>
                              <th>{{__('Ceding/Broker')}}</th>
                              <th>{{__('Ceding')}}</th>
                              <th>{{__('Endorsement')}}</th>
                              <th>{{__('Status Slip')}}</th>
                              <th>{{__('User Entry')}}</th>
                            </tr>
                            @foreach (@$insureddata->slipdata as $slipdata)
                            <tr>
                              
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
@include('crm.transaction.facultative.js.index_facultative_js')
@endsection