<div class="row">
  <div class="col-md-6">

    <div class="row mb-3">
      {{-- <div class="col-md-4"><button class="btn btn-sm btn-primary">Attach Document SOA</button></div> --}}
      <div class="col-md-4">
        <button type="button" onclick="openBorderoModal()" id="btn_show_bordero" class="btn btn-sm btn-primary"
          disabled>
          Show Borderaux
        </button>
      </div>
    </div>

    <input type="hidden" id="id_soa" value="{{ @$soa->id }}">
    <input type="hidden" id="bordero_report" value="{{ @$soa->getprop->getsubdetail->bordereaux_reporting_account }}">
    {{-- <div class="row mb-5">
      <div class="col-md-4"><a href="#">Attach File Doc</a></div>
    </div> --}}

    <div class="row mb-2">
      <div class="col-md-3">ID</div>
      <div class="col-md-3"><input type="text" class="form-control form-control-sm" name="soa_id" id="soa_id"
          value="{{ @$soa->soa_id }}" readonly>
      </div>
      <div class="col-md-3 d-flex">
        <div class="mr-1">Status</div>
        <input type="text" class="form-control form-control-sm" name="status" id="status" @if(@$soa->status)
        value="{{ @$soa->status }}" @else value="Original" @endif readonly>
        {{-- Revised --}}
      </div>
      <div class="col-md-3 d-flex">
        <div class="mr-1">Version</div>
        <input type="text" class="form-control form-control-sm" name="version" id="version" @if(@$soa->version)
        value="{{ @$soa->version }}"
        @else value="1" @endif readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Ceding/Broker</div>
      <div class="col-md-6">
        <input type="hidden" name="ceding_broker" id="ceding_broker" value="{{ @$soa->ceding_broker }}">
        <select name="select_ceding_broker" id="select_ceding_broker" class="e1 form-control form-control-sm" disabled>
          <option value="" selected disabled>{{ __('Select Ceding/Broker') }}</option>
          @foreach ($ceding as $c)
          @if ($c->id == @$soa->ceding_broker)
          <option value="{{ $c->id }}" selected>{{ $c->name }}
            @else
          <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Ceding Company</div>
      <div class="col-md-6">
        <input type="hidden" name="ceding_company" id="ceding_company" value="{{ @$soa->ceding_company }}">
        <select name="select_ceding_company" id="select_ceding_company" class="e1 form-control form-control-sm"
          disabled>
          <option value="" selected disabled>{{ __('Select Ceding Company') }}</option>
          @foreach ($ceding as $c)
          @if ($c->id == @$soa->ceding_company)
          <option value="{{ $c->id }}" selected>{{ $c->name }}
            @else
          <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      {{-- <div class="col-md-3">Reg Number</div>
      <div class="col-md-4">
        <input type="text" class="form-control form-control-sm @error('reg_number') is-invalid @enderror"
          name="reg_number" id="reg_number" value="{{ @$soa->reg_number }}" required>
      </div> --}}
      <div class="col-md-3">U/W Year</div>
      <div class="col-md-2">
        <input type="text"
          class="form-control form-control-sm yearmask yearpicker @error('u_w_year') is-invalid @enderror" required
          name="u_w_year" id="u_w_year" value="{{ @$soa->u_w_year }}" autocomplete="off">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Tty Summary</div>
      <div class="col-md-5">
        <select id="tty_summary" name="tty_summary"
          class="e1 form-control form-control-sm @error('tty_summary') is-invalid @enderror" required>
          <option value="" selected disabled>{{ __('Select Tty Summary') }}</option>
          @foreach ($props as $prop)
          <option value="{{ $prop->id }}" class="options" @if ($prop->id == @$soa->tty_summary) selected @endif>
            {{ $prop->id_detail_contract }} - {{ $prop->getcob->description }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-sm btn-primary" id="btn_sub_detail" type="button" onclick="openSubDetail()"
          @if(!@$soa->tty_summary) disabled @endif>
          Sub Detail
        </button>
      </div>
      <div class="col-md-2">
        <button class="btn btn-sm btn-primary" id="btn_ban_limit" type="button" onclick="openBanLimit()"
          @if(!@$soa->tty_summary) disabled @endif @if(@$soa->getprop->type != 'credit') style="display: none" @endif>
          Ban Limit
        </button>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Currency</div>
      <div class="col-md-2">
        <select name="currency" id="currency"
          class="e1 form-control form-control-sm @error('currency') is-invalid @enderror" required>
          <option value="" selected disabled></option>
          @foreach ($currencies as $c)
          @if ($c->id == @$soa->currency)
          <option value="{{ $c->id }}" selected>{{ $c->code }}</option>
          @else
          <option value="{{ $c->id }}">{{ $c->code }}</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="col-md-3 d-flex">
        <div class="mr-1">RI Comm %</div>
        <input name="r_i_comm_percentage" type="text"
          class="form-control form-control-sm @error('r_i_comm_percentage') is-invalid @enderror" required
          style="width: 60%" id="r_i_comm_percentage"
          value="{{ @$soa->r_i_comm_percentage ? number_format(@$soa->r_i_comm_percentage, 2) : '' }}">
      </div>
      <div class="col-md-4 d-flex">
        <div class="mr-1">Cash Call Limit</div>
        <input name="cash_call_limit" type="text"
          class="form-control form-control-sm money text-left @error('cash_call_limit') is-invalid @enderror" required
          style="width: 70%" id="cash_call_limit"
          value="{{ @$soa->cash_call_limit ? number_format(@$soa->cash_call_limit, 2) : '' }}">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Doc Number</div>
      <div class="col-md-6">
        <input name="doc_number" type="text"
          class="form-control form-control-sm @error('doc_number') is-invalid @enderror" required id="doc_number"
          value="{{ @$soa->doc_number }}">
      </div>
    </div>

    <div class="card">
      <div class="card-body bg-light-gray">
        <div class="row mb-2">
          <div class="col-md-3">Date Production</div>
          <div class="col-md-3">
            <input name="date_prod" type="text"
              class="form-control form-control-sm @error('date_prod') is-invalid @enderror" required id="date_prod"
              @if(@$soa && @$soa->date_prod) value="{{ date('d/m/Y',strtotime(@$soa->date_prod)) }}"
            @else
            value="{{ date('d/m/Y', strtotime(now())) }}" @endif autocomplete="off" readonly>
          </div>
          <div class="col-md-3">
            <input type="checkbox" class="mr-1" name="date_prod_extend_check" id="date_prod_extend_check"
              @if(@$soa->date_prod_extend_check) checked @endif>
            Extend
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-3">
          </div>
          <div class="col-md-3 d-flex">
            <select name="date_prod_period" id="date_prod_period" class="form-control form-control-sm" required
              @if(@$soa->getprop->getsubdetail->bordereaux_reporting_account == "Monthly") disabled @endif>
              <option value="" selected disabled></option>
              <option value="1" @if (@$soa && @$soa->date_prod_period == "1") selected @endif>1st</option>
              <option value="2" @if (@$soa && @$soa->date_prod_period == "2") selected @endif>2nd</option>
              <option class="dis_half" value="3" @if (@$soa && @$soa->date_prod_period == "3") selected @endif
                @if(@$soa->getprop->getsubdetail->bordereaux_reporting_account == "Half Yearly") disabled @endif>3rd
              </option>
              <option class="dis_half" value="4" @if (@$soa && @$soa->date_prod_period == "4") selected @endif
                @if(@$soa->getprop->getsubdetail->bordereaux_reporting_account == "Half Yearly") disabled @endif>4th
              </option>
              @if (@$soa->date_prod_extend_check)
              <option value="5" class="extend" @if (@$soa && @$soa->date_prod_period == "5") selected @endif>5th
              </option>
              <option value="6" class="extend" @if (@$soa && @$soa->date_prod_period == "6") selected @endif>6th
              </option>
              @if (@$soa->getprop->getsubdetail->bordereaux_reporting_account == "Quarterly")
              <option value="7" class="extend" @if (@$soa && @$soa->date_prod_period == "7") selected @endif>7th
              </option>
              <option value="8" class="extend" @if (@$soa && @$soa->date_prod_period == "8") selected @endif>8th
              </option>
              <option value="9" class="extend" @if (@$soa && @$soa->date_prod_period == "9") selected @endif>9th
              </option>
              <option value="10" class="extend" @if (@$soa && @$soa->date_prod_period == "10") selected @endif>10th
              </option>
              <option value="11" class="extend" @if (@$soa && @$soa->date_prod_period == "11") selected @endif>11th
              </option>
              <option value="12" class="extend" @if (@$soa && @$soa->date_prod_period == "12") selected @endif>12th
              </option>
              @endif
              @endif
            </select>
          </div>
          <div class="col-md-3 d-flex">
            <select name="date_prod_month" id="date_prod_month" class="form-control form-control-sm" required
              @if(@$soa->getprop->getsubdetail->bordereaux_reporting_account != "Monthly") disabled @endif>
              <option value="" selected disabled></option>
              <option @if (@$soa && @$soa->date_prod_month == "Januari") selected @endif
                value="Januari">Januari
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Februari") selected @endif
                value="Februari">Februari
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Maret") selected @endif value="Maret">Maret
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "April") selected @endif value="April">April
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Mei") selected @endif value="Mei">Mei
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Juni") selected @endif value="Juni">Juni
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Juli") selected @endif value="Juli">Juli
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Agustus") selected @endif
                value="Agustus">Agustus
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "September") selected @endif
                value="September">September
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Oktober") selected @endif
                value="Oktober">Oktober
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "November") selected @endif
                value="November">November
              </option>
              <option @if (@$soa && @$soa->date_prod_month == "Desember") selected @endif
                value="Desember">Desember
              </option>
            </select>
          </div>
          <div class="col-md-3 d-flex">
            <input name="date_prod_year" type="text" class="form-control form-control-sm yearmask yearpicker"
              id="date_prod_year" required value="{{ @$soa->date_prod_year }}" autocomplete="off"
              @if(!@$soa->date_prod_extend_check && @$soa->getprop->getsubdetail->bordereaux_reporting_account !=
            "Monthly") disabled @endif>
          </div>
        </div>
      </div>
    </div>


    <div class="row mb-2">
      <div class="col-md-3">Remarks</div>
      <div class="col-md-6">
        <input name="remark" type="text" class="form-control form-control-sm" id="remark" required
          value="{{ @$soa->remark }}">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Flag</div>
      <div class="col-md-6">
        <select name="flag" id="flag" class="form-control form-control-sm datetime" required>
          <option value="soa" @if (@$soa && @$soa->flag == "soa") selected @endif selected>SOA</option>
          <option value="transfer" @if (@$soa && @$soa->flag == "transfer") selected @endif>Transfer</option>
          <option value="withdraw" @if (@$soa && @$soa->flag == "withdraw") selected @endif>Withdraw</option>
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col">
        <div class="card">
          <div class="card-header bg-gray">
            Attach Document SOA
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table_attach_document_soa" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Url') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody id="tbody_attach_document_soa">
                  @if (@$document_attach)
                  @foreach ($document_attach as $doc)
                  <tr id="attach_document_soa_row{{ $doc->id }}">
                    <input type="hidden" name="attach_id[]" value="{{ $doc->id }}">
                    <input type="hidden" name="attach_description[]" value="{{ $doc->description }}">
                    <input type="hidden" name="attach_url[]" value="{{ $doc->url }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $doc->description }}</td>
                    <td>{{ $doc->url }}</td>
                    <td>
                      <button class="btn" onclick="deleteAttachment({{ $doc->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash"
                          viewBox="0 0 16 16">
                          <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                          <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
                <tbody>
                  <tr>
                    <td></td>
                    <td>
                      <div class="form-group">
                        <input type="text" id="attachmentdesc" class="form-control form-control-sm"
                          placeholder="Attachment Description">
                      </div>
                    </td>
                    <td>
                      <input type="text" id="attachmenturl" placeholder="Attachment Url"
                        class="form-control form-control-sm" />
                    </td>
                    <td>
                      <div class="form-group">
                        <button type="button" id="attachmentbtn" name="attachmentbtn" class="btn btn-md btn-primary">{{
                          __('Add') }}</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>