<form onsubmit="submitFilter(this); return false">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="row mb-2">
        <div class="col-md-2">U/W Year</div>
        <div class="col">
          <div class="row">
            <div class="col-md-3"><input type="text" name="u_w_year"
                class="form-control form-control-sm yearpicker yearmask" value="{{ @$sliding->getprop->treaty_year }}"
                autocomplete="off" required>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-md-2 text-right">As At</div>
            <div class="col-md-3"><input type="text" name="as_at"
                class="form-control form-control-sm datepicker datemask"></div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding/Broker</div>
        <div class="col-md-9"><select name="ceding_broker" class="e1 form-control form-control-sm">
            <option value="" selected disabled>Select Ceding/Broker</option>
            @foreach ($ceding as $c)
            <option value="{{ $c->id }}" @if(@$sliding->getprop->ceding_broker == $c->id) selected @endif>{{ $c->name }}
            </option>
            @endforeach
          </select></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">Ceding Company</div>
        <div class="col-md-9"><select name="ceding_company" class="e1 form-control form-control-sm">
            <option value="" selected disabled>Select Ceding Company</option>
            @foreach ($ceding as $c)
            <option value="{{ $c->id }}" @if(@$sliding->getprop->ceding_company == $c->id) selected
              @endif>{{ $c->name }}</option>
            @endforeach
          </select></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">COB</div>
        <div class="col-md-9"><select name="cob" class="e1 form-control form-control-sm">
            <option value="" selected disabled>Select COB</option>
            @foreach ($cob as $c)
            <option value="{{ $c->id }}" @if(@$sliding->getprop->cob == $c->id) selected @endif>{{ $c->description }}
            </option>
            @endforeach
          </select></div>
      </div>

      <div class="row mb-2">
        <div class="col-md-2">KOC</div>
        <div class="col-md-9"><select name="koc" class="e1 form-control form-control-sm">
            <option value="" selected disabled>Select KOC</option>
            @foreach ($koc as $c)
            <option value="{{ $c->id }}" @if(@$sliding->getprop->koc == $c->id) selected @endif>{{ $c->description }}
            </option>
            @endforeach
          </select></div>
      </div>

      <div class="row my-3 justify-content-center">
        <div class="col-md-4 text-center"><button type="submit" class="btn btn-primary">Calculate Sliding Scale</button>
        </div>
      </div>

    </div>
  </div>
</form>