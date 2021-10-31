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

  .overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1100 !important;
    background: rgba(255, 255, 255, 0.8) url("{{ asset('loader.gif') }}") center no-repeat;
  }

  /* Turn off scrollbar when body element has the loading class */
  body.loading {
    overflow: hidden;
  }

  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay {
    display: block;
  }
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    <div class="card">

      <div class="card-header bg-gray">
        Retrocession Special Program List
      </div>

      <div class="card-body bg-light-gray">

        <div class="row mb-3">
          <div class="col-md-2 align-self-center">Contract Name</div>
          <div class="col-md-2 align-self-center">
            <input type="text" class="form-control" name="contract_name" id="contract_name" autocomplete="off">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-2 align-self-center">U/W Year</div>
          <div class="col-md-2 align-self-center">
            <input type="text" class="form-control yearmask yearpicker" name="u_w_year" id="u_w_year"
              autocomplete="off">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-2 align-self-center">Type</div>
          <div class="col-md-4 align-self-center">
            <select class="e1 form-control" name="type" id="type">
              <option value="" disabled selected>Select Type</option>
              <option value="Treaty Retrocession">Treaty Retrocession</option>
              <option value="Facultative Proportional Retrocession">Facultative Proportional Retrocession</option>
              <option value="Facultative Non Proportional Retrocession">Facultative Non Proportional Retrocession
              </option>
            </select>
          </div>
        </div>

        <div class="row mb-3 justify-content-center">
          <div class="col-md-2 align-self-center text-center">
            <button class="btn btn-primary">Search</button>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Contract</th>
                  <th>U/W Year</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody_list">
                @foreach ($specialContract as $sc)
                <tr>
                  <td style="text-transform: uppercase">{{ $sc->contract_name}}</td>
                  <td>{{ $sc->u_w_year }}</td>
                  <td>{{ $sc->type }}</td>
                  <td>
                    <button @if(str_contains($sc->type, 'Facultative'))
                      onclick="show_detail('facultative', '{{ base64_encode($sc->id) }}')"
                      @else
                      onclick="show_detail('treaty', '{{ base64_encode($sc->id) }}')"
                      @endif
                      class="btn btn-sm btn-primary" >
                      Show Detail
                    </button>
                    <button class="btn btn-sm" form="edit{{ $sc->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </button>
                    <button class="btn btn-sm" form="delete{{ $sc->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                        viewBox="0 0 16 16">
                        <path
                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd"
                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </button>
                    <form style="display: none" action="/retro/contract/entry/{{ base64_encode($sc->id) }}" method="get"
                      id="edit{{ $sc->id }}">
                    </form>
                    <form style="display: none" action="/retro/contract/delete/{{ $sc->id }}" method="post"
                      id="delete{{ $sc->id }}">
                      @method('delete')
                      @csrf
                    </form>
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

<script src="{{ asset('/js/templates/main.js') }}"></script>
<script src="{{ asset('/js/retro/contract/list.js') }}"></script>

@endsection