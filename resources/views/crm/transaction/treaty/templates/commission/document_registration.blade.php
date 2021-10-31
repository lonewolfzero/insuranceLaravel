<form onsubmit="create_document_registration(this); return false">
  <div class="row">
    <div class="col-md-10">
      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Reg Number</div>
            <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="reg_number"
                id="reg_num_reg_number" readonly @if(@$commission->registration)
              value="{{ @$commission->registration->reg_number }}" @endif>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Date of Doc</div>
            <div class="col-md-6"><input type="text" name="date_of_doc" id="reg_num_date_of_doc"
                class="form-control form-control-sm datemask datepicker" autocomplete="off" required
                @if(@$commission->registration)
              value="{{ date('d/m/Y',strtotime(@$commission->registration->date_of_doc)) }}" @endif>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Ceding/Broker</div>
            <div class="col-md-6">
              <select name="ceding_broker" id="reg_num_ceding_broker"
                class="e1 form-control form-control-sm @error('reg_num_ceding_broker') is-invalid @enderror" required>
                <option value="" selected disabled>{{ __('Select Ceding/Broker') }}</option>
                @foreach ($ceding as $c)
                @if ($c->id == @$commission->registration->ceding_broker)
                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Incoming Date</div>
            <div class="col-md-6"><input type="text" class="form-control form-control-sm datemask datepicker"
                name="incoming_date" id="reg_num_incoming_date" autocomplete="off" required
                @if(@$commission->registration)
              value="{{ date('d/m/Y',strtotime(@$commission->registration->incoming_date)) }}"@endif>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Ceding Company</div>
            <div class="col-md-6">
              <select name="ceding_company" id="reg_num_ceding_company"
                class="e1 form-control form-control-sm @error('reg_num_ceding_company') is-invalid @enderror" required>
                <option value="" selected disabled>{{ __('Select Ceding Company') }}</option>
                @foreach ($ceding as $c)
                @if ($c->id == @$commission->registration->ceding_company)
                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Period</div>
            <div class="col-md-6">
              <select name="period" id="reg_num_period" class="form-control form-control-sm" autocomplete="off"
                required>
                <option value="" selected></option>
                <option value="1" @if(@$commission->registration->period == "1") selected @endif>1ST</option>
                <option value="2" @if(@$commission->registration->period == "2") selected @endif>2ND</option>
                <option value="3" @if(@$commission->registration->period == "3") selected @endif>3RD</option>
                <option value="4" @if(@$commission->registration->period == "4") selected @endif>4TH</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Ref Number</div>
            <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="ref_number"
                id="reg_num_ref_number" autocomplete="off" required @if(@$commission->registration)
              value="{{ @$commission->registration->ref_number }}"@endif>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Accounting Year</div>
            <div class="col-md-2"><input type="text" name="accounting_year" id="reg_num_accounting_year"
                autocomplete="off" class="form-control form-control-sm yearmask yearpicker" required
                @if(@$commission->registration)
              value="{{ @$commission->registration->accounting_year }}" @endif>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Delivered By</div>
            <div class="col-md-6">
              <select name="delivered_by" id="reg_num_delivered_by" class="form-control form-control-sm"
                autocomplete="off" required>
                <option value="" selected></option>
                <option value="post" @if(@$commission->registration->delivered_by == "post") selected
                  @endif>Post</option>
                <option value="email" @if(@$commission->registration->delivered_by == "email") selected
                  @endif>Email</option>
                <option value="fax" @if(@$commission->registration->delivered_by == "fax") selected
                  @endif>Fax</option>
                <option value="copied" @if(@$commission->registration->delivered_by == "copied") selected
                  @endif>Copied from other</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">Type</div>
            <div class="col-md-6">
              <select name="type" id="reg_num_type" class="form-control form-control-sm" autocomplete="off" required>
                {{-- <option value="" selected></option> --}}
                <option value="pc" selected>Profit Commission</option>
                {{-- <option value="commission" selected>Statement Of Account</option> --}}
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <button class="btn btn-primary" type="submit">Create</button>
    </div>
  </div>
</form>