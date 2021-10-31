<div class="card">

  <div class="card-header bg-gray">
    Structure Limit
  </div>

  <div class="card-body">

    <div class="row mb-2">
      <div class="col-md-3">ID Structure Limit</div>
      <div class="col-md-3">
        <input type="text" id="structure_limit_id" class="form-control form-control-sm" readonly>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Ban Limit (100%)</div>
      <div class="col-md-3">
        <input type="text" id="structure_limit_ban_limit" class="form-control form-control-sm money text-left">
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Net OR (% for QS)</div>
      <div class="col-md-3">
        <input type="text" id="structure_limit_net_or" class="form-control form-control-sm money text-left">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">Nasionalre Share</div>
      <div class="col-md-3">
        <div class="input-group input-group-sm">
          <input type="text" id="structure_limit_nasionalre_share_first"
            class="form-control form-control-sm money text-left">
          <div class="input-group-append"><span class="input-group-text">%</span></div>
        </div>
      </div>
      <div class="col-md-1 text-center">Of</div>
      <div class="col-md-3">
        <div class="input-group input-group-sm">
          <input type="text" id="structure_limit_nasionalre_share_second"
            class="form-control form-control-sm money text-left">
          <div class="input-group-append"><span class="input-group-text">%</span></div>
        </div>
      </div>
      <div class="col-md-2">Of 100%</div>
    </div>

    <div class="row mb-3">
      <div class="col text-center">
        <button type="button" class="btn btn-primary" id="add_structure_limit" disabled>
          Add
        </button>
      </div>
    </div>

    <table class="table table-bordered table-striped mb-3">
      <thead>
        <tr>
          <th>Treaty Limit</th>
          <th>Net OR</th>
          <th>Nasionalre Share</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody_structure_limit">
        @if (@$structure)
        @foreach ($structure as $s)
        <tr id="structure_limit_row{{ $s->id }}">
          <input type="hidden" value="{{ $s->id }}" name="sl_ids[]">
          <input type="hidden" value="{{ $s->ban_limit }}" name="sl_ban_limit[]" />
          <input type="hidden" value="{{ $s->net_or }}" name="sl_net_or[]" />
          <input type="hidden" value="{{ $s->nasionalre_first }}" name="sl_nasionalre_first[]" />
          <input type="hidden" value="{{ $s->nasionalre_second }}" name="sl_nasionalre_second[]" />
          <td>{{ number_format($s->ban_limit, 2) }}</td>
          <td>{{ number_format($s->net_or, 2) }}%</td>
          <td>{{ number_format($s->nasionalre_first, 2) }}% - {{ number_format($s->nasionalre_second, 2) }}%</td>
          <td>
            <button class="btn" onclick="delete_structure_limit({{ $s->id }})">
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

    {{-- <div class="row mb-2">
      <div class="col text-center"><button class="btn btn-primary">Submit</button></div>
      <div class="col text-center"><button class="btn btn-primary">Cancel</button></div>
    </div> --}}

  </div>

</div>