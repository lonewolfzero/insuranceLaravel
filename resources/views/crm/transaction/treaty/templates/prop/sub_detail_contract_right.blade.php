<div class="col">
  <div class="row mb-2">
    <div class="col-md-4">Counter Number</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="counter_number" type="text" readonly
        id="counter_number" value="{{ @$subdetail->counter_number }}"></div>
  </div>
  <div class="row mb-2">
    <div class="col-md-4">Date Prod</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="date_prod" type="text" readonly
        id="date_prod" @if(@$subdetail->date_prod) value="{{ date('d/m/Y',strtotime(@$subdetail->date_prod)) }}" @else
      value="{{ date('d/m/Y',strtotime(now())) }}" @endif>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-md-4">User Entry</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="user_entry" type="text" readonly
        id="user_entry" @if(@$subdetail->user_entry) value="{{ @$subdetail->getuser->name }}" @else
      value="{{ auth()->user()->name }}" @endif></div>
  </div>

  <div style="height: 40px;"></div>

  <div class="row mb-2">
    <div class="col-md-4">E.P.I (100% TTY)</div>
    <div class="col-md-5"><input class="form-control form-control-sm money text-left" name="e_p_i" type="text"
        id="e_p_i" value="{{ @$subdetail->e_p_i ? number_format(@$subdetail->e_p_i, 2) : '' }}" autocomplete="off"
        required></div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Treaty System (R/C)</div>
    <div class="col-md-5">
      <select class="form-control form-control-sm" name="treaty_system" id="treaty_system" required>
        <option value="" selected disabled></option>
        <option value="Run Off" @if(@$subdetail->treaty_system =="Run Off") selected @endif>Run Off</option>
        <option value="Cut Off" @if(@$subdetail->treaty_system =="Cut Off") selected @endif>Cut Off</option>
      </select>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Nasionalre Share</div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="nasionalre_share_first"
          id="nasionalre_share_first"
          value="{{ @$subdetail->nasionalre_share_first ? number_format(@$subdetail->nasionalre_share_first, 2) : '' }}"
          autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-1 text-center">Of</div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="nasionalre_share_second"
          id="nasionalre_share_second"
          value="{{ @$subdetail->nasionalre_share_second ? number_format(@$subdetail->nasionalre_share_second, 2) : '' }}"
          autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2">Of 100%</div>
  </div>

  {{-- <div class="row mb-2">
    <div class="col-md-4">Deficit Carrier Forward (DCF)</div>
    <div class="col-md-5"><input class="form-control form-control-sm" name="deficit_carrier_forward" type="text"
        id="deficit_carrier_forward" value="{{ @$subdetail->deficit_carrier_forward }}">
    </div>
  </div> --}}

  <div class="row mb-2">
    <div class="col-md-4">Prof. Comm (Y/N)</div>
    <div class="col-md-3">
      <select class="form-control form-control-sm" name="prof_comm_decision" id="prof_comm_decision" required>
        <option value="" selected></option>
        <option value="yes" @if(@$subdetail->prof_comm_decision =="yes") selected @endif>Yes</option>
        <option value="no" @if(@$subdetail->prof_comm_decision =="no") selected @endif>No</option>
      </select>
    </div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <select class="form-control form-control-sm" name="year_dcf" id="year_dcf" required>
          <option value="" selected></option>
          <option value="0" @if(@$subdetail->year_dcf =="0") selected @endif>0</option>
          <option value="1" @if(@$subdetail->year_dcf =="1") selected @endif>1</option>
          <option value="2" @if(@$subdetail->year_dcf =="2") selected @endif>2</option>
          <option value="3" @if(@$subdetail->year_dcf =="3") selected @endif>3</option>
          <option value="4" @if(@$subdetail->year_dcf =="4") selected @endif>4</option>
          <option value="5" @if(@$subdetail->year_dcf =="5") selected @endif>5</option>
        </select>
        <div class="input-group-append">
          <span class="input-group-text" for="year_dcf">Year DCF</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Prof. Comm (%)</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="prof_comm_percentage"
          id="prof_comm_percentage"
          value="{{ @$subdetail->prof_comm_percentage ? number_format(@$subdetail->prof_comm_percentage, 2) : '' }}"
          autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2 text-center">Mgt. Exp</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="mgt_exp" id="mgt_exp"
          value="{{ @$subdetail->mgt_exp ? number_format(@$subdetail->mgt_exp, 2) : '' }}" autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">R/I Comm Gross (%)</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="r_i_comm_gross" id="r_i_comm_gross"
          value="{{ @$subdetail->r_i_comm_gross ? number_format(@$subdetail->r_i_comm_gross, 2) : '0' }}"
          autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2 text-center">R/I Comm Nett (%)</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="r_i_comm_nett" id="r_i_comm_nett"
          value="{{ @$subdetail->r_i_comm_nett ? number_format(@$subdetail->r_i_comm_nett, 2) : '0' }}"
          autocomplete="off" required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Brokerage (%)</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="brokerage" id="brokerage"
          value="{{ @$subdetail->brokerage ? number_format(@$subdetail->brokerage, 2) : '' }}" autocomplete="off"
          required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
    <div class="col-md-2 text-center">VAT</div>
    <div class="col-md-1" style="text-align: center; place-self: center;">
      <input type="checkbox" name="vat_check" id="vat_check" @if(@$subdetail->vat_check) checked @endif>
    </div>
    <div class="col-md-2">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm money text-left" name="vat_percentage" id="vat_percentage"
          value="{{ @$subdetail->vat_percentage ? number_format(@$subdetail->vat_percentage, 2) : '' }}"
          @if(!@$subdetail->vat_check) readonly @endif autocomplete="off">
        <div class="input-group-append"><span class="input-group-text">%</span></div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Bordereaux Reporting</div>
    <div class="col-md-3">
      <select class="form-control form-control-sm" name="bordereaux_reporting" id="bordereaux_reporting" required>
        <option value="" selected></option>
        <option value="Monthly" @if(@$subdetail->bordereaux_reporting =="Monthly") selected @endif>Monthly</option>
        <option value="Non Reporting" @if(@$subdetail->bordereaux_reporting =="Non Reporting") selected @endif>Non
          Reporting
        </option>
        <option value="Quarterly" @if(@$subdetail->bordereaux_reporting =="Quarterly") selected @endif>Quarterly
        </option>
        <option value="Half Yearly" @if(@$subdetail->bordereaux_reporting =="Half Yearly") selected @endif>Half Yearly
        </option>
      </select>
    </div>
    <div class="col-md-2">Account</div>
    <div class="col-md-3">
      <select class="form-control form-control-sm" name="bordereaux_reporting_account" id="bordereaux_reporting_account"
        required>
        <option value=""></option>
        <option value="Quarterly" @if(@$subdetail->bordereaux_reporting_account =="Quarterly") selected @endif>Quarterly
        </option>
        <option value="Half Yearly" @if(@$subdetail->bordereaux_reporting_account =="Half Yearly") selected @endif>Half
          Yearly
        </option>
        <option value="Monthly" @if(@$subdetail->bordereaux_reporting_account =="Monthly") selected @endif>Monthly
        </option>
      </select>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4 d-flex">
      <div class="row">
        <div class="col-md-6">Submission</div>
        <div class="col-md-6">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" type="number" name="submission"
              aria-label="Recipient's username" aria-describedby="submission-addon2" id="submission"
              value="{{ @$subdetail->submission }}" required>
            <div class="input-group-append">
              <span class="input-group-text" id="submission-addon2">Days</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="row">
        <div class="col-md-6">Confirmation</div>
        <div class="col-md-6">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" type="number" name="confirmation"
              aria-label="Recipient's username" aria-describedby="confirmation-addon2" id="confirmation"
              value="{{ @$subdetail->confirmation }}" required>
            <div class="input-group-append">
              <span class="input-group-text" id="confirmation-addon2">Days</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="row">
        <div class="col-md-6">Settlement</div>
        <div class="col-md-6">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" type="number" name="settlement"
              aria-label="Recipient's username" aria-describedby="settlement-addon2" id="settlement"
              value="{{ @$subdetail->settlement }}" required>
            <div class="input-group-append">
              <span class="input-group-text" id="settlement-addon2">Days</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Total Account Period</div>
    <div class="col-md-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-sm" type="number" name="total_account_period"
          aria-label="Recipient's username" aria-describedby="total_account_period-addon2" id="total_account_period"
          readonly value="{{ @$subdetail->total_account_period }}" required>
        <div class="input-group-append">
          <span class="input-group-text" id="total_account_period-addon2">Days</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Remark</div>
    <div class="col-md-8">
      <textarea class="form-control form-control-sm" name="remark" id="remark"
        required>{{ @$subdetail->remark ?? '0' }}</textarea>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-4">Status</div>
    <div class="col-md-5">
      <select class="form-control form-control-sm" name="status" id="status" required>
        <option value="" selected disabled></option>
        <option value="Pre Summary" @if(@$subdetail->status == "Pre Summary") selected @endif>Pre Summary</option>
        <option value="Draft" @if(@$subdetail->status == "Draft") selected @endif>Draft</option>
        <option value="Original" @if(@$subdetail->status == "Original") selected @endif>Original</option>
        <option value="Endorsment" @if(@$subdetail->status == "Endorsment") selected @endif>Endorsment</option>
      </select>
    </div>
  </div>

</div>