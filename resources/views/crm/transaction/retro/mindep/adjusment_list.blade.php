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

    <div class="card">

      <div class="card-header bg-gray">
        Main Program Mindep List Entry
      </div>

      <div class="card-body bg-light-gray">

        <div class="row justify-content-center my-5">
          <div class="col-md-6">
            <div class="row mb-4">
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-2 align-self-center">U/W YEAR</div>
                  <div class="col-md-6">
                    <input type="text" id="u_w_year" name="u_w_year" class="form-control yearmask yearpicker"
                      autocomplete="off">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-2 align-self-center">COB</div>
                  <div class="col-md-6">
                    <select name="cob" id="cob" class="e1 form-control">
                      <option value="" disabled selected>Select COB</option>
                      @foreach ($cob as $c)
                      <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->description }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary">Search</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-2 align-self-center">Currency</div>
                  <div class="col-md-6">
                    <select name="currency" id="currency" class="e1 form-control">
                      <option value="" disabled selected>Select Currency</option>
                      @foreach ($currency as $c)
                      <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->symbol_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="row mb-4">
          <div class="col"></div>
          <div class="col-md-1 align-self-center">Quick Search</div>
          <div class="col-md-2"><input type="text" id="u_w_year" name="u_w_year" class="form-control"></div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Version</th>
                    <th>Commercing Date</th>
                    <th>Due Date</th>
                    <th>AGNPI</th>
                    <th>Adj Pr Rate</th>
                    <th>Add Premium</th>
                    <th>Overrider</th>
                    <th>No Claim Bonus</th>
                    <th>Balance Due Date</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($adjusments as $adj)
                  <tr>
                    <td>{{ $adj->version }}</td>
                    <td>{{ date('d/m/Y',strtotime($adj->date_entry)) }}</td>
                    <td>{{ date('d/m/Y',strtotime($adj->due_date)) }}</td>
                    <td>{{ number_format($adj->agnpi, 2) }}</td>
                    <td>{{ number_format($adj->adj_premium_rate_amount, 2) }}</td>
                    <td>{{ number_format($adj->additional_premium, 2) }}</td>
                    <td>{{ number_format($adj->overrider_amount, 2) }}</td>
                    <td>{{ number_format($adj->no_claim_bonus_amount, 2) }}</td>
                    <td>{{ number_format($adj->balance_due, 2) }}</td>
                    {{-- <td></td> --}}
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

<script src="{{ asset('/js/retro/mindep/adjusment/list.js') }}"></script>
<script src="{{ asset('/js/retro/mindep/adjusment/index.js') }}"></script>

@endsection