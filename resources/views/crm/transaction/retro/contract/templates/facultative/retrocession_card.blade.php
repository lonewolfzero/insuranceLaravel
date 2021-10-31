<div class="card">
  <div class="card-header bg-gray">Retrocession Panel</div>
  <div class="card-body bg-light-gray">

    <form onsubmit="create_retrocession(this); return false" id="form_retrocession">

      <input type="hidden" name="contract_id" value="{{ @$contract->id }}">
      <div class="row mb-3">
        <div class="col-md-2 align-self-center">Retrocession</div>
        <div class="col-md-4 align-self-center">
          <x-select-option all="retrocession" :master="$ceding" text="Select Retrocession" col1="code" col2="name"
            :isrequired="true" />
        </div>
        <div class="col"></div>
        <div class="col-md-2 align-self-center">Commission</div>
        <div class="col-md-2 align-self-center">
          <div class="input-group">
            <x-input-money-format all="commission" :isrequired="true" />
            <div class="input-group-append">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-2 align-self-center">Share</div>
        <div class="col-md-2 align-self-center">
          <div class="input-group">
            <x-input-money-format all="share" :isrequired="true" />
            <div class="input-group-append">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
        <div class="col"></div>
        <div class="col-md-2 align-self-center">Overriding by Gross Premium</div>
        <div class="col-md-2 align-self-center">
          <div class="input-group">
            <x-input-money-format all="overriding_by_gross_premium" :isrequired="true" />
            <div class="input-group-append">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col"></div>
        <div class="col-md-2 align-self-center">Overriding by Nett Premium</div>
        <div class="col-md-2 align-self-center">
          <div class="input-group">
            <x-input-money-format all="overriding_by_nett_premium" :isrequired="true" />
            <div class="input-group-append">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3 justify-content-center">
        <div class="col-md-2 align-self-center text-center">
          <button class="btn btn-primary">Add</button>
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
                  <th>Retrocession</th>
                  <th>Share</th>
                  <th>Commission</th>
                  <th>Overriding by Gross Premium</th>
                  <th>Overriding by Net Premium</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody_retrocession">
                @foreach ($retrocessions as $r)
                <tr id="tr_retrocession{{ $r->id }}">
                  <td>{{ $r->getceding->code }} - {{ $r->getceding->name }}</td>
                  <td>{{ number_format($r->share, 2) }}%</td>
                  <td>{{ number_format($r->commission, 2) }}%</td>
                  <td>{{ number_format($r->overriding_by_gross_premium, 2) }}%</td>
                  <td>{{ number_format($r->overriding_by_nett_premium, 2) }}%</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-primary" onclick="add_member({{ $r->id }})">
                      Add Member
                    </button>
                    <button type="button" class="btn btn-sm btn-danger"
                      onclick="delete_retrocession({{ $r->id }})">Delete</button>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col"></div>
      <div class="col-md-2 align-self-center">Total Share</div>
      <div class="col-md-2 align-self-center">
        <div class="input-group">
          <input type="text" class="form-control money text-left" id="commission" autocomplete="off" readonly>
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>