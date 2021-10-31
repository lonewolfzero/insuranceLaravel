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
        TREATY & RETROCESSION Summary Prop Credit
        @include('crm.transaction.treaty.templates.prop.new_doc_form')
      </div>


      <div class="card-body bg-light-gray ">

        <form action="/treaty/prop/store" method="POST" id="prop_form">
          @csrf

          <div class="card">

            <div class="card-header bg-gray">
              Treaty Summary TTY Entry Prop
            </div>

            <div class="card-body bg-light-gray ">

              <input type="hidden" id="has_soa" value="{{ @$has_soa }}">
              <input type="hidden" name="type" value="credit">
              <input type="hidden" id="sub_detail_id" value="{{ @$subdetail->id }}">

              <div class="row">

                <div class="col-md-6">

                  @include('crm.transaction.treaty.templates.prop.master_contract')

                  @include('crm.transaction.treaty.templates.prop.detail_contract')

                </div>

                <div class="col-md-6">
                  @include('crm.transaction.treaty.templates.prop.backup_retro')
                </div>

              </div>

            </div>

          </div>

          <div class="card">

            <div class="card-header bg-gray">
              Sub Detail Contract
            </div>

            <div class="card-body bg-light-gray ">

              <div class="row">

                <div class="col-md-6">
                  <div class="row">

                    @include('crm.transaction.treaty.templates.prop.sub_detail_contract_left')

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">

                    @include('crm.transaction.treaty.templates.prop.sub_detail_contract_right')

                  </div>
                </div>

              </div>

              <div class="row justify-content-center mt-3">
                <div class="col-md-10">

                  @include('crm.transaction.treaty.templates.prop.sub_detail_contract_bottom')

                </div>
              </div>

              <div class="row justify-content-center my-3">
                <div class="col-1 text-center">
                  <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
              </div>

            </div>

          </div>

        </form>

        <div class="card">
          <div class="card-body bg-light-gray">
            @include('crm.transaction.treaty.templates.prop.sub_detail_contract_table')
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

<script src="{{ asset('/js/treaty/prop/index.js') }}"></script>
<script src="{{ asset('/js/treaty/prop/credit.js') }}"></script>

@endsection