<div class="card-header bg-gray" id="claim_filter_div">
  <div class="row mb-2">

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-2">KOC</div>
        <div class="col-md-9">
          <select name="kocselect" id="kocselect" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select KOC') }}</option>
            @foreach ($koc as $k)
            <option value="{{ $k->id }}">{{ $k->code }} - {{ $k->description }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-3">Ceding</div>
        <div class="col-md-9">
          <select name="cedinginput" id="cedinginput" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select Ceding') }}</option>
            @foreach ($cedings as $cd)
            <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-5 text-right">UY</div>
        <div class="col-md-7">
          <input type="text" name="uyinput" id="uyinput" class="form-control form-control-sm" autocomplete="off"
            data-mask="9999" placeholder="yyyy">
        </div>
      </div>
    </div>

    <div class="col-md-2 align-self-center">
      <button type="button" class="btn btn-sm btn-primary" id="cancelall">{{ __('Cancel All') }}</button>
    </div>

  </div>

  <div class="row">

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-2">COB</div>
        <div class="col-md-9">
          <select name="cobselect" id="cobselect" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select COB') }}</option>
            @foreach ($cob as $k)
            <option value="{{ $k->id }}">{{ $k->code }} - {{ $k->description }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-3">Insured</div>
        <div class="col-md-9">
          <select name="insuredinput" id="insuredinput" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select Interest Insured') }}</option>
            @foreach ($insureds as $cd)
            <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->description }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-5 text-right">Reference No</div>
        <div class="col-md-7">
          <input type="text" name="noinput" id="noinput" class="form-control form-control-sm" autocomplete="off">
        </div>
      </div>
    </div>

    <div class="col-md-2 align-self-center">
      <button type="button" class="btn btn-sm btn-primary" id="retrievedata">{{ __('Retrieve Data') }}</button>
    </div>

  </div>

</div>