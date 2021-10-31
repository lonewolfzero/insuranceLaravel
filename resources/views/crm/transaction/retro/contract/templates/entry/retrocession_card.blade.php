<div class="card">
  <div class="card-header bg-gray">Retrocession Panel</div>
  <div class="card-body bg-light-gray">

    <div class="row mb-3">
      <div class="col-md-2 align-self-center">Retrocession</div>
      <div class="col-md-6 align-self-center">
        <x-select-option id="retrocession" text="Select Retrocession" :master="$ceding" col1="code" col2="name" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-2 align-self-center">Share</div>
      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control money text-left" id="share" autocomplete="off">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3 justify-content-center">
      <div class="col-md-2 align-self-center text-center">
        <button type="button" class="btn btn-sm btn-primary" id="btn_add_retrocession" disabled>Add</button>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Retrocession</th>
              <th>Share</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_retrocession">
            @if (@$retrocessions)
            @foreach ($retrocessions as $r)
            <tr id="tr_retrocession{{ $r->id }}">
              <input type="hidden" name="r_id[]" value="{{ $r->id }}">
              <input type="hidden" name="r_retrocession[]" value="{{ $r->retrocession }}">
              <input type="hidden" name="r_share[]" value="{{ $r->share }}">
              <td>{{ $r->getceding->code }} - {{ $r->getceding->name }}</td>
              <td>{{ number_format($r->share, 2) }}%</td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-primary" onclick="add_member({{ $r->id }})">Add
                  Member</button>
                <button type="button" class="btn btn-sm" onclick="delete_retrocession({{ $r->id }})">
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

    <div class="row">
      <div class="col"></div>
      <div class="col-md-2 align-self-center">Total Share</div>
      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control" name="total_share" id="total_share"
            @if(@$specialContract->total_share) value="{{ number_format($specialContract->total_share, 2) }}" @endif
          autocomplete="off" readonly>
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>