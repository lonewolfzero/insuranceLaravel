<div class="card">

  <div class="card-header bg-gray">
    Master Contract
  </div>

  <div class="card-body bg-light-gray ">

    <div class="row mb-2">
      <div class="col-md-3">Treaty Code</div>
      <div class="col-md-3"><input class="form-control form-control-sm" type="text" name="treaty_code" id="treaty_code"
          value="{{ @$subdetail->getprop->treaty_code }}" readonly></div>
      @if (request()->path() == "treaty/prop/credit/entry")
      <div class="col-md-3"><button class="btn btn-sm btn-primary" id="btn_attach_document">Attach Document</button>
      </div>
      @else
      <div class="col-md-3"><button class="btn btn-sm btn-primary" id="btn_attach_summary">Attach Summary</button></div>
      <div class="col-md-3"><button class="btn btn-sm btn-primary" id="btn_attach_cover_note">Attach Cover Note</button>
      </div>
      @endif
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Treaty Year</div>
      <div class="col-md-3"><input class="form-control form-control-sm yearmask yearpicker" type="text"
          name="treaty_year" id="treaty_year" value="{{ @$subdetail->getprop->treaty_year }}" autocomplete="off"
          required>
        <div class="invalid-feedback">
          Year below/above 2 years!
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Ceding/Broker</div>
      <div class="col-md-9">
        <select name="ceding_broker" class="e1 form-control form-control-sm" id="ceding_broker" required>
          <option value="" disabled selected>Select Ceding/Broker</option>
          @foreach ($ceding as $c)
          <option value="{{ $c->id }}" @if(@$subdetail->getprop->ceding_broker == $c->id) selected @endif>
            {{ $c->code }} - {{ $c->name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Type</div>
      <div class="col-md-9">
        <select name="ceding_broker_type" class="e1 form-control form-control-sm" id="ceding_broker_type" required>
          <option value="" disabled selected>Select Type</option>
          <option value="Ceding" @if(@$subdetail->getprop->ceding_broker_type == 'Ceding') selected @endif>
            Ceding
          </option>
          <option value="Broker" @if(@$subdetail->getprop->ceding_broker_type == 'Broker') selected @endif>
            Broker
          </option>
        </select>
      </div>
    </div>

  </div>

</div>