@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .styled-border {
    border-width: 3px !important;
    border-color: black !important
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

    <div class="card card-primary">

      <div class="card-header bg-gray">
        Claim Section (FIRE & ENGINEERING)
      </div>

      <div class="card-body bg-light-gray">

        @include('crm.transaction.claim.v2.templates.slip_modal')

        <div class="card">
          <div class="card-header bg-gray">

            @include('crm.transaction.claim.v2.templates.filter')

          </div>

          <div class="card-body bg-light-gray">

            {{-- @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif --}}

            <form action="/claim" method="post">
              @csrf

              @include('crm.transaction.claim.v2.templates.filter_result')

              <div class="card">
                <div class="card-header bg-gray">
                  @include('crm.transaction.claim.v2.templates.form_header')
                </div>
                <div class="card-body bg-light-gray">
                  @include('crm.transaction.claim.v2.templates.form')
                </div>
              </div>

              <div class="card">
                <div class="card-header bg-gray">Other</div>
                <div class="card-body bg-light-gray">

                  @include('crm.transaction.claim.v2.templates.other')

                </div>
              </div>

            </form>

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

<script src="{{ asset('/js/claim/v2/entry.js') }}"></script>
<script src="{{ asset('/js/claim/v2/filter.js') }}"></script>
<script src="{{ asset('/js/templates/main.js') }}"></script>

@endsection