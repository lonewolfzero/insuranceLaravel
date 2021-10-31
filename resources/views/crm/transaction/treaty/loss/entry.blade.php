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
</style>

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">

    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('Loss Participation Entry') }}
      </div>

      <div class="card-body bg-light-gray">

        @include('crm.transaction.treaty.templates.loss.filter')

        <hr>

        <form action="/treaty/loss/store" method="POST" id="loss_form">
          @csrf

          <input type="hidden" name="prop_id" id="prop_id" value="{{ @$loss->getprop->id }}">
          <input type="hidden" id="loss_id" value="{{ @$loss->id }}">

          @include('crm.transaction.treaty.templates.loss.center')

          <div class="row">

            @include('crm.transaction.treaty.templates.loss.bottom_left')

            @include('crm.transaction.treaty.templates.loss.bottom_right')

          </div>

          <div class="row justify-content-center">
            <div class="col-md-8">

              <div class="row justify-content-center my-4">
                <div class="col-md-4 text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                {{-- <div class="col-md-4 text-center"><button class="btn btn-primary">Cancel</button></div> --}}
              </div>

            </div>

          </div>

        </form>

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

<script src="{{ asset('/js/treaty/loss/index.js') }}"></script>
<script src="{{ asset('/js/treaty/loss/entry.js') }}"></script>

@endsection