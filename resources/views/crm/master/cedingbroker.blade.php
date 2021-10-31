@extends('crm.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

      <div class="container-fluid">
         
        {{-- NOTE Show All Errors Here --}}
        @include('crm.layouts.error')
        

        <form method="POST" action={{url('master-data/cedingbroker/store')}}>
          @csrf
        <div class="card">
          <div class="card-header bg-gray">
            {{__('New Ceding Broker Data')}}
          </div>
          
          <div class="card-body bg-light-gray ">
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Enter Code')}} </label>
                          <input type="text" id="codecedbrok" style="width: 25%;" name="codebroker" class="form-control form-control-sm" data-validation="length" data-validation-length="1-12" value="" readonly="readonly" placeholder="input type and company name first" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{__('Type')}}</label>
                        <select name="type" class="form-control form-control-sm e1">
                            <option selected disabled>{{__('Select Type')}}</option>
                            @foreach($companytype as $ct)
                              <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                            @endforeach
                        </select>
                    </div>    
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{__('Company Name')}}</label>
                        <input type="text" id="companynamefield" name="companyname" class="form-control form-control-sm " placeholder="please input with Uppercase letter in the beginning" data-validation="length" data-validation-length="0-50" required/>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Name')}}</label>
                          <input type="text" name="name" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" required/>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Address')}}</label>
                          <textarea name="address" class="form-control form-control-sm " data-validation="length" data-validation-length="0-50" required/></textarea>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">{{__('Country')}}</label>
                          <select name="crccountry" class="e1 form-control form-control-sm ">
                              <option selected disabled>{{__('Select Country')}}</option>
                              @foreach($country as $cty)
                              <option value="{{ $cty->id }}">{{ $cty->id }} - {{ $cty->name }}</option>
                              @endforeach
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
                            {{__('Save Ceding Broker')}}
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
                   
                    <table id="cedingbrokerTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>{{__('Code')}}</th>
                        <th width="300px">{{__('Name')}}</th>
                        <th>{{__('Company Name')}}</th>
                        <th>{{__('Address')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('Type')}}</th>
                        <th width="300px">{{__('Actions')}}</th>
                      </tr>
                      </thead>
                       
                    </table>

                  <div class="pull-right">
                  </div>

                </div>
               
            </div>
        </div>
    </div> 

  </div>
  </div>
@endsection

@section('scripts')
@include('crm.master.cedingbroker_js')
@endsection