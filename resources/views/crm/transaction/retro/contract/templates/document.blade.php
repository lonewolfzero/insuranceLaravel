<input type="hidden" id="doc_type" value="{{ $table }}">

<form onsubmit="create_document(this); return false" id="form_{{ $table }}">

  <input type="hidden" name="contract_id" value="{{ @$contract->id }}">

  <div class="row mb-3">
    <div class="col-md-2 align-self-center">Document Date</div>
    <div class="col-md-2 align-self-center">
      <input type="text" class="form-control datepicker datemask" name="document_date" id="document_date"
        autocomplete="off" required>
    </div>
    <div class="col"></div>
    <div class="col-md-2 align-self-center">Username</div>
    <div class="col-md-2 align-self-center">
      <input type="text" class="form-control" name="username" id="username" value="{{ auth()->user()->name }}" disabled>
    </div>
  </div>

  <div class="row mb-3">
    @if (str_contains(request()->path(), "retro/contract/treaty/"))
    <div class="col-md-2 align-self-center">Quarter</div>
    <div class="col-md-2 align-self-center">
      <select name="quarter" id="quarter" class="form-control" required>
        <option value="" disabled selected>Select Quarter</option>
        <option value="1">1ST</option>
        <option value="2">2ND</option>
        <option value="3">3RD</option>
        <option value="4">4TH</option>
      </select>
    </div>
    <div class="col-md-1 align-self-center text-center">Year</div>
    <div class="col-md-2 align-self-center">
      <select name="year" id="year" class="form-control" required>
        <option value="" disabled selected>Select Year</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
      </select>
    </div>
    @endif
    <div class="col"></div>
    <div class="col-md-2 align-self-center">Date Entry</div>
    <div class="col-md-2 align-self-center">
      <input type="text" class="form-control datemask datepicker" name="date_entry" id="date_entry"
        value="{{ date('d/m/Y', strtotime(now())) }}" disabled>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col"></div>
    <div class="col-md-2 align-self-center">Production Date</div>
    <div class="col-md-2 align-self-center">
      <input type="text" class="form-control datemask datepicker" name="production_date" id="production_date"
        autocomplete="off" required>
    </div>
  </div>

  <div class="row mb-3 justify-content-center">
    <div class="col-md-2 align-self-center text-center">
      <button class="btn btn-primary">Submit</button>
    </div>
  </div>

</form>

<div class="row mb-3">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Document Date</th>
              <th>Net balance</th>
              <th>Transfer Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_{{ $table }}">
            @if(@$data)
            @foreach ($data as $d)
            <tr id="tr_{{ $table }}{{ $d->id }}">
              <td>{{ $loop->iteration }}</td>
              <td>{{ date('d/m/Y', strtotime($d->document_date)) }}</td>
              <td></td>
              <td>{{ date('d/m/Y', strtotime($d->production_date)) }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning">Cancel Replace</button>
                <button type="button" class="btn btn-sm btn-success" onclick="open_detail_data({{ $d->id }})">
                  Show Detail
                </button>
                <button type="button" class="btn btn-sm btn-primary" onclick="open_incoming_panel()">
                  Process Data
                </button>
                <button type="button" class="btn btn-sm btn-danger"
                  onclick="delete_document({{ $d->id }})">Delete</button>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row mb-3" id="detail_data" style="display: none">
  <div class="col">
    <div class="card">
      <div class="card-header bg-gray">Detail Data</div>
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Doc Number</th>
              <th>End No</th>
              <th>COB</th>
              <th>Gross Premium</th>
              <th>Claim Paid</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_document">
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <button class="btn btn-sm btn-primary" onclick="open_edit_detail_data()">Edit
                  Data</button>
                <button class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="row mt-3">
          <div class="col"></div>
          <div class="col-md-2 align-self-center">Total Gross Premium</div>
          <div class="col-md-2 align-self-center">
            <input type="text" class="form-control" name="contract_name" id="contract_name" autocomplete="off" disabled>
          </div>
          <div class="col-md-2 align-self-center text-center">Total Claim Paid</div>
          <div class="col-md-2 align-self-center">
            <input type="text" class="form-control" name="contract_name" id="contract_name" autocomplete="off" disabled>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>