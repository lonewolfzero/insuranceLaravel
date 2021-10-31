@extends('crm.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

      <div class="container-fluid">
         
        {{-- NOTE Show All Errors Here --}}
        @include('crm.layouts.error')
        
        <form method="POST" action={{url('master-data/businesstype/store')}}>
          @csrf
        <div class="card">
          <div class="card-header bg-gray">
            {{__('New Business Type')}}
          </div>
          
          <div class="card-body bg-light-gray ">
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Enter Code')}} </label>
                          <input type="text" id="cobcode" style="width:25%;" name="code" class="form-control form-control-sm" data-validation="length" placeholder="enter code manually if not have parent data" data-validation-length="1-16" value="{{ $code }}" readonly="readonly" required/>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Name')}}</label>
                          <input type="text" name="name" class="form-control form-control-sm " data-validation="length" data-validation-length="0-150" required/>
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
                            {{__('Save Business Type')}}
                        </button>
                    </div>
                   
                </div>
            </div>
        </div> 
        
        
    </form>

    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
              <div class="table-responsive">
                <table id="cobTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>{{__('Code')}}</th>
                    <th>{{__('Name')}}</th>
                    <th width="20%">{{__('Actions')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach (@$business_type as $data)
                          <tr>
                            <td>{{@$data->code}}</td>
                            <td>{{@$data->name}}</td>
                            <td>
                              
                              <span>
                                {{-- @can('update-country', User::class) --}}
                                  <a class="text-primary mr-3" data-toggle="modal" data-target="#updatebt{{$data->id}}">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                {{-- @endcan --}}

                                <div class="modal fade" id="updatebt{{$data->id}}" tabindex="-1" user="dialog" aria-labelledby="updatebt{{$data->id}}Label" aria-hidden="true">
                                  <div class="modal-dialog" user="document">
                                    <div class="modal-content bg-light-gray">
                                      <div class="modal-header bg-gray">
                                        <h5 class="modal-title" id="updatebt{{$data->id}}Label">{{__('Update Business Type')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form action="{{url('master-data/businesstype',$data)}}" method="POST">
                                          <div class="modal-body">
                                              @csrf
                                              @method('PUT')
                                              <div class="row">
                                                <div class="col-md-6 col-md-12">
                                                  <div class="form-group">
                                                    <label for="">{{__('Code')}}</label>
                                                    <input type="text" name="code" class="form-control" value="{{$data->code}}" data-validation="length" data-validation-length="1-12" required readonly="readonly"/>
                                                  </div>
                                                </div>
                                              </div>


                                                <div class="col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                    <label for="">{{__('Name')}}</label>
                                                    <input type="text" name="name" class="form-control" value="{{$data->name}}" data-validation="length" data-validation-length="0-150" />
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

                                <span id="delbtn{{@$data->id}}"></span>
                              
                                  <form id="delete-cob-{{$data->id}}"
                                      action="{{ url('master-data/businesstype/destroy', $data->id) }}"
                                      method="POST">
                                      @method('DELETE')
                                      @csrf
                                  </form>
                                {{-- @endcan   --}}
                              </span>
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
@endsection

@section('scripts')
@include('crm.master.business_type_js')
@endsection