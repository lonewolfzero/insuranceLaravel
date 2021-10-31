<div class="card">
  <div class="card-header bg-gray">
    Bordero Upload
  </div>
  <div class="card-body">
    <div class="row mb-2">
      <div class="col-md-4">Jenis</div>
      <div class="col-md-7">
        <select class="form-control form-control-sm" id="bordero_jenis" disabled>
          <option value="" disabled selected></option>
          <option value="premi">Premi</option>
          <option value="klaim">Klaim</option>
        </select>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-md-4">Format / Type</div>
      <div class="col-md-7">
        <select class="form-control form-control-sm" id="bordero_format" disabled>
          <option value="" disabled selected></option>
          <option value="marine" @if(@$bordero && @$bordero !=="marine" ) disabled @endif>marine</option>
          <option value="non marine" @if(@$bordero && @$bordero !=="nonmarine" ) disabled @endif>Non Marine</option>
          <option value="kredit" @if(@$bordero && @$bordero !=="kredit" ) disabled @endif>Kredit</option>
        </select>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-md-4">Incoming Date</div>
      <div class="col-md-7">
        <input class="form-control form-control-sm datemask datepicker" id="bordero_incoming_date" disabled>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-md-4">Document</div>
      <div class="col-md-7">
        <div class="input-group input-group-sm mb-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="bordero_input_file" aria-describedby="bordero_input_file"
              disabled>
            <label class="custom-file-label" for="bordero_input_file">Choose File ...</label>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="row justify-content-center">
          <div class="col-md-4 text-center"><button type="button" class="btn btn-sm btn-primary" id="btn_submit_bordero"
              onclick="uploadBordero()" disabled>Submit</button>
          </div>
          <div class="col-md-4 text-center"><button type="button" class="btn btn-sm btn-primary" id="btn_cancel_bordero"
              onclick="cancelBordero()" disabled>Cancel</button>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>