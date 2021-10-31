@extends('crm.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="container-fluid">

    {{-- NOTE Show All Errors Here --}}
    @include('crm.layouts.error')

    <form method="POST" action={{ url('master-data/lossdesc/store') }}>
      @csrf
      <div class="card">
        <div class="card-header bg-gray">
          {{ __('New Master Description Loss Data') }}
        </div>

        <div class="card-body bg-light-gray ">
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Code') }} </label>
                    <input type="text" id="number" style="width: 25%;" name="number"
                      class="form-control form-control-sm" value="{{ $number_lossdesc }}"
                      placeholder="enter code manually if not have parent data" data-validation="length"
                      readonly="readonly" data-validation-length="1-16" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Name') }}</label>
                    <input type="text" name="desc_name" class="form-control form-control-sm" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Factor') }}</label>
                    <select name="factor" id="factor" class="form-control">
                      <option selected disabled value="">{{ __('Select Factor') }}</option>
                      <option value="1">{{ __('1') }}</option>
                      <option value="-1">{{ __('-1') }}</option>
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
                {{ __('Save Claim Description Loss') }}
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
            <table id="lossdescTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ __('Number') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Factor') }}</th>
                  <th width="20%">{{ __('Actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach (@$lossdesc as $lossdescdata)
                <tr>
                  <td>
                    @if (@$lossdescdata->id <= 9) 0{{ @$lossdescdata->id }} @else {{ @$lossdescdata->id }} @endif </td>
                      <td>{{ @$lossdescdata->desc_name }}</td>
                  <td>{{ @$lossdescdata->factor }}</td>


                  <td>
                    <a href="#" data-toggle="tooltip"
                      data-title="{{ @$lossdescdata->created_at->toDayDateTimeString() }}" class="mr-3">
                      <i class="fas fa-clock text-info"></i>
                    </a>
                    <a href="#" data-toggle="tooltip"
                      data-title="{{ @$lossdescdata->updated_at->toDayDateTimeString() }}" class="mr-3">
                      <i class="fas fa-history text-primary"></i>
                    </a>
                    <span>
                      {{-- @can('update-lossdescdata', User::class) --}}
                      <a class="text-primary mr-3" data-toggle="modal"
                        data-target="#updatelossdescdata{{ $lossdescdata->id }}">
                        <i class="fas fa-edit"></i>
                      </a>
                      {{-- @endcan --}}

                      <div class="modal fade" id="updatelossdescdata{{ $lossdescdata->id }}" tabindex="-1" user="dialog"
                        aria-labelledby="updatelossdescdata{{ $lossdescdata->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" user="document">
                          <div class="modal-content bg-light-gray">
                            <div class="modal-header bg-gray">
                              <h5 class="modal-title" id="updatelossdescdata{{ $lossdescdata->id }}Label">
                                {{ __('Update Description Loss') }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ url('master-data/lossdesc', $lossdescdata) }}" method="POST">
                              <div class="modal-body">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Number') }}</label>
                                      <input type="text" name="id" class="form-control" value="{{ $lossdescdata->id }}"
                                        required readonly />
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Name') }}</label>
                                      <input type="text" name="desc_name" class="form-control"
                                        value="{{ $lossdescdata->desc_name }}" required />
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Factor') }}</label>
                                      <select name="factor" class="form-control" value="{{ $lossdescdata->factor }}"
                                        required>
                                        <option @if (!isset($lossdescdata->factor)) selected @endif disabled value="">
                                          {{ __('Select Factor') }}</option>
                                        <option value="1" @if ($lossdescdata->factor == '1') selected
                                          @endif>{{ __('1') }}</option>
                                        <option value="-1" @if ($lossdescdata->factor == '-1') selected
                                          @endif>{{ __('-1') }}</option>
                                      </select>
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
                      {{-- Edit Modal Ends --}}

                      {{-- @can('delete-lossdesc', User::class) --}}

                      <span id="delbtn{{ @$lossdescdata->id }}"></span>

                      <form id="delete-lossdesc-{{ $lossdescdata->id }}"
                        action="{{ url('master-data/lossdesc', $lossdescdata->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                      </form>

                      {{-- @endcan --}}
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
@include('crm.master.lossdesc_js')
@endsection