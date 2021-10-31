<div class="row justify-content-center">
  <div class="col-md-8">

    <div class="row mb-2">
      <div class="col-md-2">Treaty Year / U/Y</div>
      <div class="col-md-2">
        <div class="row">
          <div class="col-md-7"><input type="text" autocomplete="off"
              class="form-control form-control-sm yearmask yearpicker" name="treaty_year" id="treaty_year"
              value="{{ @$commission->treaty_year }}" required>
          </div>
        </div>
      </div>
      {{-- <div class="col">
          <div class="row">
            <div class="col-md-3 text-right">Period Year</div>
            <div class="col-md-4"><input type="text" autocomplete="off"
                class="form-control form-control-sm yearmask yearpicker" name="period_year"
                id="period_year"></div>
          </div>
        </div> --}}
    </div>

    <div class="row mb-2">
      <div class="col-md-2">Ceding/Broker</div>
      <div class="col-md-9">
        <input type="hidden" name="ceding_broker" id="ceding_broker" value="{{ @$commission->ceding_broker }}">
        <select class="e1 form-control form-control-sm" id="select_ceding_broker" disabled>
          <option value="" selected disabled>Select Ceding/Broker</option>
          @foreach ($ceding as $c)
          <option value="{{ $c->id }}" @if (@$commission->ceding_broker == $c->id) selected
            @endif>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-2">Ceding Company</div>
      <div class="col-md-9">
        <input type="hidden" name="ceding_company" id="ceding_company" value="{{ @$commission->ceding_company }}">
        <select class="e1 form-control form-control-sm" id="select_ceding_company" disabled>
          <option value="" selected disabled>Select Ceding Company</option>
          @foreach ($ceding as $c)
          <option value="{{ $c->id }}" @if (@$commission->ceding_company == $c->id) selected
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
          <option value="{{ $c->id }}" @if (@$commission->cob == $c->id) selected
            @endif>{{ $c->description }}</option>
          @endforeach
        </select></div>
    </div>

    <div class="row mb-2">
      <div class="col-md-2">KOC</div>
      <div class="col-md-9"><select class="e1 form-control form-control-sm" name="koc" id="koc" required>
          <option value="" selected disabled>Select KOC</option>
          @foreach ($koc as $c)
          <option value="{{ $c->id }}" @if (@$commission->koc == $c->id) selected
            @endif>{{ $c->description }}</option>
          @endforeach
        </select></div>
    </div>

    <div class="row my-3 justify-content-center">
      <div class="col-md-4 text-center"><button class="btn btn-primary" type="button"
          onclick="check_profit_commission()">Check Profit
          Commission</button></div>
    </div>

    <input type="hidden" name="prop_id" id="prop_id" value="{{ @$commission->prop_id }}">

    <div class="row mb-2">
      <div class="col-md-3">Summary :</div>
      <div class="col-md-2"><b id="check_summary">{{ @$commission->getprop->getsubdetail->treaty_year }} (Tahun)</b>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3">E.P.I (100 % TTY) :</div>
      <div class="col-md-2"><b id="check_e_p_i">{{ number_format(@$commission->getprop->getsubdetail->e_p_i, 2) }}</b>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-3">Deficit Carrier Forward (DCF) :</div>
      <div class="col-md-2"><b id="check_d_c_f">{{ @$commission->getprop->getsubdetail->year_dcf }} Years</b></div>
      <div class="col-md-1"></div>
      <div class="col-md-3">Total Premi SOA :</div>
      <div class="col-md-2"><b id="check_premi_soa"></b></div>
    </div>

    <div class="row mb-2 justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td>U/Y</td>
                  <td>Premi</td>
                  <td>Komisi</td>
                  <td>Klaim</td>
                  <td>Cash Call</td>
                  <td>OS Claim</td>
                  <td>Net Balance</td>
                </tr>
              </thead>
              <tbody id="tbody_profit_commission">
                @if (@$check && count(@$check) > 0)
                @foreach ($check as $c)
                <tr>
                  <td>{{ $c->uy }}</td>
                  <td>{{ number_format($c->premi, 2) }}</td>
                  <td>{{ number_format($c->komisi, 2) }}</td>
                  <td>{{ number_format($c->klaim, 2) }}</td>
                  <td>{{ number_format($c->cash_call, 2) }}</td>
                  <td>{{ number_format($c->os_klaim, 2) }}</td>
                  <td>{{ number_format($c->net_balance, 2) }}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>