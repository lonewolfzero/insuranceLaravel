@extends('crm.layouts.app')

@section('content')

<style type="text/css">
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

<div class="content-wrapper">


  <div class="container-fluid">
    <div class="card">

      <div class="card-header bg-gray">
        Claim Section (Facultative)
      </div>

      <div class="card-body bg-light-gray ">

        <div class="card">

          <div class="card-header bg-gray">
            Show Incoming Claim Information
          </div>

          <div class="card-body bg-light-gray ">

            <div class="card">

              {{-- INCLUDING BLADE FILTER --}}
              @include('crm.transaction.claim.layouts.claim_filter')

              <div class="card-body bg-light-gray ">

                {{-- INCLUDING BLADE CLAIM INSURED --}}
                @include('crm.transaction.claim.marine.components.slip')

                <div class="card">

                  @include('crm.transaction.claim.marine.components.modal')

                  <div class="card-header bg-gray">

                    <div class="row">

                      <div class="col-md-3 d-flex">
                        <input type='hidden' value="{{ @$type }}" id="type_claim">
                        <input type="hidden" id="claimdata" value="{{ @$claimdata }}">
                        <input type="hidden" id="lossamountlimit" value="{{@$lossamountlimit }}">
                        <input type="hidden" name="slipnumberdata" id="slipnumberdata" class="form-control"
                          value="{{ @$claimdata->number }}" autocomplete="off" placeholder="Slip Number" disabled>
                        <button type="button" id="prevbutton" name="prevbutton"
                          class="btn btn-primary mx-2">{{ __('Prev') }}</button>
                        <button type="button" id="nextbutton" name="nextbuttpm"
                          class="btn btn-primary">{{ __('Next') }}</button>

                      </div>


                      <div class="col-md-9 d-flex justify-content-end">

                        <select id="documentstatus" name="documentstatus" class="form-control mr-2"
                          style="width:fit-content; display: none">
                          <option value="" selected disabled>Change Document Status</option>
                          @if (@$status_flag != 3)
                          <option value="1">To Interim</option>
                          @endif
                          <option value="2">To DLA</option>
                          <option value="3">Correction</option>
                          <option value="4">Multi</option>
                        </select>

                        <button class="btn btn-sm btn-primary mr-2" style="display: none" id="buttondocumentstatus">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                          </svg>
                        </button>

                        <button class="btn btn-sm btn-primary mr-2" style="display: none" id="buttoncancel">
                          Cancel Correction
                        </button>

                        <button type="button" id="maincollapsebutton" name="maincollapsebutton" data-toggle="collapse"
                          data-target="#collapseClaimSection" aria-expanded="false" aria-controls="collapseClaimSection"
                          class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                        </button>


                      </div>

                    </div>
                  </div>
                  <div class="card-body bg-light-gray collapse show" id="collapseClaimSection">

                    @include('crm.transaction.claim.marine.components.claim')

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="card">

      <div class="card-header bg-gray">
        Retro Section (Facultative)
      </div>

      <div class="card-body bg-light-gray ">

        <div class="card">

          <div class="card-header bg-gray btn text-left" data-toggle="collapse" data-target="#collapseRecoverySection"
            aria-expanded="false" aria-controls="collapseRecoverySection">
            Recovery Claim
          </div>

          <div class="card-body bg-light-gray ">

            <div class="card">

              <div class="card-header bg-gray">

              </div>

              <div class="card-body bg-light-gray collapse" id="collapseRecoverySection">

                @include('crm.transaction.claim.layouts.retrosection')

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="card">

      <div class="card-header bg-gray btn text-left" data-toggle="collapse" data-target="#collapseOtherSection"
        aria-expanded="false" aria-controls="collapseOtherSection">
        Other
      </div>

      <div class="card-body bg-light-gray ">

        <div class="card">

          <div class="card-body bg-light-gray ">

            <div class="card">

              <div class="card-header bg-gray">

              </div>

              <div class="card-body bg-light-gray collapse" id="collapseOtherSection">

                @include('crm.transaction.claim.layouts.othersection')

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

@endsection

@section('scripts')

@include('crm.transaction.claim.marine.script')

@endsection