@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    @include('crm.transaction.retro.mindep.templates.modal_layer')

    <div class="card">

      <div class="card-header bg-gray">
        Main Program Mindep List Entry
      </div>

      <div class="card-body bg-light-gray">

        <div class="row justify-content-center my-5">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-2 align-self-center">U/W YEAR</div>
                  <div class="col-md-6">
                    <input type="text" id="u_w_year" name="u_w_year" class="form-control yearmask yearpicker"
                      autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary">Search</button>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="row mb-4">
          <div class="col"></div>
          <div class="col-md-1 align-self-center">Quick Search</div>
          <div class="col-md-2"><input type="text" id="" name="" class="form-control"></div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Main Contract</th>
                    <th>U/W Year</th>
                    <th>COB</th>
                    <th>Contract Description</th>
                    <th>EGNPI</th>
                    <th>Currency</th>
                    <th>Period</th>
                    <th>ROE</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($maincontracts as $mc)
                  <tr>
                    <td>{{ $mc->main_contract }}</td>
                    <td>{{ $mc->u_w_year }}</td>
                    <td>{{ $mc->getcob->code }} - {{ $mc->getcob->description }}</td>
                    <td>{{ $mc->contract_description }}</td>
                    <td>{{ number_format($mc->egnpi, 2) }}</td>
                    <td>{{ $mc->getcurrency->code }} - {{ $mc->getcurrency->symbol_name }}</td>
                    <td>
                      {{ date('d/m/Y', strtotime($mc->period_from)) }}
                      -
                      {{ date('d/m/Y', strtotime($mc->period_to)) }}</td>
                    <td>{{ number_format($mc->roe, 2) }}</td>
                    <td>
                      <form style="display: none" id="form_entry{{ $mc->id }}" action="/retro/mindep/entry"
                        method="get">
                        <input type="hidden" name="id" value="{{ base64_encode($mc->id) }}">
                      </form>
                      <div class="d-flex">
                        <button class="btn" type="submit" form="form_entry{{ $mc->id }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue"
                            class="bi bi-display" viewBox="0 0 16 16">
                            <path
                              d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z" />
                          </svg>
                        </button>
                        <button class="btn" onclick="open_layer_modal({{ $mc->id }})">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                          </svg>
                        </button>
                      </div>
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

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/select2.js') }}"></script>

<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('/js/retro/mindep/entry/list.js') }}"></script>
<script src="{{ asset('/js/retro/mindep/entry/index.js') }}"></script>

@endsection