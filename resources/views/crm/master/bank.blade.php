@extends('crm.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="container-fluid">

    {{-- NOTE Show All Errors Here --}}
    @include('crm.layouts.error')

    <form method="POST" action={{ url('master-data/bank/store') }}>
      @csrf
      <div class="card">
        <div class="card-header bg-gray">
          {{ __('New Master Bank Data') }}
        </div>

        <div class="card-body bg-light-gray ">
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="lead-details-id" role="tabpanel" aria-labelledby="lead-details">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('ID LNKB') }} </label>
                    <input type="text" id="id_lnkb" name="id_lnkb" class="form-control form-control-sm" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control form-control-sm" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">{{ __('Group') }}</label>
                    <select name="group" id="group" class="form-control">
                      <option selected disabled value="">{{ __('Select Group') }}</option>
                      <option value="BANK PEMBANGUNAN DAERAH">{{ __('BANK PEMBANGUNAN DAERAH') }}</option>
                      <option value="BANK UMUM PERSERO">{{ __('BANK UMUM PERSERO') }}</option>
                      <option value="BANK UMUM SWASTA NASIONAL">{{ __('BANK UMUM SWASTA NASIONAL') }}</option>
                      <option value="KANTOR CABANG BANK YANG BERKEDUDUKAN DI LUAR NEGERI">
                        {{ __('KANTOR CABANG BANK YANG BERKEDUDUKAN DI LUAR NEGERI') }}</option>
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
                {{ __('Save Bank') }}
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
            <table id="bankTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ __('ID LNKB') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Group') }}</th>
                  <th width="20%">{{ __('Actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach (@$bank as $bankdata)
                <tr>
                  <td>{{ @$bankdata->id_lnkb }}</td>
                  <td>{{ @$bankdata->name }}</td>
                  <td>{{ @$bankdata->group }}</td>


                  <td>
                    <a href="#" data-toggle="tooltip" data-title="{{ @$bankdata->created_at->toDayDateTimeString() }}"
                      class="mr-3">
                      <i class="fas fa-clock text-info"></i>
                    </a>
                    <a href="#" data-toggle="tooltip" data-title="{{ @$bankdata->updated_at->toDayDateTimeString() }}"
                      class="mr-3">
                      <i class="fas fa-history text-primary"></i>
                    </a>
                    <span>
                      @can('update-bank', User::class)
                      <a class="text-primary mr-3" data-toggle="modal" data-target="#updatebankdata{{ $bankdata->id }}">
                        <i class="fas fa-edit"></i>
                      </a>
                      @endcan

                      <div class="modal fade" id="updatebankdata{{ $bankdata->id }}" tabindex="-1" user="dialog"
                        aria-labelledby="updatebankdata{{ $bankdata->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" user="document">
                          <div class="modal-content bg-light-gray">
                            <div class="modal-header bg-gray">
                              <h5 class="modal-title" id="updatebankdata{{ $bankdata->id }}Label">
                                {{ __('Update Description Loss') }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ url('master-data/bank', $bankdata) }}" method="POST">
                              <div class="modal-body">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('ID LNKB') }}</label>
                                      <input type="text" name="id_lnkb" class="form-control"
                                        value="{{ $bankdata->id_lnkb }}" required />
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Name') }}</label>
                                      <input type="text" name="name" class="form-control" value="{{ $bankdata->name }}"
                                        required />
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-4 col-md-12">
                                    <div class="form-group">
                                      <label for="">{{ __('Group') }}</label>
                                      <select name="group" class="form-control" value="{{ $bankdata->group }}" required>
                                        <option @if (!isset($bankdata->group)) selected @endif disabled value="">
                                          {{ __('Select Group') }}</option>
                                        <option value="BANK PEMBANGUNAN DAERAH" @if($bankdata->group == "BANK
                                          PEMBANGUNAN DAERAH") selected @endif>{{ __('BANK PEMBANGUNAN DAERAH') }}
                                        </option>
                                        <option value="BANK UMUM PERSERO" @if($bankdata->group == "BANK UMUM PERSERO")
                                          selected @endif>{{ __('BANK UMUM PERSERO') }}</option>
                                        <option value="BANK UMUM SWASTA NASIONAL" @if($bankdata->group == "BANK UMUM
                                          SWASTA NASIONAL") selected @endif>{{ __('BANK UMUM SWASTA NASIONAL') }}
                                        </option>
                                        <option value="KANTOR CABANG BANK YANG BERKEDUDUKAN DI LUAR NEGERI"
                                          @if($bankdata->group == "KANTOR CABANG BANK YANG BERKEDUDUKAN DI LUAR NEGERI")
                                          selected @endif>
                                          {{ __('KANTOR CABANG BANK YANG BERKEDUDUKAN DI LUAR NEGERI') }}</option>
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

                      @can('delete-bank', User::class)

                      <span id="delbtn{{ @$bankdata->id }}"></span>

                      <form id="delete-bank-{{ $bankdata->id }}" action="{{ url('master-data/bank', $bankdata->id) }}"
                        method="POST">
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
@include('crm.master.bank_js')
@endsection