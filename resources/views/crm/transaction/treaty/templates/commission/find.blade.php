<div class="my-5">

  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <div class="row mb-2">
            <div class="col-md-5">Ceding / Broker</div>
            <div class="col-md-7">
              <input type="text" class="form-control form-control-sm" id="find_ceding_broker"
                value="{{ @$commission->getbroker->name }}" readonly>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-5">Ceding Company</div>
            <div class="col-md-7">
              <input type="text" class="form-control form-control-sm" id="find_ceding_company"
                value="{{ @$commission->getcompany->name }}" readonly>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-gray">Currency</div>
            <div class="card-body row">
              <div class="form-check col-6 text-center">
                <input class="form-check-input" type="radio" name="currency_radio" id="currency_radio1" value="original"
                  @if(@$commission->currency_radio == "original") checked @endif required>
                <label class="form-check-label" for="currency_radio1">
                  Original
                </label>
              </div>
              <div class="form-check col-6 text-center">
                <input class="form-check-input" type="radio" name="currency_radio" id="currency_radio2" value="idr"
                  @if(@$commission->currency_radio == "idr") checked @endif>
                <label class="form-check-label" for="currency_radio2">
                  IDR
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row mb-2">
            <div class="col-md-5">U/W Year</div>
            <div class="col-md-7">
              <input type="text" class="form-control form-control-sm" id="find_u_w_year"
                value="{{ @$commission->treaty_year }}" readonly>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-5">COB</div>
            <div class="col-md-7">
              <input type="text" class="form-control form-control-sm" id="find_cob"
                value="{{ @$commission->getcob->description }}" readonly>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-5">KOC</div>
            <div class="col-md-7">
              <input type="text" class="form-control form-control-sm" id="find_koc"
                value="{{ @$commission->getkoc->description }}" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-8 row mb-2">
          <div class="col-md-4">OS Claim Position</div>
          <div class="col-md-3"><input type="text" class="form-control form-control-sm datemask datepicker"
              name="os_claim_position" autocomplete="off" @if(@$commission->os_claim_position)
            value="{{ date('d/m/Y',strtotime(@$commission->os_claim_position)) }}" @endif required>
          </div>
        </div>
        <div class="col-md-4 row mb-2">
          <div class="col-md-6">Date Prod</div>
          <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="date_prod" readonly
              @if(@$commission->date_prod)
            value="{{ date('d/m/Y',strtotime(@$commission->date_prod)) }}" @else
            value="{{ date('d/m/Y', strtotime(now())) }}" @endif></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 row mb-2">
          <div class="col-md-4">Prod Year</div>
          <div class="col-md-3"><input type="text" class="form-control form-control-sm yearmask yearpicker"
              name="prod_year_start" autocomplete="off" value="{{ @$commission->prod_year_start }}" required>
          </div>
          <div class="col-md-1">Of</div>
          <div class="col-md-3"><input type="text" class="form-control form-control-sm yearmask yearpicker"
              name="prod_year_end" autocomplete="off" value="{{ @$commission->prod_year_end }}" required>
          </div>
        </div>
        <div class="col-md-4 row mb-2">
          <div class="col-md-6">User Entry</div>
          <div class="col-md-6"><input type="text" class="form-control form-control-sm" @if(@$commission->user_entry)
            value="{{ @$commission->getuser->name }}" @else
            value="{{ auth()->user()->name }} @endif" name="user_entry" readonly></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center my-4">
    <div class="col-md-2 text-center"><button type="button" id="btn_find" class="btn btn-primary"
        onclick="find_profit_commission()" disabled>Find</button>
    </div>
  </div>



  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td><input type="checkbox" id="soa_checkbox_all"></td>
                <td>ID</td>
                <td>Prod Date</td>
                <td>Doc Num</td>
                <td>QTR Tahun</td>
                <td>QTR No</td>
                <td>Currency</td>
                <td>Original Gross</td>
              </tr>
            </thead>
            <tbody id="tbody_soa_profit_commission">
              @if (@$soa && count(@$soa) > 0)
              @foreach ($soa as $key => $s)
              <tr>
                <input type="hidden" name="find_soa_id[]" value="{{ $s->getsoa->id }}">
                <td>
                  <input type="hidden" name="find_soa_checkbox[{{ $key }}]" value="off">
                  <input type="checkbox" class="find_soa_checkbox" name="find_soa_checkbox[{{ $key }}]" value="on"
                    @if($s->checked) checked
                  @endif>
                </td>
                <td>{{ $s->getsoa->soa_id }}</td>
                <td>{{ date('d/m/Y',strtotime($s->getsoa->date_prod)) }}</td>
                <td>{{ $s->getsoa->doc_number }}</td>
                <td>{{ $s->getsoa->date_prod_year ?? "-" }}</td>
                <td>{{ $s->getsoa->date_prod_period  ?? "-" }}</td>
                <td>{{ $s->getsoa->getcurrency->code }}</td>
                <td>{{ number_format($s->getsoa->treaty_gross_premium, 2) }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td><input type="checkbox" id="" name=""></td>
                <td>ID</td>
                <td>Date Prod</td>
                <td>Date Loss</td>
                <td>Curr</td>
                <td>Total Loss</td>
                <td>NR Share</td>
              </tr>
            </thead>
            <tbody id="tbody_claim_soa_commission"></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <div class="row justify-content-center my-4">
    <div class="col-md-3 text-center">
      <button class="btn btn-primary" id="btn_calculate" type="button" onclick="calculate_profit_commission()"
        disabled>Calculate & Show Profit
        Commission</button>
    </div>
  </div>

</div>