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
        {{ __('Bordero Upload') }}
      </div>

      <div class="card-body">

        <div class="row justify-content-center">
          <div class="col-md-8">

            <div class="row mb-2">
              <div class="col-md-2">Jenis</div>
              <div class="col-md-4">
                <select class="form-control form-control-sm">
                  <option value="premi">Premi</option>
                  <option value="klaim">Klaim</option>
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">U/W Year</div>
              <div class="col-md-3"><input type="text" class="form-control form-control-sm"></div>
              <div class="col-md-3">
                <select class="form-control form-control-sm">
                  <option value="Monthly">Monthly</option>
                  <option value="Quarterly">Quarterly</option>
                  <option value="Semester">Semester</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control form-control-sm">
                  @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Ceding/Broker</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('Ceding/Broker') }}</option>
                  @foreach ($ceding as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->name }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Ceding Company</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('Ceding Company') }}</option>
                  @foreach ($ceding as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->name }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">COB</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('COB') }}</option>
                  @foreach ($cob as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">KOC</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('KOC') }}</option>
                  @foreach ($koc as $c)
                  @if ($c->id == @$cedingsource)
                  <option value="{{ $c->id }}" selected>{{ $c->description }}
                    @else
                  <option value="{{ $c->id }}">{{ $c->description }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">ID Sub Contract</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('ID Sub Contract') }}</option>
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Format / Type</div>
              <div class="col-md-6">
                <select id="cedingsource" name="cedingsource" class="e1 form-control form-control-sm">
                  <option selected disabled>{{ __('Format / Type') }}</option>
                  <option value="marine">Marine</option>
                  <option value="non marine">Non Marine</option>
                  <option value="credit">Credit</option>
                </select>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Date of Doc</div>
              <div class="col-md-6">
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Incoming Date</div>
              <div class="col-md-6">
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-2">Document</div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                      aria-describedby="inputGroupFileAddon01" multiple>
                    <label class="custom-file-label" for="inputGroupFile01">Choose File(s)...</label>
                  </div>
                </div>
                {{-- <input class="form-control-file" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"> --}}
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-8">

                <div class="row justify-content-center my-4">
                  <div class="col-md-4 text-center"><button class="btn btn-primary">Submit</button></div>
                  <div class="col-md-4 text-center"><button class="btn btn-primary">Cancel</button></div>
                </div>

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

<script src="{{ asset('/js/treaty/soa/index.js') }}"></script>
{{-- @include('crm.transaction.claim.index_script') --}}

@endsection