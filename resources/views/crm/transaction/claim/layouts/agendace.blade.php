@extends('crm.layouts.app')

<style type="text/css">
  #map {
    margin: 10px;
    width: 600px;
    height: 300px;
    padding: 10px;
  }
</style>

@section('content')
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
  integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
  crossorigin="anonymous" />

<link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="container-fluid">

    {{-- NOTE Show All Errors Here --}}
    @include('crm.layouts.error')


    <div class="card card-primary">
      <div class="card-header bg-gray">
        {{ __('AGENDA CE') }}
      </div>
      {{-- <input type='hidden' value="{{ $claimlist_ids->content() }}" id="claimids"> --}}
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 com-sm-12 mt-3">

            {{-- {{ Form::open(['url' => 'claimtransaction-data/'.$type.'/index']) }} --}}
            <form method="get" action='/claimtransaction-data/agendace'>
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">{{ __('No CE') }}</label>
                        <input type="text" name="noce" id="noce" placeholder="No CE"
                          class="form-control form-control-sm" autocomplete="off">
                        {{-- {{ Form::text('search', @$search, ['class' => 'form-control form-control-sm', 'placeholder' => 'No CE']) }}
                        --}}
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">{{ __('Ceding Source') }}</label><br>
                        <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm ">
                          <option selected disabled>{{ __('Ceding Source') }}</option>
                          {{-- @foreach ($causeofloss as $pi)
                          @if ($pi->id == @$cedingsource)
                          <option value="{{ $pi->id }}" selected>{{ $pi->nama }} -
                          {{ $pi->keterangan }}
                          </option>
                          @else
                          <option value="{{ $pi->id }}">{{ $pi->nama }} - {{ $pi->keterangan }}
                          </option>
                          @endif
                          @endforeach --}}
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">{{ __('Accumulation Retro') }}</label><br>
                        <select id="accumulationretro" name="accumulationretro"
                          class="e1 form-control form-control-sm ">
                          <option value="" selected disabled>Accumulation Retro</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          {{-- @foreach ($natureofloss as $pi)
                          @if ($pi->id == @$accumulationretro)
                          <option value="{{ $pi->id }}" selected> {{ $pi->accident }} -
                          {{ $pi->keterangan }}</option>
                          @else
                          <option value="{{ $pi->id }}"> {{ $pi->accident }} - {{ $pi->keterangan }}
                          </option>
                          @endif
                          @endforeach --}}
                        </select>
                      </div>
                    </div>
                  </div>



                </div>

                <div class="col-md-6">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">{{ __('Reg Comp') }}</label>
                        <input type="text" name="regcomp" id="regcomp" placeholder="Reg Comp"
                          class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">{{ __('Date Of Loss ') }}</label><br>
                        <input type="text" name="dateofloss" id="dateofloss"
                          class="form-control form-control-sm datepicker datemask" placeholder="Date Of Loss"
                          autocomplete="off">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">{{ __('Search') }}</button>
                  </div>
                </div>
              </div>
            </form>
            {{-- {{ Form::close() }} --}}

            <hr>
            <div class="table-responsive">
              <table id="felookupTable2" class="table table-bordered table-striped w-100" style="overflow-x:auto;">
                <thead>
                  <tr>
                    <th>{{ __('No CE') }}</th>
                    <th>{{ __('Reg comp') }}</th>
                    <th>{{ __('Doc Counter') }}</th>
                    <th>{{ __('Ceding Source') }}</th>
                    <th>{{ __('Insured') }}</th>
                    <th>{{ __('Date Of Loss') }}</th>
                    <th>{{ __('Doc PLA/DLA') }}</th>
                    <th>{{ __('Total Loss Amount') }}</th>
                    <th>{{ __('NR Share') }}</th>
                    <th>{{ __('NR Share On Loss') }}</th>
                    <th>{{ __('Accumulation Retro') }}</th>
                    <th>{{ __('User Create') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (@$claims as $claim)
                  <tr>
                    <input type="hidden" id="regcomp{{ $loop->index }}" value="{{ @$claim->reg_comp }}">
                    <input type="hidden" id="counter{{ $loop->index }}" value="{{ @$claim->doc_counter }}">
                    <td>{{ @$claim->cereffno }}</td>
                    <td><a target="_blank"
                        href="{{ url('claimtransaction-data/'.@$claim->slip->slip_type.'/update', base64_encode($claim->id)) }}">{{ @$claim->reg_comp }}</a>
                    </td>
                    <td>{{ @$claim->doc_counter }}</td>
                    <td>{{ @$claim->slip->ceding->name }}</td>
                    <td>{{ @$claim->slip->insureddata->insured_name }}</td>
                    <td>{{ date('d/m/Y', strtotime(@$claim->date_of_loss)) }}</td>
                    <td>{{ @$claim->docpladla ?? '-' }}</td>
                    <td>
                      {{ $claim->total_loss_amount < 0 ? number_format($claim->total_loss_amount * -1, 0) : number_format($claim->total_loss_amount, 0) }}
                    </td>
                    <td>
                      {{ $claim->nasre_liab < 0 ? number_format($claim->nasre_liab * -1, 2) : number_format($claim->nasre_liab, 2) }}%
                    </td>
                    <td>
                      {{ $claim->nasre_share_loss < 0 ? number_format($claim->nasre_share_loss * -1, 0) : number_format($claim->nasre_share_loss, 0) }}
                    </td>
                    <td>{{ @$claim->acc_retro == "1" ? "YES" : "NO" }}</td>
                    <td>{{ @$claim->usercreatece->name }}</td>

                  </tr>

                  @endforeach
                </tbody>

              </table>
            </div>
            {!! $claims->render() !!}

          </div>

        </div>
      </div>
    </div>


  </div>
</div>
@endsection
@section('scripts')
{{-- @include('crm.transaction.claim.claim_index_js') --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
  integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
  crossorigin="anonymous"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{ asset('js/select2.js') }}"></script>
<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  $(`select[name="documentstatus"]`).change(function () {
    var _val = $(this).val();
    var _counter = $(this)[0].id.slice(-1);
    console.log(_counter, _val);
    if (_val != "") {
        $("#buttondocumentstatus" + _counter).show();
    } else {
        $("#buttondocumentstatus" + _counter).hide();
    }
  });

  $(function () {
      "use strict";

      $("#felookupTable2").DataTable({
          paging: false,
          order: [
            [0, "desc"],
            [2, "desc"],
            [3, "desc"],
          ],
          dom: '<"top"fB>rt<"bottom"lip><"clear">',
          lengthMenu: [
              [10, 25, 50, 100, -1],
              ["10 rows", "25 rows", "50 rows", "100 rows", "Show all"],
          ],
      });
  });

</script>
<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
    });
    $(".datemask").mask("00/00/0000", {
    placeholder: "dd/mm/yyyy",
    separator: "/",
});
    $(".e1").select2();
    $('.uang').mask("#,##0.00", {
      reverse: true
    });
  });

</script>
<style>
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
@endsection