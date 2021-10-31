@extends('crm.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

      <div class="container-fluid">
         
        {{-- NOTE Show All Errors Here --}}
        @include('crm.layouts.error')
        
        <form method="POST" action={{url('master-data/insuredmarinetype/store')}}>
          @csrf
        <div class="card">
          <div class="card-header bg-gray">
            {{__('Insured Marine Type Data')}}
          </div>
          
          <div class="card-body bg-light-gray ">
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__(' Code')}} </label>
                          <input type="text" name="imtcode" style="width: 25%" class="form-control form-control-sm" data-validation="length" data-validation-length="1-16" value="{{ $code_imt }}" readonly="readonly" required/>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Name')}}</label>
                          <input type="text" name="imtname" class="form-control form-control-sm " data-validation="length" data-validation-length="0-250"/>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Description')}}</label>
	                      	<textarea name="imtdescription" class="form-control form-control-sm ">
	                      		
	                      	</textarea>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('COB')}}</label>
                          <select name="imtcob" class="form-control form-control-sm e1">
                              <option selected disabled>{{__('Select COB')}}</option>
                              @foreach($cob as $cco)
                              <option value="{{ $cco->id }}">{{ $cco->code }} - {{ $cco->description }}</option>
                              @endforeach
                          </select>
                      </div>    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Group type')}}</label>
                          <select name="imtgrouptype" class="form-control form-control-sm e1">
                              <option selected disabled>{{__('Select Group Type')}}</option>
                              
                              <option value="1">WAR</option>
                              <option value="2">HM+IV</option>
                              
                          </select>
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
                        <button class="btn btn-primary btn-block ">
                            {{__('Save Insured Marine Type')}}
                        </button>
                    </div>
                   
                </div>
            </div>
        </div> 
        
        
    </form>

    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 com-sm-12 mt-3">
                  <div class="table-responsive">
                    <table id="insuredmarinetypeTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>{{__('Code')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('COB')}}</th>
                        <th>{{__('Group Type')}}</th>
                        <th width="20%">{{__('Actions')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach (@$insuredmarine as $ii)
                              <tr>
                                <td>{{@$ii->code}}</td>
                                <td>{{@$ii->type}}</td>
                                <td>@if($ii->keterangan) {{$ii->keterangan}} @else - @endif</td>
                                <td>@if($ii->cob) {{@$ii->cob_data->description}} @else - @endif</td>
                                <td>@if($ii->group_type == 1) WAR @elseif($ii->group_type == 2) HM+IV @else - @endif</td>
                                <td>
                                  <a href="#" data-toggle="tooltip" data-title="{{$ii->created_at->toDayDateTimeString()}}" class="mr-3">
                                    <i class="fas fa-clock text-info"></i>
                                  </a>
                                  <a href="#" data-toggle="tooltip" data-title="{{$ii->updated_at->toDayDateTimeString()}}" class="mr-3">
                                    <i class="fas fa-history text-primary"></i>
                                  </a>
                                  <span>
                                    {{-- @can('update-insuredmarinetype', User::class) --}}
                                      <a class="text-primary mr-3" data-toggle="modal" data-target="#updateinsuredmarinetype{{$ii->id}}">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                    {{-- @endcan --}}
  
                                    <div class="modal fade" id="updateinsuredmarinetype{{$ii->id}}" tabindex="-1" user="dialog" aria-labelledby="updateinsuredmarinetype{{$ii->id}}Label" aria-hidden="true">
                                      <div class="modal-dialog" user="document">
                                        <div class="modal-content bg-light-gray">
                                          <div class="modal-header bg-gray">
                                            <h5 class="modal-title" id="updateinsuredmarinetype{{$ii->id}}Label">{{__('Update Insured Marine Type')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="{{url('master-data/insuredmarinetype',$ii)}}" method="POST">
                                              <div class="modal-body">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="row">
                                                    <div class="col-md-4 col-md-12">
                                                      <div class="form-group">
                                                        <label for="">{{__('Code')}}</label>
                                                        <input type="text" name="codeimt" class="form-control" value="{{$ii->code}}" data-validation="length" data-validation-length="1-16" readonly="readonly" required/>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-6 col-md-12">
                                                      <div class="form-group">
                                                        <label for="">{{__('Name')}}</label>
                                                        <input type="text" name="nameimt" class="form-control" value="{{$ii->type}}" data-validation="length" data-validation-length="0-150" />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-6 col-md-12">
                                                      <div class="form-group">
                                                        <label for="">{{__('Description')}}</label>
                                                      	<textarea name="descriptionimt" class="form-control">
                                                      		{{$ii->keterangan}}
                                                      	</textarea>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-6 col-md-12">
                                                      <div class="form-group">
                                                          <label for="">{{__('COB')}}</label>
                                                          <select name="cobimt" class="form-control form-control-sm e1">
                                                              <option selected disabled>{{__('Select COB')}}</option>
                                                              @foreach($cob as $cco)
                                                                @if($ii->cob  == $cco->id)
                                                                <option value="{{ $cco->id }}" selected>{{ $cco->code }} - {{ $cco->description }}</option>
                                                                @else
                                                                <option value="{{ $cco->id }}">{{ $cco->code }} - {{ $cco->description }}</option>
                                                                @endif
                                                              @endforeach
                                                          </select>
                                                      </div>    
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-md-12">
                                                      <div class="form-group">
                                                          <label for="">{{__('Group type')}}</label>
                                                          <select name="grouptypeimt" class="form-control form-control-sm e1">
                                                              <option selected disabled>{{__('Select Group Type')}}</option>
                                                              
                                                              <option value="1">WAR</option>
                                                              <option value="2">HM+IV</option>
                                                              
                                                          </select>
                                                      </div>    
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                                  <input type="submit" class="btn btn-info" value="Update">
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                  </div>
                                  {{-- Edit Modal Ends --}}
  
                                    {{-- @can('delete-country', User::class) --}}
                                      <span id="delbtn{{@$ii->id}}"></span>
                                        <form id="delete-insuredmarinetype-{{$ii->id}}"
                                            action="{{ url('master-data/insuredmarinetype/destroy', $ii->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                      </span>
                                  {{-- @endcan   --}}
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

  </div>
  </div>
@endsection

@section('scripts')
@include('crm.master.insuredmarinetype_js')
@endsection