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
        {{ __('CLAIM INSURED INDEX') }}
      </div>
      <input type='hidden' value="{{ $claimlist_ids->content() }}" id="claimids">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 com-sm-12 mt-3">

            {!! link_to('claimtransaction-data/claim', 'Add Data', ['class' => 'btn btn-primary']) !!}
            <hr>
            {{ Form::open(['url' => 'claimtransaction-data/claim-index']) }}
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Doc Number') }}</label>
                      {{ Form::text('search', @$search, ['class' => 'form-control form-control-sm', 'placeholder' => 'Doc Number']) }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('UY') }}</label>
                      {{ Form::text('searchuy', @$searchuy, ['class' => 'form-control form-control-sm', 'placeholder' => 'UY']) }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Ceding') }}</label>
                      {{ Form::text('searchceding', @$searchceding, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ceding']) }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Cause Of Loss') }}</label><br>
                      <select id="searchcauseofloss" name="searchcauseofloss" class="e1 form-control form-control-sm ">
                        <option selected readonly value='0'>{{ __('Cause Of Loss') }}</option>
                        @foreach ($causeofloss as $pi)
                        @if ($pi->id == @$searchcauseofloss)
                        <option value="{{ $pi->id }}" selected>{{ $pi->nama }} -
                          {{ $pi->keterangan }}
                        </option>
                        @else
                        <option value="{{ $pi->id }}">{{ $pi->nama }} - {{ $pi->keterangan }}
                        </option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Nature Of Loss') }}</label><br>
                      <select id="searchnatureofloss" name="searchnatureofloss"
                        class="e1 form-control form-control-sm ">
                        <option value="" selected disabled>Nature Of Loss</option>
                        @foreach ($natureofloss as $pi)
                        @if ($pi->id == @$searchnatureofloss)
                        <option value="{{ $pi->id }}" selected> {{ $pi->accident }} -
                          {{ $pi->keterangan }}</option>
                        @else
                        <option value="{{ $pi->id }}"> {{ $pi->accident }} - {{ $pi->keterangan }}
                        </option>
                        @endif
                        @endforeach
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
                      {{ Form::text('searchregcomp', @$searchregcomp, ['class' => 'form-control form-control-sm', 'placeholder' => 'Reg Comp']) }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Insured') }}</label>
                      {{ Form::text('searchinsured', @$searchinsured, ['class' => 'form-control form-control-sm', 'placeholder' => 'Insured Name']) }}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Date Of Receipt ') }}</label><br>
                      {{-- {{ Form::text('searchdate', @$searchdate, ['class' => 'form-control form-control-sm datepicker', 'placeholder' => 'Date Of Receipt']) }}
                      --}}
                      <input type="text" name="searchdate" id="searchdate"
                        class="form-control form-control-sm datepicker" placeholder="Date Of Receipt"
                        autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">{{ __('Surveyor') }}</label><br>
                      <select id="searchsurveyor" name="searchsurveyor" class="e1 form-control form-control-sm ">
                        <option value="" selected disabled>Surveyor</option>
                        @foreach ($surveyor as $pi)
                        @if ($pi->id == @$searchsurveyor)
                        <option value="{{ $pi->id }}" selected> {{ $pi->number }} -
                          {{ $pi->keterangan }}</option>
                        @else
                        <option value="{{ $pi->id }}"> {{ $pi->number }} - {{ $pi->keterangan }}
                        </option>
                        @endif
                        @endforeach
                      </select>
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
            {{ Form::close() }}


            <hr>
            <table id="felookupTable2" class="table table-bordered table-striped" style="table-layout: fixed;">
              <thead>
                <tr>
                  <th>{{ __('Reg comp') }}</th>
                  <th width="5%">{{ __('Status') }}</th>
                  <th width="5%">{{ __('Counter') }}</th>
                  <th>{{ __('Type') }}</th>
                  <th>{{ __('Ceding') }}</th>
                  <th>{{ __('Doc PLA/DLA') }}</th>
                  <th>{{ __('Insured') }}</th>
                  <th>{{ __('Cause Of Loss') }}</th>
                  <th>{{ __('Date Of Recipt') }}</th>
                  <th>{{ __('Date Entry') }}</th>
                  <th>{{ __('NR Share On Loss') }}</th>
                  <th width="17%">{{ __('Actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach (@$claimlist as $claimlistata)
                <tr>
                  <input type="hidden" id="regcomp{{ $loop->index }}" value="{{ @$claimlistata->reg_comp }}">
                  <input type="hidden" id="counter{{ $loop->index }}" value="{{ @$claimlistata->doc_counter }}">
                  <td><a @if ($claimlistata->slip->slip_type =='mc')
                      href="{{ url('claimtransaction-data/marine/cargo', $claimlistata->id) }}"
                      @else
                      href="{{ url('claimtransaction-data/marine/hull', $claimlistata->id) }}"
                      @endif
                      >{{ @$claimlistata->reg_comp }}</a>
                  </td>
                  <td>
                    @if (@$claimlistata->status_flag == 1)
                    {{ __('PLA') }}
                    @elseif(@$claimlistata->status_flag==2)
                    {{ __('Interim') }}
                    @elseif(@$claimlistata->status_flag==3)
                    {{ __('DLA') }}
                    @endif
                  </td>
                  <td>{{ @$claimlistata->doc_counter }}</td>
                  <td>
                    @if (@$claimlistata->slip->slip_type =='mc')
                    {{ __('Cargo') }}
                    @elseif(@$claimlistata->slip->slip_type =='mh')
                    {{ __('Hull') }}
                    @endif
                  </td>
                  <td>{{ @$claimlistata->slip->ceding->name }}</td>
                  <td>{{ @$claimlistata->docpladla ?? '-' }}</td>
                  <td>{{ @$claimlistata->slip->insureddata->insured_name }}</td>
                  <td>{{ @$claimlistata->desc_causeofloss }}</td>
                  <td>{{ date('Y-m-d', strtotime(@$claimlistata->date_receipt)) }}</td>
                  <td>{{ date('Y-m-d', strtotime(@$claimlistata->dateofentry)) }}</td>
                  <td>
                    {{ $claimlistata->nasre_share_loss < 0 ? number_format($claimlistata->nasre_share_loss * -1, 0) : number_format($claimlistata->nasre_share_loss, 0) }}
                  </td>


                  <td class="d-flex">

                    <span class="mr-2">
                      <a href="#" onclick="confirmDelete('{{ @$claimlistata->id }}')">
                        <i class="fas fa-trash text-danger"></i>
                      </a>
                    </span>

                    <form id="delete-claim-{{ $claimlistata->id }}"
                      action="{{ url('claimtransaction-data/destroy', $claimlistata->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                    </form>

                    <select id="documentstatus{{ $loop->index }}" name="documentstatus" class="form-control"
                      style="width:fit-content">
                      <option value="" selected>Change Document Status</option>
                      @if (@$claimlistata->status_flag == 1 || @$claimlistata->status_flag == 2)
                      <option value="1">To Interim</option>
                      @endif
                      <option value="2">To DLA</option>
                    </select>
                    <button class="btn btn-sm btn-primary ml-2" id="buttondocumentstatus{{ $loop->index }}"
                      style="display: none" onclick="changeStatus('{{ $loop->index }}')">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </button>

                  </td>

                </tr>

                @endforeach
              </tbody>

            </table>

            {!! $claimlist->render() !!}

          </div>

        </div>
      </div>
    </div>


  </div>
</div>
@endsection

@section('scripts')
@include('crm.transaction.claim.claim_index_js')
@endsection