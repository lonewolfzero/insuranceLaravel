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
        Adjusment Premium
      </div>

      <div class="card-body bg-light-gray">

        <div class="row justify-content-center">
          <div class="col-md-10">

            <div class="row mb-2">
              <div class="col"></div>
              <div class="col-md-1 align-self-center">User</div>
              <div class="col-md-2"><input type="text" id="user" name="user" class="form-control"
                  value="{{ auth()->user()->name }}" disabled></div>
            </div>

            <div class="row mb-2">
              <div class="col"></div>
              <div class="col-md-1 align-self-center">Date Entry</div>
              <div class="col-md-2"><input type="text" id="user" name="user" class="form-control"
                  value="{{ date('d/m/Y', strtotime(now())) }}" disabled></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Main Contract</div>
              <div class="col-md-3">
                <input type="text" id="main_contract" name="main_contract" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">U/W Year</div>
              <div class="col-md-3">
                <input type="text" id="u_w_year" name="u_w_year" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Class Of Bussiness</div>
              <div class="col-md-3">
                <input type="text" id="class_of_bussiness" name="class_of_bussiness" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">EGNPI</div>
              <div class="col-md-3">
                <input type="text" id="egnpi" name="egnpi" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Currency</div>
              <div class="col-md-3">
                <input type="text" id="currency" name="currency" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Period</div>
              <div class="col-md-3">
                <input type="text" id="period_from" name="period_from" class="form-control">
              </div>
              <div class="col-md-1 text-center">To</div>
              <div class="col-md-3">
                <input type="text" id="period_to" name="period_to" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">ROE</div>
              <div class="col-md-3">
                <input type="text" id="roe" name="roe" class="form-control">
              </div>
            </div>

            <hr>

            <div class="row mb-2">
              <div class="col-md-2">ID Layer</div>
              <div class="col-md-3">
                <input type="text" id="id_layer" name="id_layer" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">Mindep Retro</div>
              <div class="col-md-3">
                <input type="text" id="mindep_retro" name="mindep_retro" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Our Contract</div>
              <div class="col-md-3">
                <input type="text" id="our_contract" name="our_contract" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">With Holding Tax</div>
              <div class="col-md-3">
                <input type="text" id="with_holding_tax" name="with_holding_tax" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Kind Of Treaty</div>
              <div class="col-md-3">
                <input type="text" id="kind_of_treaty" name="kind_of_treaty" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">Limit Loss</div>
              <div class="col-md-3">
                <input type="text" id="limit_loss" name="limit_loss" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Type Coverage</div>
              <div class="col-md-3">
                <input type="text" id="type_coverage" name="type_coverage" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">Deductible</div>
              <div class="col-md-3">
                <input type="text" id="deductible" name="deductible" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Mindep 100%</div>
              <div class="col-md-3">
                <input type="text" id="mindep_100" name="mindep_100" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">Aggregate</div>
              <div class="col-md-3">
                <input type="text" id="aggregate" name="aggregate" class="form-control">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Share</div>
              <div class="col-md-3">
                <input type="text" id="share" name="share" class="form-control">
              </div>
              <div class="col"></div>
              <div class="col-md-2">Adj Rate</div>
              <div class="col-md-3">
                <input type="text" id="adj_rate" name="adj_rate" class="form-control">
              </div>
            </div>

            <hr>

            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card">

                  <div class="card-header bg-gray">
                    Adjusment
                  </div>

                  <div class="card-body bg-light-gray">

                    <div class="row mb-2">
                      <div class="col-md-4">ID Adjusment</div>
                      <div class="col-md-8">
                        <input type="text" name="id_adjusment" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Version</div>
                      <div class="col-md-3">
                        <input type="text" name="version" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Due Date</div>
                      <div class="col-md-3">
                        <input type="text" name="version" class="form-control datemask datepicker">
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">AGNPI</div>
                      <div class="col-md-3"></div>
                      <div class="col-md-5">
                        <input type="text" name="agnpi" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Adj Premium Rate</div>
                      <div class="col-md-3">
                        <input type="text" name="adj_premium_rate_percentage" class="form-control">
                      </div>
                      <div class="col-md-5">
                        <input type="text" name="adj_premium_rate_amount" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Additional Premium</div>
                      <div class="col-md-3"></div>
                      <div class="col-md-5">
                        <input type="text" name="additional premium" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Overrider (%)</div>
                      <div class="col-md-3">
                        <input type="text" name="overrider_percentage" class="form-control">
                      </div>
                      <div class="col-md-5">
                        <input type="text" name="overrider_amount" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">No Claim Bonus</div>
                      <div class="col-md-3">
                        <input type="text" name="no_claim_bonus_percentage" class="form-control">
                      </div>
                      <div class="col-md-5">
                        <input type="text" name="no_claim_bonus_amount" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-4">Balance Due</div>
                      <div class="col-md-3"></div>
                      <div class="col-md-5">
                        <input type="text" name="adj_premium_rate_amount" class="form-control" disabled>
                      </div>
                    </div>

                    <div class="row justify-content-center my-4">
                      <div class="col-md-2"><button class="btn btn-primary">Submit</button></div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-sm btn-primary">Cancel Replace</button></td>
                  </tr>
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
  integrity="sha512-mSYUmp1HYZDFaVKK//64EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
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

<script src="{{ asset('/js/retro/mindep/adjusment/entry.js') }}"></script>
<script src="{{ asset('/js/retro/mindep/adjusment/index.js') }}"></script>

@endsection