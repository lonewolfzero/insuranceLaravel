<div class="row mb-4">
  <div class="col-md-2">COB</div>
  <div class="col-md-4">
    <input type="text" id="cob" class="form-control" autocomplete="off" disabled>
  </div>
</div>
<div class="row mb-4">
  <div class="col-md-2">KOC</div>
  <div class="col-md-4">
    <input type="text" id="koc" class="form-control" autocomplete="off" disabled>
  </div>
</div>

<div class="row mb-4">
  <div class="col-md-6">
    <input type="hidden" name="_token2" id="token" value="{{ csrf_token() }}">
    <div class="row">
      <div class="col-md-3">
        <p>Reg Comp</p>
      </div>

      <div class="col-md-5">
        <div class="row">
          <div class="col-md-8">
            <input type="text" name="regcomp" id="regcomp" class="form-control" autocomplete="off" disabled>
          </div>
          <div class="col-md-4">
            <input type="text" name="doccounter" id="doccounter" class="form-control" autocomplete="off" disabled>
          </div>
          <input type="hidden" id="mainclaimid" value="{{ @$idclaim }}">
          <input type="hidden" id="statusflag" value="{{ @$status_flag }}">
          <input type="hidden" id="doc_type" value="{{ @$type }}">
          <input type="hidden" id="selectedslip">
          <input type="hidden" id="selectedslipid">
          <input type="hidden" id="currency">
        </div>
      </div>

      <div class="col-md-4">
        <div class="row">
          <div class="col-md-5 text-right">Status</div>
          <div class="col-md-7">
            <input type="text" name="statusdocument" id="statusdocument" class="form-control" autocomplete="off"
              disabled>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="col-md-3">

    <div class="row">
      <div class="col-md-6">
        <p id="dateofreceipttext" class="text-right">
          Date Of Receipt
        </p>
      </div>
      <div class="col-md-6">
        <input type="text" name="dateofreceipt" id="dateofreceipt" class="form-control datepicker datemask"
          autocomplete="off">
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="row">
      <div class="col-md-6">
        <p id="dateofdocumenttext" class="text-right">
          Date Of Document
        </p>
      </div>
      <div class="col-md-6">
        <input type="text" name="dateofdocument" id="dateofdocument" class="form-control datepicker datemask"
          autocomplete="off">
      </div>
    </div>
  </div>

</div>


<div class="row">

  <div class="col-md-6">

    <div class="row mb-4">
      <div class="col-md-4">
        <p>Doc Ref Number</p>
      </div>
      <div class="col-md-8">
        <input type="text" name="docnumber" id="docnumber" class="form-control" autocomplete="off" disabled>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="docpladlatext">Doc Number DLA/PLA</p>
      </div>
      <div class="col-md-8">
        <input type="text" name="docpladla" id="docpladla" class="form-control" autocomplete="off">
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="causeoflosstext">Cause Of Loss</p>
      </div>
      <div class="col-md-8">
        <select id="causeofloss" name="causeofloss" class="e1 form-control">
          <option selected value="" disabled>{{ __('Cause Of Loss') }}</option>
          @foreach ($causeofloss as $pi)
          <option value="{{ $pi->id }}">{{ $pi->number }} - {{ $pi->nama }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="natureoflosstext">Nature Of Loss</p>
      </div>
      <div class="col-md-8">
        <select id="natureofloss" name="natureofloss" class="e1 form-control">
          <option selected value="" disabled>{{ __('Nature Of Loss') }}</option>
          @foreach ($natureofloss as $pi)
          <option value="{{ $pi->id }}">{{ $pi->number }} - {{ $pi->accident }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p>Reinsurance Periode</p>
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">From</div>
              <div class="col-md-9"><input type="text" id="reinsurance_from" class="form-control" disabled></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3 text-right">To</div>
              <div class="col-md-9"><input type="text" id="reinsurance_to" class="form-control" disabled></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="dateoflosstext">Date Of Loss</->
      </div>
      <div class="col-md-4">
        <input type="text" name="dateofloss" id="dateofloss" class="form-control datepicker datemask"
          autocomplete="off">
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="curroflosstext">Curr Of Loss</p>
      </div>
      <div class="col-md-8">
        <select name="currofloss" id="currofloss" class="e1 form-control" @if(!(@$status_flag==1 ||
          @$status_flag==null)) disabled @endif>
          <option selected disabled>{{ __('Select Currency') }}</option>
          @foreach ($currency as $curr)
          <option value="{{ $curr->id }}">{{ $curr->code }} - {{ $curr->symbol_name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-4">
        <p id="adjustertext">Adjuster</p>
      </div>
      <div class="col-md-8">
        <select id="adjuster" name="adjuster" class="e1 form-control ">
          <option selected value="" disabled>{{ __('Select Adjuster') }}</option>
          @foreach ($surveyor as $pi)
          @if ($pi->type_flag == 2)
          <option value="{{ $pi->id }}">{{ $pi->number }} - {{ $pi->keterangan }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>

    @if (@$type == "mc" || @$type == "mh")
    <div class="row mb-4">
      <div class="col-md-4">
        <p id="surveyortext">Surveyor</p>
      </div>
      <div class="col-md-8">
        <select id="surveyor" name="surveyor" class="e1 form-control ">
          <option selected value="" disabled>{{ __('Select Surveyor') }}</option>
          @foreach ($surveyor as $pi)
          @if ($pi->type_flag == 1)
          <option value="{{ $pi->id }}">{{ $pi->number }} - {{ $pi->keterangan }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>
    @endif

    <div class="row mb-4">
      <div class="col-md-4">
        <p>National Re's Liab</p>
      </div>
      <div class="col-md-3">
        <div class="input-group">
          <input type="text" id="nationalresliab" name="nationalresliab" class="form-control floatTextBox"
            placeholder="b%" disabled />
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fa fa-percent" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <input type="text" name="descnationalresliab" id="descnationalresliab" class="form-control money"
          autocomplete="off" disabled>
      </div>
    </div>


    <div class="row mb-4">
      <div class="col-md-4">
        <p id="cedantsharetext">Cedant's Share</p>
      </div>
      <div class="col-md-8">
        <input type="text" name="cedantshare" id="cedantshare" class="form-control money" autocomplete="off" disabled>
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

<div class="row mb-4">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-4">
        <p id="shareonlosstext">National Re's Share on Loss</p>
      </div>
      <div class="col-md-8">
        <input type="text" name="shareonloss" id="shareonloss" class="form-control money" autocomplete="off"
          readonly="true">
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-md-6">
    <div class="row">

      <div class="col-md-4">
        <p id="subrogasipersentext">
          Estimate Amount Subrogasi
        </p>
      </div>

      <div class="col-md-3">
        <div class="input-group">
          <input type="text" id="subrogasipersen" name="subrogasipersen" class="form-control floatTextBox"
            placeholder="b%" data-mask="#" />
          <div class="input-group-append">
            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        <input type="text" name="subrogasi" id="subrogasi" class="form-control money" autocomplete="off" value="0"
          readonly="true">
      </div>

    </div>

  </div>

  <div class="col-md-6">
    <div class="row">
      <div class="col-md-3">
        <p id="totallossamounttext">Total Loss Amt</p>
      </div>
      <div class="col-md-7">
        <input type="text" name="totallossamount" id="totallossamount" class="form-control money" readonly="true"
          autocomplete="off">
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
            <select name="potentialrecoverydecision" id="potentialrecoverydecision" class="form-control"
              style="width: fit-content;">
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

<div class="row">
  <div class="col-md-2">
    <table class="table">
      <tbody>
        <tr>
          <td id="managerrecomendtext">Manager Recommendation</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="managerrecomend" id="managerrecomend" class="form-control" autocomplete="off"></textarea>
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
          <td id="generalmanagerrecomendtext">General Manager Recommendation</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-9">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <textarea name="generalmanagerrecomend" id="generalmanagerrecomend" class="form-control"
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