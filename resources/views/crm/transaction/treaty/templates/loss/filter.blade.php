<form onsubmit="submitFilter(this); return false">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="row mb-2">
        <div class="col-md-2">Treaty Year</div>
        <div class="col-md-2">
          <div class="row">
            <div class="col-md-7"><input type="text" autocomplete="off"
                class="form-control form-control-sm yearmask yearpicker" name="treaty_year" id="treaty_year"
                value="{{ @$loss->getprop->treaty_year }}" required>
            </div>
          </div>
        </div>

        <div class="col-md-2 text-right">As At</div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-7"><input type="text" autocomplete="off"
                class="form-control form-control-sm datemask datepicker" name="as_at" id="as_at"
                value="{{ @$loss->as_at }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding/Broker</div>
        <div class="col-md-9">
          <select class="e1 form-control form-control-sm" name="ceding_broker" id="ceding_broker">
            <option value="" selected disabled>Select Ceding/Broker</option>
            @foreach ($ceding as $c)
            <option value="{{ $c->id }}" @if (@$loss->getprop->ceding_broker == $c->id) selected
              @endif>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding Company</div>
        <div class="col-md-9">
          <select class="e1 form-control form-control-sm" name="ceding_company" id="ceding_company">
            <option value="" selected disabled>Select Ceding Company</option>
            @foreach ($ceding as $c)
            <option value="{{ $c->id }}" @if (@$loss->getprop->ceding_company == $c->id) selected
              @endif>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">COB</div>
        <div class="col-md-9"><select class="e1 form-control form-control-sm" name="cob" id="cob" required>
            <option value="" selected disabled>Select COB</option>
            @foreach ($cob as $c)
            <option value="{{ $c->id }}" @if (@$loss->getprop->cob == $c->id) selected
              @endif>{{ $c->description }}</option>
            @endforeach
          </select></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">KOC</div>
        <div class="col-md-9"><select class="e1 form-control form-control-sm" name="koc" id="koc" required>
            <option value="" selected disabled>Select KOC</option>
            @foreach ($koc as $c)
            <option value="{{ $c->id }}" @if (@$loss->getprop->koc == $c->id) selected
              @endif>{{ $c->description }}</option>
            @endforeach
          </select></div>
      </div>

      <div class="row my-3 justify-content-center">
        <div class="col-md-4 text-center"><button class="btn btn-primary" type="submit">Check Loss
            Participation</button></div>
      </div>

    </div>
  </div>
</form>