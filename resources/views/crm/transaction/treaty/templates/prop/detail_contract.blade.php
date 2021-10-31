<div class="card">

  <div class="card-header bg-gray">
    Detail Contract
  </div>

  <div class="card-body bg-light-gray ">

    <div class="row mb-2">
      <div class="col-md-3">ID Detail Contract</div>
      <div class="col-md-3"><input class="form-control form-control-sm" type="text" name="id_detail_contract"
          id="id_detail_contract" value="{{ @$subdetail->getprop->id_detail_contract }}" readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Ceding Company</div>
      <div class="col-md-9">
        <select name="ceding_company" class="e1 form-control form-control-sm" id="ceding_company" required>
          <option value="" disabled selected>Select Ceding Company</option>
          @foreach ($ceding as $c)
          <option value="{{ $c->id }}" @if(@$subdetail->getprop->ceding_company == $c->id) selected @endif>
            {{ $c->code }} - {{ $c->name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">COB</div>
      <div class="col-md-6">
        <select name="cob" class="e1 form-control form-control-sm" id="cob" required>
          <option value="" disabled selected>Select COB</option>
          @foreach ($cob as $c)
          <option value="{{ $c->id }}" @if (@$subdetail->getprop->cob == $c->id) selected @endif>
            {{ $c->code }} - {{ $c->description }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">KOC</div>
      <div class="col-md-6">
        <select name="koc" class="e1 form-control form-control-sm" id="koc" required>
          <option value="" disabled selected>Select KOC</option>
          @foreach ($koc as $k)
          <option value="{{ $k->id }}" @if (@$subdetail->getprop->koc == $k->id) selected @endif>
            {{ $k->code }} - {{ $k->description }}
          </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card">

          <div class="card-header bg-gray">
            Type Perusahaan
          </div>

          <div class="card-body">
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="type_perusahaan" id="type_perusahaan1"
                @if(@$subdetail->getprop->type_perusahaan == "ceding") checked @endif value="ceding" required>
              <label class="form-check-label" for="type_perusahaan1">
                Ceding
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="type_perusahaan" id="type_perusahaan2"
                @if(@$subdetail->getprop->type_perusahaan == "penjaminan") checked @endif value="penjaminan">
              <label class="form-check-label" for="type_perusahaan2">
                Penjaminan
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="type_perusahaan" id="type_perusahaan3"
                @if(@$subdetail->getprop->type_perusahaan == "konsorium") checked @endif value="konsorium">
              <label class="form-check-label" for="type_perusahaan3">
                Konsorsium
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="type_perusahaan" id="type_perusahaan4"
                @if(@$subdetail->getprop->type_perusahaan == "overseas") checked @endif value="overseas">
              <label class="form-check-label" for="type_perusahaan4">
                Overseas
              </label>
            </div>
          </div>
        </div>
      </div>
      @if (request()->path() == "treaty/prop/credit/entry")
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-gray">
            Bank/LKNB
          </div>

          <div class="card-body">
            <div class="row mb-2">
              <div class="col-md-3">Bank/LKNB</div>
              <div class="col-md-9">
                <select id="bank" class="e1 form-control form-control-sm">
                  <option value="" selected disabled>Bank</option>
                  @foreach ($banks as $b)
                  <option value="{{ $b->id }}">{{ $b->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2 justify-content-center">
              <div class="col-md-3">
                <button class="btn btn-sm btn-primary" type="button" id="add_bank">
                  Add
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>No</td>
                      <td>Bank</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                  <tbody id="tbody_bank">

                    @if (@$credit_banks)
                    @foreach ($credit_banks as $b)
                    <tr id="bank_row{{ $b->id }}">
                      <input type="hidden" value="{{ $b->id }}" name="bank_ids[]">
                      <input type="hidden" value="{{ $b->bank_id }}" name="banks[]" />
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $b->getbank->name }}</td>
                      <td>
                        <button class="btn" onclick="delete_bank({{ $b->id }})">
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
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>

  </div>

</div>