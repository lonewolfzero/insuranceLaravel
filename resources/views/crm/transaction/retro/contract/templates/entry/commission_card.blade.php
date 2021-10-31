<div class="card">
  <div class="card-header bg-gray">Commission Panel</div>
  <div class="card-body bg-light-gray">

    <div class="row mb-3">
      <div class="col-md-4 align-self-center">COB</div>
      <div class="col-md-6 align-self-center">
        <x-select-option id="commission_panel_cob" text="Select COB" :master="$cob" col1="code" col2="description" />
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4 align-self-center">Commission</div>
      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control money text-left" id="commission" autocomplete="off">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4 align-self-center">Overriding by Gross Premium</div>
      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control money text-left" id="overriding_by_gross_premium" autocomplete="off">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4 align-self-center">Overriding by Nett Premium</div>
      <div class="col-md-3 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control money text-left" id="overriding_by_nett_premium" autocomplete="off">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3 justify-content-center">
      <div class="col-md-2 align-self-center text-center">
        <button type="button" class="btn btn-sm btn-primary" id="btn_add_commission" disabled>Add</button>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>COB</th>
              <th>Commission</th>
              <th>Overriding by Gross Premium</th>
              <th>Overriding by Nett Premium</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_commission">
            @if(@$commissions)
            @foreach ($commissions as $c)
            <tr id="tr_commission{{ $c->id }}">
              <input type="hidden" name="c_id[]" value="{{ $c->id }}">
              <input type="hidden" name="c_cob[]" value="{{ $c->cob }}">
              <input type="hidden" name="c_commission[]" value="{{ $c->commission }}">
              <input type="hidden" name="c_gross[]" value="{{ $c->overriding_by_gross_premium }}">
              <input type="hidden" name="c_nett[]" value="{{ $c->overriding_by_nett_premium }}">
              <td>{{ $c->getcob->code }} - {{ $c->getcob->description }}</td>
              <td>{{ number_format($c->commission, 2) }}%</td>
              <td>{{ number_format($c->overriding_by_gross_premium, 2) }}%</td>
              <td>{{ number_format($c->overriding_by_nett_premium, 2) }}%</td>
              <td class="text-center">
                <button type="button" class="btn btn-sm" onclick="delete_commission({{ $c->id }})">
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