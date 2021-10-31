@extends('crm.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="container-fluid">

    {{-- NOTE Show All Errors Here --}}
    @include('crm.layouts.error')

    <form method="POST" action={{ url('master-data/typeofmindep/store') }}>
      @csrf
      <div class="card">
        <div class="card-header bg-gray">
          {{ __('New Master Type Of Mindep Data') }}
        </div>

        <div class="card-body bg-light-gray ">
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Code') }} </label>
                    <input type="text" id="code" name="code" class="form-control form-control-sm" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Description') }}</label>
                    <input type="text" name="description" class="form-control form-control-sm" required />
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
                {{ __('Save Type Of Mindep') }}
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
            <table id="typeOfMindepTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ __('Code') }}</th>
                  <th>{{ __('Description') }}</th>
                  <th width="20%">{{ __('Actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach (@$typeOfMindep as $typeOfMindepdata)
                <tr>
                  <td>{{ @$typeOfMindepdata->code }}</td>
                  <td>{{ @$typeOfMindepdata->description }}</td>


                  <td>
                    <a href="#" data-toggle="tooltip"
                      data-title="{{ @$typeOfMindepdata->created_at->toDayDateTimeString() }}" class="mr-3">
                      <i class="fas fa-clock text-info"></i>
                    </a>
                    <a href="#" data-toggle="tooltip"
                      data-title="{{ @$typeOfMindepdata->updated_at->toDayDateTimeString() }}" class="mr-3">
                      <i class="fas fa-history text-primary"></i>
                    </a>
                    <span>
                      @can('update-type-of-mindep', User::class)
                      <a class="text-primary mr-3" data-toggle="modal"
                        data-target="#updatetypeOfMindepdata{{ $typeOfMindepdata->id }}">
                        <i class="fas fa-edit"></i>
                      </a>
                      @endcan

                      <div class="modal fade" id="updatetypeOfMindepdata{{ $typeOfMindepdata->id }}" tabindex="-1"
                        user="dialog" aria-labelledby="updatetypeOfMindepdata{{ $typeOfMindepdata->id }}Label"
                        aria-hidden="true">
                        <div class="modal-dialog" user="document">
                          <div class="modal-content bg-light-gray">
                            <div class="modal-header bg-gray">
                              <h5 class="modal-title" id="updatetypeOfMindepdata{{ $typeOfMindepdata->id }}Label">
                                {{ __('Update Description Loss') }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ url('master-data/typeofmindep', $typeOfMindepdata) }}" method="POST">
                              <div class="modal-body">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Code') }}</label>
                                      <input type="text" name="code" class="form-control"
                                        value="{{ $typeOfMindepdata->code }}" required />
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Description') }}</label>
                                      <input type="text" name="description" class="form-control"
                                        value="{{ $typeOfMindepdata->description }}" required />
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                  data-dismiss="modal">{{ __('Close') }}</button>
                                <input type="submit" class="btn btn-info" value="Update">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      @can('delete-type-of-mindep', User::class)
                      <span id="delbtn{{ @$typeOfMindepdata->id }}"></span>

                      <form id="delete-typeOfMindep-{{ $typeOfMindepdata->id }}"
                        action="{{ url('master-data/typeofmindep', $typeOfMindepdata->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                      </form>
                      @endcan

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
@include('crm.master.typeofmindep_js')
@endsection