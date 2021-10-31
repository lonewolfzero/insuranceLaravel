<div class="row">
  <div class="col-md-6">
    <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td>Reg Comp</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="hidden" id="mainclaimid" value="">
                <input type="hidden" id="statusflag" value="{{ @$status_flag }}">
                <input type="hidden" id="selectedslip">
                <input type="hidden" id="currency">
                <input type="text" name="regcomp" id="regcomp" class="form-control" autocomplete="off" @if(@$claimdata)
                  value="{{ $claimdata->reg_comp }}" @endif disabled>
              </td>
              <td class="w-25">
                <input type="text" name="doccounter" id="doccounter" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->doc_counter }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                Status
              </td>
              <td>
                @if (@$claimdata->status_flag == 1) @php $val = 'PLA' @endphp
                @elseif (@$claimdata->status_flag == 2) @php $val = 'INTERIM' @endphp
                @elseif (@$claimdata->status_flag == 3) @php $val = 'DLA' @endphp
                @endif
                <input type="text" name="statusdocument" id="statusdocument" class="form-control" autocomplete="off"
                  disabled value="{{ @$val }}">
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>


  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td id="date_receipttext">
              Date Of Receipt
            </td>
            <th>
              <input type="text" name="date_receipt" id="date_receipt" class="form-control datepicker datemask"
                @if(@$claimdata) value="{{ date('d/m/Y', strtotime($claimdata->date_receipt)) }}" @endif
                autocomplete="off">
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-md-3">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td id="date_documenttext">
              Date Of Document
            </td>
            <td>
              <input type="text" name="date_document" id="date_document" class="form-control datepicker datemask"
                @if(@$claimdata) value="{{ date('d/m/Y', strtotime($claimdata->date_document)) }}" @endif
                autocomplete="off">

            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>


<div class="row">

  <div class="col-md-6">

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td>Doc Ref Number</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="docnumber" id="docnumber" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->doc_number }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td id="docpladlatext">Doc Number DLA/PLA</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="docpladla" id="docpladla" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->docpladla }}" @endif>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <input type="hidden" id="desccauseoflosstext" value="Cause Of Loss Description">
              <td id="causeofloss_idtext">Cause Of Loss</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                @foreach ($causeofloss as $pi)
                <input type="hidden" id="desccol{{ $pi->id }}" value="{{ $pi->keterangan }}">
                @endforeach
                <select id="causeofloss_id" name="causeofloss_id" class="e1 form-control form-control-sm ">
                  <option selected value="" disabled>{{ __('Select Cause Of Loss') }}</option>
                  @foreach ($causeofloss as $pi)
                  <option value="{{ $pi->id }}" @if(@$claimdata && $pi->id == @$claimdata->causeofloss_id) selected
                    @endif>{{ $pi->nama }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="desccauseofloss" id="desccauseofloss" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->desc_causeofloss }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <input type="hidden" id="descnatureoflosstext" value="Nature Of Loss Description">
              <td id="natureofloss_idtext">Nature Of Loss</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                @foreach ($natureofloss as $pi)
                <input type="hidden" id="descnol{{ $pi->id }}" value="{{ $pi->keterangan }}">
                @endforeach
                <select id="natureofloss_id" name="natureofloss_id" class="e1 form-control form-control-sm ">
                  <option selected value="" disabled>{{ __('Select Nature Of Loss') }}</option>
                  @foreach ($natureofloss as $pi)
                  <option value="{{ $pi->id }}" @if(@$claimdata && $pi->id == @$claimdata->natureofloss_id) selected
                    @endif>{{ $pi->accident }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="descnatureofloss" id="descnatureofloss" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->descnatureofloss }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td>Reinsurance Periode</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <p>From</p>
              </td>
              <td>
                <input type="text" id="reinsurance_from" class="form-control" disabled @if(@$claimdata)
                  value="{{ date('d/m/Y', strtotime($claimdata->slip->reinsurance_period_from)) }}" @endif>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <p>To</p>
              </td>
              <td>
                <input type="text" id="reinsurance_to" class="form-control" disabled @if(@$claimdata)
                  value="{{ date('d/m/Y', strtotime($claimdata->slip->reinsurance_period_to)) }}" @endif>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td id="date_of_losstext">Date Of Loss</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="date_of_loss" id="date_of_loss" class="form-control datepicker datemask"
                  @if(@$claimdata) value="{{ date('d/m/Y', strtotime($claimdata->date_of_loss)) }}" @endif
                  autocomplete="off">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <input type="hidden" id="desccurroflosstext" value="Curr Of Loss Description">
              <td id="curr_id_losstext">Curr Of Loss</td>
              <td>
                @foreach ($currency as $curr)
                <input type="hidden" id="desccurr{{ $curr->id }}" value="{{ $curr->symbol_name }}">
                @endforeach
                <select style="width: fit-content;" name="curr_id_loss" id="curr_id_loss" class="form-control"
                  @if(!(@$status_flag==1 || @$status_flag==null)) disabled @endif>
                  {{-- <option selected disabled>{{ __('Select Currency Of Loss') }}</option> --}}
                  @foreach ($currency as $curr)
                  <option value="{{ $curr->id }}" @if(@$claimdata && $curr->id == @$claimdata->curr_id_loss) selected
                    @endif>{{ $curr->code }}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <input type="text" name="desccurrofloss" id="desccurrofloss" class="form-control" readonly="true"
                  @if(@$claimdata) value="{{ $claimdata->curr_lossdesc }}" @endif autocomplete="off">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <input type="hidden" id="descadjustertext" value="Adjuster Description">
              <td id="adjuster_idtext">Adjuster</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                @foreach ($adjusters as $adj)
                <input type="hidden" id="descadj{{ $adj->id }}" value="{{ $adj->keterangan }}">
                @endforeach
                <select id="adjuster_id" name="adjuster_id" class="e1 form-control form-control-sm">
                  <option selected value="" disabled>{{ __('Select Adjuster') }}</option>
                  @foreach ($adjusters as $adj)
                  <option value="{{ $adj->id }}" @if(@$claimdata && $adj->id == @$claimdata->adjuster_id) selected
                    @endif>{{ $adj->number }} -
                    {{ $adj->keterangan }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="descadjuster" id="descadjuster" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->desc_adjuster }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <input type="hidden" id="descsurveyortext" value="Surveyor Description">
              <td id="surveyor_idtext">Surveyor</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                @foreach ($surveyors as $srv)
                <input type="hidden" id="descsrv{{ $srv->id }}" value="{{ $srv->keterangan }}">
                @endforeach
                <select id="surveyor_id" name="surveyor_id" class="e1 form-control form-control-sm">
                  <option selected value="" disabled>{{ __('Select Surveyor') }}</option>
                  @foreach ($surveyors as $srv)
                  <option value="{{ $srv->id }}" @if(@$claimdata && $srv->id == @$claimdata->surveyor_id) selected
                    @endif >{{ $srv->number }} -
                    {{ $srv->keterangan }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="descsurveyor" id="descsurveyor" class="form-control" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->desc_surveyor }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td>National Re's Liab</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <div class="input-group">
                  <input type="text" id="nationalresliab" name="nationalresliab" class="form-control floatTextBox"
                    placeholder="b%" @if(@$claimdata) value="{{ $claimdata->nasre_liab }}" @endif disabled />
                  <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="descnationalresliab" id="descnationalresliab" class="form-control money"
                  autocomplete="off" @if(@$claimdata) value="{{ $claimdata->nasre_liabdesc }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td id="ced_sharetext">Cedant's Share</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="ced_share" id="ced_share" class="form-control money" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->ced_share }}" @endif disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-gray">
        Description Loss
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table id="propertyTypePanelAmount" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ __('No') }}</th>
                  <th>{{ __('Description') }}</th>
                  <th>{{ __('Amount') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody id="lossdesctbody">
                @if (@$desclosses)
                @foreach ($desclosses as $desc)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $desc->descLoss->desc_name }}</td>
                  <td class="money">{{ $desc->amount }}</td>
                  <td><a href="javascript:void(0)" onclick="deleteamountclaimdetail({{ $desc->id }})">delete</a></td>
                </tr>
                @endforeach
                @endif
              </tbody>
              <tbody>
                <tr>
                  <td></td>
                  <td>
                    <div class="form-group">
                      @foreach ($lossdesc as $cd)
                      <input type="hidden" id="desclossname{{ $cd->id }}" value="{{ $cd->desc_name }}">
                      <input type="hidden" id="desclossfactor{{ $cd->id }}" value="{{ $cd->factor }}">
                      @endforeach
                      <select id="descripitontableselect" name="descripitontableselect"
                        class="form-control form-control-sm e1">
                        <option value="" selected disabled>Select Loss Description Fee</option>
                        @foreach ($lossdesc as $cd)
                        <option value="{{ $cd->id }}">{{ $cd->desc_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                  <td>
                    <input type="text" id="amounttablemanual" name="amounttablemanual" placeholder="Amount Manual"
                      class="form-control form-control-sm money" />
                  </td>
                  <td>
                    <div class="form-group">
                      <button type="button" id="addmanualclaim-btn" name="addmanualclaim-btn"
                        class="btn btn-md btn-primary">{{ __('Add') }}</button>

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

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td id="nasre_share_losstext">National Re's Share on Loss</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="nasre_share_loss" id="nasre_share_loss" class="form-control money"
                  autocomplete="off" @if(@$claimdata) value="{{ $claimdata->nasre_share_loss }}" @endif readonly="true">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="row">

      <div class="col-md-3">
        <table class="table">
          <tbody>
            <tr>
              <td id="estimate_percent_subrotext">
                Estimate Amount Subrogasi
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-4">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <div class="input-group">
                  <input type="text" id="estimate_percent_subro" name="estimate_percent_subro"
                    class="form-control floatTextBox" placeholder="b%" data-mask="#" @if(@$claimdata)
                    value="{{ $claimdata->estimate_percent_subro }}" @endif />
                  <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-5">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="subrogasi" id="subrogasi" class="form-control money" autocomplete="off"
                  @if(@$claimdata) value="{{ $claimdata->estimate_amount_subro }}" @endif value="0" readonly="true">
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

  </div>

  <div class="col-md-6">
    <div class="row">
      <div class="col-md-2">
        <table class="table">
          <tbody>
            <tr>
              <td id="total_loss_amounttext">Total Loss Amt</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-8">
        <table class="table">
          <tbody>
            <tr>
              <td>
                <input type="text" name="total_loss_amount" id="total_loss_amount" class="form-control money"
                  readonly="true" autocomplete="off" @if(@$claimdata) value="{{ $claimdata->total_loss_amount }}"
                  @endif>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-2">
    <table class="table">
      <tbody>
        <tr>
          <input type="hidden" id="potentialrecoverydecisiontext" value="Potential Recovery Decision">
          <td id="potentialrecoverytext">Potential Recovery</td>
          <td>
            <select name="potentialrecoverydecision" id="potentialrecoverydecision" class="form-control">
              <option value="" disabled selected></option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="potentialrecovery" id="potentialrecovery" class="form-control"
              autocomplete="off"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div class="row">
  <div class="col-md-2">
    <table class="table">
      <tbody>
        <tr>
          <td id="kronologitext">Kronologi</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="kronologi" id="kronologi" class="form-control" autocomplete="off"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



<div class="row">
  <div class="col-md-2">
    <table class="table">
      <tbody>
        <tr>
          <td id="staffrecomendtext">Staff Recommendation</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="staffrecomend" id="staffrecomend" class="form-control" autocomplete="off"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
    <table class="table">
      <tbody>
        <tr>
          <td id="assistantmanagerrecomendtext">Assistan Manager Recommendation</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="assistantmanagerrecomend" id="assistantmanagerrecomend" class="form-control"
              autocomplete="off"></textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div class="card card-primary" id="postcard">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 com-sm-12 mt-3">
        <button type="submit" id="addclaiminsured-btn" class="btn btn-primary btn-block ">
          {{ __('SAVE') }}
        </button>
      </div>

    </div>
  </div>
</div>