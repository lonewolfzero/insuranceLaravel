<form onsubmit="submit_filter(this); return false" id="form_filter" class="mb-0">
  <div class="row mb-2">

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-2 align-self-center">KOC</div>
        <div class="col-md-9">
          <select name="koc" id="kocselect" class="e1 form-control form-control-sm">
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
        <div class="col-md-3 align-self-center">Ceding</div>
        <div class="col-md-9">
          <select name="ceding" id="cedinginput" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select Ceding') }}</option>
            @foreach ($ceding as $cd)
            <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-5 align-self-center text-center">UY</div>
        <div class="col-md-7">
          <input type="text" name="uy" id="uyinput" class="form-control form-control-sm yearmask yearpicker"
            autocomplete="off">
        </div>
      </div>
    </div>

    <div class="col-md-2 align-self-center">
      <button type="button" class="btn btn-sm btn-primary" id="cancelall" onclick="cancel_filter()">{{ __('Cancel All')
        }}</button>
    </div>

  </div>

  <div class="row">

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-2 align-self-center">COB</div>
        <div class="col-md-9">
          <select name="cob" id="cobselect" class="e1 form-control form-control-sm">
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
        <div class="col-md-3 align-self-center">Insured</div>
        <div class="col-md-9">
          <select name="insured" id="insuredinput" class="e1 form-control form-control-sm">
            <option selected value="">{{ __('Select Interest Insured') }}</option>
            @foreach ($insured as $cd)
            <option value="{{ $cd->id }}">{{ $cd->code }} - {{ $cd->description }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-5 align-self-center text-center">Reference No</div>
        <div class="col-md-7">
          <input type="text" name="ref_no" id="noinput" class="form-control form-control-sm" autocomplete="off">
        </div>
      </div>
    </div>

    <div class="col-md-2 align-self-center">
      <button type="submit" class="btn btn-sm btn-primary" id="retrievedata">{{ __('Retrieve Data') }}</button>
    </div>

  </div>
</form>