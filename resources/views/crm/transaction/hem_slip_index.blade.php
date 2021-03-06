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
            {{__('HE & MOTOR INDEX')}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 com-sm-12 mt-3">
                
                  {!! link_to('transaction-data/hem-slip','Add Data',['class'=>'btn btn-primary']) !!}
                  <hr>
                  {{ Form::open(array('url'=>'transaction-data/hem-slipindex')) }}
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
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">{{__('Our Share')}}</label>
                                        {{ Form::text('searchshare',@$searchshare,['class'=>'form-control form-control-sm','placeholder'=>'Our Share']) }}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">{{__('Nasional RE Share')}}</label>
                                       {{ Form::text('searchnre',@$searchnre,['class'=>'form-control form-control-sm','placeholder'=>'National Reinsurance']) }}
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
                                        <label for="">{{__('Total Sum Insurance')}}</label>
                                          {{ Form::text('searchtsi',@$searchtsi,['class'=>'form-control form-control-sm','placeholder'=>'Total Sum Insurance']) }}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="">{{__('Endorsement')}}</label>
                                        {{ Form::text('searchendorse',@$searchendorse,['class'=>'form-control form-control-sm','placeholder'=>'Endorsement Count']) }}
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
                          <button type="submit" class="btn btn-md btn-primary">{{__('Search')}}</button>
                        </div>
                      </div>
                  {{ Form::close() }}

                  <hr>
                  <table id="felookupTable2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>{{__('Number')}}</th>
                      <th>{{__('Insured')}}</th>
                      <th>{{__('UY')}}</th>
                      <th>{{__('Our Share')}}</th>
                      <th>{{__('National Reinsurance')}}</th>
                      <th>{{__('Total Sum Insurance')}}</th>
                      <th>{{__('Endorsement Count')}}</th>
                      <th width="20%">{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach (@$insuredlist as $insureddata)
                            <tr>
                              <td ><a href="{{  url('transaction-data/updatehemslip', $insureddata->id) }}">{{@$insureddata->number}}</a></td>
                              <td> @php echo strtoupper($insureddata->insured_prefix); @endphp - 
                                   @php echo strtoupper($insureddata->insured_name);    @endphp- 
                                   @php echo strtoupper($insureddata->insured_suffix);  @endphp
                              </td>
                              <td>{{@$insureddata->uy }}</td>
                              <td>{{ number_format($insureddata->share,0) }}</td>
                              <td> {{ number_format($insureddata->share_from,0) }}</td>
                              <td> {{ number_format($insureddata->share_to,0) }}</td>
                              <td>{{@$insureddata->count_endorsement}}</td>
                              <td>
                                <a href="#" data-toggle="tooltip" data-title="{{$insureddata->created_at}}" class="mr-3">
                                  <i class="fas fa-clock text-info"></i>
                                </a>
                                <a href="#" data-toggle="tooltip" data-title="{{$insureddata->updated_at}}" class="mr-3">
                                  <i class="fas fa-history text-primary"></i>
                                </a>
                                <span>
                                
                                {{-- @can('update-felookup', User::class) --}}
                                {{--<a class="text-primary mr-3" href="{{ url('transaction-data/detailfeslip', $insureddata->id) }}">
                                  <i class="fas fa-file"></i>
                                </a>--}}
                                {{-- {!! link_to('transaction-data/detailfeslip/'.@$insureddata->id,'Detail Data',['class'=>'btn btn-primary']) !!} --}}
                                {{-- @endcan   --}}

                                {{-- @can('update-felookup', User::class) --}}
                                {{--<a class="text-primary mr-3" href="{{ url('transaction-data/updatefeslip', $insureddata->id) }}">
                                  <i class="fas fa-edit"></i>
                                </a>--}}
                                {{-- {!! link_to('transaction-data/updatefeslip/'.@$insureddata->id,'Edit Data',['class'=>'btn btn-primary']) !!} --}}
                                {{-- @endcan   --}}

                                  

                                   {{-- @can('delete-felookup', User::class) --}}

                                   {{--<span id="delbtn{{@$insureddata->id}}"></span>
                                
                                    <form id="delete-felookuplocation-{{$insureddata->id}}"
                                        action="{{ url('transaction-data/fe-slip/destroy', $insureddata->id) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>>--}}
                                  {{-- @endcan   --}}
                                </span>
                              </td>

                            </tr>

                            
                            <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th>{{__('Slip Number')}}</th>
                              <th>{{__('Cob')}}</th>
                              <th>{{__('Ceding/Broker')}}</th>
                              <th>{{__('Ceding')}}</th>
                              <th>{{__('Actions')}}</th>
                            </tr>
                            @foreach (@$insureddata->slipdata as $slipdata)
                            <tr>
                              
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>{{@$slipdata['number'] }}</td>
                              <td>{{@$slipdata['cobdata']->code }} - {{@$slipdata['cobdata']->description }}</td>
                              <td>{{@$slipdata['brokerdata']->name}} - {{@$slipdata['brokerdata']->company_name }}</td>
                              <td>{{@$slipdata['cedingdata']->name}} - {{@$slipdata['cedingdata']->company_name }}</td>
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
@include('crm.transaction.hem_slip_index_js')
@endsection