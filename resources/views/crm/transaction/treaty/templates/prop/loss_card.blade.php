<div class="card">

  <div class="card-header bg-gray">
    Loss participation
  </div>

  <div class="card-body">

    <div class="row mb-2">
      <div class="col-md-2">Share</div>
      <div class="col-md-4">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-sm money text-left" type="text" id="par_share" autocomplete="off">
          <div class="input-group-append"><span class="input-group-text">%</span></div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-2">Loss Ratio</div>
      <div class="col-md-4">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-sm money text-left" type="text" id="par_loss_ratio_first"
            autocomplete="off">
          <div class="input-group-append"><span class="input-group-text">%</span></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-sm money text-left" type="text" id="par_loss_ratio_second"
            autocomplete="off">
          <div class="input-group-append"><span class="input-group-text">%</span></div>
        </div>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col text-center"><button class="btn btn-primary" id="add_loss_participation" disabled>Add</button>
      </div>
    </div>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Share</th>
          <th>Loss Ratio</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbody_loss_participation">
        @if (@$losses)
        @foreach (@$losses as $ls)
        <tr id="loss_participation_row{{ $ls->id }}">
          <input type="hidden" value="{{ $ls->id }}" name="par_ids[]">
          <input type="hidden" value="{{ $ls->share }}" name="par_share[]" />
          <input type="hidden" value="{{ $ls->loss_ratio_first }}" name="par_loss_ratio_first[]" />
          <input type="hidden" value="{{ $ls->loss_ratio_second }}" name="par_loss_ratio_second[]" />
          <td>{{ number_format($ls->share, 2) }}%</td>
          <td>{{ number_format($ls->loss_ratio_first, 2) }}% - {{ number_format($ls->loss_ratio_second, 2) }}%</td>
          <td>
            <button class="btn">
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