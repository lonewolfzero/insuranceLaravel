<div class="card">

  <div class="card-header bg-gray">
    Backup Retro
  </div>

  <div class="card-body bg-light-gray">

    <div class="row mb-2">
      <div class="col-md-3">Retro Contract No</div>
      <div class="col-md-6">
        <select class="e1 form-control form-control-sm" id="retro_contract_no">
          <option value="" disabled selected>Select Retro Contract</option>
          @foreach ($mainContract as $data)
          <option value="{{ $data->id }}">{{ $data->main_contract }}</option>
          @endforeach
          @foreach ($specialContract as $data)
          <option value="{{ $data->id }}">{{ $data->contract_name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-3">Retro (%)</div>
      <div class="col-md-3"><input class="form-control form-control-sm percentage" type="text" id="retro_percentage">
      </div>
      <div class="col"></div>
      <div class="col-md-3"><button class="btn btn-primary" id="add_retro" disabled>Add</button></div>
    </div>

    {{-- <div class="row mb-2">
      <div class="col-md-3">Pure (%)</div>
      <div class="col-md-3"><input class="form-control form-control-sm percentage" type="text" id="pure_percentage">
      </div>
    </div> --}}

    <div class="row mb-2">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Retro Contract No</th>
                  <th>Retro (%)</th>
                  {{-- <th>Pure (%)</th> --}}
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody_backup_retro">
                @if (@$retros)
                @foreach (@$retros as $rt)
                <tr id="backup_retro_row{{ $rt->id }}">
                  <input type="hidden" value="{{ $rt->id }}" name="retro_ids[]">
                  <input type="hidden" value="{{ $rt->retro_contract_no }}" name="retro_contract_no[]" />
                  <input type="hidden" value="{{ $rt->retro_percentage }}" name="retro_percentage[]" />
                  <td>{{ $rt->retro_contract_no }}</td>
                  <td>{{ $rt->retro_percentage }}</td>
                  <td>
                    <button class="btn" onclick="delete_backup_retro({{ $rt->id }})">
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
</div>